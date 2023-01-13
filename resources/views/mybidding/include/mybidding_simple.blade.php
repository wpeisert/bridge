<style>
    .table_results {
        border: 1px solid silver;
    }
    .table_results tr {
        border: 1px solid silver;
        vertical-align: top;
    }
    .table_results tr * {
        border: 1px solid silver;
        padding: 3px;
        text-align: center;
    }
</style>

<h3>{{ __( $title ) }} </h3>

<hr />

@php
    $count = 0;
    $result_NS = 0;
    $result_ns_imp = 0;
    $result_WE = 0;
    $result_we_imp = 0;
@endphp

@foreach($trainings as $training)

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

    <table class="table_results">
        <tr>
            <th>Deal</th>
            <th>NS</th>
            <th>NS IMP</th>
            <th>WE</th>
            <th>WE IMP</th>
        </tr>
        @foreach ($training->biddings as $bidding)
            <tr>
                <td>
                    <a href="{{ route('mybidding', $bidding->id) }}">[ {!! $biddingParser->parse($bidding)->getContractAsString() !!} ]</a>  &nbsp;
                </td>
            @if ($bidding->is_finished)
                @php
                    $count++;
                    $result_NS += $bidding->result_NS;
                    $result_ns_imp += $bidding->result_ns_imp;
                    $result_WE += $bidding->result_WE;
                    $result_we_imp += $bidding->result_we_imp;
                @endphp
                <td>{{ $bidding->result_NS }}</td>
                <td>{{ $bidding->result_ns_imp }}</td>
                <td>{{ $bidding->result_WE }}</td>
                <td>{{ $bidding->result_we_imp }}</td>
            @endif
            </tr>
        @endforeach
        <tr>
            <td>Total</td>
            <td>{{ $result_NS }}</td>
            <td>{{ $result_ns_imp }}</td>
            <td>{{ $result_WE }}</td>
            <td>{{ $result_we_imp }}</td>
        </tr>
        <tr>
            <td>Avg.</td>
            <td>{{ round($result_NS / $count, 1) }}</td>
            <td>{{ round($result_ns_imp / $count, 1) }}</td>
            <td>{{ round($result_WE / $count, 1) }}</td>
            <td>{{ round($result_we_imp / $count, 1) }}</td>
        </tr>

    </table>
    <hr />
@endforeach
