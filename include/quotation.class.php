<?php
require_once("main.class.php");
require_once("function.class.php");
class Quotation extends Functions
{
	public $db;
	public $log;
	public $ctable="quotation";
	public $ctableMessurement="messurement";
	public $ctableQuotationStore="quotation_store_item";
	public $ctablePriceList="price_list_map_quotation";
	function __construct($id="") 
	{
		$db = new Functions();
		$conn =$db->connect();
		$this->db=$db;	
		$log	= new Log();		
		$this->log=$log;		
    } 
	
	public function getStoreQuotationInformation($store_id,$quotation_id)
	{
		$store_information=$this->db->rp_getData("quotation_store_item","*","store_id='".$store_id."' AND quotation_id='".$quotation_id."'","",0);
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
	
	
	public function getVehicalQuotationInformation($vehical_id,$quotation_id)
	{
		$store_information=$this->rp_getData("vehical_map_stock","*","vehical_id='".$vehical_id."' AND quotation_id='".$quotation_id."'","",0);
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
	public function getQuotationInformation($quotation_id)
	{
		$store_information=$this->db->rp_getData("quotation","*","id='".$quotation_id."'","",0);
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
	
	
	function getQuotationDetail($pid)
	{
		$quotations=array();
		$quotation_r=$this->db->rp_getData("quotation","*","id='".$pid."'","",0);
		
		while($quotation=mysqli_fetch_assoc($quotation_r))
		{
			$quotations[]=$quotation;
		}
		return $quotations;
	}


	public function InsertQuotation($detail) 
	{
		extract($detail);

if($cid==""){
	$adate = date("Y-m-d H:i:s");
	$cdrows 	= array(
		"name",
		"mobile_number",
		"location",
		"created_date"
	);
$cdvalues = array(
		$customer_name,
		$mobile_number,
		$location,
		$adate
	);
$cid =  $this->db->rp_insert("customer",$cdvalues,$cdrows);

}


		$rows 	= array(
			"cid",
			"subtotal",
			"discount",
			"total",
			"isDelete",	
			"isActive",	
			"created_date"
		);
$values = array(
			$cid,
			$subtotal,
			$discount,
			$finalTotal,
			0,			  
			1,
			date("Y-m-d H:i:s")	
			);


			$quotation_id = $this->db->rp_insert($this->ctable,$values,$rows,0);

			if($quotation_id!=0)
					   {
						  
						foreach($item as $row) {
							$product= $row['product_id'];
							$quantity= $row['qty'];
							$unit= $row['unit_id'];
							$total= $row['total'];
						
							
						  
						
							$rows 	= array(
								"qid",
								"cid",
								"product",
								"quantity",
								"unit",
								"total",
								"isDelete",	
								"isActive",	
								"created_date"
							);
					$values = array(
								$quotation_id,
								$cid,
								$product,
								$quantity,
								$unit,	
								$total,	
								0,			  
								1,
								date("Y-m-d H:i:s")	
								);
							
					 $qm_id = $this->db->rp_insert("quotation_mapping",$values,$rows,0);
					} 
					 if($qm_id!=0){
						$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('QUOTATION_INSERT_SUCESS',1),"ack_msg"=>$this->log->getMessage('QUOTATION_INSERT_SUCESS'),"cid"=>$customer_ids);
						return $reply;
						}else{
							$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('QUOTATION_INSERT_FAILED',1),"ack_msg"=>$this->log->getMessage('QUOTATION_INSERT_FAILED'),"cid"=>$customer_ids);
						return $reply;
						}
					
						
					   }else{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('QUOTATION_INSERT_FAILED',1),"ack_msg"=>$this->log->getMessage('QUOTATION_INSERT_FAILED'),"cid"=>$customer_ids);
				return $reply;
					   }

			}	

	public function UpdateQuotation($detail)
	{
			extract($detail);
			$dup_where = "display_name = '".$display_name."'  AND id!='".$_REQUEST['id']."' AND isDelete=0";
			$r = $this->db->rp_dupCheck($this->ctable,$dup_where);
		
				$modify_date=date("Y-m-d H:i:s");
				$rows 	= array(
						"cid"=> $cid,
						"product"=> $product,
						"quantity"=> $quantity,
						"unit"=> $unit, 
						"total"=> $total,           
						"isDelete"=>0,
						"isActive"=>1,
						"created_date"=>$modify_date
						
				);
				$where	= "id='".$_REQUEST['id']."'";
				$uid=$this->db->rp_update($this->ctable,$rows,$where,0);
				
				$this->log->insertLog($this->ctable,$_REQUEST['id'],"update",$this->log->slm['QUOTATION_UPDATE_SUCESS']." : ".$fg_item_name);
				
				if($uid)
				{
					

						
					
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('QUOTATION_UPDATE_SUCESS',1),"ack_msg"=>$this->log->getMessage('QUOTATION_UPDATE_SUCESS'),"id"=>$_REQUEST['id']);
					return $reply;
					
				}
				else
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('QUOTATION_UPDATE_FAILED',1),"ack_msg"=>$this->log->getMessage('QUOTATION_UPDATE_FAILED'));
					return $reply;
				}
				
		}	
	public function EditQuotation($detail)
	{		
		$where = " id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where,"",0);
		if($ctable_r)
		{
			$ctable_d = mysqli_fetch_array($ctable_r);
			$result=array();
			
			$result=$ctable_d;
			$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('QUOTATION_GET_SUCESS',1),"ack_msg"=>$this->log->getMessage('QUOTATION_GET_SUCESS'),"result"=>$result);
			return $reply;
		}
		else
		{
			$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('QUOTATION_GET_FAILED',1),"ack_msg"=>$this->log->getMessage('QUOTATION_GET_FAILED'));
			return $reply;
		}
	
	}	
	public function DeleteQuotation($detail)
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
				$where	= "quotation_id='".$detail['id']."'";
				$this->rp_update($this->ctableQuotationStore,array("isDelete"=>1),"quotation_id='".$_REQUEST['id']."'");
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('QUOTATION_DELETE_SUCESS',1),"ack_msg"=>$this->log->getMessage('QUOTATION_DELETE_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('QUOTATION_DELETE_FAILED',1),"ack_msg"=>$this->log->getMessage('QUOTATION_DELETE_FAILED'));
				return $reply;
			}
	}
	public function ActiveQuotation($detail)
	{
		$rows 	= array(
			"isActive"	=> $detail['is_active']
		);
			$where	= "id='".$detail['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('QUOTATION_STATUS_SUCESS',1),"ack_msg"=>$this->log->getMessage('QUOTATION_STATUS_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('QUOTATION_STATUS_FAILED',1),"ack_msg"=>$this->log->getMessage('QUOTATION_STATUS_FAILED'));
				return $reply;
			}
	}
	
}

?>