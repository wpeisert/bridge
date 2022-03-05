<tr>
    <td>
        {{ $dealConstraint->id }}
    </td>
    <td>
        {{ $dealConstraint->name }}
    </td>
    <td>
        {{ $dealConstraint->description }}
    </td>
    <td>
        {{ $DEAL_CONSTRAINTS_VULNERABLE[intval($dealConstraint->vulnerable)] }}
    </td>
    <td>
        {{ $DEAL_CONSTRAINTS_DEALER[intval($dealConstraint->dealer)] }}
    </td>
    <td>
        @foreach ($DEAL_CONSTRAINTS_FIELDS as $name => $field)
            @if ($field['defaultValue'] !== $dealConstraint->$name)
                @php
                    $parsedName = str_replace(
                        array_merge(['PC'], $COLORS_NAMES, array_keys($PLAYERS_NAMES), ['_', 'from', 'to']),
                        array_merge(['Points'], $COLORS_SYMBOLS, $PLAYERS_NAMES, [' ', '>=', '<=']),
                        $name
                    );
                @endphp
                {!! $parsedName !!} {{ $dealConstraint->$name }}<br />
            @endif
        @endforeach
    </td>
    <td>
        <form action="{{ route('deal_constraints.destroy',$dealConstraint->id) }}" method="POST">
            <a class="btn btn-info" href="{{ route('deal_constraints.show',$dealConstraint->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('deal_constraints.edit',$dealConstraint->id) }}">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>
