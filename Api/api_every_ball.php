<?php
include_once '../td_includes.php';

$_POST = json_decode(file_get_contents('php://input'), true);




//delete ka hai---
if ($_POST['action'] == "delete_player") {

	$id = $_POST['id'];  // left:$id for controller parameter = right:id arrive frome js .

	$data = $every_balls->delete_player($id);  // $every_balls object se delete_player($id); call. 

	if ($data) {
		$message = "Success";
	} else {
		$message = "Failed to delete player.";
	}

	//  echo json_encode((object)["scalar" => $message]);
	echo json_encode(["scalar" => $message]);
}



// if ($_GET['action'] == "Check") {

// 	$pl_naam = $_GET['pl_naam'];
// 	$pl_sstatus = $_GET['pl_sstatus'];

// 	$data = $every_balls->filter_name($pl_naam, $pl_sstatus);

// 	if ($data) {
// 		$data = (object) $data;
// 		$json = json_encode($data);
// 		echo $json;
// 	} else {
// 		echo "Invalid request";
// 	}
// }





// //Team A or B ke player ka detail wala api

// if ($_POST['action'] == "team_a_details") {
// 	$pl_slug = $_POST['pl_slug'];
// 	$item_pl_checked = $_POST['item_pl_checked'];
// 	$team_name_a = $_POST['team_name_a'];
// 	$mtch_slug = $_POST['mtch_slug'];

// 	$data = $every_balls->team_a_details($pl_slug, $item_pl_checked, $team_name_a, $mtch_slug);

// 	if ($data) {
// 		if ($data == "Invalid Userid or Password") {
// 			$message = "Invalid Userid or Password.";
// 		} else {
// 			$message = "Success";
// 		}
// 	} else {
// 		$message = "Your Data Not Save in Database Error";
// 	}

// 	$message = (object) $message;
// 	$json = json_encode($message);
// 	echo $json;
// }

// **********************************

if ($_GET['action'] == "fetch_toss_win") {
	$toss_slug = $_GET['toss_slug'];
	$data = $every_balls->fetch_toss_win($toss_slug);

	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}



if ($_GET['action'] == "select_batting_call") {
	if (isset($_GET['team']) && isset($_GET['slug'])) {
		$team = $_GET['team'];  // india
		$slug = $_GET['slug'];  // 2a73c1...

		// controller call
		$data = $every_balls->select_batting_call($team, $slug);  // returns array

		$data = (object) $data;
		// echo json_encode($data);  // yahi bhej diya jaata hai API se
		$json = json_encode($data);
		echo $json;
	} else {
		echo json_encode(["error" => "Missing parameters team or slug"]);
	}
}
// ***************************************************
// ************** Loss Toss name send Api ********************************

if ($_GET['action'] == "fetch_bowling_team") {
	if (isset($_GET['team']) && isset($_GET['slug'])) {
		$team = $_GET['team'];  // india
		$slug = $_GET['slug'];  // 2a73c1...

		// controller call
		$data = $every_balls->fetch_bowling_team($team, $slug);  // returns array

		echo json_encode($data);  // yahi bhej diya jaata hai API se

	} else {
		echo json_encode(["error" => "Missing parameters team or slug"]);
	}
}



// ***********************************
// if ($_GET['action'] == "fetch_title") {
// 	$m_slug = $_GET['m_slug'];
// 	$data = $every_balls->fetch_title($m_slug);

// 	if ($data) {
// 		$data = (object) $data;
// 		$json = json_encode($data);
// 		echo $json;
// 	} else {
// 		echo "Invalid request";
// 	}
// }


if ($_GET['action'] == "fetch_all_player") {

	$data = $every_balls->fetch_all_player();

	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}





// if ($_GET['action'] == "fetch_team_name") {
// 	$team_slug = $_GET['team_slug'];
// 	$data = $every_balls->fetch_team_name($team_slug);

// 	if ($data) {
// 		$data = (object) $data;
// 		$json = json_encode($data);
// 		echo $json;
// 	} else {
// 		echo "Invalid request";
// 	}
// }




if ($_GET['action'] == "fetch_Notout_pl") {
	$mtch_slug = $_GET['mtch_slug'];
	$batting_team = $_GET['batting_team'];

	// echo "1298_".$mtch_slug; exit;
	$data = $every_balls->fetch_Notout_pl($mtch_slug, $batting_team);

	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}





if ($_GET['action'] == "fetch_mtch_status") {

	$m_slug = $_GET['mtch_slug'];

	$data = $every_balls->fetch_mtch_status($m_slug);

	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}




if ($_POST['action'] == "update_player_detail") {
	$id = $_POST['id'];
	$pl_name = $_POST['pl_name'];
	$pl_status = $_POST['pl_status'];
	$pl_age = $_POST['pl_age'];
	$pl_city = $_POST['pl_city'];
	$pl_number = $_POST['pl_number'];

	$data = $every_balls->update_player_detail($id, $pl_name, $pl_status, $pl_age, $pl_city, $pl_number);

	$message = $data ? "Success" : "Failed to update data.";
	echo json_encode((object)$message);
}






if ($_POST['action'] == "Done_inning_info") {

	$selected_toss = $_POST['selected_toss'];
	$batting_team = $_POST['batting_team'];
	$striker = $_POST['striker'];
	$non_striker = $_POST['non_striker'];
	$bowler = $_POST['bowler'];
	$mt_slug = $_POST['mt_slug'];
	$bowling_team = $_POST['bowling_team'];
	$mtch_inining = $_POST['mtch_inining'];


	//   echo "Match Slug: ".$bowling_team; 
	//   exit; 
	$data = $every_balls->Done_inning_info($selected_toss, $batting_team, $striker, $non_striker, $bowler, $mt_slug, $bowling_team, $mtch_inining);

	if ($data) {
		if ($data == "undefine") {
			$message = "Api Done_inning_info eroor";
		} else {
			$message = "Success";
		}
	} else {
		$message = "Api Done_inning_info eroor";
	}

	$message = (object) $message;
	$json = json_encode($message);
	echo $json;
}





if ($_POST['action'] == "send_next_bowler") {

	$next_bowler = $_POST['next_bowler'];
	$mtc_slug = $_POST['mtc_slug'];

	$data = $every_balls->send_next_bowler($next_bowler, $mtc_slug);

	if ($data) {
		if ($data == "undefine") {
			$message = "Api send_next_bowler eroor";
		} else {
			$message = "Success";
		}
	} else {
		$message = "Api next_bowler eroor";
	}

	$message = (object) $message;
	$json = json_encode($message);
	echo $json;
}





if ($_POST['action'] == "send_wicket_detail") {

	$wicket_by = $_POST['wicket_by'];
	$out_batsman = $_POST['out_batsman'];
	$neww_batsman = $_POST['neww_batsman'];
	$wicktype = $_POST['wicktype'];

	$run = $_POST['run'];
	$ball = $_POST['ballNumber'];
	$batsman = $_POST['batsman'];
	$mtc_slug = $_POST['mt_slug'];
	$bowler = $_POST['bowler'];
	$current_over = $_POST['current_over'];

	$mtch_inining = $_POST['mtch_inining'];
	$bowling_team_updt = $_POST['bowling_team_updt'];
	$non_striker_updt = $_POST['non_striker_updt'];
	$batting_team_updt = $_POST['batting_team_updt'];
	$selected_toss_updt = $_POST['selected_toss_updt'];
	$stker_non_striker = $_POST['stker_non_striker'];
	$st_val = $_POST['st_val'];

	$wick_slug = md5(time());

	//    echo " 359 mt_slug_received=" .$wicktype,"=+=",$out_batsman,"=+=",$wicket_by,"=",$stker_non_striker;
	//    die;

	if ($stker_non_striker == "non_strike_liya") {

		if ($st_val == "nonSt_out") {
			// echo "==1";
			$data3 = $every_balls->update_inining_nonstrike($mtc_slug, $selected_toss_updt, $bowling_team_updt, $batting_team_updt, $neww_batsman, $non_striker_updt, $bowler, $mtch_inining, $batsman);
		} else {
			// echo "==2";
			$data3 = $every_balls->update_inining_nonstrike_two($mtc_slug, $selected_toss_updt, $bowling_team_updt, $batting_team_updt, $neww_batsman, $non_striker_updt, $bowler, $mtch_inining, $batsman);
		}
	} else if ($stker_non_striker == "Strike_liya") {

		if ($st_val == "St_out") {
			// echo "==3";
			$data3 = $every_balls->update_inining($mtc_slug, $selected_toss_updt, $bowling_team_updt, $batting_team_updt, $neww_batsman, $non_striker_updt, $bowler, $mtch_inining, $batsman);
		} else {
			// echo "==4";
			$data3 = $every_balls->update_inining_four($mtc_slug, $selected_toss_updt, $bowling_team_updt, $batting_team_updt, $neww_batsman, $non_striker_updt, $bowler, $mtch_inining, $batsman);
		}
	} else {

		$data4 = $every_balls->update_inining_normal_wk($mtc_slug, $selected_toss_updt, $bowling_team_updt, $batting_team_updt, $neww_batsman, $non_striker_updt, $bowler, $mtch_inining);
	}






	$data = $every_balls->every_ball_data_send($ball, $run, $batsman, $mtc_slug, $bowler, $current_over, $mtch_inining, $wick_slug); // is wale function me ball,run,mtch slug sab kuchh entery hona chahiye,view se lana hai,agar nhi aaya tab controller se lana hai,fir  
	//    echo " 388 api  batsman=" .$run,"_",$batsman; die;
	$data2 = $every_balls->send_wicket_detail($mtc_slug, $wicket_by, $out_batsman, $neww_batsman, $wicktype, $wick_slug); // data 2 aur data, me wick_slug same rhega,run out hone par send_wicket_detail pura fill hona chahiye, aur ball, run inning sabhi fill hona chahiye.
	// $data3 = $every_balls->check_nb($mtc_slug,$ball,$mtch_inining,$current_over); // data 2 aur data, me wick_slug same rhega,run out hone par send_wicket_detail pura fill hona chahiye, aur ball, run inning sabhi fill hona chahiye.





	// $data3 = $every_balls->update_inining($mtc_slug,$selected_toss_updt,$bowling_team_updt,$batting_team_updt,$neww_batsman,$non_striker_updt,$bowler,$mtch_inining); 

	if ($data) {
		if ($data == "null") {
			$message = "Api error";
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


if ($_POST['action'] == "every_ball_data_send") {

	$ball = $_POST['ball'];
	$run = $_POST['run'];
	$batsman = $_POST['batsman'];
	$mtc_slug = $_POST['mt_slug'];
	$bowler = $_POST['bowler'];
	$current_over = $_POST['current_over'];
	$mtch_over = $_POST['mtch_over'];
	$mtch_inining = $_POST['mtch_inining'];
	$wick_slug = $_POST[''];

	// echo "596 = " . $ball . $current_over . $mtch_over . $mtch_inining;

	if ($ball >= 1 && $ball <= 6 && $current_over >= $mtch_over  && $mtch_inining >= 2) {
		$message = "complete";
	} else {

		$data = $every_balls->every_ball_data_send($ball, $run, $batsman, $mtc_slug, $bowler, $current_over, $mtch_inining, $wick_slug);
		// echo "425 wick_slug".$wick_slug;die;
		if ($data) {
			if ($data == "null") {
				$message = "Api error";
			} else {

				$message = "Success";
			}
		} else {
			$message = "Your Data Not Save in Database Error";
		}
	}

	$message = (object) $message;
	$json = json_encode($message);
	echo $json;
}



if ($_POST['action'] == "ining_update") {

	$m_inining = $_POST['m_inining'];
	$batt_team = $_POST['batt_team'];
	$mtch_slug = $_POST['mtch_slug'];
	$bowl_team = $_POST['bowl_team'];


	$data = $every_balls->ining_update($m_inining, $batt_team, $mtch_slug, $bowl_team);

	if ($data) {
		if ($data == "null") {
			$message = "Api error";
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


if ($_GET['action'] == "row_data_fetch") {
	$mtch_slug = $_GET['mtch_slug'];
	$data = $every_balls->row_data_fetch($mtch_slug);

	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}




if ($_GET['action'] == "fetch_nb_check") {
	$toss_slug = $_GET['toss_slug'];
	$mtch_ininig = $_GET['mtch_ininig'];

	$data = $every_balls->fetch_nb_check($toss_slug, $mtch_ininig);

	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}







if ($_GET['action'] == "row_data_fetch_innings_two") {
	$mtch_slug = $_GET['mtch_slug'];
	$data = $every_balls->row_data_fetch_innings_two($mtch_slug);

	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}


if ($_GET['action'] == "fetch_inning_info") {
	$mtch_slug = $_GET['mtch_slug'];
	//    echo "1298_".$mtch_slug; exit;
	$data = $every_balls->fetch_inning_info($mtch_slug);
	// echo "<pre>";
	// print_r($data);
	// echo "</pre>";
	// die;

	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}


if ($_GET['action'] == "fetch_inning_zero_leval") {
	$mtch_slug = $_GET['mtch_slug'];

	$data = $every_balls->fetch_inning_zero_leval($mtch_slug);
	// echo "<pre>";
	// print_r($data);
	// echo "</pre>";
	// die;

	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}















if ($_GET['action'] == "ball_over_fetch") {
	$mtch_slug = $_GET['mtch_slug'];
	$data = $every_balls->ball_over_fetch($mtch_slug);


	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}


if ($_GET['action'] == "skip_extra_ball") {
	$mtch_slug = $_GET['mtch_slug'];
	$data = $every_balls->skip_extra_ball($mtch_slug);

	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}


// <!-- *************************************************************************** -->


if ($_GET['action'] == "fetch_batsman_run") {
	$mt_slug = $_GET['mtch_slug'];
	$mtch_inining = $_GET['mtch_inining'];

	//    echo "1298_".$mt_slug; exit;

	$data = $every_balls->fetch_batsman_run($mt_slug, $mtch_inining);

	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}



if ($_GET['action'] == "fetch_team_run") {

	$mt_slug = $_GET['mtch_slug'];
	$mtch_inining = $_GET['mtch_inining'];

	$data = $every_balls->fetch_team_run($mt_slug, $mtch_inining);

	// bas number bhejna
	echo json_encode(['total_run' => $data]);
	exit;
}



if ($_GET['action'] == "fetch_all_inining_run") {

	$mt_slug = $_GET['mtch_slug'];

	$data = $every_balls->fetch_all_inining_run($mt_slug);

	// Default Response
	$response = ['total_run' => $data];

	// Check if both innings exist (1 and 2)
	if (isset($data[1]) && isset($data[2])) {

		$first_inning  = intval($data[1]);
		$second_inning = intval($data[2]);

		if ($second_inning > $first_inning) {
			$response['message'] = "Chasing Team Win";
		} elseif ($second_inning == $first_inning) {
			$response['message'] = "Match Tied";
		} else {
			$response['message'] = "Defending Team Ahead";
		}
	}

	echo json_encode($response);
	exit;
}






if ($_POST['action'] == "ining_st_nst_updt") {

	$currentStriker_new = $_POST['currentStriker_new'];
	$currentNonStriker_new = $_POST['currentNonStriker_new'];
	$mt_slug = $_POST['mt_slug'];


	$data = $every_balls->ining_st_nst_updt($currentStriker_new, $currentNonStriker_new, $mt_slug);
	// echo "425 wick_slug".$wick_slug;die;
	if ($data) {
		$message = "Success";
	} else {
		$message = "Your Data Not Save in Database Error";
	}

	$message = (object) $message;
	$json = json_encode($message);
	echo $json;
}

//*******************************************  View Match Detail ka hai ***************************************************** */

if ($_GET['action'] == "match_batter_detail") {
	$mtch_slug = $_GET['mtch_slugg'];

	$data = $every_balls->match_batter_detail($mtch_slug);

	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}


if ($_GET['action'] == "match_bowler_detail") {
	$mtch_slug = $_GET['mtch_slugg'];

	$data = $every_balls->match_bowler_detail($mtch_slug);

	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}

if ($_POST['action'] == "mtch_status") {

	$mtt_slug = $_POST['mtt_slug'];
	$m_status = $_POST['m_status'];

	// echo "Newapi=".$mtt_slug."=".$m_status;


	$data = $every_balls->mtch_status($mtt_slug, $m_status);

	if ($data) {
		$message = "Success";
	} else {
		$message = "error";
	}
	$message = (object) $message;
	$json = json_encode($message);
	echo $json;
}

if ($_POST['action'] == "submit") {

	$Client_name = $_POST['Client_name'];
	$pt_name = $_POST['pt_name'];
	$refdoctor = $_POST['refdoctor'];
	$DOB = $_POST['DOB'];
	$bill_number = $_POST['bill_number'];
	$bill_date_time = $_POST['bill_date_time'];
	$mobile = $_POST['mobile'];
	$Receipt = $_POST['Receipt'];
	
	$Test_name = $_POST['Test_name'];

	$submit_slug = md5(time());

	$data = $every_balls->submit($Client_name, $pt_name, $refdoctor, $DOB, $bill_number, $bill_date_time, $mobile, $Receipt, $Test_name, $submit_slug);
	$data1 = $every_balls->submit_test($Test_name, $submit_slug);


	if ($data) {
		$message = "Success";
	} else {
		$message = "error";
	}

	$message = (object) $message;
	$json = json_encode($message);
	echo $json;
}


if ($_GET['action'] == "fetch_bill") {

	$data = $every_balls->fetch_bill();

	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}


if ($_GET['action'] == "fetch_test_name") {
	$pg_slug = $_GET['pg_slug'];

	$data = $every_balls->fetch_test_name($pg_slug);

	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}



if ($_GET['action'] == "fetch_bill_full_detail") {
	$pg_slug = $_GET['pg_slug'];

	$data = $every_balls->fetch_bill_full_detail($pg_slug);

	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}



if ($_GET['action'] == "fetch_pl_info") {
	$player = $_GET['player'];
	$data = $every_balls->fetch_pl_info($player);

	if ($data) {
		$data = (object) $data;
		$json = json_encode($data);
		echo $json;
	} else {
		echo "Invalid request";
	}
}









