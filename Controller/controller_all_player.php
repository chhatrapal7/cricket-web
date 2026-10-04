<?php
class player_infoController
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}



	public function fetch_all_player()
	{
		$query = mysqli_query($this->db, "SELECT * FROM td_criket_players") or die(mysqli_error($this->db));

		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
			$data[] = $row;
		}
		return $data;
	}


	
	public function fetch_player_info($pl_slug)
	{
		$query = mysqli_query($this->db, "SELECT pl_name,pl_status,new_pl_slug,pl_city,imgname,pl_number,pl_age FROM td_criket_players where new_pl_slug = '$pl_slug'") or die(mysqli_error($this->db));

		// while (
		// 	$row = mysqli_fetch_array($query, MYSQLI_ASSOC)
		// 	) {
		// 	$data[] = $row;
		// }
		// return $data;
	


			$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

		    return $row;

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













}









?>