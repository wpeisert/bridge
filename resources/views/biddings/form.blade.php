<br />
<table>
    <tr>
        @foreach ($BIDS_SPECIAL as $bid)
            @if (in_array($bid, $possibleBids))
                <td>
                    @include ('biddings.bid', [
                            'bidding' => $bidding,
                            'bid' => $bid
                        ]
                    )
                </td>
            @endif
        @endforeach
    </tr>
</table>
<br />
<table>
    @for ($level = 1; $level <= $BIDS_MAX_LEVEL; ++$level)
        <tr>
            @foreach ($BIDS_COLORS as $bidColor)
                <td>
                    @php
                        $bid = $level . $bidColor;
                    @endphp
                    @if (in_array($bid, $possibleBids))
                        @include ('biddings.bid', [
                                'bidding' => $bidding,
                                'bid' => $bid
                            ]
                        )
                    @endif
                </td>
            @endforeach
        </tr>
    @endfor
</table>
