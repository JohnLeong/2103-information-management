<!DOCTYPE html>
<!-- Database connection-->

<?php
require_once('../protected/config.php');
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
 $sql = "SELECT COUNT(DISTINCT centre_name), type_of_citizenship, AVG(fees)
FROM centre_service
WHERE fees IN (SELECT fees FROM centre_service)
GROUP BY type_of_citizenship
ORDER BY AVG(fees) ASC;"; 

$fire = mysqli_query($conn, $sql);

if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
}
else {
    echo 'connected';
    while ($result = mysqli_fetch_assoc($fire)){
                echo "['".$result["COUNT(DISTINCT centre_name)"]."',".$result["type_of_citizenship"].",".$result["AVG(fees)"]."]";    
            }
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
        <!-- illustration of pie chart Section  -->
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Count of centre name', 'Type of citizenship', 'Average cost'],
              ['SPR', 768.42,1548],
              ['SC', 824.42, 1534],
              ['Others', 867.64, 1507],

              <?php

                while ($result = mysqli_fetch_assoc($fire)){
                   echo "['".$result["COUNT(DISTINCT centre_name)"]."',".$result["type_of_citizenship"].",".$result["AVG(fees)"]."]";

                }

                ?>
            ]);
              
            var options= {
              title: 'Count of childcare centre and their average costs based on type of citizenships'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
        </script> 
        <!-- illustration of pie chart Section  -->
    

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
        
       <!-- table of pie chart Section  -->
       <body>
           <div id="piechart"></div>
           
           <div id ="piechart_table">
            <table>
               <tr>
                   <th>COUNT of center name</th>
                   <th>types of citizenship</th>
                   <th>Average cost</th>
               </tr>

               <?php
               require_once('../protected/config.php');
                $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                $sql = "SELECT COUNT(DISTINCT centre_name), type_of_citizenship, AVG(fees)
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
                echo "<tr><td>".$result["COUNT(DISTINCT centre_name)"]."</td><td>".$result["type_of_citizenship"]."</td><td>".$result["AVG(fees)"]."</td></tr>";

                }
                echo "</table>";
              ?>
            </table>
           </div> 
           <!-- Table for pie chart end  -->
           
           
        </body> 
        
        
    <!-- Footer  -->
    <?php
         include 'footer.inc.php';
     ?>
    <!-- Footer  -->
        
       

            
            

        
</html>




