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
        @php $uniqueUserIds = array(); @endphp
@foreach($telaats as $telaat)
    @if(!in_array($telaat->user_id, $uniqueUserIds))
        @php $uniqueUserIds[] = $telaat->user_id; @endphp
        <tr>
            <td>{{ $telaat->name }}</td>
            <td>{{ $telaat->user_id }}</td>
            <td>{{ $telaat->date }}</td>    
            <td>te laat</td>
            <td><button type="button" class="ban-btn" data-userid="{{ $telaat->user_id }}" data-username="{{ $telaat->name }}">Ban</button></td>
        </tr>
    @endif
@endforeach

</tbody>
    </table>
    @include('jsAdmin.Zoekbalk')
    @include('jsAdmin.Adminheader1')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        $('.ban-btn').click(function(){
            var userId = $(this).data('userid');
            var name = $(this).data('username');
            var token = '{{ csrf_token() }}';
            
            // Referentie naar de huidige rij
            var currentRow = $(this).closest('tr');

            // AJAX call om data naar de server te verzenden
            $.ajax({
                type: 'POST',
                url: '{{ route("ban") }}',
                data: {
                    user_id: userId,
                    name: name,
                    _token: token // Voeg de CSRF-token toe aan het verzoek
                },
                success: function(response){
                    // Handel het antwoord af
                    if(response.success){
                        alert('Gebruiker is verbannen.');
                        
                        // Verberg de rij nadat de gebruiker is verbannen
                        currentRow.hide(); // Verberg de huidige rij
                    } else {
                        alert('Er is een fout opgetreden bij het verbannen van de gebruiker.');
                    }
                },
                error: function(xhr, status, error){
                    console.error(xhr.responseText);
                    alert('Er is een fout opgetreden bij het verbannen van de gebruiker.');
                }
            });
        });
    });
</script>



</body>
</html>
