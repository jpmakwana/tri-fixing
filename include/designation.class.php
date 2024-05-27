<?php
require_once("main.class.php");
require_once("function.class.php");
class Designation extends Functions
{
	public $db,$log;
	public $ctable="designation";
	function __construct($id="") 
	{
		$db = new Functions();
		$conn =$db->connect();
		$this->db=$db;	
		$log	= new Log();		
		$this->log=$log;
    } 
	public function InsertDesignation($detail) 
	{
		extract($detail);
		$dup_where = "name = '".$name."' AND isDelete=0";
		$r = $this->db->rp_dupCheck($this->ctable,$dup_where);
		if($r){
		$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DUPLICATE_RECORED_FOUND',1),"ack_msg"=>$this->log->getMessage('DUPLICATE_RECORED_FOUND'));
			return $reply;
		}
		else
		{
			$adate	= date('Y-m-d H:i:s');
			$rows 	= array(
						"name",
						"isDelete",
						"created_date"
					);
			$values = array(
						$name,	
						$isDelete,
						$adate
					);
					
		 	$uid = $this->db->rp_insert($this->ctable,$values,$rows,0);
			$this->log->insertLog($this->ctable,$uid,"insert",$this->log->slm['DESIGNATION_INSERT']." : ".$name);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('DESIGNATION_INSERT_SUCESS',1),"ack_msg"=>$this->log->getMessage('DESIGNATION_INSERT_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DESIGNATION_INSERT_FAILED',1),"ack_msg"=>$this->log->getMessage('DESIGNATION_INSERT_FAILED'));
				return $reply;
			}
		}
	}
	 
	 public function UpdateDesignation($detail)
	  {
			extract($detail);
			$dup_where = "name = '".$name."' AND id!='".$_REQUEST['id']."' AND isDelete=0";
			$r = $this->db->rp_dupCheck($this->ctable,$dup_where);
			if($r){
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DUPLICATE_RECORED_FOUND',1),"ack_msg"=>$this->log->getMessage('DUPLICATE_RECORED_FOUND'));
				return $reply;
				
			}else{
				$rows 	= array(
						"name"				=> $name,
						);
				$where	= "id='".$_REQUEST['id']."'";
				$uid=$this->db->rp_update($this->ctable,$rows,$where,0);
				$this->log->insertLog($this->ctable,$_REQUEST['id'],"Update",$this->log->slm['DESIGNATION_UPDATE']." : ".$name);
				if($uid!=0)
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('DESIGNATION_UPDATE_SUCESS',1),"ack_msg"=>$this->log->getMessage('DESIGNATION_UPDATE_SUCESS'));
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DESIGNATION_UPDATE_FAILED',1),"ack_msg"=>$this->log->getMessage('DESIGNATION_UPDATE_FAILED'));
					return $reply;
				}
			}	
		}	
	public function GetEditDataDesignation($detail)
	{		
		$where = " id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where,0);
		$ctable_d = mysqli_fetch_array($ctable_r);
		$result=array();
		
		$result['name']		= htmlentities($ctable_d['name']);

		
		$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('DESIGNATION_GET_SUCESS',1),"ack_msg"=>$this->log->getMessage('DESIGNATION_GET_SUCESS'),"result"=>$result);
		return $reply;
	
	}
	
	public function DeleteDesignation($detail)
	{
		$name=$this->db->rp_getValue($this->ctable,"name","isDelete=0 AND id='".$detail['id']."'");
		$rows 	= array(
		"isDelete"	=> "1"
		);
			$where	= "id='".$_REQUEST['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			$this->log->insertLog($this->ctable,$_REQUEST['id'],"Update",$this->log->slm['DESIGNATION_DELETE']." : ".$name);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('DESIGNATION_DELETE_SUCESS',1),"ack_msg"=>$this->log->getMessage('DESIGNATION_DELETE_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DESIGNATION_DELETE_FAILED',1),"ack_msg"=>$this->log->getMessage('DESIGNATION_DELETE_FAILED'));
				return $reply;
			}
	}
}

?>