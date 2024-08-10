<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Message;
use Livewire\Component;
use App\Helpers\General;
use Livewire\Attributes\On;
use App\Events\MessageSendEvent;

class ChatMessenger extends Component
{
    protected $listeners = ['show_chat' => 'showChat', 'scroll_bottom' => 'scrollBottom'];

    public $user;
    public $sender_id;
    public $receiver_id;
    public $message = "";
    public $messages = [];
    public function render()
    {
        return view('livewire.chat-messenger');
    }

    public function mount()
    {
        $this->sender_id = auth()->user()->id;
    }

    public function showChat($user_id)
    {
        // dd($user_id);
        $this->sender_id = auth()->user()->id;
        $this->receiver_id = $user_id;

        $messages = Message::where(function ($query) {
            $query->where('sender_id', $this->sender_id)
                ->where('receiver_id', $this->receiver_id);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->receiver_id)
                ->where('receiver_id', $this->sender_id);
        })
            ->with('sender:id,name', 'receiver:id,name')
            ->get();

        foreach ($messages as $message) {
            $this->appendChatMessage($message);
        }

        $this->user = User::where('id', $user_id)->first();
    }

    public function appendChatMessage($message)
    {
        $this->messages[] = [
            'id' => $message->id,
            'sender_id' => $message->sender_id,
            'message' => $message->message,
            'sender' => $message->sender->name,
            'receiver' => $message->receiver->name,
            'date' => General::formatDateTime($message->created_at),
        ];
    }

    public function sendMessage()
    {
        $chat = new Message();
        $chat->sender_id = $this->sender_id;
        $chat->receiver_id = $this->receiver_id;
        $chat->message = $this->message;
        $chat->save();

        /* show message on current user chat box */
        $this->appendChatMessage($chat);

        broadcast(new MessageSendEvent($chat))->toOthers();

        $this->message = "";

        $this->scrollBottom();
    }

    public function scrollBottom()
    {
        $this->dispatch('scrollToBottom')->self();
    }

    /* creater listner after broadcast */
    #[On("echo:private-chat-channel.{sender_id},MessageSendEvent")]
    public function listenForMessage($event)
    {
        $currenctMessage = Message::whereId($event['chatMessage']['id'])
            ->with('sender:id,name', 'receiver:id,name')
            ->first();

        /* boardcasting show message */
        $this->appendChatMessage($currenctMessage);

        $this->scrollBottom();
    }
}
