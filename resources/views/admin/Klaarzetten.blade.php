<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klaarzetten | Admin</title>
    <link rel="icon" href="{{asset('Assets/Logo/logo.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/Admin/Klaarzetten.css')}}">
</head>
<body>
    <header class="Adminheader"></header>
    <div id="top-controls">
        <label for="week-select">Selecteer week:</label>
        <input type="week" id="week-select">
        <button id="filter-button">Filter</button>
        <input type="text" id="search" placeholder="Zoek student">
    </div>
    <table>
        <thead>
            <tr>
                <th>Student</th>
                <th>Producten</th>
                <th>Bevestiging</th>
            </tr>
        </thead>
        <tbody id="reservation-table-body">
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->name }}</td>
                    <td>{{ $reservation->product->title }}</td>
                    <td>{{ $reservation->date }}</td>
                    <td><input type="checkbox"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    @include('jsAdmin.Klaarzetten')
    @include('jsAdmin.Zoekbalk')
    @include('jsAdmin.Adminheader1')
</body>
</html>