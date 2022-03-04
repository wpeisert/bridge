<tr>
    <td>
        <b>ID: </b>{{ $deal->id }}<br />
        <b>Dealer: </b>
        {{ $PLAYERS_NAMES[intval($deal->dealer)] }}
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
        @for ($iter = 0; $iter < $PLAYERS_COUNT; ++$iter)
            <strong>{{ $PLAYERS_NAMES[$iter] }}:</strong>
            {!! $deal->getOneLineCards($iter) !!}
            <br />
        @endfor
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
