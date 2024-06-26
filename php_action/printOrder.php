<?php    

require_once 'core.php';

// Check if POST data is set
if(isset($_POST['orderId'])) {
    $orderId = $_POST['orderId'];

    // Prepare and execute the SQL query
    $sql = "SELECT p.product_name,
       oi.product_price_type,
       SUM(oi.quantity) AS total_quantity,
       o.order_id,
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
            $orderId = $orderData['order_id'];
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
      .table, th {
         border: 0.5px solid #000 !important;
         border-collapse: collapse;
         width: 100%;
      }
      td {
         border: 0.1px solid #000 !important;
      }
      .text{
        text-align: right;
      }
      
   </style>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
   <div class="container-fluid" style="border: 2px solid #000;">
      <div class="row" style="margin: 0px !important;">
         <div class="col-12 d-flex align-items-center justify-content-center" style="border: 2px solid #000;">
            <h2 class="text-dark text-center">Invoice</h2>
         </div>
         <div class="col-md-6 col-12 d-flex flex-column">
            <p class="fw-semibold">Shipper: <span>Growth Revolution Co. Ltd 05755650008533855<br>Thasud Sub District, Muang-Chiangrai District, Chiangrai 57100<br> Thailand</span></p>
            <br>
            <p class="fw-semibold">Tel: <a href="tel: +94-71795-5888">+94-71795-5888</a></p>
            <p class="fw-semibold">Email: <a href="mailto: growthrevolution1@gmail.com">growthrevolution1@gmail.com</a></p>
            <br>
            <p class="fw-semibold">Consignee: <span><?php echo $clientName; ?></span><br>
               Address:<span> <?php echo $clientAddress ?></span></p>
            <p class="fw-semibold">Tel: <a href="tel: <?php echo $clientContact; ?>"><?php echo $clientContact; ?></a></p>
            <p class="fw-semibold">Email: <a href="mailto: <?php echo $clientEmail; ?>"><?php echo $clientEmail; ?></a></p>
         </div>
         <div class="col-md-6 col-12 d-flex flex-column">
            <p class="fw-semibold text-end">Date: <span class="text-danger"><?php echo $orderDate; ?></span></p>
            <p class="fw-semibold text-end">Inv No: <span class="text-danger">SE<?php echo $orderId; ?></span></p>
         </div>
         <div class="col-12">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" style="width: 10% !important;">Item</th>
                  <th scope="col" style="width: 50% !important;">Description</th>
                  <th scope="col" style="width: 15% !important;">Qty<br>(Bag/Flask)</th>
                  <th scope="col" style="width: 15% !important;">Unit/<br>Price</th>
                  <th scope="col" style="width: 20% !important;">Amount<br> <span class="text-uppercase">
                    <?php
                    if ($payment_type == 'thb') {
                        echo "THB";
                    }else{
                        echo "USD";
                    }
                        
                      ?>
                        
                    </span></th>
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
       oi.rate,
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
       o.payment_type,
       o.grand_total,
       o.paid,
       o.due,
       o.payment_place,
       o.gstn
FROM order_item AS oi
JOIN orders AS o ON oi.order_id = o.order_id
JOIN product AS p ON oi.product_id = p.product_id
WHERE oi.order_id = $orderId
GROUP BY p.product_name, oi.rate, o.order_date, o.client_name, o.client_contact, o.client_address, o.client_email, o.sub_total, o.vat, o.total_amount, o.shipping, o.discount, o.phytosanitary, o.payment_type, o.grand_total, o.paid, o.due, o.payment_place, o.gstn
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
            $payment_type = $order['rate'];
            $total = $order['total'];
            $shipping = $order['shipping'];
            $discount = $order['discount'];
            $phytosanitary = $order['phytosanitary'];
            $gstn = $order['gstn'];
            $grand_total = $order['grand_total'];
            $vat = $order['vat'];
            $paymentMethod = $order['payment_type'];

            // Outputting table rows
            echo '<tr>';
            echo '<td>' . $counter . '</td>';
            echo '<td>' . $productName . '</td>';
            echo '<td>' . $quantity . '</td>';
            echo '<td>' . $payment_type . '</td>';
            echo '<td class="text">' . $total . '</td>';
            //echo '<td>' . $shipping . '</td>';
            //echo '<td>' . $phytosanitary . '</td>';
            //echo '<td>' . $gstn . '</td>';
            echo '</tr>';
        }

        echo '<tr>';
        echo '<th class="text-center" scope="row" colspan="2">phytosanitary</th>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td class="text">' . $phytosanitary . '.00</td>'; // Assuming $totalAmount is the total amount for the order
        echo '</tr>';

        echo '<tr>';
        echo '<th class="text-center" scope="row" colspan="2">shipping</th>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td class="text">' . $shipping . '.00</td>'; // Assuming $totalAmount is the total amount for the order
        echo '</tr>';


        if ($discount != 0) {
        echo '<tr>';
        echo '<th class="text-center" scope="row" colspan="2">discount</th>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td class="text">' . $discount . '.00</td>'; // Assuming $totalAmount is the total amount for the order
        echo '</tr>';
        }
        
            if ($paymentMethod == 1) {
        echo '<tr>';
        echo '<th class="text-center" scope="row" colspan="2">5%</th>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td class="text">' . $vat . '</td>'; // Assuming $totalAmount is the total amount for the order
        echo '</tr>';
        } else {
                echo '';
        }
            
        // Outputting total row
        echo '<tr>';
        echo '<th class="text-center" scope="row" colspan="2">Total</th>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td class="text">' . $grand_total . '</td>'; // Assuming $totalAmount is the total amount for the order
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

            <!-- Check if gstn is not null -->
    <?php if ($paymentMethod == 1): ?>
        <div class="col-12 d-flex align-items-start justify-content-start">
            <p>Payment Detail:<b>DILANGAMANOJ@gmail.com</b></p>
            
        </div>
    <?php elseif ($paymentMethod == 2): ?>
        <div class="col-12 d-flex align-items-start justify-content-start flex-column westernAddress">
            <b>Payment detail as below:</b><br>
            <p>bank detail of company</p>
            <p>Bank Holder's name: PREEYAPORN</p>
            <p>Bank Holder's surname: TALUENGJIT</p>
            <p>Address: 5/93 LADPRAW RD., SOI 17 JOMPHON, CHAUTUJAK, BANGKOK 10900 THAILAND</p>
            <p>Mobile: +66 8 96651315</p>
            <p>Bank Account No.: 098-0-343990</p>
            <p>Bank Name: BANGKOK BANK PUBLIC COMPANY LIMITED</p>
            <p>Bank Branch: CENTRAL PLAZA GRAND RAMA 9</p>
            <p>Bank Address: 9/8-9 RAMA 9 RD., HUAI KHWANG, BANGKOK 10310 THAILAND</p>
            <p>Bank Address: +66 2 1603829</p>
            <p>SWIFT CODE: BKKBTHBK</p>
        </div>
    <?php else: ?>
        <div class="col-12 d-flex align-items-start justify-content-start flex-column paypalAddress">
            <b>Payment detail as below:</b><br>
            <p>bank detail of company</p>
            <p>Bank Holder's name: Growth Revolution Co.Ltd</p>
            <p>Saving account no.: 033-4-34153-4</p>
            <p>Bank Name: Siam Commercial Bank</p>
            <p>Address: 514/58 Moo 1, Thasood Sub-District, Muangchiangrai District</p>
            <p>City/Province: Chiangrai, Country: THAILAND,</p>
            <p>Postcode: 57100</p>
            <p>Email: p_taluengjit@yahoo.com</p>
        </div>
    <?php endif; ?>
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
