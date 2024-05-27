<?php
require_once("main.class.php");
require_once("function.class.php");
class Gallery extends Functions
{
	public $db;
	public $log;
	public $ctable = "gallery";
	function __construct($id = "")
	{
		$db = new Functions();
		$conn = $db->connect();
		$this->db = $db;
		$log	= new Log();
		$this->log = $log;
	}
	public function InsertGallery($detail, $file)
	{
		extract($detail);



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
				$fileSize  = round($file["image_path"]["size"]);
				// BYTES
				//echo $fileSize ;exit;
				$adate   = date('Y-m-d H:i:m');

				$extension = end(explode(".", $fileName));

				$fileName	= 'cat_image_' . substr(sha1(time()), 0, 6) . "." . $extension;
				$filePath 	= GALLERY_IMAGE_A . $fileName;
				move_uploaded_file($file['image_path']['tmp_name'], $filePath);
				$image = $fileName;
			} else {
				$image = "Image not upload.";
			}
			$gallery_slug = $this->db->rp_createSlugs("gallery_slug", $gallery_name, $this->ctable);
			$rows 	= array(

				"gallery_slug",
				"image_path",
				"isDelete",
				"isActive",
				"created_date"
			);
			$values = array(

				$gallery_slug,
				$image,
				0,
				1,
				date("Y-m-d H:i:s")
			);

			$cat_id = $this->db->rp_insert($this->ctable, $values, $rows, 0);
			$this->log->insertLog($this->ctable, $cat_id, "insert", $this->log->slm['GALLERY_INSERT_SUCESS'] . " : " . $gallery_name);
			if ($cat_id != 0) {
				$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('GALLERY_INSERT_SUCESS', 1), "ack_msg" => $this->log->getMessage('GALLERY_INSERT_SUCESS'));
				return $reply;
			} else {
				$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('GALLERY_INSERT_FAILED', 1), "ack_msg" => $this->log->getMessage('GALLERY_INSERT_FAILED'));
				return $reply;
			}
		}
	}
	public function UpdateGallery($detail, $file)
	{
		extract($detail);
		// print_r($_FILES);
		// exit;

		$where = " id='" . $detail['id'] . "' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable, "*", $where);
		$ctable_d = mysqli_fetch_assoc($ctable_r);
		$filePath = GALLERY_IMAGE_A . $ctable_d['image_path'];
		unlink($filePath);

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
				$filePath 	= GALLERY_IMAGE_A . $fileName;
				move_uploaded_file($file['image_path']['tmp_name'], $filePath);
				$image = $fileName;

				$images = GALLERY_IMAGE_A . $detail['old_image_path'];
				unlink($images);

				unset($detail['old_image_path']);
			} else {
				$image = $detail['old_image_path'];
			}
			//	$gallery_slug=$this->db->rp_createSlugs("gallery_slug",$gallery_name,$this->ctable);
			//$gallery_slug=$this->db->rp_createSlug($gallery_name);
			$rows 	= array(
				"image_path"                => $image,
				"created_date"				=> $created_date,
			);
			$where	= "id='" . $_REQUEST['id'] . "'";
			$isUpdated = $this->db->rp_update($this->ctable, $rows, $where);
			$this->log->insertLog($this->ctable, $_REQUEST['id'], "update", $this->log->slm['GALLERY_UPDATE_SUCESS'] . " : " . $gallery_name);
			if ($isUpdated) {
				$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('GALLERY_UPDATE_SUCESS', 1), "ack_msg" => $this->log->getMessage('GALLERY_UPDATE_SUCESS'));
				return $reply;
			} else {
				$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('GALLERY_UPDATE_FAILED', 1), "ack_msg" => $this->log->getMessage('GALLERY_UPDATE_FAILED'));
				return $reply;
			}
		}
	}
	public function EditGallery($detail)
	{
		$where = " id='" . $detail['id'] . "' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable, "*", $where);


		if ($ctable_r) {
			$ctable_d = mysqli_fetch_array($ctable_r);
			$result = array();

			$result = $ctable_d;
			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('GALLERY_GET_SUCESS', 1), "ack_msg" => $this->log->getMessage('GALLERY_GET_SUCESS'), "result" => $result);
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('GALLERY_GET_FAILED', 1), "ack_msg" => $this->log->getMessage('GALLERY_GET_FAILED'));
			return $reply;
		}
	}
	public function DeleteGallery($detail)
	{

		$where = " id='" . $detail['id'] . "' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable, "*", $where);
		$ctable_d = mysqli_fetch_assoc($ctable_r);
		$filePath 	= GALLERY_IMAGE_A . $ctable_d['image_path'];
		unlink($filePath);

		$gallery_name = $this->db->rp_getValue($this->ctable, "gallery_name", "isDelete=0 AND id='" . $detail['id'] . "'");
		$rows 	= array(
			"isDelete"	=> "1"
		);
		$where	= "id='" . $detail['id'] . "'";
		$isUpdated = $this->db->rp_update($this->ctable, $rows, $where);

		$this->log->insertLog($this->ctable, $detail['id'], "delete", $this->log->slm['GALLERY_DELETE_SUCESS'] . " : " . $gallery_name . " <br/> All Item From Gallery " . $gallery_name . " deleted");

		if ($isUpdated) {
			$this->db->rp_update("sub_gallery", $rows, "cid='" . $detail['id'] . "'");
			$this->db->rp_update("sub_sub_gallery", $rows, "cid='" . $detail['id'] . "'");
			$this->db->rp_update("product", $rows, "cid='" . $detail['id'] . "'");
			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('GALLERY_DELETE_SUCESS', 1), "ack_msg" => $this->log->getMessage('GALLERY_DELETE_SUCESS'));
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('GALLERY_DELETE_FAILED', 1), "ack_msg" => $this->log->getMessage('GALLERY_DELETE_FAILED'));
			return $reply;
		}
	}
	public function ActiveGallery($detail)
	{
		$rows 	= array(
			"isActive"	=> $detail['isActive']
		);
		$where	= "id='" . $detail['id'] . "'";
		$uid = $this->db->rp_update($this->ctable, $rows, $where);
		$isitemUpdate = $this->db->rp_update("item_fg", $rows, "fg_item_gallery IN (" . $detail['id'] . ")", 0);
		if ($uid != 0) {
			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('GALLERY_STATUS_SUCESS', 1), "ack_msg" => $this->log->getMessage('GALLERY_STATUS_SUCESS'));
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('GALLERY_STATUS_FAILED', 1), "ack_msg" => $this->log->getMessage('GALLERY_STATUS_FAILED'));
			return $reply;
		}
	}
}
