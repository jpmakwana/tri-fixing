<?php
require_once("main.class.php");
require_once("function.class.php");
class Sub_device_problem extends Functions
{
	public $db;
	public $log;
	public $ctable = "sub_device_problem";
	public $ctable1 = "device_problem";
	function __construct($id = "")
	{
		$db = new Functions();
		$conn = $db->connect();
		$this->db = $db;
		$log	= new Log();
		$this->log = $log;
	}
	public function InsertSub_device_problem($detail, $file)
	{
		extract($detail);
		$dup_where = "device_problem_type_id = '" . $device_problem_type_id . "' AND device_problem_id = '" . $device_problem_id . "' AND isDelete=0";
		$r = $this->db->rp_dupCheck($this->ctable, $dup_where);
		if ($r) {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('DUPLICATE_RECORED_FOUND', 1), "ack_msg" => $this->log->getMessage('DUPLICATE_RECORED_FOUND'));
			return $reply;
		} else {

			$rows 	= array(
				"device_problem_id",
				"device_problem_type_id",
				"amount",
				"isDelete",
				"isActive",
				"created_date"
			);
			$values = array(
				$device_problem_id,
				$device_problem_type_id,
				$amount,
				0,
				1,
				date("Y-m-d H:i:s")
			);

			$cat_id = $this->db->rp_insert($this->ctable, $values, $rows, 0);

			$this->log->insertLog($this->ctable, $cat_id, "insert", $this->log->slm['BRAND_INSERT_SUCESS'] . " : " . $sub_device_problem_name);
			if ($cat_id != 0) {
				$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('BRAND_INSERT_SUCESS', 1), "ack_msg" => $this->log->getMessage('BRAND_INSERT_SUCESS'));
				return $reply;
			} else {
				$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('BRAND_INSERT_FAILED', 1), "ack_msg" => $this->log->getMessage('BRAND_INSERT_FAILED'));
				return $reply;
			}
		}
	}
	public function UpdateSub_device_problem($detail, $file)
	{
		extract($detail);
		$dup_where = "category_id = '" . $category_id . "' AND sub_device_problem_name = '" . $sub_device_problem_name . "' AND id!='" . $_REQUEST['id'] . "' AND isDelete=0";
		// $dup_where = "sub_device_problem_name = '" . $sub_device_problem_name . "' AND id!='" . $_REQUEST['id'] . "' AND isDelete=0";
		$r = $this->db->rp_dupCheck($this->ctable, $dup_where);

		if ($r) {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('DUPLICATE_RECORED_FOUND', 1), "ack_msg" => $this->log->getMessage('DUPLICATE_RECORED_FOUND'));
			return $reply;
		} else {
			$created_date = date('Y-m-d H:i:s');
			$rows 	= array(
				"device_problem_id" => $device_problem_id,
				"device_problem_type_id"	=> $device_problem_type_id,
				"amount" => $amount,
				"created_date" => $created_date,
			);
			$where	= "id='" . $_REQUEST['id'] . "'";
			$isUpdated = $this->db->rp_update($this->ctable, $rows, $where);
			$this->log->insertLog($this->ctable, $_REQUEST['id'], "update", $this->log->slm['BRAND_UPDATE_SUCESS'] . " : " . $sub_device_problem_name);
			if ($isUpdated) {
				$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('BRAND_UPDATE_SUCESS', 1), "ack_msg" => $this->log->getMessage('BRAND_UPDATE_SUCESS'));
				return $reply;
			} else {
				$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('BRAND_UPDATE_FAILED', 1), "ack_msg" => $this->log->getMessage('BRAND_UPDATE_FAILED'));
				return $reply;
			}
		}
	}
	public function EditSub_device_problem($detail)
	{
		$where = " id='" . $detail['id'] . "' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable, "*", $where);
		if ($ctable_r) {
			$ctable_d = mysqli_fetch_array($ctable_r);
			$result = array();

			$result = $ctable_d;

			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('BRAND_GET_SUCESS', 1), "ack_msg" => $this->log->getMessage('BRAND_GET_SUCESS'), "result" => $result);
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('BRAND_GET_FAILED', 1), "ack_msg" => $this->log->getMessage('BRAND_GET_FAILED'));
			return $reply;
		}
	}
	public function DeleteSub_device_problem($detail)
	{

		$where = " id='" . $detail['id'] . "' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable, "*", $where);
		$ctable_d = mysqli_fetch_assoc($ctable_r);

		$images = BRAND_IMAGE_A . $ctable_d['image_path'];

		unlink($images);

		$sub_device_problem_name = $this->db->rp_getValue($this->ctable, "sub_device_problem_name", "isDelete=0 AND id='" . $detail['id'] . "'");
		$rows 	= array(
			"isDelete"	=> "1"
		);
		$where	= "id='" . $detail['id'] . "'";
		$isUpdated = $this->db->rp_update($this->ctable, $rows, $where);

		$this->log->insertLog($this->ctable, $detail['id'], "delete", $this->log->slm['BRAND_DELETE_SUCESS'] . " : " . $sub_device_problem_name . " <br/> All Item From Sub_device_problem " . $sub_device_problem_name . " deleted");


		if ($isUpdated) {
			$this->db->rp_update("modal", $rows, "sub_device_problem_id='" . $detail['id'] . "'");
			$this->db->rp_update("sub_sub_sub_device_problem", $rows, "cid='" . $detail['id'] . "'");
			$this->db->rp_update("product", $rows, "cid='" . $detail['id'] . "'");
			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('BRAND_DELETE_SUCESS', 1), "ack_msg" => $this->log->getMessage('BRAND_DELETE_SUCESS'));
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('BRAND_DELETE_FAILED', 1), "ack_msg" => $this->log->getMessage('BRAND_DELETE_FAILED'));
			return $reply;
		}
	}
	public function ActiveSub_device_problem($detail)
	{
		$rows 	= array(
			"isActive"	=> $detail['isActive']
		);
		$where	= "id='" . $detail['id'] . "'";
		$uid = $this->db->rp_update($this->ctable, $rows, $where);
		$isitemUpdate = $this->db->rp_update("item_fg", $rows, "fg_item_sub_device_problem IN (" . $detail['id'] . ")", 0);
		if ($uid != 0) {
			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('BRAND_STATUS_SUCESS', 1), "ack_msg" => $this->log->getMessage('BRAND_STATUS_SUCESS'));
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('BRAND_STATUS_FAILED', 1), "ack_msg" => $this->log->getMessage('BRAND_STATUS_FAILED'));
			return $reply;
		}
	}
}
