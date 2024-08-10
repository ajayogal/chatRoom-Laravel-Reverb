<div class="w-1/4 bg-white border-r border-gray-300">
    <!-- Sidebar Header -->
    <header class="p-4 border-b border-gray-300 flex justify-between items-center bg-indigo-600 text-white">
        <h1 class="text-2xl font-semibold">{{ $title }}</h1>
    </header>

    <!-- Contact List -->
    <div class="overflow-y-auto h-screen p-3 mb-9 pb-20">
        @foreach ($friends as $friend)
            <div wire:click="loadFriendChat({{ $friend->id }})" class="flex items-center mb-4 cursor-pointer hover:bg-gray-100 p-2 rounded-md">
                <div class="">
                    <div class="avatar receiver">{{ Str::substr($friend->name, 0, 2) }}</div>
                </div>
                <div class="flex-1">
                    <h2 class="text-lg font-semibold">{{ $friend->name }}</h2>
                    @if($friend->latestMessage)
                    <p class="text-gray-600">{{ $friend->latestMessage->message }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
