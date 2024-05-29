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
            <h1 class="title-gv">Gebruiks & Verlies overeenkomst</h1>
            <div id="container">
                <p<span class="bold">By borrowing an item, you agree to the following terms and conditions:</span></p>
                    <p>If the borrowed item is not returned or returned late, you will receive a warning. After
                        receiving 2 warnings, you will be blacklisted and no longer allowed to borrow items.</p>
                    <p><span class="bold">Additional terms and conditions:</span></p>
                    <ul id="ul-list">
                        <li class="li-list">The borrowed item must be used responsibly and returned in the same condition
                            as it was borrowed.</li>
                        <li class="li-list">Any damages or loss of the borrowed item will be your responsibility and may
                            result in additional charges.</li>
                        <li class="li-list">Only one item can be borrowed at a time.</li>
                        <li class="li-list">Extensions on the borrowing period may be granted on a case-by-case basis,
                            subject to availability.</li>
                        <li class="li-list">Items must be returned on time. Late returns may result in a warning or
                            blacklisting.</li>
                        <li class="li-list">By borrowing an item, you agree to the terms and conditions outlined above.
                        </li>
                    </ul>
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
