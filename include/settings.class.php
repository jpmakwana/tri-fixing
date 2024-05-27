<?php
require_once("main.class.php");
require_once("function.class.php");
require_once("class.system.php");
require_once("notification.class.php");

class Settings extends Functions
{
	public $db;
	public $log;
	public $system;
	public $ctable = "settings";

	function __construct($id = "")
	{
		$db = new Functions();
		$log = new Log();
		$system = new System();
		$conn = $db->connect();
		$this->db = $db;
		$this->log = $log;
		$this->notification = new Notification();
		$this->system = $system;
	}

	public function InsertSettings($detail)
	{

		extract($detail);


		$adate	= date('Y-m-d H:i:s');
		$rows 	= array(
			"razorpay_id",
			"razorpay_secret",
			"imdb_key",
			"terms",
			"privacy",
			"offer_food",
			"contact_us",
          	"terms_text",
			"isDelete",
			"isActive",
			"created_date",
		);
		$values = array(
			$razorpay_id,
			$razorpay_secret,
			$imdb_key,
			$terms,
			$privacy,
			$offer_food,
			$contact_us,
          	$terms_text,
			0,
			1,
			$adate,
		);
		$customer_id = $this->db->rp_insert($this->ctable, $values, $rows, 0);
		$this->log->insertLog($this->ctable, $customer_id, "insert", $this->log->slm['SETTINGS_INSERT_SUCESS'] . " : " . $name);
		if ($customer_id != 0) {
			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('SETTINGS_INSERT_SUCESS', 1), "ack_msg" => $this->log->getMessage('SETTINGS_INSERT_SUCESS'), "id" => $customer_id);
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('SETTINGS_INSERT_FAILED', 0), "ack_msg" => $this->log->getMessage('SETTINGS_INSERT_FAILED'));
			return $reply;
		}
	}
	public function UpdateSettings($detail)
	{
		extract($detail);
		$adate   = date('Y-m-d H:i:m');

		$rows 	= array(

			"razorpay_id" => $razorpay_id,
			"razorpay_secret" => $razorpay_secret,
			"imdb_key" => $imdb_key,
			"terms" => $terms,
			"privacy" => $privacy,
			"offer_food" => $offer_food,
			"contact_us" => $contact_us,
          	"terms_text" => $terms_text,
			"created_date" => $adate,
		);
		$where	= "id='" . $id . "'";
		$uid = $this->db->rp_update($this->ctable, $rows, $where, 0);
		$this->log->insertLog($this->ctable, $id, "update", $this->log->slm['SETTINGS_UPDATE_SUCESS'] . " : " . $first_name);
		if ($uid != 0) {

			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('SETTINGS_UPDATE_SUCESS', 1), "ack_msg" => $this->log->getMessage('SETTINGS_UPDATE_SUCESS'));
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('SETTINGS_UPDATE_FAILED', 0), "ack_msg" => $this->log->getMessage('SETTINGS_UPDATE_FAILED'));
			return $reply;
		}
	}

	public function SettingsGetEditData($detail)
	{
		$where = " id='" . $detail['id'] . "' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable, "*", $where);
		if ($ctable_r) {
			$ctable_d = mysqli_fetch_array($ctable_r);
			$result = array();
			$result = $ctable_d;
			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('SETTINGS_GET_SUCESS', 1), "ack_msg" => $this->log->getMessage('SETTINGS_GET_SUCESS'), "result" => $result);
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('SETTINGS_GET_FAILED', 0), "ack_msg" => $this->log->getMessage('SETTINGS_GET_FAILED'));
			return $reply;
		}
	}
	public function ActiveSettings($detail)
	{


		$rows 	= array(
			"isActive"	=> $detail['isActive']
		);
		$where	= "id='" . $detail['id'] . "'";
		$uid = $this->db->rp_update($this->ctable, $rows, $where);
		$this->log->insertLog($this->ctable, $detail['id'], "delete", $this->log->slm['VENDOR_STATUS_SUCESS'] . " : admin");
		if ($uid != 0) {
			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('SETTINGS_STATUS_SUCESS', 1), "ack_msg" => $this->log->getMessage('SETTINGS_STATUS_SUCESS'));
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('SETTINGS_STATUS_FAILED', 1), "ack_msg" => $this->log->getMessage('SETTINGS_STATUS_FAILED'));
			return $reply;
		}
	}

	public function DeleteSettings($detail)
	{
		$rows 	= array(
			"isDelete"	=> "1"

		);
		$where	= "id='" . $detail['id'] . "'";
		$isUpdated = $this->db->rp_update($this->ctable, $rows, $where);

		$this->log->insertLog($this->ctable, $detail['id'], "delete", $this->log->slm['SETTINGS_DELETE_SUCESS'] . " : ");

		if ($isUpdated) {
			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('SETTINGS_DELETE_SUCESS', 1), "ack_msg" => $this->log->getMessage('SETTINGS_DELETE_SUCESS'));
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('SETTINGS_DELETE_FAILED', 1), "ack_msg" => $this->log->getMessage('SETTINGS_DELETE_FAILED'));
			return $reply;
		}
	}


	function getSettingsDetail($uid)
	{
		$settings = array();
		$settings_r = $this->db->rp_getData("settings", "*", "id='" . $uid . "'", "", 0);

		while ($settings_d = mysqli_fetch_assoc($settings_r)) {
			$settings[] = $settings_d;
		}
		return $settings;
	}




	function validateKey($detail)
	{
		$error = array();
		foreach ($detail as $key => $value) {
			if (!in_array($key, $this->valid_keys)) {
				$error[] = $key;
			}
		}

		if (empty($error)) {
			$result = array("ack" => 1);
			return $result;
		} else {
			$result = array("ack" => 0, "error" => $error);
			return $result;
		}
	}
	function countSettings($key, $value)
	{
		$countCustomer = $this->db->rp_getTotalRecord($this->ctable, $key . "='" . $value . "'", 0);
		return $countCustomer;
	}



	// function parseDate($date){
	// 	if($date!="0000-00-00"){
	// 		$date=date('d-m-Y',strtotime($date));
	// 	}else{
	// 		$date="";
	// 	}
	// 	return $date;
	// }


}
