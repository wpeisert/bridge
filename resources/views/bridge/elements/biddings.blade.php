<b>{{ __( $title ) }}</b> <br />
@foreach($currentBiddings as $biddings)
    {{ $biddings['partner_name'] }}:
    @foreach($biddings['biddings'] as $bidding)
        &nbsp;
        <a href="{{ route('bidding', ['id' => $bidding['id']]) }}">@if($bidding['status'] === 'my_bid')<b>[@endif{{ $loop->iteration }}@if($bidding['status'] === 'my_bid')]</b>@endif</a>
    @endforeach
    <br />
@endforeach
