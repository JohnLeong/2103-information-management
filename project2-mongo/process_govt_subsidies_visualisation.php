<?php
require 'vendor/autoload.php';
require_once('../protected/configmdb.php');
$collection = $mongo->alfredng_db->centre;

?>  
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart_jl);
    google.charts.setOnLoadCallback(drawChart1_jl);

    function drawChart_jl() {

        var data = google.visualization.arrayToDataTable([
            ['Govt_subsidies', 'Yes/No'],
<?php

$result = array(
    array('$group' => array('_id' => '$government_subsidy',
            'count' => array('$sum' => 1))));
$cursor1 = $collection->aggregate($result);
foreach ($cursor1 as $result) {
    if (isset($result->_id)) {
        echo "['" . $result->_id . "', " .  $result->count . "],";
    }
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

$pipeline = [
    [
        '$match' => [
            'centre_subsidies' => ['$size' => 12]
        ]
    ]
];
$result2 = $collection->aggregate($pipeline);
$yes_results = count($result2->toArray());
$total_result = $collection->count();
$no_result = $total_result - $yes_results;
echo "['YES', " .  $yes_results . "],";
echo "['NO', " .  $no_result . "],";

?>
        ]);

        var options = {
            title: 'Childcare Centre provides ALL Government Subsidies'
        };

        var chart = new google.visualization.PieChart(document.getElementById('all_govt_subsidies_piechart1'));

        chart.draw(data, options);
    }


</script>
