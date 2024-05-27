<?php
require_once("../include/class.system.php");
class Dispatch extends Functions
{
	
	public $ctableOrder              ="order_detail";
	public $ctableOrderProductItem   ="order_item";
	public $ctableDispatch           ="dispatch_info";
	public $ctableDispatchItem       ="dispatch_item";
	
	public $order_status             = array("1"=>"Order Placed","2"=>"Partial Dispatch","3"=>"Complete Order Dispatch","4"=>"Oreder Cancel");
	public $dispatchStatus           =array(0=>"Order received",1=>"Prepared",2=>"Partial Dispatched",3=>"Completed");
	public $dispatchType           =array(0=>"Truck",1=>"Logistic",2=>"Train",3=>"Bus","4"=>"Courier");
	function __construct() {
	   $db                           = new Functions();
	   $conn                         = $db->connect();
	   $this->db                     =$db;
	   $this->objSystem 			 = new System();
	   $this->log 			 		 = new Log();
	}
	function AddactualDispatch($detail,$item)
	{
			extract($detail);
			if(!empty($detail))
			{
				
				$dispatch_actual_special_note=$dispatch_actual_special_note?$dispatch_actual_special_note:"";
				$dispatch_inform_to=$dispatch_inform_to?$dispatch_inform_to:"";
				$dispatch_collect_invoice=$dispatch_collect_invoice?$dispatch_collect_invoice:"";
				$dispatch_goods_per_order=$dispatch_goods_per_order?$dispatch_goods_per_order:"";
				$mode_url  = $mode;
				$dispatch_order_id=$dispatch_id;
				$order_id=$this->db->rp_getValue("dispatch_info","order_id","id='".$dispatch_order_id."'",0);
				$this->finalDispatch($dispatch_order_id,$dispatch_actual_driver_name,$dispatch_actual_driver_number,$dispatch_actual_date,$dispatch_actual_transport_type,$dispatch_actual_lr_no,$dispatch_actual_vehical_number,$dispatch_actual_special_note,$dispatch_inform_to,$dispatch_collect_invoice,$dispatch_goods_per_order);
				
				if($mode_url!=1){
					$dispatch_items=$this->db->rp_getData("dispatch_item","*","dispatch_id='".$dispatch_order_id."'","",0);
					if($dispatch_items){
						while($dispatch_item=mysqli_fetch_assoc($dispatch_items)){
							$order_dispatched_qty=$this->db->rp_getValue("order_item","order_item_actual_dispatched_qty","order_id='".$dispatch_item['order_id']."' AND order_item_id='".$dispatch_item['dispatch_item_id']."'",0);
							$dispatch_item_qty=$order_dispatched_qty+$dispatch_item['dispatch_item_qty'];
							
							$this->db->rp_update("order_item",array("order_item_actual_dispatched_qty"=>$dispatch_item_qty),"order_id='".$dispatch_item['order_id']."' AND order_item_id='".$dispatch_item['dispatch_item_id']."'",0);
						}
							
					}
				}
				
				if(!empty($item))
				{
						
					$order_item=array();
					foreach($item as $i)
					{
						$store_items=json_decode($i,true);
					
						foreach($store_items as $current_item)
						{
							
							$store_name=$this->db->rp_getValue("store_master","store_name","id='".$current_item['store_id']."'");
							$product_name=$this->db->rp_getValue("product","display_name","id='".$current_item['item_id']."'");
							$adate	= date('Y-m-d H:i:s');
								$rows 	= array(
								"dispatch_id",
								"product_id",
								"store_id",
								"product_name",
								"store_name",
								"dispatch_qty",
								"created_date"
							);
							$values = array(
								$dispatch_id,
								$current_item['item_id'],
								$current_item['store_id'],
								$product_name,
								$store_name,
								$current_item['qty'],
								$adate,
							);
							$order_item_id = $this->db->rp_insert("dispatch_product_store_item",$values,$rows,0);
							
							//update order item table disaptch qty
							$dispatch_item=$this->db->rp_getData("dispatch_item","*","dispatch_id='".$dispatch_id."'"); 
							while($items=mysqli_fetch_assoc($dispatch_item))
							{
								$isUpdated=$this->db->rp_update("order_item",array("order_item_dispatched_qty"=>$current_item['qty']),"id='".$items['order_item_id']."'");
							}
							// update main store qty
							$getstock_qty = $this->db->rp_getValue("product_store_item","stock_qty","product_id='".$current_item['item_id']."' AND store_id='".$current_item['store_id']."'");
							
							$final_qty=$getstock_qty-$current_item['qty'];
							$isUpdated=$this->db->rp_update("product_store_item",array("stock_qty"=>$final_qty),"product_id='".$current_item['item_id']."' AND store_id='".$current_item['store_id']."'",0);
						}
						
					}
					
				}
				$this->updateProductItemStatus($order_id);
				$response=array('ack'=>1,'ack_msg'=>'Dispatch order status changed to dispatched!!','order_id'=>$order_id);
				return $response;
			}
			else
			{				
				$response=array('ack'=>0,'ack_msg'=>'Something went wrong Try Again!!');
				return $response;
			}
		   
	  
	}
	function UpdateactualDispatch($detail)
	{
			
			
			if(!empty($detail))
			{
				extract($detail);
		
				$order_id=$this->db->rp_getValue("dispatch_info","order_id","id='".$dispatch_order_id."'",0);
				$this->finalDispatchupdate($dispatch_id,$dispatch_actual_driver_name,$dispatch_actual_driver_number,$dispatch_actual_date,$dispatch_actual_transport_type,$dispatch_actual_lr_no,$dispatch_actual_vehical_number,$dispatch_actual_special_note,$dispatch_inform_to,$dispatch_collect_invoice,$dispatch_goods_per_order,$dispatch_suggested_transportation,
				$dispatch_packing_standard,		
				$dispatch_transport_charge,	
				$dispatch_payment_recieve);
				
				$response=array('ack'=>1,'ack_msg'=>'Dispatch Detail Updated Successfully!!','order_id'=>$order_id);
				return $response;
			}
			else
			{				
				$response=array('ack'=>0,'ack_msg'=>'Something went wrong Try Again!!');
				return $response;
			}
		   
	  
		}
	function addDispatchDetail($order_detail,$products,$remarks)
	{
		//echo "asdasd"; exit;
		$detail['dispatch_actual_driver_name']	=$order_detail['dispatch_actual_driver_name'];
		$detail['dispatch_actual_driver_number']=$order_detail['dispatch_actual_driver_number'];
		$detail['dispatch_actual_transport_type']	=$order_detail['dispatch_actual_transport_type'];
		$detail['dispatch_actual_lr_no']	=$order_detail['dispatch_actual_lr_no'];
		$detail['dispatch_actual_vehical_number']	=$order_detail['dispatch_actual_vehical_number'];
		$detail['dispatch_actual_special_note']		=$order_detail['dispatch_actual_special_note'];
		$detail['dispatch_inform_to']	=$order_detail['dispatch_inform_to'];
		$detail['dispatch_collect_invoice']		=$order_detail['dispatch_collect_invoice'];
		$detail['dispatch_goods_per_order']		=$order_detail['dispatch_goods_per_order'];
		
		$order_id=$order_detail['order_id'];
		$dispatch_customer_address=$order_detail['dispatch_customer_address'];
		$dispatch_customer_city=$order_detail['dispatch_customer_city'];
		$dispatch_customer_state=$order_detail['dispatch_customer_state'];
		$dispatch_customer_country=$order_detail['dispatch_customer_country'];
		$dispatch_customer_pincode=$order_detail['dispatch_customer_pincode'];
		$dispatch_customer_gst_no=$order_detail['dispatch_customer_gst_no'];
		
		$dispatch_billing_name=$order_detail['dispatch_billing_name'];
		$dispatch_billing_phone=$order_detail['dispatch_billing_phone'];
		$dispatch_billing_city=$order_detail['dispatch_billing_city'];
		$dispatch_billing_state=$order_detail['dispatch_billing_state'];
		$dispatch_billing_country=$order_detail['dispatch_billing_country'];
		$dispatch_billing_address=$order_detail['dispatch_billing_address'];
		$dispatch_billing_pincode=$order_detail['dispatch_billing_pincode'];
		$dispatch_gst_no=$order_detail['dispatch_billing_gst_no'];
		
		$dispatch_date=$order_detail['dispatch_date'];	
		$payment_due_date=$order_detail['payment_due_date'];	
		$dispatch_suggested_transportation=$order_detail['dispatch_suggested_transportation'];	
		$dispatch_packing_standard=$order_detail['dispatch_packing_standard'];		
		$dispatch_transport_charge=$order_detail['dispatch_transport_charge'];	
		//$dispatch_executive_incentive=$order_detail['dispatch_executive_incentive'];	
		$dispatch_payment_recieve=$order_detail['dispatch_payment_recieve'];	
		$order_status=$this->getOrderStatus($order_id);
		if($order_status>=1)
		{	
			$error=array();
			// Enter Dispatch Information First Which Hold Information about Single Dispatch
			$dispatch_details=$this->getDispatchInformation($order_id);
			$total_dispatched_qty_till_date=$dispatch_details['total_dispatched_qty'];	// This is Qty which is dispatched till today
			//$today_dispatched_qty= $this->sumOfArray($qtys);  	// This is Qty which is dispatched today in current cargo
			$today_remaining_qty= $dispatch_details['remaining_qty'];// This is Qty which is remaining before current cargo dispatched
			$order_details=$this->getOrderDetail($order_id);
			$dispatch_no=DP_NO."00/".$this->db->getlastInsertId($this->ctableDispatch);
			// Insert Dispatch
			$dispatch_info_columns=array("order_id",
										 "dispatch_no",
										 "dispatch_customer_gst_no",
										 "dispatch_gst_no",
										 //"dispatched_qty",
										 "dispatch_cid",
										 "dispatch_customer_name",
										 "dispatch_customer_address",
										 "dispatch_customer_phone",
										 "dispatch_customer_pincode",
										 "dispatch_customer_city",
										 "dispatch_customer_state",
										 "dispatch_customer_country",
										 "dispatch_billing_address",
										 "dispatch_billing_pincode",
										 "dispatch_billing_name",
										 "dispatch_billing_phone",
										 "dispatch_billing_city",
										 "dispatch_billing_state",
										 "dispatch_billing_country",
										 "dispatch_date",
										 "payment_due_date",
										 "dispatch_suggested_transportation",
										 "dispatch_packing_standard",	
										 "dispatch_transport_charge",
										 "dispatch_payment_recieve",
										 "created_date"
										 );
			$dispatch_info_values=array( $order_id,
										 $dispatch_no,
										 $dispatch_customer_gst_no,
										 $dispatch_gst_no,
										 //$today_dispatched_qty,
										 $order_details['cid'],
										 $order_details['customer_name'],
										 $dispatch_customer_address,
										 $order_details['customer_phone'],
										 $dispatch_customer_pincode,
										 $dispatch_customer_city,
										 $dispatch_customer_state,
										 $dispatch_customer_country,
										 $dispatch_billing_address,
										 $dispatch_billing_pincode,
										 $dispatch_billing_name,
										 $dispatch_billing_phone,
										 $dispatch_billing_city,
										 $dispatch_billing_state,
										 $dispatch_billing_country,
										 date("Y-m-d",strtotime($dispatch_date)),
										 date("Y-m-d",strtotime($payment_due_date)),
										 $dispatch_suggested_transportation,
										 $dispatch_packing_standard,
										 $dispatch_transport_charge,
										 $dispatch_payment_recieve,
										 date('Y-m-d H:i:s'));
			$dispatch_id=$this->db->rp_insert($this->ctableDispatch,$dispatch_info_values,$dispatch_info_columns,0);
			$detail['dispatch_id']=$dispatch_id;
			$val=array("order_status"=>2,"modify_date"=>date("Y-m-d H:i:s"));
			$this->db->rp_update($this->ctableOrder,$val,"id='".$order_id."'");
			
			$total_amount=0;
			// Now Insert Dispatch Item to Item Table
			//print_r($products); exit;
			foreach($products as $product)
			{
				
				$product_id=0;
				$qty=0;
				$product_from_store=json_decode($product,true);
				//print_r($product_from_store); 
				foreach($product_from_store as $store_item)
				{
					$product_id=$store_item['item_id'];
					$qty=$qty+$store_item['qty'];
				}
			
				if($product_id!=0 && $qty!=0)
				{
						
					$product_detail=$this->getProductDetails($order_id,$product_id);
					//print_r($product_detail);
					if($product_detail)
					{
						//echo "dasd";
						if($qty<=$product_detail['order_item_remaining_qty'])
						{
							$pid=$product_id;
							$current_qty=$qty;
							$current_remarks="";
							$order_qty=$product_detail['order_item_qty'];
							$today_dispatched_qty +=$current_qty;
							$dispatched_qty   =intval($product_detail['order_item_dispatched_qty'])+intval($qty);
							$new_remaining_qty=intval($product_detail['order_item_remaining_qty'])-intval($qty);
							//display name.. 
							$item_name=$product_detail['order_item_name'];
							// Original name..
							$item_display_name=$product_detail['order_item_display_name'];
							$item_code=$product_detail['order_item_code'];
							$item_original_price=$product_detail['order_item_original_price'];
							$item_price=$product_detail['order_item_selling_price'];
							$item_subtotal=$product_detail['order_item_selling_price']*$current_qty;
							$order_item_id=$product_detail['id'];
							$order_item_discount=$product_detail['order_item_discount'];
							$order_item_discount_amount=$product_detail['order_item_discount_amount'];
							
							//Dispatch Item						
							$dispatch_item_columns=array("order_id","dispatch_id","order_item_id","dispatch_item_name","dispatch_item_display_name","dispatch_item_code","dispatch_item_selling_price","dispatch_item_original_price","dispatch_item_sub_total","dispatch_item_id","dispatch_item_qty","order_qty","remaining_qty","remark","created_date","dispatch_item_discount","dispatch_item_discount_amount");
							$dispatch_item_values=array($order_id,$dispatch_id,$order_item_id,$item_name,$item_display_name,$item_code,$item_price,$item_original_price,$item_subtotal,$pid,$current_qty,$order_qty,$new_remaining_qty,$current_remarks,date('Y-m-d H:i:s'),$order_item_discount,$order_item_discount_amount);
							$dispatch_item_id=$this->db->rp_insert($this->ctableDispatchItem,$dispatch_item_values,$dispatch_item_columns,0);
							
							// Update In Order Item Table Remaining Qty.
							$this->db->rp_update($this->ctableOrderProductItem,array("order_item_dispatched_qty"=>$dispatched_qty,"order_item_remaining_qty"=>$new_remaining_qty),"id='".$product_detail['id']."'",0);
						}	
						else
						{
							$error[]="For Product ".$product_detail['order_item_name']." dispatch qty. entered exceeds remaining dispatch qty.";
							$this->db->rp_delete($this->ctableDispatch,"id='".$dispatch_id."'");
							$val=array("order_status"=>1);
							$this->db->rp_update($this->ctableOrder,$val,"id='".$order_id."'");
												
						}						
					}
					$total_amount += $item_subtotal;
				}
				
			}
			
			$isUpdated=$this->db->rp_update($this->ctableDispatch,array("dispatch_total_amount"=>$total_amount,"dispatched_qty"=>$today_dispatched_qty),"id='".$dispatch_id."'");	
			
			//$this->updateProductItemStatus($order_id);
			$data = $this->db->rp_getData($this->ctableDispatch,"*","id='".$dispatch_id."'");
			$result = mysqli_fetch_assoc($data);
			if(empty($error))
			{
				$reply=$this->AddactualDispatch($detail,$products);
				$ack=array("ack"=>1,
				"ack_msg"=>"Dispatch Order Successfully Saved!!",
				"developer_msg"=>"Order in valid state current state is".$order_status,
				"result"=>$result,"dispatch_id"=>$dispatch_id);
				return $ack;
			}
			else{
				$ack=array("ack"=>0,
				"ack_msg"=>implode("<br>",$error),
				"developer_msg"=>"Order not in valid state current state is".$order_status,
				"result"=>array(),
				);
				return $ack;
			}
			
		}
		else
		{
			
			$ack=array("ack"=>0,
			"ack_msg"=>" Either order not forwarded to dispatch or cancelled !!",
			"developer_msg"=>"Order not in valid state current state is".$order_status,
			"result"=>array(),
			);
			return $ack;
		}
	}
	
	function updateDispatchDetail($order_detail,$product_ids,$qtys,$remarks)
	{
		
		$order_id=$order_detail['order_id'];
		$dispatch_dealer_address=$order_detail['dispatch_dealer_address'];
		$dispatch_dealer_city=$order_detail['dispatch_customer_city'];
		$dispatch_dealer_state=$order_detail['dispatch_customer_state'];
		$dispatch_dealer_country=$order_detail['dispatch_customer_country'];
		$dispatch_dealer_pincode=$order_detail['dispatch_customer_pincode'];
		$dispatch_dealer_gst_no=$order_detail['dispatch_customer_gst_no'];
		
		$dispatch_billing_name=$order_detail['dispatch_billing_name'];
		$dispatch_billing_phone=$order_detail['dispatch_billing_phone'];
		//$dispatch_billing_email=$order_detail['dispatch_billing_email'];
		$dispatch_billing_city=$order_detail['dispatch_billing_city'];
		$dispatch_billing_state=$order_detail['dispatch_billing_state'];
		$dispatch_billing_country=$order_detail['dispatch_billing_country'];
		$dispatch_billing_address=$order_detail['dispatch_billing_address'];
		$dispatch_billing_pincode=$order_detail['dispatch_billing_pincode'];
		$dispatch_gst_no=$order_detail['dispatch_billing_gst_no'];
		
		$dispatch_date=$order_detail['dispatch_date'];	
		$payment_due_date=$order_detail['payment_due_date'];	
		$dispatch_suggested_transportation=$order_detail['dispatch_suggested_transportation'];	
		$dispatch_packing_standard=$order_detail['dispatch_packing_standard'];		
		$dispatch_transport_charge=$order_detail['dispatch_transport_charge'];	
		//$dispatch_executive_incentive=$order_detail['dispatch_executive_incentive'];	
		$dispatch_payment_recieve=$order_detail['dispatch_payment_recieve'];	
		$order_status=$this->getOrderStatus($order_id);
		if($order_status>=1)
		{	
			$error=array();
			// Enter Dispatch Information First Which Hold Information about Single Dispatch
			$dispatch_details=$this->getDispatchInformation($order_id);
			$total_dispatched_qty_till_date=$dispatch_details['total_dispatched_qty'];	// This is Qty which is dispatched till today
			//$today_dispatched_qty= $this->sumOfArray($qtys);  	// This is Qty which is dispatched today in current cargo
			$today_remaining_qty= $dispatch_details['remaining_qty'];// This is Qty which is remaining before current cargo dispatched
			$order_details=$this->getOrderDetail($order_id);
			$dispatch_no=DP_NO."00/".$this->db->getlastInsertId($this->ctableDispatch);
			// Insert Dispatch
			$dispatch_info_columns=array("order_id"=>$order_id,
										 "dispatch_no"=>$dispatch_no,
										 "dispatch_customer_gst_no"=>$dispatch_customer_gst_no,
										 "dispatch_gst_no"=>$dispatch_gst_no,
										 "dispatch_cid"=>$order_details['did'],
										 "dispatch_customer_name"=> $order_details['dealer_name'],
										 "dispatch_customer_address"=>$dispatch_customer_address,
										 "dispatch_customer_phone"=>$order_details['dealer_phone'],
										 "dispatch_customer_pincode"=>$dispatch_dealer_pincode,
										 "dispatch_customer_city"=>$dispatch_dealer_city,
										 "dispatch_customer_state"=>$dispatch_dealer_state,
										 "dispatch_customer_country"=>$dispatch_dealer_country,
										 "dispatch_billing_address"=>$dispatch_billing_address,
										 "dispatch_billing_pincode"=>$dispatch_billing_pincode,
										 "dispatch_billing_name"=>$dispatch_billing_name,
										 "dispatch_billing_phone"=>$dispatch_billing_phone,
										 "dispatch_billing_city"=>$dispatch_billing_city,
										 "dispatch_billing_state"=>$dispatch_billing_state,
										 "dispatch_billing_country"=>$dispatch_billing_country,
										 "dispatch_date"=>date("Y-m-d",strtotime($dispatch_date)),
										 "payment_due_date"=>date("Y-m-d",strtotime($payment_due_date)),
										 "dispatch_suggested_transportation"=>$dispatch_suggested_transportation,
										 "dispatch_packing_standard"=>$dispatch_packing_standard,	
										 "dispatch_transport_charge"=>$dispatch_transport_charge,
										 "dispatch_payment_recieve"=>$dispatch_payment_recieve,
										 "created_date"=>date('Y-m-d H:i:s'),
										 );
			
			$isUpdated=$this->db->rp_update($this->ctableDispatch,$dispatch_info_columns,"id='".$_REQUEST['dispatch_id']."'",0);
			
			//$val=array("order_status"=>2);
			//$this->db->rp_update($this->ctableOrder,$val,"id='".$order_id."'");
			
			
			// Now Insert Dispatch Item to Item Table
			$this->db->rp_delete($this->ctableDispatchItem,"dispatch_id='".$_REQUEST['dispatch_id']."'");
			$total_amount=0;
			for($i=0;$i<sizeof($product_ids);$i++)
			{
				$product_detail=$this->getProductDetails($order_id,$product_ids[$i]);
				
				if($product_detail)
				{
						$pid=$product_ids[$i];
						$current_qty=$qtys[$i];
						$current_remarks=$remarks[$i];
						$order_qty=$product_detail['order_item_qty'];
						// Display name
						$item_name=$product_detail['order_item_name'];
						// Original name
						$item_display_name=$product_detail['order_item_display_name'];
						$item_code=$product_detail['order_item_code'];
						$item_price=$product_detail['order_item_selling_price'];
						$item_subtotal=$product_detail['order_item_selling_price']*$current_qty;
						$order_item_id=$product_detail['id'];
						$order_item_discount=$product_detail['order_item_discount'];
						$order_item_discount_amount=$product_detail['order_item_discount_amount'];
						
						
						//Dispatch Item						
						$dispatch_item_columns=array("order_id","dispatch_id","order_item_id","dispatch_item_name","dispatch_item_display_name","dispatch_item_code","dispatch_item_selling_price","dispatch_item_sub_total","dispatch_item_id","dispatch_item_qty","order_qty","remark","created_date","disaptch_item_discount","disaptch_item_discount_amount");
						$dispatch_item_values=array($order_id,$_REQUEST['dispatch_id'],$order_item_id,$item_name,$item_display_name,$item_code,$item_price,$item_subtotal,$pid,$current_qty,$order_qty,$current_remarks,date('Y-m-d H:i:s'),$order_item_discount,$order_item_discount_amount);
						$dispatch_item_id=$this->db->rp_insert($this->ctableDispatchItem,$dispatch_item_values,$dispatch_item_columns,0);
						
						// Update In Order Item Table Remaining Qty.
						$order_item_received_qty=$this->ReceivedQty($order_id,$order_item_id); 
						$dispatched_qty   =intval($order_item_received_qty);
						$new_remaining_qty=intval($product_detail['order_item_qty'])-intval($order_item_received_qty);
						
						
						$this->db->rp_update($this->ctableOrderProductItem,array("order_item_dispatched_qty"=>$dispatched_qty,"order_item_remaining_qty"=>$new_remaining_qty),"id='".$product_detail['id']."'",0);
											
				}
				$total_amount += $item_subtotal;
			}
				$isUpdated=$this->db->rp_update($this->ctableDispatch,array("dispatch_total_amount"=>$total_amount),"id='".$dispatch_id."'");
			//$this->updateProductItemStatus($order_id);
			$data = $this->db->rp_getData($this->ctableDispatch,"*","id='".$dispatch_id."'");
			$result = mysqli_fetch_assoc($data);
			if(empty($error))
			{
					$ack=array("ack"=>1,
				"ack_msg"=>"Dispatch Order Successfully Saved!!",
				"developer_msg"=>"Order in valid state current state is".$order_status,
				"result"=>$result,
				);
				return $ack;
			}
			else{
				$ack=array("ack"=>0,
				"ack_msg"=>implode("<br>",$error),
				"developer_msg"=>"Order not in valid state current state is".$order_status,
				"result"=>array(),
				);
				return $ack;
			}
			
		}
		else
		{
			
			$ack=array("ack"=>0,
			"ack_msg"=>" Either order not forwarded to dispatch or cancelled !!",
			"developer_msg"=>"Order not in valid state current state is".$order_status,
			"result"=>array(),
			);
			return $ack;
		}
	}
	function getDispatchs($order_id)
	{
		$r = array();
		$data    = $this->db->rp_getData($this->ctableDispatch,"*","order_id= '".$order_id."' AND isDelete=0","dispatch_date DESC",0);
		if($data)
		{
			while($row = mysqli_fetch_assoc($data))
			{				
				$r[] = $row;
			}
			if(!empty($r))
			{
					$ack=array( "ack"=>1,
						"ack_msg"=>"Order detail Found!! !!",
						"developer_msg"=>"Order detail Found!!",
						"result"=>$r,
						);
						
						return $ack;
			}
			else
			{
					$ack=array( "ack"=>0,
						"ack_msg"=>"No data found !!",
						"developer_msg"=>"No found!!",
						"result"=>$r,
						);
						return $ack;
			}	
		}
		else
		{
			$ack=array( "ack"=>0,
						"ack_msg"=>"No data found !!",
						"developer_msg"=>"No found!!",
						"result"=>$r,
						);
						return $ack;
		}
		
	}
	function ReceivedQty($order_id,$order_item_id){
		
		$orders_id=$this->db->rp_getData($this->ctableDispatch,"id","order_id='".$order_id."'","",0);
		if($orders_id)
		{
			$received_qty_r=$this->db->rp_getData($this->ctableDispatchItem,"SUM(dispatch_item_qty) as total_received_qty","order_id='".$order_id."' AND order_item_id='".$order_item_id."'","",0);
			$receive_qty_d=mysqli_fetch_assoc($received_qty_r);
			$receive_qty_d['total_received_qty']; 
			return  $receive_qty_d['total_received_qty'];
		
		}
		else
		{
			return 0;
		}
		
	}
	function getProductDetails($order_id,$product_id)
	{
		$qty_details =$this->db->rp_getData($this->ctableOrderProductItem,"*","order_id='".$order_id."' AND order_item_id='".$product_id."'","",0);
		if($qty_details)
		{
			$qty_details=mysqli_fetch_assoc($qty_details);
			return $qty_details;
		}
		else
		{
			return false;
		}
		
	}
	// This Function will give you complete information how many dispatch made , how much qty still need to remaining, what is order qty etc..
	function getDispatchInformation($order_id)
	{
		
		$qty_details      =$this->db->rp_getData($this->ctableOrderProductItem,"SUM(order_item_qty) as total_order_qty,SUM(order_item_dispatched_qty) as total_dispatched_qty,SUM(order_item_remaining_qty) as order_item_remaining_qty ","order_id='".$order_id."'","",0);
		if($qty_details)
		{
			$last_dispatch_date=$this->db->rp_getValue($this->ctableDispatch,"MAX(created_date)","order_id='".$order_id."'");
			$total_dispatch_made_till_date=mysqli_num_rows($qty_details);
			// Fetch NOW
			$qty_details=mysqli_fetch_assoc($qty_details);
			$total_order_qty=$qty_details['total_order_qty'];
			$total_dispatched_qty=$qty_details['total_dispatched_qty'];
			$remaining_qty=$qty_details['order_item_remaining_qty'];
			$result=array(  "last_dispatch_date"=>$last_dispatch_date,
							"total_dispatch_made_till_date"=>$total_dispatch_made_till_date,
							"total_dispatched_qty"=>$total_dispatched_qty,
							"remaining_qty"=>$remaining_qty);
			return $result;
		}
		else
		{
			return false;
		}
		
	}
	
	function updateProductItemStatus($order_id)
	{
		$isOrderDispatchedComplete=true;
		
		$product_details            =$this->db->rp_getData($this->ctableOrderProductItem,"*","order_id='".$order_id."'","",0);
		if($product_details)
		{
			while($product=mysqli_fetch_assoc($product_details))
			{
				$order_qty=$product['order_item_qty'];
				$remaining_qty=$product['order_item_remaining_qty'];
				$dispatched_qty=$product['order_item_actual_dispatched_qty'];
				if($order_qty==$dispatched_qty && $remaining_qty<=0)
				{
					$this->db->rp_update($this->ctableOrderProductItem,array("status"=>1),"id='".$product['id']."'");
					
				}
				else
				{
					$this->db->rp_update($this->ctableOrderProductItem,array("status"=>0),"id='".$product['id']."'");
					$isOrderDispatchedComplete=false;
				}
			}
			
			if($isOrderDispatchedComplete)
			{
				$this->db->rp_update($this->ctableOrder,array("order_status"=>3),"id='".$order_id."'",0);	
				//send notification
				$where="id='".$order_id."'";
				$did=$this->db->rp_getValue("order_detail","did",$where);
				 
				 $detail['notification_title']=$this->log->getMessage('FULL_DISPATCH_NOTIFICATION_TITLE');
				 $detail['notification_type']="1";
				 $detail['notification_description']=$this->log->getMessage('FULL_DISPATCH_NOTIFICATION_DESCRIPTION');
				 $detail['did']=$did;
				 $this->objSystem->notificationInsert($detail);
				 //send notification over
			}
			else
			{
				$this->db->rp_update($this->ctableOrder,array("order_status"=>2),"id='".$order_id."'",0);
				//send notification
				 $where="id='".$order_id."'";
				 $did=$this->db->rp_getValue("order_detail","did",$where);
				 
				 $detail['notification_title']=$this->log->getMessage('PARTIAL_DISPATCH_NOTIFICATION_TITLE');
				 $detail['notification_type']="1";
				 $detail['notification_description']=$this->log->getMessage('PARTIAL_DISPATCH_NOTIFICATION_DESCRIPTION');
				 $detail['did']=$did;
				 $this->objSystem->notificationInsert($detail);
				 
				 //send notification over
				 
			}
		}
		else
		{
			return false;
		}
	}
	function getOrderDetail($order_id)
	{
		$order_details =$this->db->rp_getData($this->ctableOrder,"*","id='".$order_id."'","",0);
		if($order_details)
		{
			
			$order_details=mysqli_fetch_assoc($order_details);
			return $order_details;
		}
		else
		{
			return false;
		}
	}
	function getDispatchDetail($dispatch_id,$order_id)
	{
		$dispatch_details =$this->db->rp_getData($this->ctableDispatch,"*","id='".$dispatch_id."'","",0);
		if($dispatch_details)
		{
			
			$dispatch_details=mysqli_fetch_assoc($dispatch_details);
			$products=array();
			$qty_details_r           =$this->db->rp_getData($this->ctableDispatchItem,"*","dispatch_id='".$dispatch_id."'","",0);
			if($qty_details_r)
			{
				while($qty_details=mysqli_fetch_assoc($qty_details_r))
				{
					$product_detail=$this->getProductDetails($order_id,$qty_details['order_item_id']);
					$qty_details['more_info']=$product_detail;
					$products[]=$qty_details;
				}
			}
			$dispatch_details['products']=$products;			
			return $dispatch_details;
		}
		else
		{
			return false;
		}
	}
	function getOrderStatus($order_id)
	{
		if($order_id!="")
		{
			return $order_status=$this->db->rp_getValue($this->ctableOrder,"order_status","id='".$order_id."'");
			
		}
		return false;
	}	
	function changeDispatchStatus($dispatch_id,$status)
	{
		if($dispatch_id!="")
		{
			return $isUpdated=$this->db->rp_update($this->ctableDispatch,array("status"=>$status),"id='".$dispatch_id."'");			
		}
		return false;
	}
	function finalDispatch($dispatch_order_id,$dispatch_actual_driver_name="",$dispatch_actual_driver_number="",$dispatch_actual_date="",$dispatch_actual_transport_type="",$dispatch_actual_lr_no="",$dispatch_actual_vehical_number="",$dispatch_actual_special_note="",$dispatch_inform_to="",$dispatch_collect_invoice="",$dispatch_goods_per_order="")
	{
		if($dispatch_order_id!="")
		{
			$update_status=$this->db->rp_getValue($this->ctableDispatch,"status","id='".$dispatch_order_id."'");
			if($update_status==0)
			{
				$update_status=3;
			}
			
			$values=array(
			"dispatch_actual_driver_name"=>$dispatch_actual_driver_name,
			"dispatch_actual_driver_number"=>$dispatch_actual_driver_number,
			"dispatch_actual_date"=>date("Y-m-d",strtotime($dispatch_actual_date)),
			"dispatch_actual_transport_type"=>$dispatch_actual_transport_type,
			"dispatch_actual_lr_no"=>$dispatch_actual_lr_no,
			"dispatch_actual_vehical_number"=>$dispatch_actual_vehical_number,
			"dispatch_actual_special_note"=>$dispatch_actual_special_note,
			"dispatch_inform_to"=>$dispatch_inform_to,
			"dispatch_collect_invoice"=>$dispatch_collect_invoice,
			"dispatch_goods_per_order"=>$dispatch_goods_per_order,
			"status"=>$update_status);
			return $isUpdated=$this->db->rp_update($this->ctableDispatch,$values,"id='".$dispatch_order_id."'",0);	

			
		}
		return false;
	}	
	function finalDispatchupdate($dispatch_order_id,$dispatch_actual_driver_name="",$dispatch_actual_driver_number="",$dispatch_actual_date="",$dispatch_actual_transport_type="",$dispatch_actual_lr_no="",$dispatch_actual_vehical_number="",$dispatch_actual_special_note="",$dispatch_inform_to="",$dispatch_collect_invoice="",$dispatch_goods_per_order="",$dispatch_goods_per_order="",$dispatch_suggested_transportation="",$dispatch_packing_standard="",	$dispatch_transport_charge="",$dispatch_payment_recieve="")
	{
		if($dispatch_order_id!="")
		{
			$update_status=$this->db->rp_getValue($this->ctableDispatch,"status","id='".$dispatch_order_id."'");
			if($update_status==0)
			{
				$update_status=3;
			}
			
			$values=array(
			"dispatch_actual_driver_name"=>$dispatch_actual_driver_name,
			"dispatch_actual_driver_number"=>$dispatch_actual_driver_number,
			"dispatch_actual_date"=>date("Y-m-d",strtotime($dispatch_actual_date)),
			"dispatch_actual_transport_type"=>$dispatch_actual_transport_type,
			"dispatch_actual_lr_no"=>$dispatch_actual_lr_no,
			"dispatch_actual_vehical_number"=>$dispatch_actual_vehical_number,
			"dispatch_actual_special_note"=>$dispatch_actual_special_note,
			"dispatch_inform_to"=>$dispatch_inform_to,
			"dispatch_collect_invoice"=>$dispatch_collect_invoice,
			"dispatch_goods_per_order"=>$dispatch_goods_per_order,
			"dispatch_suggested_transportation"=>$dispatch_suggested_transportation,
			"dispatch_packing_standard"=>$dispatch_packing_standard,
			"dispatch_transport_charge"=>$dispatch_transport_charge,
			"dispatch_payment_recieve"=>$dispatch_payment_recieve,
			"status"=>$update_status);
			return $isUpdated=$this->db->rp_update($this->ctableDispatch,$values,"id='".$dispatch_order_id."'",0);	

			
		}
		return false;
	}
	function deleteDispatchOrder($order_id,$dispatch_id)
	{
		if($dispatch_id!="")
		{
			$dispatch_items_r=$this->db->rp_getData($this->ctableDispatchItem,"*","dispatch_id='".$dispatch_id."'");
			if($dispatch_items_r)
			{
				while($item=mysqli_fetch_assoc($dispatch_items_r))
				{
					$item_id=$item['dispatch_item_id'];
					$item_qty=intval($item['dispatch_item_qty']);
					// update qty in product detail table
					
					$current_dispatched_qty=intval($this->db->rp_getValue($this->ctableOrderProductItem,"order_item_dispatched_qty","order_item_id='".$item_id."' AND order_id='".$order_id."'","",0));
					$current_qty=intval($this->db->rp_getValue($this->ctableOrderProductItem,"order_item_qty","order_item_id='".$item_id."' AND order_id='".$order_id."'","",0));
					$new_dispatched_qty=$current_dispatched_qty-$item_qty;
					$new_remaining_qty=$current_qty-$new_dispatched_qty;					
					$isUpdated=$this->db->rp_update($this->ctableOrderProductItem,array('order_item_remaining_qty'=>$new_remaining_qty,"order_item_dispatched_qty"=>$new_dispatched_qty),"order_item_id='".$item_id."' AND order_id='".$order_id."'",0);
					$this->rp_delete($this->ctableDispatchItem,"id='".$item['id']."'");
				}
				$this->db->rp_update($this->ctableDispatch,array("isDelete"=>1),"id='".$dispatch_id."'");		
				$this->updateProductItemStatus($order_id);
				$ack=array("ack"=>1,
				"ack_msg"=>"Dispatch Order Successfully Deleted!!",
				);
				return $ack;
			}
			$ack=array("ack"=>0,
			"ack_msg"=>"Dispatch Order Could Not Be Deleted!!",
			"developer_msg"=>"No Dispatch Items Found!!"
			);
			return $ack;
		}
		$ack=array("ack"=>0,
		"ack_msg"=>"Dispatch Order Could Not Be Deleted!!",
		"developer_msg"=>"No Dispatch ID Found!!"
		);
		return $ack;
	}	
	function updateFlickAttachmnet($file,$did)
	{

			$countFromId=$this->db->rp_getData($this->ctableDispatch,"id='".$did."'");
			if($countFromId>=1)
			{
			   if (isset($file["file"])) {
					$allowedExts = array("jpg","jpeg","png","gif","JPG","JPEG","txt","docx","pdf","ppt","doc","csv","xlsx","xls");
					$temp = explode(".", $file["file"]["name"]);
					 $extension = end($temp);
					$error="";
					if($file["file"]["error"]>0) {
						$error .= "Error opening the file. ";
					}
					if($file["file"]["type"]=="application/x-msdownload"){
						$error .= "Mime type not allowed. ";
					}
					if(!in_array($extension, $allowedExts)){
						$error .= "Extension not allowed. ";
					}
					if($file["file"]["size"] > 26214400){ //26214400 Bytes = 25 MB, 102400 = 100KB
						$error .= "File size shoud be less than 25 MB ";
					}
					if($error=="") {

						$fileName 	= $this->db->clean($file["file"]["name"]);
						$fileSize 	= round($file["file"]["size"]); // BYTES
						$adate 		= date('Y-m-d H:i:m');

						$extension	= end(explode(".", $fileName));
						$fileName	= $did.'_dispatch_order_attachment_'.substr(sha1(time()), 0, 6).".".$extension;
						$filePath 	= "../".DISPATCH_ORDER_ATTACHMENT.$fileName;
						move_uploaded_file($file['file']['tmp_name'], $filePath);

						$aid=$this->addAttachment($did,0,$fileName,$this->db->clean($file["file"]["name"]),date("Y-m-d H:i:s"));
						$reply=array("ack"=>1,"developer_msg"=>"File successfully uploaded!!","ack_msg"=>"File successfully uploaded!!","result"=>$aid);
						return $reply;
					}
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>"File type not valid","ack_msg"=>"Invalid File or file not found.");
						return $reply;
					}
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"File type not valid","ack_msg"=>"Invalid File or Files not found.");
					return $reply;
				}
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Dispatch id not valid","ack_msg"=>"Internal Error!!");
				return $reply;
			}
	}
	
	function addAttachment($reference_id,$reference_type,$file_path,$title,$adate)
	{
		$insert_id=$this->db->rp_insert($this->ctableAttachment,array($reference_id,$reference_type,$file_path,$adate,$title),array("reference_id","reference_type","file_path","adate","title"),0);
		return $insert_id;
	}
	function removeAttachment($aid)
	{
		$file_path=$this->db->rp_getValue($this->ctableAttachment,"file_path","id='".$aid."'");
		if(file_exists("../".DISPATCH_ORDER_ATTACHMENT.$file_path))
		{
			unlink("../".DISPATCH_ORDER_ATTACHMENT.$file_path);
		}
		
		$this->db->rp_delete($this->ctableAttachment,"id='".$aid."'");
		$reply=array("ack"=>1,"developer_msg"=>"Attachment Removed!!","ack_msg"=>"Attachment Removed!!");
		return $reply;
		
	}
	function sumOfArray($array)
	{
		$total=0;
		foreach($array as $a)
		{
			$total=intval($a)+$total;
		}
		return $total;
	}
}
	?>