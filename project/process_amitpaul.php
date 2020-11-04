  <?php
require_once('../protected/config.php');
$connect = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
if ($connect->connect_error) {
    $errorMsg = "Connection failed: " . $connect->connect_error;
    $success = false;
} else {

//$connect = mysqli_connect("localhost", "root", "", "testing");
    $query = "SELECT town_name,ROUND(AVG(centre_service.fees),2) FROM centre "
            . "JOIN centre_service ON centre.centre_code=centre_service.centre_code "
            . "JOIN hdb_town ON LEFT(centre.postal_code,2)=idhdb_town "
            . "GROUP BY town_name "
            . "ORDER BY town_name;";
    $result = mysqli_query($connect, $query);
    
    $query1 = "SELECT town_name, COUNT(DISTINCT(centre.centre_code)) FROM centre "
            . "JOIN hdb_town ON LEFT(centre.postal_code,2)=idhdb_town "
            . "GROUP BY town_name "
            . "ORDER BY town_name;";
    $result1 = mysqli_query($connect, $query1);

    
}
?>  

<!-- Bar Chart visualization-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
            google.charts.load('current', {'packages': ['corechart']});
            
            google.charts.load('current', {'packages': ['bar']});
            
            google.charts.setOnLoadCallback(drawChart_bc);

            function drawChart_bc() {

                var data = google.visualization.arrayToDataTable([
                    ['Town', 'Average  Fees'],
<?php
while ($row = mysqli_fetch_array($result)) {
    echo "['" . $row["town_name"] . "', " . $row["ROUND(AVG(centre_service.fees),2)"] . "],";
}
?>
                ]);

                var options = {
                    title: 'Average Fees per Town', legend:{position:'top'}
                };

                var chart = new google.visualization.ColumnChart(document.getElementById('town_barchart'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
            }

            


        </script>
        
        <!-- Line Chart Visualization
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Town', 'Number of Centres'],
         <?php
while ($row = mysqli_fetch_array($result1)) {
    echo "['" . $row["town_name"] . "', " . $row["COUNT(DISTINCT(centre.centre_code))"] . "],";
}
?>
        ]);

        var options = {
          title: 'Number of Centres per Town',
          legend: { position: 'top' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('town_linechart'));

        chart.draw(data, options);
      }
    </script>
-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Town', 'Number of Centres'],
         <?php
while ($row = mysqli_fetch_array($result1)) {
    echo "['" . $row["town_name"] . "', " . $row["COUNT(DISTINCT(centre.centre_code))"] . "],";
}
?>
        ]);

        var options = {
          title: 'Number of Centres per Town', legend:{position:'right'}
        };

        var chart = new google.visualization.PieChart(document.getElementById('town_linechart'));

        chart.draw(data, options);
      }
    </script>