<?php
require_once("main.class.php");
require_once("function.class.php");
require_once("class.log.php");

class SalesInvoice extends Functions
{
	public $db,$log;
	public $ctable="sales_invoice_info";
	function __construct($id="") 
	{
		$db = new Functions();
		$conn =$db->connect();
		$this->db=$db;
		$this->log=new Log();		   		
    } 
	
	 
	public function UpdateSalesInvoice($detail,$item)
	{
			$total_other_tax_amount=0;
			$grand_total=0;
			$total_tax_amount=0;
			$subtotal=0;
			$invoice_discount=0;
			extract($detail);
				$sales_invoice_date=($sales_invoice_date!="")?date('Y-m-d',strtotime($sales_invoice_date)):"";
				$invoice_due_date=($invoice_due_date!="")?date('Y-m-d',strtotime($invoice_due_date)):"";
				$rows 	                                = array(
							"sales_invoice_date"=>$sales_invoice_date,
							"invoice_due_date"=>$invoice_due_date,
							);
				$where	       = "id='".$_REQUEST['id']."'";
				$isUpdated     =$this->db->rp_update($this->ctable,$rows,$where,0);
				if($isUpdated)
				{
					// Insert Sales Invoice Item
					$this->db->rp_delete("sales_invoice_item","sales_invoice_id='".$_REQUEST['id']."'",0);
					$sales_invoice_id=$_REQUEST['id'];
					$GrandTotal=0;
					$SubTotal=0;
					$DiscountAmount=0;
					$TaxAmount=0;
					$OtherTaxAmount=0;
					foreach($item as $current_item)
					{
						$item=$this->db->rp_getData("product","*","id='".$current_item['item_id']."'",0);
						$items=mysqli_fetch_assoc($item);
						$total=$current_item['item_price']*$current_item['item_qty'];
						$discount_amount=0;//($item_subtotal*$current_item['item_discount'])/100;
						$subtotal=$total-$discount_amount;
						$tax=$this->db->rp_getValue("tax","tax_value","id='".$items['vat_tax']."'");
						$tax_amount=($tax*$subtotal)/100;
						$other_tax_amount=($subtotal*$items['other_tax'])/100;
						$grand_total=$subtotal+$tax_amount+$other_tax_amount;
						$rows 	= array(
								"sales_invoice_id",
								"item_id",
								"item_name",
								"item_code",
								"item_price",
								"item_orignal_price",
								"item_qty",
								"item_subtotal",
								"item_discount",
								"item_discount_amount",
								"tax",
								"other_tax",
								"tax_amount",
								"other_tax_amount",
								"item_grandtotal",
								"created_date"
							);
					$values = array(
								$sales_invoice_id,	
								$current_item['item_id'],
								$items['product_name'],
								$items['product_code'],
								$current_item['item_price'],
								$current_item['item_price'],
								$current_item['item_qty'],
								$subtotal,
								0,
								$discount_amount,
								$tax,
								$items['other_tax'],
								$tax_amount,
								$other_tax_amount,
								$grand_total,
								date('Y-m-d H:i:s')
							);	
						$sales_invoice_item_id = $this->db->rp_insert("sales_invoice_item",$values,$rows,0);
						$OtherTaxAmount=$OtherTaxAmount+$other_tax_amount;
						$TaxAmount=$TaxAmount+$tax_amount;
						$DiscountAmount=$DiscountAmount+$discount_amount;
						$SubTotal=$SubTotal+$subtotal;
						$GrandTotal=$GrandTotal+$grand_total;
					}
					
						
						// Purchase
					$rows 	= array(
						"invoice_subtotal"			=> $SubTotal,
						"invoice_discount"			=> $DiscountAmount,
						"tax_amount"				=> $TaxAmount,
						"other_tax_amount"			=> $OtherTaxAmount,
						"invoice_grandtotal"		=> $GrandTotal,
						);
						$where	= "id='".$sales_invoice_id."'";
						$isUpdated_invoice=$this->db->rp_update($this->ctable,$rows,$where,0);
						$reply=array("ack"=>1,"developer_msg"=>"Store Item Updated.","ack_msg"=>"Success! Store Item Update Successfully.");
						return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"Store Item Update Fail.","ack_msg"=>"Success! Store Item Update Failed.");
						return $reply;
				}
		}
	public function GetSalesInvoice($detail,$item_required=false)
	{
		$where = "id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where,"",0);		
		$ctable_d = mysqli_fetch_assoc($ctable_r);
		if($item_required)
		{
			$reply=$this->GetSalesInvoiceItem($detail);
			if($reply['ack']==1)
			{
				$ctable_d['items']=$reply['result'];
			}	
			else
			{
				$ctable_d['items']=array();
			}
		}
		$reply=array("ack"=>1,"developer_msg"=>"Store detail fetched!!.","ack_msg"=>"Success! Store Edit Successfully.","result"=>$ctable_d);
		return $reply;
	
	}
	public function GetSalesInvoiceItem($detail)
	{		

			$where = "sales_invoice_id='".$detail['id']."' AND sales_invoice_item.isDelete=0";
			$ctable_item = $this->db->rp_getData("sales_invoice_item LEFT JOIN product ON sales_invoice_item.item_id=product.id LEFT JOIN category ON product.category_id=category.id","sales_invoice_item.*",$where,ITEM_DISPLAY_ORDER,0);
			if($ctable_item)
			{
			while($ctable_item_d = mysqli_fetch_assoc($ctable_item))
			{
				$result_item=array();
				$result[]=$ctable_item_d;
			}
			$reply=array("ack"=>1,"developer_msg"=>"Store detail fetched!!.","ack_msg"=>"Success! Update Store Successfully.","result"=>$result);
			return $reply;
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"Update not fetched!!.","ack_msg"=>"Success! Update Failed"	);
			return $reply;
		}
	
	}
	public function DeleteSalesInvoice($detail)
	{
		$rows 	= array(
			"isDelete"	=> "1"
			);
		$where	= "id='".$_REQUEST['id']."'";
		$isUpdated=$this->db->rp_update($this->ctable,$rows,$where);
		
		if($isUpdated)
		{
			/////////// delete customer account
			$this->db->rp_delete("customer_account","reference_id='".$_REQUEST['id']."' AND reference_type='sales_invoice_info'");
			$sales_invoice_r=$this->db->rp_getData("sales_invoice_item","*","sales_invoice_id='".$_REQUEST['id']."'","",0);
	
			if($sales_invoice_r){
				$sales_invoice_d=array();
				while($sales_invoice_d=mysqli_fetch_assoc($sales_invoice_r)){
					$sales_invoice_items[]=$sales_invoice_d;
				}
				foreach($sales_invoice_items as $item){
					$fg_item_qty=$item['fg_item_qty'];
				
					$fg_item_id=$item['fg_item_id'];
					
				
				$fg_item_r=$this->db->rp_getData("item_fg","*","id='".$fg_item_id."'","",0);
					if($fg_item_r)
					{
						$fg_item_d=mysqli_fetch_assoc($fg_item_r);
							
						$fg_stock_qty=$fg_item_d['fg_stock_qty'];
						$new_stock=$fg_stock_qty+$fg_item_qty;
						
						$rows 	= array(
									"fg_stock_qty"	=> $new_stock,
									);
							
						$UpdateIssueItem=$this->db->rp_update("item_fg",$rows,"id='".$fg_item_id."'",0);	
					}
				}
			}
			
			$reply=array("ack"=>1,"developer_msg"=>"deleted data.","ack_msg"=>"Success! Delete Sales Invoice Successfully.");
			return $reply;
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Delete Store Item Failed.");
			return $reply;
		}
		
	}
	
	
	public function checkStockAvailability($item,$sales_invoice_id)
	{
		$isValid=true;
		$error=array();
		foreach($item as $key=>$i)
		{
			$item_id=$i['item_id'];
			
			$item=$this->db->rp_getData("product","*","id='".$i['item_id']."'");
			$items=mysqli_fetch_assoc($item);
			
			$product_name=$items['product_name'];
			$item_qty=$i['qty'];
			
			$old_sales_stock=$this->db->rp_getValue("sales_invoice_item","item_qty","sales_invoice_id='".$sales_invoice_id."' AND item_id='".$item_id."'");
			if($old_sales_stock!="")
			{
				$old_sales_stock=floatval($old_sales_stock);
			}
			else
			{
				$old_sales_stock=0;
			}
			$current_stock=$this->db->rp_getValue("product","stock_qty","id='".$item_id."'");
			$new_stock=$current_stock+$old_sales_stock-$item_qty; 
			
			if($new_stock<0)
			{
				$isValid=false;
				$error[]="Item ".$product_name." not available in stock.";
			}
			
		}
		return array("isValid"=>$isValid,"error"=>$error);
	}

	function debitAmount($sales_invoice_id,$dealer_id,$sales_grandtotal,$remark){
		$accountId=$this->db->rp_getValue("account_info","id","did='".$dealer_id."'");
		$accountno=$this->db->rp_getValue("account_info","account_number","did='".$dealer_id."'");
		
		$account_row=array("reference_id","aid","dealer_account_no","did","debit","reference_type","add_date");
		$account_value=array($sales_invoice_id,$accountId,$accountno,$dealer_id,$sales_grandtotal,$remark,date('Y-m-d H:i:s'));
		
		$uid = $this->db->rp_insert("dealer_account",$account_value,$account_row,0);
		
		if($uid!=0)
		{
			$reply=array("ack"=>1,"developer_msg"=>"Debit Amount Successfully","ack_msg"=>"Success! Debit Amount Successfully.");
			return $reply;
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Debit Amount Failed.");
			return $reply;
		}
	}

}

?>