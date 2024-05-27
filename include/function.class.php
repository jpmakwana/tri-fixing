<?php
require_once("main.class.php");
class Functions extends Database
{


	function __construct()
	{
		$db = new Database();
		$conn = $db->connect();
		$this->conn = $conn;
	}

	/*
		*** Main Function Developed By Ravi Patel :) <<<
			-> rp_getData() 
				- return single and multi records
			-> rp_getValue() 
				- return single records
			-> rp_getTotalRecord()
				- return number of records
			-> rp_getMaxVal()
				- return maximum value
			-> rp_insert()
				- insert record
			-> rp_delete()
				- delete record
			-> rp_update()
				- update record
			-> tableExists()
				- check whether table exist or not
			-> rp_limitChar()
				- return trimed character string
			-> rp_dupCheck()
				- check for duplicate record in table
			-> rp_location()
				- redirect to given URL
			-> rp_getDisplayOrder()
				- get next display order
			-> rp_createSlug()
				- create alias of given string
			-> rp_getTotalReview()
				- number of total review of product
			-> rp_catData()
				- get cid/sid/ssid from slug
			-> clean()
				- prevent mysql injction
			-> rp_productQty()
				- Current Product Qty
			-> rp_getProductPriceDiv()
				- Product Price Div
	*/

	public function rp_getData($table, $rows = '*', $where = null, $order = null, $die = 0, $limit = "") // Select Query, $die==1 will print query By Ravi Patel
	{
		$results = array();
		$q = 'SELECT ' . $rows . ' FROM ' . $table;
		if ($where != null)
			$q .= ' WHERE ' . $where;
		if ($order != null)
			$q .= ' ORDER BY ' . $order;
		if ($limit != null)
			$q .= ' LIMIT ' . $limit;
		if ($die == 1) {
			echo $q;
			die;
		}
		if ($this->tableExists($table)) {

			if (mysqli_num_rows(mysqli_query($this->conn, $q)) > 0) {
				$results = @mysqli_query($this->conn, $q);
				return $results;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}



	public function rp_getDataByRights($table, $rows = '*', $where = null, $order = null, $die = 0) // Select Query, $die==1 will print query By Ravi Patel
	{
		$results = array();
		$q = 'SELECT ' . $rows . ' FROM ' . $table;
		if ($where != null) {
			$where = $where . " AND " . $this->rightsWhere();
			$q .= ' WHERE ' . $where;
		}


		if ($order != null)
			$q .= ' ORDER BY ' . $order;
		if ($die == 1) {
			echo $q;
			die;
		}
		if ($this->tableExists($table)) {
			if (mysqli_num_rows(mysqli_query($this->conn, $q)) > 0) {
				$results = @mysqli_query($this->conn, $q);
				return $results;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	public function rightsWhere()
	{

		if (isset($_SESSION[SITE_SESS . '_ADMIN_SESS_ID']) && $_SESSION[SITE_SESS . '_ADMIN_SESS_ID'] != "" && isset($_SESSION[SITE_SESS . '_ADMIN_TYPE']) && $_SESSION[SITE_SESS . '_ADMIN_TYPE'] != "") {
			$uid = $_SESSION[SITE_SESS . '_ADMIN_SESS_ID'];
			$user_type = $_SESSION[SITE_SESS . '_ADMIN_TYPE'];
			$where = "((created_by_type >" . $user_type . ") OR (created_by_type='" . $user_type . "' AND created_by='" . $uid . "'))";
		} else {
			if (is_writable(LOG_FILE)) {
				$ip = $this->rp_get_client_ip();
				$file = fopen(LOG_FILE, "a");
				fwrite($file, "From IP " . $ip . " Entry is modified or inserted but Session not created DATETIME " . date("Y-m-d H:i:s") . PHP_EOL);
				fclose($file);
			}
			$where = "1=0";
		}
		return $where;
	}
	public function rp_getValue($table, $row = null, $where = null, $die = 0) // single records ref HB function
	{
		if ($this->tableExists($table) && $row != null && $where != null) {
			$q = 'SELECT ' . $row . ' FROM ' . $table . ' WHERE ' . $where;
			if ($die == 1) {
				echo $q; //die;
			}

			if (mysqli_num_rows(mysqli_query($this->conn, $q)) >= 0) {
				$results = @mysqli_fetch_array(mysqli_query($this->conn, $q));
				return $results[$row];
			} else {

				return false;
			}
		} else {
			return false;
		}
	}

	public function rp_getMaxVal($table, $row = null, $where = null, $die = 0)
	{
		if ($this->tableExists($table) && $row != null && $where != null) {
			$q = 'SELECT MAX(' . $row . ') as ' . $row . ' FROM ' . $table . ' WHERE ' . $where;
			if ($die == 1) {
				echo $q;
				die;
			}
			if (mysqli_num_rows(mysqli_query($this->conn, $q)) > 0) {
				$results = @mysqli_fetch_array(mysqli_query($this->conn, $q));
				return $results[$row];
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}
	public function rp_getMinVal($table, $row = null, $where = null, $die = 0)
	{
		if ($this->tableExists($table) && $row != null && $where != null) {
			$q = 'SELECT MIN(' . $row . ') as ' . $row . ' FROM ' . $table . ' WHERE ' . $where;
			if ($die == 1) {
				echo $q;
				die;
			}
			if (mysqli_num_rows(mysqli_query($this->conn, $q)) > 0) {
				$results = @mysqli_fetch_array(mysqli_query($this->conn, $q));
				return $results[$row];
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}
	public function rp_getAvgVal($table, $row = null, $where = null, $die = 0)
	{
		if ($this->tableExists($table) && $row != null && $where != null) {
			$q = 'SELECT AVG(' . $row . ') as ' . $row . ' FROM ' . $table . ' WHERE ' . $where;
			if ($die == 1) {
				echo $q;
				die;
			}
			if (mysqli_num_rows(mysqli_query($this->conn, $q)) > 0) {
				$results = @mysqli_fetch_array(mysqli_query($this->conn, $q));
				return $results[$row];
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}

	public function rp_getTotalRecord($table, $where = null, $die = 0) // return number of records By Ravi Patel
	{
		$q = 'SELECT * FROM ' . $table;
		if ($where != null)
			$q .= ' WHERE ' . $where;
		if ($die == 1) {
			echo $q;
			die;
		}
		if ($this->tableExists($table))
			return mysqli_num_rows(mysqli_query($this->conn, $q)) + 0;
		else
			return 0;
	}

	public function rp_insert($table, $values, $rows, $die = 0) // rp_insert - Insert and Die Values By Rav-i Pa-tel
	{

		// Modify by Jai
		// Add six column and there value automatically
		// created_by,created_by_type,modified_by,modified_by_type,created_date,modified_date

		if ($this->tableExists($table)) {
			/*$extras=$this->autoGeneratedColumnsForInsert();
			if(array_key_exists("columns",$extras) && array_key_exists("values",$extras))
			{
				$rows=array_merge($rows,$extras['columns']);
				$values=array_merge($values,$extras['values']);
				
			}*/

			$insert = 'INSERT INTO ' . $table;
			if (count($rows) > 0) {
				$insert .= ' (' . implode(",", $rows) . ')';
			}

			for ($i = 0; $i < count($values); $i++) {
				if (is_string($values[$i]))
					$values[$i] = '"' . $values[$i] . '"';
			}



			$values = implode(',', $values);


			$insert .= ' VALUES (' . $values . ')';

			if ($die == 1) {
				echo $insert;
				die;
			}
			$ins = @mysqli_query($this->conn, $insert);
			if ($ins) {
				$last_id = mysqli_insert_id($this->conn);
				$this->update_table_information($table, date("Y-m-d H:i:s"));
				return $last_id;
			} else {
				return false;
			}
		}
	}
	public function autoGeneratedColumnsForInsert()
	{
		if (isset($_SESSION[SITE_SESS . '_ADMIN_SESS_ID']) && $_SESSION[SITE_SESS . '_ADMIN_SESS_ID'] != "" && isset($_SESSION[SITE_SESS . '_ADMIN_TYPE']) && $_SESSION[SITE_SESS . '_ADMIN_TYPE'] != "") {
			$uid = $_SESSION[SITE_SESS . '_ADMIN_SESS_ID'];
			$user_type = $_SESSION[SITE_SESS . '_ADMIN_TYPE'];
			return array("columns" => array("created_by", "created_by_type", "modified_by", "modified_by_type", "created_date", "modified_date"), "values" => array($uid, $user_type, "", "", date("Y-m-d H:i:s"), ""));
		} else {
			if (is_writable(LOG_FILE)) {
				$ip = $this->rp_get_client_ip();
				fopen(LOG_FILE, "a");
				fwrite(LOG_FILE, "From IP " . $ip . " Entry is modified or inserted but Session not created DATETIME " . date("Y-m-d H:i:s") . PHP_EOL);
				fclose(LOG_FILE);
			}

			return array("columns" => array("created_by", "created_by_type", "modified_by", "modified_by_type", "created_date", "modified_date"), "values" => array("5895", "0712", "", "", date("Y-m-d H:i:s")));
		}
	}
	// Send Notification by GCM to Android
	public function send_notification($data, $ids, $which_notification)
	{
		//print_r($data);exit;
		////which_notification=>1=delivery, 2=customer
		if ($which_notification == 1) {
			$apiKey = 'AIzaSyBlhO-CBqqrgWkw_stJFzLAJLpRU5boXCw'; // This is Server Legacy Key From Cloud Messaging Firebase
		} else {
			$apiKey = 'AIzaSyBlhO-CBqqrgWkw_stJFzLAJLpRU5boXCw'; // This is Server Legacy Key From Cloud Messaging Firebase
		}
		$url = 'https://android.googleapis.com/gcm/send';
		$post = array(
			'registration_ids'  => $ids,
			'data'              => $data,

			'priority'          => 'high',
		);

		$headers = array(
			'Authorization: key=' . $apiKey,
			'Content-Type: application/json'
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //////// SSL Verifier False ////////
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	public function autoGeneratedColumnsForUpdate($last_users_modified, $last_user_types_modified, $last_modified_dates)
	{
		if (isset($_SESSION[SITE_SESS . '_ADMIN_SESS_ID']) && $_SESSION[SITE_SESS . '_ADMIN_SESS_ID'] != "" && isset($_SESSION[SITE_SESS . '_ADMIN_TYPE']) && $_SESSION[SITE_SESS . '_ADMIN_TYPE'] != "") {
			$uid = $_SESSION[SITE_SESS . '_ADMIN_SESS_ID'];
			$user_type = $_SESSION[SITE_SESS . '_ADMIN_TYPE'];

			if ($last_users_modified != "") {
				$last_users_modified = explode(",", $last_users_modified);
				$last_users_modified[] = $uid;
				$last_users_modified = implode(",", $last_users_modified);
			} else {
				$last_users_modified = $uid;
			}

			if ($last_user_types_modified != "") {
				$last_user_types_modified = explode(",", $last_user_types_modified);
				$last_user_types_modified[] = $user_type;
				$last_user_types_modified = implode(",", $last_user_types_modified);
			} else {
				$last_user_types_modified = $user_type;
			}
			if ($last_modified_dates != "") {
				$last_modified_dates = explode(",", $last_modified_dates);
				$last_modified_dates[] = date("Y-m-d H:i:s");
				$last_modified_dates = implode(",", $last_modified_dates);
			} else {
				$last_modified_dates = date("Y-m-d H:i:s");
			}

			return array("values" => array("modified_by" => $last_users_modified, "modified_by_type" => $last_user_types_modified, "modified_date" => $last_modified_dates));
		} else {
			if (is_writable(LOG_FILE)) {
				$ip = $this->rp_get_client_ip();
				fopen(LOG_FILE, "a");
				fwrite(LOG_FILE, "From IP " . $ip . " Entry is modified or inserted but Session not created DATETIME " . date("Y-m-d H:i:s") . PHP_EOL);
				fclose(LOG_FILE);
			}
			$uid = 5895;
			$user_type = 0712;

			if ($last_users_modified != "") {
				$last_users_modified = explode(",", $last_users_modified);
				$last_users_modified[] = $uid;
				$last_users_modified = implode(",", $last_users_modified);
			} else {
				$last_users_modified = $uid;
			}

			if ($last_user_types_modified != "") {
				$last_user_types_modified = explode(",", $last_user_types_modified);
				$last_user_types_modified[] = $user_type;
				$last_user_types_modified = implode(",", $last_user_types_modified);
			} else {
				$last_user_types_modified = $user_type;
			}
			if ($last_modified_dates != "") {
				$last_modified_dates = explode(",", $last_modified_dates);
				$last_modified_dates[] = date("Y-m-d H:i:s");
				$last_modified_dates = implode(",", $last_modified_dates);
			} else {
				$last_modified_dates = date("Y-m-d H:i:s");
			}

			return array("values" => array("modified_by" => $last_users_modified, "modified_by_type" => $last_user_types_modified, "modified_date" => $last_modified_dates));
		}
	}
	public function rp_delete($table, $where = null, $die = 0)
	{
		if ($this->tableExists($table)) {
			if ($where != null) {
				$delete = 'DELETE FROM ' . $table . ' WHERE ' . $where;
				if ($die == 1) {
					echo $delete;
					die;
				}
				$del = @mysqli_query($this->conn, $delete);
			}
			if ($del) {
				$this->update_table_information($table, date("Y-m-d H:i:s"));
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	public function rp_update($table, $rows, $where, $die = 0) //update query by Ravi Patel
	{
		if ($this->tableExists($table)) {
			// Parse the where values
			// even values (including 0) contain the where rows
			// odd values contain the clauses for the row
			//print_r($where);die;
			/*$extra_r=$this->rp_getData($table,"modified_by,modified_by_type,modified_date",$where);
            if($extra_r)
			{
				$extra_v=mysqli_fetch_assoc($extra_r);
				$extra=$this->autoGeneratedColumnsForUpdate($extra_v['modified_by'],$extra_v['modified_by_type'],$extra_v['modified_date']);
				$rows=array_merge($extra['values'],$rows);
            	
			}*/
			$update = 'UPDATE ' . $table . ' SET ';
			$keys = array_keys($rows);
			for ($i = 0; $i < count($rows); $i++) {
				if (is_string($rows[$keys[$i]])) {
					$update .= $keys[$i] . '="' . $rows[$keys[$i]] . '"';
				} else {
					$update .= $keys[$i] . '=' . $rows[$keys[$i]];
				}

				// Parse to add commas
				if ($i != count($rows) - 1) {
					$update .= ',';
				}
			}
			$update .= ' WHERE ' . $where;
			if ($die == 1) {
				echo $update;
				die;
			}
			//$update = trim($update," AND");
			$query = @mysqli_query($this->conn, $update);
			if ($query) {
				$this->update_table_information($table, date("Y-m-d H:i:s"));
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function tableExists($table)
	{
		return true;
		$tablesInDb = @mysqli_query($this->conn, 'SHOW TABLES FROM ' . $this->db_name . ' LIKE "' . $table . '"');
		if ($tablesInDb) {
			if (mysqli_num_rows($tablesInDb) == 1) {
				return true;
			} else {
				return false;
			}
		}
	}
	public function rp_getSumVal($table, $row = null, $where = null, $die = 0)
	{
		if ($this->tableExists($table) && $row != null && $where != null) {
			$q = 'SELECT SUM(' . $row . ') as ' . $row . ' FROM ' . $table . ' WHERE ' . $where;
			if ($die == 1) {
				echo $q;
				die;
			}
			if (mysqli_num_rows(mysqli_query($this->conn, $q)) > 0) {
				$results = @mysqli_fetch_array(mysqli_query($this->conn, $q));
				return $results[$row];
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}
	public function rp_limitChar($content, $limit, $url = "javascript:void(0);", $txt = "&hellip;")
	{
		if (strlen($content) <= $limit) {
			return $content;
		} else {
			$ans = substr($content, 0, $limit);
			if ($url != "") {
				$ans .= "<a href='$url' class='desc'>$txt</a>";
			} else {
				$ans .= "&hellip;";
			}
			return $ans;
		}
	}

	public function rp_dupCheck($table, $where = null, $die = 0)
	{
		$q = 'SELECT id FROM ' . $table;
		if ($where != null)
			$q .= ' WHERE ' . $where;
		if ($die == 1) {
			echo $q;
			die;
		}
		if ($this->tableExists($table)) {
			$results = @mysqli_num_rows(mysqli_query($this->conn, $q));
			if ($results > 0) {
				return true;
			} else {
				return false;
			}
		} else
			return false;
	}

	public function rp_location($redirectPageName = null)
	{
		if ($redirectPageName == null) {
			header("Location:" . $this->SITEURL);
			exit;
		} else {
			header("Location:" . $redirectPageName);
			exit;
		}
	}

	public function flash($name, $text = '')
	{
		if (isset($_SESSION[$name])) {
			$msg = $_SESSION[$name];
			unset($_SESSION[$name]);
			return $msg;
		} else {
			$_SESSION[$name] = $text;
		}
		return '';
	}

	public function rp_getDisplayOrder($table, $where = null, $die = 0)
	{
		$q = 'SELECT MAX(display_order) as display_order FROM ' . $table;
		if ($where != null)
			$q .= ' WHERE ' . $where;
		if ($die == 1) {
			echo $q;
			die;
		}
		if ($this->tableExists($table)) {
			$results = @mysqli_query($this->conn, $q);
			if (@mysqli_num_rows($results) > 0) {
				$disp_d = mysqli_fetch_array($results);
				return intval($disp_d['display_order']) + 1;
			} else {
				return 1;
			}
		} else {
			return 1;
		}
	}

	public function rp_createSlug($string)
	{
		$slug = strtolower(trim(preg_replace('/-{2,}/', '-', preg_replace('/[^a-zA-Z0-9-]/', '-', $string)), "-"));
		return $slug;
	}

	public function rp_createSlugs($row_slug, $string, $table)
	{

		$slug = strtolower(trim(preg_replace('/-{2,}/', '-', preg_replace('/[^a-zA-Z0-9-]/', '-', $string)), "-"));

		$last_id = $this->getlastInsertId($table);
		$count = $last_id++;
		$slug = $slug . "_" . $count;

		return $slug;
	}
	public function rp_createProSlug($string)
	{
		$slug = strtolower(trim(preg_replace('/-{2,}/', '-', preg_replace('/[^a-zA-Z0-9-.]/', '-', $string)), "-"));
		return $slug;
	}

	public function getDBName()
	{
		$dbData = $this->db_host . "," . $this->db_user . "," . $this->db_pass . "," . $this->db_name;
		return $dbData;
	}


	public function rp_num($val, $deci = "2", $sep = ".", $thousand_sep = "")
	{
		return number_format($val, $deci, $sep, $thousand_sep);
	}

	public function catData($cslug = null, $sslug = null, $ssslug = null)
	{
		if ($cslug != null && $sslug == null && $ssslug == null) {
			return $this->rp_getData("category", "*", "slug='" . $cslug . "' AND isDelete=0");
		} else if ($cslug != null && $sslug != null && $ssslug == null) {
			$cid	= $this->rp_getValue("category", "id", "slug='" . $cslug . "'");
			return $this->rp_getData("sub_category", "*", "cid='" . $cid . "' AND slug='" . $sslug . "' AND isDelete=0");
		} else if ($cslug != null && $sslug != null && $ssslug != null) {
			$cid	= $this->rp_getValue("category", "id", "slug='" . $cslug . "'");
			$sid	= $this->rp_getValue("sub_category", "id", "slug='" . $sslug . "'");
			return $this->rp_getData("sub_sub_category", "*", "cid='" . $cid . "' AND sid='" . $sid . "' AND slug='" . $ssslug . "' AND isDelete=0");
		} else {
			return false;
		}
		//return number_format($val,$deci,$sep,$thousand_sep);
	}
	public function rp_getTotalReview($v_id)
	{
		return $this->rp_getTotalRecord("review", "vid = '" . $v_id . "'");
	}



	public function rp_getTotalCity($city_id)
	{
		return $this->rp_getTotalRecord("vendor", "isActive=1 AND isDelete=0 AND isVerified=1 AND city = '" . $city_id . "'");
	}

	public function clean($string)
	{
		$string = trim($string);								// Trim empty space before and after
		if (get_magic_quotes_gpc()) {
			$string = stripslashes($string);					        // Stripslashes
		}
		$string = mysqli_real_escape_string($this->conn, $string);			        // mysqli_real_escape_string
		return $string;
	}
	public function rp_getProductQty($pid)
	{
		$proQty = $this->rp_getValue("product", "qty", "id='" . $pid . "'");
		return $proQty;
	}
	public function rp_getProductPriceDiv($max_price, $sell_price)
	{
		if ($sell_price < $max_price && $sell_price != $max_price) {
?>
			<span class="price"><?php echo CURR; ?><?php echo $sell_price; ?></span>
			<span class="price-before-discount"><?php echo CURR; ?><?php echo $max_price; ?></span>
		<?php
		} else {
		?>
			<span class="price"><?php echo CURR; ?><?php echo $sell_price; ?></span>
			<span class="price-before-discount"></span>
			<?php
		}
	}
	public function rp_getShippingCharge($pincode, $pid, $subpid = 0)
	{
		if ($subpid > 0) {
			$tabName = "sub_product";
			$pro_id	= $subpid;
		} else {
			$tabName = "product";
			$pro_id	= $pid;
		}
		$deliveryPin_r = $this->rp_getData("delivery_pincode", "*", "pincode='" . $pincode . "' AND isDelivery=1");
		if (mysqli_num_rows($deliveryPin_r) > 0) {
			$deliveryPin_d = mysqli_fetch_array($deliveryPin_r);
			$area_type 	= $deliveryPin_d["area_type"];

			if ($area_type == 0) {
				$shipping_charge = $this->rp_num($this->rp_getValue($tabName, "local_ship_charge", "id='" . $pro_id . "'"));
			} else if ($area_type == 1) {
				$shipping_charge = $this->rp_num($this->rp_getValue($tabName, "zonal_ship_charge", "id='" . $pro_id . "'"));
			} else {
				$shipping_charge = $this->rp_num($this->rp_getValue($tabName, "national_ship_charge", "id='" . $pro_id . "'"));
			}
			return $shipping_charge;
		} else {
			return $this->rp_num($this->rp_getValue($tabName, "national_ship_charge", "id='" . $pro_id . "'"));
		}
	}
	public function rp_checkDeliveryAndShipping($pincode, $pid)
	{
		if ($this->rp_getTotalRecord("delivery_pincode", "pincode='" . $pincode . "'") > 0) {
			if ($this->rp_getTotalRecord("delivery_pincode", "pincode='" . $pincode . "' AND isDelivery=1") > 0) {
				$shipping_charge = $this->rp_getShippingCharge($pincode, $pid);
				if ($shipping_charge == 0.00) {
					$shipping_charge = "Free";
				} else {
					$shipping_charge = CURR . $shipping_charge;
				}
				$_SESSION['SHOPWALA_SESS_PINCODE'] = $pincode;

			?>
				<div class="col-md-5"><strong>Delivery available at pincode:</strong> <?php echo $pincode; ?></div>
				<div class="col-md-5"><strong>Shipping Charges:</strong> <?php echo $shipping_charge; ?></div>
			<?php
			} else {
			?>
				<div class="col-md-12"><strong>Delivery not available at pincode:</strong> <?php echo $pincode; ?></div>
			<?php
			}
		} else {
			?>
			<div class="col-md-12"><strong>Sorry, we couldn't find pincode:</strong><?php echo $pincode; ?></div>
		<?php
		}
	}
	public function getlastInsertId($ctable, $die = 0)
	{
		$lastInsertId = $this->rp_getValue($ctable, "MAX(`id`)", "1=1");
		return $lastInsertId + 1;
	}
	public function printr($val, $isDie = 1)
	{
		echo "<pre>";
		print_r($val);
		if ($isDie) {
			die;
		}
	}
	public function rp_randomString($len = 5)
	{
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$str = "";
		for ($i = 0; $i < $len; $i++) {
			$str .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $str;
	}
	public function rp_get_client_ip()
	{
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if (getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if (getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if (getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if (getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if (getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';

		return $ipaddress;
	}
	function getCustomers($debug = 0)
	{
		$result = array();
		$rows = $this->rp_getData("customer", "*", "isDelete='0'", "", $debug);
		while ($data = mysqli_fetch_assoc($rows)) {
			$result[] = $data;
		}

		return $result;
	}
	function getPayees($debug = 0)
	{
		$result = array();
		$rows = $this->rp_getData("payee", "*", "isDelete='0'", "", $debug);
		while ($data = mysqli_fetch_assoc($rows)) {
			$result[] = $data;
		}

		return $result;
	}
	function getCustomerInfo($cid = "", $debug = 0)
	{
		$result = array();
		if ($cid != "") {
			$result = mysqli_fetch_assoc($this->rp_getData("customer", "*", "id='" . $cid . "' AND isDelete=0", "", $debug));
		}
		return $result;
	}
	function getCustomerBranches($cid = "", $debug = 0)
	{

		$result = array();
		if ($cid != "") {
			$rows = $this->rp_getData("customer_branch", "*", "cid='" . $cid . "' AND isDelete=0", "", $debug);
			while ($data = mysqli_fetch_assoc($rows)) {
				$result[] = $data;
			}
		}

		return $result;
	}
	function getCustomerBranchInfo($cid = "", $cbranchid = "", $debug = 0)
	{

		$result = array();
		if ($cid != "" && $cbranchid != "") {
			$result = mysqli_fetch_assoc($this->rp_getData("customer_branch", "*", "id='" . $cbranchid . "' AND cid='" . $cid . "' AND isDelete=0", "", $debug));
		}
		return $result;
	}
	function getVendorBranchInfo($vid = "", $cbranchid = "", $debug = 0)
	{

		$result = array();
		if ($vid != "" && $cbranchid != "") {
			$result = mysqli_fetch_assoc($this->rp_getData("vendor_branch", "*", "id='" . $cbranchid . "' AND vid='" . $vid . "' AND isDelete=0", "", $debug));
		}
		return $result;
	}
	function getCustomerBrancheJobs($cbranchid = "", $status = 1, $debug = 0)
	{

		$result = array();
		if ($cbranchid != "") {
			$rows = $this->rp_getData("job", "*", "branch='" . $cbranchid . "' AND status='" . $status . "' AND isDelete=0", "", $debug);
			if ($rows) {
				while ($data = mysqli_fetch_assoc($rows)) {
					$result[] = $data;
				}
			}
		}
		return $result;
	}

	function getProducts($debug = 0)
	{
		$result = array();
		$rows = $this->rp_getData("product", "*", "isDelete=0 AND 1=1", "", $debug);
		while ($data = mysqli_fetch_assoc($rows)) {
			$result[] = $data;
		}
		return $result;
	}
	function getProductInfo($pid = "", $debug = 0)
	{

		$result = array();
		if ($pid != "") {
			$result = mysqli_fetch_assoc($this->rp_getData("product", "*", "id='" . $pid . "' AND isDelete=0 ", "", $debug));
		}

		return $result;
	}
	function getLab($job_id, $debug = 0)
	{
		$result = array();
		$rows = $this->rp_getData("lab", "*", "job_id='" . $job_id . "' AND isDelete=0", "", $debug);
		while ($data = mysqli_fetch_assoc($rows)) {
			$result[] = $data;
		}
		return $result;
	}
	function extractArray($array)
	{
		$columns = array();
		$values = array();
		foreach ($array as $key => $value) {
			$columns[] = $key;
			$values[] = $value;
		}
		return array("columns" => $columns, "values" => $values);
	}
	function getJobMaterial($job_id, $customer_id, $where = "", $debug = 0)
	{

		$result = array();
		$row = mysqli_query($this->conn, "SELECT * FROM lab WHERE job_id='" . $job_id . "' AND isDelete=0");
		$job_information = $this->getJobDetail($job_id);
		$price_list = $this->rp_getValue("customer", "price_list", "id='" . $customer_id . "'");

		while ($r = mysqli_fetch_assoc($row)) {

			$count = 0;
			$tests = explode(",", $r['tests']);
			$testprices = explode(",", $r['test_prices']);
			$sum = 0;
			/*foreach($tests as $t)
			{
				$price=$this->rp_getValue("price_list_map_test","price","test_id='".$t."' AND price_list_id='".$price_list."' AND isDelete=0");
				if($price==0)
				{
					$price=$this->rp_getValue("test","price","id='".$t."' AND isDelete=0",0);
				}
				$r['test_price'][$t]=$price;
				//echo "Test price:".$price."<br>";
				$sum=$sum+intval($price);
				//echo "Total: ".$sum."<br>";
			}*/

			foreach ($testprices as $t) {
				$price = $t;
				$r['test_price'][$t] = $price;
				//echo "Test price:".$price."<br>";
				$sum = $sum + intval($price);
				//echo "Total: ".$sum."<br>";
			}
			if (array_key_exists($r['pid'], $result)) {

				$result[$r['pid']]['total_price'];
				$result[$r['pid']]['labs'] = $result[$r['pid']]['labs'] . "," . $r['id'];
				$result[$r['pid']]['job_no'] = SITE_SHORT . "/" . FINANCIAL_YEAR . "/" . $job_id;
				$result[$r['pid']]['letter_no'] = $job_information['letter_no'];
				$result[$r['pid']]['letter_date'] = date("d-M-y", strtotime($job_information['letter_date']));
				$result[$r['pid']]['qty'] = $result[$r['pid']]['qty'] + 1;
				$result[$r['pid']]['total_price'] = $result[$r['pid']]['total_price'] + $sum;
				$result[$r['pid']]['sample_rate'] = $result[$r['pid']]['total_price'] / $result[$r['pid']]['qty'];
			} else {
				$result[$r['pid']]['pid'] = $r['pid'];
				$result[$r['pid']]['name'] = $this->rp_getValue("product", "name", "id='" . $r['pid'] . "'");
				$result[$r['pid']]['labs'] = $r['id'];
				$result[$r['pid']]['qty'] = 1;
				$result[$r['pid']]['job_no'] = SITE_SHORT . "/" . FINANCIAL_YEAR . "/" . $job_id;
				$result[$r['pid']]['letter_no'] = $job_information['letter_no'];
				$result[$r['pid']]['letter_date'] = date("d-M-y", strtotime($job_information['letter_date']));
				$result[$r['pid']]['total_price'] = $sum;
				$result[$r['pid']]['sample_rate'] = $result[$r['pid']]['total_price'] / $result[$r['pid']]['qty'];
			}

			$result[$r['pid']]['detail'][] = $r;
			$count++;
		}

		return $result;
	}
	function getTest($pid, $debug = 0)
	{
		$result = array();
		$rows = $this->rp_getData("product_map_test", "*", "product_id='" . $pid . "' AND isDelete=0", "", $debug);
		while ($data = mysqli_fetch_assoc($rows)) {
			$test_id = $data['test_id'];
			$r = $this->rp_getData("test", "*", "id='" . $test_id . "'", "", 0);
			$test = mysqli_fetch_assoc($r);
			$result[] = $test;
		}
		return $result;
	}
	function getTests($tid = "", $debug = 0)
	{
		$result = array();
		if ($tid != "") {
			$rows = $this->rp_getData("test", "*", "id='" . $tid . "' AND isDelete=0", "", $debug);
			$result = mysqli_fetch_assoc($rows);
		} else {
			$rows = $this->rp_getData("test", "*", "isDelete=0", "", $debug);
			while ($data = mysqli_fetch_assoc($rows)) {
				$result[] = $data;
			}
		}

		return $result;
	}
	function getJobDetail($jid, $debug = 0)
	{
		$result = array();
		if ($jid != "") {
			$result = mysqli_fetch_assoc($this->rp_getData("job", "*", "id='" . $jid . "' AND isDelete=0", "", 0));
		}
		return $result;
	}
	function getJobStatus($jobStatus, $html)
	{

		$status = array("In Progress", "Completed", "Billed");
		$statusHtml = array("<span class='text-warning'><i class='fa fa-clock-o'></i> &nbsp;In Progress</span>", "<span class='text-success'><i class='fa fa-check'></i> &nbsp;Completed</span>", "<span class='text-success'><i class='fa fa-print'></i> &nbsp;Billed</span>");
		$jobStatus = intval($jobStatus);
		if (array_key_exists($jobStatus, $status)) {
			if ($html) {
				return $statusHtml[$jobStatus];
			} else {
				return $status[$jobStatus];
			}
		} else {
			return false;
		}
	}
	function getLabStatus($labStatus, $html)
	{
		$status = array("In Progress", "Completed");
		$statusHtml = array("<span class='text-warning'><i class='fa fa-clock-o'></i> &nbsp;In Progress</span>", "<span class='text-success'><i class='fa fa-check'></i> &nbsp;Completed</span>");
		$labStatus = intval($labStatus);
		if (array_key_exists($labStatus, $status)) {
			if ($html) {
				return $statusHtml[$labStatus];
			} else {
				return $status[$labStatus];
			}
		} else {
			return false;
		}
	}
	function labAssistant($lab_id, $debug = 0)
	{
		$lab_assistant_id = $this->rp_getValue("lab", "lab_assistant_id", "id='" . $lab_id . "' AND isDelete=0", "", $debug);
		return $lab_assistant_id;
	}
	function labTests($lab_id, $debug = 0)
	{
		$tests = $this->rp_getValue("lab", "tests", "id='" . $lab_id . "' AND isDelete=0", "", $debug);
		return $tests;
	}
	function isJobsCompleted($jobs)
	{
		if (!empty($jobs)) {
			foreach ($jobs as $j) {
				$status = $this->rp_getValue("job", "status", "id='" . $j . "'");
				if ($status == 0) {
					return false;
				}
			}
			return true;
		} else {
			return false;
		}
	}
	function changeJobsStatus($job_ids, $status)
	{
		$isGoingWell = true;
		foreach ($job_ids as $job_id) {
			$rows = array(
				"status" => $status
			);
			if ($job_id = $this->rp_update("job", $rows, "id='" . $job_id . "'", 0)) {
			} else {
				$isGoingWell = false;
			}
		}
		return $isGoingWell;
	}
	function changeLabsStatus($job_ids, $status)
	{
		$isGoingWell = true;
		foreach ($job_ids as $job_id) {

			$rows = array(
				"status" => $status
			);
			if ($job_id = $this->rp_update("lab", $rows, "job_id='" . $job_id . "'", 0)) {
			} else {
				$isGoingWell = false;
			}
		}
		return $isGoingWell;
	}
	function addCustomerBranch($cid = "", $branch_name = "", $debug = 0)
	{
		if ($branch_name != "" && $cid != "") {
			$adate	= date('Y-m-d H:i:s');
			$rows = array("cid", "branch_name", "adate", "isDelete");
			$values = array($cid, $branch_name, $adate, 0);
			$cbid = $this->rp_insert("customer_branch", $values, $rows, $debug);
			if ($cbid != 0) {
				return $response = array('ack' => 1, 'ack_msg' => 'Branch added Successfully !!!');
			} else {
				return $response = array('ack' => 0, 'ack_msg' => 'Branch name can not be empty !!!');
			}
		} else {
			return $response = array('ack' => 0, 'ack_msg' => 'Branch name can not be empty !!!');
		}
	}
	function changeJobStatus($job_id)
	{
		$allLabStatus = $this->rp_getTotalRecord("lab", "job_id='" . $job_id . "' AND status='0' AND isDelete='0'", 0);

		if ($allLabStatus == 0) {

			$jobStatus = 0;
			$rows = array(
				"status" => 1
			);
			if ($job_id = $this->rp_update("job", $rows, "id='" . $job_id . "'", 0)) {
				$jobStatus = 1;
			}
		} else {

			$rows = array(
				"status" => 0
			);
			if ($job_id = $this->rp_update("job", $rows, "id='" . $job_id . "'", 0)) {
				$jobStatus = 0;
			}
		}
		return $jobStatus;
	}
	function getAdmin($type, $debug)
	{
		$result = array();
		if ($type != "") {
			$rows = $this->rp_getData("stern", "*", "type='" . $type . "' AND isDelete=0", "", $debug);
			while ($data = mysqli_fetch_assoc($rows)) {
				$result[] = $data;
			}
		}
		return $result;
	}
	function getTaxs($id = "", $debug = 0)
	{
		if ($id == "") {
			$result = array();
			$current_date = date('Y-m-d');
			$rows = $this->rp_getData("tax", "*", "DATE(applied_from)<='" . $current_date . "' AND isDelete=0", "", 0);
			while ($data = mysqli_fetch_assoc($rows)) {
				$result[] = $data;
			}
		} else {
			$result = array();
			$current_date = date('Y-m-d');
			$result = mysqli_fetch_assoc($this->rp_getData("tax", "*", "DATE(applied_from)<='" . $current_date . "' AND isDelete=0", "", 0));
		}
		return $result;
	}
	function getTaxValues($tax_ids, $debug = 0)
	{
		$result = array();
		foreach ($tax_ids as $tax) {
			$result[] = $this->rp_getValue("tax", "value", "id='" . $tax . "' AND isDelete=0", "", $debug);
		}


		return $result;
	}

	function billTaxCalculation($tax_ids, $tax_values, $tax_type, $total_price)
	{
		$result = array();
		$orignal = $total_price;
		if ($tax_type == 1) {
			$additional_fig = 1.145;
		} else {
			$additional_fig = 1;
		}
		$calculated = $total_price;
		for ($i = 0; $i < sizeof($tax_ids); $i++) {
			$title = $this->rp_getValue("tax", "name", "id='" . $tax_ids[$i] . "'") . "</b> @ " . $tax_values[$i] . "%";
			$value = round(((floatval($total_price) / $additional_fig) * floatval($tax_values[$i])) / 100, 2);
			$result[] = array("title" => $title, "value" => $value);
			$calculated = $value + $calculated;
		}
		if ($tax_type == 2) {
			$result['final_total'] = $calculated;
		} else {
			$result['final_total'] = $orignal;
		}
		return $result;
	}
	function getBillType($bill_id = "", $debug = 0)
	{
		if ($bill_id == "") {
			$result = array();
			$rows = $this->rp_getData("bill_type", "*", "isDelete=0", "", 0);
			while ($data = mysqli_fetch_assoc($rows)) {
				$result[] = $data;
			}
		} else {
			$result = array();
			$result = mysqli_fetch_assoc($this->rp_getData("tax", "*", "id='" . $bill_id . "'", "", 0));
		}
		return $result;
	}
	function addErrorMessage($message)
	{
		$TYPE = $GLOBALS['PANEL_TYPE'];
		if (isset($_SESSION[$TYPE . 'error_message']) && $_SESSION[$TYPE . 'error_message'] != "") {
			unset($_SESSION[$TYPE . 'error_message']);
		}
		if ($message != "")
			$_SESSION[$TYPE . 'error_message'] = $message;
	}
	function addSuccessMessage($message)
	{
		$TYPE = $GLOBALS['PANEL_TYPE'];
		if (isset($_SESSION[$TYPE . 'success_message']) && $_SESSION[$TYPE . 'success_message'] != "") {
			unset($_SESSION[$TYPE . 'success_message']);
		}
		if ($message != "")
			$_SESSION[$TYPE . 'success_message'] = $message;
	}
	function printErrorMessage()
	{
		$TYPE = $GLOBALS['PANEL_TYPE'];
		if (isset($_SESSION[$TYPE . 'error_message']) && $_SESSION[$TYPE . 'error_message'] != "") {
		?>

			<div class="alert alert-danger alert-dismissable"> <i class="fa fa-ban"></i>
				<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
				<b><?php echo $_SESSION[$TYPE . 'error_message']; ?></b>
			</div>

		<?php
			unset($_SESSION[$TYPE . 'error_message']);
		}
	}

	function printSuccessMessage()
	{
		$TYPE = $GLOBALS['PANEL_TYPE'];
		if (isset($_SESSION[$TYPE . 'success_message']) && $_SESSION[$TYPE . 'success_message'] != "") {
		?>

			<div class="alert alert-success alert-dismissable"> <i class="fa fa-check"></i>
				<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
				<b><?php echo $_SESSION[$TYPE . 'success_message']; ?></b>
			</div>

		<?php
			unset($_SESSION[$TYPE . 'success_message']);
		}
	}
	function getConsoleBlock()
	{
		if (AJAX_DEBUG == 1) {
		?>
			<div class="portlet light" id="console">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-bug"></i>
						<span class="caption-subject bold uppercase"> Console</span>

					</div>
				</div>
				<div class="portlet-body">
				</div>
			</div>
<?php
		}
	}
	public function checkAPIKey($key, $die = 0)
	{
		$count = $this->rp_getTotalRecord("api_key_table", "api_key='" . $key . "' AND isActive=1");
		if ($count > 0) {
			return true;
		} else {
			$this->AddAPILog($key, "", 0);
			return false;
		}
	}
	public function checkAPI($api_slug, $api_key, $die = 0)
	{
		$count = $this->rp_getTotalRecord("api_table", "api_slug='" . $api_slug . "' OR id='" . $api_slug . "'");
		if ($count > 0) {
			$this->AddAPILog($api_key, $api_slug, 1);
			return true;
		} else {
			$this->AddAPILog($api_key, $api_slug, 0);
			return false;
		}
	}
	function AddAPILog($APIKey, $APISlug, $Authorize)
	{
		$RequestedURL = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$APIAccessTime = strtotime(date("Y-m-d H:i:s"));
		$APIAccessMethod = $_SERVER['REQUEST_METHOD'];
		$IPAddress = $this->rp_get_client_ip();
		$Params = $_REQUEST;
		$ClientUserAgent = $_SERVER['HTTP_USER_AGENT'];
		$Params['user_agent'] = $ClientUserAgent;
		$Params = addslashes(serialize($Params));
		$values = array($APIKey, $APISlug, $RequestedURL, $APIAccessMethod, $Params, $APIAccessTime, $IPAddress, $Authorize);
		$columns = array("api_key", "api_slug", "uri", "method", "params", "time", "ip_address", "authorize");
		$this->rp_insert(CTABLE_API_LOG, $values, $columns, 0);
	}
	public function printJSON($val, $die = 0)
	{
		//$val["extra"]=array("requested_params"=>$_REQUEST);
		echo json_encode($val);
		if ($die)
			exit();
	}
	public function getRequestedParam($val, $die = 0)
	{
		if ($val != "") {
			return (isset($_REQUEST[$val]) && $_REQUEST[$val] != "") ? $_REQUEST[$val] : "";
		} else {
			return "";
		}
		if ($die)
			exit();
	}
	public function getLimit()
	{
		$ul = $this->getRequestedParam("ul"); //upper_limit
		$ll = $this->getRequestedParam("ll"); //lower_limit
		if ($ul != "") {
			return array("ul" => $ul, "ll" => $ll);
		} else {
			return array();
		}
	}
	public function aj_updateUserPassword($id, $newPassword, $password)
	{

		$rows = array("password" => $newPassword);
		$where = " id='" . $id . "'";
		return $this->rp_update("sales_executive", $rows, $where, 0);
	}
	public function update_table_information($table_slug, $date)
	{
		//echo "UPDATE ".CTABLE_INFORMATION_SCHEMA." SET last_modified_date='".$date."' WHERE `table_slug`='".$table_slug."'";
		//exit;
		/*  $isUpdated=mysqli_query($this->conn,"UPDATE ".CTABLE_INFORMATION_SCHEMA." SET last_modified_date='".$date."' WHERE `table_slug`='".$table_slug."'");
        if($isUpdated)
        {
            return true;
        }
        else
        {
            return false;
        }*/
	}
	function aNum($num, $d = "0.3")
	{
		return sprintf("%" . $d . "f", $num);
	}
	function postiveNumber($num)
	{
		return ($num < 0) ? 0 : floatval($num);
	}

	public function arraySearchMultidim($array, $column, $key)
	{
		return (array_search($key, array_column($array, $column)));
	}

	public function parseDate($Date, $Format = "d-m-y")
	{
		if ($Date == "0000-00-00 00:00:00" || $Date == "0000-00-00")
			return "";
		else
			return date($Format, strtotime($Date));
	}
	public function parseDateTime($Date, $Format = "d-m-Y H:i")
	{
		if ($Date == "0000-00-00 00:00:00" || $Date == "0000-00-00")
			return "";
		else
			return date($Format, strtotime($Date));
	}




	function rp_getAllRating($p_id)
	{

		$numberofReviews = 0;
		$totalStars = 0;
		$average = 0;
		$user_id = $this->rp_getData("rating", "*", "participate_id='" . $p_id . "' AND isDelete=0");
		if ($user_id) {
			while ($user_id_r = mysqli_fetch_assoc($user_id)) {

				$rating = $user_id_r['option1'];
				$numberofReviews++;
				$totalStars  += $rating;
			}

			$average = $totalStars / $numberofReviews;
		}

		return $average;
	}

	function rp_getRating($p_id, $designation, $max)
	{

		$numberofReviews = 0;
		$totalStars = 0;
		$average = 0;
		$user_id = $this->rp_getData("rating", "*", "participate_id='" . $p_id . "' AND isDelete=0");
		if ($user_id) {
			while ($user_id_r = mysqli_fetch_assoc($user_id)) {

				$user_id_d = $user_id_r['user_id'];

				$user_d = $this->rp_getData("user_common", "*", "id='" . $user_id_d . "' AND designation='" . $designation . "' AND isDelete=0");

				if ($user_d) {

					while ($user_r = mysqli_fetch_assoc($user_d)) {
						$user = $user_r['id'];

						if ($user == $user_id_d) {
							$rating = $this->rp_getValue("rating", "option1", "user_id='" . $user . "' AND isDelete=0");
							$numberofReviews++;
							$totalStars  += $rating;
						}
					}

					if ($max <= $numberofReviews) {
						$average = $totalStars / $numberofReviews;
					}
				}
			}
		}
		return $average;
	}

	function rp_getGroupRating($participate_id)
	{

		$average_vice_principal = $this->rp_getRating($participate_id, 'Vice-Principal', 0);
		$average_trustee = $this->rp_getRating($participate_id, 'Trustee', 0);
		$average_campus_director = $this->rp_getRating($participate_id, 'Campus Director', 0);
		$average_crc = $this->rp_getRating($participate_id, 'CRC', 0);
		$average_brc = $this->rp_getRating($participate_id, 'BRC', 0);
		$average_deo = $this->rp_getRating($participate_id, 'DEO', 0);


		$numberofReviews = 0;

		$average = 0;

		if ($average_vice_principal > 0) {
			$numberofReviews++;
		}
		if ($average_trustee > 0) {
			$numberofReviews++;
		}
		if ($average_campus_director > 0) {
			$numberofReviews++;
		}
		if ($average_crc > 0) {
			$numberofReviews++;
		}
		if ($average_brc > 0) {
			$numberofReviews++;
		}
		if ($average_deo > 0) {
			$numberofReviews++;
		}




		if ($numberofReviews > 0) {
			$average = ($average_vice_principal + $average_trustee + $average_campus_director + $average_crc + $average_brc + $average_deo) / $numberofReviews;
		}
		return $average;
	}

	function rp_getMarks($ctable, $p_id, $max, $marks)
	{
		$total_marks = 0;
		$training_id = $this->rp_getTotalRecord($ctable, "cus_id='" . $p_id . "' AND isDelete=0  AND isActive=1");
		if ($training_id <= $max) {

			$total_marks = $training_id * $marks;
		} else if ($training_id > $max) {
			$total_marks = $max * $marks;
		}
		return $total_marks;
	}

	function rp_getTotalMarks($participate_id)
	{




		$average_principal = $this->rp_getRating($participate_id, 'Principal', 0);
		$average_group = $this->rp_getGroupRating($participate_id);
		$average_student = $this->rp_getRating($participate_id, 'Student', 20);
		$average_parent = $this->rp_getRating($participate_id, 'Parent', 20);
		$average_teacher = $this->rp_getRating($participate_id, 'Educator', 20);

		$training_marks = $this->rp_getMarks("training", $participate_id, 3, 5);
		$article_marks = $this->rp_getMarks("article", $participate_id, 1, 5);
		$video_marks = $this->rp_getMarks("video", $participate_id, 1, 5);
		$book_marks = $this->rp_getMarks("book", $participate_id, 5, 1);
		$article_publication_marks = $this->rp_getMarks("article_publication", $participate_id, 5, 1);
		$course_marks = $this->rp_getMarks("course", $participate_id, 2, 5);
		$award_marks = $this->rp_getMarks("awards", $participate_id, 3, 10);

		$test_mark = $this->rp_getValue("test", "score", "user_id='" . $participate_id . "' AND isDelete=0");

		if ($test_mark) {
			$test_marks = $test_mark;
		} else {
			$test_marks = 0;
		}




		$dup_where = "participate_id = '" . $participate_id . "' AND isDelete=0";
		$r = $this->rp_dupCheck("user_data", $dup_where, 0);
		if ($r) {
			$total_marks = ($average_principal + $average_group + $average_student + $average_parent + $average_teacher + $training_marks + $article_marks + $video_marks + $book_marks + $article_publication_marks + $course_marks + $award_marks + $test_marks);

			$rows = array(
				"principal" => $average_principal,
				"groups" => $average_group,
				"parents" => $average_parent,
				"students" => $average_student,
				"teacher_colleagues" => $average_teacher,
				"training" => $training_marks,
				"article" => $article_marks,
				"video" => $video_marks,
				"books" => $book_marks,
				"article_publication" => $article_publication_marks,
				"courses" => $course_marks,
				"awards" => $award_marks,
				"test" => $test_marks,
				"total_marks" => $total_marks,


			);
			$where = "participate_id='" . $participate_id . "'";
			$cbid = $this->rp_update("user_data", $rows, $where, 0);
			if ($cbid != 0) {
				return 1;
			} else {
				return 0;
			}
		} else {

			$total_marks = ($average_principal + $average_group + $average_student + $average_parent + $average_teacher + $training_marks + $article_marks + $video_marks + $book_marks + $article_publication_marks + $course_marks + $award_marks + $test_marks);

			$rows = array("participate_id", "principal", "groups", "parents", "students", "teacher_colleagues", "training", "article", "video", "books", "article_publication", "courses", "awards", "test", "total_marks", "created_date");
			$values = array($participate_id, $average_principal, $average_group, $average_parent, $average_student, $average_teacher, $training_marks, $article_marks, $video_marks, $book_marks, $article_publication_marks, $course_marks, $award_marks, $test_marks, $total_marks, date("Y-m-d H:i:s"));
			$cbid = $this->rp_insert("user_data", $values, $rows, 0);
			if ($cbid != 0) {
				return 1;
			} else {
				return 0;
			}
		}
	}



	function rp_addCustomerProduct($cid, $total)
	{
		$totalProduct = 0;
		$quotation_d = $this->rp_getData("quotation_mapping", "*", "cid='" . $cid . "' AND isDelete=0");
		if ($quotation_d) {
			while ($quotation_r = mysqli_fetch_assoc($quotation_d)) {

				$total_r = $quotation_r['total'];


				$totalProduct  = $total + $total_r;
			}
			$rows = array(
				"total" => $totalProduct
			);
			$quotation_id = $this->rp_update("quotation_mapping", $rows, "cid='" . $cid . "'", 0);
			if ($quotation_id) {
				return 1;
			} else {
				return 0;
			}
		} else {
			$rows = array("cid", "total", "created_date");
			$values = array($cid, $total, date("Y-m-d H:i:s"));
			$cbid = $this->rp_insert("quotation_mapping", $values, $rows, 0);
			if ($cbid != 0) {
				return 1;
			} else {
				return 0;
			}
		}
	}
}
include("admin.class.php");
?>