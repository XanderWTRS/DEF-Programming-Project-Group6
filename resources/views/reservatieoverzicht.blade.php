
<x-app-layout>
    <!--LAYOUT HOME PAGE -->
    <body>
        <main>
        @if($products->isEmpty())
            <p>No products found.</p>
        @else
            <div id="productenGrid">
                @php
                    $productCounts = [];
                    $uniqueProducts = [];
                @endphp
                @foreach ($products as $product)
                    @php
                        $productKey = $product->title . '-' . $product->category;
                        if (is_object($product) && property_exists($product, 'date')) {
                            $productKey .= '-' . $product->date;
                        }
                        if (!isset($productCounts[$productKey])) {
                            $productCounts[$productKey] = 1;
                            $uniqueProducts[$productKey] = $product;
                        } else {
                            $productCounts[$productKey]++; 
                        }
                    @endphp
                @endforeach

                @foreach ($uniqueProducts as $productKey => $product)
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
                                @if (is_object($productWeeks) && property_exists($productWeeks, $product->id))
                                    <p>Reserved Week: {{ $productWeeks[$product->id] }}</p>
                                @endif
                                @if ($productCounts[$productKey] > 1)
                                    <p>Count: {{ $productCounts[$productKey] }}</p>
                                @endif
                            </div>
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
