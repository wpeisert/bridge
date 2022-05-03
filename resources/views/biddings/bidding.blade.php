<x-biddings-layout>
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
                @php
                    $youPlayer = false;
                @endphp
                @foreach($PLAYERS_NAMES as $playerName)
                    @php
                        $player = $bidding->training->getUser($playerName);
                        $fieldName = 'user_id_' . $playerName;
                        $you = Auth::user()->id === $bidding->training->$fieldName;
                        if ($you) {
                            $youPlayer = true;
                        }
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

                    @foreach ($PLAYERS_NAMES as $playerName)
                        @php
                            $slotName = 'cards_' . $playerName;
                            $fieldName = 'user_id_' . $playerName;
                            $you = Auth::user()->id === $bidding->training->$fieldName;
                            $isHuman = $bidding->training->$fieldName != 0;
                        @endphp

                        <x-slot :name="$slotName">
                            @if (!$youPlayer || $you || ($isHuman && $bidding->is_finished))
                                {!! $bidding->deal->getOneLineCards($playerName) !!}
                            @endif
                        </x-slot>

                    @endforeach


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
