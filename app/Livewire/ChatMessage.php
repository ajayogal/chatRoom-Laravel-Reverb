<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ChatMessage extends Component
{
    public $user;
    public function render()
    {
        return view('livewire.chat-message');
    }

    public function mount($user_id)
    {
        $this->user = User::where('id', $user_id)->first();
    }

}
