<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

  $productDate = $_POST['productDate'];
  $productName = $_POST['productName'];
  $quantity = $_POST['quantity'];
  $rate = $_POST['rate'];
  $wholesale = $_POST['wholesale'];
  $thb = $_POST['thb'];
  $productStatus = $_POST['productStatus'];

  // Use prepared statements to prevent SQL injection
  $stmt = $connect->prepare("INSERT INTO product (product_date, product_name, quantity, rate, wholesale, thb, active, status) 
                            VALUES (?, ?, ?, ?, ?, ?, 1, ?)");

  // Bind parameters
  $stmt->bind_param("sssssss", $productDate, $productName, $quantity, $rate, $wholesale, $thb, $productStatus);

  // Execute the statement
  if ($stmt->execute()) {
    $valid['success'] = true;
    $valid['messages'] = "Successfully Added";
  } else {
    $valid['success'] = false;
    $valid['messages'] = "Error while adding the members";
  }

  $stmt->close();

  $connect->close();

  echo json_encode($valid);
}
?>
