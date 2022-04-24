<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My biddings') }}
        </h2>
    </x-slot>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{!! $message !!}</p>
        </div>
    @endif

    @if ($message = Session::get('danger'))
        <div class="alert alert-danger">
            <p>{!! $message !!}</p>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('mybidding.create') }}">Start a new training</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="font-bold p-6 bg-white border-b border-gray-200">
                        @include(
                            'bridge.elements.mytrainings_split',
                            [
                                'title' => 'Active trainings',
                                'trainings' => $activeTrainings,
                                'biddingParser' => $biddingParser,
                            ]
                        )
                    </div>
                    <div class="font-bold p-6 bg-white border-b border-gray-200">
                        @include(
                            'bridge.elements.mytrainings',
                            [
                                'title' => 'Finished trainings',
                                'trainings' => $finishedTrainings,
                                'biddingParser' => $biddingParser,
                            ]
                        )
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
