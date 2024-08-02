<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ "Chat Box" }}
        </h2>
    </x-slot>
    @livewire('chat-message', ['user_id' => $id])
</x-app-layout>
