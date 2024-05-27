<?php
require_once("main.class.php");
require_once("function.class.php");
require_once("class.media.php");
class UserData extends Functions
{
	public $detail=array();
	public $db;
	public $c_type  = array("0"=>"Department","1"=>"Company");
	public $confirm = array("0"=>"Running","1"=>"Compalate");
	public $order_status=array("0"=>"Pending","1"=>"Completed");
	public $ctableDispatch="dispatch_info";
	public $ctableDispatchItem="dispatch_item";
	public $ctableOrderItem="order_item";
	public $CtableCreditNoteItems="credit_note_item";
	public $CtableCreditNote="credit_note";
	public $CtablePriceList="price_list";
	public $CtablePriceListProducts="price_list_map_product";
	public $CtableCustomerBranch="customer_branch";
	public $CtableCustomer="customer";
	public $CtableCartDetails="cartdetails";
	public $CtableCartItems="cartitems";
	public $CtableProduct="product";
	public $CtableTax="tax";
	public $media;
	function __construct($id="") {
	   $db = new Functions();
	   $conn = $db->connect();
	   $this->db=$db;
	   $log	= new Log();		
		$this->log=$log;
		$this->media=new Media();
	   if($id!="")
	   {
		   $this->detail=$this->getUserFromId($id);
		   
	   }
	}
	/*
		*** Cart Function Developed By Ravi Patel :) <<<
	*/
	
		function rp_getPrincipalRating($p_id){
	
	                $numberofReviews = 0;
            $totalStars = 0;
             $average = 0;
                 $user_id =$this->db->rp_getData("rating","*","participate_id='".$p_id."' AND isDelete=0");
    if($user_id){
        	while($user_id_r=mysqli_fetch_assoc($user_id)){
        	    
        $user_id_d= $user_id_r['user_id'];
       
         $user_d =$this->db->rp_getData("user_common","*","id='".$user_id_d."' AND designation='Trustee' AND isDelete=0");
       
         if($user_d){
            
             	while($user_r=mysqli_fetch_assoc($user_d)){
            $user= $user_r['id'];
             if($user==$user_id_d){
                     $rating =$this->db->rp_getValue("rating","option1","user_id='".$user."' AND isDelete=0");
                      $numberofReviews++;
                    $totalStars  += $rating;
                 
        
              
             	}
             	
             
             
         }
        	}
        	 
    } 
    
 
    } 
    
   
             	$average = $totalStars/$numberofReviews;
             
                    return $average;
	
		}
	
		function rp_getPrincipalRatingss($p_id){
		    
		     $user_id =$this->db->rp_getData("rating","*","participate_id='".$p_id."' AND isDelete=0");
    if($user_id){
        	while($user_id_r=mysqli_fetch_assoc($user_id)){
        	    
        $user_id_d= $user_id_r['user_id'];
       
         $user_d =$this->db->rp_getData("user_common","*","id='".$user_id_d."' AND designation='Student' AND isDelete=0");
       
         if($user_d){
              $numberOfReviews = 0;
            $totalStars = 0;
             	while($user_r=mysqli_fetch_assoc($user_d)){
            $user= $user_r['id'];
             if($user==$user_id_d){
                     $rating =$this->db->rp_getValue("rating","option1","user_id='".$user."' AND isDelete=0");
                      $numberofReviews++;
                    $totalStars  += $rating;
        
              
             	}
         }
        	}
    } 
    }
		
		  $average = $totalStars/$numberOfReviews;   
		 
		   	return parent::rp_num($average);
	
	}
	
	
	
	
	public function rp_getCartTotalItem() // Total no. of products in cart
    {
		if(isset($_SESSION['SHOPWALA_SESS_CART_ID']) && $_SESSION['SHOPWALA_SESS_CART_ID']>0){
			return parent::rp_getTotalRecord("cartitems","cart_id='".$_SESSION['SHOPWALA_SESS_CART_ID']."'");
		}else{
			return 0;
		}
    }
	function getCartDetails($cart_id){
		$result=array();
		$cart_r = $this->db->rp_getData("cartdetails","cart_id,cid,customer_name,customer_phone,customer_email,customer_city,customer_state,customer_country,customer_address,customer_pincode,orderdate,rcdate,order_status,subtotal,payment_method,cod_charge,finaltotal","cart_id='".$cart_id."'","",0);
		if($cart_r){
			while($cart_d=mysqli_fetch_assoc($cart_r)){
				$cart_items_r = $this->db->rp_getData("cartitems","id,cid,cart_id,order_id,order_item_id,order_item_name,order_item_code,order_item_selling_price,order_item_sub_total,order_item_discount,order_item_discount_amount,order_item_original_price","cart_id='".$cart_id."'","",0);
				$item=array();
				if($cart_items_r){
					while($cart_items_d=mysqli_fetch_assoc($cart_items_r)){
						$item[]=$cart_items_d;
						$cart_d['cartitems']=$item;
					}
				}
				$result[]=$cart_d;
				if(!empty($result))
				{
					$ack=array( "ack"=>1,"ack_msg"=>$this->log->getMessage('CART_DETAIL_GET_SUCCESS',1),"developer_msg"=>$this->log->getMessage('CART_DETAIL_GET_SUCCESS'),"result"=>$result);
					return $ack;
				}
				else
				{
					$ack=array( "ack"=>0,"ack_msg"=>$this->log->getMessage('CART_DETAIL_GET_FAILED',1),"developer_msg"=>$this->log->getMessage('CART_DETAIL_GET_FAILED'),"result"=>$result,);
					return $ack;
				}
			}
		}
		else{
			$ack=array( "ack"=>0,"ack_msg"=>$this->log->getMessage('CART_ITEM_NOT_AVAILABLE',1),"developer_msg"=>$this->log->getMessage('CART_ITEM_NOT_AVAILABLE'));
			return $ack;
		}
	}
	
	function getCartDetailsByUserId($cid){
		$result=array();
		$cart_r = $this->db->rp_getData("cartdetails","cart_id,cbid,cid,customer_name,customer_phone,customer_email,customer_city,customer_state,customer_country,customer_address,customer_pincode,orderdate,rcdate,order_status,subtotal,payment_method,finaltotal,discount,discount_amount","cid='".$cid."' AND order_status='1'","",0);
		if($cart_r){
			while($cart_d=mysqli_fetch_assoc($cart_r)){
				$cart_d['cartitems']=array();
				$cart_items_r = $this->db->rp_getData("cartitems LEFT JOIN product ON cartitems.order_item_id=product.id LEFT JOIN category ON product.category_id=category.id","cartitems.id,cid,cart_id,order_id,order_item_id,order_item_name,order_item_code,order_item_selling_price,category.display_order,order_item_sub_total,order_item_discount,order_item_discount_amount,order_item_original_price,order_item_qty","cart_id='".$cart_d['cart_id']."'",ITEM_DISPLAY_ORDER,0);
				$item=array();
				if($cart_items_r){
					while($cart_items_d=mysqli_fetch_assoc($cart_items_r)){
						$item[]=$cart_items_d;
						$cart_d['cartitems']=$item;
					}
				}
				if(!empty($cart_d))
				{
					$ack=array( "ack"=>1,"ack_msg"=>$this->log->getMessage('CART_DETAIL_GET_SUCCESS',1),"developer_msg"=>$this->log->getMessage('CART_DETAIL_GET_SUCCESS'),"result"=>$cart_d);
					return $ack;
				}
				else
				{
					$ack=array( "ack"=>0,"ack_msg"=>$this->log->getMessage('CART_DETAIL_GET_FAILED',1),"developer_msg"=>$this->log->getMessage('CART_DETAIL_GET_FAILED'),"result"=>$result,);
					return $ack;
				}
			}
		}
		else{
			$ack=array( "ack"=>0,"ack_msg"=>$this->log->getMessage('CART_ITEM_NOT_AVAILABLE',1),"developer_msg"=>$this->log->getMessage('CART_ITEM_NOT_AVAILABLE'));
			return $ack;
		}
	}
	
	public function rp_getCartSubTotalPrice() // Total Price of cart
    {
		if(isset($_SESSION['SHOPWALA_SESS_CART_ID']) && $_SESSION['SHOPWALA_SESS_CART_ID']>0){
			$t = parent::rp_getSumVal("cartitems","totalprice","cart_id='".$_SESSION['SHOPWALA_SESS_CART_ID']."'");
			$s = parent::rp_getSumVal("cartitems","ship_charge","cart_id='".$_SESSION['SHOPWALA_SESS_CART_ID']."'");
			$d = $this->rp_getShippingDiscount($t,$s);
			return parent::rp_num(($t+$s)-$d);
		}else{
			return parent::rp_num(0);
		}
    }
	public function aj_getCartSubTotalPrice($cid) // Total Price of cart
    {
		if($cid>0){
			$t = parent::rp_getSumVal("cartitems","order_item_sub_total","cart_id='".$cid."'",0);
			$s=$d=0;
			//$s = parent::rp_getSumVal("cartitems","ship_charge","cart_id='".$cid."'");
			//$d = $this->rp_getShippingDiscount($t,$s);
			return parent::rp_num(($t+$s)-$d);
		}else{
			return parent::rp_num(0);
		}
    }
	public function aj_updateSubTotalCart($cid,$order_item_discount_amount="")
	{
		if($cid>0){
			$t = parent::rp_getSumVal("cartitems","order_item_sub_total","cart_id='".$cid."'",0);
			//$final_total = $t-$order_item_discount_amount;
			$drows=array("subtotal"=>$t);
			$dwhere="cart_id='".$cid."'";
			parent::rp_update("cartdetails",$drows,$dwhere,0);
		}else{
			return parent::rp_num(0);
		}
	}
	public function aj_checkForUpdateCartItemQty($cartItemId,$newqty)
	{
		$q = 1;
		$shop_cart_r = parent::rp_getData("cartitems","*","id='".$cartItemId."'","",0);
		if($shop_cart_r){
			
			while($shop_cart_d = mysqli_fetch_array($shop_cart_r)){
				$pid 		= $shop_cart_d['order_item_id'];
				$qty 		= $newqty;
				
				$pro_qty 	= parent::rp_getValue("product","stock_qty","id='".$pid."'",0);
				
				if($pro_qty<=0 || $pro_qty<$qty){					
					$q = 0;
				}
			}
			if($q>0){
				
				return 1;
			}else{
				
				return 0;
			}
		}else{
			return 0;
		}
	}
	public function rp_checkCartQuantity($cartid){
		$q = 1;
		$shop_cart_r = parent::rp_getData("cartitems","*","cart_id='".$cartid."'");
		if($shop_cart_r){
			while($shop_cart_d = mysqli_fetch_array($shop_cart_r)){
				$pid 		= $shop_cart_d['pid'];
				$qty 		= $shop_cart_d['qty'];
				$pro_qty 	= parent::rp_getValue("product","qty","id='".$pid."'");
				if($pro_qty<=0 || $pro_qty<$qty){
					$q = 0;
				}
			}
			if($q>0){
				return 1;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}
	public function rp_checkCart($cid){
		$q = 1;
		$shop_cart_r = parent::rp_getData("cartdetails","*","cid='".$cid."' AND order_status=1","",0);
		if($shop_cart_r){
			$shop_cartDetail=mysqli_fetch_array($shop_cart_r);
			$result=array('ack'=>1,'cart_id'=>$shop_cartDetail['cart_id']);			
			return $result;
		}else{
			return array('ack'=>0);;
		}
	}
	function aj_getProductDetail($branch_id,$cid,$product_name,$require_column=array(),$product_id)
	{
		$is_flag=0;
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
						if($cid!=-1)
						$where="category_id='".$cid."' AND isDelete=0 AND isActive=1";
						else
						$where="isFeatured='1' AND isDelete=0 AND isActive=1";
						

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
					
					$product_r = $this->db->rp_getData("product","*",$where,"",0);
					if($product_r){
						while($product_detail=mysqli_fetch_assoc($product_r))	
						{
							// Is This Item Available In Price list or not?
							$InPriceList=$this->rp_getTotalRecord($this->CtablePriceListProducts,"product_id='".$product_detail['id']."' AND price_list_id='".$BranchPriceListDetail['id']."'",0);
							if($InPriceList>0)
							{
								$PriceInPriceList=$this->db->rp_getValue($this->CtablePriceListProducts,"price","product_id='".$product_detail['id']."' AND price_list_id='".$BranchPriceListDetail['id']."'",0);
							}
							else
							{
								$PriceInPriceList="";
							}

								if($PriceInPriceList=="")
								{
									$PriceInPriceList=$this->db->rp_getValue($this->CtableProduct,"selling_price","id='".$product_detail['id']."'");
								}
									$VATTax=$this->rp_getValue($this->CtableTax,"tax_value","id='".$product_detail['vat_tax']."'",0);
									$VATTaxName=$this->rp_getValue($this->CtableTax,"tax_name","id='".$product_detail['vat_tax']."'",0);
									$VATTaxName=($VATTaxName!="")?$VATTaxName:"-";
									$VATTax=($VATTax!="")?floatval($VATTax):0;
									$VATTaxAmount=($PriceInPriceList*$VATTax)/100;
									
									$OtherTax=($product_detail['other_tax']!="")?floatval($product_detail['other_tax']):0;
									$OtherTaxAmount=($PriceInPriceList*$OtherTax)/100;
									
									$product_detail['vat_tax_name'] = $VATTaxName;
									$product_detail['vat_tax']=$VATTax;
									$product_detail['vat_tax_amount']=$VATTaxAmount;
									$product_detail['other_tax']=$OtherTax;
									$product_detail['other_tax_amount']=$OtherTaxAmount;
									//Pricing 
									$product_detail['orignal_price']=$PriceInPriceList;
									if($product_detail['isExcludingTax']==1)
									$product_detail['selling_price']=floatval($PriceInPriceList+$VATTaxAmount+$OtherTaxAmount);
									else
									$product_detail['selling_price']=	floatval($PriceInPriceList);
									$product_detail['discount']=$Discount;
									$product_detail['discount_amount']=$product_detail['selling_price']*$Discount/100;
									
									$product_detail['discount_price']=$product_detail['selling_price']-$product_detail['discount_amount'];
									
									
									// Category Details
									$cid		= $product_detail['category_id'];
									$category_name		= $this->db->rp_getValue("category","category_name","id=".$cid);
									$product_detail['category_name'] = stripslashes($category_name);
									$product_detail['value'] = $product_detail['product_name'];
									// Media Details
									$media_info=$this->media->getMedia(array("mid"=>$product_detail['image']));	
									if($media_info['ack']==1){
										$product_detail['image']=$media_info['result']['full_url'];
									}
									else{
										$product_detail['image']=ADMINSITEURL.Media::$DefaultImage;
									}

									// Product Availablity		
									$pro_date=$this->db->rp_getValue("product_availability","availability_date","product_id='".$product_detail['id']."'",0);
									if($pro_date!=""){
										
										$product_detail['product_availability_date']=date("d-m-Y",strtotime($pro_date));
									}else{
										$product_detail['product_availability_date']="";
									
									}


									// Stock
									$Stock=$this->db->rp_getValue("product_store_item","SUM(stock_qty)","product_id='".$product_detail['id']."'");
									$product_detail['stock_qty']=$Stock;

									/*$cart_id=$this->db->rp_getValue("cartitems","cart_id","cbid='".$branch_id."' AND order_item_id='".$product_detail['id']."'");
									if($cart_id){
										$order_status=$this->db->rp_getValue("cartdetails","order_status","cart_id='".$cart_id."'");
										if($order_status==1){
											$is_flag=1;
										}else{
											$is_flag=0;
										}
									}else{
										$is_flag=0;
									}*/
									$is_flag=0;
									$cart_id=$this->db->rp_getValue("cartdetails","cart_id","cid='".$CustomerID."' AND cbid='".$branch_id."' AND order_status=1",0);
									if($cart_id){
										$total_record=$this->db->rp_getTotalRecord("cartitems","cart_id='".$cart_id."' AND order_item_id='".$product_detail['id']."'");
										if($total_record!=0){
											$is_flag=1;
										}else{
											$is_flag=0;
										}
									}


									$product_detail['stock_qty']=$Stock;
									$product_detail['product_cart_in']=$is_flag;


									$result[] 	= $product_detail;	
						}
						
					}
				}
				
				
			}
			
		}
		
		
		return $result;
	}
	public function aj_getProductPrice($pid,$priceid,$uid="")
	{
		
		$price=parent::rp_getValue("product_weight_price","price","id='".$priceid."' AND product_id='".$pid."'",0);
		if($price)
		{
			$weight_id=parent::rp_getValue("product_weight_price","weight_id","id='".$priceid."'","",0);
			$title=parent::rp_getValue("weight","name","id='".$weight_id."'");
			if($uid!="")
			{
				$pricelist=parent::rp_getValue("user","price_list","id='".$uid."'");
				$discountPer=parent::rp_getValue("pricelist","percentage","id='".$pricelist."'");

				if($discountPer!=0)
				{
					$discountAmount=$price*$discountPer/100;			
				}
				else
				{
					$discountAmount=0;
				}

				$finalPrice=$price-$discountAmount;
			} 
			else
			{
				$finalPrice=$price;
			}
			return array('ack'=>1,'title'=>$title,'price'=>$finalPrice,"weight_id"=>$weight_id);
		}
		else
		{
			return array('ack'=>0,'ack_msg'=>'Price list mismatch');
		}
		
	}
	public function aj_getRecipeDetail($rid,$uid=""){
		$q = 1;
		$recipe_r = parent::rp_getData("recipes","*","id='".$rid."' AND isDelete=0","",0);
		if($recipe_r){
			
			$recipe_detail=mysqli_fetch_assoc($recipe_r);
			
			$recipe_detail['material']=explode("&xx5895",$recipe_detail['material']);
			$recipe_detail['steps']=explode("&xx5895",$recipe_detail['steps']);
			
			$recipe_detail['image_path']=FINAL_URL."".ADMINFOLDER."/".RECIPE."".$recipe_detail['image_path'];
			
			$recipe_detail['recipe_type']=parent::rp_getValue("recipe_category","name","id=".$recipe_detail['type'],"id LIMIT ".$limit);
			
			$alt_images=array();
			$alt_images_q=parent::rp_getData("recipe_alt_image","*","rid='".$recipe_detail['id']."'","display_order ASC",0);
			
			if($alt_images_q){
					
				while($f = mysqli_fetch_array($alt_images_q)){
					array_push($alt_images,FINAL_URL."".ADMINFOLDER."/".RECIPE_ALT_A."".$f['image_path']);
				}
			}
			$recipe_detail['alt_img']=$alt_images;
			if(isset($_REQUEST['uid']) && $_REQUEST['uid']!="")
			{
					$uid=$_REQUEST['uid'];
					$fav=(parent::rp_getTotalRecord("recipe_favorite","uid = '".$uid."' AND rid='".$recipe_detail['id']."'",0)>0)?1:0;
			}
			else
			{
					$fav=0;
			}
			$recipe_detail['favorite']=$fav;		
			return $recipe_detail;
		}else{
			return array();;
		}
	}
	
	public function rp_updateCartQuantity() //update pro qty after succcessfull order
	{
		$shop_cart_r = parent::rp_getData("cartitems","*","cart_id='".$_SESSION['SHOPWALA_SESS_CART_ID']."'");
		if($shop_cart_r){
			while($shop_cart_d = mysqli_fetch_array($shop_cart_r)){
				$pid 		= $shop_cart_d['pid'];
				$subpid 	= $shop_cart_d['subpid'];
				$qty 		= $shop_cart_d['qty'];
				if($subpid>0){
					$pro_qty 	= parent::rp_getValue("sub_product","qty","id='".$subpid."'");
				}else{
					$pro_qty 	= parent::rp_getValue("product","qty","id='".$pid."'");
				}	
				$new_qty = intval($pro_qty)-intval($qty);
				if($new_qty==0){
					$rows 	= array(
						"qty"		=> $new_qty,
						"status"	=> "1",
					);
				}else{
					$rows 	= array(
						"qty"		=> $new_qty,
					);
				}
				if($subpid>0){
					$where	= "id='".$subpid."'";
					parent::rp_update("sub_product",$rows,$where);
					/****/
					$isDefault 	= parent::rp_getValue("sub_product","isDefault","id='".$subpid."'");
					if($isDefault>0){
						if($new_qty==0){
							$drows 	= array(
								"qty"		=> $new_qty,
								"status"	=> "1",
							);
						}else{
							$drows 	= array(
								"qty"		=> $new_qty,
							);
						}
						$dwhere	= "id='".$pid."'";
						parent::rp_update("product",$drows,$dwhere);
					}
					/****/
				}else{
					$where	= "id='".$pid."'";
					parent::rp_update("product",$rows,$where);
				}
			}
		}
	}
	public function aj_updateCartQuantity($cid) //update pro qty after succcessfull order
	{
		$shop_cart_r = parent::rp_getData("cartitems","*","cart_id='".$cid."'");
		if($shop_cart_r){
			while($shop_cart_d = mysqli_fetch_array($shop_cart_r)){
				$pid 		= $shop_cart_d['pid'];
				$subpid 	= $shop_cart_d['subpid'];
				$qty 		= $shop_cart_d['qty'];
				if($subpid>0){
					$pro_qty 	= parent::rp_getValue("sub_product","qty","id='".$subpid."'");
				}else{
					$pro_qty 	= parent::rp_getValue("product","qty","id='".$pid."'");
				}	
				$new_qty = intval($pro_qty)-intval($qty);
				if($new_qty==0){
					$rows 	= array(
						"qty"		=> $new_qty,
						"status"	=> "1",
					);
				}else{
					$rows 	= array(
						"qty"		=> $new_qty,
					);
				}
				if($subpid>0){
					$where	= "id='".$subpid."'";
					parent::rp_update("sub_product",$rows,$where);
					/****/
					$isDefault 	= parent::rp_getValue("sub_product","isDefault","id='".$subpid."'");
					if($isDefault>0){
						if($new_qty==0){
							$drows 	= array(
								"qty"		=> $new_qty,
								"status"	=> "1",
							);
						}else{
							$drows 	= array(
								"qty"		=> $new_qty,
							);
						}
						$dwhere	= "id='".$pid."'";
						parent::rp_update("product",$drows,$dwhere);
					}
					/****/
				}else{
					$where	= "id='".$pid."'";
					parent::rp_update("product",$rows,$where);
				}
			}
		}
	}
	public function rp_getDiscountAmount($disc_type,$discount,$totalprice){ // $disc_type : 0=flat, 1=perc
		if($disc_type==0){
			return $discount;
		}else{
			$discount_amt = $totalprice*($discount/100);
			return $discount_amt;
		}
	}
	public function rp_getProductQty($pid)
    {
			$proQty = parent::rp_getValue("product","stock_qty","id='".$pid."'"); 
			return $proQty;
    }
	public function rp_checkQtyToAddInCart($cart_id,$pid,$qty,$type,$subpid=0){ //check product qty before add to cart
		$curr_qty = $this->rp_getProductQty($pid);
		
		if($type==2){
			$curr_cart_qty = 0;
		}else{
			if($cart_id>0){
				
					$curr_cart_qty = parent::rp_getValue("cartitems","order_item_qty","order_item_id='".$pid."' AND cart_id='".$cart_id."'");
				
			}else{
				$curr_cart_qty = 0;
			}
		}
		$qty1 = $curr_cart_qty+$qty;
		if($qty1>$curr_qty){
			return 0;
		}else{
			return 1;
		}
	}
	
	public function rp_shipChargeUpdate(){ // update shipping charge in cart if Pincode avail
		if(isset($_SESSION['SHOPWALA_SESS_CART_ID']) && $_SESSION['SHOPWALA_SESS_CART_ID']>0 && isset($_SESSION['SHOPWALA_SESS_PINCODE']) && $_SESSION['SHOPWALA_SESS_PINCODE']!=""){
			$shop_cart_r = parent::rp_getData("cartitems","*","cart_id='".$_SESSION['SHOPWALA_SESS_CART_ID']."'");
			if($shop_cart_r){
				while($shop_cart_d = mysqli_fetch_array($shop_cart_r)){
					$pid 		= $shop_cart_d['pid'];
					$subpid 	= $shop_cart_d['subpid'];
					$qty 		= $shop_cart_d['qty'];
					$ship_charge = parent::rp_getShippingCharge($_SESSION['SHOPWALA_SESS_PINCODE'],$pid,$subpid);
					$ship_charge = parent::rp_num($ship_charge*$qty);
					$rows 	= array(
						"ship_charge"		=> $ship_charge,
					);
					$where	= "pid='".$pid."' AND cart_id='".$_SESSION['SHOPWALA_SESS_CART_ID']."'";
					parent::rp_update("cartitems",$rows,$where);
				}
			}
		}
	}
	public function aj_shipChargeUpdate($cid,$pincode){ // update shipping charge in cart if Pincode avail
		if($cid>0 && $pincode!=""){
			$shop_cart_r = parent::rp_getData("cartitems","*","cart_id='".$cid."'");
			if($shop_cart_r){
				while($shop_cart_d = mysqli_fetch_array($shop_cart_r)){
					$pid 		= $shop_cart_d['pid'];
					$subpid 	= $shop_cart_d['subpid'];
					$weight_id 	= $shop_cart_d['weight_id'];
					$qty 		= $shop_cart_d['qty'];
					$ship_charge = parent::rp_getShippingCharge($pincode,$pid,$weight_id,$subpid);
					$ship_charge = parent::rp_num($ship_charge*$qty);
					$rows 	= array(
						"ship_charge"		=> $ship_charge,
					);
					$where	= "pid='".$pid."' AND weight_id='".$weight_id."' AND cart_id='".$cid."'";
					parent::rp_update("cartitems",$rows,$where);
				}
			}
		}
	}
	public function rp_rcorder($rcOrder,$cart_id){ // return or cancel order
		//Get Cart Details
		$cart_details_r = parent::rp_getData("cartdetails","*","cart_id='".$cart_id."'");
		$cart_details_d = mysqli_fetch_array($cart_details_r);
		$order_date 	= $cart_details_d["orderdate"];
		$order_status 	= $cart_details_d["orderstatus"];
		
		if($rcOrder==$cart_id+6){ // Ret
			// Return Order
			//return $this->rp_returnOrder($cart_id,$order_date,$order_status);
			$_SESSION['return_ty']			= 0;
			$_SESSION['return_cart_id'] 	= $cart_id;
			$_SESSION['return_cartitem_id'] = 0;
			return "ret";
		}else if($rcOrder==$cart_id+9){ //Can
			// Cancel Order
			//return $this->rp_cancelOrder($cart_id,$order_date,$order_status);
			$_SESSION['cancel_ty']			= 0;
			$_SESSION['cancel_cart_id'] 	= $cart_id;
			$_SESSION['cancel_cartitem_id'] = 0;
			return "can";
		}else{
			return "Something went wrong. Please try again or you can contact our customer care.";
		}
	}
	
	public function rp_rcorder_history($cart_id,$from_status,$to_status){ // Save RCOrder History Starts
		/****RCOrder Item Starts****/
		$today_date	= date('Y-m-d H:i:s');
		$shop_cart_r= parent::rp_getData("cartitems","*","cart_id='".$cart_id."'");
		if($shop_cart_r){
			while($shop_cart_d = mysqli_fetch_array($shop_cart_r)){
				$cart_item_id 	= $shop_cart_d['id'];
				$uid 			= $shop_cart_d['uid'];
				$pid 			= $shop_cart_d['pid'];
				$subpid 		= $shop_cart_d['subpid'];
				$cdrows 	= array(
						"cart_id",
						"cart_item_id",
						"pid",
						"subpid",
						"uid",
						"from_status",
						"to_status",
						"rcdate",
					);
				$cdvalues = array(
						$cart_id,
						$cart_item_id,
						$pid,
						$subpid,
						$uid,
						$from_status,
						$to_status,
						$today_date,
					);
				parent::rp_insert("rcorder_items",$cdvalues,$cdrows);
				/****Update Cartitem Starts****/
				$rows 	= array(
						"rcdate"		=> $today_date,
						"orderstatus"	=> $to_status,
					);
				$where	= "id='".$cart_item_id."'";
				parent::rp_update("cartitems",$rows,$where);
				/****Update Cartitem Ends****/
			}
		}
		/****RCOrder Item Ends****/
		/****RCOrder Starts****/
		$uid = parent::rp_getValue("cartdetails","uid","cart_id='".$cart_id."'");
		$cdrows 	= array(
				"cart_id",
				"uid",
				"from_status",
				"to_status",
				"rcdate",
			);
		$cdvalues = array(
				$cart_id,
				$uid,
				$from_status,
				$to_status,
				$today_date,
			);
		$rcid = parent::rp_insert("rcorder",$cdvalues,$cdrows);
		return $rcid;
		/****RCOrder Ends****/
	}
	
	public function rp_rcSingleOrder_history($cart_id,$cartitem_id,$from_status,$to_status){ // Save RCSingleOrder History Starts
		/****RCOrder Single Item Starts****/
		$today_date	= date('Y-m-d H:i:s');
		$shop_cart_r= parent::rp_getData("cartitems","*","cart_id='".$cart_id."' AND id='".$cartitem_id."'");
		if($shop_cart_r){
			$shop_cart_d = mysqli_fetch_array($shop_cart_r);
			$cart_item_id 	= $shop_cart_d['id'];
			$uid 			= $shop_cart_d['uid'];
			$pid 			= $shop_cart_d['pid'];
			$subpid 		= $shop_cart_d['subpid'];
			$cdrows 	= array(
					"cart_id",
					"cart_item_id",
					"pid",
					"subpid",
					"uid",
					"from_status",
					"to_status",
					"rcdate",
				);
			$cdvalues = array(
					$cart_id,
					$cartitem_id,
					$pid,
					$subpid,
					$uid,
					$from_status,
					$to_status,
					$today_date,
				);
			$rcsid = parent::rp_insert("rcorder_items",$cdvalues,$cdrows);
			return $rcsid;
		}
		/****RCOrder Single Item Ends****/
	}
	
	public function rp_returnOrder($cart_id,$order_date,$order_status){ // Return Full Order
		$last_date_to_return= date('Y-m-d', strtotime($order_date." +".RETURN_HOURS." hours"));
		$today_date			= date('Y-m-d');
		if(strtotime($today_date)<=strtotime($last_date_to_return)){
			if($order_status==4){
				/***Save History Starts***/
				$rcid = $this->rp_rcorder_history($cart_id,$order_status,"5");	
				/***Save History Ends***/
				$today_date1	= date('Y-m-d H:i:s');
				$rows 	= array(
						"rcdate"		=> $today_date1,
						"orderstatus"	=> "5",
					);
				$where	= "cart_id='".$cart_id."'";
				parent::rp_update("cartdetails",$rows,$where);
				$fn = new parent;
				$nt = new notification($fn);
				/**Send SMS**/
				$smsMsg = "We've receive your return request from order #".$cart_id.". We can reject or accept your request based on conditions ";
				$nt->rp_sendSMS2($cart_id,$smsMsg,SMSPROMOTEXT);
				/**Send SMS**/
				
				/*******************************************************/
				$toemail 	= $db->rp_getValue("cartdetails","email","cart_id='".$cart_id."'");
				$subject	= SITENAME." - Order #".$cart_id." Return Request";
				$body = file_get_contents(SITEURL.'mailbody/return_whole_order_request.php?cart_id='.$cart_id.'');
				$nt->rp_sendGenEmail($toemail,$subject,$body);
				/*******************************************************/
				
				$_SESSION['rcid'] = $rcid;
				return "Your order return request has been placed successfully.";
				
			}else{
				return "Your order is not delivered yet. So you can not return the order. Instead of that you can cancel your order. If you have any query than please contact our customer care.";
			}
		}else{
			return "Last date to 'Return Order' is already passed. You can not return order. If you have any query than please contact our customer care.";
		}
	}
	
	public function rp_cancelOrder($cart_id,$order_date,$order_status){ // update shipping charge in cart if Pincode avail
		$last_date_to_return= date('Y-m-d', strtotime($order_date." +".RETURN_HOURS." hours"));
		$today_date			= date('Y-m-d');
		if($order_status==2 || $order_status==3){
			if(strtotime($today_date)<=strtotime($last_date_to_return)){
				
				/**Update Qty Starts**/
				$this->rp_rcQtyUpdate($cart_id);
				/**Update Qty Ends**/
				
				/***Save History Starts***/
				$rcid = $this->rp_rcorder_history($cart_id,$order_status,"0");	
				/***Save History Ends***/
				
				$today_date1	= date('Y-m-d H:i:s');
				$rows 	= array(
						"rcdate"		=> $today_date1,
						"orderstatus"	=> "0",
					);
				$where	= "cart_id='".$cart_id."'";
				parent::rp_update("cartdetails",$rows,$where);
				
				$fn = new parent;
				$nt = new notification($fn); 
				/**Send SMS**/
				$smsMsg = "We've receive your cancel request for order #".$cart_id.". You can check your updated order in your Account. ";
				$nt->rp_sendSMS2($cart_id,$smsMsg,SMSPROMOTEXT);
				/**Send SMS**/
				
				/**Send Email**/
				$subject	= SITENAME." - Order #".$cart_id." Cancelled";
				$toemail 	= parent::rp_getValue("cartdetails","email","cart_id='".$cart_id."'");
				$body = file_get_contents(SITEURL.'mailbody/cancel_whole_order.php?cart_id='.$cart_id.'');
				$nt->rp_sendGenEmail($toemail,$subject,$body);
				/**Send Email**/
				
				$_SESSION['rcid'] = $rcid;
				return "Your order has been cancelled successfully.";
			}else{
				return "Last date to 'Cancel Order' is already passed. You can not cancel order. If you have any query than please contact our customer care.";
			}
		}else{
			return "Your order is delivered. You can not cancel your order. Instead of that you can return your order. If you have any query than please contact our customer care.";
		}
	}
	
	public function rp_getRefundAmount($cart_id){ // return or cancel order
		//Get Cart Details
		$cart_details_r = parent::rp_getData("cartdetails","*","cart_id='".$cart_id."'");
		$cart_details_d = mysqli_fetch_array($cart_details_r);
		$order_status 	= $cart_details_d["orderstatus"];
		$total_ship_charge 	= parent::rp_num($cart_details_d["total_ship_charge"]);
		$cod_charge 		= parent::rp_num($cart_details_d["cod_charge"]);
		$finaltotal 		= parent::rp_num($cart_details_d["finaltotal"]);
		if($order_status==0){
			$prevoius_orderstatus = parent::rp_getValue("rcorder","from_status","cart_id='".$cart_id."' AND to_status='".$order_status."'");
			if($prevoius_orderstatus==3){ // Shipped than take shipping charge
				$refund_amount = parent::rp_num($finaltotal - $total_ship_charge - $cod_charge);
			}else{ //In Progress than refund all amount
				$refund_amount = parent::rp_num($finaltotal);
			}
		}elseif($order_status==5){ // Delivered order refund amount
			$refund_amount = parent::rp_num($finaltotal - $total_ship_charge - $cod_charge);
		}else{
			$refund_amount = 0.00;
		}
		return $refund_amount;
	}
	
	public function rp_getSingleItemRefundAmount($cart_id,$cart_item_id){ // return or cancel order
		//Get Cart Details
		$cart_item_r 	= parent::rp_getData("cartitems","*","cart_id='".$cart_id."' AND id='".$cart_item_id."'");
		$cart_item_d 	= mysqli_fetch_array($cart_item_r);
		$order_status	= $cart_item_d["orderstatus"];
		$totalprice 	= parent::rp_num($cart_item_d["totalprice"]);
		return $totalprice;
	}
	
	public function rp_getSingleItemShippingRefundAmount($cart_id,$cart_item_id){ // return or cancel order
		//Get Cart Details
		$cart_item_r 	= parent::rp_getData("cartitems","*","cart_id='".$cart_id."' AND id='".$cart_item_id."'");
		$cart_item_d 	= mysqli_fetch_array($cart_item_r);
		$order_status	= $cart_item_d["orderstatus"];
		$ship_charge	= parent::rp_num($cart_item_d["ship_charge"]);
		if($order_status==0){
			$prevoius_orderstatus = parent::rp_getValue("rcorder_items","from_status","cart_id='".$cart_id."' AND cart_item_id='".$cart_item_id."' AND to_status='".$order_status."'");
			if($prevoius_orderstatus==3){ // Shipped than take shipping charge
				$ship_refund_amount = 0.00;
			}else{ //In Progress than refund all amount
				$ship_refund_amount = parent::rp_num($ship_charge);
			}
		}elseif($order_status==5){ // Delivered order refund amount
			$ship_refund_amount = 0.00;
		}else{
			$ship_refund_amount = 0.00;
		}
		return $ship_refund_amount;
	}
	
	public function rp_getSingleItemCODRefundAmount($cart_id,$cart_item_id,$payment_method){ // return or cancel order
		if($payment_method==1){
			//Get Cart Details
			$cart_item_r 	= parent::rp_getData("cartitems","*","cart_id='".$cart_id."' AND id='".$cart_item_id."'");
			$cart_item_d 	= mysqli_fetch_array($cart_item_r);
			$order_status	= $cart_item_d["orderstatus"];
			$totalprice 	= parent::rp_num($cart_item_d["totalprice"]);
			if($order_status==0){
				$prevoius_orderstatus = parent::rp_getValue("rcorder_items","from_status","cart_id='".$cart_id."' AND cart_item_id='".$cart_item_id."' AND to_status='".$order_status."'");
				if($prevoius_orderstatus==3){ // Shipped than take shipping charge
					$COD_refund_amount = 0.00;
				}else{ //In Progress than refund all amount
					$cod_charge	= parent::rp_num($totalprice*(COD_PER/100));
					if($cod_charge<COD_FLAT){
						$cod_charge = parent::rp_num(COD_FLAT);
					}
					$COD_refund_amount = parent::rp_num($cod_charge);
				}
			}elseif($order_status==5){ // Delivered order refund amount
				$COD_refund_amount = 0.00;
			}else{
				$COD_refund_amount = 0.00;
			}
		}else{
			$COD_refund_amount = 0.00;
		}
		return $COD_refund_amount;
	}
	
	public function rp_rcsingle_order($rcOrder,$cart_id,$cartitem_id){ // return or cancel order
		
		$cart_details_r = parent::rp_getData("cartdetails","orderdate,orderstatus","cart_id='".$cart_id."'");
		$cart_details_d = mysqli_fetch_array($cart_details_r);
		$order_date 	= $cart_details_d["orderdate"];
		$order_status	= $cart_details_d["orderstatus"];
		
		if($rcOrder==$cartitem_id+6){ // Ret
			// Return Single Order
			/*if(parent::rp_getTotalRecord("cartitems","cart_id='".$cart_id."'")==1){
				return $this->rp_returnOrder($cart_id,$order_date,$order_status);
			}else{
				return $this->rp_returnSingleOrder($cart_id,$cartitem_id,$order_date,$order_status);
			}*/
			$_SESSION['return_ty']			= 1;
			$_SESSION['return_cart_id'] 	= $cart_id;
			$_SESSION['return_cartitem_id'] = $cartitem_id;
			return "ret";
		}else if($rcOrder==$cartitem_id+9){ // Can
			// Cancel Single Order
			/*if(parent::rp_getTotalRecord("cartitems","cart_id='".$cart_id."'")==1){
				return $this->rp_cancelOrder($cart_id,$order_date,$order_status);
			}else{
				return $this->rp_cancelSingleOrder($cart_id,$cartitem_id,$order_date,$order_status);
			}*/
			$_SESSION['cancel_ty']			= 1;
			$_SESSION['cancel_cart_id'] 	= $cart_id;
			$_SESSION['cancel_cartitem_id'] = $cartitem_id;
			return "can";
		}else{
			return "Something went wrong. Please try again or you can contact our customer care.";
		}
	}
	
	public function rp_returnSingleOrder($cart_id,$cartitem_id,$order_date,$order_status){ // return single order
		$last_date_to_return= date('Y-m-d', strtotime($order_date." +".RETURN_HOURS." hours"));
		$today_date			= date('Y-m-d');
		if(strtotime($today_date)<=strtotime($last_date_to_return)){
			if($order_status==4){
				
				/***Save History Starts***/
				$rcsid = $this->rp_rcSingleOrder_history($cart_id,$cartitem_id,$order_status,"5");	
				/***Save History Ends***/
				
				/****Update Cartitem Starts****/
				$rows 	= array(
						"rcdate"		=> $today_date,
						"orderstatus"	=> "5",
					);
				$where	= "id='".$cartitem_id."'";
				parent::rp_update("cartitems",$rows,$where);
				/****Update Cartitem Ends****/
				
				/*******Check ALL Item is Returned Starts*******/
				$this->rp_isAllRC($cart_id,$order_status,"5");
				/*******Check ALL Item is Returned Ends*******/
				$fn = new parent;
				$nt = new notification($fn);
				/**Send SMS**/
				$itemName = parent::rp_getValue("cartitems","name","id='".$cartitem_id."'");
				$msg = "Your mufat.in order #".$cart_id." item '".$itemName."' return request has been placed...";
				$nt->rp_sendSMS2($cart_id,$msg,SMSPROMOTEXT);
				/**Send SMS**/
				
				/**Send Email**/
				$subject	= SITENAME." - Order #".$cart_id." item '".$itemName."' Return Request";
				$toemail 	= parent::rp_getValue("cartdetails","email","cart_id='".$cart_id."'");
				$body = file_get_contents(SITEURL.'mailbody/return_single_order_item.php?cart_id='.$cart_id.'&ciid='.$cartitem_id.'');
				$nt->rp_sendGenEmail($toemail,$subject,$body);
				/**Send Email**/
				$_SESSION['rcsid'] = $rcsid;
				return "Your ordered item return request has been placed.";
			}else{
				return "Your order is not delivered yet. So you can not return the order item. Instead of that you can cancel your order item. If you have any query than please contact our customer care.";
			}
		}else{
			return "Last date to 'Return Order' is already passed. You can not return order item. If you have any query than please contact our customer care.";
		}
	}
	
	public function rp_cancelSingleOrder($cart_id,$cartitem_id,$order_date,$order_status){ // Cancel single order
		$last_date_to_return= date('Y-m-d', strtotime($order_date." +".RETURN_HOURS." hours"));
		$today_date			= date('Y-m-d');
		if(strtotime($today_date)<=strtotime($last_date_to_return)){
			if($order_status==2 || $order_status==3){
				
				/**Update Qty Starts**/
				$this->rp_rcSingleQtyUpdate($cartitem_id);
				/**Update Qty Ends**/
				
				/***Save History Starts***/
				$rcsid = $this->rp_rcSingleOrder_history($cart_id,$cartitem_id,$order_status,"0");	
				/***Save History Ends***/
				
				/****Update Cartitem Starts****/
				$rows 	= array(
						"rcdate"		=> $today_date,
						"orderstatus"	=> "0",
					);
				$where	= "id='".$cartitem_id."'";
				parent::rp_update("cartitems",$rows,$where);
				/****Update Cartitem Ends****/
				/*******Check ALL Item is Returned Starts*******/
				$this->rp_isAllRC($cart_id,$order_status,"0");
				/*******Check ALL Item is Returned Ends*******/
				
				$fn = new parent;
				$nt = new notification($fn); 
				/**Send SMS**/
				
				$msg = "Your mufat.in order #".$cart_id." item '".$itemName."' has been cancelled successfully...";
				$nt->rp_sendSMS2($cart_id,$msg,SMSPROMOTEXT);
				/**Send SMS**/
				
				/**Send Email**/
				$subject	= SITENAME." - Order #".$cart_id." item '".$itemName."' Cancelled";
				$toemail 	= parent::rp_getValue("cartdetails","email","cart_id='".$cart_id."'");
				$body = file_get_contents(SITEURL.'mailbody/cancel_single_order_item.php?cart_id='.$cart_id.'');
				$nt->rp_sendGenEmail($toemail,$subject,$body);
				/**Send Email**/
				$_SESSION['rcsid'] = $rcsid;
				return "Your ordered item has been cancelled successfully.";
			}else{
				return "Your order is delivered. You can not cancel your order. Instead of that you can return your order. If you have any query than please contact our customer care.";
			}
		}else{
			return "Last date to 'Cancel Order' is already passed. You can not cancel order. If you have any query than please contact our customer care.";
		}
	}
	
	public function rp_isAllRC($cart_id,$from_status,$to_status){
		//if all item in cartitem are returned or cancel than update cartdetails and rcorder
		$shop_cart_t = parent::rp_getTotalRecord("cartitems","cart_id='".$cart_id."' AND orderstatus='".$from_status."'");
		if($shop_cart_t>0){
			//Do nothing
		}else{
			/***UPdate Cartdetails Starts***/
			$today_date1	= date('Y-m-d H:i:s');
			$rows 	= array(
					"rcdate"		=> $today_date1,
					"orderstatus"	=> $to_status,
				);
			$where	= "cart_id='".$cart_id."'";
			parent::rp_update("cartdetails",$rows,$where);
			/***Update Cartdetails Ends***/
			/****RCOrder Starts****/
			$uid = parent::rp_getValue("cartdetails","uid","cart_id='".$cart_id."'");
			$cdrows 	= array(
					"cart_id",
					"uid",
					"from_status",
					"to_status",
					"rcdate",
				);
			$cdvalues = array(
					$cart_id,
					$uid,
					$from_status,
					$to_status,
					$today_date1,
				);
			parent::rp_insert("rcorder",$cdvalues,$cdrows);
			/****RCOrder Ends****/
		}
		
	}
	
	public function rp_getPaymentMode(){
		if(isset($_SESSION['SW_ADMIN_SESS_ID']) && $_SESSION['SW_ADMIN_SESS_ID']!=""){
			return parent::rp_getValue("ccavenue_paymentgateway","status","id=1");
		}else{
			return "0";
		}
	}
	
	public function rp_getShippingDiscount($sub_total,$shipping_charge){
		if(SDP>0){
			if($sub_total>=MOTAFSD){
				$disc_amount = parent::rp_num(($shipping_charge*SDP)/100);
				if($disc_amount<=$shipping_charge){
					return parent::rp_num($disc_amount);
				}else{
					return 0.00;
				}
			}else{
				return 0.00;
			}
		}else{
			return 0.00;
		}
	}
	
	public function rp_rcSingleQtyUpdate($cartitem_id){
		$ciid_up_d = mysqli_fetch_array(parent::rp_getData("cartitems","pid,subpid,name,qty","id='".$cartitem_id."' AND orderstatus!=0 AND orderstatus!=5"));
		$itemName 	= stripslashes($ciid_up_d['name']);
		$itemPid	= $ciid_up_d['pid'];
		$itemSubPid	= $ciid_up_d['subpid'];
		$itemQty	= $ciid_up_d['qty'];
		
		if($itemSubPid>0){
			$sp_r 	= parent::rp_getData("sub_product","qty,status","id='".$itemSubPid."'");
			if($sp_r){
				$sp_d 	= mysqli_fetch_array($sp_r);
				$cqty	= $sp_d["qty"];
				$cspstt	= $sp_d["status"];
				$nqty	= $cqty+$itemQty;
				if($cspstt==1 && $nqty>0){
					$nspstt	= 0;
				}else{
					$nspstt	= 0;
				}
				$qrows 	= array(
						"qty"		=> $cqty+$itemQty,
						"status"	=> $nspstt,
					);
				$qwhere	= "id='".$itemSubPid."'";
				parent::rp_update("sub_product",$qrows,$qwhere);
			}
		}else{
			$p_r 	= parent::rp_getData("product","qty,status","id='".$itemPid."'");
			if($p_r){
				$p_d 	= mysqli_fetch_array($p_r);
				$cqty	= $p_d["qty"];
				$cpstt	= $p_d["status"];
				$nqty	= $cqty+$itemQty;
				if($cpstt==1 && $nqty>0){
					$npstt	= 0;
				}else{
					$npstt	= 0;
				}
				$qrows 	= array(
						"qty"		=> $cqty+$itemQty,
						"status"	=> $npstt,
					);
				$qwhere	= "id='".$itemPid."'";
				parent::rp_update("product",$qrows,$qwhere);
			}
		}
	}
	public function rp_rcQtyUpdate($cart_id){
		$rcQty_r = parent::rp_getData("cartitems","id","cart_id='".$cart_id."'  AND orderstatus!=0 AND orderstatus!=5");
		if($rcQty_r){
			while($rcQty_d = mysqli_fetch_array($rcQty_r)){
				$this->rp_rcSingleQtyUpdate($rcQty_d['id']);
			}
		}
	}
	
	
	public function applyCoupon($cart_id,$coupon_code)
	{
		/******Get Coupon Data*******/
		$cc_r 		= $this->rp_getData("coupon_code","*","coupon_code='".$coupon_code."' AND isDelete=0 AND (valid_from <= NOW() AND valid_to >= NOW())","",0);
		if($cc_r){
			$cc_d = mysqli_fetch_array($cc_r);
			$coupon_id	= $cc_d['id'];
			$cat_type	= stripslashes($cc_d['cat_type']);
			$cat_id		= explode(",",$cc_d['cat_id']);
			$disc_type 	= stripslashes($cc_d['disc_type']);
			$discount	= $this->rp_num($cc_d['discount']);
			$min_amount = $this->rp_num($cc_d['min_amount']);
			
			/******Get Shoppoing Cart Data and Update Cartitems*******/
				$shop_cart_r = $this->rp_getData("cartitems","*","cart_id='".$cart_id."'");
				$cc = 0;
				while($shop_cart_d = mysqli_fetch_array($shop_cart_r)){
					$discount_amt=0;
					$id 		= $shop_cart_d['id'];
					$pid 		= $shop_cart_d['pid'];
					$totalprice = $this->rp_num($shop_cart_d['totalprice']);
					
					$pro_r 		= $this->rp_getData("product","*","id='".$pid."'","",0);
					$pro_d 		= mysqli_fetch_array($pro_r);
					//print_r($pro_d);
					$pro_bid	= stripslashes($pro_d["bid"]);
				    $pro_cid	= stripslashes($pro_d["cid"]);
					$pro_sid	= stripslashes($pro_d["sid"]);
					$pro_ssid	= stripslashes($pro_d["ssid"]);
					
					if($cat_type==0){ //All
						$discount_amt = $this->rp_getDiscountAmount($disc_type,$discount,$totalprice);
						$cc++;
					}else if($cat_type==1){ //Category
						if(in_array($pro_cid,$cat_id)){
							$discount_amt = $this->rp_getDiscountAmount($disc_type,$discount,$totalprice);
							$cc++;
						}
					}else if($cat_type==2){ //Sub Category
						if(in_array($pro_sid,$cat_id)){
							$discount_amt = $this->rp_getDiscountAmount($disc_type,$discount,$totalprice);
							$cc++;
						}
					}else if($cat_type==3){ //Sub Sub Category
						if(in_array($pro_ssid,$cat_id)){
							$discount_amt = $this->rp_getDiscountAmount($disc_type,$discount,$totalprice);
							$cc++;
						}
					}else if($cat_type==4){
						if(in_array($pro_bid,$cat_id)){
							$discount_amt = $this->rp_getDiscountAmount($disc_type,$discount,$totalprice);
							$cc++;
						}
					}
					
					
					$cartitem_rows 	= array(
							"coupon_id"	=> $coupon_id,
							"discount"	=> $discount_amt,
						);
						
					$where	= "cart_id='".$cart_id."' AND id='".$id."'";
					$this->rp_update("cartitems",$cartitem_rows,$where);
					
				}
			/******Get Shopping Cart Data and Update Cartitems*******/
			if($cc>0){
				/*********Update CartDetail*********/

				$cartdetails_rows 	= array(
						"coupon_id"		=> $coupon_id,
						"coupon_code"	=> $coupon_code,
					);
					
				$where	= "cart_id='".$cart_id."'";
				$this->rp_update("cartdetails",$cartdetails_rows,$where,0);
				
				/*********Update CartDetail*********/
				$shop_cart_r = $this->rp_getData("cartitems","*","cart_id='".$cart_id."'");
				if($shop_cart_r){
					$totalprice = 0;
					$discount 	= 0;
					$sub_total	= 0;
					$pid_ids	= "";
					$total_ship_charge= 0;
					
					while($shop_cart_d = mysqli_fetch_array($shop_cart_r)){
						$id 		= $shop_cart_d['id'];
						$pid 		= $shop_cart_d['pid'];
						$subpid 	= $shop_cart_d['subpid'];
						$pid_ids	.= $pid.",";
						$qty 		= $shop_cart_d['qty'];
						$attr_val	= unserialize($shop_cart_d["attr_val"]);
						$ship_charge= $this->rp_num($shop_cart_d["ship_charge"]);
						$total_ship_charge += $ship_charge;
						$ship_days	= intval($shop_cart_d["ship_days"]);
						$unitprice 	= $this->rp_num($shop_cart_d['unitprice']);
						$discount	+= $shop_cart_d['discount'];
						$totalprice = $this->rp_num($shop_cart_d['totalprice']);
						
						
						$sub_total 	+= $totalprice;
						$pro_r = mysqli_fetch_assoc($this->rp_getData("product","*","id='".$pid."'"));											
						$tax+=(($totalprice*$pro_r['pro_tax'])/100);
						
					}
				}
				$payment_method		="COD";
				$sub_total 			= $this->rp_num($sub_total);
				$shipping_charge 	= $this->rp_num($total_ship_charge);
				$shipping_discount 	= $this->rp_num($this->rp_getShippingDiscount($sub_total,$shipping_charge));
				$tax 				= $this->rp_num($tax);
				// if tax is excluded then add tax to final total here...
				$final_total 		= $this->rp_num(($sub_total + $shipping_charge) - $discount - $shipping_discount);	
				if($final_total<=0)
				{
					$final_total=0;
					$cartdetails_rows 	= array(
						"finaltotal"		=> 0,						
					);
					
					$where	= "cart_id='".$cart_id."'";
					$this->rp_update("cartdetails",$cartdetails_rows,$where,0);
				}					
				$ack=array("ack"=>1,"ack_msg"=>"Coupon applied successfully!!","sub_total"=>$sub_total,"shipping_charge"=>$total_ship_charge,"discount"=>$discount,"shipping_discount"=>$shipping_discount,"tax"=>$tax,"final_total"=>$final_total);
				return $ack;						
			}else{
				$ack=array("ack"=>0,"ack_msg"=>"Please enter valid coupon code!!");
				return $ack;	
			}
		}else{
			$ack=array("ack"=>0,"ack_msg"=>"Please enter valid coupon code!!");
			return $ack;	
		}
		/******Get Coupon Data*******/	
	}

	function updateDeliveryPincode($cart_id,$zip,$uid)
	{		
			if($cart_id!="" || $cart_id!=0)
			{
				$zip = intval(trim($zip));
				$delWhere 		= " pincode='".$zip."' AND isDelete=0";
				$delPinCheck_r 	= $this->rp_getData("delivery_pincode","*",$delWhere);
				if($delPinCheck_r && $delPinCheck_r)
				{
					$this->aj_shipChargeUpdate($cart_id,intval($zip));					
					$isUpdated=$this->rp_update("cartdetails",array("zip"=>intval($zip)),"cart_id='".$cart_id."'");
					if($isUpdated==1)
					{
						$reply=array("ack"=>1,"developer_msg"=>"Delivery Pincode Updated!!","ack_msg"=>"Delivery Pincode Updated!!");
						return $reply;
					}
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>"Database Error!!","ack_msg"=>"Internal Error!! Try later");
						return $reply;
					}
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"RIP Delivery not available","ack_msg"=>"Sorry We can't deliver product to your place!!");
					return $reply;
				}				
							
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"cart not found!!","ack_msg"=>"Internal Error!! Try later");
				return $reply;
			}
				
			
	}
	
	public function addToCart($ProductID,$Qty,$CustomerID,$CustomerBranchID)
	{
		
		$CartDetails=$this->rp_getData($this->CtableCartDetails,"*","cid='".$CustomerID."' AND order_status=1");
		
		$CustomerDetail=$this->rp_getData($this->CtableCustomer,"*","id='".$CustomerID."'","",0);
		if($CustomerDetail)
		{
			$CustomerDetail=mysqli_fetch_assoc($CustomerDetail);
			$BranchInformation=$this->rp_getData($this->CtableCustomerBranch,"*","id='".$CustomerBranchID."'");
			if($BranchInformation)
			{
				$BranchInformation=mysqli_fetch_assoc($BranchInformation);
				if($CartDetails)
				{
					$CartDetails=mysqli_fetch_assoc($CartDetails);
					$CartID=$CartDetails['cart_id'];
				}
				else
				{
					$CartDetails=array();
					$CartDetails['cid']=$CustomerID;
					$CartDetails['cbid']=$CustomerBranchID;
					$CartDetails['customer_name']=$BranchInformation['branch_name'];
					$CartDetails['customer_phone']=$BranchInformation['phone'];
					$CartDetails['customer_email']=$BranchInformation['email'];
					$CartDetails['customer_city']=$BranchInformation['city'];
					$CartDetails['customer_country']=$BranchInformation['country'];
					$CartDetails['customer_address']=$BranchInformation['address'];
					$CartDetails['customer_pincode']=$BranchInformation['pincode'];
					$CartDetails['order_status']=1;
					$CartDetails['created_date']=date("Y-m-d H:i:s");
					$CartID=$this->rp_insert($this->CtableCartDetails,array_values($CartDetails),array_keys($CartDetails),0);
					$CartDetails=$this->rp_getData($this->CtableCartDetails,"*","cart_id='".$CartID."'");
					if($CartDetails)
					{
						$CartDetails=mysqli_fetch_assoc($CartDetails);
					}
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('CUSTOMER_CART_NOT_FOUND',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_CART_NOT_FOUND'));
						return $reply;
					}
					
				}
				// CART FOUND NOW 
					 $ProductDetail =$this->aj_getProductDetail($CustomerBranchID,"","",array(),$ProductID);
					$ProductDetail=$ProductDetail[0];
					if(!empty($ProductDetail))
					{
						$BranchPriceListDetail=$this->db->rp_getData($this->CtablePriceList,"*","id='".$BranchInformation['price_list']."'","",0);
						if($BranchPriceListDetail)
						{
							$BranchPriceListDetail=mysqli_fetch_assoc($BranchPriceListDetail);
							$VATTax=$this->rp_getValue($this->CtableTax,"tax_value","id='".$ProductDetail['vat_tax']."'");
							$VATTaxName=$this->rp_getValue($this->CtableTax,"tax_name","id='".$ProductDetail['vat_tax']."'",0);
							$VATTaxName=($ProductDetail['vat_tax']!="" && $ProductDetail['vat_tax']!=0)?$VATTaxName:"";
							$VATTax=($VATTax!="")?floatval($VATTax):0;
							
							$OtherTax=($ProductDetail['other_tax']!="")?floatval($ProductDetail['other_tax']):0;
							$PriceInPriceList=$this->db->rp_getValue($this->CtablePriceListProducts,"price","product_id='".$ProductID."' AND price_list_id='".$BranchPriceListDetail['id']."'",0);
							if($PriceInPriceList=="")
							{
								$PriceInPriceList=$this->db->rp_getValue($this->CtableProduct,"selling_price","id='".$ProductID."'",0);
							}
								$VATTaxAmount=($PriceInPriceList*$VATTax)/100;
								$OtherTaxAmount=($PriceInPriceList*$OtherTax)/100;
								$CartItem=$this->rp_getData($this->CtableCartItems,"*","cart_id='".$CartID."' AND order_item_id='".$ProductID."'","",0);

								if($CartItem)
								{
									$CartItem=mysqli_fetch_assoc($CartItem);
									$NewCartItem['order_item_id']=$CartItem['order_item_id'];
									$NewCartItem['order_item_name']=$CartItem['order_item_name'];
									$NewCartItem['order_item_code']=$CartItem['order_item_code'];
									$NewCartItem['order_item_qty']=$CartItem['order_item_qty']+$Qty;
									$NewCartItem['original_qty']=$CartItem['order_item_qty']+$Qty;
									$NewCartItem['order_item_remaining_qty']=$CartItem['order_item_qty']+$Qty;
									$NewCartItem['status']=0;
									$NewCartItem['vat_tax_name']=$ProductDetail['vat_tax_name'];
									$NewCartItem['order_item_selling_price']=$ProductDetail['selling_price'];
									$NewCartItem['order_item_orignal_price']=$ProductDetail['selling_price'];
									$NewCartItem['order_item_sub_total']=$NewCartItem['order_item_qty']*$NewCartItem['order_item_selling_price'];
									$NewCartItem['order_item_discount']=$CustomerDetail['discount'];
									$NewCartItem['order_item_discount_amount']=($NewCartItem['order_item_sub_total']*$CustomerDetail['discount'])/100;
									$NewCartItem['tax']=$VATTax;
									$NewCartItem['tax_amount']=($NewCartItem['order_item_selling_price']*$VATTax)/100;
									$NewCartItem['other_tax']=$OtherTax;
									$NewCartItem['other_tax_amount']=($NewCartItem['order_item_selling_price']*$OtherTax)/100;
									$NewCartItem['order_item_grand_total']=$NewCartItem['order_item_sub_total']-$NewCartItem['order_item_discount_amount']+$NewCartItem['tax_amount']+$NewCartItem['other_tax_amount'];
									$isUpdated=$this->rp_update($this->CtableCartItems,$NewCartItem,"id='".$CartItem['id']."'",0);
									if($isUpdated)
									{
										$result=array("ack"=>1,"ack_msg"=>$this->log->getMessage('ADD_CART_QTY_UPDATED_SUCESS',1),"developer_msg"=>$this->log->getMessage('ADD_CART_QTY_UPDATED_SUCESS'));
									}
									else
									{
										$result=array('ack'=>0,"ack_msg"=>$this->log->getMessage('ADD_CART_PRODUCT_FAILED',1),"developer_msg"=>$this->log->getMessage('ADD_CART_PRODUCT_FAILED'));
									}	
									
								}
								else
								{
									$NewCartItem['cid']=$CustomerID;
									$NewCartItem['cbid']=$CustomerBranchID;
									$NewCartItem['cart_id']=$CartID;
									$NewCartItem['order_item_id']=$ProductDetail['id'];
									$NewCartItem['order_item_name']=$ProductDetail['product_name'];
									$NewCartItem['order_item_code']=$ProductDetail['product_code'];
									$NewCartItem['order_item_qty']=$Qty;
									$NewCartItem['original_qty']=$Qty;
									$NewCartItem['order_item_remaining_qty']=$Qty;
									$NewCartItem['status']=0;
									$NewCartItem['vat_tax_name']=$ProductDetail['vat_tax_name'];
									$NewCartItem['order_item_selling_price']=$ProductDetail['selling_price'];
									$NewCartItem['order_item_orignal_price']=$ProductDetail['selling_price'];
									$NewCartItem['order_item_sub_total']=$Qty*$NewCartItem['order_item_selling_price'];
									$NewCartItem['order_item_discount']=$CustomerDetail['discount'];
									$NewCartItem['order_item_discount_amount']=($NewCartItem['order_item_selling_price']*$CustomerDetail['discount'])/100;
									$NewCartItem['tax']=$VATTax;
									$NewCartItem['tax_amount']=($NewCartItem['order_item_selling_price']*$VATTax)/100;
									$NewCartItem['other_tax']=$OtherTax;
									$NewCartItem['other_tax_amount']=($NewCartItem['order_item_selling_price']*$OtherTax)/100;
									$NewCartItem['order_item_grand_total']=$NewCartItem['order_item_sub_total'];
									//-$NewCartItem['order_item_discount_amount']+$NewCartItem['tax_amount']+$NewCartItem['other_tax_amount']
									$CartItemID=$this->rp_insert($this->CtableCartItems,array_values($NewCartItem),array_keys($NewCartItem),0);										
									if($CartItemID!="")
									{
										$result=array('ack'=>1,"ack_msg"=>$this->log->getMessage('ADD_CART_PRODUCT_SUCESS',1),"developer_msg"=>$this->log->getMessage('ADD_CART_PRODUCT_SUCESS'));
									}
									else
									{
										$result=array('ack'=>0,"ack_msg"=>$this->log->getMessage('ADD_CART_PRODUCT_FAILED',1),"developer_msg"=>$this->log->getMessage('ADD_CART_PRODUCT_FAILED'));
									}
								}

								$this->UpdateCartPricing($CartID,$CustomerID,$CustomerBranchID);
								return $result;
								
															
						}
						else
						{
							$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('CUSTOMER_BRANCH_NOT_HAVING_PRICE_LIST',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_BRANCH_NOT_HAVING_PRICE_LIST'));
							return $reply;
						}
					}
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('CUSTOMER_BRANCH_NOT_HAVING_PRICE_LIST',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_BRANCH_NOT_HAVING_PRICE_LIST'));
						return $reply;
					}
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('CUSTOMER_BRANCH_NOT_HAVING_PRICE_LIST',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_BRANCH_NOT_HAVING_PRICE_LIST'));
				return $reply;
			}
			
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('CUSTOMER_NOT_FOUND',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_NOT_FOUND'));
				return $reply;
		}
			
		
	}
	
	public function UpdateCartItems($Items,$CustomerID,$CustomerBranchID,$CartID)
	{
		
			$CustomerDetail=$this->rp_getData($this->CtableCustomer,"*","id='".$CustomerID."'");
			if($CustomerDetail)
			{
				$CustomerDetail=mysqli_fetch_assoc($CustomerDetail);
				$BranchInformation=$this->rp_getData($this->CtableCustomerBranch,"*","id='".$CustomerBranchID."'");
				if($BranchInformation)
				{
					$BranchInformation=mysqli_fetch_assoc($BranchInformation);
					$BranchPriceListDetail=$this->db->rp_getData($this->CtablePriceList,"*","id='".$BranchInformation['price_list']."'","",0);
					if($BranchPriceListDetail)
					{
						$CartSubtotal=0;
						$CartVatTax=0;
						$CartOtherTax=0;
						$CartDiscount=0;
						$CartGrandTotal=0;
						
						$CartItems=$this->rp_getData($this->CtableCartItems,"*","cart_id='".$CartID."'");
						if(!empty($Items))
						{
							foreach($Items as $Item)
							{
								$CartItemID = $Item['id'];
								$Qty = $Item['qty'];
								$ProductID= $Item['pid'];
								
								
								$ProductDetail =$this->aj_getProductDetail($CustomerBranchID,"","",array(),$ProductID);
								$ProductDetail=$ProductDetail[0];
								if(!empty($ProductDetail))
								{
									
									$BranchPriceListDetail=mysqli_fetch_assoc($BranchPriceListDetail);
									$VATTax=$this->rp_getValue($this->CtableTax,"tax_value","id='".$ProductDetail['vat_tax']."'");
									$VATTaxName=$this->rp_getValue($this->CtableTax,"tax_name","id='".$ProductDetail['vat_tax']."'");
									$VATTaxName=($VATTaxName!="")?$VATTaxName:"";
									$VATTax=($VATTax!="")?floatval($VATTax):0;
									$OtherTax=($ProductDetail['other_tax']!="")?floatval($ProductDetail['other_tax']):0;
									$PriceInPriceList=$this->db->rp_getValue($this->CtablePriceListProducts,"price","product_id='".$ProductID."' AND price_list_id='".$BranchPriceListDetail['id']."'",0);
									if($PriceInPriceList=="")
									{
										$PriceInPriceList=$ProductDetail['selling_price'];

									}
										$CartItem=$this->rp_getData($this->CtableCartItems,"id","cart_id='".$CartID."' AND id='".$CartItemID."'","",0);
										if($CartItem)
										{
											$VATTaxAmount=($PriceInPriceList*$VATTax)/100;
											$OtherTaxAmount=($PriceInPriceList*$OtherTax)/100;
											$CartItem=mysqli_fetch_assoc($CartItem);
											$NewCartItem['cart_id']=$CartID;
											$NewCartItem['order_item_id']=$ProductDetail['id'];
											$NewCartItem['order_item_name']=$ProductDetail['product_name'];
											$NewCartItem['order_item_code']=$ProductDetail['product_code'];
											$NewCartItem['order_item_qty']=$Qty;
											$NewCartItem['original_qty']=$Qty;
											$NewCartItem['order_item_remaining_qty']=$Qty;
											$NewCartItem['status']=0;
											$NewCartItem['vat_tax_name']=$VATTaxName;
											$NewCartItem['order_item_selling_price']=$ProductDetail['selling_price'];
											$NewCartItem['order_item_orignal_price']=$ProductDetail['selling_price'];
											$NewCartItem['order_item_sub_total']=$Qty*$NewCartItem['order_item_selling_price'];
											$NewCartItem['order_item_discount']=$CustomerDetail['discount'];
											$NewCartItem['order_item_discount_amount']=($NewCartItem['order_item_sub_total']*$CustomerDetail['discount'])/100;
											$NewCartItem['tax']=$VATTax;
											$NewCartItem['tax_amount']=($NewCartItem['order_item_selling_price']*$VATTax)/100;
											$NewCartItem['other_tax']=$OtherTax;
											$NewCartItem['other_tax_amount']=($NewCartItem['order_item_selling_price']*$OtherTax)/100;
											$NewCartItem['order_item_grand_total']=$NewCartItem['order_item_sub_total'];//-$NewCartItem['order_item_discount_amount']+$NewCartItem['tax_amount']+$NewCartItem['other_tax_amount']
											$CartItemID=$this->rp_update($this->CtableCartItems,$NewCartItem,"id='".$CartItemID."'",0);	

											$CartSubtotal+=$NewCartItem['order_item_sub_total'];
											$CartDiscount+=$NewCartItem['order_item_discount_amount'];
											$CartVatTax+=$NewCartItem['tax_amount'];
											$CartOtherTax+=$NewCartItem['other_tax_amount'];
											$CartGrandTotal+=$NewCartItem['order_item_grand_total'];											
										}
											
																		
								}
								else
								{
									// Remove Item Because It Removed From Master
									$this->rp_delete($this->CtableCartItem,"id='".$CartItemID."'");
								}
									
								
							}
							
							$this->UpdateCartPricing($CartID,$CustomerID,$CustomerBranchID);									
						}
						else
						{
							// Remove Cart No Cart Item FOUND
							$this->rp_delete($this->CtableCartDetails,"cart_id='".$CartID."'");
							$this->rp_delete($this->CtableCartItem,"cart_id='".$CartID."'");
						}						
					}
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('CUSTOMER_BRANCH_NOT_HAVING_PRICE_LIST',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_BRANCH_NOT_HAVING_PRICE_LIST'));
						return $reply;
					}
					
					$CartDetails['cid']=$CustomerID;
					$CartDetails['cbid']=$CustomerBranchID;
					$CartDetails['customer_name']=$BranchInformation['branch_name'];
					$CartDetails['customer_phone']=$BranchInformation['phone'];
					$CartDetails['customer_email']=$BranchInformation['email'];
					$CartDetails['customer_city']=$BranchInformation['city'];
					$CartDetails['customer_country']=$BranchInformation['country'];
					$CartDetails['customer_address']=$BranchInformation['address'];
					$CartDetails['customer_pincode']=$BranchInformation['pincode'];
					$CartDetails['subtotal']=$CartSubtotal;
					$CartDetails['discount_amount']=$CartDiscount;
					$CartDetails['other_tax_amount']=$CartOtherTax;
					$CartDetails['tax_amount']=$CartVatTax;
					$CartDetails['finaltotal']=$CartGrandTotal;
					$this->rp_update($this->CtableCartDetails,$CartDetails,"id='".$CartID."'");	
					
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('CUSTOMER_NOT_FOUND',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_NOT_FOUND'));
						return $reply;
				}
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('CUSTOMER_NOT_FOUND',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_NOT_FOUND'));
					return $reply;
			}
			
			
			$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('CART_UPDATED',1),"ack_msg"=>$this->log->getMessage('CART_UPDATED'));
			return $reply;
			
		
	}
	function UpdateCartPricing($CartID,$CustomerID,$CustomerBranchID)
	{
		$CustomerDetail=$this->rp_getData($this->CtableCustomer,"*","id='".$CustomerID."'");
		if($CustomerDetail)
		{
			$CustomerDetail=mysqli_fetch_assoc($CustomerDetail);
			$BranchInformation=$this->rp_getData($this->CtableCustomerBranch,"*","id='".$CustomerBranchID."'");
			if($BranchInformation)
			{
				$BranchInformation=mysqli_fetch_assoc($BranchInformation);
				$CartSubtotal=0;
				$CartVatTax=0;
				$CartOtherTax=0;
				$CartDiscount=0;
				$CartGrandTotal=0;
				
				$CartItems=$this->rp_getData($this->CtableCartItems,"*","cart_id='".$CartID."'","",0);
				if($CartItems)
				{
					while($CartItem=mysqli_fetch_assoc($CartItems))
					{
						$CartSubtotal+=$CartItem['order_item_sub_total'];
						$CartDiscount+=$CartItem['order_item_discount_amount'];
						$CartVatTax+=$CartItem['tax_amount'];
						$CartOtherTax+=$CartItem['other_tax_amount'];
						$CartGrandTotal+=$CartItem['order_item_grand_total'];
					}
				}
				
				$CartDetails['cid']=$CustomerID;
				$CartDetails['cbid']=$CustomerBranchID;
				$CartDetails['customer_name']=$BranchInformation['branch_name'];
				$CartDetails['customer_phone']=$BranchInformation['phone'];
				$CartDetails['customer_email']=$BranchInformation['email'];
				$CartDetails['customer_city']=$BranchInformation['city'];
				$CartDetails['customer_country']=$BranchInformation['country'];
				$CartDetails['customer_address']=$BranchInformation['address'];
				$CartDetails['customer_pincode']=$BranchInformation['pincode'];
				$CartDetails['subtotal']=$CartSubtotal;
				$CartDetails['discount_amount']=$CartDiscount;
				$CartDetails['other_tax_amount']=$CartOtherTax;
				$CartDetails['tax_amount']=$CartVatTax;
				$CartDetails['finaltotal']=$CartGrandTotal-$CartDiscount;
				$this->rp_update($this->CtableCartDetails,$CartDetails,"cart_id='".$CartID."'",0);	
				
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('CUSTOMER_NOT_FOUND',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_NOT_FOUND'));
					return $reply;
			}
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('CUSTOMER_NOT_FOUND',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_NOT_FOUND'));
				return $reply;
		}
		
		
		$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('CART_UPDATED',1),"ack_msg"=>$this->log->getMessage('CART_UPDATED'));
		return $reply;
	}
		
}
//include("notification.class.php");
//include("ccavenue.class.php");
/*
	*** Cart Function Developed By Ravi Patel :) <<<
*/
?>