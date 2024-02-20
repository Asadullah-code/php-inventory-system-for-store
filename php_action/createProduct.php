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
    // Insert into edit_pdetail table
    $editStmt = $connect->prepare("INSERT INTO edit_pdetail (product_name, quantity, product_date) 
                                    VALUES (?, ?, ?)");
    
    // Bind parameters
    $editStmt->bind_param("sss", $productName, $quantity, $productDate);
    
    // Execute the statement
    if ($editStmt->execute()) {
      $valid['success'] = true;
      $valid['messages'] = "Successfully Added";
    } else {
      $valid['success'] = false;
      $valid['messages'] = "Error while adding details to edit_pdetail table";
    }
    
    $editStmt->close();
  } else {
    $valid['success'] = false;
    $valid['messages'] = "Error while adding the members";
  }

  $stmt->close();

  $connect->close();

  echo json_encode($valid);
}
?>
