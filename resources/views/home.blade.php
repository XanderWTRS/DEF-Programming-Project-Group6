<x-app-layout>
    <!--LAYOUT HOME PAGE -->
    <link rel="stylesheet" href="{{ asset('/css/home.css') }}">

        <div id="filter">
            <div id="filter1">
                <!-- search filter dat ook week en categorie door geeft-->
                <div class="search-container">
                    <form id="search-form" action="{{ route('home') }}" method="get">
                        <input class="search-input" type="search" name="query" id="query" value="{{ $searchQuery ?? '' }}" placeholder="Search...">
                        <button type="submit">
                            <img id="search" src="/ASSETS/Icons/ZoekIcon.svg" alt="Search Icon" width="20" height="15">
                        </button>
                        <input type="hidden" name="week" id="week" value="{{ $selectedWeek }}">
                        <input type="hidden" name="category" id="category" value="{{ $selectedCategory }}">
                    </form>
                </div>
                <!-- dropdown voor de verschillende weken-->
                <form action="{{ route('home') }}" method="get">
                    <div id="selectWeek">
                        <select id="weekSelect" name="week" onchange="this.form.submit()">
                            <?php
                            $currentDate = date('Y-m-d');
                            $monday = date('Y-m-d', strtotime('last monday', strtotime($currentDate)));
                            for ($i = 1; $i < 4; $i++) {
                                $weekStartDate = date('Y-m-d', strtotime($monday . ' + ' . ($i * 7) . ' days'));
                                $weekEndDate = date('Y-m-d', strtotime($weekStartDate . ' + 4 days'));
                                $selected = ($weekStartDate == $selectedWeek) ? 'selected' : '';
                                echo '<option value="' . $weekStartDate . '" ' . $selected . '>' . $weekStartDate . ' - ' . $weekEndDate . '</option>';
                            }
                            ?>
                        </select>
                        <input type="hidden" name="category" value="{{ $selectedCategory }}">
                    </div>
                </form>
            </div>
            <!-- navigatie voor de verschillende categorien-->
            <nav class="nav-bar">
                <ul class="nav-items">
                    <li class="nav-item"><a href="{{ route('home', ['category' => 'Video', 'week' => $selectedWeek, 'query' => $searchQuery]) }}">Video</a></li>
                    <li class="nav-item"><a href="{{ route('home', ['category' => 'Audio', 'week' => $selectedWeek, 'query' => $searchQuery]) }}">Audio</a></li>
                    <li class="nav-item"><a href="{{ route('home', ['category' => 'Belichting', 'week' => $selectedWeek, 'query' => $searchQuery]) }}">Belichting</a></li>
                    <li class="nav-item"><a href="{{ route('home', ['category' => 'XR', 'week' => $selectedWeek, 'query' => $searchQuery]) }}">XR</a></li>
                    <li class="nav-item"><a href="{{ route('home', ['category' => 'Kits', 'week' => $selectedWeek, 'query' => $searchQuery]) }}">Kits</a></li>
                    <li class="nav-item"><a href="{{ route('home', ['category' => 'Varia', 'week' => $selectedWeek, 'query' => $searchQuery]) }}">Varia</a></li>
                </ul>
            </nav>
        </div>

        @if($products->isEmpty())
            <p>No products found.</p>
        @else
        <!-- pweergave van producten -->
        <div id="productenGrid">
            @php
                $encounteredProducts = [];
            @endphp
            @foreach ($products as $product)
                @php
                    $productKey = $product->title . '_' . $product->category;
                @endphp
                @if (!isset($encounteredProducts[$product->title]) || !in_array($product->category, $encounteredProducts[$product->title]))
                    @php
                        $encounteredProducts[$product->title][] = $product->category;
                        $availability = true;
                        $reservation = DB::table('reservations')->where('id', $product->id)->where('date', '=', $selectedWeek)->first();
                        if ($reservation) {
                            $availability = false;
                        }
                    @endphp
                    <div class="product card" onclick="window.location.href='/product/{{ $product->id }}'">
                        <div id="product-head">
                            <h2>{{ $product->title }}</h2>
                            @if ($availability)
                            <?php
                            $productname = $product->title;
                            $productids = DB::table('uitleendienst_inventaris')->where('title', $productname)->pluck('id');
                            $productidsCount = $productids->count();
                            $reservationCount = 0;
                            foreach ($productids as $productId) {
                                $reservationCount += DB::table('reservations')->where('id', $productId)->where('date', $selectedWeek)->count();
                            }
                            $availableCount = max(0, $productidsCount - $reservationCount);
                            ?>
                            <div id="product-con">
                                @if($availableCount == 0)
                                    <img id="product-con-img" src="{{asset('Assets/Icons/red-circle.png')}}">
                                    <p id="product-count">{{ $availableCount }}</p>
                                @else
                                    <img id="product-con-img" src="{{asset('Assets/Icons/green-circle.png')}}">
                                    <p id="product-count">{{ $availableCount }}</p>
                                @endif
                            </div>
                        @endif
                        </div>
                        <img src="https://via.placeholder.com/150" alt="Placeholder Image">
                        <p class="product-desc">Category: {{ $product->category }}</p>
                        <p class="product-desc">Merk: {{ $product->merk }}</p>
                        <p class="product-desc">Beschrijving: {{ $product->beschrijving }}</p>
                    </div>
                @endif
            @endforeach
        </div>
        @endif
        <!-- pagination (filter worden meegegeven naar de volgende pagina) -->
        <div class="paginationStyle">
            {{ $products->appends(['week' => $selectedWeek, 'category' => $selectedCategory, 'query' => $searchQuery])->links('pagination::bootstrap-4') }}
        </div>

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
            <div id="center-footer"><a href="https://www.erasmushogeschool.be" class="link">&#169; Erasmushogeschool Brussel</a></div>
            <div id="right-footer"><a href="{{ route('g&v_voorwaarden') }}" class="link">Gebruiks- en Verlies overeenkomst</a></div>
        </footer>
        </footer>
    </x-slot>

</x-app-layout>
