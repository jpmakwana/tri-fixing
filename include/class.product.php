<?php
require_once("main.class.php");
require_once("function.class.php");
class Product extends Functions
{
	public $db;
	public $log;
	public $ctable="product";
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
	
	public function getStoreProductInformation($store_id,$product_id)
	{
		$store_information=$this->db->rp_getData("product_store_item","*","store_id='".$store_id."' AND product_id='".$product_id."'","",0);
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
	
	
	public function getVehicalProductInformation($vehical_id,$product_id)
	{
		$store_information=$this->rp_getData("vehical_map_stock","*","vehical_id='".$vehical_id."' AND product_id='".$product_id."'","",0);
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
	
	
	function getProductDetail($pid)
	{
		$products=array();
		$product_r=$this->db->rp_getData("product","*","id='".$pid."'","",0);
		
		while($product=mysqli_fetch_assoc($product_r))
		{
			$products[]=$product;
		}
		return $products;
	}

	public function getVehicalInformation($vehical_id)
	{
		$store_information=$this->db->rp_getData("vehical","*","id='".$vehical_id."'","",0);
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
	public function UpdateInward($dispatch_id,$store_id,$product_id,$used_qty)
	{
		$TotalUsedQty=$used_qty;
		$inward_information=$this->rp_getData("inward_store_item","*","store_id='".$store_id."' AND inward_store_item_id='".$product_id."' AND remain_to_use_qty>0","",0);
		if($inward_information)
		{
			while($inward=mysqli_fetch_assoc($inward_information))
			{
				if($used_qty<0)
				{
					break;
				}
				if($inward['remain_to_use_qty']>$used_qty)
				{
					$NewRemainToLocalQty=$inward['remain_to_use_qty']-$used_qty;
					$Used=$used_qty;
					$used_qty=0;					
				}
				else
				{
					$Used=$NewRemainToLocalQty;
					$NewRemainToLocalQty=0;
					$Used=$used_qty=$used_qty-$inward['remain_to_use_qty'];
				}
				$this->rp_insert("stock_used_log",array($Used,$dispatch_id,$TotalUsedQty,$inward['inward_store_id'],$inward['inward_store_item_id'],date("Y-m-d H:i:s")),array("used","dispatch_id","total_qty","inward_id","inward_item_id","created_date"),0);
				$isUpdated=$this->rp_update("inward_store_item",array("remain_to_use_qty"=>$NewRemainToLocalQty),"store_id='".$store_id."' AND inward_store_item_id='".$product_id."' AND id='".$inward['id']."'");
				
			}

			return true;
			
		}
		else
		{
			return false;
		}
	}
	public function UpdateStoreStock($store_id,$product_id,$stock_qty)
	{
		$store_information=$this->rp_getData("product_store_item","*","store_id='".$store_id."' AND product_id='".$product_id."'");
		if($store_information)
		{

			$isUpdated=$this->rp_update("product_store_item",array("stock_qty"=>$stock_qty),"store_id='".$store_id."' AND product_id='".$product_id."'");
			return $isUpdated;
		}
		else
		{
			return false;
		}
	}
	public function UpdateVehicalStock($vehical_id,$product_id,$stock_qty)
	{
		$store_information=$this->rp_getData("vehical_map_stock","*","vehical_id='".$vehical_id."' AND product_id='".$product_id."'","",0);
		if($store_information)
		{
			$store_information=mysqli_fetch_assoc($store_information);
			$isUpdated=$this->rp_update("vehical_map_stock",array("stock_qty"=>$stock_qty),"vehical_id='".$vehical_id."' AND product_id='".$product_id."'",0);
			return $isUpdated;
		}
		else
		{
			$product_info=$this->getProductInformation($product_id);
			if($product_info)
			{
				$vehical_info=$this->getVehicalInformation($vehical_id);
				$columns=array("vehical_id", "vehical_name", "category_id", "product_id", "product_name", "stock_qty", "created_date");
				$values=array($vehical_id, $vehical_info['vehical_name'], $product_info['category_id'], $product_info['id'], $product_info['product_name'], $stock_qty, date("Y-m-d H:i:s"));
				$vehical_map_stock_id=$this->rp_insert("vehical_map_stock",$values,$columns,0);
				return $vehical_map_stock_id;
			}
			else
			{
				return false;
			}
			
		}
	}
	public function InsertProduct($detail,$file) 
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
					
						$fileName	= 'product_image_'.substr(sha1(time()), 0, 6).".".$extension;
						$filePath 	= "../images/product/".$fileName;						
						move_uploaded_file($file['image_path']['tmp_name'], $filePath);
						$image=$fileName;
						
						
						
					}
					else
					{
						$image="Image not upload.";
						
						
						
					}
			
			$today	= date('Y-m-d H:i:s');
			$rows 	= array(
						"name",
						"image_path",             
						"isDelete",	
						"isActive",	
						"created_date"	
					);
			$values = array(
						$name,
						$image,	
						0,			  
						1,
						date("Y-m-d H:i:s")	
						);
		 	$product_id = $this->db->rp_insert($this->ctable,$values,$rows,0);
		
			$this->log->insertLog($this->ctable,$product_id,"insert",$this->log->slm['PRODUCT_INSERT_SUCESS']." : ".$fg_item_name);
			
			if($product_id!=0)
			{
				
				
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('PRODUCT_INSERT_SUCESS',1),"ack_msg"=>$this->log->getMessage('PRODUCT_INSERT_SUCESS'),"id"=>$product_id);
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('PRODUCT_INSERT_FAILED',1),"ack_msg"=>$this->log->getMessage('PRODUCT_INSERT_FAILED'),"id"=>$product_id);
				return $reply;
			}
		
	}	
	public function UpdateProduct($detail,$file)
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
					
						$fileName	= 'product'.substr(sha1(time()), 0, 6).".".$extension;
						$filePath 	= "../images/product/".$fileName;						
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
						"name"=> $name,
						"image_path"	=> $image,
						"isDelete"=>0,
						"isActive"=>1
						
				);
				$where	= "id='".$_REQUEST['id']."'";
				$uid=$this->db->rp_update($this->ctable,$rows,$where,0);
				
				$this->log->insertLog($this->ctable,$_REQUEST['id'],"update",$this->log->slm['PRODUCT_UPDATE_SUCESS']." : ".$fg_item_name);
				
				if($uid)
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('PRODUCT_UPDATE_SUCESS',1),"ack_msg"=>$this->log->getMessage('PRODUCT_UPDATE_SUCESS'),"id"=>$_REQUEST['id']);
					return $reply;
					
				}
				else
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('PRODUCT_UPDATE_FAILED',1),"ack_msg"=>$this->log->getMessage('PRODUCT_UPDATE_FAILED'));
					return $reply;
				}
				
		}	
	public function EditProduct($detail)
	{		
		$where = " id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where,"",0);
		if($ctable_r)
		{
			$ctable_d = mysqli_fetch_array($ctable_r);
			$result=array();
			
			$result=$ctable_d;
			$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('PRODUCT_GET_SUCESS',1),"ack_msg"=>$this->log->getMessage('PRODUCT_GET_SUCESS'),"result"=>$result);
			return $reply;
		}
		else
		{
			$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('PRODUCT_GET_FAILED',1),"ack_msg"=>$this->log->getMessage('PRODUCT_GET_FAILED'));
			return $reply;
		}
	
	}	
	public function DeleteProduct($detail)
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
				$where	= "product_id='".$detail['id']."'";
				$this->rp_update($this->ctableProductStore,array("isDelete"=>1),"product_id='".$_REQUEST['id']."'");
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('PRODUCT_DELETE_SUCESS',1),"ack_msg"=>$this->log->getMessage('PRODUCT_DELETE_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('PRODUCT_DELETE_FAILED',1),"ack_msg"=>$this->log->getMessage('PRODUCT_DELETE_FAILED'));
				return $reply;
			}
	}
	public function ActiveProduct($detail)
	{
		$rows 	= array(
			"isActive"	=> $detail['is_active']
		);
			$where	= "id='".$detail['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('PRODUCT_STATUS_SUCESS',1),"ack_msg"=>$this->log->getMessage('PRODUCT_STATUS_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('PRODUCT_STATUS_FAILED',1),"ack_msg"=>$this->log->getMessage('PRODUCT_STATUS_FAILED'));
				return $reply;
			}
	}
	
}

?>