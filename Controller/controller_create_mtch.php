<?php
class controller_create_mtch
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	
	public function fetch_title($m_slug)
	{

		$query = mysqli_query($this->db, "SELECT  mtch_name,each_team_pl FROM td_mtch_create where mtch_slug='$m_slug' ") or die(mysqli_error($this->db));

		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

		return $row;
	}

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



	public function mtch_delete($mtch_slug)
	{
		$query = mysqli_query($this->db, "DELETE FROM td_mtch_create WHERE mtch_slug='$mtch_slug'") or die(mysqli_error($this->db));

		if ($query) {
			return true;
		} else {
			return false;
		}
	}


	public function create_new_match($mtch_name, $mtch_over, $mtch_place, $mtch_date, $Each_team_pl, $mtch_slug)
	{
		//   echo"==".$Each_team_pl;

		$query = mysqli_query($this->db, "INSERT INTO td_mtch_create (mtch_name,mtch_over,mtch_place,mtch_date,mtch_slug,each_team_pl)VALUES ('$mtch_name', '$mtch_over', '$mtch_place', '$mtch_date','$mtch_slug','$Each_team_pl')") or die(mysqli_error($this->db));

		if ($query) {
			return "Success";
		} else {
			return "Failed";
		}
	}

	public function fetch_team_name($team_slug)
	{
		$query = mysqli_query($this->db, "SELECT team_name_a,item_pl_checked,mtch_slug,pl_slug FROM td_mtch_team where mtch_slug='$team_slug' ") or die(mysqli_error($this->db));

		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

			$data[] = $row;
		}
		return $data;
		
	}


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





}