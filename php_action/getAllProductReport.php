<?php

// Include necessary files and configurations
require_once 'core.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get start date and end date from the form
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    // Prepare SQL query to fetch products within the specified date range from product table
    $sql_products = "SELECT * FROM product WHERE product_date >= '$startDate' AND product_date <= '$endDate'";

    // Execute the query to fetch products from product table
    $result_products = $connect->query($sql_products);

    // Check if any products are found in the product table
    if ($result_products->num_rows > 0) {
        // Display product report
        echo '<div class="container my-4" style="padding: 16px 16px">';
        echo '<h2>Product Report</h2>';
        echo '<table class="table" border="1">';
        echo '<tr><th style="padding: 6px 10px;">Product Name</th><th style="padding: 6px 10px;">Product Date</th><th style="padding: 6px 10px;">Quantity</th><th style="padding: 6px 10px;">Rate</th><th style="padding: 6px 10px;">Wholesale</th><th style="padding: 6px 10px;">Thb</th></tr>';
        // Loop through each product fetched from product table
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
        // Additional row for editing quantity of product Datewise
        echo '<tr>';
        echo '<th colspan="6" style="padding: 6px 10px;">Added/Remove Quantity of product Datewise</th>';
        echo '</tr>';

        // Prepare SQL query to fetch data from edit_pdetail table
        $sql_edit_pdetail = "SELECT product_name, quantity, product_date FROM edit_pdetail";

        // Execute the query to fetch data from edit_pdetail table
        $result_edit_pdetail = $connect->query($sql_edit_pdetail);

        // Check if any data are found in the edit_pdetail table
        if ($result_edit_pdetail->num_rows > 0) {
            // Loop through each row fetched from edit_pdetail table
            while ($row = $result_edit_pdetail->fetch_assoc()) {
                echo '<tr>';
                echo '<td colspan="2" style="padding: 6px 10px;">' . $row['product_name'] . '</td>';
                echo '<td colspan="2" style="padding: 6px 10px;">' . $row['quantity'] . '</td>';
                echo '<td colspan="2" style="padding: 6px 10px;">' . $row['product_date'] . '</td>';
                echo '</tr>';
            }
        } else {
            // No data found in the edit_pdetail table
            echo '<tr><td colspan="3">No data found in the edit_pdetail table.</td></tr>';
        }

        echo '</table>';
        echo '</div>';
    } else {
        // No products found for the specified date range
        echo 'No products found for the specified date range.';
    }

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
