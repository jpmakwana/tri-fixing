<?php
require_once("main.class.php");
require_once("function.class.php");
class Executive extends Functions
{
	public $db;
	public $ctable="executive";
	public $ctableMap="executive_map_area";
	
	function __construct($id="") 
	{
		$db = new Functions();
		$conn = $db->connect();
		$this->db=$db;		   
    } 
//-------#Insert Executive Detail------------------------------//	
	 public function InsertExecutive($end_user_type,$type_of_executive,$company_type,$company_name,$address,$super_stockist_id,$city,$state,$country,$email,$dealer_distributor_id,$cname,$cst,$pan,$phone,$gst,$vat,$inquiry_date,$zip,$excise,$class_id,$item,$discount,$seid="",$local_id="",$type="") 
	 {
		$dup_where = "phone = '".$phone."' AND isDelete=0";
		if($type=="")
		{
			$r = $this->db->rp_dupCheck($this->ctable,$dup_where,0);
		}
		else
		{
			$r=false;
		}
		
		if($r){
			$reply=array("ack"=>0,"developer_msg"=>"Phone number already assigned to another customer!! Try another number.","ack_msg"=>"Phone number already assigned to another customer!! Try another number.");
			return $reply;
		}
		else
		{
			
			 $adate	= date('Y-m-d H:i:s');
			$rows 	= array(
						"company_type",
						"type_of_executive",
						"company_name",
						"cname",
						"super_stockist_id",
						"dealer_distributor_id",
						"email",
						"cst",
						"pan",
						"gst",
						"vat",
						"excise",
						"phone",
						"address",
						"zip",
						"country",
						"state",
						"city",
						"isActive",
						"class_id",
						"discount",
						"adate",
						"seid",
						"modify_date"						
						
					);
			$values = array(
		//				$rtid,
						$company_type,
						$type_of_executive,
						$company_name,
						$cname,
						$super_stockist_id,
						$dealer_distributor_id,
						$email,
						$cst,
						$pan,
						$gst,
						$vat,
						$excise,
						$phone,
						$address,
						$zip,
						$country,
						$state,
						$city,
						"1",
						$class_id,
						$discount,
						$adate,
						$seid,
						$adate
						
					);
					
		 	$uid = $this->db->rp_insert($this->ctable,$values,$rows,0);
			
			$this->addOutletsBranch($uid,$company_name,1);
			if($uid!=0)
			{
				$ack=$this->addArea($uid,$type_of_executive,$class_id,$item);
				$activationCode=$this->generateActivationCode();
				$activationCode_md5=md5($activationCode);
				$executive_r=$this->db->rp_getData($this->ctable,"*","id ='".$uid."'");
				$executive=mysqli_fetch_assoc($executive_r);
					$sms="Hello ".$executive['cname']."\nWelcome to ".SITETITLE.", Your login credentials for account given below:\nMobile:".$executive['phone']."\npassword:".$activationCode."\nTeam ".SITETITLE;
				$a=$this->aj_sendSMS($executive['phone'],$sms);
				$rows 	= array(
							"password"	=> $activationCode_md5,
							);
				$this->db->rp_update($this->ctable,$rows,"id='".$uid."'",0);
				$reply=array("ack"=>1,"developer_msg"=>"insert Successfully","ack_msg"=>"Success! Insert Customer Successfully.","inserted_id"=>$uid);
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Insert Record Failed.");
				return $reply;
			}
		}
	 }
//-------------------------------------------------------------------------------//
//---------#Update Executive Detail-----------------------------------------------//	 
	public function UpdateExecutive($executive_id,$end_user_type,$type_of_executive,$company_type,$company_name,$address,$super_stockist_id,$city,$state,$country,$email,$dealer_distributor_id,$cname,$cst,$pan,$phone,$gst,$vat,$inquiry_date,$zip,$excise,$class_id,$item,$discount)
	  {
		$dup_where = "phone = '".$phone."' AND isDelete=0 AND isActive=1 AND id!='".$_REQUEST['id']."'";
		$r = $this->db->rp_dupCheck($this->ctable,$dup_where,0);
		//echo $r;exit;
		if($r > 0){
			$reply=array("ack"=>0,"developer_msg"=>"Phone number already assigned to another customer!! Try another number.","ack_msg"=>"Phone number already assigned to another customer!! Try another number.");
			return $reply;
		}
		else{
				$rows 	= array(
							"company_type"	=> $company_type,
							"company_name"	=> $company_name,
							"cname"			=> $cname,
							"super_stockist_id"=> $super_stockist_id,
							"dealer_distributor_id"=> $dealer_distributor_id,
							"email"			=> $email,							
							"cst"			=> $cst,
							"pan"			=> $pan,
							"gst"			=> $gst,
							"vat"			=> $vat,
							"excise"		=> $excise,
							"phone"			=> $phone,
							"address"		=> $address,
							"zip"			=> $zip,
							"country"		=> $country,
							"state"			=> $state,
							"city"			=> $city,
							"type_of_executive"		=> $type_of_executive,
							"class_id"		=> $class_id,
							"discount"		=> $discount,
							//"password"		=> $password,
							"modify_date"	=>date("Y-m-d H:i:s")
						);
				$where	= "id='".$executive_id."'";
				$isUpdated=$this->db->rp_update($this->ctable,$rows,$where,0);
				if($isUpdated)
				{
					//echo $uid;exit;
					$ack=$this->addArea($executive_id,$type_of_executive,$class_id,$item);
					$reply=array("ack"=>1,"developer_msg"=>"Customer Update Successfull!!.","ack_msg"=>"Success! Update Customer Successfully.");
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Update Failed.");
					return $reply;
				}
			}
exit;			
		}	
//-----------------------------------------------------------------------------//
//------#Edit Executive Detail#------------------------------------------------//		
	public function EditExecutive($detail)
	{		
		$where = " id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where);
		$ctable_d = mysqli_fetch_array($ctable_r);
		$result=array();
		$result['cname']		= htmlentities($ctable_d['cname']);
		$result['company_type']	= htmlentities($ctable_d['company_type']);
		$result['super_stockist_id']	= htmlentities($ctable_d['super_stockist_id']);
		$result['dealer_distributor_id']	= htmlentities($ctable_d['dealer_distributor_id']);
		$result['company_name']	= htmlentities($ctable_d['company_name']);
		$result['cpname']		= htmlentities($ctable_d['cpname']);
		$result['email']		= stripslashes($ctable_d['email']);
		$result['cst']			= stripslashes($ctable_d['cst']);
		$result['pan']			= stripslashes($ctable_d['pan']);
		$result['gst']			= stripslashes($ctable_d['gst']);
		$result['vat']			= stripslashes($ctable_d['vat']);
		$result['excise']		= stripslashes($ctable_d['excise']);
		$result['phone']		= stripslashes($ctable_d['phone']);
		$result['address']		= htmlentities($ctable_d['address']);
		$result['zip']			= stripslashes($ctable_d['zip']);
		$result['country']		= $ctable_d['country'];
		$result['state'] 		= stripslashes($ctable_d['state']);
		$result['city'] 		= stripslashes($ctable_d['city']);
		$result['class_id'] 		= stripslashes($ctable_d['class_id']);
		$result['area_id'] 		= stripslashes($ctable_d['area_id']);
		$result['discount'] 		= stripslashes($ctable_d['discount']);
		$result['password'] 		= stripslashes($ctable_d['password']);
		$area_id_r=$this->db->rp_getData("executive_map_area","area_id","executive_id='".$detail['id']."' AND isDelete=0","",0);
		while($w=mysqli_fetch_array($area_id_r))
		{
			//$area_id=array();
			$area_id[]=$w['area_id'];
			
		}
		$reply=array("ack"=>1,"developer_msg"=>"User detail fetched!!.","ack_msg"=>"Success! Update Customer Successfully.","result"=>$result,"area_id"=>$area_id);
		return $reply;
	
	}
//--------------------------------------------------------------------------------//
//---------#Add Area Information(executive_map_area)-------------------------------//
	 function addArea($executive_id,$type_of_executive,$class_id,$item)
    {
             $this->db->rp_delete($this->ctableMap,"executive_id=".$executive_id."",0);
             foreach($item as $b)
             {
				 $area_id=$b['area_id'];
                $this->db->rp_insert($this->ctableMap,array($executive_id,$type_of_executive,$class_id,$area_id),array("executive_id","executive_type","class_id","area_id"),0);
             }

             return true;
        
       
    }
//--------------------------------------------------------------------------------------//
//-----------#Delete Executive Information------------------------------------------------//	
	public function ExecutiveDelete($detail)
	{
		$rows 	= array(
		"isDelete"	=> "1"
		);
			$where	= "id='".$_REQUEST['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>"deleted data.","ack_msg"=>"Success! Delete Customer Successfully.");
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Delete record Failed.");
				return $reply;
			}
	}
//-------------------------------------------------------------------------------//
//------------#Add Outlets Branch Info(outlets_branch)-------------------------------------------//	
	function addOutletsBranch($cid="",$branch_name="",$debug=0)
	{
			if($branch_name!="" && $cid!="")
		{
			$adate	= date('Y-m-d H:i:s');
			$rows=array("cid","branch_name","adate","isDelete");
			$values=array($cid,$branch_name,$adate,0);
			$cbid=$this->db->rp_insert("outlets_branch",$values,$rows,$debug);
			if($cbid!=0)
			{
				return $response=array('ack'=>1,'ack_msg'=>'Branch added Successfully !!!');
				
			}
			else
			{
				return $response=array('ack'=>0,'ack_msg'=>'Branch name can not be empty !!!');			
			}
		}
		else
		{
			return $response=array('ack'=>0,'ack_msg'=>'Branch name can not be empty !!!');	
		}
			
	}
//------------------------------------------------------------------------------//
//--------------Generate Activation Code---------------------------------------//	
	function generateActivationCode()
	{
		$characters='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$randStr="";
		for($i=0;$i<=5;$i++)
		{
			$randStr=$randStr.$characters[rand(0,strlen($characters)-1)];
		}
		return $randStr;
	}
//-----------------------------------------------------------------------------//
//-----------#Send SMS To mobile on Executive's registered Number-----------------//
	function aj_sendSMS($number,$sms)
	{
		require_once('notification.class.php');
	    $nt = new Notification();
		$msgId="NO";
		if($number!="")
		{
		   	$msgId=$nt->aj_sendSMSSecurity($number,$sms);
			if($msgId!=0)
			{
				
				return $deliveryStatus=array("ack"=>1,"ack_msg"=>"SMS sent to ".$number." successfully");	
			}
			//$deliveryStatus=$nt->aj_getDeliveryReport($msgId);
			else
			$deliveryStatus=array("ack"=>0,"ack_msg"=>"SMS sending failed on".$number,"reason"=>"Invalid mobile number or mobile switched off or out of coverage area!!");	
			return $deliveryStatus;			
		}		
		return array('ack'=>0,'ack_msg'=>"Internal Error!","developer_msg"=>"Empty Mobile Number");
	}
//------------------------------------------------------------------------------------//	
	function getRequiredColumns($required_columns=array())
	{
		if(!empty($required_columns))
		{
			$required_columns_string=implode(",",$required_columns);
			return $required_columns_string;
		}
		else
		{
			return "*";
		}
	}
//24-04-2017-sejal------------------#this function is used for service get outlets list(API)----------//	
	function getOutletList($required_columns,$sales_executive_id)
	{
		//find area list for salse executive
		$result=array();
		$outlet_id=array();
		$sales_area_id=array();
		$sales_area_r=$this->db->rp_getData("sales_executive_map_area","*","sales_executive_id=".$sales_executive_id."","",0);
		if($sales_area_r)
		{
			while($sales_area_d=mysqli_fetch_assoc($sales_area_r))
			{
				
				$sales_area_id[]=$sales_area_d['area_id'];
			}
			
			if(!empty($sales_area_id))
			{
				$area_ids=implode(",",$sales_area_id);
				//find area list for outlet and get outlet ids---------------------//
				$outlet_area_r=$this->db->rp_getData("executive_map_area","*","area_id IN (".$area_ids.")  AND  executive_type='outlets'","",0);
				while($outlet_area_d=mysqli_fetch_assoc($outlet_area_r))
				{
					$outlet_id[]=$outlet_area_d['executive_id'];
				}
			}
			$required_columns=$this->getRequiredColumns($required_columns);
			$limit=$this->getLimit();		
			$result=array();
			if(!empty($outlet_id))
			{
				$ids=implode(",",$outlet_id);
				$where="type_of_executive='outlets' AND id IN (".$ids.") AND isActive=1 AND isDelete=0";
				$data    = $this->db->rp_getData('executive',$required_columns,$where,"id DESC",0,$limit);
			
				while($row=mysqli_fetch_assoc($data))
				{
					$row['dealer_distributor_id']=$this->db->rp_getValue("executive","cname","id=".$row['dealer_distributor_id']."",0);
					$row['super_stockist_id']=$this->db->rp_getValue("executive","cname","id=".$row['super_stockist_id']."");
					$row['city']=$this->db->rp_getValue("city","name","id='".$row['city']."'");
					$row['state']=$this->db->rp_getValue("state","name","id='".$row['state']."'");
					$row['country']=$this->db->rp_getValue("country","name","id='".$row['country']."'");
					$result[]=$row;
				}			
				
			}
		}
		
		return $result;
		
	}
//--------------------------------------------------------------------------//	
	
	function getLimit($limit=array())
	{
		//$limit=$this->db->getLimit();	
		if(!empty($limit) && array_key_exists("ul",$limit))
		{
			$ul=$limit['ul'];
			if(array_key_exists("ll",$limit) && $limit['ll']!="")
			{
				$ll=$limit['ll'];
			}
			else
			{
				$ll="18446744073709551615";
			}			
			$limit_string="".$ul.",".$ll;
			return $limit_string;
		}
		else
		{
			return "";
		}
	}
//--------------------Get Customer List(API)--------------------------------------------//
 function getCustomer($sales_executive_id="")
    {
		
		$result = array();
		$customer_id=array();
		$sales_area_id=array();
		$sales_area_r=$this->db->rp_getData("sales_executive_map_area","*","sales_executive_id=".$sales_executive_id."","",0);
		if($sales_area_r)
		{
			while($sales_area_d=mysqli_fetch_assoc($sales_area_r))
			{
				
				$sales_area_id[]=$sales_area_d['area_id'];
			}
			//print_r($sales_area_id);exit;
				if(!empty($sales_area_id))
				{
					$area_ids=implode(",",$sales_area_id);
					//find area list for outlet and get outlet ids---------------------//
					$outlet_area_r=$this->db->rp_getData("executive_map_area","*","area_id IN (".$area_ids.")","",0);
					while($outlet_area_d=mysqli_fetch_assoc($outlet_area_r))
					{
						$customer_id[]=$outlet_area_d['executive_id'];
					}
				}
		//print_r($customer_id);exit;
			if(!empty($customer_id))
			{
				$ids=implode(",",$customer_id);
				//
				$data    = $this->db->rp_getData('executive',"*","id IN (".$ids.") AND isDelete=0 AND isActive=1 ","adate DESC",0);
				if($data)
				{
				while($r= mysqli_fetch_assoc($data))
				{
					$r['cname'] 	= $r['cname'];
					$r['phone'] 	= $r['phone'];
					$r['adate']=date('d-m-Y',strtotime($r['adate']));
					$r['created_date']=date('d-m-Y',strtotime($r['created_date']));
					//$r['order_date']=array_key_exists('order_date',$r)?date('d-m-Y',strtotime($r['order_date'])):0;
					$r['country'] 		= $this->db->rp_getValue("country","name","id='".$r['country']."'",0);
					$r['state'] 		= $this->db->rp_getValue("state","name","id='".$r['state']."'",0);
					$r['city'] 		= $this->db->rp_getValue("city","name","id='".$r['city']."'",0);
					
					$first_area=$this->db->rp_getData("executive_map_area","area_id","executive_id='".$r['id']."'","id ASC LIMIT 1");
					if($first_area)
					{
						$first_area=mysqli_fetch_assoc($first_area);
						$first_area=$first_area['area_id'];
					}
					$r['area_id'] 		= $first_area;
					$result[] = $r;	
				}
					if(!empty($result))
					{
						$ack=array( "ack"=>1,"ack_msg"=>"Successfully Get Customer !!","developer_msg"=>"You got it!!","result"=>$result,);
						return $ack;
					}
					else
					{
						$ack=array( "ack"=>0,"ack_msg"=>"No Customer Found !!","developer_msg"=>"No Customer found!!","result"=>$result,);
						return $ack;
					}
				}
				else
				{
					$ack=array( "ack"=>0,"ack_msg"=>"No Customer Found !!","developer_msg"=>"No Customer found!!","result"=>$result,);
					return $ack;
				}
			}
			else
			{
				$ack=array( "ack"=>0,"ack_msg"=>"No Customer Found !!","developer_msg"=>"No Customer found!!","result"=>$result,);
				return $ack;
			}
		}
	}
 //--------------------------------------------------------------//
}

?>