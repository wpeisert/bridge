<x-biddings-layout>
    <x-slot name="backButtonRoute">{{ 'biddings.index' }}</x-slot>
    <x-slot name="subtitle">{{ isset($edit) ? 'Edit' : 'Show' }} bidding (ID: {{ $bidding->id }})</x-slot>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{!! $message !!}</p>
        </div>
    @endif

    @if ($message = Session::get('danger'))
        <div class="alert alert-danger">
            <p>{!! $message !!}</p>
        </div>
    @endif

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                @foreach($PLAYERS_NAMES as $playerName)
                    @php
                        $player = $bidding->training->getUser($playerName);
                    @endphp
                    @if (isset($player))
                        {{ $playerName }}: {{ $player->name }} &nbsp;
                    @endif
                @endforeach
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <x-deal>
                    <x-slot name="vulnerable">{{ $bidding->deal->vulnerable_human }}</x-slot>
                    <x-slot name="dealer">{{ $bidding->deal->dealer }}</x-slot>
                    <x-slot name="cards_N">
                        {!! $bidding->deal->getOneLineCards('N') !!}
                    </x-slot>
                    <x-slot name="cards_E">
                        {!! $bidding->deal->getOneLineCards('E') !!}
                    </x-slot>
                    <x-slot name="cards_S">
                        {!! $bidding->deal->getOneLineCards('S') !!}
                    </x-slot>
                    <x-slot name="cards_W">
                        {!! $bidding->deal->getOneLineCards('W') !!}
                    </x-slot>
                </x-deal>
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            @php
                $shift = array_search($bidding->deal->dealer, $PLAYERS_NAMES);
            @endphp
            <table>
                <tr>
                    @foreach ($PLAYERS_NAMES as $playerName)
                        @php
                            $player = $bidding->training->getUser($playerName);
                        @endphp
                        <th>
                        @if (isset($player))
                            {{ $player->name }}
                        @endif
                        </th>
                    @endforeach
                </tr>
                <tr>
                    @foreach ($PLAYERS_NAMES as $playerName)
                        @php
                            $fieldName = 'user_id_' . $playerName;
                            $you = Auth::user()->id === $bidding->training->$fieldName;
                        @endphp

                        <th style="width: 80px; height: 30px; vertical-align: top;">{{ $playerName }} @if ($you)(You)@endif</th>
                    @endforeach
                </tr>
                <tr>
                    @for ($iter = 0; $iter < $shift; ++$iter)
                        <td> </td>
                    @endfor

                    @foreach ($bidding->bids as $bid)
                        <td>{!! $bid->bid_human !!}</td>
                        @if (($loop->index + $shift + 1) % $PLAYERS_COUNT === 0)
                </tr>
                <tr>
                        @endif
                    @endforeach
                    @if (!$bidding->is_finished)
                    <td> ? </td>
                    @endif
                </tr>
            </table>

            @if (!$bidding->is_finished && isset($edit))
                @include (
                    'biddings.form',
                    [
                        'bidding' => $bidding
                    ]
                )
            @endif

        </div>

    </div>
</x-biddings-layout>
