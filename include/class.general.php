<?php
require_once('notification.class.php');
class General extends Functions
{
	
	public $detail=array();
	public $db;
	public $c_type  = array("0"=>"Department","1"=>"Company");
	public $confirm = array("0"=>"Running","1"=>"Compalate");
	public $order_status=array("0"=>"Pending","1"=>"Completed");
	
	function __construct($id="") {
	   $db = new Functions();
	   $conn = $db->connect();
	   $this->db=$db;
	   
	   if($id!="")
	   {
		   $this->detail=$this->getUserFromId($id);
		   
	   }
	}

	function getUserFromId($id)
	{
		$where 	 = "id='".$id."'AND isDelete=0";
		$data    = $this->db->rp_getData('system_user',"*",$where);
		return $data;
	}

	function getUserFromEmail($email)
	{	
		$where = "email='".$email."'AND isDelete=0";
		$data  = mysqli_fetch_assoc($this->db->rp_getData('system_user',"*",$where));
		return $data;
	}
	function aj_getProductDetail($cid,$product_name,$store_id)
	{
		$q = 1;
		$result = array();
		if($cid!="")
		{
			$where="category_id='".$cid."' isDelete=0 AND isActive=1";	
		}
		else if($product_name!="")
		{
			$where .="material_name like '%".$product_name."%' AND isDelete=0 AND isActive=1";	
		}
		else
		{
			$where="isDelete=0 AND isActive=1";
		}
		
		
		$product_r = $this->db->rp_getData("product","*",$where,"",0);
		if($product_r){
			while($product_detail=mysqli_fetch_assoc($product_r))	
			{
				$cid		= $product_detail['category_id'];
				$cat_d		= mysqli_fetch_assoc($this->db->rp_getData("category","code,name","id=".$cid));
				$image_url 						 = $this->db->rp_getValue("media","url","reference_id='".$product_detail['photo']."'",0);
				$product_detail['category_name'] = stripslashes($cat_d['name']);			
				$product_detail['category_code'] = stripslashes($cat_d['code']);		
				$product_detail['photo'] 		 = SITEURL.FG_ITEM_IMAGE1.$image_url;
				$result[] 	= $product_detail;	
			}
			return $result;
		}else{
			return array();
		}
		
	}
	function aj_getProductDetail1($pid,$uid=""){
		
		$product_r = $this->db->rp_getData("product","id,material_name,item_code,sell_price,mrp_price,stock_qty,opening_qty,minimum_stock_qty,category_id,adate,isDelete,isActive,location_code,manufacture_by,photo","id='".$pid."' isDelete=0 AND isActive=1","",0);
		if($product_r){
			$product_detail=mysqli_fetch_assoc($product_r);	
			$image_url=$this->db->rp_getValue("media","url","reference_id='".$product_detail['photo']."'",0);
			$product_detail['photo']=SITEURL.FG_ITEM_IMAGE1.$image_url;
			
			$cid	= $product_detail['category_id'];
			$cat_d	= mysqli_fetch_assoc($this->db->rp_getData("category","code,name","id=".$cid."isDelete=0 AND isActive=1"));			
			$product_detail['category'] = stripslashes($cat_d['name']);			
			return $product_detail;
		}else{
			return array();;
		}
	}
	function getCustomer()
	{
		
		$result = array();
		$data    = $this->db->rp_getData('customer',"*","isDelete=0 AND isActive=1","id DESC",0);
		if($data)
		{
			while($r= mysqli_fetch_assoc($data))
			{
					$r['company_type'] 	= $this->db->rp_getValue("company_type","name","id='".$r['company_type']."'",0);
					$r['country'] 		= $this->db->rp_getValue("country","name","id='".$r['country']."'",0);
					$r['state'] 		= $this->db->rp_getValue("state","name","id='".$r['state']."'",0);
					$r['city'] 		    = $this->db->rp_getValue("city","name","id='".$r['city']."'",0);
					$r['c_type']		= $r['c_type'];
					$r['c_type_slug']	= $this->c_type[intval($r['c_type'])];
					$r['confirm']		= $r['confirm'];
					$r['confirm_slug']	= $this->confirm[intval($r['confirm'])];
					$r['adate']			= date("d-m-Y",strtotime($r['adate']));
					$result[] = $r;	
			}
			if(!empty($result))
			{
				$ack=array( "ack"=>1,"ack_msg"=>"Successfully Get Customer !!","developer_msg"=>"You got it!!","result"=>$result,);
				return $ack;
			}
			else
			{
				$ack=array( "ack"=>0,"ack_msg"=>"No Customer Found !!","developer_msg"=>"No Customer found!!","result"=>$result,);
				return $ack;
			}
		}
		else
		{
			$ack=array( "ack"=>0,"ack_msg"=>"No Customer Found !!","developer_msg"=>"No Customer found!!","result"=>$result,);
			return $ack;
		}
	}
	function getStore()
	{
		$result = array();
		$data    = $this->db->rp_getData('store',"*","isDelete=0 AND isActive=1","name ASC",0);
		if($data)
		{
			while($r= mysqli_fetch_assoc($data))
			{
					
					$result[] = $r;	
			}
			if(!empty($result))
			{
				$ack=array( "ack"=>1,"ack_msg"=>"Successfully Get Store !!","developer_msg"=>"You got it!!","result"=>$result,);
				return $ack;
			}
			else
			{
				$ack=array( "ack"=>0,"ack_msg"=>"No Store Found !!","developer_msg"=>"No Store found!!","result"=>$result,);
				return $ack;
			}
		}
		else
		{
			$ack=array( "ack"=>0,"ack_msg"=>"No Store Found !!","developer_msg"=>"No Store found!!","result"=>$result,);
			return $ack;
		}
	}
	
	function getOrderedCustomer()
	{
		
		$result = array();
		$data    = $this->db->rp_getData('orders',"DISTINCT customer_id","isDelete=0 AND isActive=1","id DESC",0);
		if($data)
		{
			while($d=mysqli_fetch_assoc($data))
			{
				$customer_ids[]=$d['customer_id'];
			}
			if(!empty($customer_ids))
			{
				$customer_ids=implode(",",$customer_ids);
				
				$where = "id IN (".$customer_ids.") AND isDelete=0";
				$ctable_r = $this->db->rp_getData("customer","*",$where,"id ASC ",0);
				while($r = mysqli_fetch_assoc($ctable_r))
				{
					$country=$this->db->rp_getValue("country","name","id='".$r['country']."'",0);
					$state	=$this->db->rp_getValue("state","name","id='".$r['state']."'",0);
					$city	=$this->db->rp_getValue("city","name","id='".$r['city']."'",0);
					
					$r['country']= $country;
					$r['state']	 = $state;
					$r['city']	 = $city;
					
					$result[] = $r;	
				}
			}else{
				$ack=array( "ack"=>0,"ack_msg"=>"No Customer Found !!","developer_msg"=>"No Customer found!!","result"=>$result,);
				return $ack;
			}
			
			if(!empty($result))
			{
				$ack=array( "ack"=>1,"ack_msg"=>"Successfully Get Customer !!","developer_msg"=>"You got it!!","result"=>$result,);
				return $ack;
			}
			else
			{
				$ack=array( "ack"=>0,"ack_msg"=>"No Customer Found !!","developer_msg"=>"No Customer found!!","result"=>$result,);
				return $ack;
			}
		}
		else
		{
			$ack=array( "ack"=>0,"ack_msg"=>"No Customer Found !!","developer_msg"=>"No Customer found!!","result"=>$result,);
			return $ack;
		}
	}
	function getVendor()
	{
		
		$result = array();		
		$data    = $this->db->rp_getData('vendor',"*","isDelete=0 AND isActive=1","id DESC",0);
		if($data)
		{
			while($r= mysqli_fetch_assoc($data))
			{				
				$r['company_type'] 	= $this->db->rp_getValue("company_type","name","id='".$r['company_type']."'",0);
				$r['country'] 		= $this->db->rp_getValue("country","name","id='".$r['country']."'",0);
				$r['state'] 		= $this->db->rp_getValue("state","name","id='".$r['state']."'",0);
				$r['city'] 		    = $this->db->rp_getValue("city","name","id='".$r['city']."'",0);
				$result[] = $r;	
			}
			if(!empty($result))
			{
				$ack=array( "ack"=>1,
						"ack_msg"=>"Successfully Get Customer !!",
						"developer_msg"=>"You got it!!",
						"result"=>$result,
						);
						return $ack;
			}
			else
			{
				$ack=array( "ack"=>0,
						"ack_msg"=>"No Customer Found !!",
						"developer_msg"=>"No Customer found!!",
						"result"=>$result,
						);
						return $ack;
			}
		}
		else
		{
			$ack=array( "ack"=>0,
					"ack_msg"=>"No Customer Found !!",
					"developer_msg"=>"No Customer found!!",
					"result"=>$result,
					);
					return $ack;
		}
	}
	function getOrders($order_id)
	{
		$result = array();
		$order_pro_detail=mysqli_fetch_assoc($this->db->rp_getData("orders","id,order_no,sales_id,customer_id,customer_name,contact_number,address,country,state,city,email,order_date,total_amount,total_qty,discount,discount_type,grand_total,created_date,status","isDelete=0 AND id='".$order_id."'","id DESC",0));
		
		$where= "order_id='".$order_pro_detail['id']."' AND isDelete=0";
		$dt = $this->db->rp_getData("order_product_item","*",$where,"",0);
		
		$r = array();
		if($dt)
		{
			$order_pro_detail['status_slug']	= $this->order_status[intval($order_pro_detail['status'])];
			while($r=mysqli_fetch_assoc($dt))
			{
				$r['status']		= $order_pro_detail['status'];
				$result[] 			= $r;	
				
			}	
		}
				
		if($order_pro_detail)
		{
			$order_pro_detail['order_date']=date("d-m-Y",strtotime($order_pro_detail['order_date']));
			$order_pro_detail['products']=$result;
			
			if(!empty($result))
			{
				$ack=array( "ack"=>1,
						"ack_msg"=>"Successfully Get Orders !!",
						"developer_msg"=>"You got it!!",
						"result"=>$order_pro_detail,
						);
						return $ack;
			}
			else
			{
				$ack=array( "ack"=>0,
						"ack_msg"=>"No Orders Found !!",
						"developer_msg"=>"No Customer found!!",
						"result"=>$result,
						);
						return $ack;
			}
		}
		else
		{
			$ack=array( "ack"=>0,
					"ack_msg"=>"No Orders Found !!",
					"developer_msg"=>"No Customer found!!",
					"result"=>$result,
					);
					return $ack;
		}
	}
	
	
	function getStoreProduct($store_id,$pro_name)
	{
		$result = array();
		$where= "store_id='".$store_id."' AND isDelete=0";
		if($pro_name){
		$ctable_where2 .= " (
							material_name like '%".$pro_name."%'					
						) AND isDelete=0 AND isActive=1 ";
		$ctable_r = $this->db->rp_getData("product","id",$ctable_where2,"",0);
		$prod_name=array();
		 if(mysqli_num_rows($ctable_r)>0){
					 while($ctable_d = mysqli_fetch_array($ctable_r)){
						$prod_name[]=$ctable_d['id'];
					}
					$prod_name=implode(",",$prod_name);
					$where .= " AND (
									product_id IN (".$prod_name.")					
								) AND isDelete=0 AND isActive=1";
		 }
		 else{
			 $prod_name=0;
			 $where .= " AND (
									product_id IN (".$prod_name.")					
								) AND isDelete=0 AND isActive=1 ";
		 }	
		}else{
			$where .= "isDelete=0 AND isActive=1";
		}
		
				
		$data    = $this->db->rp_getData("product_store_item","*",$where,"",0);
		if($data)
		{
			while($r= mysqli_fetch_assoc($data))
			{
				$product_name	= $this->db->rp_getValue("product","material_name","id='".$r['product_id']."'AND isDelete=0 AND isActive=1");
				$sell_price		= $this->db->rp_getValue("product","sell_price","id='".$r['product_id']."'AND isDelete=0 AND isActive=1");
				
				$r['material_name']	= $product_name;
				$r['sell_price']	= $sell_price;
				
				$result[] = $r;	
			}
			if(!empty($result))
			{
				$ack=array( "ack"=>1,"ack_msg"=>"Successfully Get Store !!","developer_msg"=>"You got it!!","result"=>$result,);
				return $ack;
			}
			else
			{
				$ack=array( "ack"=>0,"ack_msg"=>"Product not available in Store.","developer_msg"=>"No Store found!!","result"=>$result,);
				return $ack;
			}
		}
		else
		{
			$ack=array( "ack"=>0,"ack_msg"=>"Product not available in Store","developer_msg"=>"No Store found!!","result"=>$result,);
			return $ack;
		}
	}
	function getAllOrders($sales_id)
	{
		$result = array();		
		if(!$this->isHavingSuperRights($sales_id))
		{
			$data    = $this->db->rp_getData('orders',"id,order_no,sales_id,customer_id,customer_name,contact_number,address,country,state,city,email,order_date,total_amount,total_qty,discount,discount_type,grand_total,created_date,status","sales_id='".$sales_id."'AND isDelete=0 AND isActive=1","id DESC",0);
		}			
		else
		{
			$data    = $this->db->rp_getData('orders',"id,order_no,sales_id,customer_id,customer_name,contact_number,address,country,state,city,email,order_date,total_amount,total_qty,discount,discount_type,grand_total,created_date,status","isDelete=0 AND isActive=1","id DESC",0);
		}
		if($data)
		{
			
			while($r= mysqli_fetch_assoc($data))
			{
				$r['status']		= $r['status'];
				$r['status_slug']	= $this->order_status[intval($r['status'])];
				$r['order_date']	= date('d-m-Y',strtotime($r['order_date']));
				
				$result[] 			= $r;	
			}
			if(!empty($result))
			{
				$ack=array( "ack"=>1,
						"ack_msg"=>"Successfully Get All Orders !!",
						"developer_msg"=>"You got it!!",
						"result"=>$result,
						);
						return $ack;
			}
			else
			{
				$ack=array( "ack"=>0,
						"ack_msg"=>"No Orders Found !!",
						"developer_msg"=>"No Orders found!!",
						"result"=>$result,
						);
						return $ack;
			}
		}
		else
		{
			$ack=array( "ack"=>0,
					"ack_msg"=>"No Orders Found !!",
					"developer_msg"=>"No Customer found!!",
					"result"=>$result,
					);
					return $ack;
		}
	}
	function getAllDispatch($sales_id)
	{
		$result = array();
		if(!$this->isHavingSuperRights($sales_id))
		{
			$data    = $this->db->rp_getData('dispatch_detail',"*","isDelete=0 AND sales_id='".$sales_id."'","id DESC",0);
		}
		else
		{
			$data    = $this->db->rp_getData('dispatch_detail',"*","isDelete=0","id DESC",0);
		}
		if($data)
		{
			while($r= mysqli_fetch_assoc($data))
			{
				$dispatch_store_item_r=$this->db->rp_getData('dispatch_product_item',"store_id","isDelete=0 AND dispatch_id='".$r['id']."'","id DESC",0);
				if($dispatch_store_item_r){
					$customer_name		= $this->db->rp_getValue("customer","cname","id='".$r['customer_id']."'",0);
					$phone		= $this->db->rp_getValue("customer","phone","id='".$r['customer_id']."'",0);
					
					
					$date				= date('d-m-Y',strtotime($r['dispatch_date']));
					$r['customer_name']	= $customer_name;
					$r['dispatch_date']	= $date;
					
					while($dispatch_store_item_d= mysqli_fetch_assoc($dispatch_store_item_r)){
						
						$store_name		= $this->db->rp_getValue("store","name","id='".$dispatch_store_item_d['store_id']."'",0);
						
						$r['adate']			= $date;
						$r['store_name']	= $store_name;
						$r['store_id']		= $dispatch_store_item_d['store_id'];
						$r['contact_owner']		= $phone;
						$r['contact_person']		= $phone;
						
					}
					
					
				}else{
					$ack=array( "ack"=>0,
						"ack_msg"=>"No Dispatch store found!!",
						"developer_msg"=>"No Dispatch store found!!",
						"result"=>$result,
						);
						return $ack;
				}
				$result[] =$r;					
			}
			if(!empty($result))
			{
				$ack=array( "ack"=>1,
						"ack_msg"=>"Successfully Get Dispatch !!",
						"developer_msg"=>"You got it!!",
						"result"=>$result,
						);
						return $ack;
			}
			else
			{
				$ack=array( "ack"=>0,
						"ack_msg"=>"No Orders Found !!",
						"developer_msg"=>"No Dispatch found!!",
						"result"=>$result,
						);
						return $ack;
			}
		}
		else
		{
			$ack=array( "ack"=>0,
					"ack_msg"=>"No Dispatch Found !!",
					"developer_msg"=>"No Dispatch found!!",
					"result"=>$result,
					);
					return $ack;
		}
	}
	function getAllInwardStore($sales_id)
	{
		$result = array();
		if(!$this->isHavingSuperRights($sales_id))
		{
		$data    = $this->db->rp_getData('inward_store',"*","isDelete=0 AND sales_id='".$sales_id."'","id DESC",0);
		}
		else{
			$data    = $this->db->rp_getData('inward_store',"*","isDelete=0 ","id DESC",0);
		}
		if($data)
		{
			while($r= mysqli_fetch_assoc($data))
			{
				$inward_store_item_r=$this->db->rp_getData('inward_store_item',"store_id","isDelete=0 AND inward_store_id='".$r['id']."'","id DESC",0);
				
				if($inward_store_item_r){
					$vendor_name="";
					
					$vendor_name		= $this->db->rp_getValue("vendor","cname","id='".$r['vendor_name']."'",0);
					$phone		= $this->db->rp_getValue("vendor","phone","id='".$r['vendor_name']."'",0);
					
					$r['vendor_id']		= $r['vendor_name'];
					$r['vendor_name']	= $vendor_name;
					
					while($inward_store_item_d= mysqli_fetch_assoc($inward_store_item_r)){
						
						$store_name		= $this->db->rp_getValue("store","name","id='".$inward_store_item_d['store_id']."'",0);
						$date			= date('d-m-Y',strtotime($r['adate']));
						
						$r['adate']		= $date;
						$r['store_name']= $store_name;
						$r['contact_owner']= $phone;
						$r['contact_person']= $phone;
						$r['store_id']	= $inward_store_item_d['store_id'];
						
					}
					
				}
				$result[] =$r;					
			}
			if(!empty($result))
			{
				$ack=array( "ack"=>1,
						"ack_msg"=>"Successfully Get Inward Store!!",
						"developer_msg"=>"You got it!!",
						"result"=>$result,
						);
						return $ack;
			}
			else
			{
				$ack=array( "ack"=>0,
						"ack_msg"=>"No Inward Found !!",
						"developer_msg"=>"No Inward found!!",
						"result"=>$result,
						);
						return $ack;
			}
		}
		else
		{
			$ack=array( "ack"=>0,
					"ack_msg"=>"No Inward Found !!",
					"developer_msg"=>"No Inward found!!",
					"result"=>$result,
					);
					return $ack;
		}
	}
	function getInwardStoreItem($inward_id)
	{
		$result = array();
		$inward_store_detail=mysqli_fetch_assoc($this->db->rp_getData("inward_store","id,vendor_name,sales_id,total_qty,grand_total,isActive,isDelete,adate","isDelete=0 AND id='".$inward_id."'","id DESC",0));
		$where= "inward_store_id='".$inward_store_detail['id']."' AND isDelete=0";
		$dt = $this->db->rp_getData("inward_store_item","*",$where,"",0);
		$r = array();
		if($dt)
		{
			while($r=mysqli_fetch_assoc($dt))
			{				
				$vendor_name	= $this->db->rp_getValue("vendor","cname","id='".$inward_store_detail['vendor_name']."'",0);
				$store_name		= $this->db->rp_getValue("store","name","id='".$r['store_id']."'",0);
				$result[] 		= $r;	
				
				$inward_store_detail['store_id']	= $r['store_id'];
				$inward_store_detail['store_name']	= $store_name;
			}	
		}
		
		if($inward_store_detail)
		{
			$date	= date('d-m-Y',strtotime($inward_store_detail['adate']));
			
			$inward_store_detail['vendor_id']	= $inward_store_detail['vendor_name'];
			$inward_store_detail['vendor_name']	= $vendor_name;
			$inward_store_detail['adate']		= $date;
			$inward_store_detail['vendor_name']	= $vendor_name;
			$inward_store_detail['products']	= $result;
			
			
			if(!empty($result))
			{
				$ack=array( "ack"=>1,
						"ack_msg"=>"Successfully Get Inward !!",
						"developer_msg"=>"You got it!!",
						"result"=>$inward_store_detail,
						);
						return $ack;
			}
			else
			{
				$ack=array( "ack"=>0,
						"ack_msg"=>"No Inward Found !!",
						"developer_msg"=>"No Inward found!!",
						"result"=>$result,
						);
						return $ack;
			}
		}
		else
		{
			$ack=array( "ack"=>0,
					"ack_msg"=>"No Inward Found !!",
					"developer_msg"=>"No Inward found!!",
					"result"=>$result,
					);
					return $ack;
		}
		}
	function getDispatchItem($dispatch_id)
	{
	$result = array();
	$dispatch_item = mysqli_fetch_assoc($this->db->rp_getData("dispatch_detail","id,customer_id,sales_id,email,contact_person,total_qty,grand_total,dispatch_date,delivery_address,remark,lr_number,isActive,isDelete","id='".$dispatch_id."' AND isDelete=0 AND isActive=1","id DESC",0));
	$where 	= "dispatch_id='".$dispatch_id."' AND isDelete=0 AND isActive=1";
	$dt 	= $this->db->rp_getData("dispatch_product_item","*",$where,"",0);
	$r 		= array();
	if($dt)
	{
		while($r=mysqli_fetch_assoc($dt))
		{				
			$customer_name	= $this->db->rp_getValue("customer","cname","id='".$dispatch_item['customer_id']."'",0);
			$stock_qty		= $this->db->rp_getValue("product_store_item","stock_qty","product_id='".$r['pro_id']."'",0);
			$remaining_qty	= $this->db->rp_getValue("order_product_item","remaining_qty","pro_id='".$r['pro_id']."'",0);
			$store_name		= $this->db->rp_getValue("store","name","id='".$r['store_id']."'",0);
			
			$dispatch_item['store_name']	= $store_name;
			$dispatch_item['store_id'] 		= $r['store_id'];
			
			if($stock_qty){
				$r['stock_qty'] = $stock_qty;
			}else{
				$r['stock_qty'] = 0;
			}
			
			$r['remaining_qty'] = $remaining_qty;
			$result[] 		= $r;	
		}	
	}
	
	if($dispatch_item)
	{
		$date=date('d-m-Y',strtotime($dispatch_item['dispatch_date']));
		$dispatch_item['customer_name']	= $customer_name;
		$dispatch_item['dispatch_date']	= $date;
		$dispatch_item['products']		= $result;
		
		if(!empty($result))
		{
			$ack=array( "ack"=>1,
					"ack_msg"=>"Successfully Get Dispatch !!",
					"developer_msg"=>"You got it!!",
					"result"=>$dispatch_item,
					);
					return $ack;
		}
		else
		{
			$ack=array( "ack"=>0,
					"ack_msg"=>"No Dispatch Found !!",
					"developer_msg"=>"No Dispatch found!!",
					"result"=>$result,
					);
					return $ack;
		}
	}
	else
	{
		$ack=array( "ack"=>0,
				"ack_msg"=>"No Dispatch Found !!",
				"developer_msg"=>"No Dispatch found!!",
				"result"=>$result,
				);
				return $ack;
	}
	}
	function getOrderStock()
	{
		$result  = array();		
		$products=$this->db->rp_getData('product',"*","isDelete=0 AND isActive=1","id DESC",0);
		if($products)
		{
			$total_qty=0;
			$count=0;
			while($product= mysqli_fetch_assoc($products))
			{
				$where = "pro_id='".$product['id']."' AND isDelete=0 AND isActive=1 GROUP BY pro_id";
				$product_item_r = $this->db->rp_getData("order_product_item","SUM(remaining_qty) as remaining_qty,pro_id,status",$where,"pro_id ASC ",0);
				$remaining_qty=0;
					if($product_item_r)
					{
						$product_item_d = mysqli_fetch_array($product_item_r);
						if($product_item_d['pro_id']){
							$remaining_qty = $product_item_d['remaining_qty'];
						}else{
							$remaining_qty=0;
						}	
					}
					
				$product['order_remaining_qty']= $remaining_qty;
				$stores=$this->db->rp_getData('product_store_item',"product_id,store_id,store_name,stock_qty,minimum_stock_qty,opening_qty,location_code","product_id='".$product['id']."'AND isDelete=0 AND isActive=1","id DESC",0);
				
				if($stores)
				{	$total_qty=0;
					$product_store=array();
					while($store= mysqli_fetch_assoc($stores))
					{
						$where_store = "pro_id='".$product['id']."' AND isDelete=0 AND isActive=1 AND store_id='".$store['store_id']."' GROUP BY pro_id";
						$product_item_store_r = $this->db->rp_getData("order_product_item","SUM(remaining_qty) as remaining_qty,pro_id,status",$where_store,"pro_id ASC ",0);
						$remaining_qty_store=0;
						if($product_item_store_r)
						{
							$product_item_store_d = mysqli_fetch_array($product_item_store_r);
							if($product_item_store_d['pro_id']){
								$remaining_qty_store=$product_item_store_d['remaining_qty'];
							}else{
								$remaining_qty_store=0;
							}
						}
						
						$total_qty	= $total_qty+floatval($store['stock_qty']);
						
						$store['order_remaining_qty']= $remaining_qty_store;
						$product_store[]=$store;
					
							$count++;
						
					}
					
					$product['store']			= $product_store;
					$product['total_stock_qty'] = $total_qty;
					$product['stock_qty'] = $total_qty;
					
					$result[]=$product;
				}
				
			}
		}
			if(!empty($result))
			{
				$ack=array( "ack"=>1,
						"ack_msg"=>"Successfully Get All Product Stock !!",
						"developer_msg"=>"You got it!!",
						"result"=>$result,
						);
						return $ack;
			}
			else
			{
				$ack=array( "ack"=>0,
						"ack_msg"=>"No Product Stock Found !!",
						"developer_msg"=>"No Product Stock found!!",
						"result"=>$result,
						);
						return $ack;
			}
		
	}
	function changeProfile($id,$name,$email,$phone,$address)
	{	
		if($this->db->rp_getTotalRecord("sales_executive","id = '".$id."'AND isDelete=0 AND isActive=1")>0)
		{
			$values	 = array(	
		
						"name" 		=>	$name,
						"email" 	=>	$email,								
						"phone"  	=>	$phone,
						"address"	=>	$address,
						);
				
			$where 	= "id='".$id."'";
			$uid 	= $this->db->rp_update("sales_executive",$values,$where);
			
			$ack=array( "ack"=>1,
			"ack_msg"=>"Successfully Updated Your Profile !!",
			"developer_msg"=>"You got it!!",
			"result"=>array($uid),
			);
			
			return $ack;
		}
		else
		{
			return array('ack'=>0,
						 "ack_msg"=>"ID Is Not Match!!",
						 "developer_msg"=>"please pass the correct id!!");
		}
	}
	function changePhone($id,$phone)
	{	if($this->db->rp_getTotalRecord("sales_executive","id ='".$id."' AND isDelete=0 AND isActive=1")>0)
		{
			$values	 = array(	
		
						"phone"  =>	$phone,
						);
				
			$where = "id='".$id."'";
			$uid = $this->db->rp_update("sales_executive",$values,$where);
			$activation_code=generateActivationCodes();			
			$sendSMS=aj_sendOTPs($phone,$activation_code);
			
			$ack=array( "ack"	=>1,
				"ack_msg"		=>"Successfully Updated Your mobile Number !!",
				"developer_msg"	=>"You got it!!",
				"result"		=>array($uid),
			);
			
			return $ack;
		}
		else
		{
			return array('ack'=>0,
						 "ack_msg"=>"ID Is Not Match!!",
						 "developer_msg"=>"please pass the correct id!!");
		}
	}
	function addNotes($id,$title,$note_date,$detail,$priority)
	{	
			$date = date('Y-m-d H-i-s');
			$rows	 = array(		
						"title",
						"date",						
						"note_date" ,											
						"detail",
						"sales_executive",
						"priority",
						);
			$values	 = array(						
						$title,
						$date,
						date('Y-m-d H-i-s',strtotime($note_date)),
						$detail,
						$id,
						$priority,
						);
				
			$add = $this->db->rp_insert("notes",$values,$rows);
			if($add)
			{
				$ack=array( "ack"=>1,
				"ack_msg"=>"Successfully Added Your Notes !!",
				"developer_msg"=>"You got it!!",
				"result"=>array($add),
				);
				return $ack;
			}
			else
			{
					$ack=array("ack"=>0,
					"ack_msg"=>"not inserted !!",
					"developer_msg"=>"not inserted!!",
					"result"=>array(),
					);
					return $ack;
			}
					
		
	}
	function sendNotification($sales_executive,$notification_title,$notification_description,$notification_type,$notification_extra)
    {
		$adate = date('Y-m-d');
		$refreshTokens=array();
			foreach($sales_executive as $s)
			{
					$rows 	= array(
						"notification_title",
						"notification_description",
						"notification_type",
						"notification_extra",					
						"sales_id",
						"adate",									
					);
					$values = array(
						$notification_title,
						$notification_description,
						$notification_type,
						$notification_extra,
						$s,	
						$adate
						
					);
			$this->db->rp_insert("notification",$values,$rows);
			
			$id=$this->db->rp_getValue("sales_executive","refreshToken","refreshToken!='' AND id='".$s."' AND isDelete=0 AND isActive=1");
			$refreshTokens[]=$id;
								
						
			}			
			$msg = array(
					"type"		 => $notification_type,
					"title"		 => $notification_title,
					"description"=> $notification_description,					
					"extra"		 =>	$notification_extra,
					);
			
			$result=$this->db->send_notification($msg,$refreshTokens);				
			return $result;
		
	}
	function isHavingSuperRights($sales_id)
	{
		$isSuperAdmin=$this->db->rp_getTotalRecord("system_user","id='".$sales_id."' AND super_admin_flag=1");
		if($isSuperAdmin>=1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

function generateActivationCodes()
{
	$characters='0123456789';
	$randStr="";
	for($i=0;$i<=5;$i++)
	{
		$randStr=$randStr.$characters[rand(0,strlen($characters)-1)];
	}
	return $randStr;
}
function aj_sendOTPs($number,$activationCode)
{
	$msgId = "";
	$nt = new Notification();							
	if($number!="")
	{
		$sms=$activationCode." is Your One Time Password!!";
		$msgId=$nt->rp_checkSMS($number,$sms);	
	}
	return array('ack'=>1,'status'=>"msgId".$msgId."&OTP=".$activationCode);
}
?>