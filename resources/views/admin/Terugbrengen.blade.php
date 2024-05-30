<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Terugbrengen | Admin</title>

    <link rel="icon" href="{{asset('Assets/Logo/logo.png')}}" type="image/png">

    <link rel="stylesheet" href="{{asset('css/admin/Terugbrengen.css')}}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">


</head>
<body>
    <header class="Adminheader"></header>

    <div class="fullwrapper">
        <div class="wrapper input_form">
            <form method="POST" action="{{ route('admin.terugbrengen.search.post') }}">
                @csrf
                <div id="search-container">
                    <input id="search-bar" type="text" name="search" placeholder="Geef het product id"><br>
                    <img id="search" src="/ASSETS/Icons/ZoekIcon.svg" alt="Search Icon" width="20" height="15">
                </div>

                <button type="submit">Search</button>
            </form>
        </div>
        <div class="reservationsdiplay">
            @isset($reservation)
                @if (!$reservation)
                    <p>No results found.</p>
                @else
                    <div class="main-container">
                        <h1>Reservation Details</h1>
                        <div class="small-container">
                            <p><b>ID:</b> {{ $reservation->id }}</p>
                            <p><b>Student:</b> {{ $reservation->name }}</p>
                            <p><b>Date:</b> {{ $reservation->date }}</p>
                                @if($reservation->confirmed == 1)
                                    <p>Dit item is opgehaald</p>
                                @else
                                    <p>Dit item is niet opgehaald</p>
                                @endif
                            <p>{{ $reservation->other_data }}</p>


                            @if($reservation->uitleendienstInventaris->isEmpty())
                                <p>No items found for this reservation.</p>
                             @else
                                @foreach($reservation->uitleendienstInventaris as $item)
                                    <p>{{ $item->merk }}, {{ $item->title }} - {{ $item->category }} - {{ $item->beschrijving }}</p>
                                @endforeach
                            @endif
                        </div>


                        <form method="POST" action="{{ route('admin.reservation.delete', $reservation->id) }}" onsubmit="return confirm('Are you sure you want to delete this reservation?');">
                            @csrf
                            @method('DELETE')
                            <button id="deleteButton" type="submit">Delete Reservation</button>
                        </form>
                        @if(session('success'))
                            <p style="color: green;">{{ session('success') }}</p>
                        @endif

                        @if(session('error'))
                            <p style="color: red;">{{ session('error') }}</p>
                        @endif
                    </div>
                @endif
            @endisset
        </div>
    </div>

</body>
    <script src="{{asset('admin/Terugbrengen.js')}}"></script>
    @include('jsAdmin.Adminheader1')
</html>
