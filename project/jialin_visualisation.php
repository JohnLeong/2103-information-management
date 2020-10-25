<?php
require_once('../protected/config.php');
$connect = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
if ($connect->connect_error) {
    $errorMsg = "Connection failed: " . $connect->connect_error;
    $success = false;
} else {

//$connect = mysqli_connect("localhost", "root", "", "testing");
    $query = "select csub.centre_code, count(csub.centre_code)as hello
from centre_subsidies csub where not exists (  select subsidy_category from govt_subsidies where not exists ( select csub1.centre_code from centre_subsidies csub1 where csub.centre_code = csub1.centre_code and subsidy_category = govt_subsidies.subsidy_category )) group by csub.centre_code";
    $result = mysqli_query($connect, $query);
}
?>  
<!DOCTYPE html>  
<html>
    <head>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    echo "['" . $row["centre_code"] . "', " . $row["hello"] . "],";
                }
                ?>
                ]);

                var options = {
                    title: 'Childcare Centre provides all Government Subsidies'
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                chart.draw(data, options);
            }
        </script>
    </head>
    <body>
        <div id="piechart" style="width: 900px; height: 500px;"></div>
    </body>
</html>
