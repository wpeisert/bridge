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

    @php
        $count = 0;
        $result_NS = 0;
        $result_ns_imp = 0;
        $result_WE = 0;
        $result_we_imp = 0;
    @endphp

    @foreach ($training->biddings as $bidding)
        <a href="{{ route('mybidding', $bidding->id) }}">[ {!! $biddingParser->parse($bidding)->getContractAsString() !!} ]</a>  &nbsp;
        @if ($bidding->is_finished)
            @php
                $count++;
                $result_NS += $bidding->result_NS;
                $result_ns_imp += $bidding->result_ns_imp;
                $result_WE += $bidding->result_WE;
                $result_we_imp += $bidding->result_we_imp;
            @endphp
            <b>NS:</b> {{ $bidding->result_NS }} <b>IMP:</b> {{ $bidding->result_ns_imp }} &nbsp;
            <b>WE:</b> {{ $bidding->result_WE }} <b>IMP:</b> {{ $bidding->result_we_imp }}
            <br />
        @endif
    @endforeach
    <b>Total: </b>
    <b>NS:</b> {{ $result_NS }} <b>IMP:</b> {{ $result_ns_imp }} &nbsp;
    <b>WE:</b> {{ $result_WE }} <b>IMP:</b> {{ $result_we_imp }}
    <br />
    <b>Avg: </b>
    <b>NS:</b> {{ $result_NS / $count }} <b>IMP:</b> {{ $result_ns_imp / $count }} &nbsp;
    <b>WE:</b> {{ $result_WE / $count }} <b>IMP:</b> {{ $result_we_imp / $count }}
    <br />

    <hr />
@endforeach
