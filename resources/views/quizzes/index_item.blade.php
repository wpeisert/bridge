<tr>
    <td>
        {{ $quiz->id }}
    </td>
    <td>
        {{ $quiz->name }}
    </td>
    <td>
        {{ $quiz->description }}
    </td>
    <td>
        {{ $quiz->deals_count }} / {{ $quiz->existing_deals_count }}
    </td>
    <td>
        Dealer: {{ $quiz->deal_constraint->dealer_human }}<br />
        Vulnerable: {{ $quiz->deal_constraint->vulnerable_human }}<br />
        Constraints:
        <ul style="list-style-type: disc; margin-left: 30px">
            @foreach ($quiz->deal_constraint->constraints_human as $constraint)
                <li>{!! $constraint['name']  !!} {{ $constraint['value'] }}</li>
            @endforeach
        </ul>
    </td>
    <td>
        @foreach($quiz->deals()->get() as $deal)
            <a href="{{ route('deals.show', $deal->id) }}">[{{ $loop->iteration }}]</a> &nbsp;
        @endforeach
    </td>
    <td>
        <form action="{{ route('quizzes.destroy',$quiz->id) }}" method="POST">
            @if ($quiz->deals_count > $quiz->existing_deals_count)
            <a class="btn btn-primary" href="{{ route('quizzes.generate-deals',$quiz->id) }}">Generate</a>
            @endif
            <a class="btn btn-info" href="{{ route('quizzes.show',$quiz->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('quizzes.edit',$quiz->id) }}">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>
