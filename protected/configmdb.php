<?php
//require 'vendor/autoload.php';

use MongoDB\Client as Mongo;

$user = "root";
$pwd = 'ict%402103mdb';

$mongo = new Mongo("mongodb://$user:$pwd@dds-gs5174a84c2af8841124-pub.mongodb.singapore.rds.aliyuncs.com:3717,dds-gs5174a84c2af8842921-pub.mongodb.singapore.rds.aliyuncs.com:3717/alfredng_db?authSource=admin&replicaSet=mgset-303122826"); // connect to a remote host (default port: 27017)

//$collection = $mongo->alfredng_db->govt_subsidies;

//echo "Database alfredng_db selected";
?>

