<script>
    const srcToCSS = `<link rel="stylesheet" href="{{asset('css/admin/Adminheader.css')}}">`;

function insertCSSToHead(code) {
    const headElements = document.getElementsByTagName('head');

    for (let i = 0; i < headElements.length; i++) {
        headElements[i].innerHTML += code;
    }
}

insertCSSToHead(srcToCSS);


const AdminHeader = document.querySelector('.Adminheader');

AdminHeader.innerHTML =
`
<nav class="navbar">
    <ul class="nav__links header__links">
        <li><a href="{{asset('/Klaarzetten')}}">Klaarzetten</a></li>
        <li><a href="{{asset('/terugbrengen')}}">Terugbrengen</a></li>
        <li><a href="{{asset('/Bezetscherm')}}">Beschikbaarheid</a></li>
        <li><a href="{{asset('/Producttoevoegen')}}">productbeheer</a></li>
        <li><a href="{{asset('/Banoverzicht')}}">blacklist</a></li>
    </ul>
    <img src="{{asset('Assets/Logo/horizontaal EhB-logo (transparante achtergrond).png')}}" alt="logoehb" class="logo">

    
</nav>

`;

</script>