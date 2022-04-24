<h3>{{ __( $title ) }} </h3>
<hr />
@foreach($trainings as $training)

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
    @foreach ($training->biddings as $bidding)
        <a href="{{ route('mybidding', $bidding->id) }}">[ {!! $biddingParser->parse($bidding)->getContract() !!} ]</a> &nbsp;
    @endforeach
@endforeach