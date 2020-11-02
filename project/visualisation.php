<!DOCTYPE html>
<!-- Database connection-->

<?php
require_once('../protected/config.php');
$connect = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
if ($connect->connect_error) {
    $errorMsg = "Connection failed: " . $connect->connect_error;
    $success = false;
} else {

//$connect = mysqli_connect("localhost", "root", "", "testing");
    $query = "SELECT type_of_citizenship, AVG(fees) as fees
                FROM centre_service
                WHERE fees IN (SELECT fees FROM centre_service)
                GROUP BY type_of_citizenship
                ORDER BY AVG(fees) ASC";
    $result = mysqli_query($connect, $query);
    
    $query1 = "SELECT COUNT(centre.centre_name) AS name, type_of_service
                FROM centre
                INNER JOIN centre_service ON centre.centre_code=centre_service.centre_code
                WHERE centre.food_offered = 'na'
                GROUP BY type_of_service";
    $result1 = mysqli_query($connect, $query1);
}
?>
    

<html lang="en">

    <head>
        <title>Creole | Dashboard </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Creole | Bringing People Together Through Fashion">
        <meta name="keywords" content="Fasion, Clothes, Dress, Tops, Bottoms">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/visualisation.css" rel="stylesheet">
        <link rel="stylesheet" href="css/shopfilter.css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    </head>
    
        <script type="text/javascript">
        <!-- illustration of bar chart 1 script  -->
                    google.charts.load('current', {
                'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Citizenship', 'Average Fees'],
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    echo "['" . $row["type_of_citizenship"] . "', " . $row["fees"] . "],";
                }
                ?>
                ]);

                var options = { title: 'Average Fee of childcare centres based on each type of citizenship', legend: { position: 'none' } };

                var colChartAfter = new google.visualization.ColumnChart(document.getElementById('colchart_after_1'));

                colChartAfter.draw(data, options);
            }
             
        </script> 
        <!-- illustration of bar chart 1 script ends  -->  
            
        <!-- illustration of bar chart 2 script  -->
        <script type="text/javascript">
        
                    google.charts.load('current', {
                'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Type Of Service', 'Name'],
                <?php
                while ($row = mysqli_fetch_array($result1)) {
                    echo "['" . $row["type_of_service"] . "', " . $row["name"] . "],";
                }
                ?>
                ]);

                var options = { title: 'Count the number of centre that does not offer food based on each type of service(Full Day, Half Day etc)', legend: { position: 'none' } };

                var colChartAfter = new google.visualization.ColumnChart(document.getElementById('colchart_after'));

                colChartAfter.draw(data, options);
            }
               
        </script>
        <!-- illustration of bar chart 2 script ends  -->  

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
        
       
       <body>
           <div class="container">
               <div class="row">
                   <div class ="col-lg-6">
                       <!-- Illustration of bar chart 1  -->
                        <div id='colchart_after_1' style='width: 650px; height: 600px; display: inline-block'></div>
                        
                        <!-- table of bar chart 1 Section  -->
                        <div id ="piechart_table">
                            <h4>Average Fee of childcare center parents have to pay based on each type of citizenship (Singaporean, PR, Others)</h4>
                            <table>
                               <tr>
                                   <th>types of citizenship</th>
                                   <th>Average cost</th>
                               </tr>

                               <?php
                               require_once('../protected/config.php');
                                $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                                $sql = "SELECT type_of_citizenship, AVG(fees)
                                FROM centre_service
                                WHERE fees IN (SELECT fees FROM centre_service)
                                GROUP BY type_of_citizenship
                                ORDER BY AVG(fees) ASC;"; 

                                $fire = mysqli_query($conn, $sql);

                                if ($conn->connect_error) {
                                    $errorMsg = "Connection failed: " . $conn->connect_error;
                                    $success = false;
                                }
                               while ($result = mysqli_fetch_assoc($fire)){
                                echo "<tr><td>".$result["type_of_citizenship"]."</td><td>".$result["AVG(fees)"]."</td></tr>";

                                }
                                echo "</table>";
                              ?>
                            </table>
                            <!-- table of bar chart 1 Section ends -->
                        </div> 
                        
           
                   </div>
                   
                   <div class ="col-lg-6">
                       <!-- Illustration of of bar chart 2 Section  -->
                       <div id='colchart_after' style='width: 650px; height: 600px; display: inline-block'></div>
                       
                            <!-- table of bar chart 2 Section  -->
                            <div id ="piechart_table">
                                <h4>Name of childcare center that does not offer food for the child according to the type of service (full day services, half day services etc)</h4>
                                <table>
                                   <tr>
                                       <th>Name of Centers </th>
                                       <th>Type of Services</th>
                                   </tr>

                                   <?php
                                   require_once('../protected/config.php');
                                    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                                    $sql = "SELECT DISTINCT centre.centre_name AS name, type_of_service
                                            FROM centre
                                            INNER JOIN centre_service ON centre.centre_code=centre_service.centre_code
                                            WHERE centre.food_offered = 'na'
                                            ORDER BY type_of_service;"; 

                                    $fire = mysqli_query($conn, $sql);

                                    if ($conn->connect_error) {
                                        $errorMsg = "Connection failed: " . $conn->connect_error;
                                        $success = false;
                                    }
                                   while ($result = mysqli_fetch_assoc($fire)){
                                    echo "<tr><td>".$result["name"]."</td><td>".$result["type_of_service"]."</td></tr>";

                                    }
                                    echo "</table>";
                                  ?>
                                </table>
                                <!-- table of bar chart 2 Section ends -->
                        </div> 
                       
                   </div>
                   
                </div>
           </div>
                   
           
           
           
           
           
           
        </body> 
        
        
    <!-- Footer  -->
    <?php
         include 'footer.inc.php';
     ?>
    <!-- Footer  -->
        
       

            
            

        
</html>





