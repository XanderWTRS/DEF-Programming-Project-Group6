<x-app-layout>
    <!--LAYOUT HOME PAGE -->
    <h1>HOME</h1>

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
