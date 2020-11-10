<!DOCTYPE html>

<html>
    <head>
        <title>Creole | (Change Password)</title>
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
        require_once('../protected/config.php');
        include 'nav.inc.php';
        if (!isset($_SESSION['email'])) {
            header('Location: login.php');
        }
        ?>
        <br>
        <br>
        <div class="container-fluid">
            <h3>Change your new password!</h3>
            <hr class="us">
            <form name="newpw" id="newpw" onsubmit="return changepw()"  method="post"  action="process_changepw.php">
                <hr class="us">
                Password: <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control" name="password" id="password" placeholder="Enter Password"><br>
                <p>Password must contains 8 character, 1 upper-case, 1 lower-case and 1 digit.</p>
                <hr class="us">
                Confirm Password: <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control" name="cfmpassword" id="cfmpassword" placeholder="Confirm Password" ><br>
                <hr class="us">
                <button type="submit" class="btn btn-default">Submit</button>
                <hr class="us">
            </form>
        </div>
        <footer>
            <?php
            include "footer.inc.php";   
            ?>
        </footer>
    </body>
</html>
