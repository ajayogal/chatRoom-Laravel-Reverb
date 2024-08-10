<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ChatFriends extends Component
{
    public $title = "Chat Friends";
    public $friends = [];
    public $friend_id = NULL;
    public function render()
    {
        return view('livewire.chat-friends');
    }

    public function mount()
    {
        $this->friends = User::where('id', '!=', auth()->user()->id)->with('latestMessage')->get();
    }

    public function loadFriendChat($value)
    {
        // dd($value);
        $this->dispatch('show_chat', $value);
        $this->dispatch('scroll_bottom');

    }
}
