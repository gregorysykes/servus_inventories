{{-- <div>
    Be like water.
</div> --}}
{{-- <div>
    Because she competes with no one, no one can compete with her.
    
</div> --}}
<x-app-layout>
    <x-slot name="title">
        Rejects
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rejects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('rejects.all-rejects',['rejects'=>$rejects, 'states'=>$states])
            </div>
        </div>
    </div>
</x-app-layout>
