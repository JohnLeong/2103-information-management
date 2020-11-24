<?php
//session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">

    <head>
        <title>TUMMY FOR YUMMY</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/header_footer.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/admin_order.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    </head>

    <body>
        <main class="page-container">
            <?php
//            include 'adminHeader.inc.php';
            ?>

            
                <article>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 pen">
                                <div class="page-header">
                                    ALFRED
                                    <!--<h1>Hello <?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?> </h1>FROM DB -->
                                </div>
                            </div>
                        </div>
                        <section>
                            <div class="container-fluid">
                                <div class="center-block">
                                <h1>Admin Login</h1>
                                <hr class="us">
                                <form action="process_adminLogin.php" method="post">
                                    Email: <br/><input type="email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}" class="form-control" name="email" id="email" placeholder="Enter Email" required aria-label="email login"><br>
                                    <hr class="us">
                                    Password: <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required aria-label="Enter password"><br>
                                    <hr class="us">
                                    <button type="submit" class="btn btn-default">Submit</button>
                                </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </article>
            <?php
            include 'adminFooter.inc.php';
            ?>
        </main>
    </body>
</html>