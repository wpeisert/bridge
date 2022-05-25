<h3>{{ __( $title ) }} </h3>
@foreach($trainings as $train)
    <hr />

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
            {{ $playerName }}: {{ $player->name }} @if ($you)({{ __('You') }})@endif&nbsp;
        @endif
    @endforeach
    <br />
    @foreach (['you', 'other', 'finished'] as $stage)
        @if (count($train['biddings'][$stage]))
            <b>{{ __($stage) }}: </b>
            @foreach ($train['biddings'][$stage] as $bidding)
                <a href="{{ route('mybidding', $bidding->id) }}">[ {!! $biddingParser->parse($bidding)->getContractAsString() !!} ]</a> &nbsp;
            @endforeach
            &nbsp; &nbsp;
        @endif
    @endforeach
@endforeach
