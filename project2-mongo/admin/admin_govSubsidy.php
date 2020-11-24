<?php
use MongoDB\BSON\Regex;
require '../vendor/autoload.php';
require_once('../../protected/configmdb.php');

$fullname = $orderid = $email = $date = $time = $price = $errorMsg = "";
$success = true;

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
session_start();

if(isset($_SESSION['email'])) {
    $currentUserprofile = $_SESSION['email'];
}else{
    header("Location: ../homepage.php");
}

if ( ! isset( $_GET['searchvalue'] ) ) {

    //We give the value of the starting row to 0 because nothing was found in URL
    $searchvalue = '';

    //Otherwise we take the value from the URL
} else {
    $searchvalue = $_GET['searchvalue'];
}
?>

<?php echo (isset($result))? $result:'';?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">

    <head>
        <title>TUMMY FOR YUMMY</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/header_footer.css">
        <link rel="stylesheet" href="../css/main.css">
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="../css/admin_order.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <!--<link rel="stylesheet" href="../assets/fonts/fontawesome/css/font-awesome.min.css">-->
        <script defer src="../js/admin.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    </head>

    <body>
<?php
include 'adminHeader.inc.php';
?>
        <main class="page-container">

            <article>
                <section>
                    <div class="jumbotron" style="margin: 0px; padding: 0px; height: 100px;" >
                        <h1>Government Subsidy</h1>
                    </div>
                    <div class="container">
                        <div class="table-responsive">
                            <form method="post">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <input name="searchInput" type="text" id="searchInput" placeholder="Centre Name Search"
                                               aria-label="Search" value="<?php 
                                               if (isset ($_POST['searchInput'])){
                                                    echo (isset($_POST['searchInput']))? htmlentities($_POST['searchInput']):'';
                                               }
                                               else{
                                                    echo (isset($_SESSION['searchvalue']))? htmlentities($_SESSION['searchvalue']):''; 
                                               }?>">
                                        </div>
                                        <div class="col-lg-3">
                                            <button type="submit" class="btn btn-primary-outline-dark btn-lg">Search</button>
                                            <button type="button" class="btn btn-primary-outline-dark btn-lg createbtn" title="Update Details">Create</button>
                                        </div>
                                </div>
                            </form>
                            
                            <table id="orderTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Household Income</th>
                                    <th>Service Type</th>
                                    <th>Total Fees</th>
                                    <th>Action</th>
                                   
                                </tr>
<?php

//Check if the starting row variable was passed in the URL or not
if ( ! isset( $_GET['startrow'] ) or ! is_numeric( $_GET['startrow'] ) ) {

    //We give the value of the starting row to 0 because nothing was found in URL
    $startrow = 0;

    //Otherwise we take the value from the URL
} else {
    $startrow = (int) $_GET['startrow'];
}
                               
if (!isset($_POST['searchInput'])){
    $collection = $mongo->alfredng_db->govt_subsidies;
    $result = $collection->find(array(),array('limit' => 20));
   
} else {
    $searchvalue = $_POST['searchInput'];
    $_SESSION['searchvalue'] = $_POST['searchInput'];
    
    $collection = $mongo->alfredng_db->govt_subsidies;
    $regex = new MongoDB\BSON\Regex($searchvalue, 'i'); 
    $result = $collection->find(['subsidy_category' => $regex ]);
}
        if ( $result != "" ) {
            foreach ($result as $row) {
                ?>
                                                <tbody>
                                                    <tr>
                                                        <td class="counterCell"></td>
                                                        <td><?php echo $row['subsidy_category']; ?></td>
                                                        <td><?php echo $row['monthly_income']; ?></td>
                                                        <td><?php echo $row['service_type']; ?></td>
                                                        <td><?php echo $row['total_fees']; ?></td>
                                                        <td style="display:none;"><?php echo $row['basic_subsidy']; ?></td>
`                                                       <td style="display:none;"><?php echo $row['max_additional_subsidy']; ?></td>
                                                        <td style="display:none;"><?php echo $row['max_family_pays']; ?></td>
                                                        <td style="display:none;"><?php echo $row['low_additional_subsidy']; ?></td>
                                                        <td style="display:none;"><?php echo $row['low_family_pays']; ?></td>
                                                      
                                                        <td><button type="button" class="btn btn-primary btn-xs updatebtn" title="Update Details"><span class="glyphicon glyphicon-edit"></span></button></td>
                                                    </tr>
                <?php
            }
            
        } else {
            ?>    
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>No Data Available!</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
            <?php
        }
        ?>
                                </tbody>
                            </table>
        <?php
        $prev = $startrow - 20;
        //  only print a "Previous" link if a "Next" was clicked
        if ( $prev >= 0 ) {
            echo '<a href="' . $_SERVER['PHP_SELF'] . '?startrow=' . $prev . '">Previous     </a>';
        }
        //  Now this is the link..
        echo '<a href="' . $_SERVER['PHP_SELF'] . '?startrow=' . ( $startrow + 20 ) . '&searchvalue=' . $searchvalue .'">Next</a>';
       

        ?>
                        </div>
                    </div>
                </section>
            </article>

            <!-- View Catering Details Modal -->
            <div class="modal fade" id="updateCatering" tab-index="-1" role="dialog" aria-labelledby="viewCaterinngDetails" aria-hidden="true">
            
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit</h4>
                        </div>
                        <form action="process_updateGovSub.php" method="POST">
                            <div class="modal-body ">
                                <div class="row">
                                    <div class="col-lg-6">
<!--                                        <input type="hidden" name="customerID" id="customerID" class="form-control" placeholder="Customer ID" readonly>-->
                                        <div class="form-group">
                                            <label> Subsidy Category </label>
                                            <input type="text" name="sCategory" id="sCategory" class="form-control" placeholder="e.g. 'kindergarten anchor operator'" readonly>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label> Total Fees </label>
                                            <input type="text" name="totalFees" id="totalFees" class="form-control" placeholder="e.g. '171.00'" required>
                                        </div> 
                                        <div class="form-group">
                                            <label> Basic Subsidy </label>
                                            <input type="text" name="bSubsidy" id="bSubsidy" class="form-control" placeholder="e.g. '150.00'" required>
                                        </div> 
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Service Type</label>
                                            <input type="text" name="serviceType" id="serviceType" class="form-control" placeholder="e.g. 'FDCC_B'" required>
                                        </div>
                                        <div class="form-group">
                                            <label> Household Income </label>
                                            <input type="text" name="Income" id="Income" class="form-control" placeholder="e.g. '5000'" required>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
<!--                                        <input type="hidden" name="customerID" id="customerID" class="form-control" placeholder="Customer ID" readonly>-->
                                        <div class="form-group">
                                            <label> Max Additional Subsidy </label>
                                            <input type="text" name="maxSubsidy" id="maxSubsidy" class="form-control" placeholder="e.g. '700.00'" required>
                                        </div>
                                        <div class="form-group">
                                            <label> Low Additional Subsidy </label>
                                            <input type="text" name="lowSubsidy" id="lowSubsidy" class="form-control" value='0' placeholder="e.g. '90.00'" required>
                                        </div> 
                                    </div>
                                     <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Max Family Pays </label>
                                            <input type="text" name="maxFamilypay" id="maxFamilypay" class="form-control" placeholder="e.g. '50.00'" required>
                                        </div> 
                                        <div class="form-group">
                                            <label> Low Family Pays </label>
                                            <input type="text" name="lowFamilypay" id="lowFamilypay" class="form-control" value='0' placeholder="e.g. '90.00'" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-default" name="deletebutton" >Delete</button>
                                <button type="submit" class="btn btn-dark" name="updatebutton">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            
            <!-- View Create GOV SUBSIDY Modal -->
            <div class="modal fade" id="createCatering" tab-index="-1" role="dialog" aria-labelledby="viewCaterinngDetails" aria-hidden="true">
            
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Create Government Subsidy</h4>
                        </div>
                        <form action="process_createGovSub.php" method="POST">
                            <div class="modal-body ">
                                <div class="row">
                                    <div class="col-lg-6">
<!--                                        <input type="hidden" name="customerID" id="customerID" class="form-control" placeholder="Customer ID" readonly>-->
                                        <div class="form-group">
                                            <label> Subsidy Category </label>
                                            <input type="text" name="sCategory" id="sCategory" class="form-control" placeholder="e.g. 'FDCC_B'" required>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label> Total Fees </label>
                                            <input type="text" name="totalFees" id="totalFees" class="form-control" placeholder="e.g. '171.00'" required>
                                        </div> 
                                        <div class="form-group">
                                            <label> Basic Subsidy </label>
                                            <input type="text" name="bSubsidy" id="bSubsidy" class="form-control" placeholder="e.g. '150.00'" required>
                                        </div> 
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Service Type</label>
                                            <input type="text" name="serviceType" id="serviceType" class="form-control" placeholder="e.g. 'kindergarten anchor operator'" required>
                                        </div>
                                        <div class="form-group">
                                            <label> Household Income </label>
                                            <input type="text" name="Income" id="Income" class="form-control" placeholder="e.g. '5000'" required>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
<!--                                        <input type="hidden" name="customerID" id="customerID" class="form-control" placeholder="Customer ID" readonly>-->
                                        <div class="form-group">
                                            <label> Max Additional Subsidy </label>
                                            <input type="text" name="maxSubsidy" id="maxSubsidy" class="form-control" placeholder="e.g. '700.00'" required>
                                        </div>
                                        <div class="form-group">
                                            <label> Low Additional Subsidy </label>
                                            <input type="text" name="lowSubsidy" id="lowSubsidy" class="form-control" value='0' placeholder="e.g. '90.00'" required>
                                        </div> 
                                    </div>
                                     <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Max Family Pays </label>
                                            <input type="text" name="maxFamilypay" id="maxFamilypay" class="form-control" placeholder="e.g. '50.00'" required>
                                        </div> 
                                        <div class="form-group">
                                            <label> Low Family Pays </label>
                                            <input type="text" name="lowFamilypay" id="lowFamilypay" class="form-control" value='0' placeholder="e.g. '90.00'" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-dark" name="updatebutton">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <script>
                //To hide 'customer_id'
//                $("td:nth-of-type(3)").hide();

                $(document).ready(function () {
                    $('.updatebtn').on('click', function () {
                        $('#updateCatering').modal('show');

                        $tr = $(this).closest('tr');

                        var data = $tr.children("td").map(function () {
                            return $(this).text();
                        }).get();

                        console.log(data);

                        $('#serviceType').val(data[3]);
                        $('#sCategory').val(data[1]);
                        $('#totalFees').val(data[4]);
                        $('#maxSubsidy').val(data[6]);
                        $('#Income').val(data[2]);
                        $('#bSubsidy').val(data[5]);
                        $('#maxFamilypay').val(data[7]);
                        if (data[9] == NULL){
                            $('#lowFamilypay').val('0.00');
                        }else{
                            $('#lowFamilypay').val(data[9]);
                        }
                        if (data[8] == NULL){
                            $('#lowSubsidy').val('0.00');
                        }else{
                            $('#lowSubsidy').val(data[8]);
                        }
                       
                    });
                });
            $(document).ready(function () {
                    $('.createbtn').on('click', function () {
                        $('#createCatering').modal('show');                       
                    });
                });
            </script>

<?php
include 'adminFooter.inc.php';
?>

        </main>
    </body>


</html>
