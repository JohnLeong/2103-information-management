<!DOCTYPE html>
<?php
require_once('../protected/config.php');
?>

<html lang="en">
    <head>
        <title>Creole | (Home)</title>
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
        <main>
            <?php
            include 'nav.inc.php';
            ?>
            <!-- nav banner if possible -->
            <div class="container-fluid">
                <div class="row">
                    <div class="jumbotron banner">
                        <h1 class="text-center banner-text"> PROFILE </h1>
                    </div>
                </div>
            </div>
            <div>
            <!-- navbar end -->

            <!-- check if got session else go to homepage -->
            <?php
            if (!isset($_SESSION['user_id'])) {
                header('Location: homepage.php');
                exit();
            } else {
                ?>

                <div class="container-fluid">
                    <div class="col-sm-offset-2 col-sm-8 ">
                        <h1><strong>Profile</strong></h1>
                        <h2>Your account details are below</h2>
                        <hr class="us">
                        <h3>First Name:</h3>
                        <?php echo '<p>' . $_SESSION['fname'] . '</p>' ?>
                        <hr class="us">
                        <h3>Last Name:</h3>
                        <?php echo '<p>' . $_SESSION['lname'] . '</p>' ?>
                        <hr class="us">
                        <h3>Email:</h3>
                        <?php echo '<p>' . $_SESSION['email'] . '</p>' ?>
                        <hr class="us">
                        <a href="changepw.php" class="btn btn-default">Change Password</a>
                        <hr class="us">
                    </div>



                </div>


            <?php } ?>
            </div>
          
        </main>
          
                <?php include "footer.inc.php" ?>
  
    </body>

</html>
