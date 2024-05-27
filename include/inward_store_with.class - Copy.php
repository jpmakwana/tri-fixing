<?php
require_once("class.log.php");
class InwardStore extends Functions
{
	public $db,$log;
	public $ctable="inward_store";
	public $ctableInwardStoreItem="inward_store_item";
	public $ctableProduct="product";
	function __construct($id="") 
	{
		$db = new Functions();
		$conn =$db->connect();
		$this->db=$db;	
		$this->log=new Log();		   				
    } 
	public function InsertInwardStore($detail,$item)
	{
		//print_r($detail); exit;	
		extract($detail);
	
		$total_qty=0;
		$grand_total=0;
		$get_vendor=$this->db->rp_getData("vendor","*","id='".$inward_store_vendor_id."'");
		$vender_d=mysqli_fetch_assoc($get_vendor);
		
			$inward_store_vendor_name=$vender_d['vendor_name'];
			$inward_store_vendor_contact_no=$vender_d['vendor_contact_no'];
			$inward_store_vendor_email=$vender_d['vendor_email'];
			$inward_store_vendor_address=$vender_d['vendor_address'];
			$inward_store_vendor_city=$vender_d['vendor_city'];
			$inward_store_vendor_state=$vender_d['vendor_state'];
			$inward_store_vendor_country=$vender_d['vendor_country'];
			$inward_store_no=IS_NO."00".$this->db->getlastInsertId($this->ctable);
		
			
				$adate	= date('Y-m-d H:i:s');
				$inward_store_date	= date('Y-m-d');
				$rows 	= array(
							"inward_store_no",
							"store_id",
							"inward_store_vendor_id",
							"inward_store_vendor_name",
							"inward_store_vendor_city",
							"inward_store_vendor_state",
							"inward_store_vendor_country",
							"inward_store_vendor_address",
							"inward_store_vendor_contact_no",
							"inward_store_vendor_email",
							"purchase_order_id",
							"created_date",
							"inward_store_date",
							"isDelete"
						);
				$values = array(
							$inward_store_no,
							$store_id,
							$inward_store_vendor_id,
							$inward_store_vendor_name,
							$inward_store_vendor_city,
							$inward_store_vendor_state,
							$inward_store_vendor_country,
							$inward_store_vendor_address,
							$inward_store_vendor_contact_no,
							$inward_store_vendor_email,
							$purchase_order_id,
							$adate,
							$inward_store_date,
							$isDelete
						);
						
				$inward_store_id = $this->db->rp_insert($this->ctable,$values,$rows,0);
				$this->log->insertLog($this->ctable,$inward_store_id,"insert",$this->log->slm['INWARD_STORE_INSERT']." : ".$inward_store_no);

			
			if($inward_store_id!=0)
			{
				$grand_total=0;
				// Insert Inward Item
				
				if(!empty($item))
				{
					$inward_item=array();
					$current_item=array();
					for($i=0;$i<sizeof($item);$i++)
					{
						
							$current_item=$item[$i]; 
					
						//print_r($current_item);exit;
							$po_items=$this->db->rp_getData("purchase_order_item","*","id='".$current_item['purchase_order_item_id']."'");
							
							$po_item = mysqli_fetch_assoc($po_items);
							$subtotal=$po_item['purchase_order_item_price']*$current_item['inward_store_item_received_qty'];
							
							
							if($current_item['inward_store_item_received_qty']<=$po_item['purchase_order_item_qty'])
							{
								$adate	= date('Y-m-d H:i:s');
								$rows 	= array(
								"inward_store_id",
								"purchase_order_id",
								"purchase_order_item_id",
								"store_id",
								"inward_store_item_id",
								"inward_store_item_unit_id",
								"inward_store_item_unit_name",
								"inward_store_item_unit_slug",
								"inward_store_item_name",
								"inward_store_item_type",
								"inward_store_item_received_qty",
								"remain_to_locate_qty",
								"inward_store_item_price",
								"inward_store_item_sub_total",
								"purchase_order_item_order_qty",
								"created_date",								
								"isDelete"
							);
							$values = array(
								$inward_store_id,	
								$po_item['purchase_order_id'],	
								$current_item['purchase_order_item_id'],
								$store_id,
								$po_item['purchase_order_item_id'],
								$po_item['purchase_order_item_unit_id'],
								$po_item['purchase_order_item_unit'],
								$po_item['purchase_order_item_unit_slug'],
								$po_item['purchase_order_item_name'],
								$po_item['purchase_order_item_type'],
								$current_item['inward_store_item_received_qty'],
								$current_item['inward_store_item_received_qty'],
								$po_item['purchase_order_item_price'],
								$subtotal,
								$po_item['purchase_order_item_qty'],
								$adate,
								0
							);	
						$grand_total+=$subtotal;						
						if($current_item['inward_store_item_received_qty']!=0){
							$inward_store_item_id = $this->db->rp_insert("inward_store_item",$values,$rows,0);
							
							//Update Stock Qty Of Product Table
							$product_stock_qty=$this->db->rp_getValue($this->ctableProduct,"stock_qty","id='".$po_item['purchase_order_item_id']."' AND isDelete=0 AND category_id='".$po_item['purchase_order_item_type']."'",0);
							
							$stock_qty=$product_stock_qty+$current_item['inward_store_item_received_qty'];
							$total_stock_qty=$stock_qty;
							$rows 	= array(
							"stock_qty"				=> $total_stock_qty,
							);
							
							$where_product	= "id='".$po_item['purchase_order_item_id']."' AND category_id='".$po_item['purchase_order_item_type']."'";
							
							$isUpdated1=$this->db->rp_update($this->ctableProduct,$rows,$where_product,0);
					
							$this->log->insertLog($this->ctableProduct,$current_item['purchase_order_item_id'],"update","Product Stock Quantity Updated By User");
								
							//Update Stock Qty Of Product store Item Table
							
							$product_store_stock_qty=$this->db->rp_getValue("product_store_item","stock_qty","product_id='".$po_item['purchase_order_item_id']."' AND isDelete=0 AND category_id='".$po_item['purchase_order_item_type']."' AND store_id='".$store_id."'",0);
							
							$store_stock_qty=$product_store_stock_qty+$current_item['inward_store_item_received_qty'];
							$total_store_stock_qty=$store_stock_qty;
							$rows 	= array(
							"stock_qty"				=> $total_store_stock_qty,
							);
							
							$where_product	= "product_id='".$po_item['purchase_order_item_id']."' AND category_id='".$po_item['purchase_order_item_type']."' AND store_id='".$store_id."'";
								
							$isUpdated1=$this->db->rp_update("product_store_item",$rows,$where_product,0);
						
							$this->log->insertLog("product_store_item",$current_item['purchase_order_item_id'],"update","Product Store Stock Quantity Updated By User");
							
							// Update Purchase Order Item Received Qty
							$purchase_order_item_received_qty=$po_item['purchase_order_item_received_qty']+$current_item['inward_store_item_received_qty'];
							
							$purchase_order_item_remaining_qty=$po_item['purchase_order_item_remaining_qty']-$current_item['inward_store_item_received_qty'];
				
							$isUpdatedPOItem=$this->db->rp_update("purchase_order_item",array("purchase_order_item_received_qty"=>$purchase_order_item_received_qty,"purchase_order_item_remaining_qty"=>$purchase_order_item_remaining_qty),"purchase_order_id='".$po_item['purchase_order_id']."' AND purchase_order_item_type='".$po_item['purchase_order_item_type']."' AND purchase_order_item_id='".$po_item['purchase_order_item_id']."'",0);
							
							
							
							/// Update all table status
							$this->updateItemStatus($inward_store_item_id);
						}
						
					}
					
					
				$inward_item[]=$po_item['purchase_order_item_name'];
				}
				//exit;
				$inward_item_list=implode(",",$inward_item);
					
				$this->log->insertLog("inward_store_item",$inward_store_id,"insert","Inward Store ".$inward_store_no." Inserted  Item :\n".$inward_item_list);
				}
				$rows 	= array(
						"inward_store_grand_total"				=> $grand_total,
						
						);
						 $where	= "id='".$inward_store_id."'";
						$isUpdated1=$this->db->rp_update("inward_store",$rows,$where,0);
									
				//$this->updatePurchaseOrderItemStatus($po_no);	
				if($inward_store_item_id){
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('INWARD_STORE_INSERT_SUCESS',1),"ack_msg"=>$this->log->getMessage('INWARD_STORE_INSERT_SUCESS'),"inward_store_id"=>$inward_store_id);		
					return $reply;
				}else{
					$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('INWARD_STORE_INSERT_FAILED',1),"ack_msg"=>$this->log->getMessage('INWARD_STORE_INSERT_FAILED'));		
					return $reply;
				}
				
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Inward Store added Failed.");
				return $reply;
			}
	//	function inward_store_item_received_qty($po_id,$category_id,$product_id);
	}
	 
	public function UpdateInwardStore($detail,$item)
	 {
		$total_qty=0;
		$grand_total=0;
		extract($detail);
		if(!empty($item)){
		$inward_store_no=$this->db->rp_getValue($this->ctable,"inward_store_no","isDelete=0 AND id='".$_REQUEST['id']."'");
		// Check whether inwarded item already used or not
		$checkResult=$this->checkOldItemUsage($_REQUEST['id']);
		if($checkResult['isValid'])
		{
			$old_items=$this->db->rp_getData($this->ctableInwardStoreItem,"*","inward_store_id='".$_REQUEST['id']."' AND isDelete=0");
			if($old_items)
			{
				while($old_item=mysqli_fetch_assoc($old_items))
				{
					$old_item_type=$old_item['inward_store_item_type'];
					$old_store_id=$old_item['store_id'];
					$old_item_id=$old_item['inward_store_item_id'];
					$old_item_inwarded_qty=$old_item['inward_store_item_received_qty'];
					$old_item_name=$old_item['inward_store_item_name'];
					
					//Restore stock Qty of product table
					$current_stock=$this->db->rp_getValue($this->ctableProduct,"stock_qty","id='".$old_item_id."'");
					$new_stock=$current_stock-$old_item_inwarded_qty;
					$this->db->rp_update($this->ctableProduct,array("stock_qty"=>$new_stock),"id='".$old_item_id."'",0);
					
					//Restore stock Qty of product Store item table
					$current_stock=$this->db->rp_getValue("product_store_item","stock_qty","product_id='".$old_item_id."' AND category_id='".$old_item_type."' AND store_id='".$old_store_id."'");
					$new_store_stock=$current_stock-$old_item_inwarded_qty;
					$this->db->rp_update("product_store_item",array("stock_qty"=>$new_store_stock),"product_id='".$old_item_id."' AND category_id='".$old_item_type."' AND store_id='".$old_store_id."'",0);
					
				}
			}
			
			$this->db->rp_delete("inward_store_item","inward_store_id='".$_REQUEST['id']."'",0);
			$inward_item=array();
			for($i=0;$i<sizeof($item);$i++)			
			{
				$current_item=$item[$i]; 
				
				
					$po_items=$this->db->rp_getData("purchase_order_item","*","id='".$current_item['purchase_order_item_id']."'");
					
					$po_item = mysqli_fetch_assoc($po_items);
					$subtotal=$po_item['purchase_order_item_price']*$current_item['inward_store_item_received_qty'];
					
					
					if($current_item['inward_store_item_received_qty']<=$po_item['purchase_order_item_qty'])
					{
						$adate	= date('Y-m-d H:i:s');
						$rows 	= array(
						"inward_store_id",
						"purchase_order_id",
						"purchase_order_item_id",
						"inward_store_item_id",
						"inward_store_item_unit_id",
						"inward_store_item_unit_name",
						"inward_store_item_unit_slug",
						"inward_store_item_name",
						"inward_store_item_code",
						"inward_store_item_type",
						"inward_store_item_received_qty",
						"remain_to_locate_qty",
						"inward_store_item_price",
						"inward_store_item_sub_total",
						"purchase_order_item_order_qty",
						"created_date",								
						"isDelete"
					);
					$values = array(
						$_REQUEST['id'],	
						$po_item['purchase_order_id'],	
						$current_item['purchase_order_item_id'],
						$po_item['purchase_order_item_id'],
						$po_item['purchase_order_item_unit_id'],
						$po_item['purchase_order_item_unit'],
						$po_item['purchase_order_item_unit_slug'],
						$po_item['purchase_order_item_name'],
						$po_item['purchase_order_item_code'],
						$po_item['purchase_order_item_type'],
						$current_item['inward_store_item_received_qty'],
						$current_item['inward_store_item_received_qty'],
						$po_item['purchase_order_item_price'],
						$subtotal,
						$po_item['purchase_order_item_qty'],
						$adate,
						0
					);	
				$grand_total+=$subtotal;						
				if($current_item['inward_store_item_received_qty']!=0){
					$inward_store_item_id = $this->db->rp_insert("inward_store_item",$values,$rows,0);
					
					//Update Stock Qty Of Product Table
					$product_stock_qty=$this->db->rp_getValue($this->ctableProduct,"stock_qty","id='".$po_item['purchase_order_item_id']."' AND isDelete=0 AND category_id='".$po_item['purchase_order_item_type']."'",0);
					
					$stock_qty=$product_stock_qty+$current_item['inward_store_item_received_qty'];
					$total_stock_qty=$stock_qty;
					$rows 	= array(
					"stock_qty"				=> $total_stock_qty,
					);
					
						 $where_product	= "id='".$po_item['purchase_order_item_id']."' AND category_id='".$po_item['purchase_order_item_type']."'";
						
						$isUpdated1=$this->db->rp_update($this->ctableProduct,$rows,$where_product,0);
				
						$this->log->insertLog($this->ctableProduct,$current_item['purchase_order_item_id'],"update","Product Stock Quantity Updated By User");
						
					//Update Stock Qty Of Product Store item Table
					$product_store_stock_qty=$this->db->rp_getValue("product_store_item","stock_qty","product_id='".$po_item['purchase_order_item_id']."' AND isDelete=0 AND category_id='".$po_item['purchase_order_item_type']."' AND store_id='".$store_id."'",0);
					
					$store_stock_qty=$product_store_stock_qty+$current_item['inward_store_item_received_qty'];
					$total_store_tock_qty=$store_stock_qty;
					$rows 	= array(
					"stock_qty"				=> $total_store_tock_qty,
					);					
					
					$where_product	= "product_id='".$po_item['purchase_order_item_id']."' AND category_id='".$po_item['purchase_order_item_type']."' AND store_id='".$store_id."'";
					
					$isUpdated1=$this->db->rp_update("product_store_item",$rows,$where_product,0);
							
					$this->log->insertLog("product_store_item",$current_item['purchase_order_item_id'],"update","Product Store Stock Quantity Updated By User");
								
					// Update Purchase Order Item Received Qty
					$purchase_order_item_received_qty=$this->ReceivedQty($po_item['purchase_order_id'],$current_item['purchase_order_item_id']);
					
					$purchase_order_item_remaining_qty=$po_item['purchase_order_item_qty']-$purchase_order_item_received_qty;
		
					$isUpdatedPOItem=$this->db->rp_update("purchase_order_item",array("purchase_order_item_received_qty"=>$purchase_order_item_received_qty,"purchase_order_item_remaining_qty"=>$purchase_order_item_remaining_qty),"purchase_order_id='".$po_item['purchase_order_id']."' AND purchase_order_item_type='".$po_item['purchase_order_item_type']."' AND purchase_order_item_id='".$po_item['purchase_order_item_id']."'",0);
					
					/// Update all table status
					$this->updateItemStatus($inward_store_item_id);
				}
			}
			
			$inward_item[]=$po_item['purchase_order_item_name'];
			}
			//print_r($inward_item);exit;
			$inward_item_list=implode(",",$inward_item);
			
			 $this->log->insertLog("inward_store_item",$_REQUEST['id'],"Update","Inward Store ".$inward_store_no." Updated Item :\n".$inward_item_list);
						
			$rows 	= array(
				"inward_store_grand_total"				=> $grand_total,
				
				);
			$where	= "id='".$_REQUEST['id']."'";
			$isUpdated1=$this->db->rp_update("inward_store",$rows,$where,0);
			
			$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('INWARD_STORE_UPDATE_SUCESS',1),"ack_msg"=>$this->log->getMessage('INWARD_STORE_UPDATE_SUCESS'));
			
			return $reply;
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"Inwarded Item already used could not edit.","ack_msg"=>"Inwarded Item already used could not edit. <br/>".implode("<br/>",$checkResult['error']));
			return $reply;
		}
		
	}
	else
	{
		$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Inward Store Update Failed.");
		return $reply;
	}
	}
	public function GetInwardStore($detail)
	{		
		
		$where = " id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where,0);		
		if($ctable_r){
			$ctable_d = mysqli_fetch_array($ctable_r);
			
			$result=array();
			
			$result['vendor_name']		= $ctable_d['inward_store_vendor_name'];
			$result['store_id']		= $ctable_d['store_id'];
			$result['vendor_email']		= $ctable_d['inward_store_vendor_email'];
			$result['vendor_address']		= $ctable_d['inward_vendor_address'];
			$result['vendor_contact_no']		= $ctable_d['inward_store_vendor_contact_no'];
			$result['purchase_order_id']		= htmlentities($ctable_d['purchase_order_id']);
		
			$result['inward_store_date']		= htmlentities($ctable_d['inward_store_date']);
			$result['inward_store_grand_total']		= htmlentities($ctable_d['inward_store_grand_total']);
			
			$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('INWARD_STORE_GET_SUCESS',1),"ack_msg"=>$this->log->getMessage('INWARD_STORE_GET_SUCESS'),"result"=>$result);
			return $reply;
			
		}else{
			$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('INWARD_STORE_GET_FAILED',1),"ack_msg"=>$this->log->getMessage('INWARD_STORE_GET_FAILED'));
			return $reply;
		}
		
	}
	public function GetInwardStoreItem($detail)
	{		
			//print_r($detail);exit;
			$where = "inward_store_id='".$detail['id']."' AND isDelete=0";
			$ctable_item = $this->db->rp_getData("inward_store_item","*",$where,"",0);
			
		
			if($ctable_item)
			{
				
			while($ctable_item_d = mysqli_fetch_array($ctable_item))
			{
				
				$receive_qty=$this->ReceivedQty($ctable_item_d['purchase_order_id'],$ctable_item_d['purchase_order_item_id']);
				$order_qty=$this->db->rp_getValue("purchase_order_item","purchase_order_item_qty","id='".$ctable_item_d['purchase_order_item_id']."'");
				$remaining_qty=$order_qty-$receive_qty;
				
				$result_item=array();
				
				$result_item['inward_store_item_name']	= htmlentities($ctable_item_d['inward_store_item_name']);
				$result_item['purchase_order_item_id']	= htmlentities($ctable_item_d['purchase_order_item_id']);
				$result_item['inward_store_item_code']	= htmlentities($ctable_item_d['inward_store_item_code']);
				$result_item['inward_store_item_received_qty']		= htmlentities($ctable_item_d['inward_store_item_received_qty']);
				$result_item['purchase_order_item_order_qty']		= htmlentities($order_qty);
				$result_item['inward_store_item_price']	= htmlentities($ctable_item_d['inward_store_item_price']);
				$result_item['inward_store_item_sub_total']	= htmlentities($ctable_item_d['inward_store_item_sub_total']);
				$result_item['store_id']	= htmlentities($ctable_item_d['store_id']);
				$result_item['remaining_qty']	= htmlentities($remaining_qty);
				$result[]=$result_item;
				//print_r($result);exit;
			}
			$reply=array("ack"=>1,"developer_msg"=>"Store detail fetched!!.","ack_msg"=>"Success! Update Store Successfully.","result"=>$result);
			return $reply;
			//print_r($result);exit;
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"Update not fetched!!.","ack_msg"=>"Success! Update Failed"	);
			return $reply;
		}
	
	}
	
	public function DeleteInwardStore($detail)
	{
		// Check whether inwarded item already used or not
		$checkResult=$this->checkOldItemUsage($detail['id']);
		$inward_store_no=$this->db->rp_getValue($this->ctable,"inward_store_no","isDelete=0 AND id='".$detail['id']."'");
		if($checkResult['isValid'])
		{
			$rows 	= array(
						"isDelete"	=> "1"
						);
			$where	= "id='".$detail['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where,0);
			$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['INWARD_STORE_DELETE']." : ".$inward_store_no);
			if($uid)
			{
				$inward_store_r=$this->db->rp_getData("inward_store_item","*","inward_store_id='".$detail['id']."'","",0);
			
				if($inward_store_r){
					$inward_store_d=array();
					while($inward_store_d=mysqli_fetch_assoc($inward_store_r)){
						$inward_store_items[]=$inward_store_d;
					}
					foreach($inward_store_items as $item){
						$inward_store_item_received_qty=$item['inward_store_item_received_qty'];
					
						$purchase_order_item_id=$item['purchase_order_item_id'];
						$inward_store_item_id=$item['id'];
						
						
				
					$po_item_r=$this->db->rp_getData("purchase_order_item","*","id='".$purchase_order_item_id."'","",0);
						if($po_item_r)
						{
							$issue_item=array();
							$po_item_d=mysqli_fetch_assoc($po_item_r);
								
								$purchase_order_item_received_qty=$po_item_d['purchase_order_item_received_qty'];
								$purchase_order_item_remaining_qty=$po_item_d['purchase_order_item_remaining_qty'];
								
							
							$remaining_qty=$purchase_order_item_remaining_qty+$inward_store_item_received_qty;
							$received_qty=$purchase_order_item_received_qty-$inward_store_item_received_qty;
							
							$rows 	= array(
										"purchase_order_item_received_qty"	=> $received_qty,
										"purchase_order_item_remaining_qty"	=> $remaining_qty
										);
								
							$UpdateIssueItem=$this->db->rp_update("purchase_order_item",$rows,"id='".$purchase_order_item_id."'",0);
							$this->db->rp_update("inward_store_item",array("inward_store_item_received_qty"=>0),"id='".$inward_store_item_id."'",0);
									
							if($UpdateIssueItem){
								$this->updateItemStatus($inward_store_item_id);
							}
						}
						
						$old_item_type=$item['inward_store_item_type'];
						$old_item_id=$item['inward_store_item_id'];
						$old_item_inwarded_qty=$item['inward_store_item_received_qty'];
						$old_item_name=$item['inward_store_item_name'];
						if($old_item_type=="row_material")
						{
							$current_stock=$this->db->rp_getValue($this->ctableProduct,"stock_qty","id='".$old_item_id."'");
							$new_stock=$current_stock-$old_item_inwarded_qty;
							$this->db->rp_update($this->ctableProduct,array("stock_qty"=>$new_stock),"id='".$old_item_id."'");
						}
						else if($old_item_type=="semi_finish_good")
						{
							$current_stock=$this->db->rp_getValue($this->ctableProduct,"stock_qty","id='".$old_item_id."'");
							$new_stock=$current_stock-$old_item_inwarded_qty;
							$this->db->rp_update($this->ctableProduct,array("stock_qty"=>$new_stock),"id='".$old_item_id."'");
						}	
						else if($old_item_type=="finish_good")
						{
							$current_stock=$this->db->rp_getValue($this->ctableProduct,"stock_qty","id='".$old_item_id."'");
							$new_stock=$current_stock-$old_item_inwarded_qty;
							$this->db->rp_update($this->ctableProduct,array("stock_qty"=>$new_stock),"id='".$old_item_id."'");
						}
					}
					
				}
				
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('INWARD_STORE_DELETE',1),"ack_msg"=>$this->log->getMessage('INWARD_STORE_DELETE'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('INWARD_STORE_UPDATE_FAILED',1),"ack_msg"=>$this->log->getMessage('INWARD_STORE_UPDATE_FAILED'));
			}
		}
		else{
			$reply=array("ack"=>0,"developer_msg"=>"Inwarded Item already used could not delete.","ack_msg"=>"Inwarded Item already used could not delete. <br/>".implode("<br/>",$checkResult['error']));
			return $reply;
		}
		
	}

	public function ReceivedQty($purchase_order_id,$purchase_order_item_id){
		
		$inward_store_id=$this->db->rp_getData($this->ctable,"id","purchase_order_id='".$purchase_order_id."'","",0);
		if($inward_store_id)
		{
			$received_qty_r=$this->db->rp_getData("inward_store_item","SUM(inward_store_item_received_qty) as total_received_qty","purchase_order_id='".$purchase_order_id."' AND purchase_order_item_id='".$purchase_order_item_id."'","",0);
			$receive_qty_d=mysqli_fetch_assoc($received_qty_r);
			$receive_qty_d['total_received_qty']; 
			return  $receive_qty_d['total_received_qty'];
		
		}
		else
		{
			return 0;
		}
		
	}
	
	// status update
	function updateItemStatus($inward_store_item_id)
	{
		// detail of inward store item table
		$inward_store_items=$this->db->rp_getData("inward_store_item","*","id='".$inward_store_item_id."'","",0);
		$inward_item=mysqli_fetch_assoc($inward_store_items);
		
		// detail of purchase order item table
		$po_items=$this->db->rp_getData("purchase_order_item","*","id='".$inward_item['purchase_order_item_id']."' AND purchase_order_id='".$inward_item['purchase_order_id']."'","",0);
		//$status=1;
		if($po_items)			
		{		
				while($po_item=mysqli_fetch_assoc($po_items)){
				
				$purchase_order_item_received_qty=$po_item['purchase_order_item_qty'];
						// Check how much qty transffered
						
				$received_qty=$this->db->rp_getValue("inward_store_item","SUM(inward_store_item_received_qty)","purchase_order_id='".$po_item['purchase_order_id']."' AND purchase_order_item_id='".$po_item['id']."'",0);
				echo $purchase_order_item_received_qty;
			echo	 $received_qty;
			echo	$remaining_qty=$purchase_order_item_received_qty-$received_qty;
				
				
					if($remaining_qty==0)
					{
						$status=1;	
					}
					else{
						$status=0;	
					}
					
					// update purchase order item status
					$this->db->rp_update("purchase_order_item",array("status"=>$status),"id='".$inward_item['purchase_order_item_id']."' AND purchase_order_id='".$inward_item['purchase_order_id']."'",0);
					
					// update Inward store item status
					$this->db->rp_update("inward_store_item",array("inward_status"=>$status),"purchase_order_id='".$po_item['purchase_order_id']."' AND purchase_order_item_id='".$po_item['id']."'",0);
				}
				// update purchase order info status Change by Ravi Shiroya - 04-09-2017
				$return_pending_status=$this->db->rp_getTotalRecord("purchase_order_item","purchase_order_id='".$inward_item['purchase_order_id']."' AND status=0",0);
				if($return_pending_status>=1)
				{		
					//$status=2;	
					$status=1;	
				}
				else
				{
					//$status=1;
					$status=2;
					
				}
				$this->db->rp_update("purchase_order",array("purchase_order_status"=>$status),"id='".$inward_item['purchase_order_id']."'",0);
				$this->updateInwardStoreStatus($inward_item['purchase_order_id']);
				return true;
		}
		return false;
	}
	public function updateInwardStoreStatus($purchase_order_id)
	{
			
		$return_pending_status=$this->db->rp_getTotalRecord("inward_store_item","purchase_order_id='".$purchase_order_id."' AND inward_status=0",0);
		if($return_pending_status>=1)
		{		
			$status=0;	
		}
		else
		{
			$status=2;
			
		}
		$this->db->rp_update("inward_store",array("inward_store_status"=>$status),"purchase_order_id='".$purchase_order_id."'",0);
		return true;
	}
	public function checkOldItemUsage($inward_store_id)
	{
		$error=array();
		$isValid=true;
		$old_items=$this->db->rp_getData($this->ctableInwardStoreItem,"*","inward_store_id='".$inward_store_id."' AND isDelete=0","",0);
		if($old_items)
		{
			while($old_item=mysqli_fetch_assoc($old_items))
			{
				$old_item_type=$old_item['inward_store_item_type'];
				$old_item_id=$old_item['inward_store_item_id'];
				$old_item_inwarded_qty=$old_item['inward_store_item_received_qty'];
				$old_item_name=$old_item['inward_store_item_name'];
				if($old_item_type=="row_material")
				{
					$current_stock=$this->db->rp_getValue($this->ctableProduct,"stock_qty","id='".$old_item_id."'");
					if($current_stock-$old_item_inwarded_qty<0)
					{
						$error[]="Item ".$old_item_name." inwarded qty already used you cannot edit qty more than ".$current_stock;
						$isValid=false;
					}
				}
				else if($old_item_type=="semi_finish_good")
				{
					$current_stock=$this->db->rp_getValue($this->ctableProduct,"stock_qty","id='".$old_item_id."'");
					if($current_stock-$old_item_inwarded_qty<0)
					{
						$error[]="Item ".$old_item_name." inwarded qty already used you cannot edit qty more than ".$current_stock;
						$isValid=false;
					}
				}	
				else if($old_item_type=="finish_good")
				{
					$current_stock=$this->db->rp_getValue($this->ctableProduct,"stock_qty","id='".$old_item_id."'");
					if($current_stock-$old_item_inwarded_qty<0)
					{
						$error[]="Item ".$old_item_name." inwarded qty already used you cannot edit qty more than ".$current_stock;
						$isValid=false;
					}
				}
			}
		}
		
		return array("isValid"=>$isValid,"error"=>$error);
	}

	///////////////////// Planning Inward Item
	public function InsertPlanningInwardStore($detail,$item)
	{
		//print_r($item); exit;	
		extract($detail);
	
		$total_qty=0;
		$grand_total=0;
		$get_vendor=$this->db->rp_getData("vendor","*","id='".$inward_store_vendor_id."'");
		$vender_d=mysqli_fetch_assoc($get_vendor);
		
			$inward_store_vendor_name=$vender_d['vendor_name'];
			$inward_store_vendor_contact_no=$vender_d['vendor_contact_no'];
			$inward_store_vendor_email=$vender_d['vendor_email'];
			$inward_store_vendor_address=$vender_d['vendor_address'];
			$inward_store_vendor_city=$vender_d['vendor_city'];
			$inward_store_vendor_state=$vender_d['vendor_state'];
			$inward_store_vendor_country=$vender_d['vendor_country'];
			$inward_store_no=IS_NO."00".$this->db->getlastInsertId($this->ctable);
		
			
				$adate	= date('Y-m-d H:i:s');
				$inward_store_date	= date('Y-m-d');
				$rows 	= array(
							"planning_id",
							"planning_type",
							"inward_store_no",
							"inward_store_vendor_id",
							"inward_store_vendor_name",
							"inward_store_vendor_city",
							"inward_store_vendor_state",
							"inward_store_vendor_country",
							"inward_store_vendor_address",
							"inward_store_vendor_contact_no",
							"inward_store_vendor_email",
							"purchase_order_id",
							"created_date",
							"inward_store_date",
							"isDelete"
						);
				$values = array(
							$planning_id,
							1,
							$inward_store_no,
							$inward_store_vendor_id,
							$inward_store_vendor_name,
							$inward_store_vendor_city,
							$inward_store_vendor_state,
							$inward_store_vendor_country,
							$inward_store_vendor_address,
							$inward_store_vendor_contact_no,
							$inward_store_vendor_email,
							$purchase_order_id,
							$adate,
							$inward_store_date,
							$isDelete
						);
						
				$inward_store_id = $this->db->rp_insert($this->ctable,$values,$rows,0);
				

			
			if($inward_store_id!=0)
			{
				$grand_total=0;
				
			// Insert Purchase Item
				if(!empty($item))
				{
					// For loop
					for($i=0;$i<sizeof($item);$i++)
					{
						$current_item=$item[$i]; 
						
						
							$po_items=$this->db->rp_getData("create_inward_note","*","id='".$current_item['inward_note_item_id']."'");
							
							$po_item = mysqli_fetch_assoc($po_items);
							$subtotal=$po_item['planning_item_price']*$current_item['inward_store_item_received_qty'];
							
							
							if($current_item['inward_store_item_received_qty']<=$po_item['planning_item_qty'])
							{
								$adate	= date('Y-m-d H:i:s');
								$rows 	= array(
								"planning_id",
								"planning_type",
								"inward_store_id",
								"purchase_order_id",
								"purchase_order_item_id",
								"inward_store_item_id",
								"inward_store_item_name",
								"inward_store_item_code",
								"inward_store_item_type",
								"inward_store_item_received_qty",
								"remain_to_locate_qty",
								"inward_store_item_price",
								"inward_store_item_sub_total",
								"purchase_order_item_order_qty",
								"created_date",								
								"isDelete"
							);
							$values = array(
								$planning_id,	
								1,	
								$inward_store_id,	
								$po_item['id'],	
								$current_item['inward_note_item_id'],
								$po_item['planning_item_id'],
								$po_item['planning_item_name'],
								$po_item['planning_item_code'],
								$po_item['planning_item_type'],
								$current_item['inward_store_item_received_qty'],
								$current_item['inward_store_item_received_qty'],
								$po_item['planning_item_price'],
								$subtotal,
								$po_item['planning_item_qty'],
								$adate,
								0
							);	
						$grand_total+=$subtotal;						
						if($current_item['inward_store_item_received_qty']!=0){
							$inward_store_item_id = $this->db->rp_insert("inward_store_item",$values,$rows,0);
							
							// Update Purchase Order Item Received Qty
							$planning_item_received_qty=$po_item['planning_item_received_qty']+$current_item['inward_store_item_received_qty'];
							
							$planning_item_remaining_qty=$po_item['planning_item_remaining_qty']-$current_item['inward_store_item_received_qty'];
				
							$isUpdatedPOItem=$this->db->rp_update("create_inward_note",array("planning_item_received_qty"=>$planning_item_received_qty,"planning_item_remaining_qty"=>$planning_item_remaining_qty),"id='".$current_item['inward_note_item_id']."'",0);
							
							/// Update all table status
							$this->updatePlanningItemStatus($inward_store_item_id);
							$this->updatePlanningStatus($planning_id);
						}
					}
					/*
					///// Update stock in items table
					if($po_item['planning_item_type']=="row_material")
					{	$ctable1='item_rm';
						$where = " id='".$po_item['planning_item_id']."' AND isDelete=0";
						$item_info = $this->db->rp_getData("item_rm","*",$where,"",0);
					
						if($item_info)
						{
							$item_info=mysqli_fetch_assoc($item_info);
							$item_id=$item_info['id'];
							$current_stock=$item_info['stock_qty'];
							
							$stock_qty=$current_stock+$current_item['inward_store_item_received_qty'];
							$this->db->rp_update($ctable1,array("stock_qty"=>$stock_qty),"id='".$item_id."'",0);
						}
					}
					else if($po_item['planning_item_type']=="finish_good")
					{ 
						 $ctable1='item_fg'; 
						 $where = " id='".$po_item['planning_item_id']."' AND isDelete=0";
						$item_info = $this->db->rp_getData($ctable1,"*",$where,0);
						if($item_info)
						{
							$item_info=mysqli_fetch_assoc($item_info);
							$item_id=$item_info['id'];
							$current_stock=$item_info['stock_qty'];
							
							$stock_qty=$current_stock+$current_item['inward_store_item_received_qty'];
							$this->db->rp_update($ctable1,array("stock_qty"=>$stock_qty),"id='".$item_id."'",0);
						}
					}
					else if($po_item['planning_item_type']=="semi_finish_good")
					{
						$ctable1='item_sfg';
						$where = " id='".$po_item['planning_item_id']."' AND isDelete=0";
						$item_info = $this->db->rp_getData($ctable1,"*",$where,0);
						if($item_info)
						{
							$item_info=mysqli_fetch_assoc($item_info);
							$item_id=$item_info['id'];
							$current_stock=$item_info['stock_qty'];
							
							$stock_qty=$current_stock+$current_item['inward_store_item_received_qty'];
							$this->db->rp_update($ctable1,array("stock_qty"=>$stock_qty),"id='".$item_id."'");
						}
					}*/
				}
				}
				$rows 	= array(
						"inward_store_grand_total"				=> $grand_total,
						
						);
						 $where	= "id='".$inward_store_id."'";
						$isUpdated1=$this->db->rp_update("inward_store",$rows,$where,0);
									
				//$this->updatePurchaseOrderItemStatus($po_no);
				$reply=array("ack"=>1,"developer_msg"=>"Store Item Added.","ack_msg"=>"Success!Inward Store Insert Successfully.","inward_store_id"=>$inward_store_id);
				return $reply;
						
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Inward Store added Failed.");
				return $reply;
			}
			
	//	function inward_store_item_received_qty($po_id,$category_id,$product_id);
	}
	function updatePlanningItemStatus($inward_store_item_id)
	{
		// detail of inward store item table
		$inward_store_items=$this->db->rp_getData("inward_store_item","*","id='".$inward_store_item_id."'","",0);
		$inward_item=mysqli_fetch_assoc($inward_store_items);
		
		// detail of purchase order item table
		$po_items=$this->db->rp_getData("purchase_order_item","*","id='".$inward_item['purchase_order_item_id']."' AND purchase_order_id='".$inward_item['purchase_order_id']."'","",0);
		//$status=1;
		if($po_items)			
		{		
				while($po_item=mysqli_fetch_assoc($po_items)){
				
				$purchase_order_item_received_qty=$po_item['purchase_order_item_qty'];
						// Check how much qty transffered
						
				$received_qty=$this->db->rp_getValue("inward_store_item","SUM(inward_store_item_received_qty)","purchase_order_id='".$po_item['purchase_order_id']."' AND purchase_order_item_id='".$po_item['id']."'",0);
				$remaining_qty=$purchase_order_item_received_qty-$received_qty;
				
				
					if($remaining_qty==0)
					{
						$status=1;	
					}
					else{
						$status=0;	
					}
					
					// update purchase order item status
					$this->db->rp_update("purchase_order_item",array("status"=>$status),"id='".$inward_item['purchase_order_item_id']."' AND purchase_order_id='".$inward_item['purchase_order_id']."'",0);
					
					// update Inward store item status
					$this->db->rp_update("inward_store_item",array("inward_status"=>$status),"purchase_order_id='".$po_item['purchase_order_id']."' AND purchase_order_item_id='".$po_item['id']."'",0);
				}
				// update purchase order info status
				$return_pending_status=$this->db->rp_getTotalRecord("purchase_order_item","purchase_order_id='".$inward_item['purchase_order_id']."' AND status=0",0);
				if($return_pending_status>=1)
				{		
					$status=0;	
				}
				else
				{
					$status=1;
					
				}
				$this->db->rp_update("purchase_order",array("purchase_order_status"=>$status),"id='".$inward_item['purchase_order_id']."'",0);
				$this->updateInwardStoreStatus($inward_item['purchase_order_id']);
				return true;
		}
		return false;
	}
	function updatePlanningStatus($planning_id)
	{
		
		$gatherAllPlanningInwardNotesQty=$this->db->rp_getValue("create_inward_note","SUM(production_qty)","planning_info_id='".$planning_id."' AND isDelete=0");
		$actualPlanningQty=$this->db->rp_getValue("planning_info","item_planning_qty","id='".$planning_id."'");
		$planning_status=$this->db->rp_getValue("planning_info","planning_status","id='".$planning_id."'");
		$gatherAllPlanningInwardNotesQty=floatval($gatherAllPlanningInwardNotesQty);
		$actualPlanningQty=floatval($actualPlanningQty);
		$remaining_qty=$actualPlanningQty-$gatherAllPlanningInwardNotesQty;
		
		
		if($remaining_qty<=0)
		{
			$remaining_qty=0;
			$planning_status=4;
		}
		$this->db->rp_update("planning_info",array("planning_status"=>$planning_status,"item_remaining_qty"=>$remaining_qty),"id='".$planning_id."'",0);
		
		
	}
	public function DeleteInwardStoreWithPlanning($detail)
	{
		// Check whether inwarded item already used or not
		$checkResult=$this->checkOldItemUsage($detail['id']);
		$inward_store_no=$this->db->rp_getValue($this->ctable,"inward_store_no","isDelete=0 AND id='".$detail['id']."'");
		if($checkResult['isValid'])
		{
			$rows 	= array(
						"isDelete"	=> "1"
						);
			$where	= "id='".$detail['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where,0);
			$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['INWARD_STORE_DELETE']." : ".$inward_store_no);
			if($uid)
			{
				$inward_store_r=$this->db->rp_getData("inward_store_item","*","inward_store_id='".$detail['id']."'","",0);
			
				if($inward_store_r){
					$inward_store_d=array();
					while($inward_store_d=mysqli_fetch_assoc($inward_store_r)){
						$inward_store_items[]=$inward_store_d;
					}
					foreach($inward_store_items as $item){
						$inward_store_item_received_qty=$item['inward_store_item_received_qty'];
					
						$purchase_order_item_id=$item['purchase_order_item_id'];
						$inward_store_item_id=$item['id'];
						
						/*$po_item_r=$this->db->rp_getData("purchase_order_item","*","id='".$purchase_order_item_id."'","",0);
						if($po_item_r)
						{
							$issue_item=array();
							$po_item_d=mysqli_fetch_assoc($po_item_r);
								
								$purchase_order_item_received_qty=$po_item_d['purchase_order_item_received_qty'];
								$purchase_order_item_remaining_qty=$po_item_d['purchase_order_item_remaining_qty'];
								
							
							$remaining_qty=$purchase_order_item_remaining_qty+$inward_store_item_received_qty;
							$received_qty=$purchase_order_item_received_qty-$inward_store_item_received_qty;
							
							$rows 	= array(
										"purchase_order_item_received_qty"	=> $received_qty,
										"purchase_order_item_remaining_qty"	=> $remaining_qty
										);
								
							$UpdateIssueItem=$this->db->rp_update("purchase_order_item",$rows,"id='".$purchase_order_item_id."'",0);
							$this->db->rp_update("inward_store_item",array("inward_store_item_received_qty"=>0),"id='".$inward_store_item_id."'",0);
									
							if($UpdateIssueItem){
								$this->updateItemStatus($inward_store_item_id);
							}
						}*/
						
						$old_item_type=$item['inward_store_item_type'];
						$old_item_id=$item['inward_store_item_id'];
						$old_item_inwarded_qty=$item['inward_store_item_received_qty'];
						$old_item_name=$item['inward_store_item_name'];
						if($old_item_type=="row_material")
						{
							$current_stock=$this->db->rp_getValue($this->ctableProduct,"stock_qty","id='".$old_item_id."'");
							$new_stock=$current_stock-$old_item_inwarded_qty;
							$this->db->rp_update($this->ctableProduct,array("stock_qty"=>$new_stock),"id='".$old_item_id."'");
						}
						else if($old_item_type=="semi_finish_good")
						{
							$current_stock=$this->db->rp_getValue($this->ctableProduct,"sstock_qty","id='".$old_item_id."'");
							$new_stock=$current_stock-$old_item_inwarded_qty;
							$this->db->rp_update($this->ctableProduct,array("stock_qty"=>$new_stock),"id='".$old_item_id."'");
						}	
						else if($old_item_type=="finish_good")
						{
							$current_stock=$this->db->rp_getValue($this->ctableProduct,"stock_qty","id='".$old_item_id."'");
							$new_stock=$current_stock-$old_item_inwarded_qty;
							$this->db->rp_update($this->ctableProduct,array("stock_qty"=>$new_stock),"id='".$old_item_id."'");
						}
					}
					
				}
				
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('INWARD_STORE_DELETE',1),"ack_msg"=>$this->log->getMessage('INWARD_STORE_DELETE'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Delete record Failed.");
				return $reply;
			}
		}
		else{
			$reply=array("ack"=>0,"developer_msg"=>"Inwarded Item already used could not delete.","ack_msg"=>"Inwarded Item already used could not delete. <br/>".implode("<br/>",$checkResult['error']));
			return $reply;
		}
		
	}
}

?>