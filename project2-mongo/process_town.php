<?php
require_once('../protected/configmdb.php');
$collection = $mongo->alfredng_db->centre;

$pipelinePie = array(
    array(
        '$group' => array('_id' => '$hdb_town',
            'count' => array('$sum' => 1))
    ),
//    array(
//        '$project' => array('_id' => 0,
//            'town_name' => '$_id',
//            'count' => 1,
//            'sum' => 1)
//    ),
    array(
        '$sort' => array('_id' => 1)
    )
);
$pipelineBar = array(
    array(
        '$lookup' => array(
            'from' => 'centre_service',
            'localField' => 'centre_code',
            'foreignField' => 'centre_code',
            'as' => 'services')
    ),
    array(
        '$addFields' => array(
            'services' => array('$avg' => '$services.fees')
        )
    ),
    array(
        '$group' => array('_id' => '$hdb_town',
            'avgFees' => array('$avg' => '$services')
        )
    ),
//    array(
//        '$project' => array('_id' => 0,
//            'town_name' => '$_id',
//            'avgFees' => 1,
//            'avg' => 1)
//    ),
    array(
        '$sort' => array('_id' => 1)
    )
);
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
//while ($row = mysqli_fetch_array($result)) {
//    echo "['" . $row["town_name"] . "', " . $row["ROUND(AVG(centre_service.fees),2)"] . "],";
//}
$cursorBar = $collection->aggregate($pipelineBar);
foreach ($cursorBar as $pipelineBar) {
    if (isset($pipelineBar->_id)) {
        echo "['" . $pipelineBar->_id . "', " . $pipelineBar->avgFees . "],";
    }
}
?>
        ]);

        var options = {
            title: 'Average Fees per Town', legend: {position: 'top'}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('town_barchart'));

        chart.draw(data, options);
    }




</script>

<!-- Pie Chart Visualization-->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Town', 'Number of Centres'],
<?php
//while ($row = mysqli_fetch_array($result1)) {
//    echo "['" . $row["town_name"] . "', " . $row["count_centre_code"] . "],";
//}
$cursorPie = $collection->aggregate($pipelinePie);
foreach ($cursorPie as $pipelinePie) {
    if (isset($pipelinePie->_id)) {
        echo "['" . $pipelinePie->_id . "', " .  $pipelinePie->count . "],";
    }
}
?>
        ]);

        var options = {
            title: 'Number of Centres per Town', legend: {position: 'right'}, is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('town_linechart'));

        chart.draw(data, options);
    }
</script>