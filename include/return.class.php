<?php
require_once('orders.class.php');
class Returns extends Functions
{
	public $db, $log,$media;
	public $ctable="return_info";
	public $ctableReturnItem="return_item";
	public $CtableCustomer="customer";
	public $CtableProduct="product";
	
	function __construct($id="") 
	{
		$db = new Functions();
		$conn =$db->connect();
		$this->db=$db;
		$log	= new Log();		
		$this->system	= new System();		
		$this->log=$log;
		$this->media=new Media();
    } 
	public function InsertReturns($detail,$item)
	{
			
			extract($detail);
		
			
		  	$return_no=$this->db->getlastInsertId($this->ctable);
			$return_no=RETURN_NO.str_pad($return_no, 4, 0, STR_PAD_LEFT);
			$customer_data=$this->db->rp_getData("customer_branch","*","id='".$customer_branch_id."'","",0);
            $customer_data_r=mysqli_fetch_assoc($customer_data);
        	 
          
			$adate	= date('Y-m-d H:i:s');
			
			
			$rows 	= array(
						"return_no",
						"cid",
						"cbid",
						"branch_name",
						"email",
						"address",
						"phone",
						"pincode",
						"city",
						"country",
						"status",
						"created_date",
						
					);
			$values = array(
						$return_no,
						$customer_id,
						$customer_branch_id,
						$customer_data_r['branch_name'],
						$customer_data_r['email'],
						$customer_data_r['address'],
						$customer_data_r['phone'],
						$customer_data_r['pincode'],
						$customer_data_r['city'],
						$customer_data_r['country'],
						0,
						$adate,
					);
					
		 	$return_id = $this->db->rp_insert($this->ctable,$values,$rows,0);
			
			$this->log->insertLog($this->ctable,$return_id,"insert",$this->log->slm['RETURN_INSERT']." : ".$return_no);
			if($return_id!=0)
			{
				 $current_item=array();
				// Insert item 
				
				if(!empty($item))
				{
					$total=0;
					$grand_total=0;
					$return_item=array();
					for($i=0;$i<sizeof($item);$i++)
					{
						$current_item=$item[$i];
						$product_name="";
						$cid=0;
						
						
						$ProductInfo= $this->db->rp_getData($this->CtableProduct,"*","id='".$current_item['return_item_id']."' AND isDelete=0");
						$ProductInfo=mysqli_fetch_assoc($ProductInfo);
						if($ProductInfo){
							
							 $item_sub_total=$ProductInfo['selling_price']*$current_item['qty'];
							 
							 $adate	= date('Y-m-d H:i:s');
								$rows 	= array(
								"return_id",
								"cbid",
								"pid",
								"item_name",
								"item_code",
								"price",
								"return_price",
								"qty",
								"return_qty",
								"return_subtotal",
								"created_date"
							);
							$values = array(
								$return_id,
								$customer_data_r['id'],
								$current_item['return_item_id'],
								$ProductInfo['product_name'],
								$ProductInfo['product_code'],
								$ProductInfo['selling_price'],
								$ProductInfo['selling_price'],
								$current_item['qty'],
								$current_item['qty'],
								$item_sub_total,
								$adate,
							);
							
							$return_item_id = $this->db->rp_insert($this->ctableReturnItem,$values,$rows,0);
							$total+=$item_sub_total;
							$return_item[]=$ProductInfo['product_name'];
						}
						$credit_amount = $total;
						
						//credit note create
						$credit_items[]=array("return_id"=>$return_id,"return_item_id"=>$return_item_id,"item_id"=>$current_item['return_item_id'],"item_name"=>$ProductInfo['product_name'],"item_actual_dispatch_qty"=>0,"item_return_qty"=>$current_item['qty'],"item_credit_qty"=>$current_item['qty'],"item_unit_price"=>$ProductInfo['selling_price'],"item_discount"=>0,"item_tax"=>0,"item_discount_amount"=>0,"item_subtotal"=>$item_sub_total,"item_grandtotal"=>$item_sub_total);
						
					}
					$grand_total  = $total;
					
					$this->db->rp_update($this->ctable,array("total_amount"=>$grand_total),"id='".$return_id."'",0);

					if($credit_amount>0 && !empty($credit_items))
					{
						$Remarks="Against return #".$return_no;
						$credit_detail=array("customer_branch_id"=>$customer_branch_id,"customer_id"=>$customer_id,"return_id"=>$return_id,"credit_amount"=>$credit_amount,"note_date"=>date("Y-m-d"),"status"=>0,"credit_type"=>"Return","remarks"=>$Remarks);
						$OrderObject=new Order();
						$CreditNoteReply=$OrderObject->CreateCreditNoteReturn($credit_detail,$credit_items);
						if($CreditNoteReply['ack']==1)
						{
							$CreditNoteID=$CreditNoteReply['credit_note_id'];
							$isUpdated=$this->db->rp_update("return_info",array("credit_note_id"=>$CreditNoteID),"id='".$return_id."'");
							$CreditNotePDFURL=$CreditNoteReply['pdf'];
						}
					}


					$order_list=implode(",",$order_item);
					$this->log->insertLog($this->ctableReturnItem,$return_id,"insert","Return ".$return_no." Inserted  Item :\n".$return_list);
				}
				
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('RETURN_INSERT',1),"ack_msg"=>$this->log->getMessage('RETURN_INSERT'),"id"=>$order_id);
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('RETURN_INSERT_FAILED',1),"ack_msg"=>$this->log->getMessage('RETURN_INSERT_FAILED'));
				return $reply;
			}
	 }
	
	 public function UpdateReturn($detail,$item)
	 {
		$return_id=$detail['id'];
		$customer_branch_id=$this->db->rp_getValue($this->ctable,"cbid","id='".$return_id."'",0);
		$return_no=$this->db->rp_getValue($this->ctable,"return_no","id='".$return_id."'",0);
		$credit_note_id=$this->db->rp_getValue($this->ctable,"credit_note_id","id='".$return_id."'",0);
		
		extract($detail);
				
				$created_date=date('Y-m-d H:i:s');
				$modify_date=date('Y-m-d H:i:s');
				$rows 	= array(
						"modify_date"		=>	$modify_date,
						"status"			=>	0,
						);
				$where	= "id='".$return_id."'";
				$isUpdated=$this->db->rp_update($this->ctable,$rows,$where,0);
				$this->log->insertLog($this->ctable,$return_id,"update",$this->log->slm['RETURN_UPDATE']." : ".$return_no);
				if($isUpdated)
				{	
					//$this->isSpecialOrder($order_id,$customer_id,$order_date);
					$this->db->rp_delete("return_item","return_id='".$return_id."'",0);
					$this->db->rp_delete("credit_note","id='".$credit_note_id."'",0);
					$this->db->rp_delete("credit_note_item","credit_note_id='".$credit_note_id."'",0);
					$current_item=array();
					// Insert item
					if(!empty($item))
					{
						$total=0;
						$grand_total=0;
						$order_item=array();
						for($i=0;$i<sizeof($item);$i++)
						{
							$current_item=$item[$i];
							$product_name="";
							$cid=0;
							//$results=$this->aj_getProductDetail($branch_id,$cid,$product_name,$require_column=array(),$current_item['order_item_id']);
							
							$ProductInfo= $this->db->rp_getData($this->CtableProduct,"*","id='".$current_item['return_item_id']."' AND isDelete=0");
							$ProductInfo=mysqli_fetch_assoc($ProductInfo);
							if($ProductInfo){
								
								 $item_sub_total=$ProductInfo['selling_price']*$current_item['qty'];
								 
								 $adate	= date('Y-m-d H:i:s');
									$rows 	= array(
									"return_id",
									"cbid",
									"pid",
									"item_name",
									"item_code",
									"price",
									"return_price",
									"qty",
									"return_qty",
									"return_subtotal",
									"created_date"
								);
								$values = array(
									$return_id,
									$customer_branch_id,
									$current_item['return_item_id'],
									$ProductInfo['product_name'],
									$ProductInfo['product_code'],
									$ProductInfo['selling_price'],
									$ProductInfo['selling_price'],
									$current_item['qty'],
									$current_item['qty'],
									$item_sub_total,
									$adate,
								);
								
								$return_item_id = $this->db->rp_insert($this->ctableReturnItem,$values,$rows,0);
								$total+=$item_sub_total;
								$return_item[]=$ProductInfo['product_name'];
							}
							$credit_amount = $total;
							//credit note create
							$credit_items[]=array("return_id"=>$return_id,"return_item_id"=>$return_item_id,"item_id"=>$current_item['return_item_id'],"item_name"=>$ProductInfo['product_name'],"item_actual_dispatch_qty"=>0,"item_return_qty"=>$current_item['qty'],"item_credit_qty"=>$current_item['qty'],"item_unit_price"=>$ProductInfo['selling_price'],"item_discount"=>0,"item_tax"=>0,"item_discount_amount"=>0,"item_subtotal"=>$item_sub_total,"item_grandtotal"=>$item_sub_total);
							
							
						}
						$return_list=implode(",",$return_item);
						if($credit_amount>0 && !empty($credit_items))
						{
							$Remarks="Against Return#".$return_no;
							$credit_detail=array("customer_branch_id"=>$customer_branch_id,"customer_id"=>$customer_id,"return_id"=>$return_id,"credit_amount"=>$credit_amount,"note_date"=>date("Y-m-d"),"status"=>0,"credit_type"=>"Return","remarks"=>$Remarks);
							$OrderObject=new Order();
							$CreditNoteReply=$OrderObject->CreateCreditNoteReturn($credit_detail,$credit_items);
							if($CreditNoteReply['ack']==1)
							{
								$CreditNoteID=$CreditNoteReply['credit_note_id'];
								$isUpdated=$this->db->rp_update("return_info",array("credit_note_id"=>$CreditNoteID),"id='".$return_id."'");
								$CreditNotePDFURL=$CreditNoteReply['pdf'];
							}
						}
						$this->log->insertLog($this->ctableReturnItem,$_REQUEST['id'],"Update","Return ".$return_no." Updated  Item :\n".$return_list);
						
						$this->db->rp_update($this->ctable,array("total_amount"=>$total),"id='".$detail['id']."'",0);
					}
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('RETURN_UPDATE',1),"ack_msg"=>$this->log->getMessage('RETURN_UPDATE'),"id"=>$order_id);
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Return Update Failed.");
					return $reply;
				}
			
		
	}
	public function GetReturn($detail)
	{
		$where = " id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where,"",0);
		$ctable_d = mysqli_fetch_array($ctable_r);
		$result=array();

		$result['cid']			= $ctable_d['cid'];
		$result['cbid']			= $ctable_d['cbid'];
		$result['customer_branch_id']			= $ctable_d['cbid'];
		$result['name']			= htmlentities($ctable_d['branch_name']);
		$result['cellphone']			= htmlentities($ctable_d['phone']);
		$result['address']			= htmlentities($ctable_d['address']);
		$result['city']			= htmlentities($ctable_d['city']);
		$result['order_grand_total']			= htmlentities($ctable_d['total_amount']);

		$reply=array("ack"=>1,"developer_msg"=>"Orders detail fetched!!.","ack_msg"=>"Orders Successfull.","result"=>$result);
		return $reply;

	}
    public function GetReturnItems($detail)
	{
		$where = " return_id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData("return_item","*",$where,"",0);
		while($ctable_item_d = mysqli_fetch_array($ctable_r)){
			$result_item=array();
				
			$result_item['return_item_id']				= htmlentities($ctable_item_d['pid']);
			$result_item['item_name']		= htmlentities($ctable_item_d['item_name']);
			$result_item['price']	= htmlentities($ctable_item_d['price']);
			$result_item['return_price']	= htmlentities($ctable_item_d['return_price']);
			$result_item['qty']	= htmlentities($ctable_item_d['qty']);
			$result_item['return_qty']	= htmlentities($ctable_item_d['return_qty']);
			$result_item['subtotal']		= htmlentities($ctable_item_d['return_subtotal']);
			$result[]=$result_item;
		}
		

		$reply=array("ack"=>1,"developer_msg"=>"Orders detail fetched!!.","ack_msg"=>"Orders Successfull.","result"=>$result);
		return $reply;

	}
		
	function aj_getProductDetail($branch_id,$cid,$product_name,$require_column=array(),$product_id)
	{
		$result = array();
		if($branch_id!="")
		{
			$CustomerID=$this->rp_getValue($this->CtableCustomerBranch,"cid","id='".$branch_id."'",0);
			$Discount=$this->rp_getValue($this->CtableCustomer,"discount","id='".$CustomerID."'");
			$BranchPriceList=$this->rp_getValue($this->CtableCustomerBranch,"price_list","id='".$branch_id."'",0);
			if($BranchPriceList!="")
			{
				$BranchPriceListDetail=$this->db->rp_getData($this->CtablePriceList,"*","id='".$BranchPriceList."'","",0);
				if($BranchPriceListDetail)
				{
					$BranchPriceListDetail=mysqli_fetch_assoc($BranchPriceListDetail);
					if($cid!="")
					{
						$where="category_id='".$cid."' AND isDelete=0 AND isActive=1";	
					}
					else if($product_name!="")
					{
						$where ="product_name like '%".$product_name."%' AND isDelete=0 AND isActive=1";	
					}
					else if($product_id!="")
					{
						$where ="id='".$product_id."' AND isDelete=0 AND isActive=1";	
					}
					else
					{
						$where="isDelete=0 AND isActive=1";
					}
					
					$require_column=$this->system->getRequiredColumns($require_column);
					$product_r = $this->db->rp_getData("product",$require_column,$where,"",0);
					if($product_r){
						while($product_detail=mysqli_fetch_assoc($product_r))	
						{
							// Is This Item Available In Price list or not?
							$InPriceList=$this->rp_getTotalRecord($this->CtablePriceListProducts,"product_id='".$product_detail['id']."' AND price_list_id='".$BranchPriceListDetail['id']."'");
							if($InPriceList>0)
							{
								$PriceInPriceList=$this->db->rp_getValue($this->CtablePriceListProducts,"price","product_id='".$product_detail['id']."' AND price_list_id='".$BranchPriceListDetail['id']."'");
							}
								if($PriceInPriceList=="")
								{
									$PriceInPriceList=$this->db->rp_getValue($this->CtableProduct,"selling_price","id='".$product_detail['id']."'");
								}
									$VATTax=$this->rp_getValue($this->CtableTax,"tax_value","id='".$product_detail['vat_tax']."'",0);
									$VATTax=($VATTax!="")?floatval($VATTax):0;
									$VATTaxAmount=($PriceInPriceList*$VATTax)/100;
									$OtherTax=($product_detail['other_tax']!="")?floatval($product_detail['other_tax']):0;
									$OtherTaxAmount=($PriceInPriceList*$OtherTax)/100;
									//Pricing 
									$product_detail['orignal_price']=$PriceInPriceList;
									$product_detail['selling_price']=$PriceInPriceList+$VATTaxAmount+$OtherTaxAmount;
									$product_detail['discount']=$Discount;
									$product_detail['discount_amount']=$product_detail['selling_price']*$Discount/100;
									
									$product_detail['discount_price']=$product_detail['selling_price']-$product_detail['discount_amount'];
									
									
									// Category Details
									$cid		= $product_detail['category_id'];
									$category_name		= $this->db->rp_getValue("category","category_name","id=".$cid);
									$product_detail['category_name'] = stripslashes($category_name);

									// Media Details
									$media_info=$this->media->getMedia(array("mid"=>$product_detail['image']));	
									if($media_info['ack']==1){
										$product_detail['image']=$media_info['result']['full_url'];
									}
									else{
										$product_detail['image']="";
									}

									// Product Availablity		
									$pro_date=$this->db->rp_getValue("product_availability","availability_date","product_id='".$product_detail['id']."'",0);
									if($pro_date!=""){
										
										$product_detail['product_availability_date']=date("d-m-Y",strtotime($pro_date));
									}else{
										$product_detail['product_availability_date']="";
									
									}
									$result[] 	= $product_detail;	
								
								
							
							
						}
						
					}
				}
				
				
			}
			
		}
		
		
		return $result;
	}
}


?>