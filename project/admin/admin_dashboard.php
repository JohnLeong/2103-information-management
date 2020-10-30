<?php
session_start();
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
            include 'adminHeader.inc.php';
            ?>

            <?php if (isset($_SESSION['admin_id'])) { ?>
                <article>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 pen">
                                <div class="page-header">
                                    <h1>Hello <?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?> </h1><!--FROM DB -->
                                </div>
                            </div>
                        </div>
                        <section>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="card card-default">
                                        <div class="card-header">Account Profile</div>
                                        <div class="card-body">
                                            <p>Username:<?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></p> <!--FROM DB -->
                                            <p>Email: <?php echo $_SESSION['email']; ?></p><!--FROM DB -->
                                        </div>
                                        <div class="card-footer"><a href="../admin/admin_account.html">View More...</a></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="card card-default">
                                            <div class="card-header">Total Number of Orders and Reservations</div>
                                            <div class="panel-body">
                                                <p id="textHeadings" class="value"><?php echo $_SESSION['total'] ?> orders</p> <!--FROM DB -->
                                                <p class="description">
                                                </p>
                                                <div class="progress progress-sm mbn">
                                                    <div role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"
                                                         style="width: 60%;" class="progress-bar progress-bar-info">
                                                        <span class="sr-only">60% Complete (success)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-5">
                                    <p id="textHeadings">Total Number of Reservations</p>
                                    <div class="card card-default">
                                        <div class="card-header"><?php echo $_SESSION['reservations'] ?> Reservations</div> <!--FROM DB -->
                                        <div class="card-body">
                                            <p>Upcoming Reservation: <?php echo $_SESSION['upcomingReservation'] ?></p><!--FROM DB -->
                                            <p><a href="../admin/admin_reservation.php">More...</a></p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-5">

                                    <p id="textHeadings">Total Number of Catering Orders</p>
                                    <div class="card card-default">
                                        <div class="card-header"><?php echo $_SESSION['orders'] ?> Orders</div><!--FROM DB -->
                                        <div class="card-body">
                                            <p>Upcoming order: 09 December 2019</p><!--FROM DB -->
                                            <p><a href="../admin/admin_catering.php">More...</a></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </section>
                    </div>
                </article>
<?php } ?>
            <?php
            include 'adminFooter.inc.php';
            ?>
        </main>
    </body>
</html>