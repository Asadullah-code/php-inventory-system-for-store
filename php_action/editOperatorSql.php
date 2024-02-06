<?php
 require_once "db_connect.php";

 $operator_id=$_POST['operator_id'];
 $operator_date=$_POST['operator_date'];
 $operator_number=$_POST['operator_number'];
 $product_id=$_POST['product_id'];
 $operator_quantity=$_POST['operator_quantity'];

 $sql= "UPDATE operators SET operator_date='$operator_date', operator_number='$operator_number', product_id='$product_id', operator_quantity='$operator_quantity' WHERE operator_id='$operator_id'";
 if ($connect->query($sql) === TRUE) {
       header("Location: ../editOperator.php?edit=1&id=$operator_id");
        } else {
            echo "Error updating record: " . $connect->error;
        }

        $connect->close();
?>