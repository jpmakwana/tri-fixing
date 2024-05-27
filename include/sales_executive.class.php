<?php
require_once("main.class.php");
require_once("function.class.php");
require_once("class.log.php");
class SalesExecutive extends Functions
{
	public $db;
	public $log;
	public $ctable="sales_executive";
	public $ctableTracking="salesexecutive_tracking";
	public $ctableNoOrderInquiry="no_order_inquiry";
	
	public $id='';public $name='';public $email='';public $password='';public $phone='';public $address='';public $isVarified='';public $isActive='';
    public $valid_keys=array("id","phone","imei","refreshToken","otp","last_login");
	function __construct($id="") 
	{
		$db = new Functions();
		$conn = $db->connect();
		$this->db=$db;	
		$log	= new Log();
		$this->log=$log;		
    } 
	
	
	 public function InsertSalesExecutive($detail,$area) 
	 {
		extract($detail);
		$dup_where = "phone = '".$mobile."' AND username='".$username."' AND isDelete=0";
		$r = $this->db->rp_dupCheck($this->ctable,$dup_where);
		
		if($r){
			$reply=array("ack"=>0,"developer_msg"=>"Duplicate Sales Executive","ack_msg"=>"Already Exist this UserName Or Mobile Number!!");
			return $reply;
		}
		else
		{
			 $adate	= date('Y-m-d H:i:s');
			$rows 	= array(
						"name",
						"phone",
						"password",
						"username",
						"zip",
						"email",
						"address",
						"country",
						"state",
						"city",
						"class_id",
						"type",
						"created_date",
						"executive_in_min",
						"executive_in_max",
						"executive_out",
						//"super_stokist_order_insert_flag",
						//"super_stokist_order_update_flag",
						"dealer_order_insert_flag",
						"dealer_order_update_flag",
						"outlets_order_insert_flag",
						"outlets_order_update_flag",
						"inquiry_insert_flag",
						"inquiry_update_flag",
						"inquiry_delete_flag",
						"customer_insert_flag",
						"customer_update_flag",
					);
			$values = array(
						$sales_executive_name,
						$mobile,
						md5($password),
						$username,
						$pincode,
						$email,
						$address,
						$country,
						$state,
						$city,
						$class_id,
						"sales_executive",
						$adate,
						$executive_in_min,
						$executive_in_max,
						$executive_out,
						//$super_stokist_order_insert_flag,
						//$super_stokist_order_update_flag,
						$dealer_order_insert_flag,
						$dealer_order_update_flag,
						$outlets_order_insert_flag,
						$outlets_order_update_flag,
						$inquiry_insert_flag,
						$inquiry_update_flag,
						$inquiry_delete_flag,
						$customer_insert_flag,
						$customer_update_flag,
					);
					
		 	$sales_executive_id = $this->db->rp_insert($this->ctable,$values,$rows,0);
			$this->log->insertLog($this->ctable,$sales_executive_id,"insert",$this->log->slm['SALES_EXECUTIVE_INSERT']." : ".$sales_executive_name);
			if($sales_executive_id!=0)
			{
				/* $current_area=array();
				// Insert Area
				if(!empty($area))
				{
					for($i=0;$i<sizeof($area);$i++)
					{
						$current_area=$area[$i];
						$area_slug=$this->db->rp_getValue("area","area_slug","id='".$current_area['area_id']."'");
						$class_slug=$this->db->rp_getValue("class","class_slug","id='".$class_id."'");
						  $adate	= date('Y-m-d H:i:s');
							$rows 	= array(
							"class_id",
							"area_id",
							"area_slug",
							"class_slug",
							"sales_executive_id",
							"created_date"
						);
						$values = array(
							$class_id,
						    $current_area['area_id'],
						    $area_slug,
						    $class_slug,
						    $sales_executive_id,
						    $adate
						);
						$mapping_id = $this->db->rp_insert("sales_executive_map_area",$values,$rows,0);
						$area_name[]=$this->db->rp_getValue("area","area_name","isDelete=0 AND id='".$current_area['area_id']."'",0);
					}
					$area_list=implode(",",$area_name);
					
					$this->log->insertLog("sales_executive_map_area",$customer_id,"insert","Sales Executive ".$sales_executive_name." Inserted \n Mapped Area :\n".$area_list);
				}*/
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('SSALES_EXECUTIVE_INSERT',1),"ack_msg"=>$this->log->getMessage('SALES_EXECUTIVE_INSERT'),"sales_id"=>$sales_executive_id);
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! sales executive  not Inserted.");
				return $reply;
			}
		}
	 }
	public function UpdateSalesExecutive($detail,$area)
	  {
			extract($detail);
			$dup_where = "phone = '".$mobile."' AND username='".$username."' AND id!='".$_REQUEST['id']."' AND isDelete=0";
			$r = $this->db->rp_dupCheck($this->ctable,$dup_where);
			if($r){
				$reply=array("ack"=>0,"developer_msg"=>"Duplicate Sales Executive","ack_msg"=>"Already Exist this UserName Or Mobile Number!!","id"=>$_REQUEST['id']);
			return $reply;
				
			}else{
				$created_date=date('Y-m-d H:i:s');
				$rows 	= array(
							"name"	=> $sales_executive_name,
							"phone"	=> $mobile,
							"username"	=> $username,
							"zip"	=> $pincode,
							"class_id"	=> $class_id,
							"email"	=> $email,
							"address"	=> $address,
							"country"			=> $country,
							"state"			=> $state,	
							"city"			=> $city,
							"created_date"			=> $created_date,
							"executive_in_min"		=> $executive_in_min,
							"executive_in_max"		=> $executive_in_max,
							"executive_out"		=> $executive_out,
							//"super_stokist_order_insert_flag"=>$super_stokist_order_insert_flag,
							//"super_stokist_order_update_flag"=>$super_stokist_order_update_flag,
							"dealer_order_insert_flag"=>$dealer_order_insert_flag,
							"dealer_order_update_flag"=>$dealer_order_update_flag,
							"outlets_order_insert_flag"=>$outlets_order_insert_flag,
							"outlets_order_update_flag"=>$outlets_order_update_flag,
							"inquiry_insert_flag"=>$inquiry_insert_flag,
							"inquiry_update_flag"=>$inquiry_update_flag,
							"inquiry_delete_flag"=>$inquiry_delete_flag,
							"customer_insert_flag"=>$customer_insert_flag,
							"customer_update_flag"=>$customer_update_flag,
						);
				$where	= "id='".$_REQUEST['id']."'";
				$uid=$this->db->rp_update($this->ctable,$rows,$where,0);
				$this->log->insertLog($this->ctable,$_REQUEST['id'],"update",$this->log->slm['SALES_EXECUTIVE_UPDATE']." : ".$sales_executive_name);
				if($uid!=0)
				{
					/*$this->db->rp_delete("sales_executive_map_area","sales_executive_id='".$_REQUEST['id']."'",0);
					 $current_area=array();
					// Insert Area
					if(!empty($area))
					{
						for($i=0;$i<sizeof($area);$i++)
						{
							$current_area=$area[$i];
							$area_slug=$this->db->rp_getValue("area","area_slug","id='".$current_area['area_id']."'");
							$class_slug=$this->db->rp_getValue("class","class_slug","id='".$class_id."'");
							  $adate	= date('Y-m-d H:i:s');
								$rows 	= array(
								"class_id",
								"area_id",
								"area_slug",
								"class_slug",
								"sales_executive_id",
								"created_date"
							);
							$values = array(
								$class_id,
								$current_area['area_id'],
								$area_slug,
								$class_slug,
								$_REQUEST['id'],
								$adate
							);
							$mapping_id = $this->db->rp_insert("sales_executive_map_area",$values,$rows,0);
							$area_name[]=$this->db->rp_getValue("area","area_name","isDelete=0 AND id='".$current_area['area_id']."'",0);
						}
						$area_list=implode(",",$area_name);
					
					$this->log->insertLog("customer_map_area",$uid,"Update","Sales Executive ".$sales_executive_name." Updated \n Mapped Area :\n".$area_list);
					}*/
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('SALES_EXECUTIVE_UPDATE',1),"ack_msg"=>$this->log->getMessage('SALES_EXECUTIVE_UPDATE'));
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Update Failed.");
					return $reply;
				}
			}	
		}	
	public function SalesExecutiveGetEditData($detail)
	{		
		$where = " id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where);
		$ctable_d = mysqli_fetch_array($ctable_r);
		$result=array();
		$result['name']		= htmlentities($ctable_d['name']);
		$result['mobile']		= htmlentities($ctable_d['phone']);
		$result['username']		= htmlentities($ctable_d['username']);
		$result['pincode']		= htmlentities($ctable_d['zip']);
		$result['password']		= md5(utf8_decode($ctable_d['password']));
		$result['email']	= htmlentities($ctable_d['email']);
		$result['address']	= htmlentities($ctable_d['address']);
		$result['country']	= htmlentities($ctable_d['country']);
		$result['state']		= stripslashes($ctable_d['state']);
		$result['city']			= stripslashes($ctable_d['city']);
		$result['class_id']			= stripslashes($ctable_d['class_id']);
		$result['executive_in_min']			= stripslashes($ctable_d['executive_in_min']);
		$result['executive_in_max']			= stripslashes($ctable_d['executive_in_max']);
		$result['executive_out']			= stripslashes($ctable_d['executive_out']);
		//$result['super_stokist_order_insert_flag']			= stripslashes($ctable_d['super_stokist_order_insert_flag']);
		//$result['super_stokist_order_update_flag']			= stripslashes($ctable_d['super_stokist_order_update_flag']);
		$result['dealer_order_insert_flag']			= stripslashes($ctable_d['dealer_order_insert_flag']);
		$result['dealer_order_update_flag']			= stripslashes($ctable_d['dealer_order_update_flag']);
		$result['outlets_order_insert_flag']			= stripslashes($ctable_d['outlets_order_insert_flag']);
		$result['outlets_order_update_flag']			= stripslashes($ctable_d['outlets_order_update_flag']);
		$result['customer_insert_flag']			= stripslashes($ctable_d['customer_insert_flag']);
		$result['customer_update_flag']			= stripslashes($ctable_d['customer_update_flag']);
		$result['inquiry_insert_flag']			= stripslashes($ctable_d['inquiry_insert_flag']);
		$result['inquiry_update_flag']			= stripslashes($ctable_d['inquiry_update_flag']);
		$result['inquiry_delete_flag']			= stripslashes($ctable_d['inquiry_delete_flag']);
		$reply=array("ack"=>1,"developer_msg"=>"User detail fetched!!.","ack_msg"=>"Success! Sales Executive Detail Fetched Successfully.","result"=>$result);
		return $reply;
	
	}
	 public function GetArea($detail)
	{

			$where = "sales_executive_id='".$_REQUEST['id']."' AND isDelete=0";
			$ctable_user = $this->db->rp_getData("sales_executive_map_area","*",$where,"",0);
			if($ctable_user)
			{

			while($ctable_user_d = mysqli_fetch_array($ctable_user))
			{
				$result_item=array();

				$result_item['id']				= htmlentities($ctable_user_d['id']);
				$result_item['area_id']		= htmlentities($ctable_user_d['area_id']);
				$result_item['class_id']		= htmlentities($ctable_user_d['class_id']);
				$result[]=$result_item;
				//print_r($result);
			}

			$reply=array("ack"=>1,"developer_msg"=>"Event User fetched!!.","ack_msg"=>"Success! Update Event User Successfully.","result"=>$result);
			return $reply;
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"Event User not fetched!!.","ack_msg"=>"Success! Event User Fetched"	);
			return $reply;
		}

	}
	public function SalesExecutiveDelete($detail)
	{
		$sales_executive_name=$this->db->rp_getValue($this->ctable,"name","isDelete=0 AND id='".$detail['id']."'");
		$rows 	= array(
		"isDelete"	=> "1"
		);
			$where	= "id='".$_REQUEST['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['SALES_EXECUTIVE_DELETE']." : ".$sales_executive_name);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('SALES_EXECUTIVE_DELETE',1),"ack_msg"=>$this->log->getMessage('SALES_EXECUTIVE_DELETE'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Delete record Failed.");
				return $reply;
			}
	}
	function trackSales($sales_id,$date="")
	{
		$count=$this->db->rp_getTotalRecord($this->ctable,"id='".$sales_id."'");
		if($count>=1)
		{
			$where="sales_executive_id='".$sales_id."' AND isDelete=0";
			if($date!="")
			{
				$where.=" AND DATE(date)='".date("Y-m-d",strtotime($date))."'";
			}
			$sales_routes=$this->db->rp_getData($this->ctableTracking,"*",$where,"date ASC",0);
			if($sales_routes)
			{
				while($route=mysqli_fetch_assoc($sales_routes))
				{
					$result[]=array("lat"=>$route['latitude'],"lng"=>$route['longitude'],"date"=>date("d M H:i",strtotime($route['date'])),"type"=>$this->pin_type[$route['type']],"type_slug"=>$route['type'],"icon"=>$this->pin_icon[$route['type']]);
				}
				$reply=array("ack"=>1,"ack_msg"=>"Sales Tracking Fetched!!","result"=>$result);
			}
			else
			{
				$reply=array("ack"=>0,"ack_msg"=>"No Route Found!!");
			}
			
		}
		else
		{
			$reply=array("ack"=>0,"ack_msg"=>"No Sales Found!!");
		}
		return $reply;
	}
	function addNoOrderInquiry($data){
		
		if(!empty($data))
		{
			$data['modify_date']=date("Y-m-d H:i:s");
			$data['modify_track']=date("Y-m-d H:i:s");
			$data['created_date']=date("Y-m-d H:i:s");
			$columns=array_keys($data);
			$data_values=array_values($data);
			$id=$this->db->rp_insert($this->ctableNoOrderInquiry,$data_values,$columns,0);
			$reply=array("ack"=>1,"developer_msg"=>"Inquiry Successfully Submitted","ack_msg"=>"Inquiry Successfully Submitted","inserted_id"=>$id);
			return $reply;
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"No data found","ack_msg"=>"Internal Error!!ADDNOI1");
			return $reply;
		}
		
	}
	function updateNoOrderInquiry($data,$id){
		
		if(!empty($data))
		{
			$last_track=$this->db->rp_getValue($this->ctableNoOrderInquiry,"modify_track","id='".$id."'");
			$data['modify_date']=date("Y-m-d H:i:s");
			$data['modify_track']=$last_track."&5895;".date("Y-m-d H:i:s");
			$this->db->rp_update($this->ctableNoOrderInquiry,$data,"id='".$id."'",0);
			$reply=array("ack"=>1,"developer_msg"=>"Inquiry Successfully Updated","ack_msg"=>"Inquiry Successfully Updated");
			return $reply;
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"No data found","ack_msg"=>"Internal Error!! ERROR UPNOI1");
			return $reply;
		}
		
	}
	
	function deleteNoOrderInquiry($id){
		
		
		$last_track=$this->db->rp_getValue($this->ctableNoOrderInquiry,"modify_track","id='".$id."'");
		$data['modify_date']=date("Y-m-d H:i:s");
		$data['modify_track']=$last_track."&5895;".date("Y-m-d H:i:s");
		$data['isDelete']=1;
		$this->db->rp_update($this->ctableNoOrderInquiry,$data,"id='".$id."'",0);
		$reply=array("ack"=>1,"developer_msg"=>"Inquiry Successfully Deleted","ack_msg"=>"Inquiry Successfully Deleted");
		return $reply;
		
		
	}
	function listNoOrderInquiry($id)
	{
		
		if($id!="")
		{
			$noOrderInquiryR=$this->db->rp_getData($this->ctableNoOrderInquiry,"*","id='".$id."'");
			if($noOrderInquiryR)
			{
				$result=array();
				while($noOrderInquiry=mysqli_fetch_assoc($noOrderInquiryR))
				{
					$result[]=$noOrderInquiry;
				}
				$reply=array("ack"=>1,"developer_msg"=>"Inquiry Get Successfully Order Inquiry","ack_msg"=>"Inquiry Successfully Fetched","result"=>$result);
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"No Inquiry Found!!","ack_msg"=>"No Inquiry Found!!");
				return $reply;
			}
			
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"No data found","ack_msg"=>"Internal Error!! ERROR LISTNOI1");
			return $reply;
		}
		
	}
	function getNoOrderInquiry($sales_id)
    {
		$result = array();
		$where="sales_executive_id	 ='".$sales_id."'";
		//$customer_id=$this->db->rp_getValue('orders','customer_id',$where,0);
		//$customer=$this->db->rp_getValue('executive','isActive',"id=".$customer_id."",0);
		//$where_final="sales_id ='".$_REQUEST['sales_id']."' AND sales_type='".$_REQUEST['sales_type']."' AND isActive!=".$customer."";
		$data    = $this->db->rp_getData('no_order_inquiry',"id, local_id, sales_executive_id, customer_name, mobile_number, contact_person, country, state, city, description, action, datetime, isDelete, isActive, created_date",$where,"id DESC",0);
		if($data)
		{
		while($r= mysqli_fetch_assoc($data))
		{
			
		 $r['sales_name'] = $this->db->rp_getValue($this->ctable,"name","id='".$r['sales_executive_id']."' AND type='".$r['sales_type']."'",0);
		 $r['country_slug'] = $r['country'];
		 $r['country'] = $this->db->rp_getValue("country","name","id='".$r['country']."'",0);
		 
		 $r['state_slug'] = $r['state'];		
		 $r['state'] = $this->db->rp_getValue("state","name","id='".$r['state']."'",0);
		 
		 $r['city_slug'] =  $r['city'];
		 $r['city'] = $this->db->rp_getValue("city","name","id='".$r['city']."'",0);
		 
		 $r['action_slug'] =  $r['action'];
		 $r['action'] = $this->db->rp_getValue("no_order_inquiry_action","name","id='".$r['action']."'",0);
		 
		$r['created_date']=date('d-m-Y',strtotime($r['created_date']));
		$r['datetime']=date('d-m-Y',strtotime($r['datetime']));
		 $result[] = $r; 
		}
		if(!empty($result))
		{
		$ack=array( "ack"=>1,
		  "ack_msg"=>"Successfully Get Inquiry !!",
		  "developer_msg"=>"You got it!!",
		  "result"=>$result,
		  );
		  return $ack;
		}
		else
		{
		$ack=array( "ack"=>0,
		  "ack_msg"=>"No Inquiry Found !!",
		  "developer_msg"=>"Not found!!",
		  "result"=>$result,
		  );
		  return $ack;
		}
		}
		else
		{
		$ack=array( "ack"=>0,
		 "ack_msg"=>"No Inquiry Found !!",
		 "developer_msg"=>"Not found!!",
		 "result"=>$result,
		 );
		 return $ack;
		}
	}
	function getPricelist($sales_id,$last_modified_date="")
    {
		
		if($last_modified_date!="")
		{
			$last_modified_date=" AND (modified_date>='".date("Y-m-d H:i:s",strtotime($last_modified_date))."' OR created_date>='".date("Y-m-d H:i:s",strtotime($last_modified_date))."')";
		}
		else
		{
			$last_modified_date="";
		}
		$salse_d = $this->db->rp_getData("sales_executive_map_area","*","sales_executive_id='".$sales_id."' ","",0);
		
			$area_id=array();
			$result=array();
			while($salse_r = mysqli_fetch_assoc($salse_d))
			{
				//area kadhvana
				$area_id[]=$salse_r['area_id'];
				
			}
			$area_id=array_unique($area_id);
			$area_id=implode(",",$area_id);
			
			
			$c_ids = $this->db->rp_getData("customer_map_area","*","area_id IN (".$area_id.")","",0);
		
			$price_list=array();
			$result=array();
			while($c_id = mysqli_fetch_assoc($c_ids))
			{
				$customer_id = $c_id['customer_id'];
				$pricelist_id = $this->db->rp_getValue("customer","price_list_id","id='".$customer_id."'",0); 
				
				$price_list[]=$pricelist_id;
				
			}
			$price_list=array_unique($price_list);
			$price_list=implode(",",$price_list);
			
			
			$class_r = $this->db->rp_getData("price_table","*","dcid IN (".$price_list.") ".$last_modified_date,"",0);
			if($class_r)
			{
				while($class_d = mysqli_fetch_assoc($class_r))
				{
					$result[] = $class_d;
				}
			}
			else
			{
				$result=array();
			}
			
			if(!empty($result))
			{
				$ack=array( "ack"=>1,
				  "ack_msg"=>"Successfully Get PriceList !!",
				  "developer_msg"=>"You got it!!",
				  "result"=>$result,
				  );
				  return $ack;
			}
			else
			{
				$ack=array( "ack"=>0,
				  "ack_msg"=>"No PriceList Found !!",
				  "developer_msg"=>"Not found!!",
				  "result"=>$result,
				  );
				  return $ack;
			}
	}
	
		
}
	
	


?>