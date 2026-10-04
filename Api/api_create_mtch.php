<?php
include_once '../td_includes.php';

$_POST = json_decode(file_get_contents('php://input'), true);




if ($_GET['action'] == "fetch_create_match") {

	$data = $creat_mtch->fetch_create_match();

	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}



if ($_POST['action'] == "mtch_delete") {

	$mtch_slug = $_POST['mtch_slug'];

	$data = $creat_mtch->mtch_delete($mtch_slug);

	if ($data) {
		$message = "Success";
	} else {
		$message = "Failed to delete player.";
	}

	//  echo json_encode((object)["scalar" => $message]);
	echo json_encode(["scalar" => $message]);
}



//  creat Match ka hai

if ($_POST['action'] == "create_new_match") {

	$mtch_name = $_POST['mtch_name'];
	$mtch_over = $_POST['mtch_over'];
	$mtch_place = $_POST['mtch_place'];
	$Each_team_pl = $_POST['Each_team_pl'];
	$mtch_date = time();

	$mtch_slug = md5(time());
	$data = $creat_mtch->create_new_match($mtch_name, $mtch_over, $mtch_place, $mtch_date, $Each_team_pl, $mtch_slug);

	if ($data) {
		if ($data == "Invalid Userid or Password") {
			$message = "Invalid Userid or Password.";
		} else {
			$message = "Success";
		}
	} else {
		$message = "Your Data Not Save in Database Error";
	}

	$message = (object) $message;
	$json = json_encode($message);
	echo $json;
}


if ($_GET['action'] == "fetch_title") {
	$m_slug = $_GET['m_slug'];
	$data = $creat_mtch->fetch_title($m_slug);

	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}


if ($_GET['action'] == "fetch_team_name") {
	$team_slug = $_GET['team_slug'];
	$data = $creat_mtch->fetch_team_name($team_slug);
	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}



//Team A or B ke player ka detail wala api

if ($_POST['action'] == "team_a_details") {
	$pl_slug = $_POST['pl_slug'];
	$item_pl_checked = $_POST['item_pl_checked'];
	$team_name_a = $_POST['team_name_a'];
	$mtch_slug = $_POST['mtch_slug'];

	$data = $creat_mtch->team_a_details($pl_slug, $item_pl_checked, $team_name_a, $mtch_slug);

	if ($data) {
		if ($data == "Invalid Userid or Password") {
			$message = "Invalid Userid or Password.";
		} else {
			$message = "Success";
		}
	} else {
		$message = "Your Data Not Save in Database Error";
	}

	$message = (object) $message;
	$json = json_encode($message);
	echo $json;
}

