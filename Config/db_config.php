<?php
define('DB_SERVER', 'mysql-db.cdcm0s2ye4a1.ap-south-1.rds.amazonaws.com');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'root123456');
define('DB_DATABASE', 'apna_structure');
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_DATABASE) or die(mysqli_connect_error());
mysqli_query ($db,"set character_set_results='utf8'");
?>
