<x-my-bidding-layout>

    <x-slot name="title">New training</x-slot>

    <form action="{{ route('mybidding.start') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            @foreach ($PLAYERS_NAMES as $playerName)
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Player {{ $playerName }}:</strong>
                        @php
                            $userField = 'user_id_' . $playerName;
                        @endphp
                        <select class="form-control" name="{{ $userField }}">
                            <option value="0"> -- computer -- </option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Deals count:</strong>
                    <input class="form-control" name="deals_count" value="10" />
                </div>
            </div>

        </div>

        @include ('deal_constraints.form_fields')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>

</x-my-bidding-layout>
