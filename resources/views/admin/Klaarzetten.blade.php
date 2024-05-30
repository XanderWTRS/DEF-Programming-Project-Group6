<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klaarzetten | Admin</title>
    <link rel="icon" href="{{asset('Assets/Logo/logo.png')}}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/Admin/Klaarzetten.css')}}">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header class="Adminheader"></header>
    <div class="container">

        <div id="top-controls">
            <div class="calendar">
                <label for="week-select">Selecteer week:</label>
                <input type="week" id="week-select">
                <button id="filter-button">Filter</button>
            </div>
            <div class="searching">
                <div id="search-container">
                    <input type="text" id="search-bar" placeholder="Zoek op naam...">
                    <img id="search" src="/ASSETS/Icons/ZoekIcon.svg" alt="Search Icon" width="20" height="15">
                </div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Producten</th>
                    <th>ID</th>
                    <th>Bevestiging</th>
                    <th>Vergeten</th>
                </tr>
            </thead>
            <tbody id="reservation-table-body">
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->name }}</td>
                        <td>{{ $reservation->product->title }}</td>
                        <td>{{ $reservation->id }}</td>
                        <td><input class="bevestigen" type="checkbox" data-id="{{ $reservation->id }}"></td>
                        <td><input class="vergeten" type="checkbox"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('.bevestigen').on('click', function() {
                var reservationId = $(this).data('id');
                var isChecked = $(this).is(':checked'); // Check if the checkbox is checked
                var token = $('meta[name="csrf-token"]').attr('content');

                console.log('Reservation ID:', reservationId);
                console.log('Is Checked:', isChecked);
                console.log('CSRF Token:', token);

                // Send the appropriate value based on whether the checkbox is checked or unchecked
                var confirmedValue = isChecked ? 1 : 0;

                $.ajax({
                    url: '/Klaarzetten/' + reservationId + '/confirm',
                    type: 'POST',
                    data: {
                        _token: token,
                        confirmed: confirmedValue // Send the confirmed value
                    },
                    success: function(response) {
                        console.log('AJAX success response:', response);
                        if (response.success) {
                            alert('Reservation confirmed!');
                            // Optionally, update the UI to reflect the change
                        } else {
                            alert('Failed to confirm reservation.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX error:', status, error);
                        console.log('XHR:', xhr);
                        alert('Error confirming reservation.');
                    }
                });
            });
        });

    </script>

    @include('jsAdmin.Klaarzetten')
    @include('jsAdmin.Zoekbalk')
    @include('jsAdmin.Adminheader1')
</body>
</html>
