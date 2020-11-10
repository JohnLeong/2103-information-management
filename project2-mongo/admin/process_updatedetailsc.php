<?php
require_once('../../protected/config.php');

//Admin_Catering
$centreCode = $centreName = $orgCode = $orgDesc = $serviceModel = $contactNum = $emailAddress = 
        $centreAddress = $postalCode = $centreWeb = $pgVac = $infantVac = $n1Vac = $n2Vac = $k1Vac = $k2Vac = 
        $fdOffer = $secLang = $wkFullDay = $saturday = $schemeType = $extendOpt = $proTransport = $govSub = $gstReg = $sparkCert = "";

$success = true;

//Sanitize inputs
$centreCode = sanitize_input($_POST["centreCode"]);
$centreName = sanitize_input($_POST["centreName"]);
$orgCode = sanitize_input($_POST["orgCode"]);
$orgDesc = sanitize_input($_POST["orgDesc"]);
$serviceModel = sanitize_input($_POST["serviceModel"]);
(int)$contactNum = sanitize_input($_POST["contactNum"]);
$emailAddress = sanitize_input($_POST["emailAddress"]);
(int)$centreAddress = sanitize_input($_POST["postalCode"]);
$postalCode = sanitize_input($_POST["orgDesc"]);
$centreWeb = sanitize_input($_POST["centreWeb"]);
$infantVac = sanitize_input($_POST["infantVac"]);
$pgVac = sanitize_input($_POST["pgVac"]);
$n1Vac = sanitize_input($_POST["n1Vac"]);
$n2Vac = sanitize_input($_POST["n2Vac"]);
$k1Vac = sanitize_input($_POST["k1Vac"]);
$k2Vac = sanitize_input($_POST["k2Vac"]);
$fdOffer = sanitize_input($_POST["fdOffer"]);
$secLang = sanitize_input($_POST["secLang"]);
$sparkCert = sanitize_input($_POST["sparkCert"]);
$wkFullDay = sanitize_input($_POST["wkFullDay"]);
$saturday = sanitize_input($_POST["saturday"]);
$schemeType = sanitize_input($_POST["schemeType"]);
$extendOpt = sanitize_input($_POST["extendOpt"]);
$proTransport = sanitize_input($_POST["proTransport"]);
$govSub = sanitize_input($_POST["govSub"]);
$gstReg = sanitize_input($_POST["gstReg"]);

////Delivery Date
//if (empty($_POST["deliveryDate"])) {
//    $errorMsg .= "Delivery Date is required.";
//    $success = false;
//} else {
//    $deliveryDate = sanitize_input($_POST["deliveryDate"]);
//}

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($success) {
    updateReservation();
    header("location: admin_centre.php");
    echo '<script>alert("Data has been updated successfully."); </script>';
} else {
    echo '<script>alert("Data update failed. Please try again."); </script>';
}

function updateReservation() {

    if (isset($_POST['updatebutton'])) {
        $centreCode =  ($_POST["centreCode"]);
        $centreName =  ($_POST["centreName"]);
        $orgCode =  ($_POST["orgCode"]);
        $orgDesc =  ($_POST["orgDesc"]);
        $serviceModel =  ($_POST["serviceModel"]);
        $contactNum =  ($_POST["contactNum"]);
        $emailAddress =  ($_POST["emailAddress"]);
        $centreAddress =  ($_POST["centreAddress"]);
        $postalCode =  ($_POST["postalCode"]);
        $centreWeb =  ($_POST["centreWeb"]);
        $infantVac =  ($_POST["infantVac"]);
        $pgVac =  ($_POST["pgVac"]);
        $n1Vac =  ($_POST["n1Vac"]);
        $n2Vac =  ($_POST["n2Vac"]);
        $k1Vac =  ($_POST["k1Vac"]);
        $k2Vac =  ($_POST["k2Vac"]);
        $fdOffer =  ($_POST["fdOffer"]);
        $sparkCert = ($_POST["sparkCert"]);
        $secLang =  ($_POST["secLang"]);
        $wkFullDay =  ($_POST["wkFullDay"]);
        $saturday =  ($_POST["saturday"]);
        $schemeType =  ($_POST["schemeType"]);
        $extendOpt =  ($_POST["extendOpt"]);
        $proTransport =  ($_POST["proTransport"]);
        $govSub =  ($_POST["govSub"]);
        $gstReg =  ($_POST["gstReg"]);
        
        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } else {
            $sql = "UPDATE centre SET centre_name = '$centreName', organisation_code = '$orgCode', organisation_description = '$orgDesc', "
                    . "service_model = '$serviceModel', centre_contact_no = '$contactNum', centre_email_address = '$emailAddress', centre_address = '$centreAddress',"
                    . "postal_code = '$postalCode', centre_website = '$centreWeb', infant_vacancy = '$infantVac', pg_vacancy = '$pgVac', "
                    . "n1_vacancy = '$n1Vac', n2_vacancy = '$n2Vac', k1_vacancy = '$k1Vac', k2_vacancy = '$k2Vac', "
                    . "food_offered = '$fdOffer', second_languages_offered = '$secLang', spark_certified = '$sparkCert', weekday_full_day = '$wkFullDay', "
                    . "saturday = '$saturday', scheme_type = '$schemeType', extended_operating_hours = '$extendOpt', provision_of_transport = '$proTransport', "
                    . "government_subsidy = '$govSub', gst_registration = '$gstReg' WHERE centre_code = '$centreCode'";
            
            if (!$conn->query($sql)) {
                $errorMsg = "Database error: " . $conn->error;
                $success = false;
            }
        }
    }
    
        if (isset($_POST['deletebutton'])) {
        $centreCode =  ($_POST["centreCode"]);
             
        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } else {
            $sql1 = "DELETE FROM incidental_charge where (centre_code = '$centreCode');";
            $sql2 = "DELETE FROM centre_subsidies where (centre_code = '$centreCode');";
            $sql3 = "DELETE FROM centre_service where (centre_code = '$centreCode');";
            $sql4 = "DELETE FROM centre where (centre_code = '$centreCode');";
            
            
            if (!$conn->query($sql1)) {
                $errorMsg = "Database error: " . $conn->error;
                $success = false;
            }
            if (!$conn->query($sql2)) {
                $errorMsg = "Database error: " . $conn->error;
                $success = false;
            }
            if (!$conn->query($sql3)) {
                $errorMsg = "Database error: " . $conn->error;
                $success = false;
            }
            if (!$conn->query($sql4)) {
                $errorMsg = "Database error: " . $conn->error;
                $success = false;
            }
             
        }
    }

    $conn->close();
}
?>