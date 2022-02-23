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
                            <th>ID</th>
                            <th>NS vulnerable</th>
                            <th>WE vulnerable</th>
                            <th>Description</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($deals as $deal)
                            <tr>
                                <td>{{ $deal->id }}</td>
                                <td>{{ $deal->vulnerable_02 }}</td>
                                <td>{{ $deal->vulnerable_13 }}</td>
                                <td>{{ $deal->description }}</td>
                                <td>
                                    <form action="{{ route('deals.destroy',$deal->id) }}" method="POST">

                                        <a class="btn btn-info" href="{{ route('deals.show',$deal->id) }}">Show</a>

                                        <a class="btn btn-primary" href="{{ route('deals.edit',$deal->id) }}">Edit</a>

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    {!! $deals->links() !!}

</x-deals-layout>
