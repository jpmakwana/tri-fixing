<?php
require_once("main.class.php");
require_once("function.class.php");
class Customer extends Functions
{
	public $db;
	public $log;
	public $ctable="customer";
	function __construct($id="") 
	{
		$db = new Functions();
		$conn =$db->connect();
		$this->db=$db;	
		$log	= new Log();		
		$this->log=$log;		
    } 
	

	

	public function InsertCustomer($detail) 
	{
         	extract($detail);
	/*	$dup_where = "phone_number = '".$phone_number."' AND isDelete=0";
		$r = $this->db->rp_dupCheck($this->ctable,$dup_where);
		if($r){
			$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DUPLICATE_RECORED_FOUND',1),"ack_msg"=>$this->log->getMessage('DUPLICATE_RECORED_FOUND'));
			return $reply;
		}
		else
		{  */ 
			
			$today	= date('Y-m-d H:i:s');
			$rows 	= array(
						"name",
						"mobile_number",
						"location",
						"isDelete",	
						"isActive",	
						"created_date",	
					);
			$values = array(
						$name,
						$mobile_number,
						$location,
						0,			  
						1,
						date("Y-m-d H:i:s")	
						);
		 	$product_id = $this->db->rp_insert($this->ctable,$values,$rows,0);
		
			$this->log->insertLog($this->ctable,$product_id,"insert",$this->log->slm['CUSTOMER_INSERT_SUCESS']." : ".$fg_item_name);
			
			if($product_id!=0)
			{
				
				
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('CUSTOMER_INSERT_SUCESS',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_INSERT_SUCESS'),"id"=>$product_id);
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('CUSTOMER_INSERT_FAILED',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_INSERT_FAILED'),"id"=>$product_id);
				return $reply;
			}
		//}
		
	}	

	public function UpdateCustomer($detail)
	{
			extract($detail);
			

				
			
				$modify_date=date("Y-m-d H:i:s");
				$rows 	= array(
						"name"=> $name,
						"mobile_number"=> $mobile_number,
						"location"=> $location,
						"isDelete"=>0,
						"isActive"=>1,
						"created_date"=>$modify_date,
						
				);
				$where	= "id='".$_REQUEST['id']."'";
				$uid=$this->db->rp_update($this->ctable,$rows,$where,0);
				
				$this->log->insertLog($this->ctable,$_REQUEST['id'],"update",$this->log->slm['CUSTOMER_UPDATE_SUCESS']." : ".$fg_item_name);
				
				if($uid)
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('CUSTOMER_UPDATE_SUCESS',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_UPDATE_SUCESS'),"id"=>$_REQUEST['id']);
					return $reply;
					
				}
				else
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('CUSTOMER_UPDATE_FAILED',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_UPDATE_FAILED'));
					return $reply;
				}
				
		}	
	public function EditCustomer($detail)
	{		
		$where = " id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where,"",0);
		if($ctable_r)
		{
			$ctable_d = mysqli_fetch_array($ctable_r);
			$result=array();
			
			$result=$ctable_d;
			$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('CUSTOMER_GET_SUCESS',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_GET_SUCESS'),"result"=>$result);
			return $reply;
		}
		else
		{
			$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('CUSTOMER_GET_FAILED',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_GET_FAILED'));
			return $reply;
		}
	
	}	
	public function DeleteCustomer($detail)
	{
		$rows 	= array(
		"isDelete"	=> "1"
		);
			$where	= "id='".$detail['id']."'";
			$isUpdated=$this->db->rp_update($this->ctable,$rows,$where);
			
			$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['ITEM_FG_DELETE']." : ");
			
			if($isUpdated)
			{
				$where	= "id='".$detail['id']."'";
				$this->rp_update($this->ctableProductStore,array("isDelete"=>1),"id='".$_REQUEST['id']."'");
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('CUSTOMER_DELETE_SUCESS',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_DELETE_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('CUSTOMER_DELETE_FAILED',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_DELETE_FAILED'));
				return $reply;
			}
	}
	public function ActiveCustomer($detail)
	{
		$rows 	= array(
			"isActive"	=> $detail['isActive']
		);
			$where	= "id='".$detail['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('CUSTOMER_STATUS_SUCESS',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_STATUS_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('CUSTOMER_STATUS_FAILED',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_STATUS_FAILED'));
				return $reply;
			}
	}
	
}

?>