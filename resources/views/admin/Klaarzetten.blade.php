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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/Admin/Klaarzetten.css')}}">
</head>
<body>
    <header class="Adminheader"></header>
<div id="top-controls">
    <label for="pickup-date">Datum van ophalen:</label>
    <input type="date" id="pickup-date">
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
    <tbody>
    <tr>
        <td>Matteo</td>
        <td>   <ul>
            <li>Camera</li>
            <li>Laptop</li>
            <li>Microfoon</li>
        </ul></td>
        <td><input type="checkbox"></td>
    </tr>
    <tr>
        <td>blue</td>
        <td>   <ul>
            <li>Camera</li>
            <li>Laptop</li>
            <li>Microfoon</li>
        </ul></td>
        <td><input type="checkbox"></td>
    </tr>
    <tr>
        <td>jordan</td>
        <td>   <ul>
            <li>Camera</li>
            <li>Laptop</li>
            <li>Microfoon</li>
        </ul></td>
        <td><input type="checkbox"></td>
    </tr>
    <tr>
        <td>jackson</td>
        <td>   <ul>
            <li>Camera</li>
            <li>Laptop</li>
            <li>Microfoon</li>
        </ul></td>
        <td><input type="checkbox"></td>
    </tr>
    <tr>
        <td>tab</td>
        <td>   <ul>
            <li>Camera</li>
            <li>Laptop</li>
            <li>Microfoon</li>
        </ul></td>
        <td><input type="checkbox"></td>
    </tr>
    <tr>
        <td>max</td>
        <td>   <ul>
            <li>Camera</li>
            <li>Laptop</li>
            <li>Microfoon</li>
        </ul></td>
        <td><input type="checkbox"></td>
    </tr>
    </tbody>
</table>

@include('jsAdmin.Klaarzetten.Klaarzetten')
@include('jsAdmin.Bezetscherm.Zoekbalk')
@include('jsAdmin.Adminheader1')
</body>
</html>