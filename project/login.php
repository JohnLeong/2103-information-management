<!DOCTYPE html>
<?php
require_once('../protected/config.php');
?>
<html lang="en">
    <head>
        <title>Creole | (Login)</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Creole | Bringing People Together Through Fashion">
        <meta name="keywords" content="Fasion, Clothes, Dress, Tops, Bottoms">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <script
            src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
        </script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="js/bootstrap.min.js">
        </script>
        <link rel="stylesheet" href="css/main.css"/>

    </head>

    <body>
        <?php
        include 'nav.inc.php';
        ?>
        <main>
            <br>
            <br>
            <div class="container-fluid">
                <h1>Member Login</h1>
                <hr class="us">
                <p>For new members, please click on Sign Up to create a new account!</p>
                <hr class="us">
                <form name="myLogin" id="myLogin" action="process_login.php" onsubmit="return myLogin()" method="post">
                    Email: <input type="email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}" class="form-control" name="email" id="email" placeholder="Enter Email" required aria-label="email login"><br>
                    <hr class="us">
                    Password: <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required aria-label="Enter password"><br>
                    <hr class="us">
                    <small>Lost your password? Click <a href="forgetpw.php">here</a></small><br>
                    <button type="submit" class="btn btn-default">Submit</button>
                    <a href="register.php" class="btn btn-default" role="button">Sign up</a>
                </form>

            </div>
        </main>
        <?php include "footer.inc.php" ?>
    </body>

</html>
