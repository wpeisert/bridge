<x-deal-constraints-layout>

    <x-slot name="subtitle">Create new deal constraints</x-slot>

    <form action="{{ route('deal_constraints.store') }}" method="POST">
        @csrf

        @include ('deal_constraints.form_fields')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>

</x-deal-constraints-layout>
