<form action="{{ route('biddings.place-bid',$bidding->id) }}" method="POST">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-primary">Place bid</button>
</form>
