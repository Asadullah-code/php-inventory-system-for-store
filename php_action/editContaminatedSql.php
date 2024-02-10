<?php
require_once "db_connect.php";

$contaminated_id = $_POST['contaminated_id'];
$contaminated_date = $_POST['contaminated_date'];
$product_name = $_POST['product_name'];
$operator_number = $_POST['operator_number'];
$contaminated_quantity = $_POST['contaminated_quantity'];

$sql = "UPDATE contaminated_plants SET contaminated_date='$contaminated_date', product_name='$product_name', operator_number='$operator_number', contaminated_quantity='$contaminated_quantity' WHERE contaminated_id='$contaminated_id'";

if ($connect->query($sql) === TRUE) {
    header("Location: ../editContaminated.php?edit=1&id=$contaminated_id");
} else {
    echo "Error updating record: " . $connect->error;
}

$connect->close();
?>
