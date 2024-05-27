<?php
require_once("main.class.php");
require_once("function.class.php");
class Coupon extends Functions
{
	public $db;
	public $log;
	public $ctable="coupon_master";
	function __construct($id="") 
	{
		$db = new Functions();
		$conn =$db->connect();
		$this->db=$db;	
		$log	= new Log();		
		$this->log=$log;		
    } 
	public function InsertCoupon($detail) 
	{
		extract($detail);
		$dup_where = "coupon_code = '".$coupon_code."' AND isDelete=0";
		$r = $this->db->rp_dupCheck($this->ctable,$dup_where);
		if($r){
			$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DUPLICATE_RECORED_FOUND',1),"ack_msg"=>$this->log->getMessage('DUPLICATE_RECORED_FOUND'));
			return $reply;
		}
		else
		{
			$adate	= date('Y-m-d H:i:s');
			$rows 	= array(
			            "vid",
						"coupon_code",
						"validate_from",
						"validate_to",
						"adate"
						
					);
			$values = array(
			            $vid,
						$coupon_code,		
						$validate_from,
						$validate_to,
						$adate,
					);
					
		 	$uid = $this->db->rp_insert($this->ctable,$values,$rows,0);
		 	
			$this->log->insertLog($this->ctable,$uid,"insert",$this->log->slm['PACKING_TYPE_INSERT_SUCESS']." : ".$title);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('PACKING_TYPE_INSERT_SUCESS',1),"ack_msg"=>$this->log->getMessage('PACKING_TYPE_INSERT_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('PACKING_TYPE_INSERT_FAILED',1),"ack_msg"=>$this->log->getMessage('PACKING_TYPE_INSERT_FAILED'));
				return $reply;
			}
		}
	}
	 
	 public function UpdateCoupon($detail)
	  {
			extract($detail);
			$dup_where = "coupon_code = '".$coupon_code."' AND id!='".$_REQUEST['id']."' AND isDelete=0";
			$r = $this->db->rp_dupCheck($this->ctable,$dup_where);
			if($r){
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DUPLICATE_RECORED_FOUND',1),"ack_msg"=>$this->log->getMessage('DUPLICATE_RECORED_FOUND'));
				return $reply;
				
			}else{
				$rows 	= array(
						"vid"				=> $vid,
						"coupon_code"				=> $coupon_code,
						"validate_from"				=> $validate_from,
						"validate_to"				=> $validate_to,
						"adate"				=> $adate,
						);
				$where	= "id='".$_REQUEST['id']."'";
				$uid=$this->db->rp_update($this->ctable,$rows,$where,0);
				$this->log->insertLog($this->ctable,$_REQUEST['id'],"update",$this->log->slm['PACKING_TYPE_UPDATE_SUCESS']." : ".$title);
				if($uid!=0)
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('PACKING_TYPE_UPDATE_SUCESS',1),"ack_msg"=>$this->log->getMessage('PACKING_TYPE_UPDATE_SUCESS'));
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('PACKING_TYPE_UPDATE_FAILED',1),"ack_msg"=>$this->log->getMessage('PACKING_TYPE_UPDATE_FAILED'));
					return $reply;
				}
			}	
		}	
	public function EditCoupon($detail)
	{		
		$where = " id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where,0);
		$ctable_d = mysqli_fetch_array($ctable_r);
		$result=array();
		
		$result['title']		= htmlentities($ctable_d['title']);		
		
		$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('PACKING_TYPE_GET_SUCESS',1),"ack_msg"=>$this->log->getMessage('PACKING_TYPE_GET_SUCESS'),"result"=>$result);
		return $reply;
		
	
	}
	
	public function DeleteCoupon($detail)
	{
		$title=$this->db->rp_getValue($this->ctable,"coupon_code","isDelete=0 AND id='".$detail['id']."'");
		$rows 	= array(
		"isDelete"	=> "1"
		);
			$where	= "id='".$_REQUEST['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['PACKING_TYPE_DELETE_SUCESS']." : ".$title);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('PACKING_TYPE_DELETE_SUCESS',1),"ack_msg"=>$this->log->getMessage('PACKING_TYPE_DELETE_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('UNIT_DELETE_FAILED',1),"ack_msg"=>$this->log->getMessage('PACKING_TYPE_DELETE_FAILED'));
				return $reply;
			}
	}
}

?>