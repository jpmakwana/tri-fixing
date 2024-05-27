<?php
include("connect.php");
// Include your database connection code here

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_FILES["image_path"]) && $_FILES["image_path"]['size'] != 0) {
        $allowedExts = array("jpg", "jpeg", "png", "gif", "JPG", "JPEG");
        $temp = explode(".", $_FILES["image_path"]["name"]);
        $extension = end($temp);
        $error = "";
        if ($_FILES["image_path"]["error"] > 0) {
            $error .= "Error opening the file. ";
        }
        if ($_FILES["image_path"]["type"] == "application/x-msdownload") {
            $error .= "Mime type not allowed. ";
        }
        if (!in_array($extension, $allowedExts)) {
            $error .= "Extension not allowed. ";
        }
        $fileName  = $db->clean($_FILES["image_path"]["name"]);
        $fileSize  = round($_FILES["image_path"]["size"]); // BYTES
        $adate   = date('Y-m-d H:i:m');
        $extension = end(explode(".", $fileName));
        $fileName    = 'user_profile_' . substr(sha1(time()), 0, 6) . "." . $extension;
        $filePath     = "images/user/" . $fileName;
        move_uploaded_file($_FILES['image_path']['tmp_name'], $filePath);
        $image = $fileName;
        $images = USER_IMAGE_F . $_POST['old_image_path'];
        unlink($images);
        unset($_POST['old_image_path']);
    } else {
        $image = $_POST['old_image_path'];
    }
    $rows = array(
        "image_path" => $image,
    );
    $where    = "id='" . $_SESSION['USER_ID'] . "'";
    $isUpdated = $db->rp_update("user", $rows, $where);
} else {
    echo "Not Update Images";
}
