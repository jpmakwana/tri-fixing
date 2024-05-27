<?php
session_start();
error_reporting(0);
date_default_timezone_set('Asia/Kolkata');
require_once("./include/define.php");
require_once("./include/function.class.php");
require_once("./include/class.log.php");
require_once("./include/class.system.php");
require_once("./include/class.media.php");
$db = new Admin();
//$db = new Functions();
$db_con = $db->conn;
$system = new System();
$conn = $db->connect();
include("../include/security.php");
define("SITEURL","http://192.168.1.11/tri-fixing/");
?>