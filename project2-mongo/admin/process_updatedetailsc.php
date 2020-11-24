<?php
use MongoDB\BSON\Regex;
require '../vendor/autoload.php';
require_once('../../protected/configmdb.php');


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
    if (isset($_POST['updatebutton'])) {
        $collection = $mongo->alfredng_db->centre;
        $result = $collection->updateOne([ 'centre_code' =>  $centreCode],[ '$set' => 
            [ 'centre_name' => $centreName, 'organisation_code' => $orgCode, 'organisation_description' => $orgDesc, 
                'service_model' => $serviceModel, 'centre_contact_no' => $contactNum, 'centre_email_address' => $emailAddress,
                'postal_code' => $postalCode, 'centre_website' => $centreWeb, 'infant_vacancy' => $infantVac, 
                'pg_vacancy' => $pgVac, 'food_offered' => $fdOffer, 'second_languages_offered' => $secLang, 
                'spark_certified' => $sparkCert, 'weekday_full_day' => $wkFullDay, 'saturday' => $saturday, 
                'scheme_type' => $schemeType, 'extended_operating_hours' => $extendOpt, 'provision_of_transport' => $proTransport, 
                'government_subsidy' => $govSub, 'gst_registration' => $gstReg ]]);
    }   
    if (isset($_POST['deletebutton'])) {
        $collection = $mongo->alfredng_db->centre;
        $deleteResult = $collection->deleteOne(['centre_code' => $centreCode]);
//        $deleteResult->getDeletedCount();
    }

    header("location: admin_centre.php");
    echo '<script>alert("Data has been updated successfully."); </script>';
} else {
    echo '<script>alert("Data update failed. Please try again."); </script>';
}

?>