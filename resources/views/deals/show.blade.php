<x-deals-layout>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <a class="btn btn-primary" href="javascript:history.back();"> Back</a>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('deals.index') }}"> Deals list</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ID:</strong>
                {{ $deal->id }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Dealer: </strong>
                {{ $PLAYERS_NAMES[intval($deal->dealer)] }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>NS vulnerable:</strong>
                {{ $deal->vulnerable_NS }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>WE vulnerable:</strong>
                {{ $deal->vulnerable_WE }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $deal->description }}
            </div>
        </div>

        @foreach ($PLAYERS_NAMES as $playerName)
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ $playerName }} cards:</strong>
                    {!! $deal->getOneLineCards($playerName) !!}
                </div>
            </div>
        @endforeach

    </div>
</x-deals-layout>
