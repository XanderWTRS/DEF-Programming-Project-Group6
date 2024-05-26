<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Terugbrengen | Admin</title>

    <link rel="icon" href="{{asset('Assets/Logo/logo.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">

    <link rel="stylesheet" href="{{asset('css/admin/Terugbrengen.css')}}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">


</head>
<body>
    <header class="Adminheader"></header>

    <div class="fullwrapper">
        <div class="wrapper input_form">
            <form method="POST" action="{{ route('admin.terugbrengen.search') }}">
                @csrf
                <input type="text" name="search" placeholder="Enter the product id"><br>
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="reservationsdiplay">
        @isset($reservation)
            @if (!$reservation)
            <p>No results found.</p>
            @else
                <h1>Reservation Details</h1>
                <p>ID: {{ $reservation->id }}</p>
                <p>Other Reservation Data: {{ $reservation->other_data }}</p>
        
                <h2>Uitleendienst Inventaris</h2>
                @if($reservation->uitleendienstInventaris->isEmpty())
                    <p>No items found for this reservation.</p>
                @else
                    <ul>
                        @foreach($reservation->uitleendienstInventaris as $item)
                            <li>{{ $item->merk }} {{ $item->title }} - {{ $item->category }} - {{ $item->beschrijving }}</li>
                        @endforeach
                    </ul>
                @endif
            @endif
        @endisset
        </div>
    </div>
    
</body>
    <script src="{{asset('js/Admin/Terugbrengen.js')}}"></script>
    @include('jsAdmin.Adminheader1')
</html>