<?php    

require_once 'core.php';

// Check if POST data is set
if(isset($_POST['orderId'])) {
    $orderId = $_POST['orderId'];

    // Prepare and execute the SQL query
    $sql = "SELECT order_date, client_name, client_contact, sub_total, vat, total_amount, discount, grand_total, paid, due, payment_place, gstn FROM orders WHERE order_id = $orderId";

    $orderResult = $connect->query($sql);

    // Check if the query executed successfully
    if($orderResult) {
        // Fetch the result as an associative array
        $orderData = $orderResult->fetch_assoc();

        // Assign variables for each column
        $orderDate = $orderData['order_date'];
        $clientName = $orderData['client_name'];
        $clientContact = $orderData['client_contact']; 
        $subTotal = $orderData['sub_total'];
        $vat = $orderData['vat'];
        $totalAmount = $orderData['total_amount']; 
        $discount = $orderData['discount'];
        $grandTotal = $orderData['grand_total'];
        $paid = $orderData['paid'];
        $due = $orderData['due'];
        $payment_place = $orderData['payment_place'];
        $gstn = $orderData['gstn'];

        // Close the database connection
        $connect->close();?>


<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title></title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
   <div class="container" style="border: 2px solid #000;">
      <div class="row d-flex">
         

         <div class="col-lg-12 col-md-12 col-12 d-flex align-items-center justify-content-center p-2" style="border: 2px solid #000;">
            <h2 class="text-dark text-center">Invoice</h3>
         </div>
         <div class="col-lg-6 col-md-12 col-12 d-flex align-items-center justify-content-start flex-column">
            <p class="fs-6 fw-semibold">Shipper: <span>Company Address and Address</span></p>
            <br>
            <br>
            <p class="fs-6 fw-semibold">Tel: <a href="tel: +94-71795-5888">+94-71795-5888</a></p>
            <p class="fs-6 fw-semibold">Email: <a href="mailto: dilangamanoj@gmail.com">dilangamanoj@gmail.com</a></p>
            <br>
            <br>
            <p class="fs-6 fw-semibold">Consignee: <span>Customer name and address <br>
               2360 WEBSTER CT,SANTA CIARA,<br> 
               california, 950513033<br>
               UNITED STATES
            </span></p>
            <p class="fs-6 fw-semibold">Tel: <a href="tel: 212232923873">212232923873</a></p>
            <p class="fs-6 fw-semibold">Email: <a href="mailto: qchenna@gmail.com">qchenna@gmail.com</a></p>
         </div>
         <div class="col-lg-6 col-md-12 col-12 d-flex align-items-center justify-content-end flex-column" style="border-left: 2px solid #000;">
            <p class="fs-6 fw-semibold">Date: <span class="text-danger">December 14, 2024</span></p>
            <p class="fs-6 fw-semibold">Inv No: <span class="text-danger">SE11</span></p>
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
