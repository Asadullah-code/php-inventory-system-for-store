<?php

require_once 'core.php';

$valid['success'] = false;
$valid['messages'] = array();

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
    $sql = "UPDATE product SET product_date = '$productDate', product_name = '$productName', quantity = '$quantity', rate = '$rate', wholesale = '$wholesale', thb = '$thb', active = '$productStatus', status = 1, add_quantity = '$quantity' WHERE product_id = $productId";

    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'][] = "Successfully updated product";

        // No need to store differences in edit_pdetailtable

    } else {
        $valid['messages'][] = "Error while updating product info: " . $connect->error;
    }
} else {
    $valid['messages'][] = "No POST data received";
}

$connect->close();

echo json_encode($valid);
?>
