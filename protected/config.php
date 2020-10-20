<?php
session_start();
define("DBHOST", "rm-gs595dd89hu8175hl6o.mysql.singapore.rds.aliyuncs.com");
define("DBNAME", "ICT2103_AY20_MySQL");
define("DBUSER", "ict1902691tlx");
define("DBPASS", "XLT1962091");

define('PAYPAL_ID', 'creole@business.example.com'); 
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 
 
//define('PAYPAL_RETURN_URL', 'http://localhost//Deliverable2/payment_return.php?success=1'); 
//define('PAYPAL_CANCEL_URL', 'http://localhost//Deliverable2/payment_return.php?success=0'); 

define('PAYPAL_RETURN_URL', 'http://47.74.213.30/AY19/p1-5/project2/payment_return.php?success=1'); 
define('PAYPAL_CANCEL_URL', 'http://47.74.213.30/AY19/p1-5/project2/payment_return.php?success=0'); 

define('PAYPAL_CURRENCY', 'SGD'); 

define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");