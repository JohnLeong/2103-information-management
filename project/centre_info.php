<!DOCTYPE html>
<?php
require_once('../protected/config.php');

// Get product information from database
$product_table = "products";

$errorMsg = "";
$success = true;
$centre_code = isset($_GET['centre_code']) ? $_GET['centre_code'] : '';

$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
} else {
    $sql = "SELECT * FROM sql1902691tlx.centre WHERE centre_code = '$centre_code'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        $errorMsg = "No centre with code '$centre_code' found in the databse.";
        $success = false;
    }
    $service_sql = "SELECT * FROM sql1902691tlx.centre_service WHERE centre_code = '$centre_code'";
    $service_results = $conn->query($service_sql);
    if ($service_results->num_rows < 1) {
        $errorMsg = "No centre service with code '$centre_code' found in the databse.";
        $success = false;
    }
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
                    <img src="images/centre.jpg" alt="" class="img-responsive " />
                </div>

                <!--  Centre information --> 
                <div class="col-lg-4 col-lg-offset-0 col-md-5 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
                    <h2 id="product-name"><?php echo $row["centre_name"] ?></h2>
                    <p><?php echo $row["centre_address"] ?></p>

                    <hr>


                    <h4>Centre code</h4>
                    <p><?php echo $row["centre_code"] ?></p>

                    <h4>Contact no.</h4>
                    <p><?php echo $row["centre_contact_no"] ?></p>

                    <h4>Email address</h4>
                    <p><?php echo $row["centre_email_address"] ?></p>

                    <h4>Food offered</h4>
                    <p><?php echo $row["food_offered"] ?></p>

                    <h4>Second languages</h4>
                    <p><?php echo $row["second_languages_offered"] ?></p>

                    <table style="margin: 0px; width:100%;">
                        <tbody>
                            <tr>
                                <td><h4>Vacancies</h4></td>
                            </tr>
                            <tr>
                                <td class="centre_info_cell">
                                    <p>Infant: <?php echo $row["infant_vacancy"] ?></p>
                                </td>
                                <td class="centre_info_cell">
                                    <p>PG: <?php echo $row["pg_vacancy"] ?></p>
                                </td>
                                <td class="centre_info_cell">
                                    <p>Nursery 1: <?php echo $row["n1_vacancy"] ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="centre_info_cell">
                                    <p>Nursery 2: <?php echo $row["n2_vacancy"] ?></p>
                                </td>
                                <td class="centre_info_cell">
                                    <p>Kindergarten 1: <?php echo $row["k1_vacancy"] ?></p>
                                </td>
                                <td class="centre_info_cell">
                                    <p>Kindergarten 2: <?php echo $row["k2_vacancy"] ?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </section>

            <!-- Services section-->
            <section>
                <div class='row'>
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-8 col-sm-offset-2">
                    <h4>Centre services</h4>
                    <table style="margin: 0px; width:100%;">
                        <tbody>
                            <tr>
                                <th class="centre_info_cell">
                                    <p>Class of license</p>
                                </th>
                                <th class="centre_info_cell">
                                    <p>Type of service</p>
                                </th>
                                <th class="centre_info_cell">
                                    <p>Levels offered</p>
                                </th>
                                <th class="centre_info_cell">
                                    <p>Fees</p>
                                </th>
                                <th class="centre_info_cell">
                                    <p>Type of citizenship</p>
                                </th>
                            </tr>

                            <?php
                            if (mysqli_num_rows($service_results) > 0) {
                                while ($service_row = mysqli_fetch_array($service_results)) {
                                    echo '<tr>';
                                    echo '<td class="centre_info_cell">';
                                    echo '<p>' . $service_row["class_of_licence"] . '</p>';
                                    echo '</td>';
                                    echo '<td class="centre_info_cell">';
                                    echo '<p>' . $service_row["type_of_service"] . '</p>';
                                    echo '</td>';
                                    echo '<td class="centre_info_cell">';
                                    echo '<p>' . $service_row["levels_offered"] . '</p>';
                                    echo '</td>';
                                    echo '<td class="centre_info_cell">';
                                    echo '<p>' . $service_row["fees"] . '</p>';
                                    echo '</td>';
                                    echo '<td class="centre_info_cell">';
                                    echo '<p>' . $service_row["type_of_citizenship"] . '</p>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>  
                </div>
            </section>


            <!-- Back to store button --> 
            <section>   
                <br>
                <div>
                    <p class="text-center"><a href="centres.php" class="btn return-btn btn-lg" role="button" title="Back">Return to centre listing</a></p>
                </div>
            </section>

        </main>
        <?php
        if ($success) {
            $result->free_result();
            $service_results->free_result();
            $conn->close();
        }
        ?>
        <!--  footer  --> 
        <?php
        include 'footer.inc.php';
        ?>
        <!--  footer end --> 
    </body>
</html>
