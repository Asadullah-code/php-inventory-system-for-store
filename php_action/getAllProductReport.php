<?php

// Include necessary files and configurations
require_once 'core.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get start date and end date from the form
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    // Prepare SQL query to fetch products within the specified date range
    $sql_products = "SELECT * FROM product WHERE product_date >= '$startDate' AND product_date <= '$endDate'";
    $sql_edit_details = "SELECT edit_pdetail.*, product.product_name 
                         FROM edit_pdetail 
                         JOIN product ON edit_pdetail.product_id = product.product_id";

    // Execute the queries
    $result_products = $connect->query($sql_products);
    $result_edit_details = $connect->query($sql_edit_details);

    // Check if any products are found
    if ($result_products->num_rows > 0) {
        // Display product report
        echo '<div class="container my-4" style="padding: 16px 16px">';
        echo '<h2>Product Report</h2>';
        echo '<table class="table" border="1">';
        echo '<tr><th style="padding: 6px 10px;">Product Name</th><th style="padding: 6px 10px;">Product Date</th><th style="padding: 6px 10px;">Quantity</th><th style="padding: 6px 10px;">Rate</th><th style="padding: 6px 10px;">Wholesale</th><th style="padding: 6px 10px;">Thb</th></tr>';
        while ($row = $result_products->fetch_assoc()) {
            echo '<tr>';
            echo '<td style="padding: 6px 10px;">' . $row['product_name'] . '</td>';
            echo '<td style="padding: 6px 10px;">' . $row['product_date'] . '</td>';
            echo '<td style="padding: 6px 10px;">' . $row['quantity'] . '</td>';
            echo '<td style="padding: 6px 10px;">' . $row['rate'] . '</td>';
            echo '<td style="padding: 6px 10px;">' . $row['wholesale'] . '</td>';
            echo '<td style="padding: 6px 10px;">' . $row['thb'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</div>';
    } else {
        // No products found for the specified date range
        echo 'No products found for the specified date range.';
    }

    // Display Edit Product Detail table
    echo '<div class="container my-4" style="padding: 16px 16px">';
    echo '<h2>Edit Product Detail</h2>';
    echo '<table class="table" border="1">';
    echo '<tr><th style="padding: 6px 10px;">Product Name</th><th style="padding: 6px 10px;">New Quantity</th><th style="padding: 6px 10px;">New Rate</th><th style="padding: 6px 10px;">New Wholesale</th><th style="padding: 6px 10px;">New THB</th><th style="padding: 6px 10px;">Edit Date</th></tr>';
    while ($edit_detail = $result_edit_details->fetch_assoc()) {
        echo '<tr>';
        echo '<td style="padding: 6px 10px;">' . $edit_detail['product_name'] . '</td>';
        echo '<td style="padding: 6px 10px;">' . $edit_detail['quan_difference'] . '</td>';
        echo '<td style="padding: 6px 10px;">' . $edit_detail['rate_difference'] . '</td>';
        echo '<td style="padding: 6px 10px;">' . $edit_detail['wholesale_difference'] . '</td>';
        echo '<td style="padding: 6px 10px;">' . $edit_detail['thb_difference'] . '</td>';
        echo '<td style="padding: 6px 10px;">' . $edit_detail['timeDate'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';

    // JavaScript for auto redirection after 5 seconds
    echo '<script type="text/javascript">';
    echo 'setTimeout(function(){ window.print(); }, 5000);'; // Print after 5 seconds
    echo '</script>';

} else {
    // If the form is not submitted via POST, display an error message
    echo 'Error: Form not submitted.';
}

// Close database connection
$connect->close();

?>
