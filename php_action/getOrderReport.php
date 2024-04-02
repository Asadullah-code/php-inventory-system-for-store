<?php 

require_once 'core.php';

if($_POST) {
    // Sanitize input to prevent SQL injection
    $startDate = mysqli_real_escape_string($connect, $_POST['startDate']);
    $endDate = mysqli_real_escape_string($connect, $_POST['endDate']);
    $product_price_type = mysqli_real_escape_string($connect, $_POST['product_price_type']);

    // Convert date formats
    $start_date = date('Y-m-d', strtotime($startDate));
    $end_date = date('Y-m-d', strtotime($endDate));

    // Fetch data from the database
    $sql = "SELECT 
            orders.*, 
            GROUP_CONCAT(DISTINCT order_item.product_price_type) AS product_price_types 
        FROM 
            orders 
        JOIN 
            order_item ON orders.order_id = order_item.order_id 
        WHERE 
            orders.order_date >= '$start_date' 
            AND orders.order_date <= '$end_date' 
            AND order_item.product_price_type = '$product_price_type' 
            AND orders.order_status = 1 
        GROUP BY 
            orders.order_id";

    $query = $connect->query($sql);

    if ($query->num_rows > 0) { ?>
        <table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
            <tr>
                <th>Order Date</th>
                <th>Client Name</th>
                <th>Contact</th>
                <th>Price</th>
                <th>Price Type</th>
            </tr>
            <?php while ($result = $query->fetch_assoc()) { ?>
                <tr>
                    <td><center><?php echo $result['order_date'] ; ?></center></td>
                    <td><center><?php echo $result['client_name'] ; ?></center></td>
                    <td><center><?php echo $result['client_contact'] ; ?></center></td>
                    <td><center><?php echo $result['grand_total'] ; ?></center></td>
                    <td><center><?php echo $result['product_price_types'] ; ?></center></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3"><center>Total Amount</center></td>
                <td colspan="2"><center>
                    <?php
                    // Calculate and display total amount
                    $total_amount = 0;
                    $query->data_seek(0); // Reset pointer to first row
                    while ($result = $query->fetch_assoc()) {
                        $total_amount += $result['grand_total'];
                    }
                    echo $total_amount;
                    ?>
                </center></td>
            </tr>
        </table>
    <?php } else {
        echo "No records found.";
    }
} else {
    echo "Form data not submitted.";
}
?>
