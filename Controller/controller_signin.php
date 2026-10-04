<?php
class loginController
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function login_user($userid, $password)
	{
		$query = mysqli_query($this->db, "SELECT slug FROM td_users WHERE phoneno='$userid' AND password='$password' AND status='Active' ") or die(mysqli_error($this->db));

		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

		if (!is_null($row['slug'])) {
			return $row['slug'];
		} else {
			return "Invalid Userid or Password";
		}
	}

	// All player Team A and Team B Name fetch  4/11/25	

	public function fetch_all_player()
	{
		$query = mysqli_query($this->db, "SELECT * FROM td_criket_players") or die(mysqli_error($this->db));

		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
			$data[] = $row;
		}
		return $data;
	}


	public function filter_name($pl_naam, $pl_sstatus)
	{

		// echo "251 ".$pl_naam.$pl_sstatus;die;

		$query =  mysqli_query($this->db, "SELECT * FROM td_criket_players WHERE pl_status ='$pl_sstatus' || pl_name ='$pl_naam' ") or die(mysqli_error($this->db));

		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
			$data[] = $row;
		}
		return $data;
	}


	public function mtch_delete($mtch_slug)
	{
		$query = mysqli_query($this->db, "DELETE FROM td_mtch_create WHERE mtch_slug='$mtch_slug'") or die(mysqli_error($this->db));

		if ($query) {
			return true;
		} else {
			return false;
		}
	}


	// Delete player Name
	public function delete_player($id)
	{
		$query = mysqli_query($this->db, "DELETE FROM td_criket_players WHERE id='$id'") or die(mysqli_error($this->db));

		if ($query) {
			return true;
		} else {
			return false;
		}
	}



	public function Notout_pl_name($pl_slug, $mtch_slug)
	{

		$query = mysqli_query($this->db, "SELECT out_batsman FROM `td_wicket_detail` WHERE mtch_slug = '$mtch_slug' and out_batsman ='$pl_slug' ") or die(mysqli_error($this->db));

		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

		return $row['out_batsman'];
	}


	public function fetch_Notout_pl($mtch_slug, $batting_team)
	{

		$query = mysqli_query($this->db, "SELECT team_name_a,item_pl_checked,pl_slug,mtch_slug FROM td_mtch_team where mtch_slug='$mtch_slug' and team_name_a='$batting_team' ") or die(mysqli_error($this->db)); // team_name_a is table ke column ka name hai.$batting_team uske under me jo value hai wo hai

		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

			$checkplayout = $this->Notout_pl_name($row['pl_slug'], $row['mtch_slug']);
			if (!$checkplayout) {
				$data[] = $row;
			}
		}

		return $data;
	}

	// **********************************************************************************


	public function fetch_title($m_slug)
	{

		$query = mysqli_query($this->db, "SELECT  mtch_name FROM td_mtch_create where mtch_slug='$m_slug' ") or die(mysqli_error($this->db));

		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

		return $row['mtch_name'];
	}

	public function fetch_mtch_status($m_slug)
	{
		$query = mysqli_query($this->db, "SELECT m_status FROM td_mtch_create where mtch_slug='$m_slug' ") or die(mysqli_error($this->db));

		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

		return $row;
	}









	// *****************************************************************************
	public function fetch_toss_win($toss_slug)
	{
		$query = mysqli_query($this->db, "SELECT team_name_a,mtch_slug FROM `td_mtch_team` WHERE mtch_slug='$toss_slug' GROUP BY team_name_a;") or die(mysqli_error($this->db));

		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
			$data[] = $row;
		}
		return $data;
	}


	// ********************************************************************************************
	// *********************** Batting Select Team Name Send/ Recived Batter player  *********************************************************

	public function select_batting_call($team, $slug)
	{

		$query = mysqli_query($this->db, "SELECT item_pl_checked,pl_slug,mtch_slug FROM td_mtch_team WHERE team_name_a = '$team' AND mtch_slug = '$slug'") or die(mysqli_error($this->db));

		$data = [];
		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
			$data[] = $row;
		}

		return $data;
	}




	// ************************ Bowling Team Name Send / Recived bowlwers Name **************************

	public function fetch_bowling_team($team, $slug)
	{

		$query = mysqli_query($this->db, "SELECT item_pl_checked,pl_slug,mtch_slug FROM td_mtch_team WHERE team_name_a = '$team' AND mtch_slug = '$slug'") or die(mysqli_error($this->db));

		$data = [];
		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
			$data[] = $row;
		}

		//  echo $data;
		return $data;
	}





	//******************************************************************************* */
	public function fetch_create_match()
	{
		$data = []; // IMPORTANT

		$query = mysqli_query($this->db, "SELECT * FROM td_mtch_create") or die(mysqli_error($this->db));

		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

			$mtch_date = $row['mtch_date'];

			// Convert proper format
			$row['mtch_date'] = $mtch_date ? date('Y-m-d H:i:s', $mtch_date) : '';

			$data[] = $row;
		}
		return $data;
	}



	// ADD New Players 

	public function submit_player_detail($pl_name, $pl_status, $pl_age, $pl_city, $pl_number, $new_pl_slug)
	{

		if ($new_pl_slug) {
		}

		$query =  mysqli_query($this->db, "INSERT INTO td_criket_players (pl_name,pl_status, pl_age, pl_city,pl_number,new_pl_slug) VALUES ('$pl_name', '$pl_status', '$pl_age', '$pl_city','$pl_number','$new_pl_slug')") or die(mysqli_error($this->db));

		if ($query) {
			return "Success";
		} else {
			return "Failed";
		}
	}






	//Create New Match

	public function create_new_match($mtch_name, $mtch_over, $mtch_place, $mtch_date, $mtch_slug)
	{

		$query = mysqli_query($this->db, "INSERT INTO td_mtch_create (mtch_name,mtch_over,mtch_place,mtch_date,mtch_slug)VALUES ('$mtch_name', '$mtch_over', '$mtch_place', '$mtch_date','$mtch_slug')") or die(mysqli_error($this->db));

		if ($query) {
			return "Success";
		} else {
			return "Failed";
		}
	}


	//  select player Team A or B

	public function team_a_details($pl_slug, $item_pl_checked, $team_name_a, $mtch_slug)
	{

		for ($i = 0; $i < sizeof($pl_slug); $i++) {

			$query = mysqli_query($this->db, "INSERT INTO td_mtch_team (pl_slug,item_pl_checked,team_name_a,mtch_slug)VALUES ('$pl_slug[$i]' , '$item_pl_checked[$i]' , '$team_name_a' , '$mtch_slug')") or die(mysqli_error($this->db));
		}

		// $query = mysqli_query($this->db,"INSERT INTO td_mtch_team (pl_slug,team_a_player_name,team_name_a)VALUES ('$pl_slug' , '$item_pl_checked', '$team_name_a')") or die(mysqli_error($this->db));

		if ($query) {
			return "Success";
		} else {
			return "Failed";
		}
	}





	public function update_player_detail($id, $pl_name, $pl_status, $pl_age, $pl_city, $pl_number)
	{

		$query = mysqli_query($this->db, "UPDATE td_criket_players 

        SET pl_name='$pl_name', pl_status='$pl_status', pl_age='$pl_age', pl_city='$pl_city', pl_number='$pl_number' 
      
	    WHERE id='$id'") or die(mysqli_error($this->db));

		if ($query) {
			return true;
		} else {
			return false;
		}
	}



	public function check_inning_info($mt_slug)
	{
		$query = mysqli_query($this->db, "SELECT id FROM `td_mtch_inning_info_pro` WHERE match_slug = '$mt_slug' ") or die(mysqli_error($this->db));

		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

		if ($row) {
			return "yes";
		} else {
			return "no";
		}
	}



	public function Done_inning_info($selected_toss, $batting_team, $striker, $non_striker, $bowler, $mt_slug, $bowling_team, $mtch_inining)
	{

		$checke = $this->check_inning_info($mt_slug);

		if ($checke == "yes") {

			$query =  mysqli_query($this->db, "UPDATE td_mtch_inning_info_pro 

			SET match_slug='$mt_slug', toss_win='$selected_toss', bowling_team='$bowling_team', batting_team='$batting_team', striker='$striker', non_striker='$non_striker', bowler='$bowler', in_ining='$mtch_inining'

	        WHERE match_slug='$mt_slug' ") or die(mysqli_error($this->db));
		} else {

			$query =  mysqli_query($this->db, "INSERT INTO td_mtch_inning_info_pro (toss_win,batting_team, striker, non_striker,bowler,match_slug,bowling_team,in_ining) VALUES ('$selected_toss', '$batting_team', '$striker', '$non_striker','$bowler','$mt_slug','$bowling_team','$mtch_inining')") or die(mysqli_error($this->db));

			if ($query) {
				return "Success";
			} else {
				return "Failed";
			}
		}
	}

	public function send_next_bowler($next_bowler, $mtc_slug)
	{

		$query =  mysqli_query($this->db, "UPDATE td_mtch_inning_info_pro 

			SET bowler='$next_bowler'

	        WHERE match_slug='$mtc_slug' ") or die(mysqli_error($this->db));

		if ($query) {
			return "Success";
		} else {
			return "Failed";
		}
	}




	public function update_inining_normal_wk($mtc_slug, $selected_toss_updt, $bowling_team_updt, $batting_team_updt, $neww_batsman, $non_striker_updt, $bowler, $mtch_inining)
	{

		$query =  mysqli_query($this->db, "UPDATE td_mtch_inning_info_pro 

			SET match_slug='$mtc_slug', toss_win='$selected_toss_updt', bowling_team='$bowling_team_updt', batting_team='$batting_team_updt', striker='$neww_batsman', non_striker='$non_striker_updt', bowler='$bowler', in_ining='$mtch_inining'

	        WHERE match_slug='$mtc_slug' ") or die(mysqli_error($this->db));

		if ($query) {
			return "Success";
		} else {
			return "Failed";
		}
	}




	public function update_inining($mtc_slug, $selected_toss_updt, $bowling_team_updt, $batting_team_updt, $neww_batsman, $non_striker_updt, $bowler, $mtch_inining, $batsman)
	{

		$query =  mysqli_query($this->db, "UPDATE td_mtch_inning_info_pro 

			SET match_slug='$mtc_slug', toss_win='$selected_toss_updt', bowling_team='$bowling_team_updt', batting_team='$batting_team_updt', striker='$neww_batsman', non_striker='$non_striker_updt', bowler='$bowler', in_ining='$mtch_inining'

	        WHERE match_slug='$mtc_slug' ") or die(mysqli_error($this->db));

		if ($query) {
			return "Success";
		} else {
			return "Failed";
		}
	}

	public function update_inining_four($mtc_slug, $selected_toss_updt, $bowling_team_updt, $batting_team_updt, $neww_batsman, $non_striker_updt, $bowler, $mtch_inining, $batsman)
	{

		$query =  mysqli_query($this->db, "UPDATE td_mtch_inning_info_pro 

			SET match_slug='$mtc_slug', toss_win='$selected_toss_updt', bowling_team='$bowling_team_updt', batting_team='$batting_team_updt', striker='$neww_batsman', non_striker='$batsman', bowler='$bowler', in_ining='$mtch_inining'

	        WHERE match_slug='$mtc_slug' ") or die(mysqli_error($this->db));

		if ($query) {
			return "Success";
		} else {
			return "Failed";
		}
	}




	public function update_inining_nonstrike($mtc_slug, $selected_toss_updt, $bowling_team_updt, $batting_team_updt, $neww_batsman, $non_striker_updt, $bowler, $mtch_inining, $batsman)
	{

		$query =  mysqli_query($this->db, "UPDATE td_mtch_inning_info_pro 

			SET match_slug='$mtc_slug', toss_win='$selected_toss_updt', bowling_team='$bowling_team_updt', batting_team='$batting_team_updt', striker='$batsman', non_striker='$neww_batsman', bowler='$bowler', in_ining='$mtch_inining'
      
	        WHERE match_slug='$mtc_slug' ") or die(mysqli_error($this->db));

		if ($query) {
			return "Success";
		} else {
			return "Failed";
		}
	}


	public function update_inining_nonstrike_two($mtc_slug, $selected_toss_updt, $bowling_team_updt, $batting_team_updt, $neww_batsman, $non_striker_updt, $bowler, $mtch_inining, $batsman)
	{

		$query =  mysqli_query($this->db, "UPDATE td_mtch_inning_info_pro 

			SET match_slug='$mtc_slug', toss_win='$selected_toss_updt', bowling_team='$bowling_team_updt', batting_team='$batting_team_updt', striker='$non_striker_updt', non_striker='$neww_batsman', bowler='$bowler', in_ining='$mtch_inining'
      
	        WHERE match_slug='$mtc_slug' ") or die(mysqli_error($this->db));

		if ($query) {
			return "Success";
		} else {
			return "Failed";
		}
	}










	public function ining_update($m_inining, $batt_team, $mtch_slug, $bowl_team)
	{

		$query =  mysqli_query($this->db, "UPDATE td_mtch_inning_info_pro 

			SET  batting_team='$batt_team', in_ining='$m_inining', bowling_team='$bowl_team', striker='', non_striker='', bowler=''
      
	        WHERE match_slug='$mtch_slug' ") or die(mysqli_error($this->db));

		if ($query) {
			return "Success";
		} else {
			return "Failed";
		}
	}














	public function fetch_inning_info($mtch_slug)
	{

		$query = mysqli_query($this->db, "SELECT id,toss_win,batting_team,striker,match_slug,non_striker,bowler,in_ining FROM td_mtch_inning_info_pro WHERE match_slug='$mtch_slug' order by id desc") or die(mysqli_error($this->db));

		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

		if ($row) {
			$pl_name = $this->convert_in_name($row['non_striker']);
			$pl_name_st = $this->convert_in_name($row['striker']);
			$pl_name_bowler = $this->convert_in_name($row['bowler']);

			$st = array("item_pl_checked" => $pl_name_st, "mtch_slug" => $row['match_slug'], "pl_slug" => $row['striker'], "team_name_a" => $row['batting_team']);
			$row['st'] = $st;
			$non_st = array("item_pl_checked" => $pl_name, "mtch_slug" => $row['match_slug'], "pl_slug" => $row['non_striker'], "team_name_a" => $row['batting_team']);
			$row['non_st'] = $non_st;
			$bowler = array("item_pl_checked" => $pl_name_bowler, "mtch_slug" => $row['match_slug'], "pl_slug" => $row['bowler']);
			$row['bowler'] = $bowler;
		}


		return $row;
	}



	public function fetch_inning_zero_leval($mtch_slug)
	{

		$query = mysqli_query($this->db, "SELECT id,toss_win,batting_team,match_slug,in_ining FROM td_mtch_inning_info_pro WHERE match_slug='$mtch_slug' order by id desc") or die(mysqli_error($this->db));

		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
		$row['id'] = intval($row['id']);
		$row['in_ining'] = intval($row['in_ining']);

		return $row;
	}










	public function every_ball_data_send($ball, $run, $batsman, $mtc_slug, $bowler, $current_over, $mtch_inining, $wick_slug)
	{

		$query =  mysqli_query($this->db, "INSERT INTO td_every_ball_detail (ball,run,batsman,mtch_slug,bowler,current_over,mtch_inining,wick_slug) VALUES ('$ball', '$run', '$batsman','$mtc_slug','$bowler','$current_over','$mtch_inining','$wick_slug')") or die(mysqli_error($this->db));

		if ($query) {
			return "Success";
		} else {
			return "Failed";
		}
	}

	public function skip_extra_ball($mtch_slug)
	{

		// echo "2.0 Controlller = ".$mtch_slug;die;

		$query = mysqli_query($this->db, "SELECT ball,run FROM td_every_ball_detail WHERE mtch_slug = '$mtch_slug' AND ball REGEXP '^[0-9]+$' ORDER BY id DESC LIMIT 1;") or die(mysqli_error($this->db));

		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

		$row["run"] = intval($row["run"]); // string bhej rha hu 

		if ($row["ball"] == "") {

			$row["ball"] = "0";
		}

		return $row;
	}




	public function convert_in_name($new_pl_slug)
	{
		$query = mysqli_query($this->db, "SELECT pl_name FROM `td_criket_players` WHERE new_pl_slug = '$new_pl_slug' ") or die(mysqli_error($this->db));

		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

		return $row['pl_name'];
	}






	public function convert_in_wicktype($wick_slug)
	{
		$query = mysqli_query($this->db, "SELECT wicktype FROM `td_wicket_detail` WHERE wick_slug = '$wick_slug' ") or die(mysqli_error($this->db));

		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

		return $row['wicktype'];
	}





	//  for match inining 1
	public function row_data_fetch($mtch_slug)
	{

		$data = [];

		$query = mysqli_query($this->db, "SELECT mtch_slug,ball,run,batsman,current_over,mtch_inining,wick_slug,bowler FROM td_every_ball_detail
         WHERE mtch_slug = '$mtch_slug' AND mtch_inining = '1' ORDER BY id DESC") or die(mysqli_error($this->db));

		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
			$row['batsman'] = $this->convert_in_name($row['batsman']);
			$row['wicket_type'] = $this->convert_in_wicktype($row['wick_slug']); // 'wick_slug' ko convert_in_wicktype function me bhej rha hu.//'wicket_type' name se view me le ja rha hu
			$row["current_over"] = intval($row["current_over"]);
			$row["mtch_inining"] = intval($row["mtch_inining"]);
			$row["run"] = intval($row["run"]);
			$row['bowler_name'] = $this->convert_in_name($row['bowler']);

			$data[] = $row;
		}

		return $data;
	}





	//  for match inining 2 
	public function row_data_fetch_innings_two($mtch_slug)
	{

		$data = [];

		$query = mysqli_query($this->db, "SELECT mtch_slug,ball,run,batsman,current_over,mtch_inining,wick_slug FROM td_every_ball_detail
         WHERE mtch_slug = '$mtch_slug' AND mtch_inining = '2' ORDER BY id DESC") or die(mysqli_error($this->db));

		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
			$row['batsman'] = $this->convert_in_name($row['batsman']);
			$row["current_over"] = intval($row["current_over"]);
			$row["mtch_inining"] = intval($row["mtch_inining"]);
			$row["run"] = intval($row["run"]);
			$row['wicket_type'] = $this->convert_in_wicktype($row['wick_slug']);

			$data[] = $row;
		}

		return $data;
	}


	public function over_add($mtch_slug)
	{
		$query = mysqli_query($this->db, "SELECT mtch_over FROM `td_mtch_create` WHERE mtch_slug = '$mtch_slug' ") or die(mysqli_error($this->db));
		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
		$row["mtch_over"] = intval($row["mtch_over"]);
		return $row['mtch_over'];
	}




	public function ball_over_fetch($mtch_slug)
	{

		$data = [];

		$query = mysqli_query($this->db, "SELECT ball,current_over,mtch_inining FROM `td_every_ball_detail` WHERE mtch_slug = '$mtch_slug' ORDER BY id DESC") or die(mysqli_error($this->db));

		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

		if ($row['ball'] == "" || $row['ball'] == "undefine") {
			$row['ball'] = "1"; // ball ko string bhej rha hu
			//$row['ball']= 0;
		}
		if ($row['current_over'] == "" || $row['current_over'] == "undefine") {
			$row['current_over'] = 0;
			//  $row['current_over']=0;
		}

		$row['current_over'] = intval($row['current_over']);
		$row['mtch_over'] = $this->over_add($mtch_slug);
		$row['mtch_inining'] = intval($row['mtch_inining']);


		return $row;
	}


	public function send_wicket_detail($mtc_slug, $wicket_by, $out_batsman, $neww_batsman, $wicktype, $wick_slug)
	{  //,$wiket_slug

		// echo " 358 Controll_row_ ball_".$wicket_by,"_",$out_batsman,"_",$neww_batsman,"=",$wick_slug,"ballNumber=",$ballNumber,"run=",$run;die;

		$query =  mysqli_query($this->db, "INSERT INTO td_wicket_detail (mtch_slug,wicket_by,out_batsman,neww_batsman,wicktype,wick_slug) VALUES ('$mtc_slug','$wicket_by', '$out_batsman', '$neww_batsman','$wicktype','$wick_slug')") or die(mysqli_error($this->db));

		if ($query) {
			return "Success";
		} else {
			return "Failed";
		}
	}





	// <!-- *************************************************************************** -->

	public function check_batsman_out($batsman, $mtch_slug)
	{
		$query = mysqli_query($this->db, "SELECT out_batsman FROM `td_wicket_detail` WHERE mtch_slug = '$mtch_slug' and out_batsman = '$batsman' ") or die(mysqli_error($this->db));

		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

		if ($row) {
			return "OUT";
		} else {
			return "NOT OUT";
		}
	}




	// SELECT ball,batsman, SUM(CASE WHEN ball IN ('NB', 'WD') THEN run - 1 END) AS batsman_runs FROM td_every_ball_detail WHERE mtch_slug = '6576ce3ff6a7faf468d3ffb1c31dfe75' and mtch_inining = '1' GROUP BY batsman;
	public function fetch_batsman_run($mt_slug, $mtch_inining)
	{
		// echo " 38 Controll_row_ ball_".$mt_slug;die;
		$mt_slug = mysqli_real_escape_string($this->db, $mt_slug);

		$query = mysqli_query(
			$this->db,
			"SELECT ball,batsman,mtch_slug,
			SUM(CASE WHEN ball IN ('NB', 'WD') THEN run - 1 ELSE run END) AS batsman_runs
			FROM td_every_ball_detail
			WHERE mtch_slug = '$mt_slug' and mtch_inining = '$mtch_inining'
			GROUP BY batsman;"
		) or die(mysqli_error($this->db));

		$data = [];
		while ($row = mysqli_fetch_assoc($query)) {

			$row['batsman_name'] = $this->convert_in_name($row['batsman']);
			$row['batsman_check'] = $this->check_batsman_out($row['batsman'], $row['mtch_slug']);
			$data[] = $row;
		}

		return $data;
	}



	public function fetch_team_run($mt_slug, $mtch_inining)
	{

		$query = mysqli_query(
			$this->db,
			"SELECT SUM(run)as totle_run  FROM td_every_ball_detail WHERE mtch_slug = '$mt_slug' and mtch_inining = '$mtch_inining'"
		) or die(mysqli_error($this->db));

		$row = mysqli_fetch_assoc($query);   // single row
		return $row['totle_run'] ?? 0;       // agar null to 0
	}


	// public function fetch_all_inining_run($mt_slug)
	// {
	//     $mt_slug = mysqli_real_escape_string($this->db, $mt_slug);

	// 	$query = mysqli_query(
	// 	$this->db,
	// 	" SELECT mtch_inining, sum(run) FROM td_every_ball_detail WHERE mtch_slug = '$mt_slug' GROUP BY mtch_inining "
	// 	) or die(mysqli_error($this->db));


	// 	while ($row = mysqli_fetch_assoc($query)) {

	// 	}

	// 	return $row[''] ?? 0;    

	// }

	public function fetch_all_inining_run($mt_slug)
	{
		$mt_slug = mysqli_real_escape_string($this->db, $mt_slug);

		$query = mysqli_query(
			$this->db,
			"SELECT mtch_inining, SUM(run) AS All_run 
         FROM td_every_ball_detail 
         WHERE mtch_slug = '$mt_slug' 
         GROUP BY mtch_inining"
		) or die(mysqli_error($this->db));

		$result = [];

		while ($row = mysqli_fetch_assoc($query)) {
			$result[$row['mtch_inining']] = intval($row['All_run']);
		}

		return $result;
	}



	// <!-- *************************************************************************** -->







	public function ining_st_nst_updt($currentStriker_new, $currentNonStriker_new, $mt_slug)
	{

		$query = mysqli_query($this->db, "UPDATE td_mtch_inning_info_pro 

        SET striker='$currentStriker_new', non_striker='$currentNonStriker_new'
      
	    WHERE match_slug='$mt_slug'") or die(mysqli_error($this->db));

		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	//*******************************************  View Match Detail ka hai ***************************************************** */


	public function convert_in_match_name($mtch_slug)
	{
		$query = mysqli_query($this->db, "SELECT mtch_name FROM `td_mtch_create` WHERE mtch_slug = '$mtch_slug' ") or die(mysqli_error($this->db));

		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

		return $row['mtch_name'];
	}



	public function check_witype_batsman($batsman, $mtch_slug)  // yah function niche se call huwa, isame wicket_type out_batsman name le jana hai
	{
		$query = mysqli_query($this->db, "SELECT wicktype,wicket_by FROM `td_wicket_detail` WHERE mtch_slug = '$mtch_slug' and out_batsman = '$batsman' ") or die(mysqli_error($this->db));

		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

		return $row;
	}


	// public function get_team_name($mtch_slug)  // yah function niche se call huwa, isame wicket_type out_batsman name le jana hai
	// {
	// 	$query = mysqli_query($this->db, "SELECT team_name_a FROM `td_mtch_team` WHERE mtch_slug = '$mtch_slug' GROUP BY team_name_a") or die(mysqli_error($this->db));

	// 	$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

	// 	return $row['team_name_a'];
	// }


	public function fetch_nb_check($toss_slug, $mtch_ininig)
	{
		$query = mysqli_query(
			$this->db,
			"SELECT * FROM `td_every_ball_detail`
         WHERE mtch_slug = '$toss_slug' AND mtch_inining = '$mtch_ininig'
         ORDER BY id DESC
         LIMIT 1"
		) or die(mysqli_error($this->db));

		while ($row = mysqli_fetch_assoc($query)) {

			$batter_name = $this->convert_in_name($row['batsman']);
			$bowler_name = $this->convert_in_name($row['bowler']);
			
				$row[] = [
					'batter_name' => $batter_name,
					'bowler_name' => $bowler_name,

				];
				

			$ball = strtoupper(trim($row['ball']));
			if ($ball === '' || is_null($ball)) continue;

			//  1) अगर NB मिले -> return NB (जब तक normal नहीं मिला)
			if (strpos($ball, 'NB') !== false) {
				return $row;
			}

			//  2) WD मिले -> ignore (skip)
			if (strpos($ball, 'WD') !== false) {
				continue;
			}

			//  3) अगर 0 (dot ball) मिले -> वही return करें
			if ($ball === '0' || $ball === 'DOT') {
				return $row;
			}

			//  4) अगर W (wicket) मिले -> वही return करें
			if ($ball === 'W') {
				return $row;
			}

			//  5) अगर normal runs 1 से 6 मिले -> वही return करें
			if (preg_match('/\b[1-6]\b/', $ball)) {
				return $row;
			}



			//  यदि और कोई special case हो तो नीचे add कर सकते हैं।





		}

		return null; // fallback
	}


	// public function fetch_nb_check($toss_slug, $mtch_ininig)
	// {
	// 	$query = mysqli_query($this->db, "SELECT *  FROM `td_every_ball_detail`

	// 	WHERE mtch_slug = '$toss_slug' and mtch_inining = '$mtch_ininig' ORDER BY id DESC LIMIT 1"
	// 	) or die(mysqli_error($this->db));

	// 	$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

	// 	return $row;
	// }




	public function match_batter_detail($mtch_slug)
	{
		$innocount = 1;
		while ($innocount <= 2) {

			$query = mysqli_query($this->db, "SELECT batsman, bowler,mtch_inining,
			COUNT(ball) AS balls,
			COUNT(CASE WHEN (run = 4 or run = 5 ) AND ball REGEXP '^[0-9]+$' THEN 1 END) AS four_run,
			COUNT(CASE WHEN (run = 6 or run = 7) AND ball REGEXP '^[0-9]+$' THEN 1 END) AS six_run,
			SUM(run) AS runs 
			FROM td_every_ball_detail 
			WHERE mtch_slug = '$mtch_slug' and mtch_inining='$innocount' AND ball<>'WD' AND ball<>'NB'
			GROUP BY batsman
	    	") or die(mysqli_error($this->db));

			$data = [];

			while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

				$row['bowler_wicket_type'] = $this->check_witype_batsman($row['batsman'], $mtch_slug);

				// Convert slug to player name (assuming this function exists)
				$player_name = $this->convert_in_name($row['batsman']);

				$bowler = $this->convert_in_name($row['bowler']);
				// $team_names = $this->get_team_name($mtch_slug);


				$bowler_ = $this->convert_in_name($row['bowler_wicket_type']['wicket_by']);

				// print_r($row['wicket_type']['wicktype']) ;
				$strike_rate = ($row['runs'] / $row['balls']) * 100;

				$data[] = [
					'strike_rate' => (int)$strike_rate,
					'batsman'     => $player_name,
					'bowler'     => $bowler,
					// 'mtch_inining' => $mtch_inining,
					'mtch_inining'       => (int)$row['mtch_inining'],
					// 'team_names' => $team_names,
					'balls'       => (int)$row['balls'],
					'runs'        => (int)$row['runs'],
					'four_run'    => (int)$row['four_run'],
					'six_run'     => (int)$row['six_run'],
					'wicktype'    => $row['bowler_wicket_type']['wicktype'],
					// 'wicket_by' => $row['bowler_wicket_type']['wicket_by']
					'wicket_by' => $bowler_
				];
			}
			$finaldata[] = $data;
			$innocount++;
		}

		return $finaldata;
	}


	public function fetch_team_name($team_slug)
	{
		$query = mysqli_query($this->db, "SELECT team_name_a,item_pl_checked,mtch_slug FROM td_mtch_team where mtch_slug='$team_slug' ") or die(mysqli_error($this->db));

		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

			$data[] = $row;
		}
		return $data;
	}

	// public function fetch_team_name($team_slug)
	// {
	//     $query = mysqli_query(
	//         $this->db,
	//         "SELECT team_name_a, item_pl_checked
	//          FROM td_mtch_team 
	//          WHERE mtch_slug='$team_slug' 
	//          GROUP BY team_name_a"
	//     ) or die(mysqli_error($this->db));

	//     $data = [];
	//     while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	//         $data[] = $row;
	//     }
	//     return $data;
	// }






	public function match_bowler_detail($mtch_slug)
	{
		$inining_count = 1;
		while ($inining_count <= 2) {

			$query = mysqli_query($this->db, "SELECT 
             bowler, mtch_inining,
             SUM(CASE WHEN TRIM(wick_slug) <> '' THEN 1 ELSE 0 END) AS wicket,
             SUM(CASE WHEN run REGEXP '^[0-9]+$' THEN run ELSE 0 END) AS runs,
             COUNT(CASE WHEN ball REGEXP '^[0-9]+$' THEN 1 END) AS balls,
		     SUM(CASE WHEN ball IN ('NB', 'WD') THEN run ELSE 0 END) AS extras,
             COUNT(CASE WHEN run = 0 AND ball REGEXP '^[0-9]+$' THEN 1 END) AS dot_balls
             FROM td_every_ball_detail
             WHERE mtch_slug = '$mtch_slug' and mtch_inining='$inining_count'
             GROUP BY bowler
           ") or die(mysqli_error($this->db));

			$data = [];

			while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

				$player_name = $this->convert_in_name($row['bowler']);

				$economy = ($row['balls'] > 0) ? round($row['runs'] / ($row['balls'] / 6), 2) : 0; //round built-in function hai jo float ko fix ya kam karke digit deta hai jitana jarurat hai utana

				$data[] = [
					'bowler' => $player_name,
					'wicket' => (int)$row['wicket'],
					'runs'   => (int)$row['runs'],
					'balls'  => (int)$row['balls'],
					'over'   => floor($row['balls'] / 6) . '.' . ($row['balls'] % 6),
					'economy' => $economy,
					'extras' => (int)$row['extras'],
					'dot_balls' => (int)$row['dot_balls'],
				];
			}

			$bowler_data[] = $data;
			$inining_count++;
		}
		return $bowler_data;
	}


	public function mtch_status($mtt_slug, $m_status)
	{

		// echo "New0=".$mtt_slug."=".$m_status;

		$query = mysqli_query($this->db, "UPDATE td_mtch_create 

        SET m_status='$m_status'
      
	    WHERE mtch_slug='$mtt_slug'") or die(mysqli_error($this->db));

		if ($query) {
			return true;
		} else {
			return false;
		}
	}





	public function fetch_bill()
	{

		$query = mysqli_query($this->db, "SELECT * FROM td_bill") or die(mysqli_error($this->db));

		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

			$data[] = $row;
		}
		return $data;
	}


	public function fetch_bill_full_detail($pg_slug)
	{
		// echo"==".$pg_slug;
		$query = mysqli_query($this->db, "SELECT * FROM td_bill where submit_slug='$pg_slug'") or die(mysqli_error($this->db));


		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

			$data[] = $row;
		}


		// Yeh line add karo dekhne ke liye kya aaya:
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";

		return $data;
	}


	public function fetch_test_name($pg_slug)
	{
		$query = mysqli_query($this->db, "SELECT Department,Test_code,Test_name,Rate FROM patient_info where slug='$pg_slug'") or die(mysqli_error($this->db));
		$data = [];
		$total = 0;
		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

			$data[] = $row;
			$total = $total + $row['Rate']; // total sum nikal lo

		}
		return ["data" => $data, "total" => $total];
	}

}
