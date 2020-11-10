<?php
$count = 0;
if (isset($_SESSION['shopping_cart'])) {
    $count = count($_SESSION['shopping_cart']);
}
?>
<header>
    <nav class = "navbar navbar-inverse navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                  
                </button>
                <a href="homepage.php" class="navbar-left" title="Visit our homepage"><img src="images/design/logo.png" id="nav-logo" alt=""></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="homepage.php" title="Visit the homepage">HOME</a></li>
                    <li><a href="contact-us.php" title="Send us a message">CONTACT US</a></li>
                    <li><a href="centres.php" title="Find Centres">CENTRES</a></li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="visualisation.php" title="Data Visualisation">VISUALISATION<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="visualisation.php" title="Statistics">SC/PR/OTHERS</a></li>
                            <li><a href="govt_subsidies_visualisation.php" title="Statistics">Government Subsidies</a></li>
                            <li><a href="amitpaul_visualisation.php" title="Statistics">Average Fees & Number of Centers based on Town</a></li>
                        </ul>
                </ul>
            </div>
        </div>
    </nav>

</header>