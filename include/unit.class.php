<?php
require_once("main.class.php");
require_once("function.class.php");
class Unit extends Functions
{
	public $db;
	public $log;
	public $ctable="unit";
	function __construct($id="") 
	{
		$db = new Functions();
		$conn =$db->connect();
		$this->db=$db;	
		$log	= new Log();		
		$this->log=$log;		
    } 
	public function InsertUnit($detail) 
	{
		extract($detail);
		$dup_where = "unit_name = '".$unit_name."' AND isDelete=0";
		$r = $this->db->rp_dupCheck($this->ctable,$dup_where);
		if($r){
			$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DUPLICATE_RECORED_FOUND',1),"ack_msg"=>$this->log->getMessage('DUPLICATE_RECORED_FOUND'));
			return $reply;
		}
		else
		{
			$unit_name_slug=$this->db->rp_createSlug($unit_name);
			$adate	= date('Y-m-d H:i:s');
			$rows 	= array(
						"unit_name",
						"unit_name_slug",
						"isDelete"
					);
			$values = array(
						$unit_name,	
						$unit_name_slug,	
						$isDelete
					);
					
		 	$uid = $this->db->rp_insert($this->ctable,$values,$rows,0);
			$this->log->insertLog($this->ctable,$uid,"insert",$this->log->slm['UNIT_INSERT_SUCESS']." : ".$unit_name);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('UNIT_INSERT_SUCESS',1),"ack_msg"=>$this->log->getMessage('UNIT_INSERT_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('UNIT_INSERT_FAILED',1),"ack_msg"=>$this->log->getMessage('UNIT_INSERT_FAILED'));
				return $reply;
			}
		}
	}
	 
	 public function UpdateUnit($detail)
	  {
			extract($detail);
			$dup_where = "unit_name = '".$unit_name."' AND id!='".$_REQUEST['id']."' AND isDelete=0";
			$r = $this->db->rp_dupCheck($this->ctable,$dup_where);
			if($r){
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DUPLICATE_RECORED_FOUND',1),"ack_msg"=>$this->log->getMessage('DUPLICATE_RECORED_FOUND'));
				return $reply;
				
			}else{
				$unit_name_slug=$this->db->rp_createSlug($unit_name);
				$rows 	= array(
						"unit_name"				=> $unit_name,
						"unit_name_slug"				=> $unit_name_slug,
						);
				$where	= "id='".$_REQUEST['id']."'";
				$uid=$this->db->rp_update($this->ctable,$rows,$where,0);
				$this->log->insertLog($this->ctable,$_REQUEST['id'],"update",$this->log->slm['UNIT_UPDATE_SUCESS']." : ".$unit_name);
				if($uid!=0)
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('UNIT_UPDATE_SUCESS',1),"ack_msg"=>$this->log->getMessage('UNIT_UPDATE_SUCESS'));
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('UNIT_UPDATE_FAILED',1),"ack_msg"=>$this->log->getMessage('UNIT_UPDATE_FAILED'));
					return $reply;
				}
			}	
		}	
	public function EditUnit($detail)
	{		
		$where = " id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where,0);
		$ctable_d = mysqli_fetch_array($ctable_r);
		$result=array();
		
		$result['unit_name']		= htmlentities($ctable_d['unit_name']);		
		
		$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('UNIT_GET_SUCESS',1),"ack_msg"=>$this->log->getMessage('UNIT_GET_SUCESS'),"result"=>$result);
		return $reply;
		
	
	}
	
	public function DeleteUnit($detail)
	{
		$unit_name=$this->db->rp_getValue($this->ctable,"unit_name","isDelete=0 AND id='".$detail['id']."'");
		$rows 	= array(
		"isDelete"	=> "1"
		);
			$where	= "id='".$_REQUEST['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['UNIT_DELETE_SUCESS']." : ".$unit_name);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('UNIT_DELETE_SUCESS',1),"ack_msg"=>$this->log->getMessage('UNIT_DELETE_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('UNIT_DELETE_FAILED',1),"ack_msg"=>$this->log->getMessage('UNIT_DELETE_FAILED'));
				return $reply;
			}
	}
}

?>