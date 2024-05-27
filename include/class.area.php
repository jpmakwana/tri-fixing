<?php
require_once("main.class.php");
require_once("function.class.php");
class Area extends Functions
{
	public $db;
	public $log;
	public $ctable="area";
	function __construct($id="") 
	{
		$db = new Functions();
		$conn =$db->connect();
		$this->db=$db;	
		$log	= new Log();		
		$this->log=$log;		
    } 
	public function areaInsert($detail,$item) 
	{
		extract($detail);
		$error=array();
		if(!empty($item))
		{
			foreach($item as $i)
			{
				$isDuplicate=$this->db->rp_getValue($this->ctable,"id","area_name='".$i['name']."' and class_id='".$class_id."'",0);
				if($isDuplicate)
				{
					$error[]=$i['name']." is already exist with same class.";
				}
				else{
					$area_slug=$this->db->rp_createslug($i['name']);
					$rows 	= array(
								"area_name",
								"area_slug",
								"class_id",
								"created_date"
							);
					$values = array(
								$i['name'],
								$area_slug,
								$class_id,
								date('Y-m-d H:i:s')
							);
							
					$uid = $this->db->rp_insert($this->ctable,$values,$rows,0);
				}	
			}
			if($uid!=0)
			{
				if(!empty($error))
				$area_error_msg="Some area already exists within same class <br/>".implode("<br/>",$error);
				else
				$area_error_msg="";	
				$reply=array("ack"=>1,"developer_msg"=>"Area Updated Successfully!!.","ack_msg"=>"Success! Area Inserted Successfully.".$area_error_msg);
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Area Could Not Be Updated .");
				return $reply;
			}

		}	
	
	
	}	 
	public function areaUpdate($detail,$item)
	{
			extract($detail);
			$class_id=$_REQUEST['id'];
			$error=array();
			
			if(!empty($item))
			{
				$where="class_id='".$class_id."'";
				
				$deleted=$this->db->rp_delete($this->ctable,$where,0);
				foreach($item as $i)
				{
					$isDuplicate=$this->db->rp_getValue($this->ctable,"id","area_name='".$i['name']."' and class_id='".$class_id."'",0);
					if($isDuplicate)
					{
						$error[]=$i['name']." is already exist with same class.";
					}
					else{
						$area_slug=$this->db->rp_createslug($i['name']);
						$rows 	= array(
								"area_name",
								"area_slug",
								"class_id",
								"isDelete"
							);
						$values = array(
									$i['name'],
									$area_slug,
									$class_id,
									$isDelete
								);
								
						$uid = $this->db->rp_insert($this->ctable,$values,$rows,0);
					}			
				}
			}
			
			if($uid!=0)
			{
				if(!empty($error))
				$area_error_msg="Some area already exists within same class <br/>".implode("<br/>",$error);
				else
				$area_error_msg="";	
				$reply=array("ack"=>1,"developer_msg"=>"Area Updated Successfully!!.","ack_msg"=>"Success! Area Updated Successfully.".$area_error_msg);
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Area Could Not Be Updated .");
				return $reply;
			}
	}	
			
	public function areaGetEditData($detail)
	{		
		$where = " class_id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where,"id DESC");
		if($ctable_r)
		{
			while(	$ctable_d = mysqli_fetch_array($ctable_r))
			{
				$result_item=array();
				
				$result_item['area_name']		= htmlentities($ctable_d['area_name']);
				$result_item['area_id']		= htmlentities($ctable_d['id']);
				$result_item['class_id']		= htmlentities($ctable_d['class_id']);
				$result[]=$result_item;
			}
			$reply=array("ack"=>1,"developer_msg"=>"Class detail fetched!!.","ack_msg"=>"Success! Area Record Fetched Successfully.","result"=>$result);
				return $reply;
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"Area detail not fetched!!.","ack_msg"=>"Error! Area Record Not Found");
			return $reply;
		}
		
	}	
	public function areaDelete($detail)
	{
		$rows 	= array(
		"isDelete"	=> "1"
		);
			$where	= "id='".$detail['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['AREA_DELETE']);
			if($uid!=0)
			{
				
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('AREA_DELETE',1),"ack_msg"=>$this->log->getMessage('AREA_DELETE'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Area Could Not Be Deleted.");
				return $reply;
			}
	}
	public function areaDeleteClass($detail)
	{
		$class_name=$this->db->rp_getValue("class","class_name","isDelete=0 AND id='".$detail['id']."'");
		
		$rows 	= array(
		"isDelete"	=> "1"
		);
		$where	= "id='".$detail['id']."'";
			
			// Class Deleted : GUJARAT.\n All Area From Class GUJARAT deleted!! 
			$uid=$this->db->rp_update("class",$rows,$where,0);
			$uid=$this->db->rp_update("area",$rows,"class_id='".$detail['id']."'");
			
			$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['AREA_DELETE']." : ".$class_name." \n All Area From Class ".$class_name." deleted");

			if($uid!=0)
			{
				
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('AREA_DELETE',1),"ack_msg"=>$this->log->getMessage('AREA_DELETE'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Area Could Not Be Deleted.");
				return $reply;
			}
	}
	public function areaActive($detail)
	{
		$rows 	= array(
			"isActive"	=> $detail['isActive']
		);
			$where	= "id='".$detail['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>"Active status changed of Area.","ack_msg"=>"Success! Area Record Status Updated Successfully.");
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Area Record Status Could Not Be Updated.");
				return $reply;
			}
	}
	public function duplicateArea($class_id,$items)
	{
		$isValid=true;
		$Error=array();
		foreach($items as $i)
		{
			// Check Whether any same old item available or not?
			$area_exist=$this->db->rp_getTotalRecord($this->ctable,"area_name = '".$i['name']."' AND class_id='".$class_id."' AND isDelete=0","",0);
			if($area_exist!=0)
			{
					$isValid=false;
					$Error[]="duplicate area ".$i['name'];					
			}
			
		}	
		return array("isValid"=>$isValid,"error"=>$Error);	
		
	}
	
	
}

?>