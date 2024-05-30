
    function confirmDeletion() {
        return confirm('Are you sure you want to delete this reservation?');
    }

    /* list if we really need it
    <div class="items-list">
            <h2>List of Items in Reservations</h2>
            <ul>
                @foreach($items as $item)
                    @if($item->confirmed == 1)
                        <li>{{ $item->id }} - {{ $item->name }} - {{ $item->user_id }} - {{ $item->date }} - taken </li>
                    @else
                        <li>{{ $item->id }} - {{ $item->name }} - {{ $item->user_id }} - {{ $item->date }} - not taken </li>
                    @endif
                @endforeach
            </ul>
    </div> 
    */