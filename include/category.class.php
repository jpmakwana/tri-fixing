<?php
require_once("main.class.php");
require_once("function.class.php");
class Category extends Functions
{
	public $db;
	public $log;
	public $ctable = "category";
	function __construct($id = "")
	{
		$db = new Functions();
		$conn = $db->connect();
		$this->db = $db;
		$log	= new Log();
		$this->log = $log;
	}
	public function InsertCategory($detail, $file)
	{
		extract($detail);
		$dup_where = "category_name = '" . $category_name . "' AND isDelete=0";
		$r = $this->db->rp_dupCheck($this->ctable, $dup_where);

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

			$adate   = date('Y-m-d H:i:m');

			$extension = end(explode(".", $fileName));

			$fileName	= 'category_image_' . substr(sha1(time()), 0, 6) . "." . $extension;
			$filePath 	= "../images/category/" . $fileName;
			move_uploaded_file($file['image_path']['tmp_name'], $filePath);
			$image = $fileName;
		} else {
			$image = "Image not upload.";
		}

		if ($r) {

			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('DUPLICATE_RECORED_FOUND', 1), "ack_msg" => $this->log->getMessage('DUPLICATE_RECORED_FOUND'));
			return $reply;
		} else {
			$category_slug = $this->db->rp_createSlugs("category_slug", $category_name, $this->ctable);
			$rows 	= array(
				"category_name",
				"description",
				"image_path",
				"isDelete",
				"isActive",
				"created_date"
			);
			$values = array(
				$category_name,
				$description,
				$image,
				0,
				1,
				date("Y-m-d H:i:s")
			);

			$cat_id = $this->db->rp_insert($this->ctable, $values, $rows, 0);
			$this->log->insertLog($this->ctable, $cat_id, "insert", $this->log->slm['CATEGORY_INSERT_SUCESS'] . " : " . $category_name);
			if ($cat_id != 0) {
				$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('CATEGORY_INSERT_SUCESS', 1), "ack_msg" => $this->log->getMessage('CATEGORY_INSERT_SUCESS'));
				return $reply;
			} else {
				$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('CATEGORY_INSERT_FAILED', 1), "ack_msg" => $this->log->getMessage('CATEGORY_INSERT_FAILED'));
				return $reply;
			}
		}
	}

	public function UpdateCategory($detail, $file)
	{
		extract($detail);
		$dup_where = "category_name = '" . $category_name . "' AND id!='" . $_REQUEST['id'] . "' AND isDelete=0";
		$r = $this->db->rp_dupCheck($this->ctable, $dup_where);


		// $where = " id='" . $detail['id'] . "' AND isDelete=0";
		// $ctable_r = $this->db->rp_getData($this->ctable, "*", $where);
		// $ctable_d = mysqli_fetch_assoc($ctable_r);

		// $images = CATEGORY_IMAGE_A . $ctable_d['image_path'];

		// unlink($images);

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

				$fileName	= 'category_image_' . substr(sha1(time()), 0, 6) . "." . $extension;
				$filePath 	= "../images/category/" . $fileName;
				move_uploaded_file($file['image_path']['tmp_name'], $filePath);
				$image = $fileName;

				$images = CATEGORY_IMAGE_A . $detail['old_image_path'];
				unlink($images);

				unset($detail['old_image_path']);
			} else {
				$image = $detail['old_image_path'];
			}
			//	$category_slug=$this->db->rp_createSlugs("category_slug",$category_name,$this->ctable);
			//$category_slug=$this->db->rp_createSlug($category_name);
			$rows 	= array(

				"category_name" => $category_name,
				"description" => $description,
				"image_path" => $image,
				"created_date" => $created_date,
			);
			$where	= "id='" . $_REQUEST['id'] . "'";
			$isUpdated = $this->db->rp_update($this->ctable, $rows, $where);
			$this->log->insertLog($this->ctable, $_REQUEST['id'], "update", $this->log->slm['CATEGORY_UPDATE_SUCESS'] . " : " . $category_name);
			if ($isUpdated) {
				$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('CATEGORY_UPDATE_SUCESS', 1), "ack_msg" => $this->log->getMessage('CATEGORY_UPDATE_SUCESS'));
				return $reply;
			} else {
				$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('CATEGORY_UPDATE_FAILED', 1), "ack_msg" => $this->log->getMessage('CATEGORY_UPDATE_FAILED'));
				return $reply;
			}
		}
	}


	public function EditCategory($detail)
	{
		$where = " id='" . $detail['id'] . "' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable, "*", $where);
		if ($ctable_r) {
			$ctable_d = mysqli_fetch_array($ctable_r);
			$result = array();

			$result = $ctable_d;

			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('CATEGORY_GET_SUCESS', 1), "ack_msg" => $this->log->getMessage('CATEGORY_GET_SUCESS'), "result" => $result);
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('CATEGORY_GET_FAILED', 1), "ack_msg" => $this->log->getMessage('CATEGORY_GET_FAILED'));
			return $reply;
		}
	}
	public function DeleteCategory($detail)
	{

		$where = " id='" . $detail['id'] . "' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable, "*", $where);
		$ctable_d = mysqli_fetch_assoc($ctable_r);

		$images = CATEGORY_IMAGE_A . $ctable_d['image_path'];

		unlink($images);


		$category_name = $this->db->rp_getValue($this->ctable, "category_name", "isDelete=0 AND id='" . $detail['id'] . "'");
		$rows 	= array(
			"isDelete"	=> "1"
		);
		$where	= "id='" . $detail['id'] . "'";
		$isUpdated = $this->db->rp_update($this->ctable, $rows, $where);

		$this->log->insertLog($this->ctable, $detail['id'], "delete", $this->log->slm['CATEGORY_DELETE_SUCESS'] . " : " . $category_name . " <br/> All Item From Category " . $category_name . " deleted");


		if ($isUpdated) {
			$this->db->rp_update("brand", $rows, "category_id='" . $detail['id'] . "'");
			$this->db->rp_update("modal", $rows, "category_id='" . $detail['id'] . "'");
			// $this->db->rp_update("product", $rows, "cid='" . $detail['id'] . "'");
			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('CATEGORY_DELETE_SUCESS', 1), "ack_msg" => $this->log->getMessage('CATEGORY_DELETE_SUCESS'));
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('CATEGORY_DELETE_FAILED', 1), "ack_msg" => $this->log->getMessage('CATEGORY_DELETE_FAILED'));
			return $reply;
		}
	}
	public function ActiveCategory($detail)
	{
		$rows 	= array(
			"isActive"	=> $detail['isActive']
		);
		$where	= "id='" . $detail['id'] . "'";
		$uid = $this->db->rp_update($this->ctable, $rows, $where);
		$isitemUpdate = $this->db->rp_update("item_fg", $rows, "fg_item_category IN (" . $detail['id'] . ")", 0);
		if ($uid != 0) {
			$reply = array("ack" => 1, "developer_msg" => $this->log->getMessage('CATEGORY_STATUS_SUCESS', 1), "ack_msg" => $this->log->getMessage('CATEGORY_STATUS_SUCESS'));
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => $this->log->getMessage('CATEGORY_STATUS_FAILED', 1), "ack_msg" => $this->log->getMessage('CATEGORY_STATUS_FAILED'));
			return $reply;
		}
	}
}
