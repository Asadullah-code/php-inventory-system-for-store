<?php
// Include the database connection file
include 'db_connect.php';

$sqlProduct = "SELECT * FROM product";
$resultProduct = $connect->query($sqlProduct);

    // Check if there are any results
    if ($resultProduct->num_rows > 0) {
        // Output data of each row using a while loop
        while ($rowProduct = $resultProduct->fetch_assoc()) {
            $quantity = $rowProduct['quantity'];
        }
    }

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize inputs
    $contaminated_date = date('Y-m-d', strtotime($_POST['contaminated_date']));
    $operator_number = $_POST['operator_number'];
    $product_id = $_POST['product_id'];
    $contaminated_quantity = $_POST['contaminated_quantity'];

    // SQL query to insert data into the contaminateds table
    $sql = "INSERT INTO contaminated_plants (contaminated_date, operator_number, product_id, contaminated_quantity) 
            VALUES ('$contaminated_date', '$operator_number', '$product_id', '$contaminated_quantity')";

    if ($connect->query($sql) === TRUE) {
        // SQL query to update operator_quantity in operators table
        $update_sql = "UPDATE product 
           SET quantity = $quantity - $contaminated_quantity 
           WHERE product_id = '$product_id'";
        
        if ($connect->query($update_sql) === TRUE) {
            header("location: ../contaminated.php?status=1");
        } else {
            echo "Error updating operator quantity: " . $connect->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }
}
?>
