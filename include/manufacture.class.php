<?php
require_once("main.class.php");
require_once("function.class.php");
class Manufacture extends Functions
{
	public $db;
	public $log;
	public $ctable="manufacture";
	
	function __construct($id="") 
	{
		$db = new Functions();
		$conn = $db->connect();
		$this->db=$db;
		$log	= new Log();		
		$this->log=$log;		
    } 
	 public function InsertManufacture($detail) 
	 {
		extract($detail);
		//$dup_where = "manufacture_name = '".$manufacture_name."' AND isDelete=0";
		$dup_where =" (
							manufacture_name = '".$manufacture_name."' 
						)  AND isDelete=0";
		$r = $this->db->rp_dupCheck($this->ctable,$dup_where);
		
		$dup_where_phone =" (
							manufacture_contact_no = '".$manufacture_contact_no."' 
						)  AND isDelete=0";
		$phone_r = $this->db->rp_dupCheck($this->ctable,$dup_where_phone);
		if($r){
			$reply=array("ack"=>0,"developer_msg"=>"Duplicate Manufacture","ack_msg"=>"Already Exist Manufacture Name!!");
			return $reply;
		}
		else if($phone_r){
			$reply=array("ack"=>0,"developer_msg"=>"Duplicate Manufacture","ack_msg"=>"Already Exist Phone Number!!");
			return $reply;
		}
		else
		{
			 $adate	= date('Y-m-d H:i:s');
			$rows 	= array(
						"manufacture_name",
						"manufacture_email",
						"manufacture_contact_no",
						"manufacture_address",
						"manufacture_pincode",
						"manufacture_country",
						"isActive",
						"created_date"
					);
			$values = array(
						$manufacture_name,
						$manufacture_email,
						$manufacture_contact_no,
						$manufacture_address,
						$manufacture_pincode,
						$manufacture_country,
						$isActive,
						$adate
					);
					
		 	$uid = $this->db->rp_insert($this->ctable,$values,$rows,0);
			$this->log->insertLog($this->ctable,$uid,"insert",$this->log->slm['MANUFACTURE_INSERT']." : ".$manufacture_name);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('MANUFACTURE_INSERT',1),"ack_msg"=>$this->log->getMessage('MANUFACTURE_INSERT'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Insert Record Failed.");
				return $reply;
			}
		}
	 }
	public function UpdateManufacture($detail)
	  {
			extract($detail);
			$dup_where = "manufacture_name = '".$manufacture_name."' AND id!='".$_REQUEST['id']."' AND isDelete=0";
			$r = $this->db->rp_dupCheck($this->ctable,$dup_where);
			
			// Check Duplication of vendor phone no.
			$dup_where_phone = "manufacture_contact_no = '".$manufacture_contact_no."' AND id!='".$_REQUEST['id']."' AND isDelete=0";
			$phone_r = $this->db->rp_dupCheck($this->ctable,$dup_where_phone);
			
			if($r){
				/*$this->db->rp_location($ctable."_crud.php?mode=edit&id=".$_REQUEST['id']."&msg=duplicate");
				die;*/
				$reply=array("ack"=>0,"developer_msg"=>"Duplicate Manufacture","ack_msg"=>"Already Exist this Manufacture Name!!","id"=>$id);
				return $reply;
			}
			else if($phone_r){
				$reply=array("ack"=>0,"developer_msg"=>"Duplicate Manufacture Phone number.","ack_msg"=>"Already Exist this Phone Number!!","id"=>$id);
				return $reply;
			}
			else{
				
				$rows 	= array(
							"manufacture_name"			=> $manufacture_name,
							"manufacture_email"			=> $manufacture_email,
							"manufacture_contact_no"	=> $manufacture_contact_no,
							"manufacture_address"		=> $manufacture_address,
							"manufacture_pincode"		=> $manufacture_pincode,
							"manufacture_country"		=> $manufacture_country,
							
						);
				$where	= "id='".$_REQUEST['id']."'";
				$uid=$this->db->rp_update($this->ctable,$rows,$where,0);
				$this->log->insertLog($this->ctable,$_REQUEST['id'],"update",$this->log->slm['MANUFACTURE_UPDATE']." : ".$manufacture_name);
				if($uid!=0)
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('MANUFACTURE_UPDATE',1),"ack_msg"=>$this->log->getMessage('MANUFACTURE_UPDATE'));
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Update Failed.");
					return $reply;
				}
			}	
		}	
	public function EditManufacture($detail)
	{		
		$where = " id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where);
		$ctable_d = mysqli_fetch_array($ctable_r);
		$result=array();
		
		$result['manufacture_name']			= htmlentities($ctable_d['manufacture_name']);
		$result['manufacture_email']			= stripslashes($ctable_d['manufacture_email']);
		$result['manufacture_contact_no']	= stripslashes($ctable_d['manufacture_contact_no']);
		$result['manufacture_address']		= htmlentities($ctable_d['manufacture_address']);
		$result['manufacture_pincode']		= stripslashes($ctable_d['manufacture_pincode']);
		$result['manufacture_country'] 			= stripslashes($ctable_d['manufacture_country']);
		
		
		$reply=array("ack"=>1,"developer_msg"=>"Manufacture detail fetched!!.","ack_msg"=>"Success! Update Manufacture Successfully.","result"=>$result);
		return $reply;
	
	}
	
	public function DeleteManufacture($detail)
	{
		$manufacture_name=$this->db->rp_getValue($this->ctable,"manufacture_name","isDelete=0 AND id='".$detail['id']."'");
		$rows 	= array(
		"isDelete"	=> "1"
		);
			$where	= "id='".$_REQUEST['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['MANUFACTURE_DELETE']." : ".$manufacture_name);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('MANUFACTURE_DELETE',1),"ack_msg"=>$this->log->getMessage('MANUFACTURE_DELETE'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Delete record Failed.");
				return $reply;
			}
	}
	
}

?>