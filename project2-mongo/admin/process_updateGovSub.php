<?php

use MongoDB\BSON\Regex;
require '../vendor/autoload.php';
require_once('../../protected/configmdb.php');

//Admin_Catering
$serviceType = $sCategory = $totalFees = $maxSubsidy = $lowSubsidy = $bSubsidy = $maxFamilypay = 
        $lowFamilypay = "";

$success = true;

//Sanitize inputs
$serviceType = sanitize_input($_POST["serviceType"]);
$sCategory = sanitize_input($_POST["sCategory"]);
(int)$totalFees = sanitize_input($_POST["totalFees"]);
(int)$maxSubsidy = sanitize_input($_POST["maxSubsidy"]);
(int)$lowSubsidy = sanitize_input($_POST["lowSubsidy"]);
(int)$bSubsidy = sanitize_input($_POST["bSubsidy"]);
(int)$maxFamilypay = sanitize_input($_POST["maxFamilypay"]);
(int)$lowFamilypay = sanitize_input($_POST["lowFamilypay"]);
(int)$Income = sanitize_input($_POST["Income"]);


//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($success) {
    if (isset($_POST['updatebutton'])) {
        $collection = $mongo->alfredng_db->govt_subsidies;
        
        $result = $collection->updateOne([ 'subsidy_category' =>  $sCategory],[ '$set' => 
            [ 'monthly_income' => $Income, 'service_type' => $serviceType, 'total_fees' => $totalFees, 'basic_subsidy' => $bSubsidy, 'max_additional_subsidy' => $maxSubsidy,
            'max_family_pays' => $maxFamilypay, 'low_additional_subsidy' => $lowSubsidy, 'low_family_pays' => $lowFamilypay ]]);
        
    }
    if (isset($_POST['deletebutton'])) {
        $collection = $mongo->alfredng_db->govt_subsidies;
            $deleteResult = $collection->deleteOne(['subsidy_category' => $sCategory]);
    }
    header("location: admin_govSubsidy.php");
    echo '<script>alert("Data has been updated successfully."); </script>';
} else {
    echo '<script>alert("Data update failed. Please try again."); </script>';
}
   
  

?>