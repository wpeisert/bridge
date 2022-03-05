<x-deal-constraints-layout>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>View Deal Constraints</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('deal_constraints.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @include (
        'deal_constraints.form',
        [
            'dealConstraint' => $dealConstraint,
        ]
    )
</x-deal-constraints-layout>
