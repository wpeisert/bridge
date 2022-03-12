<x-quizzes-layout>
    <x-slot name="subtitle"></x-slot>
    <x-slot name="backButtonRoute"></x-slot>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('quizzes.create') }}"> Create New Quiz</a>
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
            <th>Name</th>
            <th>Description</th>
            <th>Deals cnt.</th>
            <th>Deals constraints</th>
            <th>Deals</th>
            <th style="width: 300px">Actions</th>
        </tr>
        @each('quizzes.index_item', $quizzes, 'quiz')

    </table>

    {!! $quizzes->links() !!}

</x-quizzes-layout>
