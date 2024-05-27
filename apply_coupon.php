<?php
require_once("connect.php");
// Include your database connection code here
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $couponCode = $_POST["coupon_code"];
    $action = $_POST["action"];
    $order_id = $_POST["order_id"];
    // Prepare and execute a SQL query to fetch the discount percentage for the submitted coupon code
    $where = " where BINARY code=$couponCode AND isDelete=0 AND isActive=1 AND is_first_order=0";
    $offers_d = mysqli_query($conn, "select * from offers $where");
    $ctable_offers = "offers";
    $ctable_offers_where = "BINARY code='" . $couponCode . "' AND isDelete=0";
    $ctable_offers_r = $db->rp_getData($ctable_offers, "*", $ctable_offers_where);
    $ctable_offers_d = mysqli_fetch_array($ctable_offers_r);

    //orders table data get query
    $ctable_order = "orders";
    $ctable_order_where = "id='" . $order_id . "' AND isDelete=0";
    $ctable_order_r = $db->rp_getData($ctable_order, "*", $ctable_order_where);
    $ctable_order_d = mysqli_fetch_array($ctable_order_r);
    $grand_total = $ctable_order_d["grand_total"];
    $amount = $ctable_order_d["sub_total"];

    //first order couple apply check query
    $ctable_order_check_r = mysqli_query($conn, "SELECT * FROM `orders` WHERE BINARY offer_code='" . $couponCode . "' AND user_id='" . $ctable_order_d['user_id'] . "' AND isDelete=0 AND isActive=1");


    if (mysqli_num_rows($ctable_offers_r) > 0) {

        $order_d = mysqli_query($conn, "select * from orders where user_id = '" . $ctable_order_d["user_id"] . "' and isDelete=0 and isActive=1");
        $order_row = mysqli_num_rows($order_d);
       
        if (mysqli_num_rows($ctable_order_check_r) <= 0 && $ctable_offers_d['is_first_order'] == 1 && $order_row == 1) {
            $discount = ($amount * $ctable_offers_d['percentage']) / 100;
            // Calculate the final amount after applying the discount
            $finalAmount = $amount - $discount;
            $grand_total = $grand_total - $discount;
            $q = mysqli_query($conn, "UPDATE orders set offer_amount = '" . $discount . "',grand_total = '" . $grand_total . "',offer_code = '" . $ctable_offers_d['code'] . "' where id = '" . $order_id . "' and isDelete=0 and isActive=1");
            // Create an array to hold the discount and final amount
            $response = array(
                'discount' => $discount,
                'finalAmount' => $finalAmount,
                'grand_total' => $grand_total,
                'success' => 'Coupon code applied successfully !!',
                'status' => 1
            );
            // Convert the array to JSON
            echo json_encode($response);
        } elseif ($ctable_offers_d['is_first_order'] == 0) {
            $discount = ($amount * $ctable_offers_d['percentage']) / 100;
            // Calculate the final amount after applying the discount
            $finalAmount = $amount - $discount;
            $grand_total = $grand_total - $discount;
            $q = mysqli_query($conn, "UPDATE orders set offer_amount = '" . $discount . "',grand_total = '" . $grand_total . "',offer_code = '" . $ctable_offers_d['code'] . "' where id = '" . $order_id . "' and isDelete=0 and isActive=1");
            // Create an array to hold the discount and final amount
            $response = array(
                'discount' => $discount,
                'finalAmount' => $finalAmount,
                'grand_total' => $grand_total,
                'success' => 'Coupon code applied successfully !!',
                'status' => 1
            );
            // Convert the array to JSON
            echo json_encode($response);
        } else {
            // Return an error message in JSON format
            $errorResponse = array(
                'error' => 'You have applied this coupon code once Please enter another coupon code!',
                'status' => 3
            );
            // Convert the array to JSON
            echo json_encode($errorResponse);
        }
    } elseif ($action === "cancel") {
        // Handle coupon removal logic, for example, set the discount to 0.
        $discount = 0;
        $newTotal = $subtotalInput - $discount;
        $grand_total = $grand_total + $ctable_order_d['offer_amount'];
        $q = mysqli_query($conn, "UPDATE orders set offer_amount = '" . $discount . "',grand_total = '" . $grand_total . "',offer_code = NULL where id = '" . $order_id . "' and isDelete=0 and isActive=1");
        // Create an array to hold the discount and final amount
        $response = array(
            'discount' => $discount,
            'finalAmount' => $newTotal,
            'grand_total' => $grand_total,
            'error' => 'Remove coupon code !!',
            'status' => 2
        );
        // Convert the array to JSON
        echo json_encode($response);
    } else {
        // Return an error message in JSON format
        $errorResponse = array(
            'error' => 'Invalid coupon code.',
            'status' => 3
        );
        // Convert the array to JSON
        echo json_encode($errorResponse);
    }
}
