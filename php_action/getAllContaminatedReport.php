<?php

// Include necessary files and configurations
require_once 'core.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get start date and end date from the form and sanitize inputs
    $startDate = $connect->real_escape_string($_POST['startDate']);
    $endDate = $connect->real_escape_string($_POST['endDate']);

    // Prepare SQL query to fetch products within the specified date range
    $sql = "SELECT contaminated_plants.*, product.product_name FROM contaminated_plants JOIN product ON contaminated_plants.product_id = product.product_id WHERE contaminated_date >= '$startDate' AND contaminated_date <= '$endDate'";

    // Execute the query
    $result = $connect->query($sql);

    // Check if any products are found
    if ($result) {
        if ($result->num_rows > 0) {
            // Display product report
            echo '<div class="container my-4" style="padding: 16px 16px">';
            echo '<h2>Contaminated Report</h2>';
            echo '<table class="table" border="1">';
            echo '<tr><th style="padding: 6px 10px;">Product Name</th><th style="padding: 6px 10px;">Quantity</th><th style="padding: 6px 10px;">Operator Number</th><th style="padding: 6px 10px;">Contaminated Date</th></tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td style="padding: 6px 10px;">' . $row['product_name'] . '</td>';
                echo '<td style="padding: 6px 10px;">' . $row['contaminated_quantity'] . '</td>';
                echo '<td style="padding: 6px 10px;">' . $row['operator_number'] . '</td>';
                echo '<td style="padding: 6px 10px;">' . $row['contaminated_date'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '</div>';

            // JavaScript for auto redirection after 5 seconds
            echo '<script type="text/javascript">';
            echo 'setTimeout(function(){ window.print(); }, 5000);'; // Print after 5 seconds
            echo '</script>';
        } else {
            // No products found for the specified date range
            echo 'No products found for the specified date range.';
        }
    } else {
        // SQL query execution failed
        echo 'Error: ' . $connect->error;
    }
} else {
    // If the form is not submitted via POST, display an error message
    echo 'Error: Form not submitted.';
}

// Close database connection
$connect->close();

?>
