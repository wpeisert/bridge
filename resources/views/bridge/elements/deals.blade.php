<b>{{ __( $title ) }}</b> <br />
@foreach($currentDeals as $deals)
    {{ $deals['partner_name'] }}:
    @foreach($deals['deals'] as $deal)
        &nbsp;
        <a href="{{ route('deal', ['id' => $deal['id']]) }}">@if($deal['status'] === 'my_bid')<b>[@endif{{ $loop->iteration }}@if($deal['status'] === 'my_bid')]</b>@endif</a>
    @endforeach
    <br />
@endforeach
