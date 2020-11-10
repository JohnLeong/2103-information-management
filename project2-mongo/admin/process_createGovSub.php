<?php
require_once('../../protected/config.php');

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
    createGovSub();
    header("location: admin_govSubsidy.php");
    echo '<script>alert("Data has been updated successfully."); </script>';
} else {
    echo '<script>alert("Data update failed. Please try again."); </script>';
}

function createGovSub() {

    if (isset($_POST['updatebutton'])) {
        $serviceType = sanitize_input($_POST["serviceType"]);
        $sCategory = sanitize_input($_POST["sCategory"]);
        (float)$totalFees = sanitize_input($_POST["totalFees"]);
        (float)$maxSubsidy = sanitize_input($_POST["maxSubsidy"]);
        (float)$lowSubsidy = sanitize_input($_POST["lowSubsidy"]);
        (float)$bSubsidy = sanitize_input($_POST["bSubsidy"]);
        (float)$maxFamilypay = sanitize_input($_POST["maxFamilypay"]);
        (float)$lowFamilypay = sanitize_input($_POST["lowFamilypay"]);
        (float)$Income = sanitize_input($_POST["Income"]);

        
        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } else {
            $sql = "INSERT INTO govt_subsidies (subsidy_category, monthly_income, service_type, total_fees, basic_subsidy,"
                    . "max_additional_subsidy, max_family_pays, low_additional_subsidy, low_family_pays) VALUES "
                    . "('$sCategory', $Income, '$serviceType', $totalFees, $bSubsidy, $maxSubsidy, $maxFamilypay, $lowSubsidy, $lowFamilypay)";

            if (!$conn->query($sql)) {
                $errorMsg = "Database error: " . $conn->error;
                $success = false;
            }
            $errorMsg = "Database error: " . $conn->error;
        }
    }

    $conn->close();
}
?>