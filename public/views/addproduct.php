<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/products.css">
    <link rel="stylesheet" type="text/css" href="public/css/addproduct.css">
    <script src="https://kit.fontawesome.com/2715bae171.js" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="public/script/navbar.js"></script>
    <title>Add Product</title>
</head>
<body>
    <div class="base-container">
        <button id="bt_nav" onclick="showhideNav()">></button>
        <nav id="navigation">
            <img src="public/img/logo.svg">
            <ul>
                <li><a href="products" class="button">products</a></li>
                <li><a href="favourites" class="button">favourites</a></li>
                <li><a href="addproduct" style="color: #fad765b2" class="button">add product</a></li>
            </ul>
            <div class="username">
                <a href="logout" class="sing-out"><i class="fas fa-sign-out-alt"></i></a>
                <p style="color:black;"><?php echo $_COOKIE['accept'];?></p>
            </div>
           
        </nav>
        <main>
             <form id="addform" class="addproduct" action="addproduct" method="POST" ENCTYPE="multipart/form-data">
                 <div class="messages">
                     <?php if(isset($messages)){
                         foreach ($messages as $message){
                             echo $message;
                         }
                     }
                     ?>
                 </div>
                <input id="name" name="name" type="text" placeholder="product name">
                <textarea id="desc" name="description" placeholder="Type something about it ..." form="addform"></textarea>
                <input class="bt" id="imgbt" type="file" name="file">
                <div class="horizontal">
                     <p>comments</p>
                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>
                </div>
                <input class="bt" id="add" value="ADD" type="submit">
              </form>
        </main>
        <div id="footer">
            <ul>
                <li><a href="products" class="button">products</a></li>
                <li><a href="favourites" class="button">favourites</a></li>
                <li><a href="addproduct" style="color: #fad765b2" class="button">add product</a></li>
            </ul>
        </div>
    </div>
    
</body>