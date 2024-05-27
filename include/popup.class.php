<?php
require_once("main.class.php");
require_once("function.class.php");
class Popup extends Functions
{
	public $db;
	public $log;
	public $ctable = "popup";
	function __construct($id = "")
	{
		$db = new Functions();
		$conn = $db->connect();
		$this->db = $db;
		$log	= new Log();
		$this->log = $log;
	}
	public function InsertPopup($detail, $file)
	{
		// print_r($_FILES);
		// exit;
		extract($detail);
		$dup_where = "image_path = '" . $image_path . "' AND isDelete=0";
		$r = $this->db->rp_dupCheck($this->ctable, $dup_where);

		if ($r) {

			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('DUPLICATE_RECORED_FOUND', 1), "ack_msg" => $this->log->getMessage('DUPLICATE_RECORED_FOUND'));
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
				$adate   = date('Y-m-d H:i:m');

				$extension = end(explode(".", $fileName));

				$fileName	= 'cat_image_' . substr(sha1(time()), 0, 6) . "." . $extension;
				$filePath 	= POPUP_IMAGE_A . $fileName;
				move_uploaded_file($file['image_path']['tmp_name'], $filePath);
				$image = $fileName;
			} else {
				$image = "Image not upload.";
			}
			$popup_slug = $this->db->rp_createSlugs("popup_slug", $popup_name, $this->ctable);
			$rows 	= array(
				"popup_name",
				"popup_slug",
				"image_path",
				"isDelete",
				"isActive",
				"created_date"
			);
			$values = array(
				$popup_name,
				$popup_slug,
				$image,
				0,
				1,
				date("Y-m-d H:i:s")
			);

			$cat_id = $this->db->rp_insert($this->ctable, $values, $rows, 0);
			$this->log->insertLog($this->ctable, $cat_id, "insert", $this->log->slm['POPUP_INSERT_SUCESS'] . " : " . $popup_name);
			if ($cat_id != 0) {
				$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('POPUP_INSERT_SUCESS', 1), "ack_msg" => $this->log->getMessage('POPUP_INSERT_SUCESS'));
				return $reply;
			} else {
				$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('POPUP_INSERT_FAILED', 1), "ack_msg" => $this->log->getMessage('POPUP_INSERT_FAILED'));
				return $reply;
			}
		}
	}
	public function UpdatePopup($detail, $file)
	{
		extract($detail);
		// print_r($file);
		// exit;
		$dup_where = "image_path = '" . $image_path . "' AND id!='" . $_REQUEST['id'] . "' AND isDelete=0";
		$r = $this->db->rp_dupCheck($this->ctable, $dup_where);
		if ($r) {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('DUPLICATE_RECORED_FOUND', 1), "ack_msg" => $this->log->getMessage('DUPLICATE_RECORED_FOUND'));
			return $reply;
		} else {
			$created_date = date('Y-m-d H:i:s');
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
				$adate   = date('Y-m-d H:i:m');

				$extension = end(explode(".", $fileName));

				$fileName	= 'cat_image_' . substr(sha1(time()), 0, 6) . "." . $extension;
				$filePath 	= POPUP_IMAGE_A . $fileName;
				move_uploaded_file($file['image_path']['tmp_name'], $filePath);
				$image = $fileName;

				unset($detail['old_image_path']);
			} else {
				$image = $detail['old_image_path'];
			}
			//	$popup_slug=$this->db->rp_createSlugs("popup_slug",$popup_name,$this->ctable);
			//$popup_slug=$this->db->rp_createSlug($popup_name);
			$rows 	= array(
				"popup_name"				=> $popup_name,
				"image_path"                => $image,
				"created_date"				=> $created_date,
			);
			$where	= "id='" . $_REQUEST['id'] . "'";
			$isUpdated = $this->db->rp_update($this->ctable, $rows, $where);
			$this->log->insertLog($this->ctable, $_REQUEST['id'], "update", $this->log->slm['POPUP_UPDATE_SUCESS'] . " : " . $popup_name);
			if ($isUpdated) {
				$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('POPUP_UPDATE_SUCESS', 1), "ack_msg" => $this->log->getMessage('POPUP_UPDATE_SUCESS'));
				return $reply;
			} else {
				$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('POPUP_UPDATE_FAILED', 1), "ack_msg" => $this->log->getMessage('POPUP_UPDATE_FAILED'));
				return $reply;
			}
		}
	}
	public function EditPopup($detail)
	{
		$where = " id='" . $detail['id'] . "' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable, "*", $where);
		if ($ctable_r) {
			$ctable_d = mysqli_fetch_array($ctable_r);
			$result = array();

			$result = $ctable_d;

			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('POPUP_GET_SUCESS', 1), "ack_msg" => $this->log->getMessage('POPUP_GET_SUCESS'), "result" => $result);
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('POPUP_GET_FAILED', 1), "ack_msg" => $this->log->getMessage('POPUP_GET_FAILED'));
			return $reply;
		}
	}
	
	public function DeletePopup($detail)
	{
		$popup_name = $this->db->rp_getValue($this->ctable, "popup_name", "isDelete=0 AND id='" . $detail['id'] . "'");
		$rows 	= array(
			"isDelete"	=> "1"
		);
		$where	= "id='" . $detail['id'] . "'";
		$isDeleted = $this->db->rp_delete($this->ctable, $where);

		$this->log->insertLog($this->ctable, $detail['id'], "delete", $this->log->slm['POPUP_DELETE_SUCESS'] . " : " . $popup_name . " <br/> All Item From Popup " . $popup_name . " deleted");


		if ($isDeleted) {
			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('POPUP_DELETE_SUCESS', 1), "ack_msg" => $this->log->getMessage('POPUP_DELETE_SUCESS'));
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('POPUP_DELETE_FAILED', 1), "ack_msg" => $this->log->getMessage('POPUP_DELETE_FAILED'));
			return $reply;
		}
	}

	public function ActivePopup($detail)
	{
		$rows 	= array(
			"isActive"	=> $detail['isActive']
		);
		$where	= "id='" . $detail['id'] . "'";
		$uid = $this->db->rp_update($this->ctable, $rows, $where);
		$isitemUpdate = $this->db->rp_update("item_fg", $rows, "fg_item_popup IN (" . $detail['id'] . ")", 0);
		if ($uid != 0) {
			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('POPUP_STATUS_SUCESS', 1), "ack_msg" => $this->log->getMessage('POPUP_STATUS_SUCESS'));
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('POPUP_STATUS_FAILED', 1), "ack_msg" => $this->log->getMessage('POPUP_STATUS_FAILED'));
			return $reply;
		}
	}
}
