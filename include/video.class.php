<?php
require_once("main.class.php");
require_once("function.class.php");
class Video extends Functions
{
	public $db;
	public $log;
	public $ctable="video";
	public $ctableMessurement="messurement";
	public $ctableVideoStore="video_store_item";
	public $ctablePriceList="price_list_map_video";
	function __construct($id="") 
	{
		$db = new Functions();
		$conn =$db->connect();
		$this->db=$db;	
		$log	= new Log();		
		$this->log=$log;		
    } 
	
	public function getStoreVideoInformation($store_id,$video_id)
	{
		$store_information=$this->db->rp_getData("video_store_item","*","store_id='".$store_id."' AND video_id='".$video_id."'","",0);
		if($store_information)
		{
			$store_information=mysqli_fetch_assoc($store_information);
			return $store_information;
		}
		else
		{
			return false;
		}
	}
	
	
	public function getVehicalVideoInformation($vehical_id,$video_id)
	{
		$store_information=$this->rp_getData("vehical_map_stock","*","vehical_id='".$vehical_id."' AND video_id='".$video_id."'","",0);
		if($store_information)
		{
			$store_information=mysqli_fetch_assoc($store_information);
			
			return $store_information;
		}
		else
		{
			return false;
		}
	}
	public function getVideoInformation($video_id)
	{
		$store_information=$this->db->rp_getData("video","*","id='".$video_id."'","",0);
		if($store_information)
		{
			$store_information=mysqli_fetch_assoc($store_information);
			return $store_information;
		}
		else
		{
			return false;
		}
	}
	
	
	function getVideoDetail($pid)
	{
		$videos=array();
		$video_r=$this->db->rp_getData("video","*","id='".$pid."'","",0);
		
		while($video=mysqli_fetch_assoc($video_r))
		{
			$videos[]=$video;
		}
		return $videos;
	}


	public function InsertVideo($detail) 
	{
		extract($detail);
		$rows 	= array(
						"url",
						"isDelete",	
						"isActive",	
						"created_date"
					);
			$values = array(
						$url,
						0,			  
						1,
						date("Y-m-d H:i:s")	
						);
		 	$video_id = $this->db->rp_insert($this->ctable,$values,$rows,0);
		
			$this->log->insertLog($this->ctable,$video_id,"insert",$this->log->slm['VIDEO_INSERT_SUCESS']." : ".$fg_item_name);
			
			if($video_id!=0)
			{
				
				
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('VIDEO_INSERT_SUCESS',1),"ack_msg"=>$this->log->getMessage('VIDEO_INSERT_SUCESS'),"id"=>$video_id);
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('VIDEO_INSERT_FAILED',1),"ack_msg"=>$this->log->getMessage('VIDEO_INSERT_FAILED'),"id"=>$video_id);
				return $reply;
			}
		
	}	

	public function UpdateVideo($detail)
	{
		extract($detail);
			
				$rows 	= array(
						"url"=> $url,
						"isDelete"=>0,
						"isActive"=>1
						
				);
				$where	= "id='".$_REQUEST['id']."'";
				$uid=$this->db->rp_update($this->ctable,$rows,$where,0);
				
				$this->log->insertLog($this->ctable,$_REQUEST['id'],"update",$this->log->slm['VIDEO_UPDATE_SUCESS']." : ".$fg_item_name);
				
				if($uid)
				{
					

						
					
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('VIDEO_UPDATE_SUCESS',1),"ack_msg"=>$this->log->getMessage('VIDEO_UPDATE_SUCESS'),"id"=>$_REQUEST['id']);
					return $reply;
					
				}
				else
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('VIDEO_UPDATE_FAILED',1),"ack_msg"=>$this->log->getMessage('VIDEO_UPDATE_FAILED'));
					return $reply;
				}
				
		}	
	public function EditVideo($detail)
	{		
		$where = " id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where,"",0);
		if($ctable_r)
		{
			$ctable_d = mysqli_fetch_array($ctable_r);
			$result=array();
			
			$result=$ctable_d;
			$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('VIDEO_GET_SUCESS',1),"ack_msg"=>$this->log->getMessage('VIDEO_GET_SUCESS'),"result"=>$result);
			return $reply;
		}
		else
		{
			$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('VIDEO_GET_FAILED',1),"ack_msg"=>$this->log->getMessage('VIDEO_GET_FAILED'));
			return $reply;
		}
	
	}	
	public function DeleteVideo($detail)
	{
		$rows 	= array(
		"isDelete"	=> "1",
		"modify_date" =>date("Y-m-d H:i:s")
		);
			$where	= "id='".$detail['id']."'";
			$isUpdated=$this->db->rp_update($this->ctable,$rows,$where);
			
			$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['ITEM_FG_DELETE']." : ");
			
			if($isUpdated)
			{
				$where	= "video_id='".$detail['id']."'";
				$this->rp_update($this->ctableVideoStore,array("isDelete"=>1),"video_id='".$_REQUEST['id']."'");
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('VIDEO_DELETE_SUCESS',1),"ack_msg"=>$this->log->getMessage('VIDEO_DELETE_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('VIDEO_DELETE_FAILED',1),"ack_msg"=>$this->log->getMessage('VIDEO_DELETE_FAILED'));
				return $reply;
			}
	}
	public function ActiveVideo($detail)
	{
		$rows 	= array(
			"isActive"	=> $detail['is_active']
		);
			$where	= "id='".$detail['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('VIDEO_STATUS_SUCESS',1),"ack_msg"=>$this->log->getMessage('VIDEO_STATUS_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('VIDEO_STATUS_FAILED',1),"ack_msg"=>$this->log->getMessage('VIDEO_STATUS_FAILED'));
				return $reply;
			}
	}
	
}

?>