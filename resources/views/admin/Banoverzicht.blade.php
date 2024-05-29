<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Banoverzicht | Admin</title>
    <link rel="icon" href="{{asset('Assets/Logo/logo.png')}}" type="image/png">

    <link rel="stylesheet" href="{{asset('css/index.css')}}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/admin/Banoverzicht.css')}}">
</head>
<body>
<header class="Adminheader"></header>
<div id="search-container">
    <input type="text" id="search" placeholder="Zoek student">
</div>
<table>
    <thead>
    
    <tbody>
    @foreach($bans as $ban)
<tr data-student-name="{{ $ban->name }}">
    <td>{{ $ban->name }}</td>
    <td>25/11/2024</td>
    <td>
    <button class="unban-btn" data-userid="{{ $ban->user_id }}">Unban</button>
    </td>
</tr>
@endforeach


</tbody>
</table>
@include('jsAdmin.ban')
@include('jsAdmin.Zoekbalk')
@include('jsAdmin.Adminheader1')
</body>
</html>