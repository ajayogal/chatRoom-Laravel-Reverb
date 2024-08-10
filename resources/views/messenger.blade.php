<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ "Messenger" }}
        </h2>
    </x-slot>
    <!-- component -->
    <div class=" overflow-hidden bg-black relative" style="height: 80vh">
        <div class="flex overflow-hidden">
            <!-- Sidebar -->
            @livewire('chat-friends')

            <!-- Main Chat Area -->
            @livewire('chat-messenger')

        </div>
    </div>
</x-app-layout>
