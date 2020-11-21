<!DOCTYPE html>
<!-- Database connection-->
<?php
require 'vendor/autoload.php';
require_once('../protected/configmdb.php');
define("results_per_page", 10);
?>
<html lang="en">

    <head>
        <title>Creole | (Centres)</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Creole | Bringing People Together Through Fashion">
        <meta name="keywords" content="Fasion, Clothes, Dress, Tops, Bottoms">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script src="js/filter.js"></script> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/shopfilter.css" />
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
                        <h1 class="text-center banner-text"> Childcare centres </h1>
                    </div>
                </div>
            </div>

            <!-- Banner Section End  -->


            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12  ">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-2  text-center">

                        </div> 
                        <div class="col-md-6">
                            <h1 id="product_title" class="text-left">
                                Search results
                            </h1>

                            <hr />
                        </div>


                        <div class="col-md-1">
                        </div>

                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class=" col-md-12  text-center">
                        <div class="col-md-1">
                        </div>


                        <div class="col-md-2 " id="product_filter">
                            <form method="get" id="filter_form">
                                <header >
                                    <h2 class=" text-left">Filter </h2>
                                </header>

                                <!-- Name Filter -->
                                <label class="filter_label">Centre name</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name_filter" name="name_filter" placeholder="Enter centre name" value=<?php echo isset($_GET['name_filter']) ? $_GET['name_filter'] : '' ?>>
                                </div>

                                <hr>

                                <!-- Location Filter -->
                                <label class="filter_label">Location</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="location_filter" name="location_filter" placeholder="Enter location name" value=<?php echo isset($_GET['location_filter']) ? $_GET['location_filter'] : '' ?>>
                                </div>

                                <hr>

                                <!-- Opening days Filter -->
                                <label class="filter_label">Opening days</label>
                                <div class="form-group">

                                    <select class="form-control" id="opening_days_filter" name="opening_days_filter">

                                        <option value="all_days" <?php
                                        if (isset($_GET['opening_days_filter']) && $_GET['opening_days_filter'] === 'all_days') {
                                            echo("selected");
                                        }
                                        ?>>Weekdays + Saturday</option>
                                        <option value="weekdays" <?php
                                        if (isset($_GET['opening_days_filter']) && $_GET['opening_days_filter'] === 'weekdays') {
                                            echo("selected");
                                        }
                                        ?>>Weekdays only</option>
                                        <option value="saturday" <?php
                                        if (isset($_GET['opening_days_filter']) && $_GET['opening_days_filter'] === 'saturday') {
                                            echo("selected");
                                        }
                                        ?>>Saturday only</option>

                                    </select>
                                </div>

                                <hr>

                                <!-- Vacancy Filter -->
                                <label class="filter_label">Vacancy</label>
                                <div class="form-group">
                                    <select class="form-control" id="child_group_filter" name="child_group_filter">

                                        <option value="infant_vacancy" <?php
                                        if (isset($_GET['child_group_filter']) && $_GET['child_group_filter'] === 'infant_vacancy') {
                                            echo("selected");
                                        }
                                        ?>>Infant</option>
                                        <option value="pg_vacancy" <?php
                                        if (isset($_GET['child_group_filter']) && $_GET['child_group_filter'] === 'pg_vacancy') {
                                            echo("selected");
                                        }
                                        ?>>PG</option>
                                        <option value="n1_vacancy" <?php
                                        if (isset($_GET['child_group_filter']) && $_GET['child_group_filter'] === 'n1_vacancy') {
                                            echo("selected");
                                        }
                                        ?>>Nursery 1</option>
                                        <option value="n2_vacancy" <?php
                                        if (isset($_GET['child_group_filter']) && $_GET['child_group_filter'] === 'n2_vacancy') {
                                            echo("selected");
                                        }
                                        ?>>Nursery 1</option>
                                        <option value="k1_vacancy" <?php
                                        if (isset($_GET['child_group_filter']) && $_GET['child_group_filter'] === 'k1_vacancy') {
                                            echo("selected");
                                        }
                                        ?>>Kindergarten 1</option>
                                        <option value="k2_vacancy" <?php
                                        if (isset($_GET['child_group_filter']) && $_GET['child_group_filter'] === 'k2_vacancy') {
                                            echo("selected");
                                        }
                                        ?>>Kindergarten 2</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="vacancy_filter" name="vacancy_filter">

                                        <option value="anytime" <?php
                                        if (isset($_GET['vacancy_filter']) && $_GET['vacancy_filter'] === 'anytime') {
                                            echo("selected");
                                        }
                                        ?>>Anytime</option>
                                        <option value="Immediate" <?php
                                        if (isset($_GET['vacancy_filter']) && $_GET['vacancy_filter'] === 'Immediate') {
                                            echo("selected");
                                        }
                                        ?>>Immediate</option>
                                        <option value="Within 1 Year" <?php
                                        if (isset($_GET['vacancy_filter']) && $_GET['vacancy_filter'] === 'Within 1 Year') {
                                            echo("selected");
                                        }
                                        ?>>Within 1 year</option>

                                    </select>
                                </div>

                                <hr>

                                <!-- Language filter -->
                                <label class="filter_label">Languages offered</label>
                                <div class="form-check filter_checkbox">
                                    <input class="form-check-input" type="checkbox" value="" id="language_chinese_filter" name="language_chinese_filter" <?php if (isset($_GET['language_chinese_filter'])) echo "checked='checked'" ?>>
                                    <span>Chinese</span>
                                </div>
                                <div class="form-check filter_checkbox">
                                    <input class="form-check-input" type="checkbox" value="" id="language_malay_filter" name="language_malay_filter" <?php if (isset($_GET['language_malay_filter'])) echo "checked='checked'" ?>>
                                    <span>Malay</span>
                                </div>
                                <div class="form-check filter_checkbox">
                                    <input class="form-check-input" type="checkbox" value="" id="language_tamil_filter" name="language_tamil_filter" <?php if (isset($_GET['language_tamil_filter'])) echo "checked='checked'" ?>>
                                    <span>Tamil</span>
                                </div>

                                <hr>

                                <!-- GST filter -->
                                <label class="filter_label">Misc. </label>
                                <div class="form-check filter_checkbox">
                                    <input class="form-check-input" type="checkbox" value="" id="gst_filter" name="gst_filter" <?php if (isset($_GET['gst_filter'])) echo "checked='checked'" ?>>
                                    <span>Requires GST registration</span>
                                </div>

                                <!-- Transport filter -->
                                <div class="form-check filter_checkbox">
                                    <input class="form-check-input" type="checkbox" value="" id="transport_filter" name="transport_filter" <?php if (isset($_GET['transport_filter'])) echo "checked='checked'" ?>>
                                    <span>Provides transport</span>
                                </div>

                                <!-- Food filter -->
                                <div class="form-check filter_checkbox">
                                    <input class="form-check-input" type="checkbox" value="" id="food_filter" name="food_filter" <?php if (isset($_GET['food_filter'])) echo "checked='checked'" ?>>
                                    <span>Provides halal food</span>
                                </div>

                                <!-- Spark filter -->
                                <div class="form-check filter_checkbox">
                                    <input class="form-check-input" type="checkbox" value="" id="spark_filter" name="spark_filter" <?php if (isset($_GET['spark_filter'])) echo "checked='checked'" ?>>
                                    <span>Spark certified</span>
                                </div>

                                <input type="hidden" name="page" id="page_num" value = "1" />
                                <hr>
                                <button type="submit" class="btn btn-primary">Search</button>
                            </form> 
                        </div>



                        <!--results-->
                        <div class="col-xs-12  col-md-8  ">
                            <div class="card ">
                                <div class="row">
                                    <?php
                                    //Default query
                                    $mongoQuery = array();

                                    //Name filter
                                    if (isset($_GET['name_filter']) && !empty($_GET['name_filter'])) {
                                        //$mongoQuery["centre_name"] = ['$regex' => new MongoDB\BSON\Regex("/" . $_GET['name_filter'] . "/")];
                                        $mongoQuery["centre_name"] = new MongoDB\BSON\Regex($_GET['name_filter'], 'i');
                                    }

                                    //Location filter
                                    if (isset($_GET['location_filter']) && !empty($_GET['location_filter'])) {
                                        $mongoQuery["centre_address"] = new MongoDB\BSON\Regex($_GET['location_filter'], 'i');
                                    }

                                    //Opening days filter
                                    if (isset($_GET['opening_days_filter']) && !empty($_GET['opening_days_filter'])) {
                                        if ($_GET['opening_days_filter'] == "saturday") {
                                            $mongoQuery["weekday_full_day"] = "na";
                                            $mongoQuery["saturday"] = ['$ne' => "na"];
                                        } else if ($_GET['opening_days_filter'] == "weekdays") {
                                            $mongoQuery["weekday_full_day"] = ['$ne' => "na"];
                                            $mongoQuery["saturday"] = "na";
                                        } else {
                                            $mongoQuery["weekday_full_day"] = ['$ne' => "na"];
                                            $mongoQuery["saturday"] = ['$ne' => "na"];
                                        }
                                    }

                                    //Vacancy filter
                                    if (isset($_GET['child_group_filter']) && !empty($_GET['child_group_filter']) && isset($_GET['vacancy_filter']) && !empty($_GET['vacancy_filter'])) {

                                        if ($_GET['vacancy_filter'] === 'anytime') {
                                            
                                        } else {
                                            $mongoQuery[$_GET['child_group_filter']] = $_GET['vacancy_filter'];
                                        }
                                    }

                                    //Languages filter
                                    if (isset($_GET['language_chinese_filter'])) {
                                        $mongoQuery["second_languages_offered"] = new MongoDB\BSON\Regex('Chinese', 'i');
                                    }
                                    if (isset($_GET['language_malay_filter'])) {
                                        $mongoQuery["second_languages_offered"] = new MongoDB\BSON\Regex('Malay', 'i');
                                    }
                                    if (isset($_GET['language_tamil_filter'])) {
                                        $mongoQuery["second_languages_offered"] = new MongoDB\BSON\Regex('Tamil', 'i');
                                    }

                                    //Misc filters
                                    if (isset($_GET['gst_filter'])) {
                                        $mongoQuery["gst_registration"] = "Yes";
                                    }
                                    if (isset($_GET['transport_filter'])) {
                                        $mongoQuery["provision_of_transport"] = "Yes";
                                    }
                                    if (isset($_GET['food_filter'])) {
                                        $mongoQuery["food_offered"] = new MongoDB\BSON\Regex(' Halal ', 'i');
                                    }
                                    if (isset($_GET['spark_filter'])) {
                                        $mongoQuery["spark_certified"] = "Yes";
                                    }


                                    $num_results = 0;

                                    $centre_collection = $mongo->alfredng_db->centre;
                                    $count_mongo = $centre_collection->count($mongoQuery);
                                    $num_results = $count_mongo;

                                    $num_pages = ceil($num_results / results_per_page);
                                    $page = isset($_GET['page']) ? $_GET['page'] : 1;

                                    $start_page = ($page - 1) * results_per_page;

                                    $mongo_results = $centre_collection->find($mongoQuery, ["limit" => results_per_page, "skip" => $start_page]);
                                    $show_pagination = false;
                                    foreach ($mongo_results as $row) {
                                        //echo $row["centre_name"] . "<br>";

                                        echo '<div class="col-xs-12 col-md-12 centre_card">';
                                        echo '<figure>';

                                        echo '<div class="row">';
                                        echo '<div class="col-md-4">';
                                        echo '<img src="images/centre.jpg" alt="' . $row["centre_name"] . '" class="img-responsive " />';
                                        echo '</div>';

                                        //echo'<a href="centre_info.php?centre_code=' . $row["centre_code"] . '">';

                                        echo'<div class="card-body">';

                                        echo'<div class="card-title">';
                                        echo'<a href= "centre_info.php?centre_code=' . $row["centre_code"] . '"><h3>' . $row["centre_name"] . '</h3></a>';
                                        echo'</div>';

                                        echo'<p class="card-text">Address: ' . $row["centre_address"] . '</p>';
                                        echo'<p class="card-text">Centre code: ' . $row["centre_code"] . '</p>';
                                        echo'<p class="card-text">Contact no.: ' . $row["centre_contact_no"] . '</p>';
                                        echo'<p class="card-text">Email address: ' . $row["centre_email_address"] . '</p>';
                                        //echo'<p class="card-text">Average service fees: $' . number_format(floatval($row["avg_fees"]), 2) . '</p>';

                                        echo'</div>';

                                        echo'</div>';
                                        echo' </figure>';
                                        echo'</div>';
                                        $show_pagination = true;
                                    }

                                    //Pagination   
                                    if ($show_pagination) {
                                        echo '<p>Results: ' . $num_results . '</p>';
                                        echo '<p>Page ' . $page . ' of ' . $num_pages . '</p>';
                                        echo '<button class="page_button" onclick="prevPage(' . $page . ', ' . $num_pages . ')"' . ($page == 1 ? 'disabled' : '') . '>Prev page</button>';
                                        echo '<button class="page_button" onclick="nextPage(' . $page . ', ' . $num_pages . ')"' . ($page == $num_pages ? 'disabled' : '') . '>Next page</button>';
                                    }
                                    ?>



                                </div><!--row-->
                            </div>
                        </div><!--products-->

                    </div>
                </div><!--row-->
            </div><!--container-->
            <br>
            <!--Footer-->
            <?php
            include 'footer.inc.php';
            ?>
            <!--Footer End-->
        </main>
    </body>
</html>