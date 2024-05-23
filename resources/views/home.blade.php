<x-app-layout>
    <!--LAYOUT HOME PAGE -->
    <body>
    <main>
        <div id="filter">
            <div id="filter1">
                <div class="search-container">
                    <form id="search-form" action="" method="get">
                        <input type="search" name="query" id="query" placeholder="Search...">
                        <button type="submit">
                            <img id="search" src="/ASSETS/Icons/ZoekIcon.svg" alt="Search Icon" width="20" height="15">
                        </button>
                        <input type="hidden" name="week" id="week">
                        <input type="hidden" name="category" id="category">
                    </form>
                </div>
                <form action="" method="get">
                    <div id="selectWeek">
                        <select id="weekSelect" name="week" onchange="this.form.submit()">
                            <!-- Week options will go here -->
                        </select>
                        <input type="hidden" name="category">
                    </div>
                </form>
            </div>
            <nav>
                <ul>
                    <li><a href="#">Video</a></li>
                    <li><a href="#">Audio</a></li>
                    <li><a href="#">Belichting</a></li>
                    <li><a href="#">XR</a></li>
                    <li><a href="#">Kits</a></li>
                    <li><a href="#">Varia</a></li>
                </ul>
            </nav>
        </div>
        <div id="productenGrid">
            @foreach ($products as $product)
                <div class="product">
                    <h2>{{ $product->title }}</h2>
                    <img src="https://via.placeholder.com/150" alt="Placeholder Image">
                    <p>Category: {{ $product->category }}</p>
                    <p>Merk: {{ $product->merk }}</p>
                    <p>Beschrijving: {{ $product->beschrijving }}</p>
                </div>
            @endforeach
        </div>e
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
