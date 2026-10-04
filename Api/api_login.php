<?php
include_once '../td_includes.php';

$_POST = json_decode(file_get_contents('php://input'), true);


if ($_POST['action'] == "login_user") {

	$userid = $_POST['userid'];
	$password = $_POST['password'];

	$data = $loginnew->login_user($userid, md5($password));
	if ($data) {
		if ($data == "Invalid Userid or Password") {
			$message = "Invalid Userid or Password.";
		} else {
			$_SESSION['userslug'] = $data;
			$message = "Success";
		}
	} else {
		$message = "Something went wrong. Please try after some time.";
	}



	$message = (object) $message;
	$json = json_encode($message);
	echo $json;


	

}

?>