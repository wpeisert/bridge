<form action="{{ route('biddings.place-bid',$bidding->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="bid" value="{{ $bid }}" />
    <button type="submit" class="btn btn-secondary">{!! \App\BridgeCore\Tools::decorateBid($bid) !!}</button>
</form>
