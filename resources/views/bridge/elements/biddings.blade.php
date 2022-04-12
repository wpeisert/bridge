<b>{{ __( $title ) }} DEF</b> <br />
@foreach($biddingsByUser as $biddings)
    {{ $biddings['partner_name'] }}:
    @foreach($biddings['biddings'] as $bidding)
        &nbsp;
        <a href="{{ route('bidding', ['bidding' => $bidding['id']]) }}">@if($bidding['status'] === 'my_bid')<b>[@endif{{ $bidding['id'] }}@if($bidding['status'] === 'my_bid')]</b>@endif</a>
    @endforeach
    <br />
@endforeach
