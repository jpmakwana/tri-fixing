<?php
require_once("main.class.php");
require_once("function.class.php");
class Security extends Functions
{
	public $db;
	public $ctable="security";
	function __construct($id="") 
	{
		$db = new Functions();
		$conn =$db->connect();
		$this->db=$db;		   
    } 
	public function Insertip($detail) 
	{
		extract($detail);
		$dup_where = "ip = '".$ip."' and status=1";
		$r = $this->db->rp_dupCheck($this->ctable,$dup_where);
	
		if($r){
			$reply=array("ack"=>0,"developer_msg"=>"Already Exist ip","ack_msg"=>"Duplication! Already Exist ip.");
			return $reply;
		}
		else
		{
			$adate	= date('Y-m-d H:i:s');
			$status	= 1;
			$attempts	= 5;
			$total_count=$this->db->rp_getTotalRecord($this->ctable,"ip='".$ip."'");
			//echo $total_count;exit;
			if($total_count>0){
				
				$rows 	= array(
						"ip"				=> $ip,
						"ltime"				=> $adate,
						"status"			=> $status,
						"attempts"			=> $attempts,
						"adate"				=> $adate,
						);
				$where	= "ip='".$ip."'";
				$isUpdated=$this->db->rp_update($this->ctable,$rows,$where,0);
			if($isUpdated)
			{
				$reply=array("ack"=>1,"developer_msg"=>"IP insert successfully!!.","ack_msg"=>"success! Insert Ip Successfully.");
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"IP insert Failed.");
				return $reply;
			}
			}else{
				
			$rows 	= array(
						"ip",
						"ltime",
						"status",
						"attempts",
						"adate",
						
					);
			$values = array(
						$ip,
						$adate,
						$status,	
						$attempts,	
						$adate,	
						
					);
					
		 	$uid = $this->db->rp_insert($this->ctable,$values,$rows,0);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>"IP insert successfully!!.","ack_msg"=>"success! Insert Ip Successfully.");
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"IP insert Failed.");
				return $reply;
			}
			}
			
		}
	}
	 
	 public function Updateip($detail)
	  {
			extract($detail);
			$dup_where = "ip = '".$ip."' AND id!='".$_REQUEST['id']."'";
			$r = $this->db->rp_dupCheck($this->ctable,$dup_where);
			if($r){
				$reply=array("ack"=>1,"developer_msg"=>"Already Exist ip","ack_msg"=>"Duplication! Already Exist ip.");
				return $reply;
				
			}else{
				$rows 	= array(
						"ip"				=> $ip,
						);
				$where	= "id='".$_REQUEST['id']."'";
				$uid=$this->db->rp_update($this->ctable,$rows,$where,0);
				if($uid!=0)
				{
					$reply=array("ack"=>1,"developer_msg"=>"ip Update Successfull!!.","ack_msg"=>"Success! Update ip Successfully.");
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"ip Update Failed.");
					return $reply;
				}
			}	
		}	
	public function Editip($detail)
	{		
		$where = " id='".$detail['id']."'";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where,0);
		$ctable_d = mysqli_fetch_array($ctable_r);
		$result=array();
		
		$result['ip']		= htmlentities($ctable_d['ip']);
		
		$reply=array("ack"=>1,"developer_msg"=>"ip detail fetched!!.","ack_msg"=>"ip Successfull.","result"=>$result);
		return $reply;
	
	}
	
	public function Deleteip($detail)
	{
		$rows 	= array(
		"isDelete"	=> "1"
		);
			$where	= "id='".$_REQUEST['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>"ip Record deleted!!","ack_msg"=>"Success! ip Unit Successfully.");
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Delete ip Failed.");
				return $reply;
			}
	}
}

?>