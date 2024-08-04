<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ "Messenger" }}
        </h2>
    </x-slot>
    <!-- component -->
    @livewire('chat-messenger')
</x-app-layout>