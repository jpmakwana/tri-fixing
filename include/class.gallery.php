<?php
require_once("main.class.php");
require_once("function.class.php");
class Gallery extends Functions
{
	public $db;
	public $log;
	public $ctable="gallery";
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
	

	public function getProductInformation($product_id)
	{
		$store_information=$this->db->rp_getData("product","*","id='".$product_id."'","",0);
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

	public function InsertGallery($file) 
	{
         	extract($detail);
		
		
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
					
						$fileName	= 'gallery_image_'.substr(sha1(time()), 0, 6).".".$extension;
						$filePath 	= "../images/gallery/".$fileName;				
						move_uploaded_file($file['image_path']['tmp_name'], $filePath);
						$image=$fileName;
						
						
						
					}
					else
					{
						$image="Image not upload.";
						
						
						
					}
			
			$today	= date('Y-m-d H:i:s');
			$rows 	= array(
						"image_path",	
						"isDelete",	
						"isActive",	
						"created_date",	
					);
			$values = array(
						$image,	
						0,			  
						1,
						date("Y-m-d H:i:s")	
						);
		 	$product_id = $this->db->rp_insert($this->ctable,$values,$rows,0);
		
			$this->log->insertLog($this->ctable,$product_id,"insert",$this->log->slm['GALLERY_INSERT_SUCESS']." : ".$fg_item_name);
			
			if($product_id!=0)
			{
				
				
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('GALLERY_INSERT_SUCESS',1),"ack_msg"=>$this->log->getMessage('GALLERY_INSERT_SUCESS'),"id"=>$product_id);
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('GALLERY_INSERT_FAILED',1),"ack_msg"=>$this->log->getMessage('GALLERY_INSERT_FAILED'),"id"=>$product_id);
				return $reply;
			}
		
		
	}	

	public function UpdateGallery($file)
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
					
						$fileName	= 'gallery_image_'.substr(sha1(time()), 0, 6).".".$extension;
						$filePath 	= "../images/gallery/".$fileName;						
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
					"image_path"	=> $image,    
						"isDelete"=>0,
						"isActive"=>1,
						"created_date"=>$modify_date,
						
				);
				$where	= "id='".$_REQUEST['id']."'";
				$uid=$this->db->rp_update($this->ctable,$rows,$where,0);
				
				$this->log->insertLog($this->ctable,$_REQUEST['id'],"update",$this->log->slm['GALLERY_UPDATE_SUCESS']." : ".$fg_item_name);
				
				if($uid)
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('GALLERY_UPDATE_SUCESS',1),"ack_msg"=>$this->log->getMessage('GALLERY_UPDATE_SUCESS'),"id"=>$_REQUEST['id']);
					return $reply;
					
				}
				else
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('GALLERY_UPDATE_FAILED',1),"ack_msg"=>$this->log->getMessage('GALLERY_UPDATE_FAILED'));
					return $reply;
				}
				
		}	
	public function EditGallery($detail)
	{		
		$where = " id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where,"",0);
		if($ctable_r)
		{
			$ctable_d = mysqli_fetch_array($ctable_r);
			$result=array();
			
			$result=$ctable_d;
			$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('GALLERY_GET_SUCESS',1),"ack_msg"=>$this->log->getMessage('GALLERY_GET_SUCESS'),"result"=>$result);
			return $reply;
		}
		else
		{
			$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('GALLERY_GET_FAILED',1),"ack_msg"=>$this->log->getMessage('GALLERY_GET_FAILED'));
			return $reply;
		}
	
	}	
	public function DeleteGallery($detail)
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
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('GALLERY_DELETE_SUCESS',1),"ack_msg"=>$this->log->getMessage('GALLERY_DELETE_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('GALLERY_DELETE_FAILED',1),"ack_msg"=>$this->log->getMessage('GALLERY_DELETE_FAILED'));
				return $reply;
			}
	}
	public function ActiveGallery($detail)
	{
		$rows 	= array(
			"isActive"	=> $detail['isActive']
		);
			$where	= "id='".$detail['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('GALLERY_STATUS_SUCESS',1),"ack_msg"=>$this->log->getMessage('GALLERY_STATUS_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('GALLERY_STATUS_FAILED',1),"ack_msg"=>$this->log->getMessage('GALLERY_STATUS_FAILED'));
				return $reply;
			}
	}
	
}

?>