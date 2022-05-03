<x-my-bidding-layout>
    <x-slot name="subtitle"></x-slot>
    <x-slot name="title"></x-slot>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('mybidding.nextbid', $bidding->id) }}"> Next </a>
            </div>
        </div>
    </div>

    @include (
        'biddings.bidding_content',
        [
            'bidding' => $bidding,
            'type' => 'bid',
        ]
    )

</x-my-bidding-layout>
