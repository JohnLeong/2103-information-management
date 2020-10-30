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
$centreAddress = sanitize_input($_POST["postalCode"]);
(int)$postalCode = sanitize_input($_POST["orgDesc"]);
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


//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($success) {
    createCentre();
    header("location: admin_centre.php");
    echo '<script>alert("Data has been updated successfully."); </script>';
} else {
    echo '<script>alert("Data update failed. Please try again."); </script>';
}

function createCentre() {

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
            $sql = "INSERT INTO `centre` (`tp_code`, `centre_code`, `centre_name`, `organisation_code`, `organisation_description`, `service_model`, `centre_contact_no`, "
                . "`centre_email_address`, `centre_address`, `postal_code`, `centre_website`, `infant_vacancy`, `pg_vacancy`, `n1_vacancy`, `n2_vacancy`, `k1_vacancy`,"
                . "`k2_vacancy`, `food_offered`, `second_languages_offered`, `spark_certified`, `weekday_full_day`, `saturday`, `scheme_type`, `extended_operating_hours`,"
                . "`provision_of_transport`, `government_subsidy`, `gst_registration`, `last_updated`) VALUES "
                . "('na', '$centreCode', '$centreName', '$orgCode', '$orgDesc', '$serviceModel', $contactNum, '$emailAddress', '$centreAddress', $postalCode, '$centreWeb', '$infantVac',"
                . "'$pgVac', '$n1Vac', '$n2Vac', '$k1Vac', '$k2Vac', '$fdOffer', '$secLang', '$sparkCert', '$wkFullDay', '$saturday', '$schemeType', '$extendOpt', '$proTransport',"
                . "'$govSub', '$gstReg', '2102-01-02')";
                 
            if (!$conn->query($sql)) {
                $errorMsg = "Database error: " . $conn->error;
                $success = false;
            }
        }
    }

    $conn->close();
}
?>