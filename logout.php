<?php
include("connect.php");
// Include your database connection code here

if(isset($_SESSION['USER_ID'])){
	unset($_SESSION['USER_ID']);
}

$db->rp_location(SITEURL);
?>