<?php
require_once("main.class.php");
require_once("function.class.php");
require_once("class.system.php");
require_once("notification.class.php");

class User extends Functions
{
	public $db;
	public $log;
	public $system;
	public $ctable = "user";

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

	public function InsertUser($detail, $file)
	{

		extract($detail);
		$dup_where = "mobile = '" . $mobile . "' AND isDelete=0 AND isActive=1";
		$r = $this->db->rp_dupCheck($this->ctable, $dup_where, 0);
		if ($r) {

			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('DUPLICATE_MOBILE_FOUND', 1), "ack_msg" => $this->log->getMessage('DUPLICATE_MOBILE_FOUND'), "result" => $user_detail);
			return $reply;
		} else {
			if (isset($file["image_path"]) && $file["image_path"]['size'] != 0) {

				$allowedExts = array("jpg", "jpeg", "png", "gif", "JPG", "JPEG");
				$temp = explode(".", $file["image_path"]["name"]);

				$extension = end($temp);
				$error = "";
				if ($file["image_path"]["error"] > 0) {
					$error .= "Error opening the file. ";
				}
				if ($file["image_path"]["type"] == "application/x-msdownload") {
					$error .= "Mime type not allowed. ";
				}
				if (!in_array($extension, $allowedExts)) {
					$error .= "Extension not allowed. ";
				}

				$fileName  = $this->db->clean($file["image_path"]["name"]);
				$fileSize  = round($file["image_path"]["size"]); // BYTES
				//echo $fileSize ;exit;
				$extension = end(explode(".", $fileName));

				$fileName	= 'user_image_' . substr(sha1(time()), 0, 6) . "." . $extension;
				$filePath 	= "../images/user/" . $fileName;
				move_uploaded_file($file['image_path']['tmp_name'], $filePath);
				$image = $fileName;
			} else {
				$image = "Image not upload.";
			}
			$adate	= date('Y-m-d H:i:s');
			$rows 	= array(
				"name",
				"email",
				"mobile",
				"address",
				"city",
				"state",
				"zipcode",
				"latitude",
				"longitude",
				"birth_date",
				"account_type",
				"account_name",
				"account_number",
				"currency",
			    "image_path",
				"isDelete",
				"isActive",
				"created_date",
			);
			$values = array(
				$name,
				$email,
				$mobile,
				$address,
				$city,
				$state,
				$zipcode,
				$latitude,
				$longitude,
				$birth_date,
				$account_type,
				$account_name,
				$account_number,
				$currency,
				$image,
				0,
				1,
				$adate,
			);
			$customer_id = $this->db->rp_insert($this->ctable, $values, $rows, 0);
			$this->log->insertLog($this->ctable, $customer_id, "insert", $this->log->slm['USER_INSERT_SUCESS'] . " : " . $name);
			if ($customer_id != 0) {
				/*$branch_rows=array("cid","branch_name","address","pincode","city","country","email","phone","price_list","adate");
				$branch_values=array($customer_id,$name,$address,$pincode,$city,$country,$email,$cellphone,$price_list,$adate);
				$cbid=$this->db->rp_insert("customer_branch",$branch_values,$branch_rows);
				$last_account_id=$this->rp_getValue("account_info","MAX(id)","isDelete=0",0);
				$last_account_no=$this->rp_getValue("account_info","account_number","id=".$last_account_id."",0);
				if($last_account_no=="")
				{
					$last_account_no="0001";
				}
				else
				{
					 $last_account_no=str_pad($last_account_no+1, 4, 0, STR_PAD_LEFT);
					
				}
				
				$rows 	= array(
						"account_number",
						"cid",
						"cbid",
						"customer_name",
						"add_date",
					);
				$values = array(
						$last_account_no,
						$cid,
						$cbid,
						$name,
						$adate,
					);
					
				$account_info_id = $this->rp_insert("account_info",$values,$rows,0);*/
				$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('USER_INSERT_SUCESS', 1), "ack_msg" => $this->log->getMessage('USER_INSERT_SUCESS'), "id" => $customer_id);
				return $reply;
			} else {
				$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('USER_INSERT_FAILED', 0), "ack_msg" => $this->log->getMessage('USER_INSERT_FAILED'));
				return $reply;
			}
		}
	}
	public function UpdateUser($detail, $file)
	{
		extract($detail);
		//$dup_where = "email = '".$email."' AND id!='".$_REQUEST['id']."' AND isDelete=0 AND isActive=1";
		$dup_where = "mobile = '" . $mobile . "' AND id!='" . $id . "' AND isDelete=0 AND isActive=1";
		$r = $this->db->rp_dupCheck($this->ctable, $dup_where, 0);
		if ($r) {

			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('DUPLICATE_MOBILE_FOUND', 1), "ack_msg" => $this->log->getMessage('DUPLICATE_MOBILE_FOUND'));
			return $reply;
		} else {


			if (isset($file["image_path"]) && $file["image_path"]['size'] != 0) {

				$allowedExts = array("jpg", "jpeg", "png", "gif", "JPG", "JPEG");
				$temp = explode(".", $file["image_path"]["name"]);

				$extension = end($temp);
				$error = "";
				if ($file["image_path"]["error"] > 0) {
					$error .= "Error opening the file. ";
				}
				if ($file["image_path"]["type"] == "application/x-msdownload") {
					$error .= "Mime type not allowed. ";
				}
				if (!in_array($extension, $allowedExts)) {
					$error .= "Extension not allowed. ";
				}

				$fileName  = $this->db->clean($file["image_path"]["name"]);
				$fileSize  = round($file["image_path"]["size"]); // BYTES
				//echo $fileSize ;exit;

				$extension = end(explode(".", $fileName));

				$fileName	= 'user_image_' . substr(sha1(time()), 0, 6) . "." . $extension;
				$filePath 	= "../images/user/" . $fileName;
				move_uploaded_file($file['image_path']['tmp_name'], $filePath);
				$image = $fileName;

				unset($detail['old_image_path']);
			} else {
				$image = $detail['old_image_path'];
			}

			$adate   = date('Y-m-d H:i:m');

			$rows 	= array(

				"name" => $name,
				"email" => $email,
				"mobile" => $mobile,
				"address" => $address,
				"city" => $city,
				"state" => $state,
				"zipcode" => $zipcode,
					"latitude"=>$latitude,
				"longitude"=>$longitude,
				"birth_date" => $birth_date,
				"account_type" => $account_type,
					"account_name"=>$account_name,
				"account_number"=>$account_number,
				"currency" => $currency,
				"image_path" => $image,
				"created_date" => $adate,
			);
			/* $where	= "id='".$_REQUEST['id']."'";
						$uid=$this->db->rp_update($this->ctable,$rows,$where,0);
						$this->log->insertLog($this->ctable,$_REQUEST['id'],"update",$this->log->slm['CUSTOMER_UPDATE']." : ".$customer_name); */


			$where	= "id='" . $id . "'";
			$uid = $this->db->rp_update($this->ctable, $rows, $where, 0);
			$this->log->insertLog($this->ctable, $id, "update", $this->log->slm['USER_UPDATE_SUCESS'] . " : " . $first_name);
			if ($uid != 0) {

				$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('USER_UPDATE_SUCESS', 1), "ack_msg" => $this->log->getMessage('USER_UPDATE_SUCESS'));
				return $reply;
			} else {
				$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('USER_UPDATE_FAILED', 0), "ack_msg" => $this->log->getMessage('USER_UPDATE_FAILED'));
				return $reply;
			}
		}
	}

	public function UserGetEditData($detail)
	{
		$where = " id='" . $detail['id'] . "' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable, "*", $where);
		if ($ctable_r) {
			$ctable_d = mysqli_fetch_array($ctable_r);
			$result = array();
			$result = $ctable_d;
			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('USER_GET_SUCESS', 1), "ack_msg" => $this->log->getMessage('USER_GET_SUCESS'), "result" => $result);
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('USER_GET_FAILED', 0), "ack_msg" => $this->log->getMessage('USER_GET_FAILED'));
			return $reply;
		}
	}
	public function ActiveUser($detail)
	{
		$customer_name = $this->db->rp_getValue($this->ctable, "name", "isDelete=0 AND isActive=1 AND id='" . $detail['id'] . "'");
		$rows 	= array(
			"isActive"	=> $detail['isActive']
		);
		$where	= "id='" . $detail['id'] . "'";
		$uid = $this->db->rp_update($this->ctable, $rows, $where);
		$this->log->insertLog($this->ctable, $detail['id'], "delete", $this->log->slm['VENDOR_STATUS_SUCESS'] . " : " . $customer_name);
		if ($uid != 0) {
			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('USER_STATUS_SUCESS', 1), "ack_msg" => $this->log->getMessage('USER_STATUS_SUCESS'));
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('USER_STATUS_FAILED', 1), "ack_msg" => $this->log->getMessage('USER_STATUS_FAILED'));
			return $reply;
		}
	}

	public function DeleteUser($detail)
	{
		$rows 	= array(
			"isDelete"	=> "1"

		);
		$where	= "id='" . $detail['id'] . "'";
		$isUpdated = $this->db->rp_update($this->ctable, $rows, $where);

		$this->log->insertLog($this->ctable, $detail['id'], "delete", $this->log->slm['USER_DELETE_SUCESS'] . " : ");

		if ($isUpdated) {
			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('USER_DELETE_SUCESS', 1), "ack_msg" => $this->log->getMessage('USER_DELETE_SUCESS'));
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('USER_DELETE_FAILED', 1), "ack_msg" => $this->log->getMessage('USER_DELETE_FAILED'));
			return $reply;
		}
	}


	function getUserDetail($uid)
	{
		$user = array();
		$user_r = $this->db->rp_getData("user", "*", "id='" . $uid . "'", "", 0);

		while ($user_d = mysqli_fetch_assoc($user_r)) {
			$user[] = $user_d;
		}
		return $user;
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
	function countUser($key, $value)
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
