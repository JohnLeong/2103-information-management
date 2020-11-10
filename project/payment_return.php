<!DOCTYPE html>
<!-- Update item quantity in db after payment success -->
<?php
require_once('../protected/config.php');
$product_table = "products";

$success_flag = filter_input(INPUT_GET, 'success', FILTER_SANITIZE_NUMBER_INT);

if ($success_flag) {
    $count = count($_SESSION['shopping_cart']);

    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

    if (!$conn->connect_error) {
        for ($i = 0; $i < $count; $i++) {
            $prod_id = $_SESSION['shopping_cart'][$i]['id'];
            $prod_size = strtolower($_SESSION['shopping_cart'][$i]['size']);
            $prod_qnty = $_SESSION['shopping_cart'][$i]['quantity'];
            $prod_stock = $_SESSION['shopping_cart'][$i]['stock'];
            $new_stock = $prod_stock-$prod_qnty;
            $sql = "UPDATE $product_table SET quantity_$prod_size = '$new_stock' WHERE product_id = '$prod_id'";
            $conn->query($sql);
        }
         $conn->close();
    }
    unset($_SESSION['shopping_cart']);
}
?>
<html lang="en">
    <head>
        <title>Creole</title>
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
    </head>
    <body>
        <!--navigation bar-->
        <?php
        include 'nav.inc.php';
        ?>
        <!--  navigation end  --> 
        <main>
            <article class="container">
                <?php if ($success_flag) { ?>
                <section class="sparce-page">
                    <header><h1>Thank you for shopping with us!</h1></header>
                    <p>Your order was successfully submitted.</p>
                    <p>We will process your order within 24 hours.</p>
                    <a href="shop.php" class="btn btn-default" title="Return to store" role="button">
                        <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping</a>
                </section>
                <?php } else { ?>
                <section class="sparce-page">
                    <header><h1>Something went wrong.</h1></header>
                    <p>Transaction failed or has been canceled, please try again.</p>
                    <p>If you continue to experience issues, please <a href="contact-us.php" title="Read more about our team">contact our team</a>.</p>
                    <a href="cart.php" class="btn btn-default" title="Back to Cart" role="button">
                        <span class="glyphicon glyphicon-shopping-cart"></span> Back to Cart</a>
                </section>
                <?php } ?>
            </article>
        </main>
        <!--  cart listing end  --> 

        <!--  footer  --> 
        <?php
        include 'footer.inc.php';
        ?>
        <!--  footer end  --> 
    </body>
</html>

        
            
