<?php
include_once '../td_includes.php';

$_POST = json_decode(file_get_contents('php://input'), true);

if ($_GET['action'] == "fetch_all_player") {

	$data = $all_player_info->fetch_all_player();

	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}



if ($_GET['action'] == "fetch_player_info") {
    // echo"pali";die;
	$pl_slug = $_GET['pl_slug'];

	$data = $all_player_info->fetch_player_info($pl_slug);

	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}

if ($_GET['action'] == "Check") {

	$pl_naam = $_GET['pl_naam'];
	$pl_sstatus = $_GET['pl_sstatus'];

	$data = $all_player_info->filter_name($pl_naam, $pl_sstatus);

	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}










?>