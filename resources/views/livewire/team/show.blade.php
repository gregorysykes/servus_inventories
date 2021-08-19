{{-- <div>
    Because she competes with no one, no one can compete with her.
    
</div> --}}
<x-app-layout>
    <x-slot name="title">
        Team Management
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Team Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('team.add-team')
                @livewire('team.all-team',['teams'=>$teams])
            </div>
        </div>
    </div>
</x-app-layout>
