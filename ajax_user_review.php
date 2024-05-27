<?php
require_once("connect.php");
// Include your database connection code here


// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON data from the request
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    if ($data) {
        // Extract the rating and review text
        $rating = $data['rating'];
        $review = $data['review'];
        
        $order_id = $data['order_id'];

        $ctable_orders = "orders";
        $ctable_orders_where = "id = " . $order_id . " AND isDelete=0";
        $ctable_orders_r = $db->rp_getData($ctable_orders, "*", $ctable_orders_where);
        $ctable_order_d = mysqli_fetch_assoc($ctable_orders_r);

        $q = mysqli_query($conn, "insert into user_review(order_id,user_id,vendor_id,rating, review, created_date)values('" . $order_id . "','" . $ctable_order_d['user_id'] . "','" . $ctable_order_d['vendor_id'] . "','" . $rating . "','" . $review . "','" . date('Y-m-d H:i:s') . "')");

        if ($q) {
            $response = array('success' => true);
        } else {
            $response = array('success' => false, 'error' => $conn->error);
        }

        // Send the response as JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $response = array('success' => false, 'error' => 'Invalid data format');
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    $response = array('success' => false, 'error' => 'Invalid request method');
    header('Content-Type: application/json');
    echo json_encode($response);
}
