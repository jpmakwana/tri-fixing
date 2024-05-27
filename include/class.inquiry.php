<?php
require_once("function.class.php");
require_once("class.log.php");
class Inquiry extends Functions
{
	public $db, $log;
	public $ctable="inquiry";
	public $ectable="inquiry_product";
	public $estable="inquiry_followup";
	function __construct($id="") 
	{
		$db = new Functions();
		$conn = $db->connect();
		$this->db=$db;	
		$this->log=new Log();		
    } 
	public function InsertInquiryInfo($detail) 
	{     
		extract($detail);
		$ctable_where .= "(cname like '%".$customer_name."%')";
			$cid = $this->db->rp_getData("customer","*",$ctable_where,"",0);
			$row =mysqli_fetch_assoc($cid);
			if(empty($row))
			{
			 $adate	= date('Y-m-d H:i:s');
			 $rows 	= array(
						"cname",
						"isActive",
						"isDelete",
						"adate"
					);
			$values = array(
						$customer_name,
						$isActive,
						1,
						$adate
					);
				$c_id=$this->db->rp_insert("customer",$values,$rows,0);
				$this->log->insertLog("customer",$c_id,"insert","New Customer Added By Inquiry User");
				$row['id']=$c_id; 
					
			}
			 $adate	= date('Y-m-d H:i:s');
			 $rows 	= array(
						"inquiry_no",
						"customer_name",
						"cpname",
						"city",
						"state",
						"country",
						"address",
						"reference",
						"level",
						"phone",
						"email",
						"isActive",
						"adate"
					);
			$values = array(
						$inquiry_no,
						$row['id'],
						$cpname,
						$city,
						$state,
						$country,
						$address,
						$reference,
						$level,
						$phone,
						$email,
						$isActive,
						$adate
					);
					
		 	$customer_id = $this->db->rp_insert($this->ctable,$values,$rows,0);
			$this->log->insertLog($this->ctable,$customer_id,"insert","Inquiry Added By User");
			if($customer_id!=0)
			{
				$reply=array("ack"=>1,"result"=>$customer_id,"developer_msg"=>"insert Successfully","ack_msg"=>"Success! Inquiry Insert Successfully.");
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Inquiry Insert Failed.");
				return $reply;
			}
		
	 }
	public function UpdateInquiryInfo($detail)
	{
			extract($detail);
			$dup_where = "customer_name = '".$customer_name."' AND id!='".$_REQUEST['id']."' AND isDelete=0";
			$r = $this->db->rp_dupCheck($this->ctable,$dup_where);
			$ctable_where .= "(cname like '%".$customer_name."%')";
			$customer_id = $this->db->rp_getData("customer","*",$ctable_where,"",0);
			$row =mysqli_fetch_assoc($customer_id);
            $r = $this->db->rp_dupCheck($this->ctable,$dup_where);
			if($r){
				$db->rp_location("add_".$ctable.".php?mode=edit&id=".$_REQUEST['id']."&msg=duplicate");
				die;
			}else{
				$rows 	= array(
						   	"customer_name"	=> $row['id'],
							"cpname"		=> $cpname,
							"city"			=> $city,
							"state"			=> $state,							
							"country"		=> $country,
							"address"		=> $address,
							"reference"		=> $reference,
							"level"			=> $level,
							"phone"			=> $phone,
							"email"			=> $email,
						);
				$where	= "id='".$_REQUEST['id']."'";
				$eid=$this->db->rp_update($this->ctable,$rows,$where,0);
				$this->log->insertLog($this->ctable,$_REQUEST['id'],"update","Inquiry Updated By User");
				if($eid!=0)
				{
					$reply=array("ack"=>1,"result"=>$_REQUEST['id'],"developer_msg"=>"Inquiry Update Successfull!!.","ack_msg"=>"Success! Inquiry Update Successfully.");
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Inquiry Update Failed.");
					return $reply;
				}
			}	
		}	
	public function getInquiryInfo($detail)
	{		
		$where = " id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where);
		$ctable_d = mysqli_fetch_array($ctable_r);
		$customer_id=$this->db->rp_getValue("customer","cname","id='".$ctable_d['customer_name']."'",0);
		$party_code=$this->db->rp_getValue("customer","party_code","id='".$ctable_d['customer_name']."'",0);
		$result=array();
		$result['customer_name']= htmlentities($customer_id);
		$result['cpname']			= htmlentities($ctable_d['cpname']);
		$result['city']			= htmlentities($ctable_d['city']);
		$result['state']		= htmlentities($ctable_d['state']);
		$result['country']		= stripslashes($ctable_d['country']);
		$result['address']		= stripslashes($ctable_d['address']);
		$result['reference']	= stripslashes($ctable_d['reference']);
		$result['level']		= stripslashes($ctable_d['level']);
		$result['phone']		= stripslashes($ctable_d['phone']);
		$result['email']		= stripslashes($ctable_d['email']);
		$result['party_code']		= $party_code;
		
		$reply=array("ack"=>1,"developer_msg"=>"Inquiry detail fetched!!.","ack_msg"=>"Success! Inquiry Update Successfully.","result"=>$result);
		return $reply;
	
	}	
	public function DeleteInquiryInfo($detail)
	{
		$rows 	= array(
		"isDelete"	=> "1"
		);
			$where	= "id='".$_REQUEST['id']."'";
			
			$eid=$this->db->rp_update($this->ctable,$rows,$where);
			$this->log->insertLog($this->ctable,$_REQUEST['id'],"delete","Inquiry deleted By User");
			if($eid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>"deleted data.","ack_msg"=>"Success! Inquiry Delete Successfully.");
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Inquiry Delete Failed.");
				return $reply;
			}
	}
	
}

?>