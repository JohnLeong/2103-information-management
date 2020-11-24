<?php
use MongoDB\BSON\Regex;
require '../vendor/autoload.php';
require_once('../../protected/configmdb.php');

//Admin_Catering
$centreCode = $class_Lic = $sCategory = "";

$success = true;

//Sanitize inputs centreName
$centreCode = sanitize_input($_POST["centreCode"]);
$centreName = sanitize_input($_POST["centreName"]);
$sCategory = sanitize_input($_POST["sCategory"]);

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
        $insertOneResult  = $collection->updateOne([ 'centre_code' => $centreCode], (array('$push' => array("centre_subsidies" => array("subsidy_category" => $sCategory)))));
//        $insertOneResult  = $collection->updateOne([ 'centre_code' => $centreCode, 'centre_subsidies' ], array('$push' => array('subsidy_category' => $sCategory)));

//        $answers->update(array('userId' => 1, 'questions.questionId' => '1'), array('$push' => array('questions.$.ans' => 'try2')));        
     }
    header("location: admin_centreServicesDt.php");
    echo '<script>alert("Data has been create successfully."); </script>';
} else {
    echo '<script>alert("Data update failed. Please try again."); </script>';
}

?>