<tr>
    <td>
        {{ $training->id }}
    </td>
    <td>
        {{ $training->quiz->name }}
    </td>
    <td>
        {{ $training->quiz->deals_count }}
    </td>
    <td>
        Dealer: {{ $training->quiz->deal_constraint->dealer }}<br />
        Vulnerable NS: {{ $training->quiz->deal_constraint->vulnerable_ns_human }}<br />
        Vulnerable WE: {{ $training->quiz->deal_constraint->vulnerable_we_human }}<br />
        Constraints:
        <ul style="list-style-type: disc; margin-left: 30px">
            @foreach ($training->quiz->deal_constraint->constraints_human as $constraint)
                <li>{!! $constraint['name']  !!} {{ $constraint['value'] }}</li>
            @endforeach
        </ul>
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
            @if (!$training->isStarted())
            <a class="btn btn-info" href="{{ route('trainings.edit',$training->id) }}">Edit</a>
            @endif
            @csrf
            @if (!$training->isStarted())
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
                <a class="btn btn-primary" href="{{ route('trainings.start',$training->id) }}">Start!</a>
            @endif

        </form>
    </td>
</tr>
