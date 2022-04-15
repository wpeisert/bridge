<form action="{{ route('biddings.place-bid',$bidding->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input style="border: 1px solid black" name="bid" />
    <button type="submit" class="btn btn-primary">Place bid</button>
</form>
