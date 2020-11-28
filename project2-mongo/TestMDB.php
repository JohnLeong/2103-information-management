<?php
require 'vendor/autoload.php';
require_once('../protected/configmdb.php');
use MongoDB\BSON\Regex;
use MongoDB\BSON\Cursor;
use MongoDB\BSON\ObjectId;

//use MongoDB\Client as Mongo;
//
//$user = "root";
//$pwd = 'ict%402103mdb';
//
//$mongo = new Mongo("mongodb://$user:$pwd@dds-gs5174a84c2af8841124-pub.mongodb.singapore.rds.aliyuncs.com:3717,dds-gs5174a84c2af8842921-pub.mongodb.singapore.rds.aliyuncs.com:3717/alfredng_db?authSource=admin&replicaSet=mgset-303122826"); // connect to a remote host (default port: 27017)

                     //DB-NAME      //TABLE-NAME

//$collection = $mongo->alfredng_db->alfredtesting;
//
//$collection->drop();
//$collection->insertMany([
//    ["did" => "123456", "did_usage" => "1", "did_timestamp" => "15012"],
//    ["did" => "4567811", "did_usage" => "1", "did_timestamp" => "15013"],
//    ["did" => "46465464", "did_usage" => "2", "did_timestamp" => "15014"],
//    ["did" => "7894446", "did_usage" => "2", "did_timestamp" => "15015"],
//    ["did" => "65646131", "did_usage" => "3", "did_timestamp" => "15016"],
//    ["did" => "7989464", "did_usage" => "2", "did_timestamp" => "15017"],
//]);
//
//$cursor = $collection->aggregate([
//    ['$group' => ['_id' => '$did_usage', 'did_timestamp' => ['$min' => '$did_usage_timestamp']]],
//    ['$sample' => ['size' => 5]],
//]);
//
//foreach ($cursor as $entry) {
//    echo $entry['_id']."</br>";
//}

$collection = $mongo->alfredng_db->centre;

$cursor = $collection->aggregate([
    ['$group' => ['_id' => '$hdb_town',
    'list' => [
                '$push' => [
                    '_id' => '$_id', 
                    'centre_name' => '$centre_name'
                    
                ]
            ]]],
    ['$sort' => ['_id' => 1]]

//    ['$sample' => ['size' => 5]],
]);

foreach ($cursor as $doc)
{
    echo "HDB Area :". $doc['_id']." , Number :". count($doc['list']) ."</br>";

}//
foreach ($cursor as $entry) {

    
}

////$collection = $mongo->alfredng_db->centre;
//$result = $collection->find([ 'food_offered' => "na"], ['$sort' => array("centre_service" => array(['type_of_service' => 1]))]);
//
//foreach ($result as $entry) {
//    echo $entry['centre_name']."--------- Food Offered:".$entry['food_offered']. "</br>";
//    for ($i = 0; $i < count($entry['centre_service']); $i++) {
//        echo $entry['centre_service'][$i]['type_of_service']."</br>";
//    }
//}
    
//$deleteResult = $collection->updateOne(
//    array("centre_code" => "989"),
//    (array('$pull' => array("centre_subsidies" => array("subsidy_category" => "KS_A"))))
//);



//$length = count($result['centre_subsidies']);
//for ($i = 0; $i < $length; $i++) {
//    echo $result[0]['centre_subsidies'][0]['subsidy_category'];
//}
                     //QUERY
//$result = $collection->find(array("email" => "alfred@sit.com")); 
//foreach ($result as $entry) {
//    echo ($entry['centre_code']. "<br/>");
//    for ($i = 0; $i < count($entry['centre_service']); $i++){
//        echo ($i . ", ".$entry['centre_service'][$i]['class_of_licence']. ", ". 
//                $entry['centre_service'][$i]['type_of_service']. 
//                $entry['centre_service'][$i]['levels_offered'].
//                $entry['centre_service'][$i]['fees'].
//                $entry['centre_service'][$i]['type_of_citizenship'].
//                $entry['centre_service'][$i]['last_updated'].
//                $entry['centre_service'][$i]['remarks']. "<br/>");
//    }
//  
//                //THIS IS THE ATTRIBUTE
////    echo ($entry[0]['subsidy_category']. "<br/>");
//
////    echo ($entry['centre_subsidies'][0]['subsidy_category']. "<br/>");
//
//}


//https://docs.mongodb.com/manual/reference/sql-comparison/
//THIS IS URL HOW TO QUERY

?>

