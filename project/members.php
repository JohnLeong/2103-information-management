<!DOCTYPE html>
<?php
require_once('../protected/config.php');
?>
<html lang="en">
    <head>
        <title>Creole | (Members)</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Creole | Bringing People Together Through Fashion">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <script
            src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
        </script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="js/bootstrap.min.js">
        </script>
        <link href="css/members.css" rel="stylesheet">
    </head>

    <body>
        <!--navigation -->
        <?php
        include 'nav.inc.php';
        ?>
        <!--navigation end -->

        <!-- banner start -->
        <div class="container-fluid">
            <div class="row">
                <div class="jumbotron banner">
                    <p class="text-center banner-text"> MEMBERS </p>
                </div>
            </div>
        </div>
        <!-- banner end -->
        <main>
        <!-- team section -->
        <article id="team">
            <div class="container section-teamprofile-start">
                <div class="row">
                    <div class="col-md-12 section1 teamprofile-hedding text-center">
                        <h1>Meet Our Team</h1>
                    </div>
                </div>
                <div class="col-sm-offset-2 col-sm-8 col-sm-offset-2"> <!-- start of profile1 -->
                    <div class="row section-danger teamprofile text-center">
                        <div class="col-md-12 section1">
                            <img src="images/about-us/jun.jpg" alt="jack">
                        </div>
                        <div class="col-md-12 section2"> <!-- Team Profile -->
                            <p>Jack</p><br>
                            <h2>Owner</h2><br>
                        </div>
                        <div class="col-md-12 section3">
<!--                                    <p class="profiling">Founder and current owner of Creole.</p>-->
                        </div>
                        <div class="col-md-12 section4"> <!--Social media glyphs -->
                            <!-- <a href="#" class="fa fa-facebook"></a>
                             <a href="#" class="fa fa-instagram"></a>
                             <a href="#" class="fa fa-twitter"></a> -->
                        </div>
                    </div>
                </div> <!-- end of profile -->

                <div class="col-sm-offset-2 col-sm-8 col-sm-offset-2"> <!-- start of profile1 -->
                    <div class="row section-danger teamprofile text-center">
                        <div class="col-md-12 section1">
                            <img src="images/about-us/jl.jpg" alt="jl">
                        </div>
                        <div class="col-md-12 section2"> <!-- Team Profile -->
                            <p>Jia Lin</p><br>
                            <h2>Co-Founder</h2><br>
                        </div>
                        <div class="col-md-12 section3">
<!--                                    <p>Co-founded Creole with Jack</p>-->
                        </div>
                        <div class="col-md-12 section4"> <!--Social media glyphs -->
                            <!--                                   <a href="#" class="fa fa-facebook"></a>
                                                                <a href="#" class="fa fa-instagram"></a>
                                                                <a href="#" class="fa fa-twitter"></a> -->
                        </div>
                    </div>
                </div> <!-- end of profile -->

                <div class="col-sm-offset-2 col-sm-8 col-sm-offset-2"> <!-- start of profile1 -->
                    <div class="row section-danger teamprofile text-center">
                        <div class="col-md-12 section1">
                            <img src="images/about-us/rey.jpg" alt="rey">
                        </div>
                        <div class="col-md-12 section2"> <!-- Team Profile -->
                            <p>Reynard</p><br>
                            <h2>Marketing Director</h2><br>
                        </div>
                        <div class="col-md-12 section3">
<!--                                    <p>Leads the marketing effort for Creole and builds the brand image.</p>-->
                        </div>
                        <div class="col-md-12 section4"> <!--Social media glyphs -->
                            <!-- <a href="#" class="fa fa-facebook"></a>
                             <a href="#" class="fa fa-instagram"></a>
                             <a href="#" class="fa fa-twitter"></a> -->
                        </div>
                    </div>
                </div> <!-- end of profile -->

                <div class="col-sm-offset-2 col-sm-8 col-sm-offset-2"> <!-- start of profile1 -->
                    <div class="row section-danger teamprofile text-center">
                        <div class="col-md-12 section1">
                            <img src="images/about-us/mirzaa.jpg" alt="mirza">
                        </div>
                        <div class="col-md-12 section2"> <!-- Team Profile -->
                            <p>Mirza</p><br>
                            <h2>Financial Manager</h2><br>
                        </div>
                        <div class="col-md-12 section3">
<!--                                    <p>For any personal enquiries, you can reach me from here.</p>-->
                        </div>
                        <div class="col-md-12 section4"> <!--Social media glyphs -->
                            <!-- <a href="#" class="fa fa-facebook"></a>
                             <a href="#" class="fa fa-instagram"></a> -->
                            <a href="https://twitter.com/m1rzyq" class="fa fa-twitter" aria-label="Go to mirza twitter"></a>
                        </div>
                    </div>
                </div> <!-- end of profile -->

                <div class="col-sm-offset-2 col-sm-8 col-sm-offset-2"> <!-- start of profile1 -->
                    <div class="row section-danger teamprofile text-center">
                        <div class="col-md-12 section1">
                            <img src="images/about-us/weiheng.jpg" alt="weiheng">
                        </div>
                        <div class="col-md-12 section2"> <!-- Team Profile -->
                            <p>Wei Heng</p><br>
                            <h2>Product Designer</h2><br>
                        </div>
                        <div class="col-md-12 section3">
<!--                                    <p>For any personal enquiries, you can reach me from here.</p>-->
                        </div>
                        <div class="col-md-12 section4"> <!--Social media glyphs -->
                            <!-- <a href="#" class="fa fa-facebook"></a>
                             <a href="#" class="fa fa-instagram"></a>
                             <a href="#" class="fa fa-twitter"></a> -->
                        </div>
                    </div>
                </div> <!-- end of profile -->


            </div>
        </article>
        </main>
        <!-- team end -->

        <!-- footer -->
        <?php
        include 'footer.inc.php';
        ?>
        <!-- footer end -->
    </body>
</html>
