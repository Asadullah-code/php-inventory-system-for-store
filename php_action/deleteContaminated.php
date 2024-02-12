<?php
// Include the database connection file
include 'db_connect.php';

// Check if the ID of the record to be deleted is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize the ID to prevent SQL injection
    $id = mysqli_real_escape_string($connect, $_GET['id']);

    // Retrieve the contaminated_quantity of the record to be deleted
    $get_contaminated_quantity_sql = "SELECT contaminated_quantity, operator_number FROM contaminated_plants WHERE contaminated_id = '$id'";
    $result = $connect->query($get_contaminated_quantity_sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $contaminated_quantity = $row['contaminated_quantity'];
        $operator_number = $row['operator_number'];

        // SQL query to delete a record from the contaminated_plants table
        $delete_sql = "DELETE FROM contaminated_plants WHERE contaminated_id = '$id'";

        if ($connect->query($delete_sql) === TRUE) {
            // Add the contaminated_quantity back to operator_quantity
            $update_operator_sql = "UPDATE operators SET operator_quantity = operator_quantity + $contaminated_quantity WHERE operator_number='$operator_number'";
            if ($connect->query($update_operator_sql) === TRUE) {
                header("location: ../contaminated.php?delete=1");
            } else {
                echo "Error updating operator quantity: " . $connect->error;
            }
        } else {
            echo "Error deleting record: " . $connect->error;
        }
    } else {
        echo "Record not found.";
    }

    // Close the database connection
    $connect->close();
} else {
    echo "No ID provided for deletion.";
}
?>
