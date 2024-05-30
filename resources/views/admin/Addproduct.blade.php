<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Addproduct | Admin</title>

    <link rel="icon" href="{{asset('Assets/Logo/logo.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">

    <link rel="stylesheet" href="{{asset('css/admin/Addproduct.css')}}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

</head>
<body>
    <header class="Adminheader"></header>

    <h1>Voeg nieuw product toe</h1>
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.Addproduct.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="merk">Merk</label>
                <input type="text" name="merk" id="merk" class="form-control" value="{{ old('merk') }}">
                @error('merk')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="title">Titel</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="photo">Foto</label>
                <input type="file" name="photo" id="photo" class="form-control" value="{{ old('photo') }}">
                @error('photo')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category">Categorie</label>
                <input type="text" name="category" id="category" class="form-control" value="{{ old('category') }}">
                @error('category')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="beschrijving">Beschrijving</label>
                <textarea name="beschrijving" id="beschrijving" class="form-control">{{ old('beschrijving') }}</textarea>
                @error('beschrijving')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Product Toevoegen</button>
        </form>
    </div>

</body>
    @include('jsAdmin.Adminheader1')
</html>
