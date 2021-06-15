<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/products.css">
    <script src="https://kit.fontawesome.com/2715bae171.js" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="public/script/navbar.js" defer></script>
    <script type="text/javascript" src="public/script/search.js" defer></script>
    <script type="text/javascript" src="public/script/statistics.js" defer></script>
    <script type="text/javascript" src="public/script/delete.js" defer></script>
    <title>Products</title>
</head>
<body>
    <div class="base-container">
        <?php include('navigation.php'); ?>
        <main>
            <header>
                <img src="public/img/logo.svg">
                <div class="search-bar">
                    <input placeholder="search">
                </div>
            </header>
            <section class="products">
                <?php foreach ($products as $product){
                    echo '<div style="position: relative;" id="'.$product->getId().'">';
                    if(isset($_COOKIE['accept']) && explode('@id',
                            $_COOKIE['accept'])[1] == $product->getIdAssignedBy()){
                        echo '<button id="delete" style="height:1em; background-color: red; margin:0;"><a>X</a></button>';
                    }
                    echo '<img src="public/uploads/'.$product->getImage().'">
                    <div>
                        <h2>'.$product->getTitle().'</h2>
                        <p>'.$product->getDescription().'</p>
                       <div class="social-section">
                            <i style="color: red" class="fas fa-heart">'.$product->getLike().'</i>
                            <i style="color: lightseagreen" class="fas fa-minus-square">'.$product->getDislike().'</i>
                        </div>
                    </div>
                </div>';
                }; ?>
            </section>
        </main>
        <?php include('footer.php'); ?>
    </div>
</body>

<template id="product-template">
    <div id="product-1"><img src="">
        <div>
            <h2>title</h2>
            <p>description</p>
            <div class="social-section">
                <i style="color: red" class="fas fa-heart">600</i>
                <i style="color: lightseagreen" class="fas fa-minus-square">101</i>
            </div>
        </div>
    </div>
</template>