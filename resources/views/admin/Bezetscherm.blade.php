<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bezetscherm | Admin</title>
    <link rel="icon" href="{{asset('Assets/Logo/logo.png')}}" type="image/png">

    <link rel="stylesheet" href="{{asset('css/Admin/Bezetscherm.css')}}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <header class="Adminheader"></header>
    <form id="search container" action="{{ route('search')}}" method="get">
        <input class="search-input" type="search" name="query" id="query" value="{{ $searchQuery ?? '' }}" placeholder="Search...">
        <button type="submit">
            <img id="search" src="/ASSETS/Icons/ZoekIcon.svg" alt="Search Icon" width="20" height="15">
        </button>
    </form>
    <!--
    <div id="search-container">
        <input type="text" id="search-bar" placeholder="Zoek op naam of product...">
        <img id="search" src="/ASSETS/Icons/ZoekIcon.svg" alt="Search Icon" width="20" height="15">
    </div>-->

    <table>
    <thead>
            <tr>
                <th>Product</th>
                <th>Status</th>
                <th>Student</th>
            </tr>
        </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->title }}</td>
            <td><span class="status-icon"></span>{{ $product->status }}</td>
            <td>{{ $product->student_name ?? '-' }}</td>
        </tr>
@endforeach

</tbody>
 </table>


 {{-- Laat de paginatie knoppen zien --}}
 <div class="paginationStyle">
    {{ $products->appends(['query' => $searchQuery])->links('pagination::bootstrap-4') }}
</div>
    @include('jsAdmin.Bezetscherm')
    @include('jsAdmin.Chemark')
    @include('jsAdmin.Zoekbalk')
    @include('jsAdmin.Filterklaarzetten')
    @include('jsAdmin.Adminheader1')
</body>
</html>
