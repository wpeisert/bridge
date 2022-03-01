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
        <form action="{{ route('quizes.destroy',$quiz->id) }}" method="POST">
            <a class="btn btn-info" href="{{ route('quizes.show',$quiz->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('quizes.edit',$quiz->id) }}">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>
