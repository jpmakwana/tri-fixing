<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods', 'GET,POST,PUT,PATCH,DELETE');
header('Accept: application/json');
header("Content-Type: application/json");
error_reporting(0);
include "connect_api.php";
include "common.php";
include('notification.php');
$notification_obj = new Notification();
$common_obj = new Common();

if ($_REQUEST['service'] == "login") {
    $user_details = [];
    $user_q = mysqli_query($conn, "select * from user where isDelete=0 And phone = '" . $_REQUEST['phone'] . "' or email = '" . $_REQUEST['email'] . "' AND isActive=1");
    if ($_REQUEST["phone"] != "" or $_REQUEST["email"] != "") {
        if (mysqli_fetch_row($user_q) > 0) {
            $user_d = mysqli_query($conn, "select * from user where phone = '" . $_REQUEST['phone'] . "' or email = '" . $_REQUEST['email'] . "' and isDelete=0 and isActive=1");
            $user_r =  mysqli_fetch_assoc($user_d);
            $user_details = $user_r;
            if ($user_r['password'] == (md5($_REQUEST['password']))) {
                $ack = array("ack" => 1, "ack_msg" => 'Login Successfully !', "user" => $user_details);
            } else {
                $ack = array("ack" => 0, "ack_msg" => 'You have entered an invalid password');
            }
        } else {
            $ack = array("ack" => 0, "ack_msg" => 'No User Found');
        }
    } else {
        $ack = ["ack" => 0, "ack_msg" => "some perameters misssing"];
    }
} elseif ($_REQUEST['service'] == "user_token") {
    $vendor_q = mysqli_query($conn, "select * from user where id = '" . $_REQUEST['user_id'] . "' and isDelete=0 and isActive=1");
    if (mysqli_fetch_row($vendor_q) > 0) {
        $q =    mysqli_query($conn, "UPDATE user set device_token = '" . $_REQUEST['device_token'] . "',device_type = '" . $_REQUEST["device_type"] . "' where id = '" . $_REQUEST['user_id'] . "' and isDelete=0 and isActive=1");
        if ($q) {
            $ack = array("ack" => 1, "ack_msg" => 'User token Successfully !');
        } else {
            $ack = array("ack" => 0, "ack_msg" => 'Something went wrong please try again !!');
        }
    } else {
        $ack = array("ack" => 0, "ack_msg" => 'No Vendor Found');
    }
} elseif ($_REQUEST['service'] == "user_register") {
    $user_q = mysqli_query($conn, "select * from user where phone = '" . $_REQUEST['phone'] . "' OR email = '" . $_REQUEST['email'] . "' and isDelete=0 and isActive=1");
    if ($_REQUEST["phone"] != "") {
        if (mysqli_fetch_row($user_q) <= 0) {
            $q = mysqli_query($conn, "insert into user(email, user_name, phone, password ,created_date)values('" . $_REQUEST['email'] . "','" . $_REQUEST['user_name'] . "','" . $_REQUEST['phone'] . "','" . md5($_REQUEST['password']) . "','" . date('Y-m-d H:i:s') . "')");
            if ($q) {
                $user_id = mysqli_insert_id($conn);
                $user_d = mysqli_query($conn, "select * from user where id = '" . $user_id . "' and isDelete=0 and isActive=1");
                while ($user_r = mysqli_fetch_assoc($user_d)) {
                    if ($user_r["image_path"] != "" && file_exists(PROBLEM_IMAGE_PATH . $user_r["image_path"])) {
                        $user_r["image_path"] = SITEURL . PROBLEM_IMAGE_PATH . $user_r["image_path"];
                    } else {
                        $user_r["image_path"] = "";
                    }
                    $user_details = $user_r;
                }
                $ack = array('ack' => 1, 'ack_msg' => 'You have registered successfully.', "user" => $user_details);
            } else {
                $ack = array("ack" => 0, "ack_msg" => 'something went to wrong');
            }
        } else {
            $ack = array("ack" => 0, "ack_msg" => 'Already exists an account registered.');
        }
    } else {
        $ack = ["ack" => 0, "ack_msg" => "some perameters misssing"];
    }
} elseif ($_REQUEST["service"] == "user_profile") {
    $user_rs = [];
    if ($_REQUEST["id"] != "") {
        $where = " where id = '" . $_REQUEST["id"] . "' and isDelete=0 and isActive=1 ";
        $user_d = mysqli_query($conn, "select * from user" . $where);
        $user_r = mysqli_fetch_assoc($user_d);
        $user_rs = $user_r;
        if ($user_r) {
            $ack = ["ack" => 1, "ack_msg" => "user profile fetch successfully", "user" => $user_rs];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No user found"];
        }
    } else {
        $ack = ["ack" => 0, "ack_msg" => "some perameters misssing"];
    }
} elseif ($_REQUEST["service"] == "user_profile_update") {
    $user_rs = [];
    if ($_REQUEST["id"] != "") {
        $user_q = mysqli_query($conn, "select * from user where id = '" . $_REQUEST["id"] . "' and isDelete=0 and isActive=1");
        $user_r = mysqli_fetch_assoc($user_q);
        if ($user_r) {
            if (isset($_FILES["image_path"]) && $_FILES["image_path"]["size"] != 0) {
                $allowedExts = ["jpg", "jpeg", "png", "gif", "JPG", "JPEG"];
                $temp = explode(".", $_FILES["image_path"]["name"]);
                $extension = end($temp);
                if ($_FILES["image_path"]["type"] !== "application/x-msdownload") {
                    if (in_array($extension, $allowedExts)) {
                        $fileName = $_FILES["image_path"]["name"];
                        $fileSize = round($_FILES["image_path"]["size"]); // BYTES
                        $extension = end(explode(".", $fileName));
                        $fileName = "user_image_" . substr(sha1(time()), 0, 6) . "." . $extension;
                        $filePath = "images/user/" . $fileName;
                        if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $filePath)) {
                            $image = $fileName;
                        }
                    }
                }
            }
            $q = mysqli_query($conn, "UPDATE user set user_name = '" . $_REQUEST["user_name"] . "',email = '" . $_REQUEST["email"] . "',phone = '" . $_REQUEST["phone"] . "',image_path = '" . $image . "' where id = '" . $_REQUEST["id"] . "' and isDelete=0 and isActive=1");
            if ($q) {
                $where = " where id = '" . $_REQUEST["id"] . "' and isDelete=0 and isActive=1";
                $user_d1 = mysqli_query($conn, "select * from user" . $where);
                $user_r1 = mysqli_fetch_assoc($user_d1);
                if ($user_r1["image_path"] != "" && file_exists(USER_IMAGE_PATH . $user_r1["image_path"])) {
                    $user_r1["image_path"] = SITEURL . USER_IMAGE_PATH . $user_r1["image_path"];
                }
                $user_rs = $user_r1;
                $ack = ["ack" => 1, "ack_msg" => "User Updated successfully", "user" => $user_rs,];
            } else {
                $ack = ["ack" => 0, "ack_msg" => "something went wrong"];
            }
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No user(s) found"];
        }
    } else {
        $ack = ["ack" => 0, "ack_msg" => "some perameters misssing"];
    }
} elseif ($_REQUEST["service"] == "user_profile_remove") {
    if ($_REQUEST["id"] != "") {
        $where = " where id = " . $_REQUEST["id"];
        $user_d = mysqli_query($conn, "select * from user" . $where);
        $user_r = mysqli_fetch_assoc($user_d);
        if ($user_r) {
            $q = mysqli_query($conn, "UPDATE user set isDelete =1  where id = '" . $_REQUEST["id"] . "' and isDelete=0 and isActive=1");
            $ack = ["ack" => 1, "ack_msg" => "User remove successfully"];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No user(s) found"];
        }
    } else {
        $ack = ["ack" => 0, "ack_msg" => "some perameters misssing"];
    }
} elseif ($_REQUEST["service"] == "vendor_login") {
    $vendor_details = [];
    $vendor_q = mysqli_query($conn, "select * from vendor where phone = '" . $_REQUEST['phone'] . "' and isDelete=0 and isActive=1");
    if ($_REQUEST["phone"] != "") {
        if (mysqli_fetch_row($vendor_q) > 0) {
            $vendor_d = mysqli_query($conn, "select * from vendor where phone = '" . $_REQUEST['phone'] . "' and isDelete=0 and isActive=1");
            $vendor_r =  mysqli_fetch_assoc($vendor_d);
            $vendor_details = $vendor_r;
            if ($vendor_r['password'] == (md5($_REQUEST['password']))) {
                $ack = array("ack" => 1, "ack_msg" => 'Vendor Login Successfully !', "vendor" => $vendor_details);
            } else {
                $ack = array("ack" => 0, "ack_msg" => 'You have entered an invalid password');
            }
        } else {
            $ack = array("ack" => 0, "ack_msg" => 'No vendor Found');
        }
    } else {
        $ack = ["ack" => 0, "ack_msg" => "some perameters misssing"];
    }
} elseif ($_REQUEST['service'] == "vendor_token") {
    $vendor_q = mysqli_query($conn, "select * from vendor where id = '" . $_REQUEST['vendor_id'] . "' and isDelete=0 and isActive=1");

    if (mysqli_fetch_row($vendor_q) > 0) {
        $q =    mysqli_query($conn, "UPDATE vendor set device_token = '" . $_REQUEST['device_token'] . "',device_type = '" . $_REQUEST["device_type"] . "' where id = '" . $_REQUEST['vendor_id'] . "' and isDelete=0 and isActive=1");
        if ($q) {
            $ack = array("ack" => 1, "ack_msg" => 'Vendor token Successfully !');
        } else {
            $ack = array("ack" => 0, "ack_msg" => 'Something went wrong please try again !!');
        }
    } else {
        $ack = array("ack" => 0, "ack_msg" => 'No Vendor Found');
    }
} elseif ($_REQUEST['service'] == "vendor_register") {
    $vendor_q = mysqli_query($conn, "select * from vendor where phone = '" . $_REQUEST['phone'] . "' OR email = '" . $_REQUEST['email'] . "' and isDelete=0 and isActive=1");
    if ($_REQUEST["phone"] != "") {
        if (mysqli_fetch_row($vendor_q) <= 0) {
            $q = mysqli_query($conn, "insert into vendor(email, vendor_name, phone, password,address, latitude, longitude, created_date)values('" . $_REQUEST['email'] . "','" . $_REQUEST['vendor_name'] . "','" . $_REQUEST['phone'] . "','" . md5($_REQUEST['password']) . "','" . $_REQUEST['address'] . "','" . $_REQUEST['latitude'] . "','" . $_REQUEST['longitude'] . "','" . date('Y-m-d H:i:s') . "')");
            if ($q) {
                $vendor_id = mysqli_insert_id($conn);

                $vendor_d = mysqli_query($conn, "select * from vendor where id = '" . $vendor_id . "' and isDelete=0 and isActive=1");
                while ($vendor_r = mysqli_fetch_assoc($vendor_d)) {
                    if ($vendor_r["image_path"] != "" && file_exists(PROBLEM_IMAGE_PATH . $vendor_r["image_path"])) {
                        $vendor_r["image_path"] = SITEURL . PROBLEM_IMAGE_PATH . $vendor_r["image_path"];
                    } else {
                        $vendor_r["image_path"] = "";
                    }
                    $vendor_details = $vendor_r;
                }

                $ack = array('ack' => 1, 'ack_msg' => 'You have vendor registered successfully.', "vendor" => $vendor_details);
            } else {
                $ack = array("ack" => 0, "ack_msg" => 'something went to wrong');
            }
        } else {
            $ack = array("ack" => 0, "ack_msg" => 'Already exists an account registered with this phone number.');
        }
    } else {
        $ack = ["ack" => 0, "ack_msg" => "some perameters misssing"];
    }
} elseif ($_REQUEST["service"] == "vendor_profile") {
    $vendor_rs = [];
    if ($_REQUEST["id"] != "") {
        $where = " where id = '" . $_REQUEST["id"] . "' and isDelete=0 and isActive=1 ";
        $vendor_d = mysqli_query($conn, "select * from vendor" . $where);
        $vendor_r = mysqli_fetch_assoc($vendor_d);
        $vendor_rs = $vendor_r;
        if ($vendor_r) {
            $ack = ["ack" => 1, "ack_msg" => "vendor profile fetch successfully", "vendor" => $vendor_rs];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No vendor found"];
        }
    } else {
        $ack = ["ack" => 0, "ack_msg" => "some perameters misssing"];
    }
} elseif ($_REQUEST["service"] == "vendor_profile_update") {
    $vendor_rs = [];
    if ($_REQUEST["id"] != "") {
        $vendor_q = mysqli_query($conn, "select * from vendor where id = '" . $_REQUEST["id"] . "' and isDelete=0 and isActive=1");
        $vendor_r = mysqli_fetch_assoc($vendor_q);
        if ($vendor_r) {
            if (isset($_FILES["image_path"]) && $_FILES["image_path"]["size"] != 0) {
                $allowedExts = ["jpg", "jpeg", "png", "gif", "JPG", "JPEG"];
                $temp = explode(".", $_FILES["image_path"]["name"]);
                $extension = end($temp);
                if ($_FILES["image_path"]["type"] !== "application/x-msdownload") {
                    if (in_array($extension, $allowedExts)) {
                        $fileName = $_FILES["image_path"]["name"];
                        $fileSize = round($_FILES["image_path"]["size"]); // BYTES
                        $extension = end(explode(".", $fileName));
                        $fileName = "vendor_image_" . substr(sha1(time()), 0, 6) . "." . $extension;
                        $filePath = "images/vendor/" . $fileName;
                        if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $filePath)) {
                            $image = $fileName;
                        }
                    }
                }
            }
            $q = mysqli_query($conn, "UPDATE vendor set vendor_name = '" . $_REQUEST["vendor_name"] . "',email = '" . $_REQUEST["email"] . "',phone = '" . $_REQUEST["phone"] . "',shop_name = '" . $_REQUEST['shop_name'] . "',address = '" . $_REQUEST['address'] . "',zipcode = '" . $_REQUEST['zipcode'] . "',latitude = '" . $_REQUEST['latitude'] . "',longitude = '" . $_REQUEST['longitude'] . "',mon_fri_opentime = '" . $_REQUEST['mon_fri_opentime'] . "',mon_fri_closetime = '" . $_REQUEST['mon_fri_closetime'] . "',satur_opentime = '" . $_REQUEST['satur_opentime'] . "',satur_closetime = '" . $_REQUEST['satur_closetime'] . "',sun_opentime = '" . $_REQUEST['sun_opentime'] . "',	sun_closetime = '" . $_REQUEST['sun_closetime'] . "',image_path = '" . $image . "' where id = '" . $_REQUEST["id"] . "' and isDelete=0 and isActive=1");
            if ($q) {
                $where = " where id = '" . $_REQUEST["id"] . "' and isDelete=0 and isActive=1";
                $vendor_d1 = mysqli_query($conn, "select * from vendor" . $where);
                $vendor_r1 = mysqli_fetch_assoc($vendor_d1);
                if ($vendor_r1["image_path"] != "" && file_exists(VENDOR_IMAGE_PATH . $vendor_r1["image_path"])) {
                    $vendor_r1["image_path"] = SITEURL . VENDOR_IMAGE_PATH . $vendor_r1["image_path"];
                }
                $vendor_rs = $vendor_r1;
                $ack = ["ack" => 1, "ack_msg" => "Vendor Updated successfully", "vendor" => $vendor_rs,];
            } else {
                $ack = ["ack" => 0, "ack_msg" => "something went wrong"];
            }
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No Vendor(s) found"];
        }
    } else {
        $ack = ["ack" => 0, "ack_msg" => "some perameters misssing"];
    }
} elseif ($_REQUEST["service"] == "vendor_profile_remove") {
    if ($_REQUEST["id"] != "") {
        $where = " where id = " . $_REQUEST["id"];
        $vendor_d = mysqli_query($conn, "select * from vendor" . $where);
        $vendor_r = mysqli_fetch_assoc($vendor_d);
        if ($vendor_r) {
            $q = mysqli_query($conn, "UPDATE vendor set isDelete =1  where id = '" . $_REQUEST["id"] . "' and isDelete=0 and isActive=1");
            $ack = ["ack" => 1, "ack_msg" => "vendor remove successfully"];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No vendor(s) found"];
        }
    } else {
        $ack = ["ack" => 0, "ack_msg" => "some perameters misssing"];
    }
} elseif ($_REQUEST["service"] == "category") {
    $cat_rs = [];
    $cat_q = mysqli_query($conn, "select * from category where isDelete=0 and isActive=1 ");
    if ($cat_q) {
        while ($cat_r = mysqli_fetch_assoc($cat_q)) {
            if ($cat_r["image_path"] != "" && file_exists(CATEGORY_IMAGE_PATH . $cat_r["image_path"])) {
                $cat_r["image_path"] = SITEURL . CATEGORY_IMAGE_PATH . $cat_r["image_path"];
            } else {
                $cat_r["image_path"] = "";
            }
            $cat_rs[] = $cat_r;
        }
        $ack = ["ack" => 1, "ack_msg" => "category fetched successfully!!", "category" => $cat_rs,];
    } else {
        $ack = ["ack" => 0, "ack_msg" => "No category found"];
    }
} elseif ($_REQUEST["service"] == "brand") {
    $brand_rs = [];
    if ($_REQUEST["category_id"] != "") {
        $brand_q = mysqli_query($conn, "select * from brand where category_id = '" . $_REQUEST["category_id"] . "' and isDelete=0 and isActive=1 ");
        $brand_row = mysqli_num_rows($brand_q);
        if ($brand_row > 0) {
            while ($brand_r = mysqli_fetch_assoc($brand_q)) {
                if ($brand_r["image_path"] != "" && file_exists(BRAND_IMAGE_PATH . $brand_r["image_path"])) {
                    $brand_r["image_path"] = SITEURL . BRAND_IMAGE_PATH . $brand_r["image_path"];
                } else {
                    $brand_r["image_path"] = "";
                }
                $brand_rs[] = $brand_r;
            }
            $ack = ["ack" => 1, "ack_msg" => "brand fetched successfully!!", "brand" => $brand_rs,];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No brand found"];
        }
    } else {
        $brand_q = mysqli_query($conn, "select * from brand where isDelete=0 and isActive=1 ");
        $brand_row = mysqli_num_rows($brand_q);
        if ($brand_row > 0) {
            while ($brand_r = mysqli_fetch_assoc($brand_q)) {
                if ($brand_r["image_path"] != "" && file_exists(BRAND_IMAGE_PATH . $brand_r["image_path"])) {
                    $brand_r["image_path"] = SITEURL . BRAND_IMAGE_PATH . $brand_r["image_path"];
                } else {
                    $brand_r["image_path"] = "";
                }
                $brand_rs[] = $brand_r;
            }
            $ack = ["ack" => 1, "ack_msg" => "brand fetched successfully!!", "brand" => $brand_rs,];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No brand found"];
        }
    }
} elseif ($_REQUEST["service"] == "modal") {
    $modal_rs = [];
    if ($_REQUEST["brand_id"] != "") {
        $modal_q = mysqli_query($conn, "select * from modal where brand_id = '" . $_REQUEST["brand_id"] . "' and isDelete=0 and isActive=1 ");
        $modal_row = mysqli_num_rows($modal_q);
        if ($modal_row > 0) {
            while ($modal_r = mysqli_fetch_assoc($modal_q)) {
                if ($modal_r["image_path"] != "" && file_exists(MODAL_IMAGE_PATH . $modal_r["image_path"])) {
                    $modal_r["image_path"] = SITEURL . MODAL_IMAGE_PATH . $modal_r["image_path"];
                } else {
                    $modal_r["image_path"] = "";
                }
                $modal_rs[] = $modal_r;
            }
            $ack = ["ack" => 1, "ack_msg" => "modal fetched successfully!!", "modal" => $modal_rs,];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No modal found"];
        }
    } else {
        $modal_q = mysqli_query($conn, "select * from modal where isDelete=0 and isActive=1 ");
        $modal_row = mysqli_num_rows($modal_q);
        if ($modal_row > 0) {
            while ($modal_r = mysqli_fetch_assoc($modal_q)) {
                if ($modal_r["image_path"] != "" && file_exists(MODAL_IMAGE_PATH . $modal_r["image_path"])) {
                    $modal_r["image_path"] = SITEURL . MODAL_IMAGE_PATH . $modal_r["image_path"];
                } else {
                    $modal_r["image_path"] = "";
                }
                $modal_rs[] = $modal_r;
            }
            $ack = ["ack" => 1, "ack_msg" => "modal fetched successfully!!", "modal" => $modal_rs,];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No modal found"];
        }
    }
} elseif ($_REQUEST["service"] == "device_problem") {
    $device_problem_rs = [];
    if ($_REQUEST["modal_id"] != "") {
        $device_problem_q = mysqli_query($conn, "select * from device_problem where modal_id = '" . $_REQUEST["modal_id"] . "' and isDelete=0 and isActive=1 ");
        $device_problem_row = mysqli_num_rows($device_problem_q);
        if ($device_problem_row > 0) {
            while ($device_problem_r = mysqli_fetch_assoc($device_problem_q)) {
                $device_problem_rs[] = $device_problem_r;
            }
            $ack = ["ack" => 1, "ack_msg" => "Device Problem fetched successfully!!", "device_problems" => $device_problem_rs,];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No Device Problem found"];
        }
    } else {
        $device_problem_q = mysqli_query($conn, "select * from device_problem where isDelete=0 and isActive=1 ");
        $device_problem_row = mysqli_num_rows($device_problem_q);
        if ($device_problem_row > 0) {
            while ($device_problem_r = mysqli_fetch_assoc($device_problem_q)) {
                $device_problem_rs[] = $device_problem_r;
            }
            $ack = ["ack" => 1, "ack_msg" => "Device Problem fetched successfully!!", "device_problems" => $device_problem_rs,];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No Device Problem found"];
        }
    }
} elseif ($_REQUEST["service"] == "gallery") {
    $gallery_rs = [];
    $gallery_q = mysqli_query($conn, "select * from gallery where isDelete=0 and isActive=1 ");
    if ($gallery_q) {
        while ($gallery_r = mysqli_fetch_assoc($gallery_q)) {
            if ($gallery_r["image_path"] != "" && file_exists(GALLERY_IMAGE_PATH . $gallery_r["image_path"])) {
                $gallery_r["image_path"] = SITEURL . GALLERY_IMAGE_PATH . $gallery_r["image_path"];
            } else {
                $gallery_r["image_path"] = "";
            }
            $gallery_rs[] = $gallery_r;
        }
        $ack = ["ack" => 1, "ack_msg" => "Gallery Fetched Successfully!!", "gallery" => $gallery_rs,];
    } else {
        $ack = ["ack" => 0, "ack_msg" => "No Gallery Found"];
    }
} elseif ($_REQUEST["service"] == "create_order") {
    if ($_REQUEST["user_id"] != "") {
        $image_path = $common_obj->upload_image($_FILES["image_path"]);
        $device_problem_id = "";
        $tracking_id = "abcd12345";
        $fileName = "";
        $q = mysqli_query($conn, "insert into orders(user_id,vendor_id,category_id,brand_id,modal_id,device_problem_id,user_address_id,offer_code,tracking_id,image_path,order_pdf,sub_total,tax_amount,offer_amount,grand_total,created_date)
		values('" . $_REQUEST["user_id"] . "','" . $_REQUEST["vendor_id"] . "','" . $_REQUEST["category_id"] . "','" . $_REQUEST["brand_id"] . "','" . $_REQUEST["modal_id"] . "','" . $device_problem_id . "','" . $_REQUEST["user_address_id"] . "','" . $_REQUEST["offer_code"] . "','" . $tracking_id . "','" . $image_path . "','" . $fileName . "','" . $_REQUEST["sub_total"] . "','" . $_REQUEST["tax_amount"] . "','" . $_REQUEST["offer_amount"] . "','" . $_REQUEST["grand_total"] . "','" . date("Y-m-d H:i:s") . "')");
        if ($q) {
            $order_id = mysqli_insert_id($conn);
            if ($_REQUEST["device_problem_id"] != "") {
                $device_problem_items = $_REQUEST["device_problem_id"];
                $json_device_problem = json_decode($device_problem_items, true);
                foreach ($json_device_problem as $device_problem_array) {
                    $device_probem_id = $device_problem_array;
                    $q1 = mysqli_query($conn, "insert into user_device_problem(device_probem_id,user_id,vendor_id,order_id,created_date)values('" . $device_probem_id . "','" . $_REQUEST["user_id"] . "','" . $_REQUEST["vendor_id"] . "','" . $order_id . "','" . date("Y-m-d H:i:s") . "')");
                }
            }
            // require_once __DIR__ . './mpdf/vendor/autoload.php';
            require './mpdf' . '/vendor/autoload.php';

            $mpdf = new \Mpdf\Mpdf();
            $mpdf->packTableData = true;
            $mpdf->AddPage();
            $fileName = "invoice-" . $order_id . '.pdf';
            $mpdf->WriteHTML(file_get_contents(SITEURL . 'user_invoice_pdf.php?order_id=' . $order_id . ''));
            //save the file put which location you need folder/filname
            // $mpdf->Output($fileName, 'D');      

            $mpdf->Output("pdf/user_invoice/" . $fileName, \Mpdf\Output\Destination::FILE);

            $q = mysqli_query($conn, "UPDATE orders set order_pdf = '" . $fileName . "' where id = '" . $order_id . "' and isDelete=0 and isActive=1");

            $user_d = mysqli_query($conn, "select * from orders where id = '" . $order_id . "' and isDelete=0 and isActive=1");
            while ($user_r = mysqli_fetch_assoc($user_d)) {
                if ($user_r["image_path"] != "" && file_exists(PROBLEM_IMAGE_PATH . $user_r["image_path"])) {
                    $user_r["image_path"] = SITEURL . PROBLEM_IMAGE_PATH . $user_r["image_path"];
                } else {
                    $user_r["image_path"] = "";
                }
                if ($user_r["order_pdf"] != "" && file_exists(USER_ORDER_PDF_PATH . $user_r["order_pdf"])) {
                    $user_r["order_pdf"] = SITEURL . USER_ORDER_PDF_PATH . $user_r["order_pdf"];
                } else {
                    $user_r["order_pdf"] = "";
                }
                $order_details[] = $user_r;
            }

            $ack = ["ack" => 1, "ack_msg" => "Order successfully!!", "order" => $order_details];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "Something Went Wrong"];
        }
    } else {
        $ack = ["ack" => 0, "ack_msg" => "some perameters misssing"];
    }
} elseif ($_REQUEST["service"] == "actual_cost") {
    $order_rs = [];
    if ($_REQUEST["order_id"] != "") {
        $device_problem_id = "";
        $vendor_q = mysqli_query($conn, "select * from orders where id = '" . $_REQUEST["order_id"] . "' and isDelete=0 and isActive=1");
        $vendor_r = mysqli_fetch_assoc($vendor_q);
        if ($vendor_r) {
            $q = mysqli_query($conn, "UPDATE orders set device_problem_id = '" . $device_problem_id . "',sub_total = '" . $_REQUEST["sub_total"] . "',tax_amount = '" . $_REQUEST["tax_amount"] . "',offer_amount = '" . $_REQUEST['offer_amount'] . "',grand_total = '" . $_REQUEST['grand_total'] . "' where id = '" . $_REQUEST["order_id"] . "' and isDelete=0 and isActive=1");
            if ($q) {
                if ($_REQUEST["device_problem_id"] != "") {
                    $device_problem_items = $_REQUEST["device_problem_id"];
                    $json_device_problem = json_decode($device_problem_items, true);
                    $where = " where id = '" . $_REQUEST["order_id"] . "' and isDelete=0 and isActive=1";
                    $order_d = mysqli_query($conn, "select * from orders" . $where);
                    $order_r = mysqli_fetch_assoc($order_d);
                    $sql = "DELETE FROM user_device_problem WHERE order_id='" . $_REQUEST["order_id"] . "'";
                    mysqli_query($conn, $sql);
                    foreach ($json_device_problem as $device_problem_array) {
                        $device_probem_id = $device_problem_array;
                        $q1 = mysqli_query($conn, "insert into user_device_problem(device_probem_id,user_id,vendor_id,order_id,created_date)values('" . $device_probem_id . "','" . $order_r['user_id'] . "','" . $order_r['vendor_id'] . "','" . $_REQUEST["order_id"] . "','" . date("Y-m-d H:i:s") . "')");
                    }
                }
                // require_once __DIR__ . './mpdf/vendor/autoload.php';
                require './mpdf' . '/vendor/autoload.php';

                $mpdf = new \Mpdf\Mpdf();
                $mpdf->packTableData = true;
                $mpdf->AddPage();
                $fileName = "invoice-" . $_REQUEST["order_id"] . '.pdf';
                $mpdf->WriteHTML(file_get_contents(SITEURL . 'user_invoice_pdf.php?order_id=' . $_REQUEST["order_id"] . ''));
                //save the file put which location you need folder/filname
                // $mpdf->Output($fileName, 'D');
                $mpdf->Output("pdf/user_invoice/" . $fileName, \Mpdf\Output\Destination::FILE);
                $q2 = mysqli_query($conn, "UPDATE orders set order_pdf = '" . $fileName . "' where id = '" . $_REQUEST["order_id"] . "' and isDelete=0 and isActive=1");

                if ($order_r["image_path"] != "" && file_exists(PROBLEM_IMAGE_PATH . $order_r["image_path"])) {
                    $order_r["image_path"] = SITEURL . PROBLEM_IMAGE_PATH . $order_r["image_path"];
                } else {
                    $order_r["image_path"] = "";
                }
                if ($order_r["order_pdf"] != "" && file_exists(USER_ORDER_PDF_PATH . $order_r["order_pdf"])) {
                    $order_r["order_pdf"] = SITEURL . USER_ORDER_PDF_PATH . $order_r["order_pdf"];
                } else {
                    $order_r["order_pdf"] = "";
                }
                $order_rs = $order_r;
                $ack = ["ack" => 1, "ack_msg" => "Order Updated successfully", "order" => $order_rs,];
            } else {
                $ack = ["ack" => 0, "ack_msg" => "something went wrong"];
            }
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No Vendor(s) found"];
        }
    } else {
        $ack = ["ack" => 0, "ack_msg" => "some perameters misssing"];
    }
} elseif ($_REQUEST['service'] == "add_user_address") {
    if ($_REQUEST["user_id"] != "") {
        $q = mysqli_query($conn, "insert into user_address(user_id, address, zipcode, created_date)values('" . $_REQUEST['user_id'] . "','" . $_REQUEST['address'] . "','" . $_REQUEST['zipcode'] . "','" . date('Y-m-d H:i:s') . "')");
        $address_id = mysqli_insert_id($conn);
        $user_address_d = mysqli_query($conn, "select * from user_address where id = '" . $address_id . "' and isDelete=0 and isActive=1");
        $user_address_r =  mysqli_fetch_assoc($user_address_d);
        $user_address_details = $user_address_r;
        if ($q) {
            $ack = array('ack' => 1, 'ack_msg' => 'Address add successfully.', "user" => $user_address_details);
        } else {
            $ack = array("ack" => 0, "ack_msg" => 'something went to wrong');
        }
    } else {
        $ack = ["ack" => 0, "ack_msg" => "some perameters misssing"];
    }
} elseif ($_REQUEST["service"] == "user_address") {
    $user_address_rs = [];
    if ($_REQUEST["user_id"] != "") {
        $user_address_q = mysqli_query($conn, "select * from user_address where user_id = '" . $_REQUEST["user_id"] . "' and isDelete=0 and isActive=1 ");
        $user_address_row = mysqli_num_rows($user_address_q);
        if ($user_address_row > 0) {
            while ($user_address_r = mysqli_fetch_assoc($user_address_q)) {
                $user_address_rs[] = $user_address_r;
            }
            $ack = ["ack" => 1, "ack_msg" => "User Address fetched successfully!!", "user_address" => $user_address_rs,];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No user_address found"];
        }
    } else {
        $user_address_q = mysqli_query($conn, "select * from user_address where isDelete=0 and isActive=1 ");
        $user_address_row = mysqli_num_rows($user_address_q);
        if ($user_address_row > 0) {
            while ($user_address_r = mysqli_fetch_assoc($user_address_q)) {
                $user_address_rs[] = $user_address_r;
            }
            $ack = ["ack" => 1, "ack_msg" => "User Address fetched successfully!!", "user_address" => $user_address_rs,];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No user_address found"];
        }
    }
} elseif ($_REQUEST["service"] == "add_user_review") {
    if ($_REQUEST["order_id"] && $_REQUEST["user_id"] && $_REQUEST["vendor_id"]) {
        $q = mysqli_query($conn, "insert into user_review(order_id,user_id,vendor_id,rating,review,created_date)
		values('" . $_REQUEST["order_id"] . "','" . $_REQUEST["user_id"] . "','" . $_REQUEST["vendor_id"] . "','" . $_REQUEST["rating"] . "','" . $_REQUEST["review"] . "','" . date("Y-m-d H:i:s") . "')");
        if ($q) {
            $ack = ["ack" => 1, "ack_msg" => "Review submitted successfully!!"];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "something went wrong"];
        }
    } else {
        $ack = ["ack" => 0, "ack_msg" => "some perameters misssing"];
    }
} elseif ($_REQUEST["service"] == "add_vendor_review") {
    if ($_REQUEST["order_id"] && $_REQUEST["user_id"] && $_REQUEST["vendor_id"]) {
        $q = mysqli_query($conn, "insert into vendor_review(order_id,user_id,vendor_id,rating,review,created_date)
		values('" . $_REQUEST["order_id"] . "','" . $_REQUEST["user_id"] . "','" . $_REQUEST["vendor_id"] . "','" . $_REQUEST["rating"] . "','" . $_REQUEST["review"] . "','" . date("Y-m-d H:i:s") . "')");
        if ($q) {
            $ack = ["ack" => 1, "ack_msg" => "Review submitted successfully!!"];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "something went wrong"];
        }
    } else {
        $ack = ["ack" => 0, "ack_msg" => "some perameters misssing"];
    }
} elseif ($_REQUEST["service"] == "user_reviews") {
    $user_reviews_rs = [];
    if ($_REQUEST["user_id"] != "") {
        $user_reviews_q = mysqli_query($conn, "select * from user_review where user_id = '" . $_REQUEST["user_id"] . "' and isDelete=0 and isActive=1");
        $user_row = mysqli_num_rows($user_reviews_q);
        if ($user_row > 0) {
            while ($user_reviews_r = mysqli_fetch_assoc($user_reviews_q)) {
                $vendor_name_q = mysqli_query($conn, "select * from vendor where isDelete=0 and isActive=1 and id= '" . $user_reviews_r["vendor_id"] . "' ");
                $vendor_name_r = mysqli_fetch_assoc($vendor_name_q);
                $user_reviews_r["vendor_name"] = $vendor_name_r["vendor_name"];
                $user_reviews_rs[] = $user_reviews_r;
            }
            $ack = ["ack" => 1, "ack_msg" => "User Review fetched successfully!!", "user_review" => $user_reviews_rs,];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No User Review found"];
        }
    } else {
        $ack = ["ack" => 0, "ack_msg" => "some perameters misssing"];
    }
} elseif ($_REQUEST["service"] == "vendor_reviews") {
    $vendor_reviews_rs = [];
    if ($_REQUEST["vendor_id"] != "") {
        $vendor_reviews_q = mysqli_query($conn, "select * from vendor_review where vendor_id = '" . $_REQUEST["vendor_id"] . "' and isDelete=0 and isActive=1");
        $user_row = mysqli_num_rows($vendor_reviews_q);
        if ($user_row > 0) {
            while ($vendor_reviews_r = mysqli_fetch_assoc($vendor_reviews_q)) {
                $user_name_q = mysqli_query($conn, "select * from user where isDelete=0 and isActive=1 and id= '" . $vendor_reviews_r["user_id"] . "' ");
                $user_name_r = mysqli_fetch_assoc($user_name_q);
                $vendor_reviews_r["user_name"] = $user_name_r["user_name"];
                $vendor_reviews_rs[] = $vendor_reviews_r;
            }
            $ack = ["ack" => 1, "ack_msg" => "Vendor Review fetched successfully!!", "vendor_review" => $vendor_reviews_rs,];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No Vendor Review found"];
        }
    } else {
        $ack = ["ack" => 0, "ack_msg" => "some perameters misssing"];
    }
} elseif ($_REQUEST['service'] == "offers_list") {
    if ($_REQUEST["user_id"] != "") {
        $order_d = mysqli_query($conn, "select * from orders where user_id = '" . $_REQUEST["user_id"] . "' and isDelete=0 and isActive=1");
        $order_row = mysqli_num_rows($order_d);
        if ($order_row > 0) {
            $offers = [];
            $where = " where isDelete=0 AND isActive=1 AND is_first_order=0";
            $offers_d = mysqli_query($conn, "select * from offers $where");
            if (mysqli_num_rows($offers_d) > 0) {
                while ($offers_r = mysqli_fetch_assoc($offers_d)) {
                    $offers[] = $offers_r;
                }
                $ack = array("ack" => 1, "ack_msg" => 'offer fetch successfully', "offers" => $offers);
            } else {
                $ack = array("ack" => 0, "ack_msg" => 'No offer(s) found');
            }
        } else {
            $offers = [];
            $where = " where isDelete=0 AND isActive=1";
            $offers_d = mysqli_query($conn, "select * from offers $where");
            if (mysqli_num_rows($offers_d) > 0) {
                while ($offers_r = mysqli_fetch_assoc($offers_d)) {
                    $offers[] = $offers_r;
                }
                $ack = array("ack" => 1, "ack_msg" => 'offer fetch successfully', "offers" => $offers);
            } else {
                $ack = array("ack" => 0, "ack_msg" => 'No offer(s) found');
            }
        }
    } else {
        $ack = ["ack" => 0, "ack_msg" => "some perameters misssing"];
    }
} elseif ($_REQUEST["service"] == "vendor_list") {
    if ($_REQUEST["user_id"] != "" && $_REQUEST["latitude"] != "" && $_REQUEST["longitude"] != "") {
        $vendor_rs = [];
        if ($_REQUEST["radius"] != "") {
            $vendor_q = mysqli_query($conn, "SELECT *,( 3959 * acos( cos( radians('" . $_REQUEST["latitude"] . "') ) * cos( radians( latitude ) ) * cos( radians(longitude) - radians('" . $_REQUEST["longitude"] . "')) + sin(radians('" . $_REQUEST["latitude"] . "')) * sin( radians(latitude)))) AS distance FROM vendor  WHERE isActive = 1 and isDelete = 0  HAVING distance < '" . $_REQUEST["radius"] . "' ORDER BY id asc");
        } else {
            $vendor_q = mysqli_query($conn, "SELECT * FROM vendor WHERE isActive = 1 and isDelete = 0  order by id asc");
        }
        if (mysqli_num_rows($vendor_q) > 0) {
            while ($vendor_r = mysqli_fetch_assoc($vendor_q)) {
                $vendor_rs[] = $vendor_r;
            }
        }
        if (!empty($vendor_rs)) {
            $ack = ["ack" => 1, "ack_msg" => "Vendor list fetched successfully!!", "vendor" => $vendor_rs,];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No Vendor found"];
        }
    } else {
        $ack = ["ack" => 0, "ack_msg" => "some perameters misssing"];
    }
} elseif ($_REQUEST["service"] == "order_request_list") {
    $order_rs = [];
    if ($_REQUEST["vendor_id"] != "") {
        $where = " where vendor_id = '" . $_REQUEST["vendor_id"] . "' and isDelete=0 and isActive=1 and status=0 ";
        $order_d = mysqli_query($conn, "select * from orders" . $where);
        if ($order_d) {
            while ($order_r = mysqli_fetch_assoc($order_d)) {
                if ($order_r["image_path"] != "" && file_exists(CATEGORY_IMAGE_PATH . $order_r["image_path"])) {
                    $order_r["image_path"] = SITEURL . CATEGORY_IMAGE_PATH . $order_r["image_path"];
                } else {
                    $order_r["image_path"] = "";
                }
                if ($order_r["order_pdf"] != "" && file_exists(USER_ORDER_PDF_PATH . $order_r["order_pdf"])) {
                    $order_r["order_pdf"] = SITEURL . USER_ORDER_PDF_PATH . $order_r["order_pdf"];
                } else {
                    $order_r["order_pdf"] = "";
                }

                $user_q = mysqli_query($conn, "select * from user where id='" . $order_r["user_id"] . "' and isDelete=0 and isActive=1");
                $user_r = mysqli_fetch_assoc($user_q);
                $order_r["user_name"] = $user_r['user_name'];

                $vendor_q = mysqli_query($conn, "select * from vendor where id='" . $order_r["vendor_id"] . "' and isDelete=0 and isActive=1");
                $vendor_r = mysqli_fetch_assoc($vendor_q);
                $order_r["vendor_name"] = $vendor_r['vendor_name'];

                $problem_q = mysqli_query($conn, "select * from user_device_problem where order_id='" . $order_r["id"] . "' and isDelete=0 and isActive=1");
                $problem_item = [];
                if (mysqli_num_rows($problem_q) > 0) {
                    while ($problem_r = mysqli_fetch_assoc($problem_q)) {
                        $problem_rs["id"] = $problem_r["id"];
                        $problem_rs["device_probem_id"] = $problem_r["device_probem_id"];
                        $user_q = mysqli_query($conn, "SELECT * FROM device_problem WHERE  id='" . $problem_r["device_probem_id"] . "'");
                        $user_r = mysqli_fetch_assoc($user_q);
                        $problem_rs["device_problem_name"] = $user_r["device_problem_name"];
                        $problem_rs["amount"] = $user_r["amount"];
                        $problem_item[] = $problem_rs;
                    }
                }
                if ($problem_item != "") {
                    $order_r["device_problem"] = $problem_item;
                }
                $order_rs[] = $order_r;
            }
            $ack = ["ack" => 1, "ack_msg" => "Orders Request list fetched successfully!!", "orders" => $order_rs,];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No Orders found"];
        }
    } else {
        $ack = ["ack" => 0, "ack_msg" => "some perameters misssing"];
    }
} elseif ($_REQUEST['service'] == "order_accept_request") {
    if (isset($_REQUEST['order_id'])) {
        $where = " where id=" . $_REQUEST['order_id'] . "";
        $order_q = mysqli_query($conn, "select * from orders " . $where);
        if (mysqli_num_rows($order_q) > 0) {
            while ($order_r = mysqli_fetch_assoc($order_q)) {
                if ($_REQUEST['order_id']) {
                    $q = mysqli_query($conn, "UPDATE orders set status = 1 where id = '" . $order_r['id'] . "'");
                    // $post_q = mysqli_query($conn, "UPDATE post set isDelete = 1 where id = '" . $_REQUEST['post_id'] . "'");
                }
                // else {
                //     $q = mysqli_query($conn, "UPDATE job set status = 3 where id = '" . $job_r['id'] . "'");
                // }
                if ($q) {
                    // $user_d = mysqli_query($conn, "select * from vendor where id='" . $_REQUEST['vid'] . "' and isDelete=0 and isActive=1");
                    // if (mysqli_num_rows($user_d) > 0) {
                    //     while ($user_r = mysqli_fetch_assoc($user_d)) {
                    //         $msg = "Job accepted successfully!!";
                    //         // print_r($msg);
                    //         $status = "accepted";
                    //         $notification_obj->send($user_r['device_token'], $msg, $status);
                    //     }
                    // }
                    $ack = array('ack' => 1, 'ack_msg' => 'Order accepted successfully!!');
                } else {
                    $ack = array("ack" => 0, "ack_msg" => 'something went wrong');
                }
            }
        }
    } else {
        $ack = array("ack" => 0, "ack_msg" => 'some perameters misssing');
    }
} elseif ($_REQUEST['service'] == "order_cancel_request") {
    if (isset($_REQUEST['order_id'])) {
        $where = " where id=" . $_REQUEST['order_id'] . "";
        $order_q = mysqli_query($conn, "select * from orders " . $where);
        if (mysqli_num_rows($order_q) > 0) {
            while ($order_r = mysqli_fetch_assoc($order_q)) {
                if ($_REQUEST['order_id']) {
                    $q = mysqli_query($conn, "UPDATE orders set status = 3 where id = '" . $order_r['id'] . "'");
                }
                if ($q) {

                    $ack = array('ack' => 1, 'ack_msg' => 'Order Cancel successfully!!');
                } else {
                    $ack = array("ack" => 0, "ack_msg" => 'something went wrong');
                }
            }
        }
    } else {
        $ack = array("ack" => 0, "ack_msg" => 'some perameters misssing');
    }
} elseif ($_REQUEST["service"] == "order_accept_list") {
    $order_rs = [];
    if ($_REQUEST["user_id"] != "") {
        $where = " where user_id = '" . $_REQUEST["user_id"] . "' and isDelete=0 and isActive=1 and status=1 ";
        $order_d = mysqli_query($conn, "select * from orders" . $where);
        if ($order_d) {
            while ($order_r = mysqli_fetch_assoc($order_d)) {
                if ($order_r["image_path"] != "" && file_exists(CATEGORY_IMAGE_PATH . $order_r["image_path"])) {
                    $order_r["image_path"] = SITEURL . CATEGORY_IMAGE_PATH . $order_r["image_path"];
                } else {
                    $order_r["image_path"] = "";
                }
                if ($order_r["order_pdf"] != "" && file_exists(USER_ORDER_PDF_PATH . $order_r["order_pdf"])) {
                    $order_r["order_pdf"] = SITEURL . USER_ORDER_PDF_PATH . $order_r["order_pdf"];
                } else {
                    $order_r["order_pdf"] = "";
                }

                $user_q = mysqli_query($conn, "select * from user where id='" . $order_r["user_id"] . "' and isDelete=0 and isActive=1");
                $user_r = mysqli_fetch_assoc($user_q);
                $order_r["user_name"] = $user_r['user_name'];

                $vendor_q = mysqli_query($conn, "select * from vendor where id='" . $order_r["vendor_id"] . "' and isDelete=0 and isActive=1");
                $vendor_r = mysqli_fetch_assoc($vendor_q);
                $order_r["vendor_name"] = $vendor_r['vendor_name'];

                $problem_q = mysqli_query($conn, "select * from user_device_problem where order_id='" . $order_r["id"] . "' and isDelete=0 and isActive=1");
                $problem_item = [];
                if (mysqli_num_rows($problem_q) > 0) {
                    while ($problem_r = mysqli_fetch_assoc($problem_q)) {
                        $problem_rs["id"] = $problem_r["id"];
                        $problem_rs["device_probem_id"] = $problem_r["device_probem_id"];
                        $user_q = mysqli_query($conn, "SELECT * FROM device_problem WHERE  id='" . $problem_r["device_probem_id"] . "'");
                        $user_r = mysqli_fetch_assoc($user_q);
                        $problem_rs["device_problem_name"] = $user_r["device_problem_name"];
                        $problem_rs["amount"] = $user_r["amount"];
                        $problem_item[] = $problem_rs;
                    }
                }
                if ($problem_item != "") {
                    $order_r["device_problem"] = $problem_item;
                }
                $order_rs[] = $order_r;
            }
            $ack = ["ack" => 1, "ack_msg" => "Orders Accept list fetched successfully!!", "orders" => $order_rs,];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No Orders found"];
        }
    } elseif ($_REQUEST["vendor_id"] != "") {
        $where = " where vendor_id = '" . $_REQUEST["vendor_id"] . "' and isDelete=0 and isActive=1 and status=1 ";
        $order_d = mysqli_query($conn, "select * from orders" . $where);
        if ($order_d) {
            while ($order_r = mysqli_fetch_assoc($order_d)) {
                if ($order_r["image_path"] != "" && file_exists(CATEGORY_IMAGE_PATH . $order_r["image_path"])) {
                    $order_r["image_path"] = SITEURL . CATEGORY_IMAGE_PATH . $order_r["image_path"];
                } else {
                    $order_r["image_path"] = "";
                }
                if ($order_r["order_pdf"] != "" && file_exists(USER_ORDER_PDF_PATH . $order_r["order_pdf"])) {
                    $order_r["order_pdf"] = SITEURL . USER_ORDER_PDF_PATH . $order_r["order_pdf"];
                } else {
                    $order_r["order_pdf"] = "";
                }

                $user_q = mysqli_query($conn, "select * from user where id='" . $order_r["user_id"] . "' and isDelete=0 and isActive=1");
                $user_r = mysqli_fetch_assoc($user_q);
                $order_r["user_name"] = $user_r['user_name'];

                $vendor_q = mysqli_query($conn, "select * from vendor where id='" . $order_r["vendor_id"] . "' and isDelete=0 and isActive=1");
                $vendor_r = mysqli_fetch_assoc($vendor_q);
                $order_r["vendor_name"] = $vendor_r['vendor_name'];

                $problem_q = mysqli_query($conn, "select * from user_device_problem where order_id='" . $order_r["id"] . "' and isDelete=0 and isActive=1");
                $problem_item = [];
                if (mysqli_num_rows($problem_q) > 0) {
                    while ($problem_r = mysqli_fetch_assoc($problem_q)) {
                        $problem_rs["id"] = $problem_r["id"];
                        $problem_rs["device_probem_id"] = $problem_r["device_probem_id"];
                        $user_q = mysqli_query($conn, "SELECT * FROM device_problem WHERE  id='" . $problem_r["device_probem_id"] . "'");
                        $user_r = mysqli_fetch_assoc($user_q);
                        $problem_rs["device_problem_name"] = $user_r["device_problem_name"];
                        $problem_rs["amount"] = $user_r["amount"];
                        $problem_item[] = $problem_rs;
                    }
                }
                if ($problem_item != "") {
                    $order_r["device_problem"] = $problem_item;
                }
                $order_rs[] = $order_r;
            }
            $ack = ["ack" => 1, "ack_msg" => "Orders Accept list fetched successfully!!", "orders" => $order_rs,];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No Orders found"];
        }
    } elseif ($_REQUEST["order_id"] != "") {
        $where = " where id = '" . $_REQUEST["order_id"] . "' and isDelete=0 and isActive=1 and status=1 ";
        $order_d = mysqli_query($conn, "select * from orders" . $where);
        if ($order_d) {
            while ($order_r = mysqli_fetch_assoc($order_d)) {
                if ($order_r["image_path"] != "" && file_exists(CATEGORY_IMAGE_PATH . $order_r["image_path"])) {
                    $order_r["image_path"] = SITEURL . CATEGORY_IMAGE_PATH . $order_r["image_path"];
                } else {
                    $order_r["image_path"] = "";
                }
                if ($order_r["order_pdf"] != "" && file_exists(USER_ORDER_PDF_PATH . $order_r["order_pdf"])) {
                    $order_r["order_pdf"] = SITEURL . USER_ORDER_PDF_PATH . $order_r["order_pdf"];
                } else {
                    $order_r["order_pdf"] = "";
                }

                $user_q = mysqli_query($conn, "select * from user where id='" . $order_r["user_id"] . "' and isDelete=0 and isActive=1");
                $user_r = mysqli_fetch_assoc($user_q);
                $order_r["user_name"] = $user_r['user_name'];

                $vendor_q = mysqli_query($conn, "select * from vendor where id='" . $order_r["vendor_id"] . "' and isDelete=0 and isActive=1");
                $vendor_r = mysqli_fetch_assoc($vendor_q);
                $order_r["vendor_name"] = $vendor_r['vendor_name'];

                $problem_q = mysqli_query($conn, "select * from user_device_problem where order_id='" . $order_r["id"] . "' and isDelete=0 and isActive=1");
                $problem_item = [];
                if (mysqli_num_rows($problem_q) > 0) {
                    while ($problem_r = mysqli_fetch_assoc($problem_q)) {
                        $problem_rs["id"] = $problem_r["id"];
                        $problem_rs["device_probem_id"] = $problem_r["device_probem_id"];
                        $user_q = mysqli_query($conn, "SELECT * FROM device_problem WHERE  id='" . $problem_r["device_probem_id"] . "'");
                        $user_r = mysqli_fetch_assoc($user_q);
                        $problem_rs["device_problem_name"] = $user_r["device_problem_name"];
                        $problem_rs["amount"] = $user_r["amount"];
                        $problem_item[] = $problem_rs;
                    }
                }
                if ($problem_item != "") {
                    $order_r["device_problem"] = $problem_item;
                }
                $order_rs[] = $order_r;
            }
            $ack = ["ack" => 1, "ack_msg" => "Orders Accept list fetched successfully!!", "orders" => $order_rs,];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No Orders found"];
        }
    } else {
        $where = " where isDelete=0 and isActive=1 and status=1 ";
        $order_d = mysqli_query($conn, "select * from orders" . $where);
        if ($order_d) {
            while ($order_r = mysqli_fetch_assoc($order_d)) {
                if ($order_r["image_path"] != "" && file_exists(CATEGORY_IMAGE_PATH . $order_r["image_path"])) {
                    $order_r["image_path"] = SITEURL . CATEGORY_IMAGE_PATH . $order_r["image_path"];
                } else {
                    $order_r["image_path"] = "";
                }
                if ($order_r["order_pdf"] != "" && file_exists(USER_ORDER_PDF_PATH . $order_r["order_pdf"])) {
                    $order_r["order_pdf"] = SITEURL . USER_ORDER_PDF_PATH . $order_r["order_pdf"];
                } else {
                    $order_r["order_pdf"] = "";
                }

                $user_q = mysqli_query($conn, "select * from user where id='" . $order_r["user_id"] . "' and isDelete=0 and isActive=1");
                $user_r = mysqli_fetch_assoc($user_q);
                $order_r["user_name"] = $user_r['user_name'];

                $vendor_q = mysqli_query($conn, "select * from vendor where id='" . $order_r["vendor_id"] . "' and isDelete=0 and isActive=1");
                $vendor_r = mysqli_fetch_assoc($vendor_q);
                $order_r["vendor_name"] = $vendor_r['vendor_name'];

                $problem_q = mysqli_query($conn, "select * from user_device_problem where order_id='" . $order_r["id"] . "' and isDelete=0 and isActive=1");
                $problem_item = [];
                if (mysqli_num_rows($problem_q) > 0) {
                    while ($problem_r = mysqli_fetch_assoc($problem_q)) {
                        $problem_rs["id"] = $problem_r["id"];
                        $problem_rs["device_probem_id"] = $problem_r["device_probem_id"];
                        $user_q = mysqli_query($conn, "SELECT * FROM device_problem WHERE  id='" . $problem_r["device_probem_id"] . "'");
                        $user_r = mysqli_fetch_assoc($user_q);
                        $problem_rs["device_problem_name"] = $user_r["device_problem_name"];
                        $problem_rs["amount"] = $user_r["amount"];
                        $problem_item[] = $problem_rs;
                    }
                }
                if ($problem_item != "") {
                    $order_r["device_problem"] = $problem_item;
                }
                $order_rs[] = $order_r;
            }
            $ack = ["ack" => 1, "ack_msg" => "Orders Accept list fetched successfully!!", "orders" => $order_rs,];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No Orders found"];
        }
    }
} elseif ($_REQUEST["service"] == "get_order") {
    $order_rs = [];
    if ($_REQUEST["order_id"] != "") {
        $where = " where id = '" . $_REQUEST["order_id"] . "' and isDelete=0 and isActive=1 and status=1 ";
        $order_d = mysqli_query($conn, "select * from orders" . $where);
        $order_r = mysqli_fetch_assoc($order_d);
        $order_rs = $order_r;
        if ($order_r) {
            $ack = ["ack" => 1, "ack_msg" => "Order fetch successfully", "order" => $order_rs];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No Order found"];
        }
    } else {
        $ack = ["ack" => 0, "ack_msg" => "some perameters misssing"];
    }
} elseif ($_REQUEST["service"] == "orders_list") {
    $user_orders_rs = [];
    if ($_REQUEST["user_id"] != "") {
        $user_orders_q = mysqli_query($conn, "select * from orders where user_id = '" . $_REQUEST["user_id"] . "' and isDelete=0 and isActive=1 ");
        $user_orders_row = mysqli_num_rows($user_orders_q);
        if ($user_orders_row > 0) {
            while ($user_orders_r = mysqli_fetch_assoc($user_orders_q)) {

                $problem_q = mysqli_query($conn, "select * from user_device_problem where order_id='" . $user_orders_r["id"] . "' and isDelete=0 and isActive=1");
                $problem_item = [];
                if (mysqli_num_rows($problem_q) > 0) {
                    while ($problem_r = mysqli_fetch_assoc($problem_q)) {
                        $problem_rs["id"] = $problem_r["id"];
                        $problem_rs["device_probem_id"] = $problem_r["device_probem_id"];
                        $user_q = mysqli_query($conn, "SELECT * FROM device_problem WHERE  id='" . $problem_r["device_probem_id"] . "'");
                        $user_r = mysqli_fetch_assoc($user_q);
                        $problem_rs["device_problem_name"] = $user_r["device_problem_name"];
                        $problem_rs["amount"] = $user_r["amount"];
                        $problem_item[] = $problem_rs;
                    }
                }
                if ($problem_item != "") {
                    $user_orders_r["device_problem"] = $problem_item;
                }

                $user_orders_rs[] = $user_orders_r;
            }
            $ack = ["ack" => 1, "ack_msg" => "User orders fetched successfully!!", "user_orders" => $user_orders_rs,];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No user orders found"];
        }
    } else {
        $user_orders_q = mysqli_query($conn, "select * from orders where isDelete=0 and isActive=1 ");
        $user_orders_row = mysqli_num_rows($user_orders_q);
        if ($user_orders_row > 0) {
            while ($user_orders_r = mysqli_fetch_assoc($user_orders_q)) {
                $user_orders_rs[] = $user_orders_r;
            }
            $ack = ["ack" => 1, "ack_msg" => "User orders fetched successfully!!", "user_orders" => $user_orders_rs,];
        } else {
            $ack = ["ack" => 0, "ack_msg" => "No user orders found"];
        }
    }
} elseif ($_REQUEST['service'] == "user_forget_password") {
    $reset_token = bin2hex(random_bytes(32));
    $email = $_REQUEST['email'];
    $user_q = mysqli_query($conn, "select * from user where email = '" . $_REQUEST['email'] . "' and isDelete=0 and isActive=1");
    if (mysqli_num_rows($user_q) > 0) {
        $sql = mysqli_query($conn, "UPDATE user set reset_token = '" . $reset_token . "' where email = '" . $email . "' and isDelete=0 and isActive=1");
        $reset_link = SITEURL . "reset_password.php?token=$reset_token";
        $to = $_REQUEST['email'];
        $from =  'makwanajaydip153@gmail.com';
        $subject = 'Password Reset Request';
        $message = "Click the following link to reset your password: $reset_link";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <' . $from . '>' . "\r\n";
        if (mail($to, $subject, $message, $headers)) {
            $ack = array('ack' => 1, 'ack_msg' => 'please check mailbox');
        } else {
            $ack = array("ack" => 0, "ack_msg" => 'Error sending email.');
        }
    } else {
        $ack = array("ack" => 0, "ack_msg" => 'please enter valid email address.');
    };
} elseif ($_REQUEST['service'] == "vendor_forget_password") {
    $reset_token = bin2hex(random_bytes(32));
    $email = $_REQUEST['email'];
    $vendor_q = mysqli_query($conn, "select * from vendor where email = '" . $_REQUEST['email'] . "' and isDelete=0 and isActive=1");
    if (mysqli_num_rows($vendor_q) > 0) {
        $sql = mysqli_query($conn, "UPDATE vendor set reset_token = '" . $reset_token . "' where email = '" . $email . "' and isDelete=0 and isActive=1");
        $reset_link = SITEURL . "reset_password.php?token=$reset_token";
        $to = $_REQUEST['email'];
        $from =  'makwanajaydip153@gmail.com';
        $subject = 'Password Reset Request';
        $message = "Click the following link to reset your password: $reset_link";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <' . $from . '>' . "\r\n";
        if (mail($to, $subject, $message, $headers)) {
            $ack = array('ack' => 1, 'ack_msg' => 'please check mailbox');
        } else {
            $ack = array("ack" => 0, "ack_msg" => 'Error sending email.');
        }
    } else {
        $ack = array("ack" => 0, "ack_msg" => 'please enter valid email address.');
    };
} elseif ($_REQUEST['service'] == "update_payment_id") {
    $orders_q = mysqli_query($conn, "select * from orders where id = '" . $_REQUEST['order_id'] . "' and isDelete=0 and isActive=1");
    if (mysqli_fetch_row($orders_q) > 0) {
        $q =    mysqli_query($conn, "UPDATE orders set razorpay_payment_id = '" . $_REQUEST['razorpay_payment_id'] . "',status = 2 where id = '" . $_REQUEST['order_id'] . "' and isDelete=0 and isActive=1");
        if ($q) {
            $ack = array("ack" => 1, "ack_msg" => 'Payment Successfully !');
        } else {
            $ack = array("ack" => 0, "ack_msg" => 'Something went wrong please try again !!');
        }
    } else {
        $ack = array("ack" => 0, "ack_msg" => 'No orders Found');
    }
} else {
    $ack = ["ack" => 0, "ack_msg" => "something went wrong"];
}
echo json_encode($ack);
