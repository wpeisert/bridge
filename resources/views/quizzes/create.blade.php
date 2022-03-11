<x-quizzes-layout>

    <x-slot name="subtitle">Create new quiz</x-slot>

    <form action="{{ route('quizzes.store') }}" method="POST">
        @csrf

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input class="form-control" name="name" />
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea name="description" class="form-control" style="height:100px" placeholder="Description"></textarea>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Deal constraints:</strong>
                    <select class="form-control" name="deal_constraint_id">
                        @foreach ($dealConstraints as $dealConstraint)
                            <option value="{{ $dealConstraint->id }}">
                                {{ $dealConstraint->select_option_text }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Deals count:</strong>
                    <input class="form-control" name="deals_count" value="10" />
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>

</x-quizzes-layout>


