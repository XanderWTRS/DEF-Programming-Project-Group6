<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telaat | Admin</title>
    <link rel="icon" href="{{asset('Assets/Logo/logo.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/Admin/Bezetscherm.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
<header class="Adminheader"></header>
    <div id="search-container">
        <input type="text" id="search" placeholder="Zoek student">
    </div>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Student ID</th>
                <th>date</th>
                <th>Status</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($telaats as $telaat)
            <tr>
                <td>{{ $telaat->id }}</td>
                <td>{{ $telaat->name }}</td>
                <td>{{ $telaat->date }}</td>
                <td>te laat</td>
                <td> <button type="button">Ban</button> </td>
            </tr>
        @endforeach
</tbody>
    </table>
    @include('jsAdmin.Zoekbalk')
    @include('jsAdmin.Adminheader1')
</body>
</html>
