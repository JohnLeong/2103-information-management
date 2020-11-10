<?php
require_once('../protected/config.php');
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
} else {
    $success = true;
}
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
        include 'process_govt_subsidies_subsidies.php';
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
                                $query = "select csub.centre_code
                                      from centre_subsidies csub 
                                      where not exists (  
                                        select subsidy_category 
                                        from govt_subsidies 
                                        where not exists ( 
                                            select csub1.centre_code 
                                            from centre_subsidies csub1 
                                            where csub.centre_code = csub1.centre_code and 
                                            subsidy_category = govt_subsidies.subsidy_category )) 
                                      group by csub.centre_code";
//                                $query1 = "select count(csub.centre_code)/12 as hello
//                                       from centre_subsidies csub 
//                                       where not exists (  
//                                        select subsidy_category 
//                                        from govt_subsidies 
//                                        where not exists ( 
//                                            select csub1.centre_code    
//                                            from centre_subsidies csub1 
//                                            where csub.centre_code = csub1.centre_code and 
//                                            subsidy_category = govt_subsidies.subsidy_category ))";

                                $result = mysqli_query($connect, $query);
                                $result1 = mysqli_query($connect, $query1);
                                if ($connect->connect_error) {
                                    $errorMsg = "Connection failed: " . $connect->connect_error;
                                    $success = false;
                                }
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tbody><tr><th class='row'>" . $row["centre_code"] . "</th></tr></tbody>";
                                }
                                ?>
                            </table>
                              <?php
//                            while ($row = mysqli_fetch_assoc($result1)) {
//                                echo "<p>" . "Count:" . $row["hello"] . "</p>";
//                            }
//                            ?> 
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
