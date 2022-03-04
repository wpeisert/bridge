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
                <strong>Start player: </strong>
                {{ $deal->getPlayersNames()[intval($deal->start_player_no)] }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>NS vulnerable:</strong>
                {{ $deal->vulnerable_02 }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>WE vulnerable:</strong>
                {{ $deal->vulnerable_13 }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $deal->description }}
            </div>
        </div>

        @for ($iter = 0; $iter < $deal->getPlayersCount(); ++$iter)
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ $deal->getPlayersNames()[$iter] }} cards:</strong>
                    {!! $deal->getOneLineCards($iter) !!}
                </div>
            </div>
        @endfor

    </div>
</x-deals-layout>
