<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "tri_fixing";
$con     = false;

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die('Could not connect:');
if (!$conn) {
    die('Could not connect:');
}

define("SITEURL","http://192.168.1.29/tri-fixing/");
define("CATEGORY_IMAGE_PATH", "images/category/");
define("BRAND_IMAGE_PATH", "images/brand/");
define("MODAL_IMAGE_PATH", "images/modal/");
define("PROBLEM_IMAGE_PATH", "images/problem_image/");
define("USER_ORDER_PDF_PATH", "pdf/user_invoice/");
define("JOB_IMAGE_PATH", "images/job_image/");
define("JOB_VIDEO_PATH", "images/job_video/");
define("SERVICE_IMAGE_PATH", "images/service_image/");
define("SERVICE_VIDEO_PATH", "images/service_video/");
define("POST_IMAGE_PATH", "images/post_image/");
define("POST_VIDEO_PATH", "images/post_video/");
define("USER_IMAGE_PATH", "images/user/");
define("VENDOR_IMAGE_PATH", "images/vendor/");
define("CHAT_IMAGE_PATH", "images/chat_image/");
define("CHAT_AUDIO_PATH", "images/chat_audio/");
define("GALLERY_IMAGE_PATH", "images/gallery/");