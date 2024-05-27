<?php
require_once("main.class.php");
require_once("function.class.php");
class Modal extends Functions
{
	public $db;
	public $log;
	public $ctable = "modal";
	function __construct($id = "")
	{
		$db = new Functions();
		$conn = $db->connect();
		$this->db = $db;
		$log	= new Log();
		$this->log = $log;
	}
	public function InsertModal($detail, $file)
	{
		extract($detail);

		$dup_where = "brand_id = '" . $brand_id . "' AND modal_name = '" . $modal_name . "' AND isDelete=0";
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
				$picture_filename = pathinfo($file['image_path']['name'], PATHINFO_FILENAME);
				$fileName	= $picture_filename . substr(sha1(time()), 0, 2) . "." . $extension;
				$filePath 	= MODAL_IMAGE_A . $fileName;
				move_uploaded_file($file['image_path']['tmp_name'], $filePath);
				$image = $fileName;
			} else {
				$image = "Image not upload.";
			}
			$rows 	= array(
				"category_id",
				"brand_id",
				"modal_name",
				"image_path",
				"isDelete",
				"isActive",
				"created_date"
			);
			$values = array(
				$category_id,
				// "5",
				$brand_id,
				// "20",
				$modal_name,
				$image,
				0,
				1,
				date("Y-m-d H:i:s")
			);

			$cat_id = $this->db->rp_insert($this->ctable, $values, $rows, 0);
			$this->log->insertLog($this->ctable, $cat_id, "insert", $this->log->slm['MODAL_INSERT_SUCESS'] . " : " . $modal_name);
			if ($cat_id != 0) {
				$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('MODAL_INSERT_SUCESS', 1), "ack_msg" => $this->log->getMessage('MODAL_INSERT_SUCESS'));
				return $reply;
			} else {
				$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('MODAL_INSERT_FAILED', 1), "ack_msg" => $this->log->getMessage('MODAL_INSERT_FAILED'));
				return $reply;
			}
		}
	}
	public function UpdateModal($detail, $file)
	{

		$where = " id='" . $detail['id'] . "' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable, "*", $where);
		$ctable_d = mysqli_fetch_assoc($ctable_r);
		$filePath = MODAL_IMAGE_A . $ctable_d['image_path'];
		unlink($filePath);

		extract($detail);
		$dup_where = "modal_name = '" . $modal_name . "' AND id!='" . $_REQUEST['id'] . "' AND isDelete=0";
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
				$filePath 	= MODAL_IMAGE_A . $fileName;
				move_uploaded_file($file['image_path']['tmp_name'], $filePath);
				$image = $fileName;

				$images = MODAL_IMAGE_A . $detail['old_image_path'];
				unlink($images);

				unset($detail['old_image_path']);
			} else {
				$image = $detail['old_image_path'];
			}
			//	$modal_slug=$this->db->rp_createSlugs("modal_slug",$modal_name,$this->ctable);
			//$modal_slug=$this->db->rp_createSlug($modal_name);
			$rows 	= array(
				"category_id" => $category_id,
				"brand_id" => $brand_id,
				"modal_name" => $modal_name,
				"image_path" => $image,
				"created_date" => $created_date,
			);
			$where	= "id='" . $_REQUEST['id'] . "'";
			$isUpdated = $this->db->rp_update($this->ctable, $rows, $where);
			$this->log->insertLog($this->ctable, $_REQUEST['id'], "update", $this->log->slm['MODAL_UPDATE_SUCESS'] . " : " . $modal_name);
			if ($isUpdated) {
				$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('MODAL_UPDATE_SUCESS', 1), "ack_msg" => $this->log->getMessage('MODAL_UPDATE_SUCESS'));
				return $reply;
			} else {
				$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('MODAL_UPDATE_FAILED', 1), "ack_msg" => $this->log->getMessage('MODAL_UPDATE_FAILED'));
				return $reply;
			}
		}
	}
	public function EditModal($detail)
	{
		$where = " id='" . $detail['id'] . "' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable, "*", $where);
		if ($ctable_r) {
			$ctable_d = mysqli_fetch_array($ctable_r);
			$result = array();

			$result = $ctable_d;

			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('MODAL_GET_SUCESS', 1), "ack_msg" => $this->log->getMessage('MODAL_GET_SUCESS'), "result" => $result);
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('MODAL_GET_FAILED', 1), "ack_msg" => $this->log->getMessage('MODAL_GET_FAILED'));
			return $reply;
		}
	}
	public function DeleteModal($detail)
	{

		$where = " id='" . $detail['id'] . "' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable, "*", $where);
		$ctable_d = mysqli_fetch_assoc($ctable_r);
		$filePath = MODAL_IMAGE_A . $ctable_d['image_path'];
		unlink($filePath);

		$modal_name = $this->db->rp_getValue($this->ctable, "modal_name", "isDelete=0 AND id='" . $detail['id'] . "'");
		$rows 	= array(
			"isDelete"	=> "1"
		);
		$where	= "id='" . $detail['id'] . "'";
		$isUpdated = $this->db->rp_update($this->ctable, $rows, $where);

		$this->log->insertLog($this->ctable, $detail['id'], "delete", $this->log->slm['MODAL_DELETE_SUCESS'] . " : " . $modal_name . " <br/> All Item From Modal " . $modal_name . " deleted");


		if ($isUpdated) {
			$this->db->rp_update("sub_modal", $rows, "brand_id='" . $detail['id'] . "'");
			$this->db->rp_update("sub_sub_modal", $rows, "brand_id='" . $detail['id'] . "'");
			$this->db->rp_update("modal", $rows, "brand_id='" . $detail['id'] . "'");
			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('MODAL_DELETE_SUCESS', 1), "ack_msg" => $this->log->getMessage('MODAL_DELETE_SUCESS'));
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('MODAL_DELETE_FAILED', 1), "ack_msg" => $this->log->getMessage('MODAL_DELETE_FAILED'));
			return $reply;
		}
	}
	public function ActiveModal($detail)
	{
		$rows 	= array(
			"isActive"	=> $detail['isActive']
		);
		$where	= "id='" . $detail['id'] . "'";
		$uid = $this->db->rp_update($this->ctable, $rows, $where);
		$isitemUpdate = $this->db->rp_update("item_fg", $rows, "fg_item_modal IN (" . $detail['id'] . ")", 0);
		if ($uid != 0) {
			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('MODAL_STATUS_SUCESS', 1), "ack_msg" => $this->log->getMessage('MODAL_STATUS_SUCESS'));
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('MODAL_STATUS_FAILED', 1), "ack_msg" => $this->log->getMessage('MODAL_STATUS_FAILED'));
			return $reply;
		}
	}
}