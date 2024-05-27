<?php
class Database
{
	protected $db_host = "localhost";
	protected $db_user = "root";
	protected $db_pass = "";
	protected $db_name = "tri_fixing";
	protected $con 	= false;

	public function connect()
	{
		if (!$this->con) {
			$myconn = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
			if ($myconn) {
				$this->con = true;
				return $myconn;
			} else {
				die("Connection failed: " . mysqli_connect_error());
				return false;
			}
		} else {
			return true;
		}
	}

	public function disconnect()
	{
		if ($this->con) {
			if (mysqli_close($this->con)) {
				$this->con = false;
				return true;
			} else {
				return false;
			}
		}
	}

	public function getDBName()
	{
		$dbData = $this->db_host . "," . $this->db_user . "," . $this->db_pass . "," . $this->db_name;
		return $dbData;
	}
	//--------------------------- DB -------------------------------//
}