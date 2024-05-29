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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" rel="stylesheet">
</head>
<body>
    <header class="Adminheader"></header>

    <div id="search-container">
        <input type="search" id="search-bar" placeholder="Zoek op naam of product..." name="query"  value="{{ $searchQuery ?? '' }}">
        <img id="search" src="/ASSETS/Icons/ZoekIcon.svg" alt="Search Icon" width="20" height="15">
    </div>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th id="status-header">Status</th>
                <th>Student</th>
            </tr>
        </thead>
        <tbody id="product-table-body">
            @forelse($products as $product)
                <tr class="{{ $product->status === 'Niet beschikbaar' ? 'not-available' : 'available' }}">
                    <td>{{ $product->title }}</td>
                    <td><span class="status-icon"></span>{{ $product->status }}</td>
                    <td>{{ $product->student_name ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Geen producten gevonden.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="paginationStyle">
        {{ $products->appends(['query' => $searchQuery])->links('pagination::bootstrap-4') }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const statusHeader = document.getElementById('status-header');
            let filterApplied = false;

            statusHeader.addEventListener('click', function () {
                const rows = document.querySelectorAll('#product-table-body tr');
                if (filterApplied) {
                    rows.forEach(row => {
                        row.style.display = '';
                    });
                    filterApplied = false;
                } else {
                    rows.forEach(row => {
                        if (row.classList.contains('available')) {
                            row.style.display = 'none';
                        }
                    });
                    filterApplied = true;
                }
            });
        });
    </script>

    @include('jsAdmin.Bezetscherm')
    @include('jsAdmin.Chemark')
    @include('jsAdmin.Zoekbalk')
    @include('jsAdmin.Filterklaarzetten')
    @include('jsAdmin.Adminheader1')
</body>
</html>
