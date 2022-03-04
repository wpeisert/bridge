<x-deal-constraints-layout>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <a class="btn btn-primary" href="javascript:history.back();"> Back</a>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('deal_constraints.index') }}"> Deals list</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ID:</strong>
                {{ $dealConstraint->id }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $dealConstraint->name }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $dealConstraint->description }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Vulnerable: </strong>
                {{ $DEAL_CONSTRAINTS_VULNERABLE[intval($dealConstraint->vulnerable)] }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Dealer: </strong>
                {{ $DEAL_CONSTRAINTS_DEALER[intval($dealConstraint->dealer)] }}
            </div>
        </div>

    </div>
</x-deal-constraints-layout>
