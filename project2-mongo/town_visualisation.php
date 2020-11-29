<?php
require_once('../protected/configmdb.php');

$collection = $mongo->alfredng_db->centre;
$pipelineTable = array(
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
            'count' => array('$sum' => 1),
            'avgFees' => array('$avg' => '$services')
        )
    ),
//    array(
//        '$project' => array('_id' => 0,
//            'town_name' => '$_id',
//            'avgFees' => 1,
//            'count' => 1,
//            'sum' => 1,
//            'avg' => 1)
//    ),
    array(
        '$sort' => array('_id' => 1)
    )
);
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
        include 'process_town.php';
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
                    <div id="town_linechart" class="col-md-6" style="width: 750px; height:500px;" ></div>
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
                                    <th>Number of Centers</th>
                                    <th>Average Fees</th>
                                </tr>
                            </thead>
                            <?php
//                            
                            $cursorTable = $collection->aggregate($pipelineTable);
                            foreach ($cursorTable as $pipelineTable) {
                                if (isset($pipelineTable->_id)) {
                                    echo "<tbody><tr><td class='row'>" . $pipelineTable->_id . "</td><td class='row'>" . $pipelineTable->count . "</td><td class'row'>$" . $pipelineTable->avgFees . "</td></tr></tbody>";
                                }
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
