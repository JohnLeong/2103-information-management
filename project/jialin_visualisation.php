<?php
require_once('../protected/config.php');
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
} else {
    $success = true;
}
?>
<!DOCTYPE html>  
<html>
    <head>
        <title> Dashboard </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/visualisation.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <?php
        include 'process_jialin.php';
        ?>

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
                        <h1 class="text-center banner-text"> DASHBOARD </h1>
                    </div>
                </div>
            </div>
            <!-- Banner Section  -->

            <!-- Display of piechart  -->
            <div id="govt_subsidies_piechart" class="piechart_css"></div>
            <div id="all_govt_subsidies_piechart1" class="piechart_css" ></div>
            <!-- Display of piechart End -->

            <!-- Display of table data of centre_code that provides ALL govt subsidies  -->
            <table>
                <tr>
                    <th>Centre Code</th>
                </tr>

                <?php
                $query = "select csub.centre_code
from centre_subsidies csub where not exists (  select subsidy_category from govt_subsidies where not exists ( select csub1.centre_code from centre_subsidies csub1 where csub.centre_code = csub1.centre_code and subsidy_category = govt_subsidies.subsidy_category )) group by csub.centre_code";
                $query1 = "select count(csub.centre_code)/12 as hello
from centre_subsidies csub where not exists (  select subsidy_category from govt_subsidies where not exists ( select csub1.centre_code from centre_subsidies csub1 where csub.centre_code = csub1.centre_code and subsidy_category = govt_subsidies.subsidy_category ))";

                $result = mysqli_query($connect, $query);
                $result1 = mysqli_query($connect, $query1);
                if ($connect->connect_error) {
                    $errorMsg = "Connection failed: " . $connect->connect_error;
                    $success = false;
                }
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>" . $row["centre_code"] . "</td><td>";
                }
                ?>
            </table>
            <?php
            while ($row = mysqli_fetch_assoc($result1)) {
                echo "<p>" . "Count:" . $row["hello"] . "</p>";
            }
            ?>
            <!-- Display of table data of centre_code that provides ALL govt subsidies End  -->
            
            <!--Footer-->
            <?php
            include 'footer.inc.php';
            ?>
            <!--Footer End-->
        </main>
    </body>
</html>
