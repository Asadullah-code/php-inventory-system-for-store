<?php    

require_once 'core.php';

// Check if POST data is set
if(isset($_POST['orderId'])) {
    $orderId = $_POST['orderId'];

    // Prepare and execute the SQL query
    $sql = "SELECT p.product_name,
       oi.product_price_type,
       SUM(oi.quantity) AS total_quantity,
       o.order_date,
       o.client_name,
       o.client_contact,
       o.client_address,
       o.client_email,
       o.sub_total,
       o.vat,
       o.total_amount,
       o.shipping,
       o.discount,
       o.phytosanitary,
       o.grand_total,
       o.paid,
       o.due,
       o.payment_place,
       o.gstn
FROM order_item AS oi
JOIN orders AS o ON oi.order_id = o.order_id
JOIN product AS p ON oi.product_id = p.product_id
WHERE oi.order_id = $orderId
GROUP BY p.product_name, oi.product_price_type, o.order_date, o.client_name, o.client_contact, o.client_address, o.client_email, o.sub_total, o.vat, o.total_amount, o.shipping, o.discount, o.phytosanitary, o.grand_total, o.paid, o.due, o.payment_place, o.gstn
";

    $orderResult = $connect->query($sql);

    // Check if the query executed successfully
    if($orderResult) {
        // Initialize counter variable
        $counter = 0;

        // Fetch each row from the result set
        while($orderData = $orderResult->fetch_assoc()) {
            // Increment the counter for each row
            $counter++;

            // Retrieve data from the current row
            $orderDate = $orderData['order_date'];
            $productName = $orderData['product_name'];
            $clientName = $orderData['client_name'];
            $clientContact = $orderData['client_contact']; 
            $clientAddress = $orderData['client_address']; 
            $clientEmail = $orderData['client_email']; 
            $subTotal = $orderData['sub_total'];
            $vat = $orderData['vat'];
            $totalAmount = $orderData['total_amount']; 
            $shipping = $orderData['shipping'];
            $discount = $orderData['discount'];
            $phytosanitary = $orderData['phytosanitary'];
            $quantity = $orderData['total_quantity'];
            $grandTotal = $orderData['grand_total'];
            $paid = $orderData['paid'];
            $due = $orderData['due'];
            $payment_type = $orderData['product_price_type'];
            $payment_place = $orderData['payment_place'];
            $gstn = $orderData['gstn'];

    }

?>


<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Invoice</title>
   <style>
      body {
         margin: 0 !important;
         padding: 0 !important;
         box-sizing: border-box;
         font-size: 11px !important;
      }
      body h3{
         font-size: 18px !important;
      }
      .table {
         border: 2px solid #000 !important;
         border-collapse: collapse;
         width: 100%;
      }
      th, td {
         border: 2px solid #000 !important;
         padding: 4px;
         text-align: left;
         font-size: 11px !important;
      }
   </style>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
   <div class="container-fluid" style="border: 2px solid #000;">
      <div class="row">
         <div class="col-12 d-flex align-items-center justify-content-center" style="border: 2px solid #000;">
            <h2 class="text-dark text-center">Invoice</h2>
         </div>
         <div class="col-md-6 col-12 d-flex flex-column">
            <p class="fw-semibold">Shipper: <span>Company Address and Address</span></p>
            <br>
            <p class="fw-semibold">Tel: <a href="tel: +94-71795-5888">+94-71795-5888</a></p>
            <p class="fw-semibold">Email: <a href="mailto: dilangamanoj@gmail.com">dilangamanoj@gmail.com</a></p>
            <br>
            <p class="fw-semibold">Consignee: <span><?php echo $clientName; ?></span><br>
               Address:<span> <?php echo $clientAddress ?></span></p>
            <p class="fw-semibold">Tel: <a href="tel: <?php echo $clientContact; ?>"><?php echo $clientContact; ?></a></p>
            <p class="fw-semibold">Email: <a href="mailto: <?php echo $clientEmail; ?>"><?php echo $clientEmail; ?></a></p>
         </div>
         <div class="col-md-6 col-12 d-flex flex-column" style="border-left: 2px solid #000;">
            <p class="fw-semibold text-end">Date: <span class="text-danger"><?php echo $orderDate; ?></span></p>
            <p class="fw-semibold text-end">Inv No: <span class="text-danger">SE11</span></p>
         </div>
         <div class="col-12">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" style="width: 10% !important;">Item</th>
                  <th scope="col" style="width: 50% !important;">Description</th>
                  <th scope="col" style="width: 15% !important;">Qty<br>(Bag/Flask)</th>
                  <th scope="col" style="width: 15% !important;">Unit/<br>Price</th>
                  <th scope="col" style="width: 20% !important;">Amount<br> USD</th>
                  <!-- <th scope="col" style="width: 10% !important;">Shipping</th>
                  <th scope="col" style="width: 10% !important;">Phytosanitary</th>
                  <th scope="col" style="width: 10% !important;">Paypal 5%<br> Charges</th> -->
                </tr>
              </thead>
              <tbody>
                

                 <?php    

require_once 'core.php';

// Check if POST data is set
if(isset($_POST['orderId'])) {
    $orderId = $_POST['orderId'];

    // Prepare and execute the SQL query
    $sqlReport = "SELECT p.product_name,
       oi.product_price_type,
       SUM(oi.quantity) AS total_quantity,
       oi.total,
       o.order_date,
       o.client_name,
       o.client_contact,
       o.client_address,
       o.client_email,
       o.sub_total,
       o.vat,
       o.total_amount,
       o.shipping,
       o.discount,
       o.phytosanitary,
       o.grand_total,
       o.paid,
       o.due,
       o.payment_place,
       o.gstn
FROM order_item AS oi
JOIN orders AS o ON oi.order_id = o.order_id
JOIN product AS p ON oi.product_id = p.product_id
WHERE oi.order_id = $orderId
GROUP BY p.product_name, oi.product_price_type, o.order_date, o.client_name, o.client_contact, o.client_address, o.client_email, o.sub_total, o.vat, o.total_amount, o.shipping, o.discount, o.phytosanitary, o.grand_total, o.paid, o.due, o.payment_place, o.gstn
";

    $orderResult = $connect->query($sqlReport); // Changed variable name from $orderResultOrder to $orderResult

    // Check if the query executed successfully
    if($orderResult) { // Changed variable name from $orderResultOrder to $orderResult
        // Initialize counter variable
        $counter = 0;

        // Fetch each row from the result set
        while($order = $orderResult->fetch_assoc()) { // Changed variable name from $orderResultOrder to $orderResult
            // Increment the counter for each row
            $counter++;

            // Fetching values from the fetched row
            $productName = $order['product_name'];
            $quantity = $order['total_quantity'];
            $payment_type = $order['product_price_type'];
            $total = $order['total'];
            $shipping = $order['shipping'];
            $phytosanitary = $order['phytosanitary'];
            $gstn = $order['gstn'];
            $grand_total = $order['grand_total'];
            $vat = $order['vat'];

            // Outputting table rows
            echo '<tr>';
            echo '<td>' . $counter . '</td>';
            echo '<td>' . $productName . '</td>';
            echo '<td>' . $quantity . '</td>';
            echo '<td>' . $payment_type . '</td>';
            echo '<td>' . $total . '</td>';
            //echo '<td>' . $shipping . '</td>';
            //echo '<td>' . $phytosanitary . '</td>';
            //echo '<td>' . $gstn . '</td>';
            echo '</tr>';
        }

        echo '<tr>';
        echo '<th class="text-center" scope="row" colspan="2">phytosanitary</th>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td>' . $phytosanitary . '</td>'; // Assuming $totalAmount is the total amount for the order
        echo '</tr>';

        echo '<tr>';
        echo '<th class="text-center" scope="row" colspan="2">shipping</th>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td>' . $shipping . '</td>'; // Assuming $totalAmount is the total amount for the order
        echo '</tr>';

        echo '<tr>';
        echo '<th class="text-center" scope="row" colspan="2">paypal charges 5%</th>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td>' . $vat . '</td>'; // Assuming $totalAmount is the total amount for the order
        echo '</tr>';
        
        // Outputting total row
        echo '<tr>';
        echo '<th class="text-center" scope="row" colspan="2">Total</th>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td>' . $grand_total . '</td>'; // Assuming $totalAmount is the total amount for the order
        echo '</tr>';
    } else {
        // Query execution failed
        echo 'Query execution failed.';
    }
} else {
    // POST data not set
    echo 'No order ID provided.';
}
?>

              </tbody>
            </table>
            <div class="col-12 d-flex align-items-start justify-content-start flex-column">
               <p><b>Payment detail as below:</b>bank detail of company</p>
               <p>Bank Holder's name:</p>
               <p>Saving account no.:</p>
               <p>Bank Name:</p>
               <p>Address:</p>
               <p>Postcode:</p>
               <p>Email: dilangam@yahoo.com</p>
            </div>
         </div>
         
      </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>




        
    <?php } else {
        // Query execution failed
        echo "Error: " . $connect->error;
    }
} else {
    // POST data not set
    echo "Error: Missing POST data";
}
?>
