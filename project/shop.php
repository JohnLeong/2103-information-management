<!DOCTYPE html>
<!-- Database connection-->
<?php
require_once('../protected/config.php');
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
}
?>
<html lang="en">

    <head>
        <title>Creole | (Shop)</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Creole | Bringing People Together Through Fashion">
        <meta name="keywords" content="Fasion, Clothes, Dress, Tops, Bottoms">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/shopfilter.css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script src="js/shopfilter.js"></script> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/shopfilter.css" />
    </head>
    <body> 
    <main>
    
        <!-- Navigation  -->
        <?php
        include 'nav.inc.php';
        ?>
        <!--Navigation End  -->

        <!-- Banner Section  -->
        <div class="container-fluid">
            <div class="row">
                <div class="jumbotron banner">
                    <h1 class="text-center banner-text"> SHOP </h1>
                </div>
            </div>
        </div>
        
        <!-- Banner Section End  -->


        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12  ">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-2  text-center">

                    </div> 
                    <div class="col-md-6">
                        <h1 id="product_title" class="text-left">
                            Our Product
                        </h1>

                        <hr />
                    </div>
                    

                    <div class="col-md-1">
                    </div>

                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class=" col-md-12  text-center">
                    <div class="col-md-1">
                    </div>
                    
                    
                    <div class="col-md-2 " id="product_filter">
                        <form method="post">
                        <header >
                            <h2 class=" text-left">Category </h2>
                        </header>
                        <!-- Filter-->
                        <div class="form-group">
                            <select class="form-control" id="sel1" name="filter" aria-label="price type filter">

                                <option value="latest">Latest</option>
                                <option value="low_price">Lowest Price</option>
                                <option value="high_price">Highest Price</option>
                               
                            </select>
                        </div>
                        <!-- Filter gender-->
                        <div class="form-group">
                            <select class="form-control" name="gender" aria-label="gender type filter">
                                <option value="men" >Men</option>
                                <option value="woman" >Woman</option>                       
                            </select>
                        </div>
                        
                        <!-- Filter clothes-->
                        <div class="form-group">
                            <select class="form-control" name="clothes" aria-label="clothing type filter">                               
                                <option value="shirt">Shirt</option>
                                <option value="pants">Pants</option>
                                <option value="dress">Dress</option>
                                <option value="skirt">Skirt</option>
                                <option value="coat">Coat</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                       </form> 
                        <form>
                            <button type="submit" name="reset" id="shop_reset" class="btn btn-primary">Reset</button>
                        </form>
                    </div>
                    
                    
                    
                    <!--products-->
                    <div class="col-xs-12  col-md-8  ">
                        <div class="card ">
                            <div class="row">


                                <?php
                               
                                //filter gender and clothes
                                if (isset($_POST['gender'])&& isset($_POST['clothes'])) {
                                $value = $_POST['clothes'];
                                $value1 = $_POST['gender'];
                                $sql = "SELECT * FROM p1_5.products WHERE product_cat='$value' and gender='$value1'";
                                //special filter
                                 if (isset($_POST['filter'])) {
                                    if ($_POST['filter'] == "latest") {

                                        $sql = "SELECT * FROM p1_5.products WHERE product_cat='$value' and gender='$value1' ORDER BY product_id DESC LIMIT 3;";
                                    }

                                    else if ($_POST['filter'] == "low_price") {

                                        $sql = "SELECT * FROM p1_5.products WHERE product_cat='$value' and gender='$value1' ORDER BY product_price ASC;";
                                    }
                                    
                                    else if ($_POST['filter'] == "high_price") {

                                        $sql = "SELECT * FROM p1_5.products WHERE product_cat='$value' and gender='$value1' ORDER BY product_price DESC;";
                                    }
                                }
                                }
                                
                              
                               else if (isset($_POST['reset'])){
                                   $sql = "SELECT * FROM p1_5.products";
                                   
                               }
                                // show all products
                                
                                else {
                                    $sql = "SELECT * FROM p1_5.products";
                                }
                            
                               if ($result = mysqli_query($conn, $sql)) {
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_array($result)) {
                                            $prod_id = $row['product_id'];
                                            if ($prod_id < 10) {
                                                $prod_id = "0" . $prod_id;
                                            }
                                            echo'<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">';
                                            echo'<figure>';
                                            echo'<a href="product.php?id=' . $prod_id . '">';
                                            echo'<img src="images/products/product-' . $prod_id . '/1.jpeg" alt="'.$row['product_name'].'" class="img-responsive " /></a>';
                                            echo'<div class="card-body">';
                                            echo'<div class="card-title">';
                                            echo'<a href= "product.php?id=' . $prod_id . '">' . $row['product_name'] . '</a>';
                                            echo'</div>';
                                            echo'<p class="card-text">' . $row['product_price'] . '</p>';
                                            echo'</div>';
                                            echo' </figure>';
                                            echo'</div>';
                                           
                                        }
                                    }
                                   $result->free_result();
                                   $conn->close();
                                }
                                
                                
                                ?>


                                
                            </div><!--row-->
                        </div>
                    </div><!--products-->

                </div>
            </div><!--row-->
        </div><!--container-->
        <!--Footer-->
        <?php
        include 'footer.inc.php';
        ?>
        <!--Footer End-->
    </main>
</body>
</html>