<table style="border: 1px solid silver; margin: 10px;">
    <tr>
        <td valign="top">
            <div style="margin-left: 5px;">
                {{ __('Dealer') }}: {{ $dealer }}<br />
                {{ __('Vuln') }}: {{ $vulnerable }}
            </div>
        </td>
        <td align="center" valign="bottom">
            <div style="text-align: left; margin-left: 20px;">{{ $cards_N }}</div>
        </td>
        <td> &nbsp; </td>
    </tr>
    <tr>
        <td align="center" valign="middle">
            <div style="text-align: left; margin-left: 20px">{{ $cards_W }}</div>
        </td>
        <td>
            <table class="table table-borderless" style="border: 0 solid;">
                <tr>
                    <td style="border: 0 solid;"></td>
                    <td style="border: 0 solid;"><strong>N</strong></td>
                    <td style="border: 0 solid;"></td>
                </tr>
                <tr>
                    <td style="border: 0 solid;"><strong>W</strong></td>
                    <td style="border: 0 solid;"></td>
                    <td style="border: 0 solid;"><strong>E</strong></td>
                </tr>
                <tr>
                    <td style="border: 0 solid;"></td>
                    <td style="border: 0 solid;"><strong>S</strong></td>
                    <td style="border: 0 solid;"></td>
                </tr>
            </table>
        </td>
        <td align="center" valign="middle">
            <div style="text-align: left; margin-left: 20px; margin-right: 20px;">{{ $cards_E }}</div>
        </td>
    </tr>
    <tr>
        <td> &nbsp; </td>
        <td align="center" valign="top">
            <div style="text-align: left; margin-left: 20px">{{ $cards_S }}</div>
        </td>
        <td> &nbsp; </td>
    </tr>
</table>

{{ $analysis ?? '' }}
