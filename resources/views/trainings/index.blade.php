<x-trainings-layout>
    <x-slot name="subtitle"></x-slot>
    <x-slot name="backButtonRoute"></x-slot>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('trainings.create') }}"> Add New Training </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Quiz</th>
            <th>N</th>
            <th>E</th>
            <th>S</th>
            <th>W</th>
            <th>Action</th>
        </tr>
        @each('trainings.index_item', $trainings, 'training')

    </table>

    {!! $trainings->links() !!}

</x-trainings-layout>
