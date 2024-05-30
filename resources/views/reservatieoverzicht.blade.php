<x-app-layout>
    <!--LAYOUT HOME PAGE -->
    <link rel="stylesheet" href="{{ asset('css/overzicht.css') }}">
    <body>
        <main>
                @if(empty($producten))
                <p>No products found.</p>
            @else
                <div id="productenGrid">
                    <!-- Loop door de products and toon ze met alle info (title, category, merk, beschrijving, date, enddate, count)-->
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
                                        <p>datum: {{ $product->date}} tot {{ $product->enddate}}</p>
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
                    <input type="checkbox" id="checkbox" data-route="{{ route('g&v_voorwaarden') }}">
                    <label for="g-v-overeenkomst">G & V overeenkomst</label>
                </div>
                <form action="{{ route('timestamp') }}" method="POST">
                    @csrf
                    <button type="submit" id="submit-button" onclick="confirmTimestamp()" disabled>Submit</button>
                </form>
            </div>
        </main>
    </body>
    <!-- JS code dat gaat kijken of checkbox is gechecked, g&v_overeenkomst toont en ook een alert toont bij het klikken van de submit knop-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var checkbox = document.getElementById('checkbox');
            var submitButton = document.getElementById('submit-button');

            checkbox.addEventListener('change', function() {
                submitButton.disabled = !this.checked;
            });

        });
        function confirmTimestamp() {
            var reservedItems = document.querySelectorAll('.product');
            var message = 'The following items will be reserved:\n';
            reservedItems.forEach(function(item) {
                var title = item.querySelector('h2').textContent;
                var date = item.querySelectorAll('p')[3].textContent;
                message += '- ' + title +  ' ('+date+')'+'\n';
            });
            alert(message);
        }
    </script>



    <!--LAYOUT FOOTER PAGE -->
    <x-slot name='footer'>
        <footer class="footer">
            <div id="left">
                <ul>
                    <li>Erasmushogeschool Brussel</li>
                    <li>Nijverheidskaai 170</li>
                    <li>1070 Anderlecht</li>
                    <li>02 559 15 00</li>
                <li>programmingprojectgroup6@gmail.com<li>
                </ul>
            </div>
            <div id="center-footer"><a href="https://www.erasmushogeschool.be" class="link" style="color: white;">&#169; Erasmushogeschool Brussel</a></div>
            <div id="right-footer"><a href="{{ route('g&v_voorwaarden') }}" class="link" style="color: white;">Gebruiks- en Verlies overeenkomst</a></div>
        </footer>
    </x-slot>
</x-app-layout>
