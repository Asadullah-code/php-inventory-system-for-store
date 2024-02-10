<?php
// Include the database connection file
include 'db_connect.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize inputs
    $contaminated_date = date('Y-m-d', strtotime($_POST['contaminated_date']));
    $operator_number = $_POST['operator_number'];
    $product_name = $_POST['product_name'];
    $contaminated_quantity = $_POST['contaminated_quantity'];

    // SQL query to insert data into the contaminateds table
    $sql = "INSERT INTO contaminated_plants (contaminated_date, operator_number, product_name, contaminated_quantity) 
            VALUES ('$contaminated_date', '$operator_number', '$product_name', '$contaminated_quantity')";

    if ($connect->query($sql) === TRUE) {
        header("location: ../contaminated.php?status=1");
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }

}
?>
