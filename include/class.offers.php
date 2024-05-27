<?php
require_once("main.class.php");
require_once("function.class.php");
class Offers extends Functions
{
	public $db;
	public $log;
	public $ctable = "offers";
	function __construct($id = "")
	{
		$db = new Functions();
		$conn = $db->connect();
		$this->db = $db;
		$log	= new Log();
		$this->log = $log;
	}
	public function InsertOffers($detail, $file)
	{
		extract($detail);
		$dup_where = "offers_name = '" . $offers_name . "' AND isDelete=0";
		$r = $this->db->rp_dupCheck($this->ctable, $dup_where);

		if ($r) {

			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('DUPLICATE_RECORED_FOUND', 1), "ack_msg" => $this->log->getMessage('DUPLICATE_RECORED_FOUND'));
			return $reply;
		} else {
			$offers_slug = $this->db->rp_createSlugs("offers_slug", $offers_name, $this->ctable);
			$rows 	= array(
				"offers_name",
				"code",
				"percentage",
				"is_first_order",
				"isDelete",
				"isActive",
				"created_date"
			);
			$values = array(
				$offers_name,
				$code,
				$percentage,
				$is_first_order,
				0,
				1,
				date("Y-m-d H:i:s")
			);

			$cat_id = $this->db->rp_insert($this->ctable, $values, $rows, 0);
			$this->log->insertLog($this->ctable, $cat_id, "insert", $this->log->slm['OFFERS_INSERT_SUCESS'] . " : " . $offers_name);
			if ($cat_id != 0) {
				$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('OFFERS_INSERT_SUCESS', 1), "ack_msg" => $this->log->getMessage('OFFERS_INSERT_SUCESS'));
				return $reply;
			} else {
				$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('OFFERS_INSERT_FAILED', 1), "ack_msg" => $this->log->getMessage('OFFERS_INSERT_FAILED'));
				return $reply;
			}
		}
	}

	public function UpdateOffers($detail, $file)
	{
		extract($detail);
		$dup_where = "offers_name = '" . $offers_name . "' AND id!='" . $_REQUEST['id'] . "' AND isDelete=0";
		$r = $this->db->rp_dupCheck($this->ctable, $dup_where);


		// $where = " id='" . $detail['id'] . "' AND isDelete=0";
		// $ctable_r = $this->db->rp_getData($this->ctable, "*", $where);
		// $ctable_d = mysqli_fetch_assoc($ctable_r);

		// $images = OFFERS_IMAGE_A . $ctable_d['image_path'];

		// unlink($images);

		if ($r) {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('DUPLICATE_RECORED_FOUND', 1), "ack_msg" => $this->log->getMessage('DUPLICATE_RECORED_FOUND'));
			return $reply;
		} else {
			$created_date = date('Y-m-d H:i:s');
			//	$offers_slug=$this->db->rp_createSlugs("offers_slug",$offers_name,$this->ctable);
			//$offers_slug=$this->db->rp_createSlug($offers_name);
			$rows 	= array(
				"offers_name" => $offers_name,
				"code" => $code,
				"percentage" => $percentage,
				"is_first_order" => $is_first_order,
				"created_date" => $created_date,
			);
			$where	= "id='" . $_REQUEST['id'] . "'";
			$isUpdated = $this->db->rp_update($this->ctable, $rows, $where);
			$this->log->insertLog($this->ctable, $_REQUEST['id'], "update", $this->log->slm['OFFERS_UPDATE_SUCESS'] . " : " . $offers_name);
			if ($isUpdated) {
				$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('OFFERS_UPDATE_SUCESS', 1), "ack_msg" => $this->log->getMessage('OFFERS_UPDATE_SUCESS'));
				return $reply;
			} else {
				$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('OFFERS_UPDATE_FAILED', 1), "ack_msg" => $this->log->getMessage('OFFERS_UPDATE_FAILED'));
				return $reply;
			}
		}
	}


	public function EditOffers($detail)
	{
		$where = " id='" . $detail['id'] . "' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable, "*", $where);
		if ($ctable_r) {
			$ctable_d = mysqli_fetch_array($ctable_r);
			$result = array();

			$result = $ctable_d;

			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('OFFERS_GET_SUCESS', 1), "ack_msg" => $this->log->getMessage('OFFERS_GET_SUCESS'), "result" => $result);
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('OFFERS_GET_FAILED', 1), "ack_msg" => $this->log->getMessage('OFFERS_GET_FAILED'));
			return $reply;
		}
	}
	public function DeleteOffers($detail)
	{

		$offers_name = $this->db->rp_getValue($this->ctable, "offers_name", "isDelete=0 AND id='" . $detail['id'] . "'");
		$rows 	= array(
			"isDelete"	=> "1"
		);
		$where	= "id='" . $detail['id'] . "'";
		$isUpdated = $this->db->rp_update($this->ctable, $rows, $where);

		$this->log->insertLog($this->ctable, $detail['id'], "delete", $this->log->slm['OFFERS_DELETE_SUCESS'] . " : " . $offers_name . " <br/> All Item From Offers " . $offers_name . " deleted");


		if ($isUpdated) {
			$this->db->rp_update("brand", $rows, "offers_id='" . $detail['id'] . "'");
			$this->db->rp_update("modal", $rows, "offers_id='" . $detail['id'] . "'");
			// $this->db->rp_update("product", $rows, "cid='" . $detail['id'] . "'");
			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('OFFERS_DELETE_SUCESS', 1), "ack_msg" => $this->log->getMessage('OFFERS_DELETE_SUCESS'));
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('OFFERS_DELETE_FAILED', 1), "ack_msg" => $this->log->getMessage('OFFERS_DELETE_FAILED'));
			return $reply;
		}
	}
	public function ActiveOffers($detail)
	{
		$rows 	= array(
			"isActive"	=> $detail['isActive']
		);
		$where	= "id='" . $detail['id'] . "'";
		$uid = $this->db->rp_update($this->ctable, $rows, $where);
		$isitemUpdate = $this->db->rp_update("item_fg", $rows, "fg_item_offers IN (" . $detail['id'] . ")", 0);
		if ($uid != 0) {
			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('OFFERS_STATUS_SUCESS', 1), "ack_msg" => $this->log->getMessage('OFFERS_STATUS_SUCESS'));
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('OFFERS_STATUS_FAILED', 1), "ack_msg" => $this->log->getMessage('OFFERS_STATUS_FAILED'));
			return $reply;
		}
	}
}
