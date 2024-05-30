<x-app-layout>
    <!--LAYOUT PAGE -->
    <main>
            <button class="button" onclick="goBack()">
                <div class="button-box">
                  <span class="button-elem">
                    <svg viewBox="0 0 46 40" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"
                      ></path>
                    </svg>
                  </span>
                  <span class="button-elem">
                    <svg viewBox="0 0 46 40">
                      <path
                        d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"
                      ></path>
                    </svg>
                  </span>
                </div>
              </button>

              <div>
                <h1 class="title-gv">Gebruiks- & Verliesovereenkomst</h1>
                <div id="container">
                    <p><span class="bold">Door een item te lenen, gaat u akkoord met de volgende voorwaarden:</span></p>
                    <p>Als het geleende item niet wordt teruggebracht of te laat wordt teruggebracht, ontvangt u een waarschuwing. Na het ontvangen van 2 waarschuwingen, wordt u op de zwarte lijst geplaatst en mag u geen items meer lenen.</p>
                    <p><span class="bold">Aanvullende voorwaarden:</span></p>
                    <ul id="ul-list">
                        <li class="li-list">Het geleende item moet verantwoordelijk worden gebruikt en in dezelfde staat worden teruggebracht als waarin het werd geleend.</li>
                        <li class="li-list">Eventuele schade of verlies van het geleende item is uw verantwoordelijkheid en kan leiden tot extra kosten.</li>
                        <li class="li-list">Er kan slechts één item tegelijk worden geleend.</li>
                        <li class="li-list">Verlengingen van de leentermijn kunnen worden toegestaan op basis van beschikbaarheid en per geval.</li>
                        <li class="li-list">Items moeten op tijd worden teruggebracht. Te late teruggave kan leiden tot een waarschuwing of plaatsing op de zwarte lijst.</li>
                        <li class="li-list">Door een item te lenen, gaat u akkoord met de bovenstaande voorwaarden.</li>
                    </ul>
                </div>
            </div>

            <div></div>

    </main>

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
                <div id="right-footer"><span class="link">Gebruiks- en Verlies overeenkomst</span></div>
            </footer>
        </span>
    </x-slot>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</x-app-layout>
