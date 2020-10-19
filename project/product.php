<!DOCTYPE html>
<?php
require_once('../protected/config.php');

// Get product information from database
$product_table = "products";

$errorMsg = "";
$success = true;
$product_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
} else {
    $sql = "SELECT * FROM $product_table WHERE product_id = '$product_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_name = $row["product_name"];
        $product_desc = $row["product_desc"];
        $product_price = $row["product_price"];
        $img_count = $row["img_count"];
        $qnty_array = array("L" => $row["quantity_l"], "M" => $row["quantity_m"],
            "S" => $row["quantity_s"], "XS" => $row["quantity_xs"]);
    } else {
        $errorMsg = "No product with ID '$product_id' found in the databse.";

        $success = false;
    }
    $result->free_result();
    $conn->close();
}

// Add items to cart
if (filter_input(INPUT_POST, 'add_to_cart')) {
    $prod_size = filter_input(INPUT_GET, 'size');
    if (isset($_SESSION['shopping_cart'])) {
        $in_cart = false;
        $count = count($_SESSION['shopping_cart']);
        for ($i = 0; $i < $count; $i++) {
            if ($_SESSION['shopping_cart'][$i]['id'] == $product_id &&
                    $_SESSION['shopping_cart'][$i]['size'] == $prod_size) {
                if ($_SESSION['shopping_cart'][$i]['quantity'] < $qnty_array[$prod_size]) {
                    $_SESSION['shopping_cart'][$i]['quantity'] += 1;
                }
                $in_cart = true;
                break;
            }
        }
        if (!$in_cart) {
            $_SESSION['shopping_cart'][$count] = array(
                'id' => $product_id,
                'name' => $product_name,
                'size' => $prod_size,
                'price' => $product_price,
                'stock' => $qnty_array[$prod_size],
                'quantity' => 1
            );
        }
    } else {
        $_SESSION['shopping_cart'][0] = array(
            'id' => $product_id,
            'name' => $product_name,
            'size' => $prod_size,
            'price' => $product_price,
            'stock' => $qnty_array[$prod_size],
            'quantity' => 1
        );
    }
    header("Location: product.php?id=$product_id");
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

        <main class="container-fluid" id="mainContent">
            <section class="row product-info justify-content-md-center">
                <!--Display main product image-->
                <div class="col-lg-4 col-lg-offset-2 col-md-5 col-md-offset-1 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
                    <div class="tab-content product-img">
                        <?php
                        for ($i = 1; $i <= $img_count; $i++) {
                            echo "<div id=\"$i\"";
                            if ($i == 1) {
                                echo " class=\"tab-pane in active\">";
                            } else {
                                echo " class=\"tab-pane\">";
                            }
                            echo "<a href=\"#lightbox\" data-toggle=\"modal\" data-slide-to=\"" . ($i - 1) . "\">
                                    <img src=\"images/products/product-$product_id/$i.jpeg\" class=\"img-thumbnail\" "
                            . "alt=\"$product_name Sample Image\" title=\"View $product_name slideshow image\"></a></div>";
                        }
                        ?>
                    </div>
                    <!--Display light box slideshow-->
                    <div class="modal fade and carousel slide" id="lightbox">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <ol class="carousel-indicators">
                                        <?php
                                        for ($i = 0; $i < $img_count; $i++) {
                                            if ($i == 0) {
                                                echo "<li data-target=\"#lightbox\" data-slide-to=\"$i\" class=\"active\"></li>";
                                            } else {
                                                echo "<li data-target=\"#lightbox\" data-slide-to=\"$i\"></li>";
                                            }
                                        }
                                        ?>
                                    </ol>
                                    <div class="carousel-inner">
                                        <?php
                                        for ($i = 1; $i <= $img_count; $i++) {
                                            if ($i == 1) {
                                                echo "<div class=\"item active\">";
                                            } else {
                                                echo " <div class=\"item\">";
                                            }
                                            echo "<img src=\"images/products/product-$product_id/$i.jpeg\" alt=\"$product_name images slide $i\"></div>";
                                        }
                                        ?>   
                                    </div>
                                    <a class="left carousel-control" href="#lightbox" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left"></span>
                                    </a>
                                    <a class="right carousel-control" href="#lightbox" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  Display sample images (small) --> 
                    <div class="row">
                        <?php
                        for ($i = 1; $i <= $img_count; $i++) {
                            if ($i == 1) {
                                echo "<div class=\"col-md-2 col-md-offset-1 col-xs-2 col-xs-offset-1 padding-0\"><div class=\"small-img\">";
                            } else if ($i == 6) {
                                echo "<div class=\"col-md-2 col-xs-2 col-xs-offset-1 col-md-offset-1 padding-0\"><div class=\"small-img\">";
                            } else {
                                echo "<div class=\"col-md-2 col-xs-2 padding-0\"><div class=\"small-img\">";
                            }
                            echo "<a data-toggle=\"tab\" href=\"#$i\"><img src=\"images/products/product-$product_id/$i.jpeg\"
                                                        class=\"img-responsive grid-img\" alt=\"$product_name Sample Image (Small)\"></a></div></div>";
                        }
                        ?>
                    </div>
                </div>
                <!--  Modal for shipping information --> 
                <div class="col-lg-4 col-lg-offset-0 col-md-5 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
                    <h2 id="product-name"><?php echo $product_name ?></h2>
                    <p id="price"><?php echo "$" . $product_price ?></p>
                    <a href = "#" data-toggle="modal" data-target="#shipInfo">
                        <span class="glyphicon glyphicon-info-sign"></span> Shipping information</a>

                    <div id="shipInfo" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span class="close-btn">&times;</span></button>
                                    <h3 class="modal-title text-primary">Shipping Information</h3>
                                    <table class="table" id="ship-table">
                                        <tbody>
                                            <tr>
                                                <td>Local Delivery</td>
                                                <td>FREE</td>
                                            </tr>
                                            <tr>
                                                <td>Standard (3-7 business days)</td>
                                                <td>$2.99</td>
                                            </tr>
                                            <tr>
                                                <td>Expedited (2-5 business days)</td>
                                                <td>$5.99</td>
                                            </tr>
                                            <tr>
                                                <td>Priority (1-4 business days)</td>
                                                <td>$11.99</td>
                                            </tr>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--  Sizing table with buy button --> 
                    <table class="table" id="size-table">
                        <tbody>
                            <?php
                            foreach ($qnty_array as $size => $qnty) {
                                echo "<tr>";
                                echo "<td >Size ($size)</td>";
                                $outOfStock = false;
                                if (isset($_SESSION['shopping_cart'])) {
                                    $count = count($_SESSION['shopping_cart']);
                                    for ($i = 0; $i < $count; $i++) {
                                        if ($_SESSION['shopping_cart'][$i]['id'] == $product_id &&
                                                $_SESSION['shopping_cart'][$i]['size'] == $size) {
                                            if ($_SESSION['shopping_cart'][$i]['quantity'] >= $qnty) {
                                                $outOfStock = true;
                                                break;
                                            }
                                        }
                                    }
                                }

                                if ($qnty > 0 && !$outOfStock) {
                                    echo "<td class=\"text-center\">";
                                    echo "<form method=\"post\" action=\"product.php?id=$product_id&action=add&size=$size\">";
                                    echo "<button name=\"add_to_cart\" class=\"btn btn-danger btn-lg\" value=\"add_to_cart\">";
                                    echo "<span class=\"glyphicon glyphicon-shopping-cart cart-btn\"></span>Add to cart";
                                    echo "</button></form></td>";
                                } else {
                                    echo "<td class=\"text-center\"><span class=\"text-danger\">SOLD OUT</span></td>";
                                }
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <h4>PRODUCT DESCRIPTION </h4>
                    <?php echo $product_desc ?>

                </div>
            </section>
            <!--  Related products section --> 
            <section class="row related-products justify-content-md-center">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
                    <h3 id="related-title">People Who Viewed This Item Also Viewed</h3>
                    <div class="row">
                        <!--  Generate and display related products  --> 
                        <?php
                        for ($i = 1; $i <= 6; $i++) {
                            $related_id = $product_id + $i;
                            if ($related_id > 10) {
                                $related_id -= 10;
                            }
                            if ($related_id < 10) {
                                $related_id = "0" . $related_id;
                            }

                            $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                            $related_name = $related_price = "";

                            if ($conn->connect_error) {
                                $errorMsg = "Connection failed: " . $conn->connect_error;
                                $success = false;
                            } else {
                                $sql = "SELECT * FROM $product_table WHERE product_id = '$related_id'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $related_name = $row["product_name"];
                                    $related_price = "$" . $row["product_price"];
                                } else {
                                    $errorMsg = "No product with ID '$related_id' found in the databse.";
                                    $success = false;
                                }
                                $result->free_result();
                                $conn->close();
                            }                          
                            if ($i <= 3) {
                                echo "<div class=\"col-lg-2 col-md-2 col-sm-3 col-xs-4\">";
                            } else if ($i == 4) {
                                echo "<div class=\"col-lg-2 col-md-2 col-sm-3 hidden-xs\">";
                            } else {
                                echo "<div class=\"col-lg-2 col-md-2 hidden-sm hidden-xs\">";
                            }
                            echo "<a href=\"product.php?id=$related_id\" title=\"Visit $related_name product page\">";
                            echo "<img src=\"images/products/product-$related_id/1.jpeg\" "
                            . "alt=\"$related_name Image\" class=\"related-hover img-responsive related-img\">";
                            echo "<p class=\"related-desc\">$related_name <br>";
                            echo "<span class=\"related-price\">$related_price</span> </p> </a> </div> ";
                        }
                        ?>
                    </div>
                </div>
            </section>
            <!-- Back to store button --> 
            <div class="row justify-content-md-center">
                <P class="text-center"><a href="shop.php" class="btn return-btn btn-lg" role="button" title="Continue shopping">Return to Store</a></p>
            </div>
        </main>

        <!--  footer  --> 
        <?php
        include 'footer.inc.php';
        ?>
        <!--  footer end --> 
    </body>
</html>
