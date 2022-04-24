<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My bidding') }}
        </h2>
    </x-slot>

        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('mybidding.next', $bidding->id) }}">Next</a>
            </div>
        </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="font-bold p-6 bg-white border-b border-gray-200">
                    X Y Z
                </div>
            </div>
        </div>
    </div>
</x-app-layout>