<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('css/admin/Dashboard.css') }}">
    <link rel="icon" href="{{ asset('Assets/Logo/logo.png')}}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <title>Admin Dashboard</title>
</head>
<body>
    <main class="maincontainer">
        <img src="{{ asset('assets/logo/logo-trans.png') }}" alt="logo EhB">
        <div class="container">
            <a href="{{asset('/Klaarzetten')}}" class="Klaarzetten">Klaarzetten</a>
            <a href="{{asset('/terugbrengen')}}" class="QR-scanner">Terugbrengen</a>
            <a href="{{asset('/Bezetscherm')}}" class="Beschikbaarheid">Beschikbaarheid</a>
            <a href="{{asset('/Producttoevoegen')}}" class="Productbeheer">Productbeheer</a>
            <a href="{{asset('/Banoverzicht')}}" class="Blacklist">Blacklist</a>
        </div>
    </main>
</body>
</html>
