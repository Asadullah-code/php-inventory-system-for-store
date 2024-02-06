<?php
// Include the database connection file
include 'db_connect.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize inputs
    $operator_date = date('Y-m-d', strtotime($_POST['operator_date']));
    $operator_number = $_POST['operator_number'];
    $product_id = $_POST['product_id'];
    $operator_quantity = $_POST['operator_quantity'];

    // SQL query to insert data into the operators table
    $sql = "INSERT INTO operators (operator_date, operator_number, product_id, operator_quantity) 
            VALUES ('$operator_date', '$operator_number', '$product_id', '$operator_quantity')";

    if ($connect->query($sql) === TRUE) {
        header("location: ../operator.php?status=1");
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }

}
?>
