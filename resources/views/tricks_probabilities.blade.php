<table style="border: 1px solid silver">
    <tr style="border: 1px solid silver; vertical-align: top;">
        <td></td>
        @foreach ($PLAYERS_NAMES as $player)
        <td style="border: 1px solid silver; padding: 3px;"><b>{{ $player }}</b></td>
        @endforeach
    </tr>
    @foreach ($BIDS_COLORS as $bidColor)
        <tr style="border: 1px solid silver; vertical-align: top;">
            <td style="border: 1px solid silver; padding: 3px;"><b>{{ $bidColor }}</b></td>
            @foreach ($PLAYERS_NAMES as $player)
                <td style="border: 1px solid silver; font-size: small; padding: 3px;">
                    @for ($tricks = 0; $tricks <= $PLAYERS_CARDS_COUNT; ++$tricks)
                        @if (isset($probs[$player][$bidColor][$tricks]))
                            {{ $tricks }}: {{ $probs[$player][$bidColor][$tricks] * 100 }}% <br />
                        @endif
                    @endfor
                </td>
            @endforeach
        </tr>
    @endforeach
</table>
