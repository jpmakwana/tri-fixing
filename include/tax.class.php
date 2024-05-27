<?php
require_once("main.class.php");
require_once("function.class.php");
class Tax extends Functions
{
	public $db;
	public $ctable="tax";
	function __construct($id="") 
	{
		$db = new Functions();
		$conn =$db->connect();
		$this->db=$db;		   
    } 
	public function TaxInsert($detail) 
	{
		extract($detail);
		$dup_where = "tax_name = '".$tax_name."' AND isDelete=0";
		$r = $this->db->rp_dupCheck($this->ctable,$dup_where,0);
		
		if($r){
			$reply=array("ack"=>0,"developer_msg"=>"Duplicate Tax","ack_msg"=>"Duplication! Already Exist This Tax.");
			return $reply;
		}
		else
		{
			$adate	= date('Y-m-d H:i:s');
			$rows 	= array(
						"tax_name",
						"tax_value",		
						"isDelete",
						"created_date"
					);
			$values = array(
						$tax_name,
						$tax_value,
						0,
						$adate
					);
					
		 	$uid = $this->db->rp_insert($this->ctable,$values,$rows,0);
		
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>"Tax Added.","ack_msg"=>"Success! Insert Tax Successfully.");
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Insert Tax Failed.");
				return $reply;
			}
		}
	}
	 
	 public function TaxUpdate($detail)
	  {
			extract($detail);
			$dup_where = "tax_name = '".$tax_name."' AND id!='".$_REQUEST['id']."' AND isDelete=0";
			$r = $this->db->rp_dupCheck($this->ctable,$dup_where);
			if($r){
				$reply=array("ack"=>1,"developer_msg"=>"Duplicate Tax","ack_msg"=>"Duplication! Already Exist This Tax.");
				return $reply;
				
			}else{
				$rows 	= array(
						"tax_name"				=> $tax_name,
						"tax_value"				=> $tax_value,
					);
				$where	= "id='".$_REQUEST['id']."'";
				$uid=$this->db->rp_update($this->ctable,$rows,$where,0);
				if($uid!=0)
				{
					$reply=array("ack"=>1,"developer_msg"=>"Tax Update Successfull!!.","ack_msg"=>"Success! Update Tax Successfully.");
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Update Tax Failed.");
					return $reply;
				}
			}	
		}	
	public function TaxGetEditData($detail)
	{		
		$where = " id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where);
		$ctable_d = mysqli_fetch_array($ctable_r);
		$result=array();
		
		$result['tax_name']		= htmlentities($ctable_d['tax_name']);
		$result['tax_value']	= stripslashes($ctable_d['tax_value']);
		
		$reply=array("ack"=>1,"developer_msg"=>"Tax detail fetched!!.","ack_msg"=>"Success! Update Tax Record Successfully.","result"=>$result);
		return $reply;
	
	}
	
	public function TaxDelete($detail)
	{
		$rows 	= array(
		"isDelete"	=> "1"
		);
			$where	= "id='".$_REQUEST['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>"deleted data.","ack_msg"=>"Success! Delete Tax Successfully.");
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Delete Tax Failed.");
				return $reply;
			}
	}
}

?>