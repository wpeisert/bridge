<x-deals-layout>

                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-right">
                                <a class="btn btn-success" href="{{ route('deals.create') }}"> Create New Deal</a>
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
                            <th>Data</th>
                            <th>Cards</th>
                            <th>Action</th>
                        </tr>
                        @each('deals.index_deal', $deals, 'deal')

                    </table>

                    {!! $deals->links() !!}

</x-deals-layout>
