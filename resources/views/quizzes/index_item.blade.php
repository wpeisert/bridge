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
        @foreach($quiz->deals()->get() as $deal)
            <a href="{{ route('deals.show', $deal->id) }}">[{{ $loop->iteration }}]</a> &nbsp;
        @endforeach
    </td>
    <td>
        <form action="{{ route('quizzes.destroy',$quiz->id) }}" method="POST">
            <a class="btn btn-info" href="{{ route('quizzes.show',$quiz->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('quizzes.edit',$quiz->id) }}">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>
