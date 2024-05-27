<?php
require_once("main.class.php");
require_once("function.class.php");
class Resource extends Functions
{
	public $db;
	public $log;
	public $ctable="resource";
	public $ctableMessurement="messurement";
	public $ctableProductStore="product_store_item";
	public $ctablePriceList="price_list_map_product";
	function __construct($id="") 
	{
		$db = new Functions();
		$conn =$db->connect();
		$this->db=$db;	
		$log	= new Log();		
		$this->log=$log;		
    } 
	
	function getResourceDetail($bid)
	{
		$resource=array();
		$resource_r=$this->db->rp_getData("resource","*","id='".$bid."'","",0);
		
		while($resource_d=mysqli_fetch_assoc($resource_r))
		{
			$resource[]=$resource_d;
		}
		return $resource;
	}





	public function InsertResource($detail,$file) 
	{
         	extract($detail);
		$dup_where = "title = '".$title."' AND isDelete=0";
		$r = $this->db->rp_dupCheck($this->ctable,$dup_where);
		if($r){
			$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DUPLICATE_RECORED_FOUND',1),"ack_msg"=>$this->log->getMessage('DUPLICATE_RECORED_FOUND'));
			return $reply;
		}
		else
		{   
	
		
		
			if (isset($file["image_path"]) && $file["image_path"]['size']!=0) 
					{
						
						$allowedExts = array("jpg","jpeg","png","gif","JPG","JPEG");
						 $temp = explode(".", $file["image_path"]["name"]);
						 
						$extension = end($temp);
						$error="";
						if($file["image_path"]["error"]>0) {
							$error .= "Error opening the file. ";
						}
						if($file["image_path"]["type"]=="application/x-msdownload"){
							$error .= "Mime type not allowed. ";
						}
						if(!in_array($extension, $allowedExts)){
							$error .= "Extension not allowed. ";
						}
				
						$fileName  = $this->db->clean($file["image_path"]["name"]);
						$fileSize  = round($file["image_path"]["size"]); // BYTES
						//echo $fileSize ;exit;
						$adate   = date('Y-m-d H:i:m');

						$extension = end(explode(".", $fileName));
					
						$fileName	= 'resource_image_'.substr(sha1(time()), 0, 6).".".$extension;
						$filePath 	= "../images/resource/".$fileName;				
						move_uploaded_file($file['image_path']['tmp_name'], $filePath);
						$image=$fileName;
						
						
						
					}
					else
					{
						$image="Image not upload.";
						
						
						
					}
			
			$today	= date('Y-m-d H:i:s');
			$rows 	= array(
						"title",
						"description",
						"image_path",	
						"isDelete",	
						"isActive",	
						"created_date",	
					);
			$values = array(
						$title,
						$description,
						$image,	
						0,			  
						1,
						date("Y-m-d H:i:s")	
						);
		 	$product_id = $this->db->rp_insert($this->ctable,$values,$rows,0);
		
			$this->log->insertLog($this->ctable,$product_id,"insert",$this->log->slm['RESOURCE_INSERT_SUCESS']." : ".$fg_item_name);
			
			if($product_id!=0)
			{
				
				
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('RESOURCE_INSERT_SUCESS',1),"ack_msg"=>$this->log->getMessage('RESOURCE_INSERT_SUCESS'),"id"=>$product_id);
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('RESOURCE_INSERT_FAILED',1),"ack_msg"=>$this->log->getMessage('RESOURCE_INSERT_FAILED'),"id"=>$product_id);
				return $reply;
			}
		}
		
	}	

	public function UpdateResource($detail,$file)
	{
			extract($detail);
			

				if (isset($file["image_path"]) && $file["image_path"]['size']!=0) 
					{
						
						$allowedExts = array("jpg","jpeg","png","gif","JPG","JPEG");
						 $temp = explode(".", $file["image_path_1"]["name"]);
						 
						$extension = end($temp);
						$error="";
						if($file["image_path"]["error"]>0) {
							$error .= "Error opening the file. ";
						}
						if($file["image_path"]["type"]=="application/x-msdownload"){
							$error .= "Mime type not allowed. ";
						}
						if(!in_array($extension, $allowedExts)){
							$error .= "Extension not allowed. ";
						}
				
						$fileName  = $this->db->clean($file["image_path"]["name"]);
						$fileSize  = round($file["image_path"]["size"]); // BYTES
						//echo $fileSize ;exit;
						$adate   = date('Y-m-d H:i:m');

						$extension = end(explode(".", $fileName));
					
						$fileName	= 'resource_image_'.substr(sha1(time()), 0, 6).".".$extension;
						$filePath 	= "../images/resource/".$fileName;						
						move_uploaded_file($file['image_path']['tmp_name'], $filePath);
						$image=$fileName;
						
						unset($detail['old_image_path']);
						
					}
					else
					{
						$image=$detail['old_image_path'];
						
					
						
					}
			
				$modify_date=date("Y-m-d H:i:s");
				$rows 	= array(
					"title"=> $title,
					"description"=> $description,
						"image_path"	=> $image,    
						"isDelete"=>0,
						"isActive"=>1,
						"created_date"=>$modify_date,
						
				);
				$where	= "id='".$_REQUEST['id']."'";
				$uid=$this->db->rp_update($this->ctable,$rows,$where,0);
				
				$this->log->insertLog($this->ctable,$_REQUEST['id'],"update",$this->log->slm['RESOURCE_UPDATE_SUCESS']." : ".$fg_item_name);
				
				if($uid)
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('RESOURCE_UPDATE_SUCESS',1),"ack_msg"=>$this->log->getMessage('RESOURCE_UPDATE_SUCESS'),"id"=>$_REQUEST['id']);
					return $reply;
					
				}
				else
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('RESOURCE_UPDATE_FAILED',1),"ack_msg"=>$this->log->getMessage('RESOURCE_UPDATE_FAILED'));
					return $reply;
				}
				
		}	
	public function EditResource($detail)
	{		
		$where = " id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where,"",0);
		if($ctable_r)
		{
			$ctable_d = mysqli_fetch_array($ctable_r);
			$result=array();
			
			$result=$ctable_d;
			$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('RESOURCE_GET_SUCESS',1),"ack_msg"=>$this->log->getMessage('RESOURCE_GET_SUCESS'),"result"=>$result);
			return $reply;
		}
		else
		{
			$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('RESOURCE_GET_FAILED',1),"ack_msg"=>$this->log->getMessage('RESOURCE_GET_FAILED'));
			return $reply;
		}
	
	}	
	public function DeleteResource($detail)
	{
		$rows 	= array(
		"isDelete"	=> "1"
		);
			$where	= "id='".$detail['id']."'";
			$isUpdated=$this->db->rp_update($this->ctable,$rows,$where);
			
			$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['ITEM_FG_DELETE']." : ");
			
			if($isUpdated)
			{
				$where	= "id='".$detail['id']."'";
				$this->rp_update($this->ctableProductStore,array("isDelete"=>1),"id='".$_REQUEST['id']."'");
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('RESOURCE_DELETE_SUCESS',1),"ack_msg"=>$this->log->getMessage('RESOURCE_DELETE_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('RESOURCE_DELETE_FAILED',1),"ack_msg"=>$this->log->getMessage('RESOURCE_DELETE_FAILED'));
				return $reply;
			}
	}
	public function ActiveResource($detail)
	{
		$rows 	= array(
			"isActive"	=> $detail['is_active']
		);
			$where	= "id='".$detail['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('RESOURCE_STATUS_SUCESS',1),"ack_msg"=>$this->log->getMessage('RESOURCE_STATUS_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('RESOURCE_STATUS_FAILED',1),"ack_msg"=>$this->log->getMessage('RESOURCE_STATUS_FAILED'));
				return $reply;
			}
	}
	
}

?>