<tr>
    <td>
        <b>ID: </b>{{ $deal->id }}<br />
        <b>Start player: </b>
        {{ $deal->getPlayersNames()[intval($deal->start_player_no)] }}
        <br />
        <b>Vulnerable: </b>
        @if ($deal->vulnerable_02 && $deal->vulnerable_13) both
        @elseif ($deal->vulnerable_02) NS
        @elseif ($deal->vulnerable_13) WE
        @else - none -
        @endif
        <br />
        {{ $deal->description }}
        <br />
    </td>
    <td>
        <b>N:</b> {!! $deal->getOneLineCards(0) !!}<br />
        <b>E:</b> {!! $deal->getOneLineCards(1) !!}<br />
        <b>S:</b> {!! $deal->getOneLineCards(2) !!}<br />
        <b>W:</b> {!! $deal->getOneLineCards(3) !!}<br />
    </td>
    <td>
        <form action="{{ route('deals.destroy',$deal->id) }}" method="POST">
            <a class="btn btn-info" href="{{ route('deals.show',$deal->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('deals.edit',$deal->id) }}">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>
