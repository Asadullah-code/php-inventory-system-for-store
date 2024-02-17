<?php

// Include necessary files and configurations
require_once 'core.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get start date and end date from the form
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $product_id = $_POST['product_id'];

    // Prepare SQL query to fetch products from "product" table within the specified date range
    $sql = "SELECT * FROM product WHERE product_date >= '$startDate' AND product_date <= '$endDate' AND product_id= '$product_id'";

    // Execute the query for "product" table
    $result = $connect->query($sql);

    // Check if any products are found in "product" table
    if ($result->num_rows > 0) {
        // Display product report
        echo'<div class="container my-4" style="padding: 16px 16px">';
        echo '<h2>Product Report</h2>';
        echo '<table class="table" border="1">';
        echo '<tr><th style="padding: 6px 10px;">Product Name</th><th style="padding: 6px 10px;">Product Date</th><th style="padding: 6px 10px;">Quantity</th><th style="padding: 6px 10px;">Rate</th><th style="padding: 6px 10px;">Wholesale</th><th style="padding: 6px 10px;">Thb</th></tr>';
        
        // Fetch data from "product" table
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td style="padding: 6px 10px;">' . $row['product_name'] . '</td>';
            echo '<td style="padding: 6px 10px;">' . $row['quantity'] . '</td>';
            echo '<td style="padding: 6px 10px;">' . $row['product_date'] . '</td>';
            echo '<td style="padding: 6px 10px;">' . $row['rate'] . '</td>';
            echo '<td style="padding: 6px 10px;">' . $row['wholesale'] . '</td>';
            echo '<td style="padding: 6px 10px;">' . $row['thb'] . '</td>';
            echo '</tr>';
            echo '</tr>';
            echo '</tr>';
            echo '</tr>';
        }

        // Fetch data from "edit_pdetail" table
        $sql_edit_pdetail = "SELECT * FROM edit_pdetail WHERE product_id = '$product_id'";
        $result_edit_pdetail = $connect->query($sql_edit_pdetail);
        
        // Check if any products are found in "edit_pdetail" table
        if ($result_edit_pdetail->num_rows > 0) {
                echo'<tr><tr>';
                echo'<td colspan="6" align="center" style="padding: 8px; font-size: 18px; font-weight: 600; text-align: center;">Later Add Qauntity Of Product Date wise</td>';
            while ($row_edit_pdetail = $result_edit_pdetail->fetch_assoc()) {
                echo '<tr>';
                echo '<td colspan="2" style="padding: 6px 10px;">' . $row_edit_pdetail['product_name'] . '</td>';
                echo '<td colspan="2" style="padding: 6px 10px;">' . $row_edit_pdetail['quantity'] . '</td>';
                echo '<td colspan="2" style="padding: 6px 10px;">' . $row_edit_pdetail['timeDate'] . '</td>';
                echo '</tr>';
            }
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
    // If the form is not submitted via POST, display an error message
    echo 'Error: Form not submitted.';
}

// Close database connection
$connect->close();

?>
