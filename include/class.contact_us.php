<?php
require_once("main.class.php");
require_once("function.class.php");
class Contact extends Functions
{
	public $db;
	public $log;
	public $ctable="inquiry";
	function __construct($id="") 
	{
		$db = new Functions();
		$conn =$db->connect();
		$this->db=$db;	
		$log	= new Log();		
		$this->log=$log;		
    } 
	public function InsertContact($detail) 
	{
		extract($detail);
		
		
			$adate	= date('Y-m-d H:i:s');
			$rows 	= array(
						"name",
						"email",
						"message",
						"subject",
						"created_date"
					);
			$values = array(
						$name,		
						$email,		
						$message,		
						$subject,		
						$adate
					);
					
		 	$cat_id = $this->db->rp_insert($this->ctable,$values,$rows,0);
			$this->log->insertLog($this->ctable,$cat_id,"insert",$this->log->slm['CONTACT_INSERT_SUCESS']." : ".$name);
			if($cat_id!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('CONTACT_INSERT_SUCESS',1),"ack_msg"=>$this->log->getMessage('CONTACT_INSERT_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('CONTACT_INSERT_FAILED',1),"ack_msg"=>$this->log->getMessage('CONTACT_INSERT_FAILED'));
				return $reply;
				
			}
		
	}	 
	public function UpdateCategory($detail)
	{
			extract($detail);
			$dup_where = "category_name = '".$category_name."' AND id!='".$_REQUEST['id']."' AND isDelete=0";
			$r = $this->db->rp_dupCheck($this->ctable,$dup_where);
			if($r){
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DUPLICATE_RECORED_FOUND',1),"ack_msg"=>$this->log->getMessage('DUPLICATE_RECORED_FOUND'));
				return $reply;
				
			}else{
				$created_date=date('Y-m-d H:i:s');
				$category_slug=$this->db->rp_createSlug($category_name);
				$rows 	= array(
						"category_name"				=> $category_name,
						"category_slug"				=> $category_slug,
						"category_descr"				=> $category_descr,
						"created_date"				=> $created_date,
						);
				$where	= "id='".$_REQUEST['id']."'";
				$isUpdated=$this->db->rp_update($this->ctable,$rows,$where);
				$this->log->insertLog($this->ctable,$_REQUEST['id'],"update",$this->log->slm['CATEGORY_UPDATE_SUCESS']." : ".$category_name);
				if($isUpdated)
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('CATEGORY_UPDATE_SUCESS',1),"ack_msg"=>$this->log->getMessage('CATEGORY_UPDATE_SUCESS'));
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('CATEGORY_UPDATE_FAILED',1),"ack_msg"=>$this->log->getMessage('CATEGORY_UPDATE_FAILED'));
					return $reply;
				}
			}	
		}	
	public function EditCategory($detail)
	{		
		$where = " id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where);
		if($ctable_r)
		{
			$ctable_d = mysqli_fetch_array($ctable_r);
			$result=array();
			
			$result['category_name']		= htmlentities($ctable_d['category_name']);
			$result['category_descr']		= htmlentities($ctable_d['category_descr']);
			
			$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('CATEGORY_GET_SUCESS',1),"ack_msg"=>$this->log->getMessage('CATEGORY_GET_SUCESS'),"result"=>$result);
			return $reply;
			
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('CATEGORY_GET_FAILED',1),"ack_msg"=>$this->log->getMessage('CATEGORY_GET_FAILED'));
			return $reply;
		}
	}	
	public function DeleteCategory($detail)
	{
		$category_name=$this->db->rp_getValue($this->ctable,"category_name","isDelete=0 AND id='".$detail['id']."'");
		$rows 	= array(
		"isDelete"	=> "1"
		);
			$where	= "id='".$detail['id']."'";
			$isUpdated=$this->db->rp_update($this->ctable,$rows,$where);
			
			$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['CATEGORY_DELETE_SUCESS']." : ".$category_name." <br/> All Item From Category ".$category_name." deleted");
			
			
			if($isUpdated )
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('CATEGORY_DELETE_SUCESS',1),"ack_msg"=>$this->log->getMessage('CATEGORY_DELETE_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('CATEGORY_DELETE_FAILED',1),"ack_msg"=>$this->log->getMessage('CATEGORY_DELETE_FAILED'));
				return $reply;
			}
	}
	public function ActiveCategory($detail)
	{
		$rows 	= array(
			"isActive"	=> $detail['isActive']
		);
			$where	= "id='".$detail['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			$isitemUpdate = $this->db->rp_update("item_fg",$rows,"fg_item_category IN (".$detail['id'].")",0);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('CATEGORY_STATUS_SUCESS',1),"ack_msg"=>$this->log->getMessage('CATEGORY_STATUS_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('CATEGORY_STATUS_FAILED',1),"ack_msg"=>$this->log->getMessage('CATEGORY_STATUS_FAILED'));
				return $reply;
			}
	}
	
	
}

?>