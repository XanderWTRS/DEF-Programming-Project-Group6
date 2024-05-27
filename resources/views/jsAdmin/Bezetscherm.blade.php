<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>

    <table>   
        <thead>
            <tr>
                <th>Product</th>
                <th>Status</th>
                <th>Student</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>{{ $product->title }}</td>
                <td><span class="status-icon"></span>{{ $product->status }}</td>
                <td>{{ $product->student_name ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody> 
    </table>
    <div>
        {{-- Laat de paginatie knoppen zien --}}
        {{ $products->links() }}

        {{-- Toon het nummer van de huidige pagina --}}
        <span>Pagina: {{ $products->currentPage() }}</span>
    </div>
</body>
</html>
