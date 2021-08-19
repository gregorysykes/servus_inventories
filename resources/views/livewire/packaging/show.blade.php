{{-- <div>
    Nothing in the world is as soft and yielding as water.
</div> --}}
<x-app-layout>
    <x-slot name="title">
        {{__('Packaging')}}
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Packaging') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('packaging.add-packaging',['processes'=>$processes])
                @livewire('packaging.all-packaging',['packagings'=>$packagings])
            </div>
        </div>
    </div>
</x-app-layout>
