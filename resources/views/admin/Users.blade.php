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
<div id="container">
    <button class="button" onclick="goBack()">
        <div class="button-box">
          <span class="button-elem">
            <svg viewBox="0 0 46 40" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"
              ></path>
            </svg>
          </span>
          <span class="button-elem">
            <svg viewBox="0 0 46 40">
              <path
                d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"
              ></path>
            </svg>
          </span>
        </div>
    </button>
    <div id="search-container">
        <input type="text" id="search" placeholder="Zoek gebruiker">
        <img id="imgsearch" src="/ASSETS/Icons/ZoekIcon.svg" alt="Search Icon" width="20" height="15">
    </div>
    <div></div>
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

function goBack()
{
    window.history.back();
}

</script>

</html>
