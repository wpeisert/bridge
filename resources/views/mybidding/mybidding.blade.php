<x-my-bidding-layout>

    <x-slot name="subtitle"></x-slot>
    <x-slot name="backButtonRoute"></x-slot>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('mybidding.next', $bidding->id) }}">Next</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="font-bold p-6 bg-white border-b border-gray-200">
            Bidding ID: {{ $bidding->id }}
        </div>
    </div>
</x-my-bidding-layout>
