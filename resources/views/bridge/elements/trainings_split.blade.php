<b>{{ __( $title ) }} </b> <br />
@foreach($trainings as $train)

    @php
        $training = $train['training']
    @endphp
    @foreach($PLAYERS_NAMES as $playerName)
        @php
            $player = $training->getUser($playerName);
            $fieldName = 'user_id_' . $playerName;
            $you = Auth::user()->id === $training->$fieldName;
        @endphp
        @if (isset($player))
            {{ $playerName }}: {{ $player->name }} @if ($you)(You)@endif&nbsp;
        @endif
    @endforeach
    <br />
    @foreach (['you', 'other', 'finished'] as $stage)
        @if (count($train['biddings'][$stage]))
            <b>{{ $stage }}: </b>
            @foreach ($train['biddings'][$stage] as $bidding)
                <a href="{{ route('biddings.show', $bidding->id) }}">[ {!! $biddingParser->parse($bidding)->getContract() !!} ]</a> &nbsp;
            @endforeach
            &nbsp; &nbsp;
        @endif
    @endforeach
    <br />
@endforeach
