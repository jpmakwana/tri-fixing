<?php
/*
** >>> dashboard_main_array Parameter Description By Ravi Patel :) <<<
		-> 1 = color of box
		-> 2 = table name
		-> 3 = where condition for filtered record i.e 1=1
		-> 4 = Title of box
		-> 5 = URL 
*/
$dashboard_main_array = array(
    
    	
		0=>array("green",$db->rp_getTotalRecord("category","isDelete=0"),"","category_manage.php",424),
		1=>array("green",$db->rp_getTotalRecord("sub_category","isDelete=0"),"","sub_category_manage.php",486),
		2=>array("green",$db->rp_getTotalRecord("sub_sub_category","isDelete=0"),"","sub_sub_category_manage.php",487),
		3=>array("green",$db->rp_getTotalRecord("product","isDelete=0"),"","product_manage.php",443),
		4=>array("green",$db->rp_getTotalRecord("banner","isDelete=0"),"","banner_manage.php",481),
		5=>array("green",$db->rp_getTotalRecord("catalog","isDelete=0"),"","catalog_manage.php",488),
		6=>array("green",$db->rp_getTotalRecord("inquiry","isDelete=0"),"","inquiry_manage.php",477),
	/*	1=>array("green",$db->rp_getTotalRecord("item_fg","isDelete=0"),"Pending","pending_manage.php",433),
		0=>array("green",$db->rp_getTotalRecord("order_detail","isDelete=0"),"Order(s)","orders_manage.php",414),
		2=>array("green",$db->rp_getTotalRecord("dispatch_info","isDelete=0"),"Dispatch(s)","dispatch_manage.php",408),*/
	);
	
	
?>