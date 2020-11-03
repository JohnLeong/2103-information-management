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
        include 'process_amitpaul.php';
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

            <!-- Display of bar chart & line chart  -->
            <div class="container-fluid">
                <div class="row">
                    <div id="town_barchart" class="col-md-6" style="width: 750px; height:500px;"></div>
                    <div id="town_linechart" class="col-md-6"style="width: 750px; height:500px;" ></div>
                </div>

            </div>

            <!-- Display of bar chart & line chart End -->

            <!-- Display of table data of Town name, Frequency of Centers and Average Fees group by Town Name  -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table" >
                            <thead>
                                <tr>
                                    <th>Town</th>
                                    <th>Frequency of Centers</th>
                                    <th>Average Fees</th>
                                </tr>
                            </thead>
                            <?php
                            $query = "SELECT town_name,COUNT(DISTINCT(centre.centre_code)),  ROUND(AVG(centre_service.fees),2) FROM centre "
                                    . "JOIN centre_service ON centre.centre_code=centre_service.centre_code "
                                    . "JOIN hdb_town ON LEFT(centre.postal_code,2)=idhdb_town "
                                    . "GROUP BY town_name;";
                      
                            $result = mysqli_query($connect, $query);
                            
                            if ($connect->connect_error) {
                                $errorMsg = "Connection failed: " . $connect->connect_error;
                                $success = false;
                            }
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tbody><tr><td class='row'>" . $row["town_name"] . "</td><td class='row'>".$row["COUNT(DISTINCT(centre.centre_code))"]."</td><td class'row'>$".$row["ROUND(AVG(centre_service.fees),2)"]."</td></tr></tbody>";
                            }
                            ?>
                        </table>
                        
                        <!-- Display of table data of Town name, Frequency of Centers and Average Fees group by Town Name End  -->
                    </div>
                   
                </div> 
            </div>


            <!--Footer-->
            <?php
            include 'footer.inc.php';
            ?>
            <!--Footer End-->
        </main>
    </body>
</html>
