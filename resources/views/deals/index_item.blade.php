<tr>
    <td>
        <b>ID: </b>{{ $deal->id }}<br />
        <b>Dealer: </b>
        {{ $PLAYERS_NAMES[intval($deal->dealer)] }}
        <br />
        <b>Vulnerable: </b>
        @if ($deal->vulnerable_NS && $deal->vulnerable_WE) both
        @elseif ($deal->vulnerable_NS) NS
        @elseif ($deal->vulnerable_WE) WE
        @else - none -
        @endif
        <br />
        {{ $deal->description }}
        <br />
    </td>
    <td>
        @foreach ($PLAYERS_NAMES as $playerName)
            <strong>{{ $playerName }}:</strong>
            <div>
                {!! $deal->getOneLineCards($playerName) !!}
            </div>
        @endforeach
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
