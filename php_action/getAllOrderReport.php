<?php 

require_once 'core.php';

if($_POST) {
    // Sanitize input to prevent SQL injection
    $startDate = mysqli_real_escape_string($connect, $_POST['startDate']);
    $endDate = mysqli_real_escape_string($connect, $_POST['endDate']);

    // Convert date formats
    $start_date = date('Y-m-d', strtotime($startDate));
    $end_date = date('Y-m-d', strtotime($endDate));

    // Fetch data from the database
    $sql = "SELECT * FROM orders WHERE order_status = 1";

    $query = $connect->query($sql);

    if ($query->num_rows > 0) { ?>
        <table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
            <tr>
                <th>Order Date</th>
                <th>Client Name</th>
                <th>Client Number</th>
                <th>Client Address</th>
                <th>Client Email</th>
                <th>Shipping</th>
                <th>Discount</th>
                <th>Phytosanitary</th>
                <th>Gst 5%</th>
                <th>Total $</th>
            </tr>
            <?php while ($result = $query->fetch_assoc()) { ?>
                <tr>
                    <td><center><?php echo $result['order_date'] ; ?></center></td>
                    <td><center><?php echo $result['client_name'] ; ?></center></td>
                    <td><center><?php echo $result['client_contact'] ; ?></center></td>
                    <td><center><?php echo $result['client_address'] ; ?></center></td>
                    <td><center><?php echo $result['client_email'] ; ?></center></td>
                    <td><center><?php echo $result['shipping'] ; ?></center></td>
                    <td><center><?php echo $result['discount'] ; ?></center></td>
                    <td><center><?php echo $result['phytosanitary'] ; ?></center></td>
                    <td><center><?php echo $result['gstn'] ; ?></center></td>
                    <td><center><?php echo $result['total_amount'] ; ?></center></td>
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
                        $total_amount += $result['total_amount'];
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
