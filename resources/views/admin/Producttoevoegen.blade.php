<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Beheer | Admin</title>
  <link rel="icon" href="{{ asset('Assets/Logo/logo.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('css/admin/Producttoevoegen.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

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

  </div>
</div>
<nav class="zoek">
  <div id="search-container">
    <input type="text" id="search" placeholder="Zoek producten...">
    <img id="imgsearch" src="/ASSETS/Icons/ZoekIcon.svg" alt="Search Icon" width="20" height="15">
  </div>
  <button class="buttonToevoegen" onclick="window.location.href='{{asset('/Addproduct')}}'">Product toevoegen</button>
</nav>
<table>
  <thead>
    <tr>
      <th>Product ID</th>
      <th>Productnaam</th>
      <th>Beschrijving</th>
      <th>Category</th>
      <th>Merk</th>
      <th>Acties</th>
    </tr>
  </thead>
  <tbody>
    @foreach($products as $product)
      <tr>
        <td>{{$product->id}}</td>
        <td>{{$product->title}}</td>
        <td>{{$product->beschrijving}}</td>
        <td>{{$product->category}}</td>
        <td>{{$product->merk}}</td>
        <td id="buttonTD">
          <button class="buttonWijzig btn btn-primary" data-toggle="modal" data-target="#editModal" 
                  data-id="{{$product->id}}" data-title="{{$product->title}}"
                  data-beschrijving="{{$product->beschrijving}}" data-category="{{$product->category}}"
                  data-merk="{{$product->merk}}">Wijzig</button>

          <form action="{{ route('product.delete', ['id' => $product->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="buttonVerwijder">Verwijder</button>
          </form>
        </td>
      </tr>
    @endforeach
</tbody>
</table>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form id="editForm" action="{{ route('product.update') }}" method="POST">
                  @csrf
                  @method('PATCH')
                  <input type="hidden" id="itemId" name="id">
                  <div class="form-group">
                      <label for="itemTitle">Title</label>
                      <input type="text" class="form-control" id="itemTitle" name="title">
                  </div>
                  <div class="form-group">
                      <label for="itemBeschrijving">Beschrijving</label>
                      <input type="text" class="form-control" id="itemBeschrijving" name="beschrijving">
                  </div>
                  <div class="form-group">
                      <label for="itemCategory">Category</label>
                      <input type="text" class="form-control" id="itemCategory" name="category">
                  </div>
                  <div class="form-group">
                      <label for="itemMerk">Merk</label>
                      <input type="text" class="form-control" id="itemMerk" name="merk">
                  </div>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
          </div>
      </div>
  </div>
</div>



    @include('jsAdmin.Toevoegen')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

@include('jsAdmin.Adminheader1')
</html>