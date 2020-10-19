<!DOCTYPE html>
<?php
require_once('../protected/config.php');
?>
<html  lang="en">
    <head>
        <title>Creole | (About Us)</title>
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
        <!--navigation bar-->
        <?php
        include 'nav.inc.php';
        ?>
        <!--  navigation end  --> 

        <!-- banner section -->
        <div class="container-fluid">
            <div class="row">
                <div class="jumbotron banner">
                    <h1 class="text-center banner-text"> ABOUT US </h1>
                </div>
            </div>
        </div>
        <!-- banner end -->
        <main>
            <!-- about us section -->

            <div class="container-fluid aboutus">

                <div class="col-sm-offset-3 col-sm-6 col-sm-offset-3">
                    <section id="aboutussection">
                        <h2><strong>Creole</strong></h2>
                        <hr class="us">
                        <article class='aboutuscontainer' id="aboutusarticle">
                            <h2>About Us</h2>
                            <p class="aboutus">
                                At Creole, we are set to revolutionize simple daily fashion which mixes both Asian and Western style in our clothing.
                                With our online shopping services, we guarantee that you will have an enjoyable, comfortable and secure experience. With an extensive
                                catalog and seasonal release, be assured that our clothing is always up to date and trendy. With Creole, we offer
                                you the most affordable and quality clothing direct from out facility. Shop with Creole, Shop with us. 
                            </p>
                            <hr class="us">
                            <h2>Our Mission</h2>
                            <p class="aboutus">
                                To provide affordable and quality fusion fashion.
                            </p>
                            <hr class="us">
                            <h2>Our Vision</h2>
                            <p class="aboutus">
                                At Creole we believe that through our

                                culturally inspired fashion, we can

                                unite the world through bringing

                                awareness of the diverse cultures that exists.
                            </p>
                            <hr>
                            <h2>Our Story</h2>
                            <p>
                                With a lack of simplistic yet culturally intriguing kind of fashion in the scene. Creole was setup to introduce to the
                                community, fashion that is aimed to bring awareness of diverse culture and unite the community through our brand of clothing.
                            </p>
                        </article>
                    </section>
                </div>
            </div>

        </main>
        <!-- aboutus end -->

        <!--  footer  --> 
        <?php
        include 'footer.inc.php';
        ?>
        <!--  footer end --> 
    </body>

</html>
