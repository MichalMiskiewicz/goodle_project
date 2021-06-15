<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/products.css">
    <link rel="stylesheet" type="text/css" href="public/css/addproduct.css">
    <script src="https://kit.fontawesome.com/2715bae171.js" crossorigin="anonymous"></script>
    <script src="public/script/navbar.js"></script>
    <title>Add Product</title>
</head>
<body>
    <div class="base-container">
        <?php include('navigation.php') ?>
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
        <?php include('footer.php') ?>
    </div>
    
</body>