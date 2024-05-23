<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bezetscherm | Admin</title>
    <link rel="icon" href="{{asset('Assets/Logo/logo.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/Admin/Bezetscherm.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <header class="Adminheader"></header>

    <input type="text" id="search-bar" placeholder="Zoek op naam of product...">
    

    <table>   
    <tbody>
        @forelse($products as $product)
        <tr>
            <td>{{ $product->title }}</td>
            <td><span class="status-icon"></span>{{ $product->status }}</td>
            <td>Matteo</td>
        </tr>
@endforeach

</tbody> 
 </table> 
    @include('jsAdmin.Chemark')
    @include('jsAdmin.Zoekbalk')
    @include('jsAdmin.Filterklaarzetten')
    @include('jsAdmin.Adminheader1')
</body>
</html>


    
    <!-- Bestaande tabel met producten 
    <table>
        <tr>
            <td>camera</td>
            <td><span class="status-icon"></span>Beschikbaar</td>
            <td>Matteo</td>
        </tr>
        <tr>
            <td>microfoon</td>
            <td><span class="status-icon"></span>Niet Beschikbaar</td>
            <td>Xander</td>
        </tr>
        <tr>
            <td>laptop</td>
            <td><span class="status-icon"></span>In onderhoud</td>
            <td>Mathis</td>
        </tr>
        <tr>
            <td>vr kit</td>
            <td><span class="status-icon"></span>Beschikbaar</td>
            <td>Lucas</td>
        </tr>
        <tr>
            <td>webcam</td>
            <td><span class="status-icon"></span>Niet Beschikbaar</td>
            <td>Jorn</td> 
        </tr>
    </table>
-->