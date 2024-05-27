<?php
require_once("main.class.php");
require_once("function.class.php");


class PurchaseIndent extends Functions
{
	public $db, $log;
	public $ctable="purchase_indent";
	function __construct($id="") 
	{
		$db = new Functions();
		$conn =$db->connect();
		$this->db=$db;	
		$this->log=new Log();		   						
    } 
	public function InsertPurchaseIndent($detail,$item)
	{
		
			extract($detail);
			
			$created_date	= date('Y-m-d H:i:s');
			$rows 	= array(
						"purchase_indent_no",
						//"department",
						"purchase_indent_remark",
						"purchase_indent_requirement_by",
						"isDelete",
						"created_date"
					);
			$values = array(
						$purchase_indent_no,
						//$department,
						$purchase_indent_remark,	
						$purchase_indent_requirement_by,					
						$isDelete,
						$created_date
					);
					
		 	$purchase_indent_id = $this->db->rp_insert($this->ctable,$values,$rows,0);
			$this->log->insertLog($this->ctable,$purchase_indent_id,"insert",$this->log->slm['PURCHASE_INDENT_INSERT']." : ".$purchase_indent_no);
			if($purchase_indent_id!=0)
			{	
				// Insert Material Item
				if(!empty($item))
				{
				
					// For loop
					$purchase_indent_item=array();
					for($i=0;$i<sizeof($item);$i++)
					{
						$purchase_indent_sub_total=0;
						$current_item=$item[$i]; 
							if($current_item['category_id']=="row_material")
							{
								$ctable1='item_rm';
								$where = " id='".$current_item['item_id']."' AND isDelete=0";
								$item_information = $this->db->rp_getData($ctable1,"*",$where,0);
								if($item_information)
								{
									$item_information=mysqli_fetch_assoc($item_information);
									$purchase_indent_item_id=$item_information['id'];
									$purchase_indent_item_name=$item_information['rm_item_name'];
									$purchase_indent_item_code=$item_information['rm_item_code'];
									$purchase_indent_current_stock=$item_information['rm_stock_qty'];
									$purchase_indent_item_unit=$item_information['rm_unit'];
									
								}
							}
							
								
							$created_date	= date('Y-m-d H:i:s');
							$rows 	= array(								
								"purchase_indent_id",							
								"purchase_indent_item_id",
								"purchase_indent_item_type",								
								"purchase_indent_item_name",
								"purchase_indent_item_code",
								"purchase_indent_item_qty",
								"purchase_indent_item_sub_total",
								"purchase_indent_item_current_stock",
								"purchase_indent_item_remaining_qty",
								"purchase_indent_item_received_qty",
								"purchase_indent_item_unit",
								"purchase_indent_requirment_date",
								"created_date"
							);
							$values = array(
								$purchase_indent_id,
								$purchase_indent_item_id,
								$current_item['category_id'],
								$purchase_indent_item_name,
								$purchase_indent_item_code,
								$current_item['required_qty'],
								$purchase_indent_sub_total,
								$purchase_indent_current_stock,
								$current_item['required_qty'],								
								0,
								$purchase_indent_item_unit,
								$current_item['requirment_date'],
								$created_date
							);		
						
							$purchaseitem_id = $this->db->rp_insert("purchase_indent_item",$values,$rows,0);
							$purchase_indent_item[]=$purchase_indent_item_name;

					}
					$purchase_indent_list=implode(",",$purchase_indent_item);
					
					$this->log->insertLog("purchase_order_item",$purchase_indent_id,"insert","Purchase Indent ".$purchase_indent_no." Inserted  Item :\n".$purchase_indent_list);
				}
				
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('PURCHASE_INDENT_INSERT',1),"ack_msg"=>$this->log->getMessage('PURCHASE_INDENT_INSERT'),"purchase_indent_id"=>$purchase_indent_id);
				return $reply;
				
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Purchase Indent Item added Failed.");
				return $reply;
			}
			
			
	}
	
	 
	 public function UpdatePurchaseIndent($detail,$item)
	  {
			extract($detail);
			$purchase_indent_no=$this->db->rp_getValue($this->ctable,"purchase_indent_no","isDelete=0 AND id='".$_REQUEST['id']."'");
			$rows 	= array(
						//"department"		=> $department,
						"purchase_indent_remark"		=> $purchase_indent_remark,
						"purchase_indent_requirement_by"=> $purchase_indent_requirement_by,
						);
				$where	= "id='".$_REQUEST['id']."'";
				$isUpdated=$this->db->rp_update($this->ctable,$rows,$where,0);
				$this->log->insertLog($this->ctable,$_REQUEST['id'],"update",$this->log->slm['PURCHASE_INDENT_UPDATE']." : ".$purchase_indent_no);
					
				if($isUpdated)
				{
					//if($current_item['required_qty']<$purchase_indent_current_stock){
					$this->db->rp_delete("purchase_indent_item","purchase_indent_id='".$_REQUEST['id']."'",0);
					$purchase_indent_id=$_REQUEST['id'];
					$purchase_indent_item=array();
					for($i=0;$i<sizeof($item);$i++)
					{
							
						$purchase_indent_sub_total=0;
						$current_item=$item[$i]; 
						if($current_item['category_id']=="row_material")
						{
							$ctable1='item_rm';
							$where = " id='".$current_item['item_id']."' AND isDelete=0";
							$item_information = $this->db->rp_getData($ctable1,"*",$where,0);
							if($item_information)
							{
								$item_information=mysqli_fetch_assoc($item_information);
								$purchase_indent_item_id=$item_information['id'];
								$purchase_indent_item_name=$item_information['rm_item_name'];
								$purchase_indent_item_code=$item_information['rm_item_code'];
								$purchase_indent_current_stock=$item_information['rm_stock_qty'];
								$purchase_indent_item_unit=$item_information['rm_unit'];
								
							}
						}
						else if($current_item['category_id']=="finish_good")
						{ 
							 $ctable1='item_fg'; 
							 $where = " id='".$current_item['item_id']."' AND isDelete=0";
							$item_information = $this->db->rp_getData($ctable1,"*",$where,0);
							if($item_information)
							{
								$item_information=mysqli_fetch_assoc($item_information);
								$purchase_indent_item_id=$item_information['id'];
								$purchase_indent_item_name=$item_information['fg_item_name'];
								$purchase_indent_item_code=$item_information['fg_item_code'];
								$purchase_indent_current_stock=$item_information['fg_stock_qty'];
								$purchase_indent_item_unit=$item_information['fg_unit'];
							}
						}
						else if($current_item['category_id']=="semi_finish_good")
						{
							$ctable1='item_sfg';
							$where = " id='".$current_item['item_id']."' AND isDelete=0";
							$item_information = $this->db->rp_getData($ctable1,"*",$where,0);
							if($item_information)
							{
								$item_information=mysqli_fetch_assoc($item_information);
								$purchase_indent_item_id=$item_information['id'];
								$purchase_indent_item_name=$item_information['sfg_item_name'];
								$purchase_indent_item_code=$item_information['sfg_item_code'];
								$purchase_indent_current_stock=$item_information['sfg_stock_qty'];
								$purchase_indent_item_unit=$item_information['sfg_unit'];
							}
						}
							$created_date	= date('Y-m-d H:i:s');
							$rows 	= array(								
								"purchase_indent_id",							
								"purchase_indent_item_id",
								"purchase_indent_item_type",								
								"purchase_indent_item_name",
								"purchase_indent_item_code",
								"purchase_indent_item_qty",
								"purchase_indent_item_sub_total",
								"purchase_indent_item_current_stock",
								"purchase_indent_item_remaining_qty",
								"purchase_indent_item_received_qty",
								"purchase_indent_item_unit",
								"purchase_indent_requirment_date",
								"created_date"
							);
							$values = array(
								$purchase_indent_id,
								$purchase_indent_item_id,
								$current_item['category_id'],
								$purchase_indent_item_name,
								$purchase_indent_item_code,
								$current_item['required_qty'],
								$purchase_indent_sub_total,
								$purchase_indent_current_stock,
								$current_item['required_qty'],								
								0,
								$purchase_indent_item_unit,
								date('Y-m-d',strtotime($current_item['requirment_date'])),
								$created_date
							);		
							
								$purchaseitem_id = $this->db->rp_insert("purchase_indent_item",$values,$rows,0);
						/*	}else{
								$reply=array("ack"=>0,"developer_msg"=>"Stock not avaliable!!","ack_msg"=>"Failed! Item Not avaliable in Store. o".$purchase_indent_current_stock." Qty are avaliable in store.");
								return $reply;
							}*/
							$purchase_indent_item[]=$purchase_indent_item_name;
					}
					$purchase_indent_list=implode(",",$purchase_indent_item);
					
					$this->log->insertLog("purchase_order_item",$purchase_indent_id,"Update","Purchase Indent ".$purchase_indent_no." Updated Item :\n".$purchase_indent_list);
					
					
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('PURCHASE_INDENT_UPDATE',1),"ack_msg"=>$this->log->getMessage('PURCHASE_INDENT_UPDATE'));
					return $reply;
					}
					
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Purchase Indent Update Failed.");
					return $reply;
				}
				
		}	
	public function GetPurchaseIndent($detail)
	{		
		$where = " id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where,0);
		$ctable_d = mysqli_fetch_array($ctable_r);
		$result=array();
		
		//$result['department']		= htmlentities($ctable_d['department']);
		$result['purchase_indent_requirement_by']	= htmlentities($ctable_d['purchase_indent_requirement_by']);
		$result['purchase_indent_no_get']			= htmlentities($ctable_d['purchase_indent_no']);
		$result['purchase_indent_remark']			= htmlentities($ctable_d['purchase_indent_remark']);
		
		// Purchase Item

		$reply=array("ack"=>1,"developer_msg"=>"Purchase Order detail fetched!!.","ack_msg"=>"Success! Purchase Edit Successfully.","result"=>$result);
		return $reply;
	
	}
	public function GetPurchaseIndentItem($detail)
	{		

			$where = "purchase_indent_id='".$detail['id']."' AND isDelete=0";
			$ctable_item = $this->db->rp_getData("purchase_indent_item","*",$where,0);
			
			while($ctable_item_d = mysqli_fetch_array($ctable_item))
			{
				$result_item=array();
				$result_item['id']				= htmlentities($ctable_item_d['purchase_indent_item_id']);
				$result_item['category_id']		= htmlentities($ctable_item_d['purchase_indent_item_type']);
				$result_item['item_name']		= htmlentities($ctable_item_d['purchase_indent_item_name']);
				$result_item['item_code']		= htmlentities($ctable_item_d['purchase_indent_item_code']);
				$result_item['received_qty']	= htmlentities($ctable_item_d['purchase_indent_item_received_qty']);
				$result_item['current_stock']	= htmlentities($ctable_item_d['purchase_indent_item_current_stock']);
				$result_item['item_unit']		= htmlentities($ctable_item_d['purchase_indent_item_unit']);
				
				$result_item['requirment_date']	= htmlentities($ctable_item_d['purchase_indent_requirment_date']);
				$result[]=$result_item;
			}
			//print_r($result);
			$reply=array("ack"=>1,"developer_msg"=>"Item detail fetched!!.","ack_msg"=>"Success! Item Update Record Successfully.","result"=>$result);
			return $reply;
		
	}
	
	
	public function DeletePurchaseIndent($detail)
	{
		$purchase_indent_no=$this->db->rp_getValue($this->ctable,"purchase_indent_no","isDelete=0 AND id='".$detail['id']."'");
		$rows 	= array(
		"isDelete"	=> "1"
		);
			$where	= "id='".$_REQUEST['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where,0);
			$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['PURCHASE_INDENT_DELETE']." : ".$purchase_indent_no);
			if($uid)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('PURCHASE_INDENT_DELETE',1),"ack_msg"=>$this->log->getMessage('PURCHASE_INDENT_DELETE'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Delete Purchase Indent Failed.");
				return $reply;
			}
	}
	
	
	public function purchaseIndentStatus($purchase_indent_id)
	{
		// Required Later 
		$update_array=array("status"=>1);
		$update_return_array=array("status"=>0);
		
		
		$purchase_indent_item_r=$this->db->rp_getData("purchase_indent_item","*","purchase_indent_id='".$purchase_indent_id."'");
		if($purchase_indent_item_r)
		{
			while($purchase_indent_item_d=mysqli_fetch_assoc($purchase_indent_item_r))
			{
				$purchase_indent_item_id=$purchase_indent_item_d['id'];
				$purchase_indent_item_required_qty=$purchase_indent_item_d['required_qty'];
				$outward_store_item_received_qty=$this->db->rp_getValue("outward_store_item","required_qty","purchase_indent_id='".$purchase_indent_id."' AND purchase_indent_item_id='".$purchase_indent_item_id."'");
				
				if($purchase_indent_item_required_qty==$outward_store_item_received_qty)
				{
					//Update Both Outward and Indent Item
					
					$isPIIUpdated=$this->db->rp_update("purchase_indent_item",$update_array,"id='".$purchase_indent_item_id."'");
					$this->log->insertLog("purchase_indent_item",$purchase_indent_item_id,"update","Purchase Indent Item Status Updated By User");
					$isOSIUpdated=$this->db->rp_update("outward_store_item",$update_array,"purchase_indent_id='".$purchase_indent_id."' AND purchase_indent_item_id='".$purchase_indent_item_id."'");
					$this->log->insertLog("outward_store_item",$purchase_indent_item_id,"update","Outward Store Item Status Updated By User");
										
				}
				else
				{
					$isPIIUpdated=$this->db->rp_update("purchase_indent_item",$update_return_array,"id='".$purchase_indent_item_id."'");
					$isOSIUpdated=$this->db->rp_update("outward_store_item",$update_return_array,"purchase_indent_id='".$purchase_indent_id."' AND purchase_indent_item_id='".$purchase_indent_item_id."'");
				}
				
			}
			
			
			$isAllPurchaseIndentItemReceived=$this->db->rp_getTotalRecord("purchase_indent_item","purchase_indent_id='".$purchase_indent_id."' AND status=0",0);
			if($isAllPurchaseIndentItemReceived<=0)
			{
				$isPIUpdated=$this->db->rp_update("purchase_indent",$update_array,"id='".$purchase_indent_id."'");
				
				$isAllOutwardItemReceived=$this->db->rp_getTotalRecord("outward_store_item","purchase_indent_id='".$purchase_indent_id."' AND purchase_indent_item_id='".$purchase_indent_item_id."' AND status=0");
				if($isAllPurchaseIndentItemReceived<=0)
				{
					$isOSUpdated=$this->db->rp_update("outward_store",$update_array,"purchase_indent_id='".$purchase_indent_id."'");
					return true;
				}
				else
				{
					$isOSUpdated=$this->db->rp_update("outward_store",$update_return_array,"purchase_indent_id='".$purchase_indent_id."'");
					return false;
				}
			}
			else
			{
				$isPIUpdated=$this->db->rp_update("purchase_indent",$update_return_array,"id='".$purchase_indent_id."'");
				$isAllOutwardItemReceived=$this->db->rp_getTotalRecord("outward_store_item","purchase_indent_id='".$purchase_indent_id."' AND purchase_indent_item_id='".$purchase_indent_item_id."' AND status=0");
				if($isAllPurchaseIndentItemReceived<=0)
				{
					$isOSUpdated=$this->db->rp_update("outward_store",$update_array,"purchase_indent_id='".$purchase_indent_id."'");
					return true;
				}
				else
				{
					$isOSUpdated=$this->db->rp_update("outward_store",$update_return_array,"purchase_indent_id='".$purchase_indent_id."'");
					return false;
				}
				return false;
			}
		}
		else
		{
			return false;
		}
	}
}

?>