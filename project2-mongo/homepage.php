<!DOCTYPE html>
<?php
require_once('../protected/configmdb.php');
?>

<html lang="en">
    <head>
        <title>Creole(Home)</title>
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

            <!-- navigation -->
            <?php
            include 'nav.inc.php';
            ?>
            <!-- navigation end -->       

            <!-- Start Carousel --> 
            <div id="myCarousel" class="carousel slide">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>

                </ol>
                <!--End Indicators-->
                <!-- Wrapper for slides -->
                <div class="carousel-inner" id="carousel1" >
                    <div class="item active">
                        <img src="images/homepage/childcare.jpg" class='img-responsive' id="home1" alt="Christmas Sale">                  
                    </div>
                    <div class="item">
                        <img src="images/homepage/childcare2.jpg" class='img-responsive' id="home2" alt="Year End Sale">                  
                    </div>
                </div>
                <!-- End Slider Wrap-->
                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev" aria-label="Christmas Banner">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next" aria-label="Year End Banner">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
            <!-- End Carousel-->

            <!-- Introduction text-->
            <div class="container-fluid" id="intro">
                <div class="row">
                    <div class="col-xs-12 col-sm-12  col-md-6 text-center  justify-content-center" id="branding">
                        <img src="images/design/logo.png" alt="brand logo" >
                    </div>

                    <div class="col-xs-12 col-sm-12  col-md-6 " id="textbrand">
                        <h1>Creole</h1>
                        <hr>
                        <p>Child Care Analysis at it's finest</p>

                    </div>
                </div>
            </div>    
            <!--End introduction text-->   

           
            <!--Shop Now-->
            <div class="container-fluid" id="shopnow">
                <div class="col-xs-6 col-md-4 col-md-offset-2" id='season'>
                    <h2>Childcare Analyzation</h2>
                    <hr>
                    <p>Find childcare centers that fit your needs.</p>
                    <p>From locations right down to</p>
                    <p>food choices.</p>
                </div>
                <div class="col-xs-6  col-md-3 margin-top-bot">
                    <img  src="images/products/product-05/product.jpg" alt="Chania" class='img-responsive' />
                </div>
            </div>
            <!-- End Shop Now -->

            <!-- Start Quick Shop --> 
            <div class="container-fluid" id="quickshop">
                <div class="row" id="madeforyou">
                    <h2>Ease Of Use</h2>
                    <h3>Navigate Through Things That Might Interest You</h3>
                    <div class="container-fluid margin-top-bot" id="threebutton">
                        <div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-4 col-md-2 col-md-offset-3" id='menformal'>
                            <a href="centres.php" class="btn btn-danger btn-lg btn-block test"  role="button">Centers</a>
                        </div>
                        <div class="col-xs-6  col-xs-offset-3 col-sm-4 col-sm-offset-4  col-md-2 col-md-offset-0" id='womenformal'>
                            <a href="aboutus.php" class="btn btn-danger btn-lg btn-block test" role="button">Our Story</a>
                        </div>
                        <div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-4  col-md-2 col-md-offset-0" id='unisex'>
                            <a href="contact-us.php" class="btn btn-danger btn-lg btn-block test" role="button">Find Us</a>
                        </div> 

                        <div class="btn-toolbar" role="toolbar">

                        </div>

                    </div>    
                </div> 
            </div>
            <!-- End Quick Shop -->

         
            <!--Footer-->
<?php
include 'footer.inc.php';
?>
            <!--Footer end-->
                </main>
        </body>

</html>

