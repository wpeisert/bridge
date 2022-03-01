<x-quizes-layout>

                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-right">
                                <a class="btn btn-success" href="{{ route('quizes.create') }}"> Create New Quiz</a>
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
                            <th style="width: 300px">Actions</th>
                        </tr>
                        @each('quizes.index_item', $quizes, 'quiz')

                    </table>

                    {!! $quizes->links() !!}

</x-quizes-layout>
