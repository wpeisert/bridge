<tr>
    <td>
        <b>ID: </b>{{ $deal->id }}<br />
        {{ $deal->description }}<br />
    </td>
    <td>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <x-deal>
                    <x-slot name="vulnerable">{{ $deal->vulnerable_human }}</x-slot>
                    <x-slot name="dealer">{{ $deal->dealer }}</x-slot>
                    <x-slot name="cards_N">
                        {!! $deal->getOneLineCards('N') !!}
                    </x-slot>
                    <x-slot name="cards_E">
                        {!! $deal->getOneLineCards('E') !!}
                    </x-slot>
                    <x-slot name="cards_S">
                        {!! $deal->getOneLineCards('S') !!}
                    </x-slot>
                    <x-slot name="cards_W">
                        {!! $deal->getOneLineCards('W') !!}
                    </x-slot>

                    <x-slot name="analysis">
                        {!! nl2br($deal->analysis) !!}
                    </x-slot>
                </x-deal>
            </div>
        </div>
    </td>
    <td>
        <form action="{{ route('deals.destroy',$deal->id) }}" method="POST">
            <a class="btn btn-info" href="{{ route('deals.show',$deal->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('deals.edit',$deal->id) }}">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>
