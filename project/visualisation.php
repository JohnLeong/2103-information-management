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
        
                   <!-- Banner Section End  -->

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

          var data = google.visualization.arrayToDataTable([
            ['Count of centre name', 'Type of citizenship', 'Average cost'],
            ['SPR', 768.42,1548],
            ['SC', 824.42, 1534],
            ['Others', 867.64, 1507]
            
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
        
       

   </head>

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

       <body>
           <div id="piechart" style= "width: 500px; height:300px;"></div>
           
       </body>
           
       <table style = "background-color: white;" >
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

        <style type="text/css">
           
            table{
                width:300px;
                height:100px;
                font-size: 10px;
                text-align: center;
                border-collapse: collapse;
                padding: 200px;
                margin: 50px;
            }
            th {
                background-color: #cdcdcd;
                color:black;
                border: 1px solid #000000;
                text-align: center;   
            }
            

        </style>
            
            

        
</html>



