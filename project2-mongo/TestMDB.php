<?php
require 'vendor/autoload.php';
require_once('../protected/configmdb.php');
//use MongoDB\Client as Mongo;
//
//$user = "root";
//$pwd = 'ict%402103mdb';
//
//$mongo = new Mongo("mongodb://$user:$pwd@dds-gs5174a84c2af8841124-pub.mongodb.singapore.rds.aliyuncs.com:3717,dds-gs5174a84c2af8842921-pub.mongodb.singapore.rds.aliyuncs.com:3717/alfredng_db?authSource=admin&replicaSet=mgset-303122826"); // connect to a remote host (default port: 27017)

                     //DB-NAME      //TABLE-NAME
$collection = $mongo->alfredng_db->govt_subsidies;

                     //QUERY
$result = $collection->find(); 
//
foreach ($result as $entry) {
                //THIS IS THE ATTRIBUTE
    echo ($entry['subsidy_category']. "<br/>");
}

//https://docs.mongodb.com/manual/reference/sql-comparison/
//THIS IS URL HOW TO QUERY

?>

