<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/registration.css">
    <script src="https://kit.fontawesome.com/2715bae171.js" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="../script/navbar.js"></script>
    <title>Register</title>
</head>
<body>
    <div class="base-container">
        <main>
             <form id="signin" class="signin" action="registration" method="POST">
                 <input id="name" name="name" type="text" placeholder="name">
                 <input id="surname" name="surname" type="text" placeholder="surname">
                 <input id="mail" name="email" type="text" placeholder="e-mail address">
                 <input id="password" name="password" type="password" placeholder="password">
                 <input class="bt" id="add" value="sign-in" type="submit">
              </form>
        </main>
    </div>
</body>