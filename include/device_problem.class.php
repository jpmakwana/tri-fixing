<?php
require_once("main.class.php");
require_once("function.class.php");
class Device_problem extends Functions
{
	public $db;
	public $log;
	public $ctable = "device_problem";
	public $ctable1 = "Sub_device_problem";
	function __construct($id = "")
	{
		$db = new Functions();
		$conn = $db->connect();
		$this->db = $db;
		$log	= new Log();
		$this->log = $log;
	}
	public function InsertDevice_problem($detail, $file)
	{
		// print_r($detail);
		// exit;
		extract($detail);
		$dup_where = "modal_id = '" . $modal_id . "' AND device_problem_name = '" . $device_problem_name . "' AND isDelete=0";
		$r = $this->db->rp_dupCheck($this->ctable, $dup_where);

		if ($r) {

			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('DUPLICATE_RECORED_FOUND', 1), "ack_msg" => $this->log->getMessage('DUPLICATE_RECORED_FOUND'));
			return $reply;
		} else {

			$rows 	= array(
				"category_id",
				"brand_id",
				"modal_id",
				"device_problem_type_id",
				"device_problem_name",
				"amount",
				"isDelete",
				"isActive",
				"created_date"
			);
			$values = array(
				$category_id,
				$brand_id,
				$modal_id,
				$device_problem_type_id,
				$device_problem_name,
				$amount,
				0,
				1,
				date("Y-m-d H:i:s")
			);
			$problem_id = $this->db->rp_insert($this->ctable, $values, $rows, 0);

			$rows1 	= array(
				"device_problem_id",
				"device_problem_type_id",
				"amount",
				"isDelete",
				"isActive",
				"created_date"
			);
			$values1 = array(
				$problem_id,
				$device_problem_type_id,
				$amount,
				0,
				1,
				date("Y-m-d H:i:s")
			);
			$this->db->rp_insert($this->ctable1, $values1, $rows1, 0);

			$this->log->insertLog($this->ctable, $problem_id, "insert", $this->log->slm['DEVICE_PROBLEM_INSERT_SUCESS'] . " : " . $device_problem_name);
			if ($problem_id != 0) {
				$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('DEVICE_PROBLEM_INSERT_SUCESS', 1), "ack_msg" => $this->log->getMessage('DEVICE_PROBLEM_INSERT_SUCESS'));
				return $reply;
			} else {
				$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('DEVICE_PROBLEM_INSERT_FAILED', 1), "ack_msg" => $this->log->getMessage('DEVICE_PROBLEM_INSERT_FAILED'));
				return $reply;
			}
		}
	}
	public function UpdateDevice_problem($detail, $file)
	{
		extract($detail);
		$dup_where = "device_problem_name = '" . $device_problem_name . "' AND isDelete=0 AND modal_id='" . $_REQUEST['modal_id'] . "' ";
		$r = $this->db->rp_dupCheck($this->ctable, $dup_where);

		if ($r) {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('DUPLICATE_RECORED_FOUND', 1), "ack_msg" => $this->log->getMessage('DUPLICATE_RECORED_FOUND'));
			return $reply;
		} else {
			$created_date = date('Y-m-d H:i:s');


			//	$device_problem_slug=$this->db->rp_createSlugs("device_problem_slug",$device_problem_name,$this->ctable);
			//$device_problem_slug=$this->db->rp_createSlug($device_problem_name);
			$rows 	= array(
				"category_id" => $category_id,
				"brand_id" => $brand_id,
				"modal_id" => $modal_id,
				"device_problem_type_id"	=> $device_problem_type_id,
				"device_problem_name"	=> $device_problem_name,
				"amount" => $amount,
				"created_date" => $created_date,
			);
			$where	= "id='" . $_REQUEST['id'] . "'";
			$isUpdated = $this->db->rp_update($this->ctable, $rows, $where);
			$this->log->insertLog($this->ctable, $_REQUEST['id'], "update", $this->log->slm['DEVICE_PROBLEM_UPDATE_SUCESS'] . " : " . $device_problem_name);
			if ($isUpdated) {
				$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('DEVICE_PROBLEM_UPDATE_SUCESS', 1), "ack_msg" => $this->log->getMessage('DEVICE_PROBLEM_UPDATE_SUCESS'));
				return $reply;
			} else {
				$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('DEVICE_PROBLEM_UPDATE_FAILED', 1), "ack_msg" => $this->log->getMessage('DEVICE_PROBLEM_UPDATE_FAILED'));
				return $reply;
			}
		}
	}
	public function EditDevice_problem($detail)
	{
		$where = " id='" . $detail['id'] . "' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable, "*", $where);
		if ($ctable_r) {
			$ctable_d = mysqli_fetch_array($ctable_r);
			$result = array();

			$result = $ctable_d;

			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('DEVICE_PROBLEM_GET_SUCESS', 1), "ack_msg" => $this->log->getMessage('DEVICE_PROBLEM_GET_SUCESS'), "result" => $result);
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('DEVICE_PROBLEM_GET_FAILED', 1), "ack_msg" => $this->log->getMessage('DEVICE_PROBLEM_GET_FAILED'));
			return $reply;
		}
	}
	public function DeleteDevice_problem($detail)
	{

		$device_problem_name = $this->db->rp_getValue($this->ctable, "device_problem_name", "isDelete=0 AND id='" . $detail['id'] . "'");
		$rows 	= array(
			"isDelete"	=> "1"
		);
		$where	= "id='" . $detail['id'] . "'";
		$isUpdated = $this->db->rp_update($this->ctable, $rows, $where);

		$this->log->insertLog($this->ctable, $detail['id'], "delete", $this->log->slm['DEVICE_PROBLEM_DELETE_SUCESS'] . " : " . $device_problem_name . " <br/> All Item From Device_problem " . $device_problem_name . " deleted");


		if ($isUpdated) {
			$this->db->rp_update("sub_device_problem", $rows, "cid='" . $detail['id'] . "'");
			$this->db->rp_update("sub_sub_device_problem", $rows, "cid='" . $detail['id'] . "'");
			$this->db->rp_update("product", $rows, "cid='" . $detail['id'] . "'");
			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('DEVICE_PROBLEM_DELETE_SUCESS', 1), "ack_msg" => $this->log->getMessage('DEVICE_PROBLEM_DELETE_SUCESS'));
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('DEVICE_PROBLEM_DELETE_FAILED', 1), "ack_msg" => $this->log->getMessage('DEVICE_PROBLEM_DELETE_FAILED'));
			return $reply;
		}
	}
	public function ActiveDevice_problem($detail)
	{
		$rows 	= array(
			"isActive"	=> $detail['isActive']
		);
		$where	= "id='" . $detail['id'] . "'";
		$uid = $this->db->rp_update($this->ctable, $rows, $where);
		$isitemUpdate = $this->db->rp_update("item_fg", $rows, "fg_item_device_problem IN (" . $detail['id'] . ")", 0);
		if ($uid != 0) {
			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('DEVICE_PROBLEM_STATUS_SUCESS', 1), "ack_msg" => $this->log->getMessage('DEVICE_PROBLEM_STATUS_SUCESS'));
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('DEVICE_PROBLEM_STATUS_FAILED', 1), "ack_msg" => $this->log->getMessage('DEVICE_PROBLEM_STATUS_FAILED'));
			return $reply;
		}
	}
}
