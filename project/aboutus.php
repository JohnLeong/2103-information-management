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
                                The purpose of this website is to provide a convenient platform for parents with children to view information on the various childcare centres in Singapore and to help them understand the importance of an early childhood education. This platform gathers all the information required of the childcare centres, provided by the Early Childhood Development Agency, and displays them on the website for users to view.
                            </p>
                            <p class="aboutus">
                                Creole allow parents to estimate the cost and view the type of subsidies that they qualify for, along with other search filters that they can use, to specify requirements such as dietary options, incidental charges etc. This platform allows parents to make informed decisions in selecting a suitable childcare centre for their child.
                            </p>
                            <hr class="us">
                            <h2>Our Mission</h2>
                            <p class="aboutus">
                                To assist parents in making informed decisions when choosing a childcare centre for their children.
                            </p>
                            <hr class="us">
                            <hr>
                            <h2>Our Story</h2>
                            <p>
                                With a lack of platforms to view collated data on the available childcare centres in Singapore, Creole was setup by a group of software engineering students from the Singapore Institute of Technology
                                to provide parents with an easy and convenient way to find suitable childcare centres in Singapore.
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
