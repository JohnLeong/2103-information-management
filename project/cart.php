<!DOCTYPE html>
<?php
require_once('../protected/config.php'); 

$subtotal = $grandtotal = $count = 0;
if (isset($_SESSION['shopping_cart'])) {
    $count = count($_SESSION['shopping_cart']);
}

if (filter_input(INPUT_POST, 'change_qnty')) {
    $increment = filter_input(INPUT_GET, 'increment');
    $index = filter_input(INPUT_GET, 'index');
    if ($increment == 1) {
        if ($_SESSION['shopping_cart'][$index]['quantity'] < $_SESSION['shopping_cart'][$index]['stock']) {
             $_SESSION['shopping_cart'][$index]['quantity'] += 1;
        }
    }
    else if ($increment == 0) {
        if ($_SESSION['shopping_cart'][$index]['quantity'] > 1) {
            $_SESSION['shopping_cart'][$index]['quantity'] -= 1;
        }
        else {
            unset($_SESSION['shopping_cart'][$index]);
            $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
        }
    }
    header("Location: cart.php");
}


if (filter_input(INPUT_POST, 'remove_btn')) {
    $index = filter_input(INPUT_GET, 'index');
    unset($_SESSION['shopping_cart'][$index]);
    $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
    header("Location: cart.php");
}

?>
<html lang="en">
    <head>
        <title>Creole | (Cart)</title>
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
    </head>
    <body>

        <!--navigation bar-->
        <?php
        include 'nav.inc.php';
        ?>
        <!--  navigation end  --> 

        <!--  cart listing  --> 
        <main>
            <article class="container">
                <header>
                    <h1>Shopping Cart</h1>
                </header>
                
                <section class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-md-offset-0 col-lg-10 col-lg-offset-1">
                        <!--Display page when cart is empty --> 
                        <?php 
                        if (!isset($_SESSION['shopping_cart']) || count($_SESSION['shopping_cart']) == 0) {
                             echo "<div class=\"sparce-page\">";
                             echo "<h2>Cart is empty.</h2>";
                             echo "<a href=\"shop.php\" class=\"btn btn-default\" title=\"Return to the store\"role=\"button\">";
                             echo "<span class=\"glyphicon glyphicon-shopping-cart\"></span>Continue Shopping</a></div>";
                         }
                         else {
                        ?>
                        <!--  Table to show cart contents --> 
                        <div class ="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Total</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php 
                                    for ($i = 0; $i < $count; $i++) {
                                        $prod_id = $_SESSION['shopping_cart'][$i]['id'];
                                        $prod_name = $_SESSION['shopping_cart'][$i]['name'];
                                        $prod_size = $_SESSION['shopping_cart'][$i]['size'];
                                        $prod_qnty = $_SESSION['shopping_cart'][$i]['quantity'];
                                        $prod_stock = $_SESSION['shopping_cart'][$i]['stock'];
                                        $prod_price = $_SESSION['shopping_cart'][$i]['price'];
                                        $prod_total = $prod_price*$prod_qnty;
                                        $subtotal += $prod_total;
                                        $grandtotal = $subtotal * 1.07;
                                    ?>
                                    <tr>
                                        <td class="col-sm-8 col-md-6">
                                            <div class="media">
                                                <a class="thumbnail pull-left" href="product.php?id=<?php echo$prod_id?>"> 
                                                    <img class="media-object cart-img" title="<?php echo$prod_name?> Sample Image" src="images/products/product-<?php echo$prod_id?>/1.jpeg">
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading"><a href="product.php?id=<?php echo$prod_id?>" title="Visit <?php echo$prod_name?> page"><?php echo$prod_name?></a></h4>
                                                    <h5 class="media-heading"> Size <strong><?php echo$prod_size?></strong></h5>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-sm-1 col-md-2 text-center pagination-centered" style="text-align: center">
                                            <form class="inline-form" method="post" action="cart.php?action=update&increment=0&index=<?php echo$i?>">
                                                <button class="btn btn-sm qnty-btn text-center" name="change_qnty" value="change_qnty">&nbsp;-&nbsp;</button>
                                            </form>
                                            <span class="qnty-no"><strong><?php echo$prod_qnty?></strong></span>
                                            <form style=" margin:0px; padding:0px; display:inline;" method="post" action="cart.php?action=update&increment=1&index=<?php echo$i?>">
                                                <button class="btn btn-sm qnty-btn text-center" name="change_qnty" value="change_qnty"
                                                        <?php if($prod_qnty >= $prod_stock){echo "disabled";} ?>>+</button>
                                            </form>
                                        </td>
                                        <td class="col-sm-1 col-md-1 text-center" ><strong><?php echo"$".$prod_price?></strong></td>
                                        <td class="col-sm-1 col-md-1 text-center"><strong>
                                            <?php echo"$".number_format($prod_total,2)?></strong></td>
                                        <td class="col-sm-1 col-md-1 text-center">
                                            <form method="post" action="cart.php?action=delete&index=<?php echo$i?>">
                                                <button type="submit" class="btn btn-danger" name="remove_btn" value="remove_btn">
                                                <span class="glyphicon glyphicon-remove"></span> Remove
                                            </button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- End of for loop -->
                                    <?php } ?>

                                    <tr>
                                        <td>   </td>
                                        <td>   </td>
                                        <td>   </td>
                                        <td><h5>Subtotal (excl. GST)</h5></td>
                                        <td class="text-right"><h5><strong>
                                            <?php echo"$".number_format($subtotal,2)?> </strong></h5></td>
                                    </tr>
                                    <tr>
                                        <td>   </td>
                                        <td>   </td>
                                        <td>   </td>
                                        <td><h3>Total</h3></td>
                                        <td class="text-right"><h3><strong>
                                                <?php echo"$".number_format($grandtotal,2)?></strong></h3></td>
                                    </tr>
                                    <tr>
                                        <td>   </td>
                                        <td>   </td>
                                        <td>   </td>
                                        <td>
                                           <a href="shop.php" class="btn btn-default" role="button" title="Return to the store page">
                                           <span class="glyphicon glyphicon-shopping-cart"></span>Continue Shopping</a>
                                        </td>
                                        <!--  Form to send data to PayPal --> 
                                        <td>
                                            <form action="<?php echo PAYPAL_URL; ?>" method="post">
                                                <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">
                                                <input type="hidden" name="cmd" value="_cart">
                                                <input type="hidden" name="upload" value="1">
                                                <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
                                                <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
                                                <?php 
                                                for ($i = 0; $i < $count; $i++) {
                                                    $prod_name = $_SESSION['shopping_cart'][$i]['name'];
                                                    $prod_size = $_SESSION['shopping_cart'][$i]['size'];
                                                    $prod_qnty = $_SESSION['shopping_cart'][$i]['quantity'];
                                                    $prod_price = $_SESSION['shopping_cart'][$i]['price'];
                                                ?>
                                                <input type="hidden" name="item_name_<?php echo$i+1?>" value="<?php echo "$prod_name ($prod_size)"?>">
                                                <input type="hidden" name="quantity_<?php echo$i+1?>" value="<?php echo$prod_qnty?>">
                                                <input type="hidden" name="amount_<?php echo$i+1?>" value="<?php echo$prod_price?>">
                                                <?php } ?>
                                                <input type="hidden" name="item_name_<?php echo$count+1?>" 
                                                       value="Tax">
                                                <input type="hidden" name="quantity_<?php echo$count+1?>" 
                                                       value="1">
                                                <input type="hidden" name="amount_<?php echo$count+1?>" 
                                                       value="<?php echo$grandtotal-$subtotal?>">
                                                <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">
                                                <input type="image" name="submit" alt="Checkout with PayPal"
                                                       src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-medium.png">
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- End of if/else statement -->
                         <?php } ?>

                    </div>
                </section>
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
