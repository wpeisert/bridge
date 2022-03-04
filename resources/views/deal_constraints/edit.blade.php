<x-deal-constraints-layout>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Deal Constraints</h2>
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

    <form action="{{ route('deal_constraints.update',$dealConstraint->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID: </strong>
                    {{ $dealConstraint->id }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input class="form-control" name="name" value="{{ $dealConstraint->name }}" />
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea name="description" class="form-control" style="height:100px" placeholder="Description">{{ $dealConstraint->description }}</textarea>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Vulnerable:</strong>
                    <select class="form-control" name="vulnerable">
                        @foreach ($DEAL_CONSTRAINTS_VULNERABLE as $value => $text)
                            <option value="{{ $value }}" @selected($value == $dealConstraint->vulnerable)>
                                {{ $text }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Dealer:</strong>
                    <select class="form-control" name="dealer">
                        @foreach ($DEAL_CONSTRAINTS_DEALER as $value => $text)
                            <option value="{{ $value }}" @selected($value == $dealConstraint->dealer)>
                                {{ $text }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
</x-deal-constraints-layout>
