<tr>
    <td>
        {{ $training->id }}
    </td>
    <td>
        {{ $training->quiz->name }}
    </td>
    @foreach ($PLAYERS_NAMES as $playerName)
        <td>
            @php
                $player = $training->getUser($playerName);
            @endphp
            {{ isset($player) ? $player->name : '' }}
        </td>
    @endforeach
    <td>
        <form action="{{ route('trainings.destroy',$training->id) }}" method="POST">
            <a class="btn btn-info" href="{{ route('trainings.show',$training->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('trainings.edit',$training->id) }}">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>
