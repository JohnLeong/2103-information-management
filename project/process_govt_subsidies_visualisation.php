  <?php
require_once('../protected/config.php');
$connect = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
if ($connect->connect_error) {
    $errorMsg = "Connection failed: " . $connect->connect_error;
    $success = false;
} else {

//$connect = mysqli_connect("localhost", "root", "", "testing");
    $query = "select government_subsidy, count(*) as hello from centre group by government_subsidy;";
    $result = mysqli_query($connect, $query);
    
    $query1 = "select count(csub.centre_code)/12 as hello
from centre_subsidies csub where not exists (  select subsidy_category from govt_subsidies where not exists ( select csub1.centre_code from centre_subsidies csub1 where csub.centre_code = csub1.centre_code and subsidy_category = govt_subsidies.subsidy_category ));";
    $result1 = mysqli_query($connect, $query1);

    $query2 = "SELECT (SELECT COUNT(*) FROM centre) - (select count(csub.centre_code)/12 
from centre_subsidies csub where not exists (  select subsidy_category from govt_subsidies where not exists ( select csub1.centre_code from centre_subsidies csub1 where csub.centre_code = csub1.centre_code and subsidy_category = govt_subsidies.subsidy_category ))) as hello2;";
    $result2 = mysqli_query($connect, $query2);
}
?>  
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawChart_jl);
            google.charts.setOnLoadCallback(drawChart1_jl);

            function drawChart_jl() {

                var data = google.visualization.arrayToDataTable([
                    ['Govt_subsidies', 'YEs/No'],
<?php
while ($row = mysqli_fetch_array($result)) {
    echo "['" . $row["government_subsidy"] . "', " . $row["hello"] . "],";
}
?>
                ]);

                var options = {
                    title: 'Childcare Centre provides Government Subsidies'
                };

                var chart = new google.visualization.PieChart(document.getElementById('govt_subsidies_piechart'));

                chart.draw(data, options);
            }

            function drawChart1_jl() {


                var data = google.visualization.arrayToDataTable([
                    ['Provides_subsidies', 'count'],

<?php
while ($row = mysqli_fetch_array($result1)) {
    echo "['" . 'YES' . "', " . $row["hello"] . "],";
}
while ($row = mysqli_fetch_array($result2)) {
    echo "['" . 'NO' . "', " . $row["hello2"] . "],";
}
?>
                ]);

                var options = {
                    title: 'Childcare Centre provides ALL Government Subsidies'
                };

                var chart = new google.visualization.PieChart(document.getElementById('all_govt_subsidies_piechart1'));

                chart.draw(data, options);
            }


        </script>
