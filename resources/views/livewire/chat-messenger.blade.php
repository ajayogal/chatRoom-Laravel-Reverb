<div class="flex-1">
    <!-- Chat Header -->
    <header class="bg-white p-4 text-gray-700">
        <div class="avatar receiver">{{ $user? Str::substr($user->name, 0, 2) : "" }}</div>
        <h1 class="text-2xl font-semibold">{{ $user? $user->name : "Start Chat" }}</h1>
    </header>

    <!-- Chat Messages -->
    <div id="chat-messages" class="screen float-left w-full overflow-y-auto p-4 pb-0" style="height: 63vh">
        @empty($messages)
            <div class="flex mt-20 justify-center ">
                <div class="p-3 bg-white rounded-lg shadow-lg w-100">
                    <p>No chat messages</p>
                </div>
            </div>
        @endempty
        @foreach($messages as $message)
            @if($message['sender_id'] == $receiver_id)
                <!-- Incoming Message -->
                <div class="flex mb-4 cursor-pointer">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center mr-2">
                        <img src="https://placehold.co/200x/2e83ad/ffffff.svg?text={{ $message['sender'] }}&font=Lato" alt="{{ $message['sender'] }}"
                            class="w-8 h-8 rounded-full">
                    </div>
                    <div class="flex max-w-96 bg-white rounded-lg p-3 gap-3">
                        <p class="text-gray-700">{{ $message['message'] }}</p>
                    </div>
                </div>
            @endif
            @if($message['sender_id'] == $sender_id)
                <!-- Outgoing Message -->
                <div class="flex justify-end mb-4 cursor-pointer">
                    <div class="flex max-w-96 bg-indigo-500 text-white rounded-lg p-3 gap-3">
                        <p>{{ $message['message'] }}</p>
                    </div>
                    <div class="w-9 h-9 rounded-full flex items-center justify-center ml-2">
                        <img src="https://placehold.co/200x/ffa8e4/ffffff.svg?text={{ $message['sender'] }}&font=Lato" alt="{{ $message['sender'] }}"
                            class="w-8 h-8 rounded-full">
                    </div>
                </div>

            @endif
        @endforeach

    </div>

    <!-- Chat Input -->
    <form wire:submit="sendMessage">
        <footer class="bg-white border-t border-gray-300 p-4 absolute bottom-0 w-full">
            <div class="flex items-center">
                <input wire:model="message" type="text" placeholder="Type a message..."
                @disabled(empty($user))
                    class="w-full p-2 rounded-md border border-gray-400 focus:outline-none focus:border-blue-500">
                <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-md ml-2" @disabled(empty($user))>Send</button>
            </div>
        </footer>
    </form>

    <!-- Add this script to handle scrolling -->
    @script
    <script>
        $wire.on('scrollToBottom', (event) => {
            const chatMessages = document.getElementById('chat-messages');
            setTimeout(() => {
                chatMessages.scrollTop = chatMessages.scrollHeight + 64;
            }, 500);
        });
    </script>

    @endscript
    <script>
        document.addEventListener('livewire:init', function () {
            const chatMessages = document.getElementById('chat-messages');
            if (chatMessages) {
                chatMessages.addEventListener('scroll', function () {
                    console.log(chatMessages.scrollHeight);
                    // You can add any other logic here, such as checking scroll position.
                });
            }
        });
    </script>
</div>
