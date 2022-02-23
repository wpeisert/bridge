<x-deals-layout>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Deal</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('deals.index') }}"> Back</a>
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

    <form action="{{ route('deals.update',$deal->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID: </strong>
                    {{ $deal->id }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Start player:</strong>
                    <select class="form-control" name="start_player_no">
                        @foreach ($deal->getPlayersNames() as $no => $player)
                            <option value="{{ $no }}" @selected($no == $deal->start_player_no)>
                            {{ $player }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>NS vulnerable:</strong>
                    <input type="hidden" name="vulnerable_02" value="0" />
                    <input type="checkbox" class="form-control" name="vulnerable_02" @checked($deal->vulnerable_02) value="1" style="width: 15px"/>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>WE vulnerable:</strong>
                    <input type="hidden" name="vulnerable_13" value="0" />
                    <input type="checkbox" class="form-control" name="vulnerable_13" @checked($deal->vulnerable_13) value="1" style="width: 15px"/>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea name="description" class="form-control" style="height:100px" placeholder="Description">{{ $deal->description }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>N cards:</strong>
                    <input class="form-control" name="cards_0" value="{{ $deal->cards_0 }}" />
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>E cards:</strong>
                    <input class="form-control" name="cards_1" value="{{ $deal->cards_1 }}" />
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>S cards:</strong>
                    <input class="form-control" name="cards_2" value="{{ $deal->cards_2 }}" />
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>W cards:</strong>
                    <input class="form-control" name="cards_3" value="{{ $deal->cards_3 }}" />
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
</x-deals-layout>
