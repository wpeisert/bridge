<x-my-bidding-layout>

    <x-slot name="title"></x-slot>
    <x-slot name="subtitle"></x-slot>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('mybidding.create') }}"> {{ __('Start a new training') }} </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="font-bold p-6 bg-white border-b border-gray-200">
            @include(
                'mybidding.include.mybidding_split',
                [
                    'title' => __('Active trainings'),
                    'trainings' => $activeTrainings,
                    'biddingParser' => $biddingParser,
                ]
            )
        </div>
        <div class="font-bold p-6 bg-white border-b border-gray-200">
            @include(
                'mybidding.include.mybidding_simple',
                [
                    'title' => __('Finished trainings'),
                    'trainings' => $finishedTrainings,
                    'biddingParser' => $biddingParser,
                ]
            )
        </div>
    </div>
</x-my-bidding-layout>
