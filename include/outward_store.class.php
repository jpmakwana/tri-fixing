<?php
require_once("main.class.php");
require_once("function.class.php");
require_once("purchase_indent.class.php");


class Store extends Functions
{
	public $db,$log;
	public $purchse_indent;
	public $ctable="outward_store";
	public $ctableRMItemMaster="item_rm";
	public $ctableSFGItemMaster="item_sfg";
	public $ctableFGItemMaster="item_fg";
	public $ctableMiniStore="mini_store";
	public $ctableMiniStoreItem="mini_store_item";
	public $ctableOutwardStoreItem="outward_store_item";
	function __construct($id="") 
	{
		$db = new Functions();
		$conn =$db->connect();
		$this->db=$db;
		$this->log=new Log();		   				
		$this->purchse_indent=new PurchaseIndent();		   
    } 
	public function InsertOutwardStore($detail,$item) 
	{
		/*echo json_encode($item);
		for($i=0;$i<sizeof($item);$i++)
		{
			$current_item=$item[$i];
			$where = " id='".$current_item['material_request_item_id']."' AND isDelete=0";
			$mr_items = $this->db->rp_getData("material_request_item","*",$where,"",0);
			$mr_item=mysqli_fetch_assoc($mr_items);
			$planning_id=$mr_item['planning_id'];
				echo "<br/>";
			$location_grid=$current_item['location_grid'];
			if(!empty($location_grid)){
				$total_qty=0;
				
				for($j=0;$j<sizeof($location_grid['location_id']);$j++)
				{
								echo $need_to_deduct_qty=floatval($location_grid['remain_qty'][$j]);
								$total_qty+=$need_to_deduct_qty;
								$location_track_info_id=$location_grid['location_id'][$j];
								$track_info_items=$this->db->rp_getData("location_track_item","*","location_track_info_id='".$location_track_info_id."' AND status=0");
								$barcode_no=$this->db->rp_getValue("location_track_info","location_track_barcode_no","id='".$location_track_info_id."'");
											
								if($track_info_items)
								{	while($track_info_item=mysqli_fetch_assoc($track_info_items))
									{
										echo "<br/>";
										print_r($track_info_item);
										echo "<br/>";
										$location_item_id=$track_info_item['id'];
										$location_track_inward_item_total_need_to_locate_qty=$track_info_item['location_track_inward_item_total_need_to_locate_qty'];
										if($need_to_deduct_qty>$track_info_item['inward_store_item_remaining_qty'])
										{
											$need_to_deduct_qty=$need_to_deduct_qty-$track_info_item['inward_store_item_remaining_qty'];
											$new_remaining_qty_on_this_location=0;
											$deduct_from_this_location=$track_info_item['inward_store_item_remaining_qty'];
										}
										else
										{
											$new_remaining_qty_on_this_location=$track_info_item['inward_store_item_remaining_qty']-$need_to_deduct_qty;
											$deduct_from_this_location=$need_to_deduct_qty;
											$need_to_deduct_qty=0;
											
										}
										
										echo "Location Track Item Need To Deduct  ID ".$location_item_id." <br/>".$need_to_deduct_qty." <br/> new_remaining_qty_on_this_location= ".$new_remaining_qty_on_this_location." <br/> deduct_from_this_location=".$deduct_from_this_location;
									}
									echo "<br/>";
								}	
				}
			}
		}
		exit;*/
		
		// Check whether enter qty available in stock or not
		$checkResult=$this->checkStockAvailability($item,0);
		if($checkResult['isValid'])
		{
			
			extract($detail);
			$adate	= date('Y-m-d H:i:s');
			$outward_store_no="J/O/00".$this->db->getlastInsertId($this->ctable);
			$rows 	= array(
						"material_request_id",
						"department_id",
						"outward_store_no",
						"created_date",
						"isDelete"
					);
			$values = array(
						$material_request_id,
						$department_id,
						$outward_store_no,
						$adate,
						0
					);
			$outward_store_id = $this->db->rp_insert($this->ctable,$values,$rows,0);
			
			$this->log->insertLog($this->ctable,$outward_store_id,"insert",$this->log->slm['OUTWARD_STORE_INSERT']." : ".$outward_store_no);
			
			if($outward_store_id!=0)
			{
				
			// Insert Outward Store Item
				if(!empty($item))
				{
					$outward_item=array();
					for($i=0;$i<sizeof($item);$i++)
					{
						$current_item=$item[$i];
						$where = " id='".$current_item['material_request_item_id']."' AND isDelete=0";
						$mr_items = $this->db->rp_getData("material_request_item","*",$where,"",0);
						$mr_item=mysqli_fetch_assoc($mr_items);
						$planning_id=$mr_item['planning_id'];
							
						$location_grid=$current_item['location_grid'];
						if(!empty($location_grid)){
							$total_qty=0;
							for($j=0;$j<sizeof($location_grid['location_id']);$j++)
							{
								$need_to_deduct_qty=floatval($location_grid['remain_qty'][$j]);
								$total_qty+=$need_to_deduct_qty;
								$location_track_info_id=$location_grid['location_id'][$j];
								$track_info_items=$this->db->rp_getData("location_track_item","*","location_track_info_id='".$location_track_info_id."'");
								$barcode_no=$this->db->rp_getValue("location_track_info","location_track_barcode_no","id='".$location_track_info_id."'");
											
								if($track_info_items)
								{	while($track_info_item=mysqli_fetch_assoc($track_info_items))
									{
											$location_item_id=$track_info_item['id'];
											$location_track_inward_item_total_need_to_locate_qty=$track_info_item['location_track_inward_item_total_need_to_locate_qty'];
											if($need_to_deduct_qty>$track_info_item['inward_store_item_remaining_qty'])
											{
												$need_to_deduct_qty=$need_to_deduct_qty-$track_info_item['inward_store_item_remaining_qty'];
												$new_remaining_qty_on_this_location=0;
												$deduct_from_this_location=$track_info_item['inward_store_item_remaining_qty'];
											}
											else
											{
												$new_remaining_qty_on_this_location=$track_info_item['inward_store_item_remaining_qty']-$need_to_deduct_qty;
												$deduct_from_this_location=$need_to_deduct_qty;
												$need_to_deduct_qty=0;
											}
											
											
											// Update location_track_item
											//// outward mapping with location
											$rows 	= array(
														"outward_store_id",
														"outward_store_item_id",
														"location_id",
														"location_item_id",
														"barcode_no",
														"outward_store_item_type",
														"outward_store_item_name",
														"outward_store_item_code",
														"outward_store_item_unit_id",
														"outward_store_item_unit_name",
														"outward_store_item_unit_slug",
														"outward_store_item_qty",
														"outward_store_item_original_qty",
														"created_date"
													);
											$values = array(
														$outward_store_id,	
														$mr_item['material_request_item_id'],
														$location_track_info_id,
														$location_item_id,
														$barcode_no,
														$mr_item['material_request_item_type'],
														$mr_item['material_request_item_name'],
														$mr_item['material_request_item_code'],
														$mr_item['material_request_item_unit'],
														$mr_item['material_request_item_unit_name'],
														$mr_item['material_request_item_unit_slug'],
														$deduct_from_this_location,
														$mr_item['material_request_item_remaining_qty'],
														$adate
													);	
											
											$outward_map_location_id=$this->db->rp_insert("outward_map_location",$values,$rows,0);
											
											// Update 
											if($new_remaining_qty_on_this_location<=0)
											{
												$status=2;
											}
											else if($new_remaining_qty_on_this_location>0)
											{
												$status=1;
											}
											$final_used_qty=$location_track_inward_item_total_need_to_locate_qty-$new_remaining_qty_on_this_location;
											$update=array("inward_store_item_remaining_qty"=>$new_remaining_qty_on_this_location,"inward_store_item_used_qty"=>$final_used_qty,"status"=>$status);
											$this->db->rp_update("location_track_item",$update,"id='".$location_item_id."'");
											
										if($need_to_deduct_qty<=0){
											break;
										}
											
									}
								}
								else
								{
									//ERROR SOMETHING WENT WRONG WITH LOCATIOB ITEMS
								}
								
								// Iterate Item From This Info And Update Item
								
								
								$this->updateLocationTrackInfo($location_track_info_id);
								$outward_item[]=$mr_item['material_request_item_name'];
							}
							$outward_item_list=implode(",",$outward_item);
					
						
						}	
					
					$current_item['received_qty']=$total_qty;
							
						$adate	= date('Y-m-d H:i:s');
						$rows 	= array(
							"outward_store_id",
							"material_request_id",
							"material_request_item_id",
							"outward_item_id",
							"outward_item_type",
							"outward_item_name",
							"outward_item_code",
							"outward_item_received_qty",
							"original_qty",
							"created_date",
							"isDelete"
						);
						$values = array(
							$outward_store_id,	
							$mr_item['material_request_id'],
							$current_item['material_request_item_id'],
							$mr_item['material_request_item_id'],
							$mr_item['material_request_item_type'],
							$mr_item['material_request_item_name'],
							$mr_item['material_request_item_code'],
							$current_item['received_qty'],
							$mr_item['material_request_item_qty'],
							$adate,								
							0
						);	
						
						if($current_item['received_qty']!=0)
						{
						
							$outward_store_item_id = $this->db->rp_insert("outward_store_item",$values,$rows,0);
							
							
							
							/// update outward_store_item_id at mapping location table
							$this->db->rp_update("outward_map_location",array("outward_store_item_table_id"=>$outward_store_item_id),"outward_store_id='".$outward_store_id."' AND outward_store_item_id='".$mr_item['material_request_item_id']."' AND outward_store_item_type='".$mr_item['material_request_item_type']."'");
							
							//insert ministore item
							$store_id = $this->db->rp_getValue("mini_store","id","department_id='".$department_id."'");
							if($store_id!="")
							{
								
								$isStoreItemAvailable = $this->db->rp_getTotalRecord("mini_store_item","store_id='".$store_id."' AND item_type='".$mr_item['material_request_item_type']."' AND item_id='".$mr_item['material_request_item_id']."'",0);
								//echo $isUpdate; exit;
								if($isStoreItemAvailable!=0)
								{
									///planning id
									
									if($mr_item['planning_id']==0){
										$item_qty = $this->db->rp_getValue("mini_store_item","item_stock_qty","store_id='".$store_id."' AND item_type='".$mr_item['material_request_item_type']."' AND item_id='".$mr_item['material_request_item_id']."'",0);
									
										$total = $item_qty+$current_item['received_qty'];
										$this->db->rp_update("mini_store_item",array("item_stock_qty"=>$total),"item_id='".$mr_item['material_request_item_id']."'",0);
									}
									else{
										$item_reserved_qty = $this->db->rp_getValue("mini_store_item","item_reserved_qty","store_id='".$store_id."' AND item_type='".$mr_item['material_request_item_type']."' AND item_id='".$mr_item['material_request_item_id']."'",0);
										
										$item_reserved_qty=$item_reserved_qty+$current_item['received_qty'];
										$this->db->rp_update("mini_store_item",array("item_reserved_qty"=>$item_reserved_qty),"item_id='".$mr_item['material_request_item_id']."'",0);
									}
									
									
								}
								else{
									if($mr_item['planning_id']==0){
										$item_stock_qty=$current_item['received_qty'];
										$item_reserved_qty=0;
									}
									else{
										$item_reserved_qty=$current_item['received_qty'];
										$item_stock_qty=0;
									}
									
									$adate	= date('Y-m-d H:i:s');
										$rows1 	= array(
										"store_id",
										"item_type",
										"item_id",
										"item_name",
										"item_code",
										"item_unit_id",
										"item_unit_name",
										"item_unit_slug",
										"item_stock_qty",
										"item_reserved_qty",
										"created_date",
										"isDelete"
									);
									$values1 = array(
										$store_id,	
										$mr_item['material_request_item_type'],
										$mr_item['material_request_item_id'],
										$mr_item['material_request_item_name'],
										$mr_item['material_request_item_code'],
										$mr_item['material_request_item_unit'],
										$mr_item['material_request_item_unit_name'],
										$mr_item['material_request_item_unit_slug'],
										$item_stock_qty,
										$item_reserved_qty,
										$adate,								
										0
									);
									$mini_store_item_id = $this->db->rp_insert("mini_store_item",$values1,$rows1,0);
									//$this->log->insertLog("mini_store_item",$mini_store_item_id,"insert","Mini Store ".$outward_store_no." Inserted  Item :\n".$outward_item_list);
								}
								
							}
							// end of mini store item insersion
							
							///// Update qty in material request item
							
							 $material_request_item_received_qty=$current_item['received_qty'];$material_request_item_remaining_qty=$mr_item['material_request_item_remaining_qty']-$material_request_item_received_qty;
							 
							$this->db->rp_update("material_request_item",array("material_request_item_remaining_qty"=>$material_request_item_remaining_qty,"material_request_item_received_qty"=>$material_request_item_received_qty),"material_request_id='".$mr_item['material_request_id']."' AND material_request_item_id='".$mr_item['material_request_item_id']."'",0);
						
							////// Update Stock in item master table
							if($mr_item['material_request_item_type']=="row_material")
							{	$ctable1='item_rm';
								$where = " id='".$mr_item['material_request_item_id']."' AND isDelete=0";
								$item_information = $this->db->rp_getData("item_rm","*",$where,"",0);
							
								if($item_information)
								{
									$item_information=mysqli_fetch_assoc($item_information);
									$item_id=$item_information['id'];
									if($planning_id==0)
									{
									$current_stock=$item_information['rm_stock_qty'];
									
									$rm_stock_qty=$current_stock-$current_item['received_qty'];
									$this->db->rp_update($ctable1,array("rm_stock_qty"=>$rm_stock_qty),"id='".$item_id."'",0);
									}
									else
									{
										$current_stock=$item_information['rm_item_reserved_qty'];
									
										$rm_item_reserved_qty=$current_stock-$current_item['received_qty'];
										$this->db->rp_update($ctable1,array("rm_item_reserved_qty"=>$rm_item_reserved_qty),"id='".$item_id."'",0);
									}
								}
							}
							else if($mr_item['material_request_item_type']=="finish_good")
							{ 
								 $ctable1='item_fg'; 
								 $where = " id='".$mr_item['material_request_item_id']."' AND isDelete=0";
								$item_information = $this->db->rp_getData($ctable1,"*",$where,0);
								if($item_information)
								{
									$item_information=mysqli_fetch_assoc($item_information);
									$item_id=$item_information['id'];
									if($planning_id==0)
									{
										$current_stock=$item_information['fg_stock_qty'];
										$fg_stock_qty=$current_stock-$current_item['received_qty'];
										$this->db->rp_update($ctable1,array("fg_stock_qty"=>$fg_stock_qty),"id='".$item_id."'",0);
									}
									else
									{
										$current_stock=$item_information['fg_item_reserved_qty'];$fg_item_reserved_qty=$current_stock-$current_item['received_qty'];
										$this->db->rp_update($ctable1,array("fg_item_reserved_qty"=>$fg_item_reserved_qty),"id='".$item_id."'",0);
									}
								}
							}
							else if($mr_item['material_request_item_type']=="semi_finish_good")
							{
								$ctable1='item_sfg';
								$where = " id='".$mr_item['material_request_item_id']."' AND isDelete=0";
								$item_information = $this->db->rp_getData($ctable1,"*",$where,0);
								if($item_information)
								{
									if($planning_id==0)
									{
									$item_information=mysqli_fetch_assoc($item_information);
									$item_id=$item_information['id'];
									$current_stock=$item_information['sfg_stock_qty'];
									
									$sfg_stock_qty=$current_stock-$current_item['received_qty'];
									$this->db->rp_update($ctable1,array("sfg_stock_qty"=>$sfg_stock_qty),"id='".$item_id."'");
									}
									else
									{
										$current_stock=$item_information['sfg_item_reserved_qty'];
										$sfg_item_reserved_qty=$current_stock-$current_item['received_qty'];
										$this->db->rp_update($ctable1,array("sfg_item_reserved_qty"=>$sfg_item_reserved_qty),"id='".$item_id."'",0);
									}
								}
							}
							
						}
						///// update status
						
						
						/*}else{
							$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Outward Store Item added Failed!! Please Enter Valid Receive Qty.");
							return $reply;
						}*/
						$this->updateItemStatus($outward_store_item_id);
						
						
						
					}
					$this->log->insertLog("outward_store_item",$outward_store_id,"insert","Outward Store ".$outward_store_no." Inserted  Item :\n".$outward_item_list);				
				}					
				
				
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('OUTWARD_STORE_INSERT',1),"ack_msg"=>$this->log->getMessage('OUTWARD_STORE_INSERT'),"outward_store_id"=>$outward_store_id);
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Store Item added Failed.");
				return $reply;
			}
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"Stock Error!!","ack_msg"=>"Some item not available in stock.<br/>".implode("<br/>",$checkResult['error']));
			return $reply;
		}
		
	}
	 
	public function UpdateOutwardStore($detail,$item)
	{
		$total_qty=0;
		extract($detail);
		$outward_store_id=$_REQUEST['id'];
		$outward_store_no=$this->db->rp_getValue($this->ctable,"outward_store_no","isDelete=0 AND id='".$outward_store_id."'");
		$department_id=$this->db->rp_getValue($this->ctable,"department_id","id='".$outward_store_id."'");
		$store_id=$this->db->rp_getValue($this->ctableMiniStore,"id","department_id='".$department_id."'");
		// Check whether enter qty available in stock or not
		$checkResult=$this->checkStockAvailability($item,$outward_store_id,$store_id);
		if($checkResult['isValid'])
		{
			//// Add in stock table existing qty
			for($i=0;$i<sizeof($item);$i++)
			{
				$current_item=$item[$i];
				
				$where = " id='".$current_item['material_request_item_id']."' AND isDelete=0";
				$mr_items = $this->db->rp_getData("material_request_item","*",$where,"",0);
				$mr_item=mysqli_fetch_assoc($mr_items);
				
				$where = " id='".$current_item['outward_item_id']."' AND isDelete=0";
				$outward_items = $this->db->rp_getData("outward_store_item","*",$where,"",0);
				$outward_item=mysqli_fetch_assoc($outward_items);
				if($outward_item['outward_item_type']=="row_material")
				{	$ctable1='item_rm';
					$where = " id='".$outward_item['outward_item_id']."' AND isDelete=0";
					$item_info = $this->db->rp_getData("item_rm","*",$where,"",0);
				
					if($item_info)
					{
						$item_info=mysqli_fetch_assoc($item_info);
						$item_id=$item_info['id'];
						$current_stock=$item_info['rm_stock_qty'];
						
						$rm_stock_qty=$current_stock+$outward_item['outward_item_received_qty'];
						$this->db->rp_update($ctable1,array("rm_stock_qty"=>$rm_stock_qty),"id='".$item_id."'",0);
					}
				}
				else if($outward_item['outward_item_type']=="finish_good")
				{ 
					 $ctable1='item_fg'; 
					 $where = " id='".$outward_item['outward_item_id']."' AND isDelete=0";
					$item_info = $this->db->rp_getData($ctable1,"*",$where,0);
					if($item_info)
					{
						$item_info=mysqli_fetch_assoc($item_info);
						$item_id=$item_info['id'];
						$current_stock=$item_info['fg_stock_qty'];
						
						$fg_stock_qty=$current_stock+$outward_item['outward_item_received_qty'];
						$this->db->rp_update($ctable1,array("fg_stock_qty"=>$fg_stock_qty),"id='".$item_id."'",0);
					}
				}
				else if($outward_item['outward_item_type']=="semi_finish_good")
				{
					$ctable1='item_sfg';
					$where = " id='".$outward_item['outward_item_id']."' AND isDelete=0";
					$item_info = $this->db->rp_getData($ctable1,"*",$where,0);
					if($item_info)
					{
						$item_info=mysqli_fetch_assoc($item_info);
						$item_id=$item_info['id'];
						$current_stock=$item_info['sfg_stock_qty'];
						
						$sfg_stock_qty=$current_stock+$outward_item['outward_item_received_qty'];
						$this->db->rp_update($ctable1,array("sfg_stock_qty"=>$sfg_stock_qty),"id='".$item_id."'");
					}
				}
				
				
				
				///// location track
				
				$outward_mapping_items=$this->db->rp_getData("outward_map_location","*","outward_store_id='".$outward_store_id."'","",0);
				if($outward_mapping_items)
				{	
					$count=0;
					while($outward_mapping_item=mysqli_fetch_assoc($outward_mapping_items))
					{
						$count++;
						$track_info_items=$this->db->rp_getData("location_track_item","*","id='".$outward_mapping_item['location_item_id']."'","",0);
						$track_info_item=mysqli_fetch_assoc($track_info_items);
						/*
						if($need_to_deduct_qty1>$track_info_item['inward_store_item_remaining_qty'])
						{
							$need_to_deduct_qty1=$need_to_deduct_qty1+$track_info_item['inward_store_item_remaining_qty'];
							$new_remaining_qty_on_this_location=0;
							$deduct_from_this_location=$track_info_item['inward_store_item_remaining_qty'];
						}
						else
						{
							$new_remaining_qty_on_this_location=$track_info_item['inward_store_item_remaining_qty']+$need_to_deduct_qty1;
							$deduct_from_this_location=$need_to_deduct_qty1;
							$need_to_deduct_qty1=0;
						}
						*/
						$location_track_inward_item_total_need_to_locate_qty=$track_info_item['location_track_inward_item_total_need_to_locate_qty'];
						$current_remaining_qty=$track_info_item['inward_store_item_remaining_qty'];
						$need_to_add_back_qty=floatval($outward_mapping_item['outward_store_item_qty']);
						$new_remaining_qty=$need_to_add_back_qty+$current_remaining_qty;
						$new_used_qty=$location_track_inward_item_total_need_to_locate_qty-$new_remaining_qty;
						// Update 
						if($new_remaining_qty<=0)
						{
							$status=2;
						}
						else if($new_remaining_qty>0)
						{
							$status=1;
						}
						$update=array("inward_store_item_remaining_qty"=>$new_remaining_qty,"inward_store_item_used_qty"=>$new_used_qty,"status"=>$status);
						
						$this->db->rp_update("location_track_item",$update,"id='".$outward_mapping_item['location_item_id']."'");
						
						$this->updateLocationTrackInfo($outward_mapping_item['location_id']);
					}
					
				}
				
				
				
				// Update Mini Store 
				if($store_id!="")
				{
					$planning_id=$this->db->rp_getValue("material_request_item","planning_id","id='".$outward_item['material_request_item_id']."'",0);
					if($planning_id==0){
						$current_store_qty=$this->db->rp_getValue($this->ctableMiniStoreItem,"item_stock_qty","item_id='".$outward_item['outward_item_id']."' AND item_type='".$outward_item['outward_item_type']."' AND store_id='".$store_id."'",0);
						if($current_store_qty!="")
						{
							$new_store_item_qty=floatval($current_store_qty)-floatval($outward_item['outward_item_received_qty']);
							$this->db->rp_update($this->ctableMiniStoreItem,array("item_stock_qty"=>$new_store_item_qty),"item_id='".$outward_item['outward_item_id']."' AND item_type='".$outward_item['outward_item_type']."' AND store_id='".$store_id."'");
						}
					}
					else{
						$current_reserved_qty=$this->db->rp_getValue($this->ctableMiniStoreItem,"item_reserved_qty","item_id='".$outward_item['outward_item_id']."' AND item_type='".$outward_item['outward_item_type']."' AND store_id='".$store_id."'",0);
						if($current_reserved_qty!="")
						{
							$new_store_item_qty1=floatval($current_reserved_qty)-floatval($outward_item['outward_item_received_qty']);
							$this->db->rp_update($this->ctableMiniStoreItem,array("item_reserved_qty"=>$new_store_item_qty1),"item_id='".$outward_item['outward_item_id']."' AND item_type='".$outward_item['outward_item_type']."' AND store_id='".$store_id."'");
							
						}
					}
				}
				
			}
			
		/*	
			///// location track
						$location_grid=$current_item['location_grid'];
						if(!empty($location_grid)){
							for($j=0;$j<sizeof($location_grid['location_id']);$j++)
							{
								$total_qty=0;
								$need_to_deduct_qty=floatval($location_grid['remain_qty'][$j]);
								$total_qty+=$need_to_deduct_qty;
								$location_track_info_id=$location_grid['location_id'][$j];
								$track_info_items=$this->db->rp_getData("location_track_item","*","location_track_info_id='".$location_track_info_id."'","",0);
								$barcode_no=$this->db->rp_getValue("location_track_info","location_track_barcode_no","id='".$location_track_info_id."'");
											
								if($track_info_items)
								{	
									while($track_info_item=mysqli_fetch_assoc($track_info_items))
									{
											$location_item_id=$track_info_item['id'];
											$location_track_inward_item_total_need_to_locate_qty=$track_info_item['location_track_inward_item_total_need_to_locate_qty'];
											if($need_to_deduct_qty>$track_info_item['inward_store_item_remaining_qty'])
											{
												$need_to_deduct_qty=$need_to_deduct_qty-$track_info_item['inward_store_item_remaining_qty'];
												$new_remaining_qty_on_this_location=0;
												$deduct_from_this_location=$track_info_item['inward_store_item_remaining_qty'];
											}
											else
											{
												$new_remaining_qty_on_this_location=$track_info_item['inward_store_item_remaining_qty']-$need_to_deduct_qty;
												$deduct_from_this_location=$need_to_deduct_qty;
												$need_to_deduct_qty=0;
											}
										//	echo $new_remaining_qty_on_this_location; exit;
											$adate=date('Y-m-d H:i:s');
											
										
											
											if($new_remaining_qty_on_this_location<=0)
											{
												$status=2;
											}
											else if($new_remaining_qty_on_this_location>0)
											{
												$status=1;
											}
											echo  "need to deduct".$need_to_deduct_qty;
											echo "<br/>";
											echo "remaining qty ".$new_remaining_qty_on_this_location;
											echo "<br/>";
											echo "used_qty ".$final_used_qty=$location_track_inward_item_total_need_to_locate_qty-$new_remaining_qty_on_this_location;
											echo "<br/>";
											if($need_to_deduct_qty<=0){
												break;
											}
									}
										
								}
								else
								{
									//ERROR SOMETHING WENT WRONG WITH LOCATIOB ITEMS
								}
								
							}
							exit;
						
						}
			
			
			
			*/
			
			
			
			
			
			
			
			
				// Insert Outward Store Item
				$this->db->rp_delete("outward_store_item","outward_store_id='".$outward_store_id."'",0);
				$this->db->rp_delete("outward_map_location","outward_store_id='".$outward_store_id."'",0);
			
				if(!empty($item))
				{
					$outward_item=array();
					for($i=0;$i<sizeof($item);$i++)
					{
						$current_item=$item[$i];
						$where = " id='".$current_item['material_request_item_id']."' AND isDelete=0";
						$mr_items = $this->db->rp_getData("material_request_item","*",$where,"",0);
						$mr_item=mysqli_fetch_assoc($mr_items);
						$planning_id=$mr_item['planning_id'];
						
						///// location track
						$location_grid=$current_item['location_grid'];
						if(!empty($location_grid)){
							for($j=0;$j<sizeof($location_grid['location_id']);$j++)
							{
								$total_qty=0;
								$need_to_deduct_qty=floatval($location_grid['remain_qty'][$j]);
								$total_qty+=$need_to_deduct_qty;
								$location_track_info_id=$location_grid['location_id'][$j];
								$track_info_items=$this->db->rp_getData("location_track_item","*","location_track_info_id='".$location_track_info_id."'","",0);
								$barcode_no=$this->db->rp_getValue("location_track_info","location_track_barcode_no","id='".$location_track_info_id."'");
											
								if($track_info_items)
								{	
									while($track_info_item=mysqli_fetch_assoc($track_info_items))
									{
											$location_item_id=$track_info_item['id'];
											$location_track_inward_item_total_need_to_locate_qty=$track_info_item['location_track_inward_item_total_need_to_locate_qty'];
											if($need_to_deduct_qty>$track_info_item['inward_store_item_remaining_qty'])
											{
												$need_to_deduct_qty=$need_to_deduct_qty-$track_info_item['inward_store_item_remaining_qty'];
												$new_remaining_qty_on_this_location=0;
												$deduct_from_this_location=$track_info_item['inward_store_item_remaining_qty'];
											}
											else
											{
												$new_remaining_qty_on_this_location=$track_info_item['inward_store_item_remaining_qty']-$need_to_deduct_qty;
												$deduct_from_this_location=$need_to_deduct_qty;
												$need_to_deduct_qty=0;
											}
										//	echo $new_remaining_qty_on_this_location; exit;
											$adate=date('Y-m-d H:i:s');
											
											// Update location_track_item
											//// outward mapping with location
											$rows 	= array(
														"outward_store_id",
														"outward_store_item_id",
														"location_id",
														"location_item_id",
														"barcode_no",
														"outward_store_item_type",
														"outward_store_item_name",
														"outward_store_item_code",
														"outward_store_item_unit_id",
														"outward_store_item_unit_name",
														"outward_store_item_unit_slug",
														"outward_store_item_qty",
														"outward_store_item_original_qty",
														"created_date"
													);
											$values = array(
														$outward_store_id,	
														$mr_item['material_request_item_id'],
														$location_track_info_id,
														$location_item_id,
														$barcode_no,
														$mr_item['material_request_item_type'],
														$mr_item['material_request_item_name'],
														$mr_item['material_request_item_code'],
														$mr_item['material_request_item_unit'],
														$mr_item['material_request_item_unit_name'],
														$mr_item['material_request_item_unit_slug'],
														$deduct_from_this_location,
														$mr_item['material_request_item_remaining_qty'],
														$adate
													);	
											
											$outward_map_location_id=$this->db->rp_insert("outward_map_location",$values,$rows,0);
											
											// Update 
											
											if($new_remaining_qty_on_this_location<=0)
											{
												$status=2;
											}
											else if($new_remaining_qty_on_this_location>0)
											{
												$status=1;
											}
											$final_used_qty=$location_track_inward_item_total_need_to_locate_qty-$new_remaining_qty_on_this_location;
									
											$update=array("inward_store_item_remaining_qty"=>$new_remaining_qty_on_this_location,"inward_store_item_used_qty"=>$final_used_qty,"status"=>$status);
											$this->db->rp_update("location_track_item",$update,"id='".$location_item_id."'",0);
											
											if($need_to_deduct_qty<=0){
												break;
											}
									}
										
								}
								else
								{
									//ERROR SOMETHING WENT WRONG WITH LOCATIOB ITEMS
								}
								
								// Iterate Item From This Info And Update Item
								
								
								$this->updateLocationTrackInfo($location_track_info_id);
								$outward_item[]=$mr_item['material_request_item_name'];
							}
							$outward_item_list=implode(",",$outward_item);
					
						
						}	
						$old_qty=$outward_item['outward_item_received_qty'];
						$current_item['received_qty']=$total_qty+$old_qty; 
						
						
						
						
						
						//if($current_item['received_qty']<=$current_item['required_qty'])
						//{
							$adate	= date('Y-m-d H:i:s');
							$rows 	= array(
							"outward_store_id",
							"material_request_id",
							"material_request_item_id",
							"outward_item_id",
							"outward_item_type",
							"outward_item_name",
							"outward_item_code",
							"outward_item_received_qty",
							"original_qty",
							"created_date",
							"isDelete"
						);
						$values = array(
							$outward_store_id,	
							$mr_item['material_request_id'],
							$current_item['material_request_item_id'],
							$mr_item['material_request_item_id'],
							$mr_item['material_request_item_type'],
							$mr_item['material_request_item_name'],
							$mr_item['material_request_item_code'],
							$current_item['received_qty'],
							$mr_item['material_request_item_qty'],
							$adate,								
							0
						);	
						
						if($current_item['received_qty']!=0)
						{
							$outward_store_item_id = $this->db->rp_insert("outward_store_item",$values,$rows,0);
							
							/// update outward_store_item_id at mapping location table
							$this->db->rp_update("outward_map_location",array("outward_store_item_table_id"=>$outward_store_item_id),"outward_store_id='".$outward_store_id."' AND outward_store_item_id='".$mr_item['material_request_item_id']."' AND outward_store_item_type='".$mr_item['material_request_item_type']."'");
							
							if($store_id!="")
							{
								//update ministore item
								$isStoreItemAvailable = $this->db->rp_getTotalRecord("mini_store_item","item_type='".$mr_item['material_request_item_type']."' AND item_id='".$mr_item['material_request_item_id']."' AND store_id='".$store_id."'",0);
								
								if($isStoreItemAvailable!=0)
								{
									///planning id
									
									if($mr_item['planning_id']==0){
										$item_qty = $this->db->rp_getValue("mini_store_item","item_stock_qty"," item_type='".$mr_item['material_request_item_type']."' AND item_id='".$mr_item['material_request_item_id']."' AND store_id='".$store_id."'",0);
									
										$total = $item_qty+$current_item['received_qty'];
										$this->db->rp_update("mini_store_item",array("item_stock_qty"=>$total),"item_id='".$mr_item['material_request_item_id']."' AND store_id='".$store_id."'",0);
									}
									else{
										
										
										
										$item_reserved_qty = $this->db->rp_getValue("mini_store_item","item_reserved_qty","store_id='".$store_id."' AND item_type='".$mr_item['material_request_item_type']."' AND item_id='".$mr_item['material_request_item_id']."'",0);
										
										$item_reserved_qty=$item_reserved_qty+$current_item['received_qty'];
										$this->db->rp_update("mini_store_item",array("item_reserved_qty"=>$item_reserved_qty),"item_id='".$mr_item['material_request_item_id']."' AND store_id='".$store_id."'",0);
									}
								}
								else
								{
									if($mr_item['planning_id']==0){
										$item_stock_qty=$current_item['received_qty'];
										$item_reserved_qty=0;
									}
									else{
										$item_stock_qty=0;
										$item_reserved_qty=$current_item['received_qty'];
									}
									
									$adate	= date('Y-m-d H:i:s');
										$rows1 	= array(
										"store_id",
										"item_type",
										"item_id",
										"item_name",
										"item_code",
										"item_unit_id",
										"item_unit_name",
										"item_unit_slug",
										"item_stock_qty",
										"item_reserved_qty",
										"created_date",
										"isDelete"
									);
									$values1 = array(
										$store_id,	
										$mr_item['material_request_item_type'],
										$mr_item['material_request_item_id'],
										$mr_item['material_request_item_name'],
										$mr_item['material_request_item_code'],
										$mr_item['material_request_item_unit'],
										$mr_item['material_request_item_unit_name'],
										$mr_item['material_request_item_unit_slug'],
										$item_stock_qty,
										$item_reserved_qty,
										$adate,								
										0
									);
									$mini_store_item_id = $this->db->rp_insert("mini_store_item",$values1,$rows1,0);
								}
								// end of mini store item updation
							}
							///// Update in material request item qty
							$material_request_item_received_qty=$this->ReceivedQty($mr_item['material_request_id'],$current_item['material_request_item_id']);
							$material_request_item_remaining_qty=$mr_item['material_request_item_qty']-$material_request_item_received_qty;
							
							$this->db->rp_update("material_request_item",array("material_request_item_remaining_qty"=>$material_request_item_remaining_qty,"material_request_item_received_qty"=>$material_request_item_received_qty),"material_request_id='".$mr_item['material_request_id']."' AND material_request_item_id='".$mr_item['material_request_item_id']."'",0);
							
							////// Update Stock in item master table
							if($mr_item['material_request_item_type']=="row_material")
							{	$ctable1='item_rm';
								$where = " id='".$mr_item['material_request_item_id']."' AND isDelete=0";
								$item_information = $this->db->rp_getData("item_rm","*",$where,"",0);
							
								if($item_information)
								{
									$item_information=mysqli_fetch_assoc($item_information);
									$item_id=$item_information['id'];
									if($planning_id==0)
									{
									$current_stock=$item_information['rm_stock_qty'];
									$rm_stock_qty=$current_stock-$current_item['received_qty'];
									$this->db->rp_update($ctable1,array("rm_stock_qty"=>$rm_stock_qty),"id='".$item_id."'",0);
									}
									else
									{
										$current_stock=$item_information['rm_item_reserved_qty'];
									
										$rm_item_reserved_qty=$current_stock-$current_item['received_qty'];
										$this->db->rp_update($ctable1,array("rm_item_reserved_qty"=>$rm_item_reserved_qty),"id='".$item_id."'",1);
									}
								}
							}
							else if($mr_item['material_request_item_type']=="finish_good")
							{ 
								 $ctable1='item_fg'; 
								 $where = " id='".$mr_item['material_request_item_id']."' AND isDelete=0";
								$item_information = $this->db->rp_getData($ctable1,"*",$where,0);
								if($item_information)
								{
									$item_information=mysqli_fetch_assoc($item_information);
									$item_id=$item_information['id'];
									if($planning_id==0)
									{
										$current_stock=$item_information['fg_stock_qty'];
										$fg_stock_qty=$current_stock-$current_item['received_qty'];
										$this->db->rp_update($ctable1,array("fg_stock_qty"=>$fg_stock_qty),"id='".$item_id."'",0);
									}
									else
									{
										$current_stock=$item_information['fg_item_reserved_qty'];$fg_item_reserved_qty=$current_stock-$current_item['received_qty'];
										$this->db->rp_update($ctable1,array("fg_item_reserved_qty"=>$fg_item_reserved_qty),"id='".$item_id."'",0);
									}
								}
							}
							else if($mr_item['material_request_item_type']=="semi_finish_good")
							{
								$ctable1='item_sfg';
								$where = " id='".$mr_item['material_request_item_id']."' AND isDelete=0";
								$item_information = $this->db->rp_getData($ctable1,"*",$where,0);
								if($item_information)
								{
									if($planning_id==0)
									{
									$item_information=mysqli_fetch_assoc($item_information);
									$item_id=$item_information['id'];
									$current_stock=$item_information['sfg_stock_qty'];
									
									$sfg_stock_qty=$current_stock-$current_item['received_qty'];
									$this->db->rp_update($ctable1,array("sfg_stock_qty"=>$sfg_stock_qty),"id='".$item_id."'");
									}
									else
									{
										$current_stock=$item_information['sfg_item_reserved_qty'];
										$sfg_item_reserved_qty=$current_stock-$current_item['received_qty'];
										$this->db->rp_update($ctable1,array("sfg_item_reserved_qty"=>$sfg_item_reserved_qty),"id='".$item_id."'",0);
									}
								}
							}
							///// update status
							$this->updateItemStatus($outward_store_item_id);
						}
						
						/*}else{
							$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Outward Store Item added Failed!! Please Enter Valid Receive Qty.");
							return $reply;
						}*/
						$outward_item[]=$mr_item['material_request_item_name'];
					}
					$outward_item_list=implode(",",$outward_item);
			
			 $this->log->insertLog("outward_store_item",$outward_store_id,"Update","Outward Store ".$outward_store_no." Updated Item :\n".$outward_item_list);
			 
			 // $this->log->insertLog("mini_store_item",$_REQUEST['id'],"Update","Outward Store ".$outward_store_no." Updated Item :\n".$outward_item_list);
			 
			
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('OUTWARD_STORE_UPDATE',1),"ack_msg"=>$this->log->getMessage('OUTWARD_STORE_UPDATE'));
				return $reply;					
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Store Update Failed.");
				return $reply;
			}
		}
		else
		{
			// again update stock as per old items
			$reply=array("ack"=>0,"developer_msg"=>"Outwarded Item already used could not edit.","ack_msg"=>"Outwarded Item already used could not edit. <br/>".implode("<br/>",$checkResult['error']));
			return $reply;
		}
		
		
	}
	public function GetOutwardStore($detail)
	{		
		$where = " id='".$_REQUEST['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where,"",0);		
		$ctable_d = mysqli_fetch_array($ctable_r);
		$departments=$this->db->rp_getData("department","*","id='".$ctable_d['department_id']."'",0);
		$department=mysqli_fetch_assoc($departments);
		$result=array();
		
		$result['department_id']		= htmlentities($ctable_d['department_id']);
		$result['department_code']		= htmlentities($department['department_code']);
		$result['department_name']		= htmlentities($department['department_name']);
		$result['material_request_id']		= htmlentities($ctable_d['material_request_id']);
		$result['remark']		= htmlentities($ctable_d['remark']);
		$result['created_date']		= htmlentities($ctable_d['created_date']);
		
		$reply=array("ack"=>1,"developer_msg"=>"Store detail fetched!!.","ack_msg"=>"Success! Store Edit Successfully.","result"=>$result);
		return $reply;
		
	}
	public function GetOutwardStoreItem($detail)
	{		
			
			$where = "outward_store_id='".$detail['id']."' AND isDelete=0";
			$ctable_item = $this->db->rp_getData("outward_store_item","*",$where,"",0);
			
		
			if($ctable_item)
			{
				
			while($ctable_item_d = mysqli_fetch_array($ctable_item))
			{
				$mr_items=$this->db->rp_getData("material_request_item","*","material_request_id='".$ctable_item_d['material_request_id']."' AND material_request_item_id='".$ctable_item_d['outward_item_id']."' AND id='".$ctable_item_d['material_request_item_id']."'",0);
				$mr_item=mysqli_fetch_assoc($mr_items);
				
				$receive_qty=$this->ReceivedQty($ctable_item_d['material_request_id'],$ctable_item_d['material_request_item_id']);
				$remaining_qty=$mr_item['material_request_item_qty']-$receive_qty;
				
				if($ctable_item_d['outward_item_type']=="row_material"){
					$current_item_stock=$this->db->rp_getValue("item_rm","rm_stock_qty","id= '".$ctable_item_d['outward_item_id']."' AND isDelete=0",0);
				}else if($ctable_item_d['outward_item_type']=="semi_finish_good"){
					$current_item_stock=$this->db->rp_getValue("item_sfg","sfg_stock_qty","id= '".$ctable_item_d['outward_item_id']."' AND isDelete=0",0);
					
				}else if($ctable_item_d['outward_item_type']=="finish_good"){
					$current_item_stock=$this->db->rp_getValue("item_fg","fg_stock_qty","id= '".$ctable_item_d['outward_item_id']."' AND isDelete=0",0);
				}
				
				$result_item=array();
				
				$result_item['outward_item_name']				= htmlentities($ctable_item_d['outward_item_name']);
				$result_item['outward_item_id']				= htmlentities($ctable_item_d['id']);
				$result_item['outward_item_type']				= htmlentities($ctable_item_d['outward_item_type']);
				$result_item['item_table_id']				= htmlentities($ctable_item_d['outward_item_id']);
				$result_item['outward_item_code']		= htmlentities($ctable_item_d['outward_item_code']);
				$result_item['material_request_item_qty']		= htmlentities($mr_item['material_request_item_qty']);
				$result_item['outward_item_received_qty']	= htmlentities($ctable_item_d['outward_item_received_qty']);
				$result_item['material_request_item_id']	= htmlentities($ctable_item_d['material_request_item_id']);
				$result_item['remaining_qty']	= htmlentities($remaining_qty);
				$result_item['current_item_stock']	= $current_item_stock;
				$results[]=$result_item;
			}
			
			$reply=array("ack"=>1,"developer_msg"=>"Store detail fetched!!.","ack_msg"=>"Success! Update Store Successfully.","result"=>$results);
			return $reply;
			
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"Update not fetched!!.","ack_msg"=>"Success! Update Failed"	);
			return $reply;
		}
	
	}
	
	public function DeleteOutwardStore($detail)
	{
		$outward_store_id=$detail['id'];
		$outward_store_no=$this->db->rp_getValue($this->ctable,"outward_store_no","isDelete=0 AND id='".$detail['id']."'");
		$item=$this->db->rp_getData($this->ctableOutwardStoreItem,"*","outward_store_id='".$outward_store_id."'","",0);
		$item=mysqli_fetch_assoc($item);
		
		$department_id=$this->db->rp_getValue($this->ctable,"department_id","id='".$outward_store_id."'");
		$store_id=$this->db->rp_getValue($this->ctableMiniStore,"id","department_id='".$department_id."'"); 
		// Check whether enter qty available in stock or not
		$checkResult=$this->checkStockAvailability($item,$outward_store_id,$store_id);
		if($checkResult['isValid'])
		{
			$rows 	= array(
				"isDelete"	=> "1"
			);
			$where	= "id='".$_REQUEST['id']."'";
			$isUpdated=$this->db->rp_update($this->ctable,$rows,$where);
			$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['OUTWARD_STORE_DELETE']." : ".$outward_store_no);
			if($isUpdated)
			{
				$outward_store_r=$this->db->rp_getData("outward_store_item","*","outward_store_id='".$_REQUEST['id']."'","",0);
		
				if($outward_store_r){
					$outward_store_d=array();
					while($outward_store_d=mysqli_fetch_assoc($outward_store_r)){
						$outward_store_items[]=$outward_store_d;
					}
					foreach($outward_store_items as $item){
						$outward_item_received_qty=$item['outward_item_received_qty'];
					
						$material_request_item_id=$item['material_request_item_id'];
						$outward_store_item_id=$item['id'];
						
					///// Update material request item qty	
						
					$mr_item_r=$this->db->rp_getData("material_request_item","*","id='".$material_request_item_id."'","",0);
						if($mr_item_r)
						{
							$issue_item=array();
							$mr_item_d=mysqli_fetch_assoc($mr_item_r);
								
								$material_request_item_received_qty=$mr_item_d['material_request_item_received_qty'];
								$material_request_item_remaining_qty=$mr_item_d['material_request_item_remaining_qty'];
								
							
							$remaining_qty=$material_request_item_remaining_qty+$outward_item_received_qty;
							$received_qty=$material_request_item_received_qty-$outward_item_received_qty;
							
							$rows 	= array(
										"material_request_item_received_qty"	=> $received_qty,
										"material_request_item_remaining_qty"	=> $remaining_qty
										);
								
							$UpdateIssueItem=$this->db->rp_update("material_request_item",$rows,"id='".$material_request_item_id."'",0);
							$this->db->rp_update("outward_store_item",array("outward_item_received_qty"=>0),"id='".$outward_store_item_id."'",0);
									
							if($UpdateIssueItem){
								//$this->updateItemStatus($outward_store_item_id);
							}
						}
						
						//// Update in stock table
						if($item['outward_item_type']=="row_material")
						{	$ctable1='item_rm';
							$where = " id='".$item['outward_item_id']."' AND isDelete=0";
							$item_info = $this->db->rp_getData("item_rm","*",$where,"",0);
						
							if($item_info)
							{
								$item_info=mysqli_fetch_assoc($item_info);
								$item_id=$item_info['id'];
								$current_stock=$item_info['rm_stock_qty'];
								
								$rm_stock_qty=$current_stock+$item['outward_item_received_qty'];
								$this->db->rp_update($ctable1,array("rm_stock_qty"=>$rm_stock_qty),"id='".$item_id."'",0);
							}
						}
						else if($item['outward_item_type']=="finish_good")
						{ 
							 $ctable1='item_fg'; 
							 $where = " id='".$item['outward_item_id']."' AND isDelete=0";
							$item_info = $this->db->rp_getData($ctable1,"*",$where,0);
							if($item_info)
							{
								$item_info=mysqli_fetch_assoc($item_info);
								$item_id=$item_info['id'];
								$current_stock=$item_info['fg_stock_qty'];
								
								$fg_stock_qty=$current_stock+$item['outward_item_received_qty'];
								$this->db->rp_update($ctable1,array("fg_stock_qty"=>$fg_stock_qty),"id='".$item_id."'",0);
							}
						}
						else if($item['outward_item_type']=="semi_finish_good")
						{
							$ctable1='item_sfg';
							$where = " id='".$item['outward_item_id']."' AND isDelete=0";
							$item_info = $this->db->rp_getData($ctable1,"*",$where,0);
							if($item_info)
							{
								$item_info=mysqli_fetch_assoc($item_info);
								$item_id=$item_info['id'];
								$current_stock=$item_info['sfg_stock_qty'];
								
								$sfg_stock_qty=$current_stock+$item['outward_item_received_qty'];
								$this->db->rp_update($ctable1,array("sfg_stock_qty"=>$sfg_stock_qty),"id='".$item_id."'");
							}
						}
						
						// Update MiniStore
						
						if($store_id!="")
						{
							$planning_id=$this->db->rp_getValue("material_request_item","planning_id","id='".$material_request_item_id."'",0);
							if($planning_id==0){
								$current_store_qty=$this->db->rp_getValue($this->ctableMiniStoreItem,"item_stock_qty","item_id='".$item['outward_item_id']."' AND item_type='".$item['outward_item_type']."' AND store_id='".$store_id."'",0);
								if($current_store_qty!="")
								{
									$new_store_item_qty=floatval($current_store_qty)-floatval($item['outward_item_received_qty']);
									$this->db->rp_update($this->ctableMiniStoreItem,array("item_stock_qty"=>$new_store_item_qty),"item_id='".$item['outward_item_id']."' AND item_type='".$item['outward_item_type']."' AND store_id='".$store_id."'");
								}
							}
							else{
								$current_reserved_qty=$this->db->rp_getValue($this->ctableMiniStoreItem,"item_reserved_qty","item_id='".$item['outward_item_id']."' AND item_type='".$item['outward_item_type']."' AND store_id='".$store_id."'",0);
								if($current_reserved_qty!="")
								{
									$new_store_item_qty1=floatval($current_reserved_qty)-floatval($item['outward_item_received_qty']);
									$this->db->rp_update($this->ctableMiniStoreItem,array("item_reserved_qty"=>$new_store_item_qty1),"item_id='".$item['outward_item_id']."' AND item_type='".$item['outward_item_type']."' AND store_id='".$store_id."'");
									
								}
							}
						}
					
						///// update status
						$this->updateItemStatus($outward_store_item_id);
					}
				}
				
				
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('OUTWARD_STORE_DELETE',1),"ack_msg"=>$this->log->getMessage('OUTWARD_STORE_DELETE'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Delete Store Item Failed.");
				return $reply;
			}
		}
		else{
			// again update stock as per old items
			$reply=array("ack"=>0,"developer_msg"=>"Outwarded Item already used could not edit.","ack_msg"=>"Outwarded Item already used could not edit. <br/>".implode("<br/>",$checkResult['error']));
			return $reply;
		}
		
	}
	public function ReceivedQty($material_request_id,$material_request_item_id){
		
		$mr_id=$this->db->rp_getData($this->ctable,"id","material_request_id='".$material_request_id."'","",0);
		if($mr_id)
		{
			$received_qty_r=$this->db->rp_getData("outward_store_item","SUM(outward_item_received_qty) as total_received_qty","material_request_id='".$material_request_id."' AND material_request_item_id='".$material_request_item_id."'","",0);
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
	public function updateItemStatus($outward_store_item_id)
	{
		// detail of outward store item table
		$outward_store_items=$this->db->rp_getData("outward_store_item","*","id='".$outward_store_item_id."'","",0);
		$outward_item=mysqli_fetch_assoc($outward_store_items);
		
		// detail of purchase order item table
		$mr_items=$this->db->rp_getData("material_request_item","*","id='".$outward_item['material_request_item_id']."' AND material_request_id='".$outward_item['material_request_id']."'","",0);
		//$status=1;
		if($mr_items)			
		{		
				while($mr_item=mysqli_fetch_assoc($mr_items)){
				
				$material_request_item_received_qty=$mr_item['material_request_item_qty'];
						// Check how much qty transffered
						
				$received_qty=$this->db->rp_getValue("outward_store_item","SUM(outward_item_received_qty)","material_request_id='".$mr_item['material_request_id']."' AND material_request_item_id='".$mr_item['id']."'",0);
				$remaining_qty=$material_request_item_received_qty-$received_qty;
				
				
					if($remaining_qty==0)
					{
						$status=1;	
					}
					else{
						$status=0;	
					}
					
					// update purchase order item status
					$this->db->rp_update("material_request_item",array("status"=>$status),"id='".$outward_item['material_request_item_id']."' AND material_request_id='".$outward_item['material_request_id']."'",0);
				}
				// update purchase order info status
				$return_pending_status=$this->db->rp_getTotalRecord("material_request_item","material_request_id='".$outward_item['material_request_id']."' AND status=0",0);
				if($return_pending_status>=1)
				{		
					$status=0;	
				}
				else
				{
					$status=1;
					
				}
				$this->db->rp_update("material_request",array("material_request_status"=>$status),"id='".$outward_item['material_request_id']."'",0);
				return true;
		}
		return false;
	}
	
	public function checkStockAvailability($item,$outward_store_id,$store_id="")
	{
		$isValid=true;
		$error=array();
		foreach($item as $key=>$i)
		{
			$location_grid=$i['location_grid'];
			if(!empty($location_grid)){
				$total_qty=0;
				for($j=0;$j<sizeof($location_grid['location_id']);$j++)
				{
					$need_to_deduct_qty=floatval($location_grid['remain_qty'][$j]);
					$total_qty+=$need_to_deduct_qty;
				}
			}	
			$i['received_qty']=$total_qty;
			
			$where = " id='".$i['material_request_item_id']."' AND isDelete=0";
			
			$mr_item = $this->db->rp_getData("material_request_item","*",$where,"",0);
			$mr_item=mysqli_fetch_assoc($mr_item);
			if($mr_item)
			{
				$planning_id=$mr_item['planning_id'];
				$item_id=$mr_item['material_request_item_id'];
				$item_type=$mr_item['material_request_item_type'];
				$item_name=$mr_item['material_request_item_name'];
				$old_outwarded_stock=$this->db->rp_getValue("outward_store_item","outward_item_received_qty","outward_store_id='".$outward_store_id."' AND outward_item_id='".$item_id."' AND outward_item_type='".$item_type."'");
				if($old_outwarded_stock!="")
				{
					$old_outwarded_stock=floatval($old_outwarded_stock);
				}
				else
				{
					$old_outwarded_stock=0;
				}
				if($item_type=="row_material")
				{
					if($planning_id==0)
					{
						$current_stock=$this->db->rp_getValue($this->ctableRMItemMaster,"rm_stock_qty","id='".$item_id."'");
					}
					else
					{
						$current_stock=$this->db->rp_getValue($this->ctableRMItemMaster,"rm_item_reserved_qty","id='".$item_id."'");
					}
					$new_stock=$current_stock+$old_outwarded_stock-$item_qty;
					
				}
				else if($item_type=="semi_finish_good")
				{
					if($planning_id==0)
					{
						$current_stock=$this->db->rp_getValue($this->ctableSFGItemMaster,"sfg_stock_qty","id='".$item_id."'");
					}
					else
					{
						$current_stock=$this->db->rp_getValue($this->ctableSFGItemMaster,"sfg_item_reserved_qty","id='".$item_id."'");
					}
					$new_stock=$current_stock+$old_outwarded_stock-$item_qty;
				}	
				else if($item_type=="finish_good")
				{
					if($planning_id==0)
					{
						$current_stock=$this->db->rp_getValue($this->ctableFGItemMaster,"fg_stock_qty","id='".$item_id."'");
					}
					else
					{
						$current_stock=$this->db->rp_getValue($this->ctableFGItemMaster,"fg_item_reserved_qty","id='".$item_id."'");
					}
					$new_stock=$current_stock+$old_outwarded_stock-$item_qty;
				}
				//echo $store_id; exit;
				if($store_id!="")
				{
					// Check delete of this item will affect mini store or not
					if($planning_id==0)
					{
						$current_store_qty=$this->db->rp_getValue($this->ctableMiniStoreItem,"item_stock_qty","item_id='".$item_id."' AND item_type='".$item_type."' AND store_id='".$store_id."'");
					
						if($current_store_qty!="")
						{
							$current_store_qty=floatval($current_store_qty);
							$will_be_new_store_qty=$current_store_qty-$old_outwarded_stock;
							if($will_be_new_store_qty<0){
								$isValid=false;
								$error[]="Item ".$item_name." already used by department mini store.";
							}
						}
					}
					else{
						$current_reserved_qty=$this->db->rp_getValue($this->ctableMiniStoreItem,"item_reserved_qty","item_id='".$item_id."' AND item_type='".$item_type."' AND store_id='".$store_id."'");
						
						if($current_reserved_qty!="")
						{
							$current_reserved_qty=floatval($current_reserved_qty);
							$will_be_new_store_qty1=$current_reserved_qty-$old_outwarded_stock;
							if($will_be_new_store_qty1<0){
								$isValid=false;
								$error[]="Item ".$item_name." already used by department mini store.";
							}
						}
					}
				}
				
				if($new_stock<0)
				{
					$isValid=false;
					$error[]="Item ".$item_name." not available in stock.";
				}
			}
			else
			{
				$isValid=false;
				$error[]="Some item edited in material request try again";
			}
			
		}
		return array("isValid"=>$isValid,"error"=>$error);
	}
	public function checkStoreItem($store_id,$new_items)
	{
		$isValid=true;
		$Error=array();
		foreach($new_items as $key=>$new_item)
		{
			// Check Whether any same old item available or not?
			$old_item_for_new_item=$this->db->rp_getData($this->ctableMaterialRequestItem,"*","material_request_item_id='".$new_item['item_id']."' AND material_request_item_type='".$new_item['category_id']."' AND material_request_id='".$material_request_id."'","",0);
			if($old_item_for_new_item)
			{
				$old_item_for_new_item=mysqli_fetch_assoc($old_item_for_new_item);
				$inwarded_qty=$old_item_for_new_item['material_request_item_received_qty'];
				$new_item_qty=$new_item['required_qty'];
				if($new_item_qty<$inwarded_qty)
				{
					$isValid=false;
					$Error[]="Material Request Item ".$old_item_for_new_item['material_request_item_name']." already outwarded ".$inwarded_qty." Qty. Enter more than that qty.";					
				}
				// Update this old item as checked 
				$this->db->rp_update($this->ctableMaterialRequestItem,array("isDelete"=>1),"id='".$old_item_for_new_item['id']."'",0);
				$new_items[$key]['last_material_request_item_id']=$old_item_for_new_item['id'];
				
			}
			
		}
		
		// Now Check for unchecked items
		$old_items=$this->db->rp_getData($this->ctableMaterialRequestItem,"*","material_request_id='".$material_request_id."' AND isDelete=0");
		if($old_items)
		{
			while($old_item=mysqli_fetch_assoc($old_items))
			{
				if($old_item['material_request_item_received_qty']>0)
				{
					$isValid=false;
					$Error[]="Material Request Item ".$old_item['material_request_item_name']." already outwarded ".$old_item['material_request_item_received_qty']." Qty. You Can't delete item which already outwarded.";
				}
				
			}
		}
		// Revert all check flags
		$this->db->rp_update($this->ctableMaterialRequestItem,array("isDelete"=>0),"material_request_id='".$material_request_id."'");	
		return array("isValid"=>$isValid,"error"=>$Error,"items"=>$new_items);	
		
	}
	
	public function getLastOutwardQty($material_request_id,$item_id,$item_category)
	{
		$outward_qty=$this->db->rp_getValue($this->ctableOutwardStoreItem,"SUM(outward_item_received_qty)","material_request_id='".$material_request_id."' AND outward_item_id='".$item_id."' AND outward_item_type='".$item_category."'",0);
		$outward_qty=($outward_qty!="")?floatval($outward_qty):0;
		return $outward_qty;
	}	
	
	public function deleteMaterialRequest($material_request_id)
	{
		$outwards=$this->db->rp_getData($this->ctable,"*","material_request_id='".$material_request_id."'");
		if($outwards)
		{
			$isValidDelete=true;
			while($outward=mysqli_fetch_assoc($outwards))
			{
				//check whether this outward can be delete or not
				$outward_store_id=$outward['id'];
				$item=$this->db->rp_getData($this->ctableOutwardStoreItem,"*","outward_store_id='".$outward_store_id."'");
				// Check whether enter qty available in stock or not
				$checkResult=$this->checkStockAvailability($item,$outward_store_id);
				if($checkResult['ack']==0)
				{
					$isValidDelete=false;
					$error[]="Outward ".$outward['outward_store_no']." can not delete.<br/>".implode("<br/>",$checkResult['error']);
				}
			}
			
		}
		if($isValidDelete)
		{
			// delete material request 
			
			$outwards=$this->db->rp_getData($this->ctable,"*","material_request_id='".$material_request_id."'");
			if($outwards)
			{
				$isValidDelete=true;
				while($outward=mysqli_fetch_assoc($outwards))
				{
					//Delete outward
					
				}
			}	
			$reply=array("ack"=>1,"developer_msg"=>"Material request deleted successfully","ack_msg"=>"Material request deleted successfully");
			return $reply;
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"Material request can not be delete becuase of some conflict!!","ack_msg"=>"Material request can not be delete becuase of some conflict!!<br/>".implode("<br/>",$checkResult['error']));
			return $reply;
		}
	}
	
	function updateLocationTrackInfo($location_track_info_id)
	{
		$used_qty=$this->db->rp_getValue("location_track_item","SUM(inward_store_item_used_qty)","location_track_info_id='".$location_track_info_id."'");
		$remaining_qty=$this->db->rp_getValue("location_track_item","SUM(inward_store_item_remaining_qty)","location_track_info_id='".$location_track_info_id."'");
		if($remaining_qty<=0)
		{
			$status=2;
		}
		else
		{
			$status=1;
		}
		$update=array("location_track_remaining_qty"=>$remaining_qty,"location_track_used_qty"=>$used_qty,"status"=>$status);
		$isUpdated=$this->db->rp_update("location_track_info",$update,"id='".$location_track_info_id."'",0);
		return $isUpdated;
	}
}

?>