<?php
session_start();
define("DBHOST", "161.117.122.252");
define("DBNAME", "p1_5");
define("DBUSER", "p1_5");
define("DBPASS", "96rjYQmInJ");

define('PAYPAL_ID', 'creole@business.example.com'); 
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 
 
//define('PAYPAL_RETURN_URL', 'http://localhost//Deliverable2/payment_return.php?success=1'); 
//define('PAYPAL_CANCEL_URL', 'http://localhost//Deliverable2/payment_return.php?success=0'); 

define('PAYPAL_RETURN_URL', 'http://47.74.213.30/AY19/p1-5/project2/payment_return.php?success=1'); 
define('PAYPAL_CANCEL_URL', 'http://47.74.213.30/AY19/p1-5/project2/payment_return.php?success=0'); 

define('PAYPAL_CURRENCY', 'SGD'); 

define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");