<?php
/*----------------------dash Title SALES Array Starts----------------------*/
$dash_head_sales_array = array(
				0=>array("Inquiry","Inquiry","inquiry_manage.php",515),
				1=>array("Quotation","Manage Quotation","quotation_manage.php",526),
				2=>array("Orders","Manage Orders","orders_manage.php",526),
			);
$dash_sales_array = array(
				0=>$dash_head_sales_array[0],
);

$final_prepared_dashboard=array("SALES"=>array("department_id"=>22,"sub_department"=>$dash_sales_array),
							);
?>