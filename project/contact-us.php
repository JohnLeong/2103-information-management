<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <title>Creole | (Contact Us)</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Creole | Bringing People Together Through Fashion">
        <meta name="keywords" content="Fasion, Clothes, Dress, Tops, Bottoms">
        <link href="css/bootstrap.min.css" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="js/bootstrap.min.js?v3.4.1"></script> 
        <script src="js/contactUs.js"></script>
        <link href="css/webcss.css" rel="stylesheet"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <!--  navigation  --> 
        <?php
        require_once('../protected/config.php');
        include 'nav.inc.php';
        ?>
        <!--  navigation end  --> 
        <!-- banner section -->
        <div class="container-fluid">
            <div class="row">
                <div class="jumbotron banner">
                    <h1 class="text-center banner-text"> CONTACT US </h1>
                </div>
            </div>
        </div>
        <!-- banner section end -->
        <main>
            <!-- contact us -->
            <div id="locatetag" class="container-fluid">
                <div class="row">
                    <div class="col-md-5  col-md-offset-1">
                        <img id="building" src="images/contact-us/building.jpg" class="img-responsive" alt="company buliding"/>

                    </div>
                    <div id="address" class="col-md-5 "  >
                        <h1 id="locate" >Locate Us</h1>
                        <p class="wording" >
                            <a class="mail" title="View Map" href="https://www.google.com/maps/place/Singapore+Institute+of+Technology+(SIT@NYP)/@1.3775234,103.8466486,17z/data=!3m1!4b1!4m5!3m4!1s0x31da16e96db0a1ab:0x3d0be54fbbd6e1cd!8m2!3d1.3775234!4d103.8488373" target="_blank">
                                <span class="glyphicon glyphicon-map-marker"></span>
                                SIT@NYP<br>180 Ang Mo Kio Avenue 8 Singapore(676180)
                            </a>
                        </p>

                        <p class="wording">
                            <a href="tel:+6567892345" class="mail">
                                <span class="glyphicon glyphicon-earphone"></span>
                                67892345
                            </a>
                        </p>
                        <p class="wording">
                            <a class=" mail" title="E-mail" href="mailto:businesscreole.contact@gmail.com?Subject=ViaWebisteEmail" target="_top">
                                <span class="glyphicon glyphicon-envelope"></span>
                               businesscreole.contact@gmail.com
                            </a>
                        </p>
                    </div>
                    <div class="col-md-offset-1"></div>
                </div>
            </div>
            <div class="container-fluid" id="messageTag">
                <div class="row">
                    <div class="col-md-6 col-md-offset-1">
                        <h2> Message Us </h2>
                        <hr/>
                        <p  id="msgUsp" >
                            If you have any enquiry, feel free to contact our team for further assistance.
                            You may contact us via three ways: filling up the form, emailing us or contact us via our hotline.
                            Our team will get back to you as soon as possible. For urgent matters, please dial in via our hotline.
                        </p>
                    </div>

                    <div class="col-md-4">
                        <!-- Message Us Form -->
                        <form name="myForm" action="process_contactus.php" method="post" onsubmit="return validateForm()" novalidate >
                            <div class="form-group " >
                                <label for="InputEmail1">Email Address</label>
                                <input type="email" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" class="form-control" name="InputEmail" id="InputEmail1"  placeholder="Eg. xyz@gmail.com" required >

                            </div>
                            <div class="form-group ">
                                <label for="InputName">Name</label>
                                <input type="text" pattern="^[A-Za-z -]+$" class="form-control" name="InputName" id="InputName" placeholder="Enter Your Name" required>

                            </div>
                            <div class="form-group">
                                <label for="comment">Message:</label>
                                <textarea class="form-control" rows="3" name="comment" id="comment" required></textarea>

                            </div>
                            <button id="sbmBtn" type="submit" class="btn btn-success " name="contactSubmit" >Submit</button>
                            <button type="reset" class="btn btn-danger"> Clear </button>
                        </form>
                        <!-- Message Us Form End -->
                    </div>
                    <div class="col-md-offset-1"></div>
                </div>
            </div>
            <!-- contact us end -->
        </main>
        <!-- footer -->
        <?php
        include 'footer.inc.php';
        ?>
        <!-- footer end -->
    </body>

</html>
