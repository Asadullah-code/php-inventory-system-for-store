<?php

require_once 'core.php';

$valid['success'] = false;
$valid['messages'] = array();

if ($_POST) {
    $productId = $_POST['productId'];
    $productDate = $_POST['editProductDate'];
    $productName = $_POST['editProductName'];
    $newQuantity = $_POST['editQuantity'];
    $rate = $_POST['editRate'];
    $wholesale = $_POST['editWholesale'];
    $thb = $_POST['editThb'];
    $productStatus = $_POST['editProductStatus'];

    // Query the old quantity from the database
    $oldQuantityQuery = "SELECT quantity FROM product WHERE product_id = $productId";
    $oldQuantityResult = $connect->query($oldQuantityQuery);

    if ($oldQuantityResult && $oldQuantityResult->num_rows > 0) {
        $row = $oldQuantityResult->fetch_assoc();
        $oldQuantity = $row['quantity'];

        // Calculate the difference between old and new quantities
        $quantityDifference = $newQuantity - $oldQuantity;

        // Update the product
        $sql = "UPDATE product SET product_date = '$productDate', product_name = '$productName', quantity = '$newQuantity', rate = '$rate', wholesale = '$wholesale', thb = '$thb', active = '$productStatus', status = 1 WHERE product_id = $productId";

        if ($connect->query($sql) === TRUE) {
            $valid['success'] = true;
            $valid['messages'][] = "Successfully updated product";

            // Insert into edit_pdetail table
            $editPDetailSql = "INSERT INTO edit_pdetail (product_id, product_name, quantity, product_date) VALUES ('$productId', '$productName', '$quantityDifference', '$productDate')";
            if ($connect->query($editPDetailSql) === TRUE) {
                $valid['messages'][] = "";
            } else {
                $valid['messages'][] = "Error while inserting data into edit_pdetail table: " . $connect->error;
            }

        } else {
            $valid['messages'][] = "Error while updating product info: " . $connect->error;
        }
    } else {
        $valid['messages'][] = "Error: Product not found";
    }
} else {
    $valid['messages'][] = "No POST data received";
}

$connect->close();

echo json_encode($valid);
?>
