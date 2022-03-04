<x-deal-constraints-layout>

                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-right">
                                <a class="btn btn-success" href="{{ route('deal_constraints.create') }}"> Add New Deal Constraints </a>
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
                            <th>Vulnerable</th>
                            <th>Dealer</th>
                            <th>PC - players</th>
                            <th>PC - pairs</th>
                            <th>Colors</th>
                            <th>Action</th>
                        </tr>
                        @each('deal_constraints.index_item', $dealConstraints, 'dealConstraint')

                    </table>

                    {!! $dealConstraints->links() !!}

</x-deal-constraints-layout>
