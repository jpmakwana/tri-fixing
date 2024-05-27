<?php
$GLOBALS['PANEL_TYPE']='CUSTOMER';
if((!isset($_SESSION[SITE_SESS.'_CUSTOMER_SESS_ID']) && $_SESSION[SITE_SESS.'_CUSTOMER_SESS_ID']=="")){
	$from 	= explode("/",$_SERVER['REQUEST_URI']);
	$from1 	= urlencode(end($from));
	$db->rp_location("index.php?from=".$from1);
}
else
{	
	$rights=$_SESSION['rights']=array("insert_flag"=>1,"view_flag"=>1,"update_flag"=>1,"delete_flag"=>1);
		
}

?>