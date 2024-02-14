<?php
require_once "db_connect.php";

$contaminated_id = $_POST['contaminated_id'];
$contaminated_date = $_POST['contaminated_date'];
$product_id = $_POST['product_id'];
$operator_number = $_POST['operator_number'];
$prevQuan = $_POST['prevQuan'];
$contaminated_quantity = $_POST['contaminated_quantity'];

$sql = "UPDATE contaminated_plants SET contaminated_date='$contaminated_date', product_id='$product_id', operator_number='$operator_number', contaminated_quantity='$contaminated_quantity' WHERE contaminated_id='$contaminated_id'";

if ($connect->query($sql) === TRUE) {
    // Check if previous_quantity is greater than contaminated_quantity
    if ($prevQuan > $contaminated_quantity) {
        // Calculate the difference between previous_quantity and contaminated_quantity
        $quantity_difference = $prevQuan - $contaminated_quantity;
        
        // Update operator_quantity in operators table by subtracting the difference
        $update_sql = "UPDATE product 
                       SET quantity = quantity + $quantity_difference 
                       WHERE product_id = '$product_id'";
        
        if ($connect->query($update_sql) === TRUE) {
            header("Location: ../editContaminated.php?edit=1&id=$contaminated_id");
        } else {
            echo "Error updating operator quantity: " . $connect->error;
        }
    } elseif ($prevQuan < $contaminated_quantity) {
        // Calculate the difference between contaminated_quantity and previous_quantity
        $quantity_difference = $contaminated_quantity - $prevQuan;
        
        // Update operator_quantity in operators table by adding the difference
        $update_sql = "UPDATE product 
                       SET quantity = quantity - $quantity_difference 
                       WHERE product_id = '$product_id'";
        
        if ($connect->query($update_sql) === TRUE) {
            header("Location: ../editContaminated.php?edit=1&id=$contaminated_id");
        } else {
            echo "Error updating operator quantity: " . $connect->error;
        }
    } else {
        // If previous_quantity is equal to contaminated_quantity, no need for update
        header("Location: ../editContaminated.php?edit=1&id=$contaminated_id");
    }
} else {
    echo "Error updating record: " . $connect->error;
}

$connect->close();
?>
