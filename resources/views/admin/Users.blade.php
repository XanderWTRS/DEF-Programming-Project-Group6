<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gebruikersoverzicht | Admin</title>
    <link rel="icon" href="{{asset('Assets/Logo/logo.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/Users.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/admin/Gebruikersoverzicht.css')}}">
</head>
<body>
<header class="Adminheader"></header>
<div class="page">
<div id="search-container">
    <input type="text" id="search" placeholder="Zoek gebruiker">
    <button id="goToOtherPage">Ga naar andere pagina</button>
</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Email</th>
            <th>Actie</th>
        </tr>
    </thead>
    <tbody id="user-table-body">
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <button class="ban-btn" data-userid="{{ $user->id }}">Ban</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@include('jsAdmin.ban')
@include('jsAdmin.Zoekbalk')
@include('jsAdmin.Adminheader1')
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#search').on('input', function() {
        var searchTerm = $(this).val().toLowerCase();
        $('#user-table-body tr').each(function() {
            var userName = $(this).find('td').eq(0).text().toLowerCase();
            var userEmail = $(this).find('td').eq(1).text().toLowerCase();
            if (userName.includes(searchTerm) || userEmail.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
    $('#goToOtherPage').click(function() {
        window.location.href = '/Telaat'; 
    });
    $('.ban-btn').click(function() {
        var userId = $(this).data('userid');
        var userName = $(this).closest('tr').find('td:eq(1)').text(); 

        $.ajax({
            url: '/banUser',
            type: 'POST',
            data: {
                user_id: userId,
                name: userName, 
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert('Gebruiker succesvol verbannen.');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Er is een fout opgetreden bij het verbannen van de gebruiker.');
            }
        });
    });
});

</script>

</html>
