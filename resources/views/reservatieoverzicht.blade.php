
<x-app-layout>
    <!--LAYOUT HOME PAGE -->
    <link rel="stylesheet" href="{{ asset('css/overzicht.css') }}">
    <body>
        <main>
                @if(empty($producten))
                <p>No products found.</p>
                @else
                    <div id="productenGrid">
                        @foreach ($producten as $product)
                            <a href="/product/{{ $product->id }}">
                                <div class="product">
                                    <div class="product-image">
                                        <h2>{{ $product->title }}</h2>
                                        <img src="https://via.placeholder.com/150" alt="Placeholder Image">
                                    </div>
                                    <div class="product-info">
                                        <p>Category: {{ $product->category }}</p>
                                        <p>Merk: {{ $product->merk }}</p>
                                        <p>Beschrijving: {{ $product->beschrijving }}</p>
                                        <p>datum: {{ $product->date}}</p>
                                        <p>count: {{ $product->count}}</p>
                                    </div>
                                    <form action="{{ route('delete', ['id' => $product->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <button type="submit" class="delete-button">Delete</button>
                                    </form>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
        <div class="bottom-right">
            <div class="gv">
                <input type="checkbox" id="g-v-overeenkomst" name="g-v-overeenkomst">
                <label for="g-v-overeenkomst">G & V overeenkomst</label>
            </div>
            <button type="button">Submit</button>
        </div>
        </main>
    </body>
    <!--LAYOUT FOOTER PAGE -->
    <x-slot name='footer'>
        <footer class="footer">
            <div id="left">
            <ul>
                <li>Erasmus Hogeschool Brussel</li>
                <li>Nijverheidskaai 170</li>
                <li>1070 Anderlecht</li>
                <li>02 559 15 00</li>
            </ul>
            </div>
            <div id="center-footer"><span class="link">&#169; Erasmus Hogeschool Brussel</span></div>
            <div id="right-footer"><a href="{{ route('g&v_voorwaarden') }}" class="link">Gebruiks- en Verlies overeenkomst</a></div>
        </footer>
        </footer>
    </x-slot>

</x-app-layout>
