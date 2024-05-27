<?php
/*
	>>> All Array's Parameter Description By Ravi Patel :) <<<
	
		*** Main Array Parameter Details
			-> 1 = left array [i]th element i.e. left_head_array[0]
		
		*** Left Title Array Parameter Details
			-> 0 = Title
			-> 1 = Main page name i.e. use $main_page variable value define on each page
			-> 2 = left_pages_array array(i) element i.e. left_pages_array0
		
		*** Pages Array Parameter Details
			-> 0 = Title
			-> 1 = Page name i.e. use page variable value define on each page
			-> 2 = Page URL
		
*/
/*-----------------------Customer Pages Arrays Starts-----------------------------*/
$left_pages_array0 = array(
						"1"=>array("Manage Customer","customer_manage","customer_manage.php",420),
					);


/*---------------------- Customer Left Title Array Starts----------------------*/

$left_head_array = array(
				0=>array("Customer","Customer",array(),420,'customer_manage.php'),
				
				
				
				
				
			);
/*----------------------Customer Main Array Starts-------------------------*/
$left_main_array = array(
				0=>$left_head_array[0],					
						
				
								
			);
/*----------------------Customer Main Array Ends-----------------------------*/

/*-----------------------Inventory Pages Arrays Starts-----------------------------*/
$left_page_inventory_array0 = array(
						"1"=>array("Manage inventory_manage","inventory_manage","inventory_manage.php",407),
					);


/*---------------------- Inventory Left Title Array Starts----------------------*/

$left_head_inventory_array = array(
				0=>array("Inventory","Inventory",array(),407,'inventory_manage.php'),
				
				
				
				
				
			);
/*----------------------Inventory Main Array Starts-------------------------*/
$left_main_inventory_array = array(
				0=>$left_head_inventory_array[0],					
						
				
								
			);
/*----------------------Page Inventory Main Array Ends-----------------------------*/



/*-----------------------Page Purchase Arrays Starts-----------------------------*/

$left_page_purchase_array0 = array(
						"1"=>array("Purchase","purchase","purchase_order_manage.php",407),
					);



/*----------------------Left Title Array Starts----------------------*/
$left_head_purchase_array = array(
				0=>array("Purchase","purchase",$left_page_purchase_array0,407),
				
				
			);

/*----------------------Main Array Starts-------------------------*/
$left_main_purchase_array = array(
				0=>$left_head_purchase_array[0],
				
											
			);
/*----------------------Purchase Main Array Ends-----------------------------*/

/*-----------------------Page Delivery Arrays Starts-----------------------------*/

$left_page_delivery_array0 = array(
						"1"=>array("Delivery","dispatch_manage","dispatch_manage.php",408),
					);


/*----------------------Delivery Left Title Array Starts----------------------*/
$left_head_delivery_array = array(
				0=>array("Delivery","dispatch_manage",$left_page_delivery_array0,408),
				
				
			);
/*----------------------Delivery Main Array Starts-------------------------*/
$left_main_delivery_array = array(
				0=>$left_head_delivery_array[0],
				
				
							
			);
/*----------------------Delivery Main Array Ends-----------------------------*/

/*----------------------hr Main Array Ends-----------------------------*/



/*-----------------------Page Order Arrays Starts-----------------------------*/

$left_page_order_array0 = array(
						"1"=>array("Orders","order_manage","orders_manage.php",414),
					);
				


/*----------------------Order Left Title Array Starts----------------------*/
$left_head_order_array = array(
				0=>array("Orders","order_manage",$left_page_order_array0,414),
				
				
				
			);
/*----------------------Order Main Array Starts-------------------------*/
$left_main_order_array = array(
				0=>$left_head_order_array[0],
			
				
							
			);
/*-----------------------Main Order Array End-----------------------------*/

/*-----------------------Page Account Arrays Starts-----------------------------*/


$left_page_account_array0 = array(
						"1"=>array("Account","Account","account_report_manage.php",426),
);

/*----------------------Account Left Title Array Starts----------------------*/
$left_head_account_array = array(
				0=>array("Account","Account",$left_page_account_array0,456),				
				
			);
/*----------------------Account Main Array Starts-------------------------*/
$left_main_account_array = array(
				0=>$left_head_account_array[0],
				
							
			);
/*----------------------Account Main Array Ends-----------------------------*/

/*-----------------------Page vehicals Arrays Starts-----------------------------*/


$left_page_vehicals_array0 = array(
						"1"=>array("Vehicals","Vehicals","vehical_manage.php",423),
);

/*----------------------vehicals Left Title Array Starts----------------------*/
$left_head_vehicals_array = array(
				0=>array("Vehicals","Vehicals",$left_page_vehicals_array0,423),	
			);

/*----------------------vehicals Main Array Starts-------------------------*/
$left_main_vehicals_array = array(
				0=>$left_head_vehicals_array[0],
		);
/*----------------------vehicals Main Array Ends-----------------------------*/

/*-----------------------Page HR Arrays Starts-----------------------------*/

$left_page_hr_array0 = array(
						"1"=>array("Employeess","employee_manage","employee_manage.php",409),
					);

/*----------------------HR Left Title Array Starts----------------------*/
$left_head_hr_array = array(
				0=>array("Employee","employee_manage",$left_page_hr_array0,409),
				
			);
/*----------------------HR Main Array Starts-------------------------*/
$left_main_hr_array = array(
				0=>$left_head_hr_array[0],
				
							
			);

/*----------------------HR Main Array End-------------------------*/
?>