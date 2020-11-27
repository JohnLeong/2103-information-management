<?php
require 'vendor/autoload.php';
require_once('../protected/configmdb.php');
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
        include 'process_govt_subsidies_visualisation.php';
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
            <div class="container-fluid ">
                <div class="row">
                    <div class="jumbotron banner">
                        <h1 class="text-center banner-text"> DASHBOARD </h1>
                    </div>
                </div>
            </div>
            <!-- Banner Section  -->

            <!-- Display of piechartand table data  -->
            <div class="container-fluid margin-align">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div id="govt_subsidies_piechart" class="piechart_css col-md-8"></div>
                    <div class="col-md-2"></div>
                </div>
            </div>
            <div class="container-fluid margin-align">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div id="all_govt_subsidies_piechart1" class="piechart_css col-md-6"></div>
                    <div class="col-md-2 table-wrapper-scroll-y my-custom-scrollbar">
                        <div class=" table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table table-bordered table-striped mb-0" >
                                <thead>
                                    <tr>
                                        <th scope="col">Centre Code</th>
                                    </tr>
                                </thead>

                                <?php
                                $collection = $mongo->alfredng_db->centre;

                                $pipeline23 = [
                                    [
                                        '$match' => [
                                            'centre_subsidies' => ['$size' => 12]
                                        ]],
                                    ['$group' => ['_id' => '$centre_code']]
                                ];
                                $result23 = $collection->aggregate($pipeline23);
                                foreach ($result23 as $pipeline23) {                          
                                    echo "<tbody><tr><th class='row'>" . $pipeline23->_id . "</th></tr></tbody>";
                                }
                                ?>

                            </table>
                        </div>
                    </div>
                    <div class="col-md-2 "></div>
                </div>
            </div>
            <!-- Display of piechart and table data End -->



            <!--Footer-->
<?php
include 'footer.inc.php';
?>
            <!--Footer End-->
        </main>
    </body>
</html>
