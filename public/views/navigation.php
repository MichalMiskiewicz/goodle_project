<button id="bt_nav" onclick="showhideNav()">></button>
<nav id="navigation">
    <img src="public/img/logo.svg">
    <ul>
        <li><a href="products" style="color: #fad765b2" class="button">products</a></li>
        <li><a id="fav" href="favourites" class="button">favourites</a></li>
        <li><a href="addproduct" class="button">add product</a></li>
    </ul>
    <div class="username">
        <a href="logout" class="sing-out"><i class="fas fa-sign-out-alt"></i></a>
        <p style="color:black;"><?php echo explode('@id', $_COOKIE['accept'])[0];?></p>
    </div>
</nav>