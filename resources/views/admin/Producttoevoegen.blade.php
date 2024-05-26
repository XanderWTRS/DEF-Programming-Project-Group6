<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Producttoevoegen | Admin</title>
  <link rel="icon" href="{{ asset('Assets/Logo/logo.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
  <link rel="stylesheet" href="{{ asset('css/Admin/Producttoevoegen.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
<header class="Adminheader"></header>

<div class="dropdown">
  <button class="dropbtn">Filter</button>
  <div class="dropdown-content">
  <a href="{{ route('filter.products', 'XR') }}">XR</a>
  <a href="{{ route('filter.products', 'Video') }}">Video</a>
  <a href="{{ route('filter.products', 'Varia') }}">Varia</a>
  <a href="{{ route('filter.products', 'Tools') }}">Tools</a>
  <a href="{{ route('filter.products', 'Belichting') }}">Belichting</a>
  <a href="{{ route('filter.products', 'Audio') }}">Audio</a>
    <!-- Voeg hier meer categorieën toe -->
  </div>
</div>
<nav class="zoek">
  <input type="text" id="search" placeholder="Zoek producten...">
  <button onclick="window.location.href='#nowhere'">Product toevoegen</button>
</nav>
<table>
  <thead>
    <tr>
      <th>Productnaam</th>
      <th>Acties</th>
    </tr>
  </thead>
  <tbody>
  @foreach($products as $product)
<tr>
  <td>{{ $product->title }}</td>
  <td>
    <form action="{{ route('product.delete', ['id' => $product->id]) }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit">Verwijder</button>
    </form>
    <button>Wijzig</button>
  </td>
</tr>
@endforeach
  </tbody>
</table>

<script src="../../SCRIPTS/Admin/toevoegen.js"></script>
</body>
@include('jsAdmin.Toevoegen')
@include('jsAdmin.Adminheader1')
</html>