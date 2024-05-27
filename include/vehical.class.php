<?php
require_once("main.class.php");
require_once("function.class.php");
class Vehical extends Functions
{
	public $db;
	public $log;
	public $ctable="vehical";
	function __construct($id="") 
	{
		$db = new Functions();
		$conn =$db->connect();
		$this->db=$db;	
		$log	= new Log();		
		$this->log=$log;		
    } 
	public function InsertVehical($detail) 
	{
		extract($detail);
		$dup_where = "vehical_no = '".$vehical_no."' AND isDelete=0";
		$r = $this->db->rp_dupCheck($this->ctable,$dup_where);
		
		if($r){
			$reply=array("ack"=>0,"developer_msg"=>"Duplicate Vehical Reg No","ack_msg"=>"Duplicate Vehical Reg No");
			return $reply;
		}
		else
		{
			$created_date=date('Y-m-d H:i:s');
			$adate	= date('Y-m-d H:i:s');
			$mot_end_date=($mot_end_date!="")?date('Y-m-d',strtotime($mot_end_date)):"";
			$mot_start_date=($mot_start_date!="")?date('Y-m-d',strtotime($mot_start_date)):"";
			$insurance_end_date=($insurance_end_date!="")?date('Y-m-d',strtotime($insurance_end_date)):"";
			$insurance_start_date=($insurance_start_date!="")?date('Y-m-d',strtotime($insurance_start_date)):"";
			$rows 	= array(
						"vehical_name",
						"vehical_no",
						"mot_name",
						"insurance_ceri_no",
						"insurance_end_date",
						"insurance_start_date",
						"insurance_company",
						"mot_ceri_no",
						"mot_start_date",
						"mot_end_date",
						"created_date"
					);
			$values = array(
						$vehical_name,		
						$vehical_no,			
						$mot_name,			
						$insurance_ceri_no,			
						$insurance_end_date,			
						$insurance_start_date,			
						$insurance_company,			
						$mot_ceri_no,			
						$mot_start_date,			
						$mot_end_date,			
						$created_date
					);
					
		 	$vehical_id = $this->db->rp_insert($this->ctable,$values,$rows,0);
		 
			$this->log->insertLog($this->ctable,$vehical_id,"insert",$this->log->slm['VEHICAL_INSERT_SUCESS']." : ".$vehical_name);

			if($vehical_id!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('VEHICAL_INSERT_SUCESS',1),"ack_msg"=>$this->log->getMessage('VEHICAL_INSERT_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('VEHICAL_INSERT_FAILED',1),"ack_msg"=>$this->log->getMessage('VEHICAL_INSERT_FAILED'));
				return $reply;
			}
		}
	}	 
	public function UpdateVehical($detail)
	{
			extract($detail);
			$dup_where = "vehical_no = '".$vehical_no."' AND id!='".$_REQUEST['id']."' AND isDelete=0";
			$r = $this->db->rp_dupCheck($this->ctable,$dup_where);
			if($r){
				$reply=array("ack"=>0,"developer_msg"=>"Duplicate Vehical Reg No","ack_msg"=>"Duplicate Vehical Reg No");
				return $reply;
				
			}else{
				$created_date=date('Y-m-d H:i:s');
				$mot_end_date=($mot_end_date!="")?date('Y-m-d',strtotime($mot_end_date)):"";
				$mot_start_date=($mot_start_date!="")?date('Y-m-d',strtotime($mot_start_date)):"";
				$insurance_end_date=($insurance_end_date!="")?date('Y-m-d',strtotime($insurance_end_date)):"";
				$insurance_start_date=($insurance_start_date!="")?date('Y-m-d',strtotime($insurance_start_date)):"";
				$rows 	= array(
						"vehical_name"				=> $vehical_name,
						"vehical_no"				=> $vehical_no,
						"created_date"				=> $created_date,
						//"insurance_name" =>$insurance_name,
						"mot_name" =>$mot_name,
						"insurance_ceri_no" =>$insurance_ceri_no,
						"insurance_end_date" =>$insurance_end_date,
						"insurance_start_date" =>$insurance_start_date,
						"insurance_company" =>$insurance_company,
						"mot_ceri_no" =>$mot_ceri_no,
						"mot_start_date" =>$mot_start_date,
						"mot_end_date" =>$mot_end_date,
						);
				$where	= "id='".$_REQUEST['id']."'";
				$isUpdated=$this->db->rp_update($this->ctable,$rows,$where,0);
				$this->log->insertLog($this->ctable,$_REQUEST['id'],"update",$this->log->slm['VEHICAL_UPDATE_SUCESS']." : ".$vehical_name);
				
				if($isUpdated)
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('VEHICAL_UPDATE_SUCESS',1),"ack_msg"=>$this->log->getMessage('VEHICAL_UPDATE_SUCESS'));
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('VEHICAL_UPDATE_FAILED',1),"ack_msg"=>$this->log->getMessage('VEHICAL_UPDATE_FAILED'));
					return $reply;
				}
			}	
		}	
	public function EditVehical($detail)
	{		
		$where = " id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where);
		if($ctable_r)
		{
			$ctable_d = mysqli_fetch_array($ctable_r);
			$result=array();
			$ctable_d['mot_start_date']=($ctable_d['mot_start_date']!="0000-00-00")?date('d-m-Y',strtotime($ctable_d['mot_start_date'])):"";
			$ctable_d['mot_end_date']=($ctable_d['mot_end_date']!="0000-00-00")?date('d-m-Y',strtotime($ctable_d['mot_end_date'])):"";
			$ctable_d['insurance_end_date']=($ctable_d['insurance_end_date']!="0000-00-00")?date('d-m-Y',strtotime($ctable_d['insurance_end_date'])):"";
			$ctable_d['insurance_start_date']=($ctable_d['insurance_start_date']!="0000-00-00")?date('d-m-Y',strtotime($ctable_d['insurance_start_date'])):"";

			$result		= $ctable_d;
			
			$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('VEHICAL_GET_SUCESS',1),"ack_msg"=>$this->log->getMessage('VEHICAL_GET_SUCESS'),"result"=>$result);
			return $reply;
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('VEHICAL_GET_FAILED',1),"ack_msg"=>$this->log->getMessage('VEHICAL_GET_FAILED'));
			return $reply;
		}
	}	
	public function ActiveVehical($detail)
	{
		$rows 	= array(
			"isActive"	=> $detail['isActive']
		);
			$where	= "id='".$detail['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('VEHICAL_STATUS_SUCESS',1),"ack_msg"=>$this->log->getMessage('VEHICAL_STATUS_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('VEHICAL_STATUS_FAILED',1),"ack_msg"=>$this->log->getMessage('VEHICAL_STATUS_FAILED'));
				return $reply;
			}
	}
	
	
}

?>