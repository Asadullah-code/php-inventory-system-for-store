<?php
// Include the database connection file
include 'db_connect.php';

// Check if the ID of the record to be deleted is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize the ID to prevent SQL injection
    $id = mysqli_real_escape_string($connect, $_GET['id']);

    // SQL query to delete a record from the operator table
    $sql = "DELETE FROM operators WHERE operator_id = '$id'";

    if ($connect->query($sql) === TRUE) {
        header("location: ../operator.php?delete=1");
    } else {
        echo "Error deleting record: " . $connect->error;
    }

    // Close the database connection
    $connect->close();
} else {
    echo "No ID provided for deletion.";
}
?>
