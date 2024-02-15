<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {
    $productId = $_POST['productId'];
    $productDate = $_POST['editProductDate'];
    $productName = $_POST['editProductName'];
    $quantity = $_POST['editQuantity'];
    $rate = $_POST['editRate'];
    $wholesale = $_POST['editWholesale'];
    $thb = $_POST['editThb'];
    $productStatus = $_POST['editProductStatus'];

    // Update the product
    $sql = "UPDATE product SET product_date = '$productDate', product_name = '$productName', quantity = '$quantity', rate = '$rate', wholesale = '$wholesale', thb = '$thb', active = '$productStatus', status = 1 WHERE product_id = $productId";

    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Successfully Update";

        // Store differences in edit_pdetailtable
        $sql_diff = "INSERT INTO edit_pdetail (product_id, rate_difference, wholesale_difference, thb_difference) VALUES ('$productId', '$rate', '$wholesale', '$thb')";
        if ($connect->query($sql_diff) === TRUE) {
            // Differences stored successfully
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error while storing differences";
        }
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error while updating product info";
    }
}

$connect->close();

echo json_encode($valid);
