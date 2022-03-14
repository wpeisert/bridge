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
        NS: {{ $dealConstraint->vulnerable_ns_human }}<br />
        WE: {{ $dealConstraint->vulnerable_we_human }}<br />
    </td>
    <td>
        {{ $dealConstraint->dealer_human }}
    </td>
    <td>
        @foreach ($dealConstraint->constraints_human as $constraint)
            {!! $constraint['name'] !!} {{ $constraint['value'] }} <br />
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
