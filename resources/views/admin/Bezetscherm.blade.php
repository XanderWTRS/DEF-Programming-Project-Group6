    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bezetscherm | Admin</title>
        <link rel="icon" href="{{ asset('Assets/Logo/logo.png') }}" type="image/png">
        <link rel="stylesheet" href="{{ asset('css/Admin/Bezetscherm.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" rel="stylesheet">
    </head>
    <body>
        <header class="Adminheader"></header>
        <form id="search-container" action="{{ route('index') }}" method="get">
            <input class="search-input" type="search" name="query" id="query" value="{{ $searchQuery ?? '' }}" placeholder="Search...">
            <button type="submit" name="action" value="search">
                <img id="search" src="/ASSETS/Icons/ZoekIcon.svg" alt="Search Icon" width="20" height="15">
            </button>
        </form>
        
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th id="status-header">
                        <form action="{{ route('index') }}" method="get" id="status-form">
                            <input type="hidden" name="action" value="filter">
                            <input type="hidden" name="status_action" value="toggle">
                            <input type="hidden" name="query" value="{{ $searchQuery ?? '' }}">
                            <a href="#" onclick="document.getElementById('status-form').submit();">Status</a>
                        </form>
                    </th>
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
            {{ $products->appends(['query' => $searchQuery, 'action' => $action, 'isFiltering' => $isFiltering])->links('pagination::bootstrap-4') }}
        </div>

        @include('jsAdmin.Bezetscherm')
        @include('jsAdmin.Chemark')
        @include('jsAdmin.Zoekbalk')
        @include('jsAdmin.Filterklaarzetten')
        @include('jsAdmin.Adminheader1')
    </body>
    </html>
