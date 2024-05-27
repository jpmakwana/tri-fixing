<?php
require_once("class.log.php");
class System extends Functions
{
	public $db;
	public $objOrder;
	public $log;
	public static $ORDER_TABLE = "order_detail";
	public static $PRUCHASE_ORDER_TABLE = "purchase_order";
	public static $Settings = array();
	public static $CtableSetting = "application_settings";
	function __construct($id = "")
	{
		$db = new Functions();
		$conn = $db->connect();
		$this->conn = $conn;
		$this->db = $db;
		$this->log = new Log();
		$this->GetApplicationSettings();
		//$this->notifications=(isset($_SESSION[SESS_NOTIFICATION]))?$_SESSION[SESS_NOTIFICATION]:array();
		$this->user_id = isset($_SESSION[SITE_SESS . '_ADMIN_SESS_ID']) ? $_SESSION[SITE_SESS . '_ADMIN_SESS_ID'] : "";
		$notification_type = array("1" => "Expense Message", "2" => "Admin Message");
	}

	function getSystemInfo()
	{



		
		$category = $this->rp_getTotalRecord("category", "isDelete=0", 0);
		$product = $this->rp_getTotalRecord("product", "isDelete=0", 0);
		$inquiry = $this->rp_getTotalRecord("inquiry", "isDelete=0", 0);
		$blog = $this->rp_getTotalRecord("blog", "isDelete=0", 0);
		$gallery = $this->rp_getTotalRecord("gallery", "isDelete=0", 0);
		$banner = $this->rp_getTotalRecord("banner", "isDelete=0", 0);
		$faq = $this->rp_getTotalRecord("faq", "isDelete=0", 0);
		$department = $this->rp_getTotalRecord("department", "isDelete=0", 0);
		$User = $this->rp_getTotalRecord("user", "isDelete=0", 0);	
		$food = $this->rp_getTotalRecord("food", "isDelete=0", 0);
		

		$dashboard = array("department" => $department, "banner" => $banner,"faq" => $faq, "user" => $User, "inquiry" => $inquiry, "food" => $food, "blog" => $blog, "product" => $product, "category" => $category, "gallery" => $gallery);


		if ($_SESSION[SITE_SESS . '_ADMIN_TYPE'] == 0) {
			$dashboard_js = "js/dashboard_admin.js";
			$dashboard_css = "css/dashboard_admin.css";
			$dashboard_content = "dashboard/dashboard_admin.php";
		} else if ($_SESSION[SITE_SESS . '_ADMIN_TYPE'] == 1) {
			$dashboard_js = "js/dashboard_admin.js";
			$dashboard_css = "css/dashboard_admin.css";
			$dashboard_content = "dashboard/dashboard_admin.php";
		} else if ($_SESSION[SITE_SESS . '_ADMIN_TYPE'] == 2) {
			$dashboard_js = "js/dashboard_sales_repo.js";
			$dashboard_css = "css/dashboard_sales_repo.css";
			$dashboard_content = "dashboard/dashboard_admin.php";
		} else if ($_SESSION[SITE_SESS . '_ADMIN_TYPE'] == 3) {
			$dashboard_js = "js/dashboard_delivery.js";
			$dashboard_css = "css/dashboard_delivery.css";
			$dashboard_content = "dashboard/dashboard_admin.php";
		}
		return array("dashboard_js" => $dashboard_js, "dashboard_css" => $dashboard_css, "dashboard_content" => $dashboard_content, "dashboard" => $dashboard);
	}
	function getCategory($required_columns = array())
	{
		$required_columns = $this->getRequiredColumns($required_columns);

		$p = array();
		$p[] = array("id" => -1, "category_name" => "Featured", "displayImage" => 1);
		$result = $this->rp_getData("category", $required_columns, "isDelete=0 AND isActive=1", "", 0);
		if ($result) {

			while ($detail = mysqli_fetch_assoc($result)) {
				$countImage = $this->rp_getTotalRecord("product", "category_id='" . $detail['id'] . "' AND (image!='' OR image!=0)", 0);
				if ($countImage >= 1)
					$detail['displayImage'] = 1;
				else
					$detail['displayImage'] = 0;


				$p[] = $detail;
			}
		}

		$reply = array("ack" => 1, "developer_msg" => "Category detail found", "ack_msg" => "Category detail found.", "result" => $p);
		return $reply;
		//print_r(result);
	}
	function setNotification($notification_id, $user_id, $user_type, $notification_title, $notification_msg, $notification_type, $type_slug, $notification_description, $notification_icon = "fa fa-notification", $notification_extra = "", $respective_date, $action_perameter = "")
	{

		$adate	= date('Y-m-d H:i:s');
		$rows 	= array(
			"user_id",
			"user_type",
			"notification_title",
			"notification_type",
			"type_slug",
			"notification_description",
			"notification_icon",
			"notification_extra",
			"action_perameter",
			"respective_date",
			"isDelete",
			"isActive",
		);
		$values = array(
			$user_id,
			$user_type,
			$notification_title,
			$notification_type,
			$type_slug,
			$notification_description,
			$notification_icon,
			$notification_extra,
			$action_perameter,
			$respective_date,
			0,
			1,
		);

		$uid = $this->db->rp_insert("notification_executive", $values, $rows, 0);

		$this->notifications[$notification_id] = array("notification_id" => $notification_id, "notification_msg" => $notification_msg, "notification_extra" => $notification_extra);
	}
	public function getNotification($notification_id)
	{
		if (array_key_exists($notification_id, $this->notifications)) {
			return $this->notifications[$notification_id];
		} else {
			return false;
		}
	}
	public function getNotifications($user_id = "", $user_type = '')
	{
		$limit = $this->getLimit();
		if ($user_type == '0')
			$where = " ((type_slug='admin' AND  isDelete=0) OR (type_slug='all') ) AND isActive=1";
		else
			$where = " ((user_id='" . $this->user_id . "' AND user_type='" . $user_type . "' AND type_slug='employee' AND  isDelete=0) OR (type_slug='all')) AND isActive=1";
		$ctable_r = $this->db->rp_getData("notification_executive", "id,user_id,notification_title,notification_description,notification_extra,notification_type,type_slug,respective_date,created_date", $where, "", 0, $limit);

		if ($ctable_r) {
			$result = array();
			while ($ctable_d = mysqli_fetch_assoc($ctable_r)) {
				$ctable_d['respective_date'] = date('d-m-Y', strtotime($ctable_d['respective_date']));
				$ctable_d['created_date'] = date('d-m-Y', strtotime($ctable_d['created_date']));
				$result[] = $ctable_d;
			}
		}
		//	print_r($result).'sd';exit;
		if (!empty($result)) {
			return $result;
		} else {
			return false;
		}
	}
	public function deleteNotifications($notification_id)
	{

		$isDeleted = $this->db->rp_update("notification_executive", array("isActive" => 0), "id='" . $notification_id . "'", 0);

		if (!empty($isDeleted)) {
			return $isDeleted;
		} else {
			return false;
		}
	}
	function fetchState($country_id)
	{

		if ($country_id != "") {
			$state_r = $this->db->rp_getData("state", "*", "country_id = '" . $country_id . "'", "", 0);
			$state = "";
?>
			<option value="">Select State</option>
			<?php
			while ($state_d = mysqli_fetch_array($state_r)) {
			?>
				<option value="<?php echo $state_d['name']; ?>" data-id="<?php echo $state_d['id']; ?>" <?php if ($state_d['name'] == $state) { ?> selected <?php } ?>><?php echo $state_d['name']; ?></option>

			<?php
			}
		} else {
			echo "<option value=''>Select first Country</option>";
		}
	}
	function fetchCity($state_id)
	{
		if ($state_id != "") {
			$city_r = $this->db->rp_getData("city", "*", "state_id = '" . $state_id . "'", "", 0);
			$city = "";
			?>
			<option value="">Select City</option>
			<?php

			while ($city_d = mysqli_fetch_assoc($city_r)) {
			?>
				<option value="<?php echo $city_d['name']; ?>" <?php if ($city_d['name'] == $city) { ?>selected <?php } ?>><?php echo $city_d['name']; ?></option>

			<?php

			}
		} else {
			?>
			<option value="">Select City</option>
<?php
		}
	}
	function getAllStateDetail($required_columns = array())
	{
		$required_columns = $this->getRequiredColumns($required_columns);

		$result = $this->rp_getData("state", $required_columns, "isDelete=0", "", 0);
		while ($detail = mysqli_fetch_assoc($result)) {
			$p[] = $detail;
		}

		$reply = array(
			"ack" => 1, "ack_msg" => $this->log->getMessage('STATE_DETAIL_SUCESS', 1),
			"developer_msg" => $this->log->getMessage('STATE_DETAIL_SUCESS'), "result" => $p
		);
		return $reply;
		//print_r(result);
	}

	function getAllCityDetail($required_columns = array(), $sid)
	{
		$required_columns = $this->getRequiredColumns($required_columns);
		if ($sid != "") {
			$where = "state_id='" . $sid . "'";
		} else {
			$where = "";
		}

		$result = $this->rp_getData("city", $required_columns, $where, "", 0);
		while ($detail = mysqli_fetch_assoc($result)) {

			$p[] = $detail;
		}


		$reply = array(
			"ack" => 1, "ack_msg" => $this->log->getMessage('CITY_DETAIL_SUCESS', 1),
			"developer_msg" => $this->log->getMessage('CITY_DETAIL_SUCESS'), "result" => $p
		);
		return $reply;
		//print_r(result);
	}
	function getUpdateInfo($last_sync_time)
	{
		$table_code = array();
		$table_slug = array();
		if ($last_sync_time != "") {
			$last_sync_time = date("Y-m-d H:i:s", strtotime($last_sync_time));

			$res = $this->db->rp_getData(CTABLE_INFORMATION_SCHEMA, "*", "last_modified_date>='" . $last_sync_time . "'", "", 0, "");
			if ($res) {
				while ($r = mysqli_fetch_assoc($res)) {
					$table_code[] = $r['table_code'];
					$table_slug[] = $r['table_slug'];
				}
			}
		}

		if (!empty($table_code)) {
			$reply = array("ack" => 1, "result" => $table_code, "table_name" => $table_slug, "developer_msg" => "Here is Your Update List", "ack_msg" => "Great !! Update List Found!!");
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => "No Updates Found!!", "ack_msg" => "No Update Found!!");
			return $reply;
		}
	}
	function getCountry($required_columns = array())
	{
		$required_columns = $this->getRequiredColumns($required_columns);

		$result = $this->rp_getData("country", $required_columns, "", "", 0);
		while ($detail = mysqli_fetch_assoc($result)) {

			$p[] = $detail;
		}
		$reply = array("ack" => 1, "developer_msg" => "City detail found", "ack_msg" => "City detail found.", "result" => $p);
		return $reply;
		//print_r(result);
	}
	function getUpdates($table_code, $user_id, $last_sync_date)
	{
		$result = array();
		if ($last_sync_date != "") {
			$last_sync_date = date("Y-m-d H:i:s", strtotime($last_sync_date));

			$res = $this->db->rp_getData(CTABLE_INFORMATION_SCHEMA, "*", "table_code='" . $table_code . "'", "", 0, "");
			if ($res) {

				$r = mysqli_fetch_assoc($res);
				$table_slug = $r['table_slug'];
				$result = array();
				if ($table_slug == "order_detail") {

					$this->objOrder = new Order();

					$result_r = $this->db->rp_getData($table_slug, "*", "(created_date>='" . $last_sync_date . "' OR modified_date>='" . $last_sync_date . "') AND sales_id='" . $user_id . "'", "", 0);
					if ($result_r) {
						while ($r = mysqli_fetch_assoc($result_r)) {
							$r['order_date'] = date('Y-m-d', strtotime($r['order_date']));


							$order_ack = $this->objOrder->getOrders_forItem($r['id']);

							//print_r($order_ack);
							if ($order_ack['ack'] == 1) {
								$r = $order_ack['result'];
								$r['server_id'] = $r['id'];
								$result[] = $r;
							}
						}
					}
				} else if ($table_slug == "item_fg") {
					$result_r = $this->db->rp_getData($table_slug, "*", "(created_date>='" . $last_sync_date . "' OR modify_date>='" . $last_sync_date . "')", "", 0);
					if ($result_r) {
						while ($r = mysqli_fetch_assoc($result_r)) {
							$result[] = $r;
						}
					}
				} else if ($table_slug == "product_weight_price") {

					$result_r = $this->db->rp_getData($table_slug, "*", "(created_date>='" . $last_sync_date . "' OR modify_date>='" . $last_sync_date . "') AND isDelete=0", "", 0);
					if ($result_r) {
						while ($r = mysqli_fetch_assoc($result_r)) {
							$result[] = $r;
						}
					}
				} else if ($table_slug == "no_order_inquiry") {
					$result = array();
					$result_r = $this->db->rp_getData($table_slug, "*", "(created_date>='" . $last_sync_date . "' OR modify_date>='" . $last_sync_date . "') AND isDelete=0 AND sales_executive_id='" . $user_id . "'", "", 0);
					if ($result_r) {
						while ($r = mysqli_fetch_assoc($result_r)) {
							$r['sales_name'] = $this->db->rp_getValue("sales_executive", "name", "id='" . $r['sales_id'] . "' AND type='" . $r['sales_type'] . "'", 0);
							$r['country_slug'] = $r['country'];
							$r['country'] = $this->db->rp_getValue("country", "name", "id='" . $r['country'] . "'", 0);

							$r['state_slug'] = $r['state'];
							$r['state'] = $this->db->rp_getValue("state", "name", "id='" . $r['state'] . "'", 0);

							$r['city_slug'] =  $r['city'];
							$r['city'] = $this->db->rp_getValue("city", "name", "id='" . $r['city'] . "'", 0);

							$r['action_slug'] =  $r['action'];
							$r['action'] = $this->db->rp_getValue("no_order_inquiry_action", "name", "id='" . $r['action'] . "'", 0);

							$r['created_date'] = date('d-m-Y', strtotime($r['created_date']));
							$r['datetime'] = date('d-m-Y', strtotime($r['datetime']));
							$result[] = $r;
						}
					}
				} else if ($table_slug == "customer") {
					$result = array();
					$objCustomer = new Customer();
					$get_customer = $objCustomer->getCustomerDetail($user_id, $last_sync_date);
					if ($get_customer['ack'] == 1) {
						$result = $get_customer['result'];
					}
				} else if ($table_slug == "price_list") {
					$result = array();
					$objSalesExecutive = new SalesExecutive();
					$get_pricelist = $objSalesExecutive->getPricelist($user_id);
					if ($get_pricelist['ack'] == 1) {
						$result = $get_pricelist['result'];
					}
				} else {

					$result_r = $this->db->rp_getData($table_slug, "*", "1=1");
					if ($result_r) {
						while ($r = mysqli_fetch_assoc($result_r)) {
							$result[] = $r;
						}
					}
				}
			}
		}
		if (!empty($result)) {
			$reply = array("ack" => 1, "result" => $result, "developer_msg" => "Here is Your Updates", "ack_msg" => "Great !! Updates List Found!!", "last_sync_date" => date("Y-m-d H:i:s"));
			return $reply;
		} else {
			$reply = array("ack" => 0, "developer_msg" => "No Updates Found!!", "ack_msg" => "No Updates Found!!", "last_sync_date" => date("Y-m-d H:i:s"), "result" => array());
			return $reply;
		}
	}
	function getRequiredColumns($required_columns = array())
	{
		if (!empty($required_columns)) {
			$required_columns_string = implode(",", $required_columns);
			return $required_columns_string;
		} else {
			return "*";
		}
	}
	function getLimit($limit = array())
	{
		$limit = $this->db->getLimit();
		if (!empty($limit) && array_key_exists("ul", $limit)) {
			$ul = $limit['ul'];
			if (array_key_exists("ll", $limit) && $limit['ll'] != "") {
				$ll = $limit['ll'];
			} else {
				$ll = "18446744073709551615";
			}
			$limit_string = "" . $ul . "," . $ll;
			return $limit_string;
		} else {
			return "";
		}
	}
	public function notificationInsert($detail)
	{

		$did		= addslashes(trim($detail['did']));
		$notification_title		= addslashes(trim($detail['notification_title']));
		$notification_description		= addslashes(trim($detail['notification_description']));
		$notification_type		= addslashes(trim($detail['notification_type']));
		$respective_date = date('Y-m-d H:i:s');
		$created_date = date('Y-m-d H:i:s');

		$refreshTokens = array();
		$rows 	= array(
			"did",
			"notification_title",
			"notification_description",
			"notification_type",
			"respective_date",
			"created_date",
		);
		$values = array(
			$did,
			$notification_title,
			$notification_description,
			$notification_type,
			$respective_date,
			$created_date
		);
		$this->db->rp_insert("notification", $values, $rows, 0);

		$msg = array(
			"type"		 => $notification_type,
			"title"		 => $notification_title,
			"description" => $notification_description,
			"respective_date"		 =>	$respective_date,
		);
		//print_r($msg);exit;

		if ($detail['did'] != "") {
			$where = "refreshToken!='' AND id='" . $detail['did'] . "'";
			$refreshTokens[] = $this->db->rp_getValue("dealer", "refreshToken", $where);
		} else {
			$where = "isDelete=0 AND isActive=1";
			$d = $this->db->rp_getData("dealer", "refreshToken", $where);
			while ($id = mysqli_fetch_assoc($d)) {
				$refreshTokens[] = $id['refreshToken'];
			}
		}
		//print_r($msg);exit;
		$result = $this->db->send_notification($msg, $detail['did'], $refreshTokens);
	}
	function generateCode($length = 6)
	{
		$characters = '0123456789';
		$randStr = "";
		for ($i = 1; $i <= $length; $i++) {
			$randStr = $randStr . $characters[rand(0, strlen($characters) - 1)];
		}
		//echo $randStr;exit;
		return $randStr;
	}

	function GetApplicationSettings()
	{
		$Settings = $this->rp_getData(System::$CtableSetting, "*", "id='1'");
		if ($Settings) {
			$Settings = mysqli_fetch_assoc($Settings);
			if ($Settings['error_reporting'] == 0) {
				error_reporting(0);
			}
			$media = new Media();
			$MediaDetail = $media->GetMediaInfo($Settings['settings_invoice_logo']);
			if ($MediaDetail['ack'] == 1) {
				$defaultContent = array("url" => $MediaDetail['result']['real_url'], "media_id" => $MediaDetail['result']['id'], "fileType" => $MediaDetail['result']['media_type']);
			}
			$Settings['settings_invoice_logo'] = $MediaDetail['result']['real_url'];
			System::$Settings = $Settings;
		} else {
			System::$Settings = array();
		}
	}

	public function SystemBackUp($remark = "")
	{
		$fileName = $this->backup_tables("localhost", $this->db->db_user, $this->db->db_pass, $this->db->db_name, "*", $remark);
		$dateDownload = date('Y-m-d H:i:s');
		$values = array($dateDownload, $fileName, $remark);
		$rows = array("createDate", "fileUrl", "remarks");
		$ps = $this->db->rp_insert("dbbackup", $values, $rows, 0);
		if ($ps)
			$reply = array("ack" => 1, "ack_msg" => "Database Backuped!!", "backup_url" => DBBACKUP_PATH . $fileName);
		else
			$reply = array("ack" => 0, "ack_msg" => "Database Could Not Backuped!!");

		return $reply;
	}


	function backup_tables($host, $user, $pass, $name, $tables = '*', $remark = "Manual Backup ")
	{

		$link = mysqli_connect($host, $user, $pass);
		mysqli_select_db($name, $link);

		//get all of the tables
		if ($tables == '*') {

			$tables = array();
			$result = mysqli_query($this->conn, 'SHOW TABLES');
			while ($row = mysqli_fetch_row($result)) {
				$tables[] = $row[0];
			}
		} else {
			$tables = is_array($tables) ? $tables : explode(',', $tables);
		}
		$return = "";
		//cycle through
		foreach ($tables as $table) {
			$result = mysqli_query($this->conn, 'SELECT * FROM ' . $table);
			$num_fields = mysqli_num_fields($result);

			//$return.= 'DROP TABLE '.$table.';';
			$row2 = mysqli_fetch_row(mysqli_query($this->conn, 'SHOW CREATE TABLE ' . $table));
			$return .= "\n\n" . $row2[1] . ";\n\n";

			for ($i = 0; $i < $num_fields; $i++) {
				while ($row = mysqli_fetch_row($result)) {
					$return .= 'INSERT INTO ' . $table . ' VALUES(';
					for ($j = 0; $j < $num_fields; $j++) {
						$row[$j] = addslashes($row[$j]);
						$row[$j] = preg_replace("\n", "\\n", $row[$j]);
						if (isset($row[$j])) {
							$return .= '"' . $row[$j] . '"';
						} else {
							$return .= '""';
						}
						if ($j < ($num_fields - 1)) {
							$return .= ',';
						}
					}
					$return .= ");\n";
				}
			}
			$return .= "\n\n\n";
		}

		//save file
		$time = time();
		$fileName 	= $remark . $time . '.sql';
		$zipfileName = $remark . $time . '.zip';
		$mysqlExportPath = DBBACKUP_PATH . $fileName;
		$handle = fopen($mysqlExportPath, 'w+');
		fwrite($handle, $return);
		fclose($handle);

		/**************************Zip File Creation****************************/
		$zip = new ZipArchive();
		$filename = DBBACKUP_PATH . $zipfileName;
		if ($zip->open($filename, ZIPARCHIVE::CREATE) !== TRUE) {
			exit("cannot open <$filename>n");
		}
		$zip->addFile($mysqlExportPath, $time . '.sql');
		$zip->close();
		@unlink($mysqlExportPath);
		/**************************Zip File Creation***************************/

		return $zipfileName;
	}

	public function hasRights($page_id, $check_right = 'view_flag')
	{
		if (isset($_SESSION[SITE_SESS . '_ADMIN_TYPE']) && $page_id != 0) {


			$admin_type = $_SESSION[SITE_SESS . '_ADMIN_TYPE'];
			if ($admin_type != 0) {
				$isPageRegistered = $this->db->rp_getTotalRecord("page_table", "id='" . $page_id . "'");
				if ($isPageRegistered > 0) {

					$rights = $this->db->rp_getData("page_admin_right", "*", "page_id='" . $page_id . "' AND admin_id='" . $admin_type . "'", "", 0);
					if ($rights) {


						$rights = mysqli_fetch_assoc($rights);
						if ($rights[$check_right] == 0) {
							return -1;
						} else {
							return $rights;
						}
					} else {

						return -1;
					}
				} else {
					return -1;
				}
			} else {
				return 1;
			}
		}
	}

	function x_week_range($date)
	{
		$ts = strtotime($date);
		$start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
		return array(
			date('Y-m-d', $start),
			date('Y-m-d', strtotime('next saturday', $start))
		);
	}
	function x_month_range($date)
	{
		$ts = strtotime($date);
		return array(
			date("Y-m-01", $ts),
			date("y-m-t", $ts)
		);
	}
}
?>