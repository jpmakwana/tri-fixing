<?php
require_once("main.class.php");
require_once("function.class.php");
class Pricelist extends Functions
{
	public $db;
	public $log;
	public $ctable="price_list";
	function __construct($id="") 
	{
		$db = new Functions();		
		$conn =$db->connect();
		$this->db=$db;	
		$this->log=new Log();		   
    } 
	public function PricelistInsert($detail) 
	{
		extract($detail);
		$dup_where = "pricelist_name = '".$pricelist_name."' AND isDelete=0";
		$r = $this->db->rp_dupCheck($this->ctable,$dup_where);
		
		if($r){
			$reply=array("ack"=>0,"developer_msg"=>"Duplicate Pricelist","ack_msg"=>"Duplication! Already Exist Pricelist Name.");
			return $reply;
		}
		else
		{
			$created_date=date('Y-m-d H:i:s');
			$pricelist_slug=$this->db->rp_createSlug($pricelist_name);
			$adate	= date('Y-m-d H:i:s');
			$rows 	= array(
						"pricelist_name",
						"pricelist_slug",
					
						"created_date"
					);
			$values = array(
						$pricelist_name,		
						$pricelist_slug,		
						$created_date
					);
					
		 	$pricelist_id = $this->db->rp_insert($this->ctable,$values,$rows,0);
			$this->log->insertLog($this->ctable,$pricelist_id,"insert",$this->log->slm['PRICELIST_INSERT']." : ".$pricelist_name);

			if($pricelist_id!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('PRICELIST_INSERT',1),"ack_msg"=>$this->log->getMessage('PRICELIST_INSERT'),"inserted_id"=>$pricelist_id);
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Pricelist Could Not Be Added. ");
				return $reply;
			}
		}
	}	 
	public function PricelistUpdate($detail)
	{
			extract($detail);
			$dup_where = "pricelist_name = '".$pricelist_name."' AND id!='".$_REQUEST['id']."' AND isDelete=0";
			$r = $this->db->rp_dupCheck($this->ctable,$dup_where);
			if($r){
				$reply=array("ack"=>0,"developer_msg"=>"Duplicate Class","ack_msg"=>"Duplication! Already Exist Class Name.");
				return $reply;
				
			}else{
				$created_date=date('Y-m-d H:i:s');
				$pricelist_slug=$this->db->rp_createSlug($pricelist_name);
				$rows 	= array(
						"pricelist_name"				=> $pricelist_name,
						"pricelist_slug"				=> $pricelist_slug,
						"created_date"				=> $created_date,
						);
				$where	= "id='".$_REQUEST['id']."'";
				$isUpdated=$this->db->rp_update($this->ctable,$rows,$where);
				$this->log->insertLog($this->ctable,$_REQUEST['id'],"update",$this->log->slm['PRICELIST_UPDATE']." : ".$pricelist_name);
				
				if($isUpdated)
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('PRICELIST_UPDATE',1),"ack_msg"=>$this->log->getMessage('PRICELIST_UPDATE'));
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Class Could Not Be Added. ");
					return $reply;
				}
			}	
		}	
	public function PricelistGetEditData($detail)
	{		
		$where = " id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where);
		if($ctable_r)
		{
			$ctable_d = mysqli_fetch_array($ctable_r);
			$result=array();
			
			$result['pricelist_name']		= htmlentities($ctable_d['pricelist_name']);
			
			$reply=array("ack"=>1,"developer_msg"=>"pricelist detail fetched!!.","ack_msg"=>"Success! pricelist Record Fetched Successfully.","result"=>$result);
			return $reply;
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"pricelist detail not fetched!!.","ack_msg"=>"Error! pricelist Record Not Found");
			return $reply;
		}
	}	
	public function PricelistDelete($detail)
	{
		$pricelist_name=$this->db->rp_getValue($this->ctable,"pricelist_name","isDelete=0 AND id='".$detail['id']."'");
		$rows 	= array(
		"isDelete"	=> "1"
		);
			$where	= "id='".$detail['id']."'";
			$isUpdated=$this->db->rp_update($this->ctable,$rows,$where);
			$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['PRICELIST_DELETE']." : ".$pricelist_name);
			if($isUpdated)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('PRICELIST_DELETE',1),"ack_msg"=>$this->log->getMessage('PRICELIST_DELETE'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Pricelist Could Not Be Deleted.");
				return $reply;
			}
	}
	public function PricelistActive($detail)
	{
		$rows 	= array(
			"isActive"	=> $detail['isActive']
		);
			$where	= "id='".$detail['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>"Active status changed of Pricelist.","ack_msg"=>"Success! Pricelist Status Updated Successfully.");
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Pricelist Status Could Not Be Updated.");
				return $reply;
			}
	}
	function getAreaDetail($required_columns)
	{	
		$required_columns=$this->getRequiredColumns($required_columns);	
		$limit=$this->getLimit();		
		$result=array();
		$where="1=1";
		$data    = $this->db->rp_getData('area',$required_columns,$where,"",0,$limit);
		
		if($data)
		{
			while($row=mysqli_fetch_assoc($data))
			{
				$result[]=$row;
			}			
			return $result;
		}
		else
		{
			return $result;
		}	
		
	}
	function getAreaDetail_usingClassId($class_id)
	{	
		$result=array();
		$where="class_id=".$_REQUEST['class_id']."";
		$data    = $this->db->rp_getData('area',"id,name,class_id",$where,"",0,$limit);
		
		if($data)
		{
			while($row=mysqli_fetch_assoc($data))
			{
				$result[]=$row;
			}			
			return $result;
		}
		else
		{
			return $result;
		}	
		
	}
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
	
	
}

?>