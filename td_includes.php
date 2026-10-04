<?php
header('Access-Control-Allow-Origin: *');
ob_start("ob_gzhandler");
error_reporting(1);
date_default_timezone_set("Asia/Kolkata");
session_start();

//config Files
include_once 'Config/db_config.php';
include_once 'Config/general_config.php';
include_once 'Controller/td_controller.php';

// login
include_once 'Controller/controller_signin.php';
include_once 'Controller/sstc_controller.php';

// login object
$login = new loginController($db);
$sstc_obj = new sstcController($db);

if (isset($_SESSION['userslug'])) {

	$userslug = $_SESSION['userslug'];
}
