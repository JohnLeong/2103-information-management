<!DOCTYPE html>
<?php
require 'vendor/autoload.php';
require_once('../protected/configmdb.php');

$errorMsg = "";
$success = true;
$centre_code = isset($_GET['centre_code']) ? $_GET['centre_code'] : '';

$centre_collection = $mongo->alfredng_db->centre;

$centre_result = $centre_collection->findOne(['centre_code' => $centre_code,]);
?>

<html lang="en">
    <head>
        <title>Creole | (Centre Info)</title>
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
                    <h2 id="product-name"><?php echo $centre_result["centre_name"] ?></h2>
                    <p><?php echo $centre_result["centre_address"] ?></p>

                    <hr>


                    <h4>Centre code</h4>
                    <p><?php echo $centre_result["centre_code"] ?></p>

                    <h4>Contact no.</h4>
                    <p><?php echo $centre_result["centre_contact_no"] ?></p>

                    <h4>Email address</h4>
                    <p><?php echo $centre_result["centre_email_address"] ?></p>

                    <h4>Food offered</h4>
                    <p><?php echo $centre_result["food_offered"] ?></p>

                    <h4>Second languages</h4>
                    <p><?php echo $centre_result["second_languages_offered"] ?></p>

                    <table style="margin: 0px; width:100%;">
                        <tbody>
                            <tr>
                                <td><h4>Vacancies</h4></td>
                            </tr>
                            <tr>
                                <td class="centre_info_cell">
                                    <p>Infant: <?php echo $centre_result["infant_vacancy"] ?></p>
                                </td>
                                <td class="centre_info_cell">
                                    <p>PG: <?php echo $centre_result["pg_vacancy"] ?></p>
                                </td>
                                <td class="centre_info_cell">
                                    <p>Nursery 1: <?php echo $centre_result["n1_vacancy"] ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="centre_info_cell">
                                    <p>Nursery 2: <?php echo $centre_result["n2_vacancy"] ?></p>
                                </td>
                                <td class="centre_info_cell">
                                    <p>Kindergarten 1: <?php echo $centre_result["k1_vacancy"] ?></p>
                                </td>
                                <td class="centre_info_cell">
                                    <p>Kindergarten 2: <?php echo $centre_result["k2_vacancy"] ?></p>
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
                                foreach ($centre_result["centre_service"] as $entry) {
                                    echo '<tr>';
                                    echo '<td class="centre_info_cell">';
                                    echo '<p>' . $entry["class_of_licence"] . '</p>';
                                    echo '</td>';
                                    echo '<td class="centre_info_cell">';
                                    echo '<p>' . $entry["type_of_service"] . '</p>';
                                    echo '</td>';
                                    echo '<td class="centre_info_cell">';
                                    echo '<p>' . $entry["levels_offered"] . '</p>';
                                    echo '</td>';
                                    echo '<td class="centre_info_cell">';
                                    echo '<p>' . $entry["fees"] . '</p>';
                                    echo '</td>';
                                    echo '<td class="centre_info_cell">';
                                    echo '<p>' . $entry["type_of_citizenship"] . '</p>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>  
                </div>
            </section>
            <br/>

            <!-- Incidental charges section-->
            <section>
                <div class='row'>
                    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-8 col-sm-offset-2">
                        <h4>Incidental charges</h4>
                        <table style="margin: 0px; width:100%;">
                            <tbody>
                                <tr>
                                    <th class="centre_info_cell">
                                        <p>Incidental charge</p>
                                    </th>
                                    <th class="centre_info_cell">
                                        <p>Frequency</p>
                                    </th>
                                    <th class="centre_info_cell">
                                        <p>Cost</p>
                                    </th>
                                </tr>

                                <?php
                                foreach ($centre_result["incidental_charges"] as $entry) {
                                    echo '<tr>';
                                    echo '<td class="centre_info_cell">';
                                    echo '<p>' . $entry["incidental_charges"] . '</p>';
                                    echo '</td>';
                                    echo '<td class="centre_info_cell">';
                                    echo '<p>' . $entry["frequency"] . '</p>';
                                    echo '</td>';
                                    echo '<td class="centre_info_cell">';
                                    echo '<p>' . $entry["amount"] . '</p>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>  
                </div>
            </section>
           <br/>

            <!-- Subsidies section-->
            <section>
                <div class='row'>
                    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-8 col-sm-offset-2">
                        <h4>Available subsidies</h4>
                        <table style="margin: 0px; width:100%;">
                            <tbody>
                                <tr>
                                    <th class="centre_info_cell">
                                        <p>Subsidy category</p>
                                    </th>
                                    <th class="centre_info_cell">
                                        <p>Service type</p>
                                    </th>
                                </tr>

                                <?php
                                foreach ($centre_result["centre_subsidies"] as $entry) {
                                    echo '<tr>';
                                    echo '<td class="centre_info_cell">';
                                    echo '<p>' . $entry["subsidy_category"] . '</p>';
                                    echo '</td>';
                                    echo '<td class="centre_info_cell">';
                                    echo '<p>' . $entry["service_type"] . '</p>';
                                    echo '</td>';
                                    echo '</tr>';
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
        <!--  footer  --> 
        <?php
        include 'footer.inc.php';
        ?>
        <!--  footer end --> 
    </body>
</html>
