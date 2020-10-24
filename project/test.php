<?php
require_once('../protected/config.php');
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
$sqlQuery = "SELECT COUNT(DISTINCT centre_name), type_of_citizenship, AVG(fees)
FROM centre_service
WHERE fees IN (SELECT fees FROM centre_service)
GROUP BY type_of_citizenship
ORDER BY AVG(fees) ASC;"; 

$result = mysqli_query($conn, $sqlQuery);

$data = array();
foreach ($result as $row){
    $data[] = $row;
}

my_sqli_close($conn);

echo json_encode($data);

?>

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

