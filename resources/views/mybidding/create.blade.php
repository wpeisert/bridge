<x-my-bidding-layout>

    <x-slot name="subtitle"></x-slot>
    <x-slot name="backButtonRoute">{{ 'dashboard' }}</x-slot>

    <form action="{{ route('mybidding.create') }}" method="POST">
        @csrf

        <div class="row">

            @foreach ($PLAYERS_NAMES as $playerName)
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ $playerName }}:</strong>
                        <input class="form-control" name="player_{{ $playerName }}" />
                    </div>
                </div>
            @endforeach

        </div>

    </form>

</x-my-bidding-layout>
