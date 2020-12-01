<!DOCTYPE html>

<?php
require 'vendor/autoload.php';
require_once('../protected/configmdb.php');

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
        <script type="text/javascript">
        <!-- illustration of bar chart 1 script  -->
                    google.charts.load('current', {
                'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Citizenship', 'Average Fees'],
                <?php
                // select a collection (analogous to a relational database's table)
                $collection = $mongo->alfredng_db->centre_service;

                $pipeline = array(
                    array(
                    '$group' => array('_id' => '$type_of_citizenship', 'avgFee' => array ('$avg' => '$fees'))
                    ), 
                    array('$sort' => array("avgFee" => 1)
                    )
                ); 

                $cursor = $collection->aggregate($pipeline);

                foreach ($cursor as $pipeline) {
                    if(isset($pipeline->_id)){
                        echo "['" . $pipeline->_id. "', " . $pipeline->avgFee . "],";   
                    } 
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

                $collection = $mongo->alfredng_db->centre;

                $pipeline1 = array(
                                    array(
                                            '$match' => array( 'food_offered' => 'na')
                                        ),
                                        array(
                                            '$unwind' => '$centre_service'
                                        ),
                                        array(   
                                            '$group' => array( '_id' => '$centre_service.type_of_service', 'count' => array( '$sum' => 1))
                                        )
                                    
                    );

                $cursor1 = $collection->aggregate($pipeline1);

                foreach ($cursor1 as $pipeline1) {
                    if(isset($pipeline1->_id)){
                        echo "['" . $pipeline1->_id. "', " . $pipeline1->count . "],";   
                    } 
                }

                           ?>
                        
                ]);

                var options = { title: 'Count the number of centre that does not offer food based on each type of service(Full Day, Half Day etc)', legend: { position: 'none' } };

                var colChartAfter = new google.visualization.ColumnChart(document.getElementById('colchart_after'));

                colChartAfter.draw(data, options);
            }
               
        </script>
        <!-- illustration of bar chart 2 script ends  -->  
        
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



            <div class="container">
                <div class="row">
                    <div class ="col-lg-6">
                        <!-- Illustration of bar chart 1  -->
                        <div id='colchart_after_1' style='width: 650px; height: 600px; display: inline-block'></div>

                        <!-- table of bar chart 1 Section  -->
                        <div id ="piechart_table">
                            <h4 style="position: relative; left: 100px;">Average Fee of childcare center parents have to pay based on each type of citizenship (Singaporean, PR, Others)</h4>
                            <table style="position: relative; left: 150px;">
                                <tr>
                                    <th>types of citizenship</th>
                                    <th>Average cost</th>
                                </tr>

                                <?php
                                $collection = $mongo->alfredng_db->centre_service;

                                $pipeline = array(
                                    array(
                                    '$group' => array('_id' => '$type_of_citizenship', 'avgFee' => array ('$avg' => '$fees'))
                                    ), 
                                    array('$sort' => array("avgFee" => 1)
                                    )
                                ); 

                                $cursor = $collection->aggregate($pipeline);

                                foreach ($cursor as $pipeline) {
                                    if(isset($pipeline->_id)){
                                        echo "<tr><td>" . $pipeline->_id. "</td><td>$" . $pipeline->avgFee . "</td></tr>";   
                                    } 
                                }
                                echo "</table>";
                                ?>

                            </table>
                            <!-- table of bar chart 1 Section ends -->
                        </div> 


                    </div>

                    <div class ="col-lg-6" >
                        <!-- Illustration of of bar chart 2 Section  -->
                        <div id='colchart_after' style='width: 650px; height: 600px; display: inline-block'></div>

                        <!-- table of bar chart 2 Section  -->
                        <div id ="piechart_table" class="table-wrapper-scroll-y my-custom-scrollbar" style="width:125%; ">
                            <!--<div class=" table-wrapper-scroll-y my-custom-scrollbar">-->
                            <h4 style="position: relative; left: 90px;">Name of childcare center that does not offer food for the child according to the type of service (full day services, half day services etc)</h4>
                                
                                    <table class="display" style="position: relative; left: 100px;">
                                        <tr>
                                            <th>Name of Centers </th>
                                            <th>Type of Services</th>
                                        </tr>

                                        <?php
                                        $collection1 = $mongo->alfredng_db->centre;

                                        $pipeline1 = array(  
                                            array(  
                                                '$match' => array('food_offered' =>  'na')
                                            ),
                                            array(   
                                                '$unwind' =>  '$centre_service' 
                                            ),

                                            array(  
                                                 '$project' =>  array(  '_id' => '$centre_service.type_of_service', 'centre_name' =>  1)
                                            )
                                        );

                                        $cursor1 = $collection1->aggregate($pipeline1);

                                        foreach ($cursor1 as $pipeline1) {
                                            if(isset($pipeline1->_id)){
                                                echo "<tr><td>" . $pipeline1->_id. "</td><td>". $pipeline1->centre_name. "</td></tr>";   
                                            } 
                                        }
                                        echo "</table>";
                                            ?>
                                            
                                    </table>
                            <!-- table of bar chart 2 Section ends -->
                        </div>  
                    </div>
                </div>  
            </div>     

            <!--Footer-->

            <!--Footer End-->
        </main>
    </body>
</html>
<?php
include 'footer.inc.php';
?>


                       
           
          








