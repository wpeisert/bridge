<x-quizzes-layout>

    <x-slot name="subtitle">Edit quiz (ID: {{ $quiz->id }})</x-slot>

    <form action="{{ route('quizzes.update',$quiz->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input class="form-control" name="name" value="{{ $quiz->name }}" />
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea name="description" class="form-control" style="height:100px" placeholder="Description">{{ $quiz->description }}</textarea>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Deal constraints:</strong>
                    <select class="form-control" name="deal_constraint_id">
                        @foreach ($dealConstraints as $dealConstraint)
                            <option value="{{ $dealConstraint->id }}" @selected($dealConstraint->id == $quiz->deal_constraint_id)">
                                {{ $dealConstraint->SelectOptionText }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Deals count:</strong>
                    <input class="form-control" name="deals_count" value="{{ $quiz->deals_count }}" />
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
</x-quizzes-layout>
