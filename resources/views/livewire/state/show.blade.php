{{-- <div>
    Knowing others is intelligence; knowing yourself is true wisdom.
</div> --}}
<x-app-layout>
    <x-slot name="title">
        State Management
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('State Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('state.add-state',['states'=>$states])
                @livewire('state.all-state',['states'=>$states])
            </div>
        </div>
    </div>
</x-app-layout>
