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
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="aboutus.html">WHO WE ARE<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="aboutus.php" title="Read more about us">ABOUT US</a></li>
                            <li><a href="members.php" title="Meet out members">OUR MEMBERS</a></li>
                        </ul>
                    <li><a href="contact-us.php" title="Send us a message">CONTACT US</a></li>
                    <li><a href="shop.php" title="Visit our shop">SHOP</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if (!isset($_SESSION['user_id'])) {
                        ?>
                        <li><a href="login.php" title="Login to an existing account"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    <?php } else { ?>
                        <li><a href="logout.php" title="Logout of your account"><span class="glyphicon glyphicon-log-in"></span>
                                Logout</a></li>
                        <li><a href="profile.php" title="Visit your profile page"><span class="glyphicon glyphicon-user"></span>
                                Profile</a></li>
                    <?php } ?>
                    <li><a href="cart.php" title="View your shopping cart"><span class="glyphicon glyphicon-shopping-cart"></span>Cart
                            <span class="badge badge-pill progress-bar-danger "><?php
                                if ($count > 0) {
                                    echo $count;
                                }
                                ?></span></a></li>

                </ul>

            </div>
        </div>
    </nav>

</header>