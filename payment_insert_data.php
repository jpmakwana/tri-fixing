<?php
include("connect.php");
// Include your database connection code here

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the AJAX request
    // Add more fields as needed
    $grand_total = $_POST["grand_total"];
    $user_name = $_POST["user_name"];
    $order_id = $_POST["order_id"];
    $razorpay_payment_id = $_POST["razorpay_payment_id"];

    //this code pdf update
    $q = mysqli_query($conn, "UPDATE orders set razorpay_payment_id = '" . $razorpay_payment_id . "',status = 2 where id = '" . $order_id . "' and isDelete=0 and isActive=1");
    // require_once __DIR__ . './mpdf/vendor/autoload.php';

    require './mpdf' . '/vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->packTableData = true;
    $mpdf->AddPage();
    $fileName = "invoice-" . $order_id . '.pdf';
    $mpdf->WriteHTML(file_get_contents(SITEURL . 'user_invoice_pdf.php?order_id=' . $order_id . ''));
    $mpdf->Output("pdf/user_invoice/" . $fileName, \Mpdf\Output\Destination::FILE);
    $q1 = mysqli_query($conn, "UPDATE orders set order_pdf = '" . $fileName . "' where id = '" . $order_id . "' and isDelete=0 and isActive=1");
    // You can return a response to the client indicating success or failure
    if ($q) {
        //success msg
        echo json_encode(["status" => "success", "message" => "Data inserted successfully"]);
    } else {
        //error msg
        echo json_encode(["status" => "error", "message" => "Failed to insert data"]);
    }
}
