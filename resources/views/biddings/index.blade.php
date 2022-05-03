<x-biddings-layout>
    <x-slot name="subtitle"></x-slot>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Quiz</th>
            <th>Deal ID</th>
            <th>N</th>
            <th>E</th>
            <th>S</th>
            <th>W</th>
            <th style="width: 300px">Actions</th>
        </tr>
        @each('biddings.index_item', $biddings, 'bidding')

    </table>

    {!! $biddings->links() !!}

</x-biddings-layout>
