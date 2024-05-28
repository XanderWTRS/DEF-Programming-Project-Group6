<x-app-layout>
    <!--LAYOUT HOME PAGE -->
    <link rel="stylesheet" href="{{ asset('css/reservations.css') }}">
    <div class="main-container">
        <div class="container">
            <div class="section1">
                <h1 class="titles">{{ $product->merk }} {{ $product->title }}</h1>
                <img src="https://via.placeholder.com/500" alt="">
                <h1 class="titles">Product Informatie</h1>
                <p>
                    Ontdek de perfecte combinatie van functionaliteit en stijl met ons nieuwste product. Ontworpen met oog voor detail en gemaakt van hoogwaardige materialen, biedt dit product alles wat je nodig hebt voor een optimale ervaring. Of je het nu thuis, op kantoor of onderweg gebruikt, het voldoet aan al je verwachtingen en meer.
                    <br><br>
                    <b>Belangrijkste kenmerken:</b>
                    <br>
                    - Uitstekende kwaliteit: Gemaakt van duurzame materialen voor langdurig gebruik.<br>
                    - Elegant design: Modern en stijlvol ontwerp dat in elke omgeving past.<br>
                    - Gebruiksvriendelijk: Eenvoudig te installeren en te gebruiken, zelfs voor beginners.<br>
                    - Veelzijdig: Geschikt voor diverse toepassingen en situaties.<br>
                    - Betaalbaar: Uitstekende prijs-kwaliteitverhouding voor een product van deze klasse.<br>
                    </p><br><br>
            </div>
            <div class="section2">
                <div class="content">
                    <form action="/product/{{ $product->id }}" method="POST">
                        @csrf
                        <table class="reservationTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Week</th>
                                    <th>Status</th>
                                    <th>Datum</th>
                                    <th>Aantal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $currentWeek = \Carbon\Carbon::now()->weekOfYear;
                                    $reservationsCount = [];
                                    $avaible = 0;

                                    foreach ($reserveringen as $reservering) {
                                        $startOfWeek = \Carbon\Carbon::parse($reservering->date)->startOfWeek();
                                        $endOfWeek = $startOfWeek->copy()->addDays(5);
                                        $weekNumber = $startOfWeek->weekOfYear;
                                        if (isset($reservationsCount[$weekNumber])) {
                                            $reservationsCount[$weekNumber]++;
                                        }
                                        else {
                                            $reservationsCount[$weekNumber] = 1;
                                        }
                                    }

                                @endphp

                                @for ($week = $currentWeek + 1; $week <= $currentWeek + 2; $week++)
                                    @php
                                        $startOfWeek = \Carbon\Carbon::now()->startOfWeek()->addWeeks($week - $currentWeek);
                                        $endOfWeek = \Carbon\Carbon::now()->endOfWeek()->addWeeks($week - $currentWeek)->subDays(2);
                                        $weekNumber = $startOfWeek->weekOfYear;
                                        $reservationCount = $reservationsCount[$weekNumber] ?? 0;

                                    @endphp
                                    <tr>
                                        @if (($productidsCount - $reservationCount)  != 0)
                                            <td><input type="checkbox" class="weekCheckbox" name="selected_week" onchange="checkOnlyOne(this)" value="{{$startOfWeek->toDateString()}}"></td>
                                            @php
                                                $avaible++;
                                            @endphp
                                        @else
                                            <td></td>
                                        @endif
                                        <td>{{ $week }}</td>
                                        <td>
                                            <p class="{{ ($productidsCount - $reservationCount) > 0 ? 'groen' : 'rood' }}">
                                                {{ ($productidsCount - $reservationCount) > 0 ? 'vrij' : 'bezet' }}
                                            </p>
                                        </td>

                                        <td><p>{{ $startOfWeek->toDateString() }} tot {{ $endOfWeek->toDateString() }}</p></td>
                                        <td><p>aantal {{$productidsCount - $reservationCount }}</p></td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                        @if ($avaible > 0)
                            <input type="submit" id="submitButton" value="Reserveer" disabled>

                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="section3">
            <h1 class="titles">Gerelateerde Producten</h1>
            <div class="related-product">
                @foreach ($relatedproducts as $relatedproduct)
                    <a class="product" href="/product/{{ $relatedproduct->id }}">
                            <h1 id="product-title">{{ $relatedproduct->title }} {{ $relatedproduct->merk }}</h1>
                            <img src="https://via.placeholder.com/150" alt="Placeholder Image">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <!--LAYOUT FOOTER PAGE -->
    <x-slot name='footer'>
        <footer class="footer">
            <div id="left">
            <ul>
                <li>Erasmus Hogeschool Brussel</li>
                <li>Nijverheidskaai 170</li>
                <li>1070 Anderlecht</li>
                <li>02 559 15 00</li>
                <li>xander.wauters@student.ehb.be<li>
            </ul>
            </div>
            <div id="center-footer"><span class="link">&#169; Erasmus Hogeschool Brussel</span></div>
            <div id="right-footer"><a href="{{ route('g&v_voorwaarden') }}" class="link">Gebruiks- en Verlies overeenkomst</a></div>
        </footer>
        </footer>
    </x-slot>

</x-app-layout>



