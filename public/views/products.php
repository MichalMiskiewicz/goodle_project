<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/products.css">
    <script src="https://kit.fontawesome.com/2715bae171.js" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="public/script/navbar.js"></script>
    <title>Products</title>
</head>
<body>
    <div class="base-container">
        <button id="bt_nav" onclick="showhideNav()">></button>
        <nav id="navigation">
            <img src="public/img/logo.svg">
            <ul>
                <li><a href="products" style="color: #fad765b2" class="button">products</a></li>
                <li><a href="favourites" class="button">favourites</a></li>
                <li><a href="addproduct" class="button">add product</a></li>
            </ul>
            <div class="username">
                <a href="#" class="sing-out"><i class="fas fa-sign-out-alt"></i></a>
                <p>username</p>
            </div>
        </nav>
        <main>
            <header>
                <img src="public/img/logo.svg">
                <div class="search-bar">
                    <form>
                        <input placeholder="search">
                    </form>
                </div>
            </header>
            <section class="products">
                <div id="product-1">
                    <img src="public/uploads/<?=$product->getImage() ?>">
                    <div>
                        <h2><?= $product->getTitle() ?></h2>
                        <p><?= $product->getDescription() ?></p>
                       <div class="social-section">
                            <i style="color: red" class="fas fa-heart">600</i>
                            <i style="color: lightseagreen" class="fas fa-minus-square">101</i>
                        </div>
                    </div>
                </div>
                <!--<div id="product-2">
                    <img src="public/img/upload/lab02.png">
                    <div>
                        <h2>Title</h2>
                        <p>Lorem Ipsum jest tekstem stosowanym jako przykładowy wypełniacz w przemyśle poligraficznym.</p>
                        <div class="social-section">
                            <i style="color: red" class="fas fa-heart">600</i>
                            <i style="color: lightseagreen" class="fas fa-minus-square">101</i>
                        </div>
                    </div>
                </div>
                <div id="product-3">
                    <img src="public/img/upload/lab02.png">
                    <div>
                        <h2>Title</h2>
                        <p>description</p>
                        <div class="social-section">
                            <i style="color: red" class="fas fa-heart">600</i>
                            <i style="color: lightseagreen" class="fas fa-minus-square">101</i>
                        </div>
                    </div>
                </div>
                <div id="product-4">
                    <img src="public/img/upload/lab02.png">
                    <div>
                        <h2>Title</h2>
                        <p>description</p>
                        <div class="social-section">
                            <i style="color: red" class="fas fa-heart">600</i>
                            <i style="color: lightseagreen" class="fas fa-minus-square">101</i>
                        </div>
                    </div>
                </div> -->
                
            </section>
        </main>
        <div id="footer">
            <ul>
                <li><a href="products" style="color: #fad765b2" class="button">products</a></li>
                <li><a href="favourites" class="button">favourites</a></li>
                <li><a href="addproduct" class="button">add product</a></li>
            </ul>
        </div>
    </div>
</body>