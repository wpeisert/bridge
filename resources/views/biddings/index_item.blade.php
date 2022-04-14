<tr>
    <td>
        {{ $bidding->id }}
    </td>
    <td>
        {{ $bidding->training->quiz->name }}
    </td>
    <td>
        {{ $bidding->deal_id }}
    </td>
    @foreach ($PLAYERS_NAMES as $playerName)
        <td>
            @php
                $player = $bidding->training->getUser($playerName);
            @endphp
            {{ isset($player) ? $player->name : '' }}
        </td>
    @endforeach
    <td>
        <form action="{{ route('biddings.destroy',$bidding->id) }}" method="POST">
            <a class="btn btn-info" href="{{ route('biddings.show',$bidding->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('biddings.edit',$bidding->id) }}">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>
