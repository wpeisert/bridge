@php
    $formAction = $formAction ?? '';
@endphp

@if ($formAction === 'update')
<form action="{{ route('trainings.update',$training->id) }}" method="POST">
    @csrf
    @method('PUT')
@elseif (($formAction === 'store'))
<form action="{{ route('trainings.store') }}" method="POST">
    @csrf
@else
    <form>
        <fieldset disabled="disabled">
@endif

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Quiz:</strong>
                <select class="form-control" name="quiz_id">
                    @foreach ($quizzes as $quiz)
                        <option value="{{ $quiz->id }}" @selected($quiz->id == (isset($training) ? $training->quiz_id : 0))>
                            {{ $quiz->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        @foreach ($PLAYERS_NAMES as $playerName)
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Player {{ $playerName }}:</strong>
                @php
                    $userField = 'user_id_' . $playerName;
                @endphp
                <select class="form-control" name="{{ $userField }}">
                    <option value="0"> -- computer -- </option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected($user->id == (isset($training) ? $training->$userField : 0))>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        @endforeach

@if ($formAction)
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
@endif
    </div>

@if (!$formAction)
    </fieldset>
@endif
</form>
