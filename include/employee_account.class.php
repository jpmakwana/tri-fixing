<?php
require_once("main.class.php");
require_once("function.class.php");
class EmployeeAccount extends Functions
{
	public $db;
	public $ctable="employee_account";
	
	function __construct($id="") 
	{
		$db = new Functions();
		$conn = $db->connect();
		$this->db=$db;				
    } 
	
	//Labour Account
	
	function debitAmount($employee_id,$amount,$remark){
		$adate	= date('Y-m-d H:i:s');
			$rows 	= array(
						"employee_id", 
						"amount",
						"type",
						"isActive",
						"remark",
						"created_date",
					);
			$values = array(
						$employee_id,
						"-".$amount,
						'debit',
						1,
						$remark,
						$adate,
					);
					
		 			
		 	$uid = $this->db->rp_insert("employee_account",$values,$rows,0);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>"Employee Debit Amount Successfully","ack_msg"=>"Success!Employee Debit Amount Successfully.");
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Debit Amount Failed.");
				return $reply;
			}
	}
	/* over Labour Account */
	//Platting Account
	function creditAmount($planning_id,$group_id,$employee_id,$amount,$remark){
			$adate	= date('Y-m-d H:i:s');
			$rows 	= array(
						"planning_id",
						"group_id",
						"employee_id",
						"amount",
						"type",
						"isActive",
						"remark",
						"created_date",
					);
			$values = array(
						$planning_id,
						$group_id,
						$employee_id,
						"+".$amount,
						'credit',
						1,
						$remark,
						$adate,
					);
					
		 	$uid = $this->db->rp_insert("employee_account",$values,$rows,0);
			
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>"Credit Amount Successfully","ack_msg"=>"Success! Credit Amount Successfully.");
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Credit Amount Failed.");
				return $reply;
			}
	}
	
	// Platting return
	
	
	function countLabour($key,$val)
	{
		
		$count=$this->db->rp_getTotalRecord($this->ctable,$key."='".$val."' AND isDelete=0",0);
		return $count;
	}
	function countLabourIssue($key,$val)
	{
		
		$count=$this->db->rp_getTotalRecord($this->ctableLabourReturnInfo,$key."='".$val."' AND isDelete=0");
		return $count;
	}
	function getIssueDetail($id,$required_columns=array())
	{
		$required_columns=$this->getRequiredColumns($required_columns);
		$resource=$this->db->rp_getData($this->ctableIssueInfo,$required_columns,"id='".$id."' AND isDelete=0","",0);
		if($resource)
		{
			return mysqli_fetch_assoc($resource);
		}
		return false;
	}
	function getRequiredColumns($required_columns=array())
	{
		if(!empty($required_columns))
		{
			$required_columns_string=implode(",",$required_columns);
			return $required_columns_string;
		}
		else
		{
			return "*";
		}
	}
	
}

?>