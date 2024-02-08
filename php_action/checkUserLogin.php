<?php
include 'db_connect.php'; // Assuming db_connect.php includes the database connection

// Retrieve username and password from the form submission
$username = $_POST['usernameU'];
$password = $_POST['passwordU'];

// Sanitize input to prevent SQL injection
$username = mysqli_real_escape_string($connect, $username);
$password = mysqli_real_escape_string($connect, $password);

// SQL query to check if the username and password match
$sql = "SELECT * FROM temp_user WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($connect, $sql);

// Check if the query executed successfully
if ($result) {
    // Check if a row is returned
    if (mysqli_num_rows($result) == 1) {
        // Username and password are correct, redirect to the dashboard
        header("Location: ".$store_url."dashboard.php");
        exit();
    } else {
        // Incorrect username or password, redirect back to the login form with an error message
        header("Location: index.php?error=incorrect_credentials");
        exit();
    }
} else {
    // Query execution failed, display MySQL error
    echo "Error: " . mysqli_error($connect);
}
?>
