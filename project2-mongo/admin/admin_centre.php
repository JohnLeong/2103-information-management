<?php
use MongoDB\BSON\Regex;
require '../vendor/autoload.php';
require_once('../../protected/configmdb.php');
//$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
//if ($conn->connect_error) {
//    $errorMsg = "Connection failed: " . $conn->connect_error;
//    $success = false;
//}
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
                        <h1>Childcare Centre</h1>
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
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Address</th>
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
    $collection = $mongo->alfredng_db->centre;
    $result = $collection->find(array(),array('limit' => 20));

//    $result = $conn->query("SELECT * FROM centre LIMIT $startrow, 20" );
} else {
    $searchvalue = $_POST['searchInput'];
    $_SESSION['searchvalue'] = $_POST['searchInput'];
    
    $collection = $mongo->alfredng_db->centre;
    $regex = new MongoDB\BSON\Regex($searchvalue, 'i'); 
    $result = $collection->find(['centre_name' => $regex ]);

}
        if ( $result != "" ) {
            foreach ($result as $row) {
                ?>
                                                <tbody>
                                                    <tr>
                                                        <td class="counterCell"></td>
                                                        <td><?php echo $row['centre_code']; ?></td>
                                                        <td><?php echo $row['centre_code']; ?></td>
                                                        <td><?php echo $row['centre_name']; ?></td>
                                                        <td><?php echo $row['centre_contact_no']; ?></td>
                                                        <td><?php echo $row['centre_address']; ?></td>
`                                                       <td style="display:none;"><?php echo $row['organisation_code']; ?></td>
                                                        <td style="display:none;"><?php echo $row['organisation_description']; ?></td>
                                                        <td style="display:none;"><?php echo $row['service_model']; ?></td>
                                                        <td style="display:none;"><?php echo $row['centre_email_address']; ?></td>
                                                        <td style="display:none;"><?php echo $row['postal_code']; ?></td>
                                                        <td style="display:none;"><?php echo $row['centre_website']; ?></td>
                                                        <td style="display:none;"><?php echo $row['infant_vacancy']; ?></td>
                                                        <td style="display:none;"><?php echo $row['pg_vacancy']; ?></td>
                                                        <td style="display:none;"><?php echo $row['n1_vacancy']; ?></td>
                                                        <td style="display:none;"><?php echo $row['n2_vacancy']; ?></td>
                                                        <td style="display:none;"><?php echo $row['k1_vacancy']; ?></td>
                                                        <td style="display:none;"><?php echo $row['k2_vacancy']; ?></td>
                                                        <td style="display:none;"><?php echo $row['food_offered']; ?></td>
                                                        <td style="display:none;"><?php echo $row['second_languages_offered']; ?></td>
                                                        <td style="display:none;"><?php echo $row['spark_certified']; ?></td>
                                                        <td style="display:none;"><?php echo $row['weekday_full_day']; ?></td>
                                                        <td style="display:none;"><?php echo $row['saturday']; ?></td>
                                                        <td style="display:none;"><?php echo $row['scheme_type']; ?></td>
                                                        <td style="display:none;"><?php echo $row['extended_operating_hours']; ?></td>
                                                        <td style="display:none;"><?php echo $row['provision_of_transport']; ?></td>
                                                        <td style="display:none;"><?php echo $row['government_subsidy']; ?></td>
                                                        <td style="display:none;"><?php echo $row['gst_regisration']; ?></td>

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
                            <h4 class="modal-title">Centre Information</h4>
                        </div>
                        <form action="process_updatedetailsc.php" method="POST">
                            <div class="modal-body ">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="hidden" name="customerID" id="customerID" class="form-control" placeholder="Customer ID" readonly>
                                        <div class="form-group">
                                            <label> Centre Code </label>
                                            <input type="text" name="centreCode" id="centreCode" class="form-control" placeholder="Centre Code" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label> Organization Code </label>
                                            <input type="text" name="orgCode" id="orgCode" class="form-control" placeholder="Organisation Code">
                                        </div> 
                                        <div class="form-group">
                                            <label> Service Model </label>
                                            <input type="text" name="serviceModel" id="serviceModel" class="form-control" placeholder="Service Model" >
                                        </div> 
                                        <div class="form-group">
                                            <label> Email </label>
                                            <input type="text" name="emailAddress" id="emailAddress" class="form-control" placeholder="Email" >
                                        </div>  
                                        <div class="form-group">
                                            <label> Address </label>
                                            <input type="text" name="centreAddress" id="centreAddress" class="form-control" placeholder="Address">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Name </label>
                                            <input type="text" name="centreName" id="centreName" class="form-control" placeholder="Centre Name" >
                                        </div> 
                                        <div class="form-group">
                                            <label> Organization Description </label>
                                            <input type="text" name="orgDesc" id="orgDesc" class="form-control" placeholder="Organisation Description" >
                                        </div> 
                                        <div class="form-group">
                                            <label> Contact Number </label>
                                            <input type="text" name="contactNum" id="contactNum" class="form-control" placeholder="Contact Number">
                                        </div>
                                        <div class="form-group">
                                            <label> Website </label>
                                            <input type="text" name="centreWeb" id="centreWeb" class="form-control" placeholder="Website URL">
                                        </div>
                                        <div class="form-group">
                                            <label> Postal Code </label>
                                            <input type="text" name="postalCode" id="postalCode" class="form-control" placeholder="Postal Code" >
                                        </div>        
                                    </div>
                                </div>
                            </div>
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Service Information</h4>
                            </div>
                            <div class="modal-body ">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Infant </label>
                                            <select name="infantVac" id="infantVac" class="form-control" placeholder="Infant Vacancy">
                                                <option value="Immediate">Immediate</option>
                                                <option value="Within 1 Year">Within 1 Year</option>
                                                <option value="More than 1 Year<">More than 1 Year</option>
                                                <option value="na">na</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label> Nursery 1 </label>
                                            <select name="n1Vac" id="n1Vac" class="form-control" placeholder="Nursery-1 Vacancy">
                                                <option value="Immediate">Immediate</option>
                                                <option value="Within 1 Year">Within 1 Year</option>
                                                <option value="More than 1 Year<">More than 1 Year</option>
                                                <option value="na">na</option>
                                            </select>
                                        </div> 
                                        <div class="form-group">
                                            <label> Kindergartens  1 </label>
                                            <select name="k1Vac" id="k1Vac" class="form-control" placeholder="Kindergartens-1 Vacancy">
                                                <option value="Immediate">Immediate</option>
                                                <option value="Within 1 Year">Within 1 Year</option>
                                                <option value="More than 1 Year<">More than 1 Year</option>
                                                <option value="na">na</option>
                                            </select>
                                        </div>                                         
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Playgroup </label>
                                            <select name="pgVac" id="pgVac" class="form-control" placeholder="Pg Vacancy">
                                                <option value="Immediate">Immediate</option>
                                                <option value="Within 1 Year">Within 1 Year</option>
                                                <option value="More than 1 Year<">More than 1 Year</option>
                                                <option value="na">na</option>
                                            </select>
                                        </div> 
                                        <div class="form-group">
                                            <label> Nursery 2 </label>
                                            <select name="n2Vac" id="n2Vac" class="form-control" placeholder="Nursery-2 Vacancy">
                                                <option value="Immediate">Immediate</option>
                                                <option value="Within 1 Year">Within 1 Year</option>
                                                <option value="More than 1 Year<">More than 1 Year</option>
                                                <option value="na">na</option>
                                            </select>
                                        </div>     
                                        <div class="form-group">
                                            <label> Kindergartens  2 </label>
                                            <select name="k2Vac" id="k2Vac" class="form-control" placeholder="Kindergartens-2 Vacancy">
                                                <option value="Immediate">Immediate</option>
                                                <option value="Within 1 Year">Within 1 Year</option>
                                                <option value="More than 1 Year<">More than 1 Year</option>
                                                <option value="na">na</option>
                                            </select>
                                        </div> 
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label> Food Offered </label>
                                            <input type="text" name="fdOffer" id="fdOffer" class="form-control" placeholder="Food Offered">
                                        </div> 
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Second Languages Offfered </label>
                                            <input type="text" name="secLang" id="secLang" class="form-control" placeholder="Second Languages Offfere">
                                        </div>
                                        <div class="form-group">
                                            <label> Weekday Full Day </label>
                                            <input type="text" name="wkFullDay" id="wkFullDay" class="form-control" placeholder="Weekday Full Day">
                                        </div> 
                                        <div class="form-group">
                                            <label> Scheme Type </label>
                                            <select name="schemeType" id="schemeType" class="form-control" placeholder="Scheme Type">
                                                <option value="Anchor Operator Scheme">Anchor Operator Scheme</option>
                                                <option value="Partner Operator Scheme">Partner Operator Scheme</option>
                                                <option value="na">na</option>
                                            </select>
                                        </div>  
                                        <div class="form-group">
                                            <label> Government Subsidy </label>
                                            <select name="govSub" id="govSub" class="form-control" placeholder="Government Subsidy">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div> 
                                        <div class="form-group"> 
                                            <label> Provision Of Transport </label>
                                            <select name="proTransport" id="proTransport" class="form-control" placeholder="Provision Of Transport">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div> 
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Spark Certified </label>
                                            <select name="sparkCert" id="sparkCert" class="form-control" placeholder="Spark Certified">>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                             </select>
                                        </div> 
                                        <div class="form-group">
                                            <label> Saturday </label>
                                            <input type="text" name="saturday" id="saturday" class="form-control" placeholder="Saturday">
                                        </div>     
                                        <div class="form-group">
                                            <label> Extended Operating Hours </label>
                                            <select name="extendOpt" id="extendOpt" class="form-control" placeholder="Extended Operating Hours">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            
                                        </div> 
                                        <div class="form-group">
                                            <label> GST Regisration </label>
                                            <select name="gstReg" id="gstReg" class="form-control" placeholder="GST Regisration">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                             </select>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-dark" name="deletebutton">Delete</button>
                                <button type="submit" class="btn btn-dark" name="updatebutton">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- View Catering Details Modal -->
            <div class="modal fade" id="createCatering" tab-index="-1" role="dialog" aria-labelledby="viewCaterinngDetails" aria-hidden="true">
            
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Create Centre Information</h4>
                        </div>
                        <form action="process_createCentre.php" method="POST">
                            <div class="modal-body ">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="hidden" name="customerID" id="customerID" class="form-control" placeholder="Customer ID" readonly>
                                        <div class="form-group">
                                            <label> Centre Code </label>
                                            <input type="text" name="centreCode" id="centreCode" class="form-control" placeholder="Centre Code">
                                        </div>
                                        <div class="form-group">
                                            <label> Organization Code </label>
                                            <input type="text" name="orgCode" id="orgCode" class="form-control" placeholder="Organisation Code">
                                        </div> 
                                        <div class="form-group">
                                            <label> Service Model </label>
                                            <input type="text" name="serviceModel" id="serviceModel" class="form-control" placeholder="Service Model" >
                                        </div> 
                                        <div class="form-group">
                                            <label> Email </label>
                                            <input type="text" name="emailAddress" id="emailAddress" class="form-control" placeholder="Email" >
                                        </div>  
                                        <div class="form-group">
                                            <label> Address </label>
                                            <input type="text" name="centreAddress" id="centreAddress" class="form-control" placeholder="Address">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Name </label>
                                            <input type="text" name="centreName" id="centreName" class="form-control" placeholder="Centre Name" >
                                        </div> 
                                        <div class="form-group">
                                            <label> Organization Description </label>
                                            <input type="text" name="orgDesc" id="orgDesc" class="form-control" placeholder="Organisation Description" >
                                        </div> 
                                        <div class="form-group">
                                            <label> Contact Number </label>
                                            <input type="text" name="contactNum" id="contactNum" class="form-control" placeholder="Contact Number">
                                        </div>
                                        <div class="form-group">
                                            <label> Website </label>
                                            <input type="text" name="centreWeb" id="centreWeb" class="form-control" placeholder="Website URL">
                                        </div>
                                        <div class="form-group">
                                            <label> Postal Code </label>
                                            <input type="text" name="postalCode" id="postalCode" class="form-control" placeholder="Postal Code" >
                                        </div>        
                                    </div>
                                </div>
                            </div>
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Service Information</h4>
                            </div>
                            <div class="modal-body ">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Infant </label>
                                            <select name="infantVac" id="infantVac" class="form-control" placeholder="Infant Vacancy">
                                                <option value="Immediate">Immediate</option>
                                                <option value="Within 1 Year">Within 1 Year</option>
                                                <option value="More than 1 Year<">More than 1 Year</option>
                                                <option value="na">na</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label> Nursery 1 </label>
                                            <select name="n1Vac" id="n1Vac" class="form-control" placeholder="Nursery-1 Vacancy">
                                                <option value="Immediate">Immediate</option>
                                                <option value="Within 1 Year">Within 1 Year</option>
                                                <option value="More than 1 Year<">More than 1 Year</option>
                                                <option value="na">na</option>
                                            </select>
                                        </div> 
                                        <div class="form-group">
                                            <label> Kindergartens  1 </label>
                                            <select name="k1Vac" id="k1Vac" class="form-control" placeholder="Kindergartens-1 Vacancy">
                                                <option value="Immediate">Immediate</option>
                                                <option value="Within 1 Year">Within 1 Year</option>
                                                <option value="More than 1 Year<">More than 1 Year</option>
                                                <option value="na">na</option>
                                            </select>
                                        </div>                                         
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Playgroup </label>
                                            <select name="pgVac" id="pgVac" class="form-control" placeholder="Pg Vacancy">
                                                <option value="Immediate">Immediate</option>
                                                <option value="Within 1 Year">Within 1 Year</option>
                                                <option value="More than 1 Year<">More than 1 Year</option>
                                                <option value="na">na</option>
                                            </select>
                                        </div> 
                                        <div class="form-group">
                                            <label> Nursery 2 </label>
                                            <select name="n2Vac" id="n2Vac" class="form-control" placeholder="Nursery-2 Vacancy">
                                                <option value="Immediate">Immediate</option>
                                                <option value="Within 1 Year">Within 1 Year</option>
                                                <option value="More than 1 Year<">More than 1 Year</option>
                                                <option value="na">na</option>
                                            </select>
                                        </div>     
                                        <div class="form-group">
                                            <label> Kindergartens  2 </label>
                                            <select name="k2Vac" id="k2Vac" class="form-control" placeholder="Kindergartens-2 Vacancy">
                                                <option value="Immediate">Immediate</option>
                                                <option value="Within 1 Year">Within 1 Year</option>
                                                <option value="More than 1 Year<">More than 1 Year</option>
                                                <option value="na">na</option>
                                            </select>
                                        </div> 
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label> Food Offered </label>
                                            <input type="text" name="fdOffer" id="fdOffer" class="form-control" placeholder="Food Offered">
                                        </div> 
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Second Languages Offfered </label>
                                            <input type="text" name="secLang" id="secLang" class="form-control" placeholder="Second Languages Offfere">
                                        </div>
                                        <div class="form-group">
                                            <label> Weekday Full Day </label>
                                            <input type="text" name="wkFullDay" id="wkFullDay" class="form-control" placeholder="Weekday Full Day">
                                        </div> 
                                        <div class="form-group">
                                            <label> Scheme Type </label>
                                            <select name="schemeType" id="schemeType" class="form-control" placeholder="Scheme Type">
                                                <option value="Anchor Operator Scheme">Anchor Operator Scheme</option>
                                                <option value="Partner Operator Scheme">Partner Operator Scheme</option>
                                                <option value="na">na</option>
                                            </select>
                                        </div>  
                                        <div class="form-group">
                                            <label> Government Subsidy </label>
                                            <select name="govSub" id="govSub" class="form-control" placeholder="Government Subsidy">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div> 
                                        <div class="form-group"> 
                                            <label> Provision Of Transport </label>
                                            <select name="proTransport" id="proTransport" class="form-control" placeholder="Provision Of Transport">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div> 
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Spark Certified </label>
                                            <select name="sparkCert" id="sparkCert" class="form-control" placeholder="Spark Certified">>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                             </select>
                                        </div> 
                                        <div class="form-group">
                                            <label> Saturday </label>
                                            <input type="text" name="saturday" id="saturday" class="form-control" placeholder="Saturday">
                                        </div>     
                                        <div class="form-group">
                                            <label> Extended Operating Hours </label>
                                            <select name="extendOpt" id="extendOpt" class="form-control" placeholder="Extended Operating Hours">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            
                                        </div> 
                                        <div class="form-group">
                                            <label> GST Regisration </label>
                                            <select name="gstReg" id="gstReg" class="form-control" placeholder="GST Regisration">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                             </select>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-dark" name="updatebutton">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- View Catering Details Modal -->
            <div class="modal fade" id="ConformationDelete" tab-index="-1" role="dialog" aria-labelledby="viewCaterinngDetails" aria-hidden="true">
            
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <form action="process_updatedetailsc.php" method="POST">
                            <div class="modal-body ">
                                <div class="row">
                                    <h2>Once is deleted, all information related to this centre will be removed.</h2>
                                    <div class="col-lg-6">
                                        <input type="hidden" name="customerID" id="customerID" class="form-control" placeholder="Customer ID" readonly>
                                        <div class="form-group">
                                            <label> Centre Code </label>
                                            <input type="text" name="centreCode" id="centreCode" class="form-control" placeholder="Centre Code" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label> Contact Number </label>
                                            <input type="text" name="contactNum" id="contactNum" class="form-control" placeholder="Organisation Code">
                                        </div> 
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label> Name </label>
                                            <input type="text" name="centreName" id="centreName" class="form-control" placeholder="Centre Name" readonly>
                                        </div> 
                                        <div class="form-group">
                                            <label> Address </label>
                                            <input type="text" name="centreAddress" id="centreAddress" class="form-control" placeholder="Organisation Description" >
                                        </div> 
                                      </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-dark" name="deletebutton">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <script>
                //To hide 'customer_id'
                $("td:nth-of-type(3)").hide();

                $(document).ready(function () {
                    $('.updatebtn').on('click', function () {
                        $('#updateCatering').modal('show');

                        $tr = $(this).closest('tr');

                        var data = $tr.children("td").map(function () {
                            return $(this).text();
                        }).get();

                        console.log(data);

                        $('#centreCode').val(data[1]);
                        $('#centreName').val(data[3]);
                        $('#orgCode').val(data[6]);
                        $('#orgDesc').val(data[7]);
                        $('#serviceModel').val(data[8]);
                        $('#contactNum').val(data[4]);
                        $('#emailAddress').val(data[9]);
                        $('#centreAddress').val(data[5]);
                        $('#postalCode').val(data[10]);
                        $('#centreWeb').val(data[11]);
                        $('#infantVac').val(data[12]);
                        $('#pgVac').val(data[13]);
                        $('#n1Vac').val(data[14]);
                        $('#n2Vac').val(data[15]);
                        $('#k1Vac').val(data[16]);
                        $('#k2Vac').val(data[17]);
                        $('#fdOffer').val(data[18]);
                        $('#secLang').val(data[19]);
                        $('#sparkCert').val(data[20]);
                        $('#wkFullDay').val(data[21]);
                        $('#saturday').val(data[22]);
                        $('#schemeType').val(data[23]);
                        $('#extendOpt').val(data[24]);
                        $('#proTransport').val(data[25]);
                        $('#govSub').val(data[26]);
                        $('#gstReg').val(data[27]);
                    });
                });
            $(document).ready(function () {
                    $('.createbtn').on('click', function () {
                        $('#createCatering').modal('show');

                        $tr = $(this).closest('tr');

                        var data = $tr.children("td").map(function () {
                            return $(this).text();
                        }).get();

                        console.log(data);

                        $('#centreCode').val(data[1]);
                        $('#centreName').val(data[3]);
                        $('#orgCode').val(data[6]);
                        $('#orgDesc').val(data[7]);
                        $('#serviceModel').val(data[8]);
                        $('#contactNum').val(data[4]);
                        $('#emailAddress').val(data[9]);
                        $('#centreAddress').val(data[5]);
                        $('#postalCode').val(data[10]);
                        $('#centreWeb').val(data[11]);
                        $('#infantVac').val(data[12]);
                        $('#pgVac').val(data[13]);
                        $('#n1Vac').val(data[14]);
                        $('#n2Vac').val(data[15]);
                        $('#k1Vac').val(data[16]);
                        $('#k2Vac').val(data[17]);
                        $('#fdOffer').val(data[18]);
                        $('#secLang').val(data[19]);
                        $('#sparkCert').val(data[20]);
                        $('#wkFullDay').val(data[21]);
                        $('#saturday').val(data[22]);
                        $('#schemeType').val(data[23]);
                        $('#extendOpt').val(data[24]);
                        $('#proTransport').val(data[25]);
                        $('#govSub').val(data[26]);
                        $('#gstReg').val(data[27]);
                    });
                });
                
          
            </script>

<?php
include 'adminFooter.inc.php';
?>

        </main>
    </body>


</html>
