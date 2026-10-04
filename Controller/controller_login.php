<?php
class loginControllernew
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

}
