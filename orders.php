<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 

if($_GET['o'] == 'add') { 
// add order
	echo "<div class='div-request div-hide'>add</div>";
} else if($_GET['o'] == 'manord') { 
	echo "<div class='div-request div-hide'>manord</div>";
} else if($_GET['o'] == 'editOrd') { 
	echo "<div class='div-request div-hide'>editOrd</div>";
} // /else manage order


?>

<ol class="breadcrumb">
  <li><a href="dashboard.php">Home</a></li>
  <li>Order</li>
  <li class="active">
  	<?php if($_GET['o'] == 'add') { ?>
  		Add Order
		<?php } else if($_GET['o'] == 'manord') { ?>
			Manage Order
		<?php } // /else manage order ?>
  </li>
</ol>


<h4>
	<i class='glyphicon glyphicon-circle-arrow-right'></i>
	<?php if($_GET['o'] == 'add') {
		echo "Add Order";
	} else if($_GET['o'] == 'manord') { 
		echo "Manage Order";
	} else if($_GET['o'] == 'editOrd') { 
		echo "Edit Order";
	}
	?>	
</h4>



<div class="panel panel-default">
	<div class="panel-heading">

		<?php if($_GET['o'] == 'add') { ?>
  		<i class="glyphicon glyphicon-plus-sign"></i>	Add Order
		<?php } else if($_GET['o'] == 'manord') { ?>
			<i class="glyphicon glyphicon-edit"></i> Manage Order
		<?php } else if($_GET['o'] == 'editOrd') { ?>
			<i class="glyphicon glyphicon-edit"></i> Edit Order
		<?php } ?>

	</div> <!--/panel-->	
	<div class="panel-body">
			
		<?php if($_GET['o'] == 'add') { 
			// add order
			?>			

			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/createOrder.php" id="createOrderForm">

			  <div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label">Order Date</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="orderDate" name="orderDate" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientName" class="col-sm-2 control-label">Client Name</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-2 control-label">Client Contact</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientContact" name="clientContact" placeholder="Contact Number" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientAddress" class="col-sm-2 control-label">Client Address</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientAddress" name="clientAddress" placeholder="Address" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientEmail" class="col-sm-2 control-label">Client Email</label>
			    <div class="col-sm-10">
			      <input type="email" class="form-control" id="clientEmail" name="clientEmail" placeholder="Email Address" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->			  

			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:30%;">Product</th>
			  			<th style="width:15%;">Price Type</th>
			  			<th style="width:15%;">Rate</th>
			  			<th style="width:15%;">Available Quantity</th>
			  			<th style="width:10%;">Quantity</th>
			  			<th style="width:15%;">Total</th>			  			
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php
			  		$arrayNumber = 0;
			  		for($x = 1; $x < 2; $x++) { ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>" data-rowId ="<?= $x; ?>">
			  				<td style="margin-left:20px;">
			  					<div class="form-group">

			  					<select class="form-control" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
			  						<option value="">~~SELECT~~</option>
			  						<?php
			  							$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 AND quantity != 0";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."'>".$row['product_name']."</option>";
										 	} // /while 

			  						?>
		  						</select>
								
			  					</div>
			  				</td>
			  				<td style="padding-left:30px;">
			  					<div class="form-group">
			  					<select class="form-control" name="price_type[]" id="price_type<?php echo $x; ?>"  onchange="getProductRateWiseData(this,<?php echo $x; ?>)">
			  						<option value="">price type</option>
                        <option value="rate">Rate</option>
                        <option value="wholesale">WholeSale</option>
                        <option value="thb">Thb</option>
                    </select>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">
			  					<input type="text" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />			  					
			  					<input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
			  				
							<td style="padding-left:20px;">
			  					<div class="form-group form-control">
									<p id="available_quantity<?php echo $x; ?>"></p>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
			  				<td>

			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="subTotal" class="col-sm-3 control-label">Sub Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
				    </div>
				  </div> <!--/form-group-->			  
				   <!--/form-group-->	<input type="hidden" class="form-control" id="totalAmount" name="totalAmount" disabled="true"/>
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />		  
				  <!-- <div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Total Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true"/>
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
				    </div>
				  </div> -->
				   <!--/form-group-->			  
				  <div class="form-group">
				    <label for="shipping_cost" class="col-sm-3 control-label">Shipping Cost</label>
				    <div class="col-sm-9">
				      <input type="number" class="form-control" id="shipping_cost" name="shipping" onkeyup="addShippingCostToTotal(this)" autocomplete="off" />
				    </div>
				  </div> <!--/form-group-->	
				  <div class="form-group">
				    <label for="discount" class="col-sm-3 control-label">Discount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" />
				    </div>
				  </div> <!--/form-group-->	
				  <!-- <div class="form-group">
				    <label for="phytosanitary" class="col-sm-3 control-label">Phytosanitary</label>
				    <div class="col-sm-9">
				      <input type="number" class="form-control" id="phytosanitary" name="phytosanitary" autocomplete="off" />
				    </div>
				  </div> --> <!--/form-group-->	
				<p>  <div class="form-group">
				    <label for="vat" class="col-sm-3 control-label gst">GST 5%</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="vat" name="gstn" readonly="true" />
				      <input type="hidden" class="form-control" id="vatValue" name="vatValue" />
				    </div>
				  </div>	</p>  		  
				  <div class="form-group">
				    <label for="grandTotal" class="col-sm-3 control-label">Grand Total</label>
				    <div class="col-sm-9">
				      <input type="number" class="form-control" id="grandTotal" name="grandTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" />
				    </div>
				  </div> <!--/form-group-->	
			  </div> <!--/col-md-6-->

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="paid" class="col-sm-3 control-label">Paid Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="due" class="col-sm-3 control-label">Due Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="due" name="due" disabled="true" />
				      <input type="hidden" class="form-control" id="dueValue" name="dueValue" />
				    </div>
				  </div> <!--/form-group-->		
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentType" id="paymentType">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">PayPal</option>
				      	<option value="2">Western Union</option>
				      	<option value="3">Wise</option>
								<option value="4">Bank Transfer</option>
								<option value="5">Cash</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->							  
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentStatus" id="paymentStatus">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">paid</option>
				      	<option value="2">Payment Proccessing</option>
				      	<option value="3">No Payment</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Place</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentPlace" id="paymentPlace">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">USA</option>
				      	<option value="2">EU</option>
								<option value="3">UK</option>
								<option value="4">canada</option>
								<option value="5">Singapore</option>
								<option value="6">Hongkong</option>
								<option value="7">Norway</option>
								<option value="8">Switxerland</option>
								<option value="9"> Alaska & Hawaii</option>
								<option value="10">AUS</option>
								<option value="11">Other</option>
				      </select>
				      <div id="otherPlace" class="mt-3" style="display: none;">
							  <label for="otherInput">Other Location:</label>
							  <input type="text" class="form-control" id="otherInput" name="otherInput">
							</div>
							<script>
							document.addEventListener("DOMContentLoaded", function() {
							  var paymentPlaceSelect = document.getElementById("paymentPlace");
							  var otherPlaceDiv = document.getElementById("otherPlace");
							  var otherInput = document.getElementById("otherInput");

							  paymentPlaceSelect.addEventListener("change", function() {
							    if (paymentPlaceSelect.value === "11") {
							      otherPlaceDiv.style.display = "block";
							    } else {
							      otherPlaceDiv.style.display = "none";
							      otherInput.value = ""; // Reset the input field when not selecting "Other"
							    }
							  });
							  
							  // Add an event listener to the input field to update the select value
							  otherInput.addEventListener("input", function() {
							    if (paymentPlaceSelect.value === "11") {
							      paymentPlaceSelect.value = otherInput.value;
							    }
							  });
							});
							</script>
				    </div>
				  </div> <!--/form-group-->							  
			  </div> <!--/col-md-6-->


			  <div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			    <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>

			      <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>

			      <button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> Reset</button>
			    </div>
			  </div>
			</form>
		<?php } else if($_GET['o'] == 'manord') { 
			// manage order
			?>

			<div id="success-messages"></div>
			
			<table class="table" id="manageOrderTable">
				<thead>
					<tr>
						<th>#</th>
						<th>Order Date</th>
						<th>Client Name</th>
						<th>Contact</th>
						<th>Total Order Item</th>
						<th>Payment Status</th>
						<th>Option</th>
					</tr>
				</thead>
			</table>

		<?php 
		// /else manage order
		} else if($_GET['o'] == 'editOrd') {
			// get order
			?>
			
			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/editOrder.php" id="editOrderForm">

  			<?php $orderId = $_GET['i'];

  			$sql = "SELECT orders.order_id, orders.order_date, orders.client_name, orders.client_contact, orders.client_address, orders.client_email, orders.sub_total, orders.vat, orders.total_amount, orders.shipping, orders.discount, orders.grand_total, orders.paid, orders.due, orders.payment_type, orders.payment_status,orders.payment_place,orders.gstn FROM orders 	
					WHERE orders.order_id = {$orderId}";

				$result = $connect->query($sql);
				$data = $result->fetch_row();
  			?>

			  <div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label">Order Date</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="orderDate" name="orderDate" autocomplete="off" value="<?php echo $data[1] ?>" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientName" class="col-sm-2 control-label">Client Name</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" autocomplete="off" value="<?php echo $data[2] ?>" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-2 control-label">Client Contact</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientContact" name="clientContact" placeholder="Contact Number" autocomplete="off" value="<?php echo $data[3] ?>" />
			    </div>
			  </div> <!--/form-group-->			  
			  <div class="form-group">
			    <label for="clientAddress" class="col-sm-2 control-label">Client Address</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientAddress" name="clientAddress" placeholder="Contact Number" autocomplete="off" value="<?php echo $data[4] ?>" />
			    </div>
			  </div> <!--/form-group-->	
			  <div class="form-group">
			    <label for="clientEmail" class="col-sm-2 control-label">Client Email</label>
			    <div class="col-sm-10">
			      <input type="email" class="form-control" id="clientEmail" name="clientEmail" placeholder="Client Email" autocomplete="off" value="<?php echo $data[5] ?>" />
			    </div>
			  </div> <!--/form-group-->	
			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:25%;">Product</th>
			  			<th style="width:15%;">Price Type</th>
			  			<th style="width:10%;">Rate</th>
			  			<th style="width:10%;">Available Quantity</th>			  			
			  			<th style="width:15%;">Quantity</th>			  			
			  			<th style="width:15%;">Total</th>			  			
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php

			  		$orderItemSql = "SELECT order_item.order_item_id,product_price_type, order_item.order_id, order_item.product_id, order_item.quantity, order_item.rate, order_item.total FROM order_item WHERE order_item.order_id = {$orderId}";
						$orderItemResult = $connect->query($orderItemSql);
						// $orderItemData = $orderItemResult->fetch_all();						
						
						// print_r($orderItemData);
			  		$arrayNumber = 0;
			  		// for($x = 1; $x <= count($orderItemData); $x++) {
			  		$x = 1;
			  		while($orderItemData = $orderItemResult->fetch_array()) { 
			  			// print_r($orderItemData); ?>
			  			<tr id="row<?php echo $x; ?>" data-rowId = "<?= $x?>"class="<?php echo $arrayNumber; ?>">
			  				<td style="padding-right:20px;">
			  					<div class="form-group">

			  					<select class="form-control" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
			  						<option value="">~~SELECT~~</option>
			  						<?php
			  							$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 AND quantity != 0";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								$selected = "";
			  								if($row['product_id'] == $orderItemData['product_id']) {
			  									$selected = "selected";
			  								} else {
			  									$selected = "";
			  								}

			  								echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."' ".$selected." >".$row['product_name']."</option>";
										 	} // /while 

			  						?>
		  						</select>
			  					</div>
			  				</td>
                <td style="padding-left:20px;">
                    <div class="form-group">
                        <select class="form-control" name="price_type[]" id="price_type<?php echo $x; ?>"  onchange="getProductRateWiseData(this,<?php echo $x; ?>)">
                            <option value="">Select price type</option>

                            <option value="rate"<?= $orderItemData['product_price_type'] === "rate"  ? "selected" : "" ?>>Rate</option>
                            <option value="wholesale"<?= $orderItemData['product_price_type'] === "wholesale"  ? "selected" : "" ?>>WholeSale</option>
                            <option value="thb"<?= $orderItemData['product_price_type'] === "thb"  ? "selected" : "" ?>>Thb</option>
                        </select>

                    </div>
                </td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" value="<?php echo $orderItemData['rate']; ?>" />
			  					<input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $orderItemData['rate']; ?>" />
			  				</td>
							<td style="padding-left:20px;">
			  					<div class="form-group">
									<?php
			  							$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 AND quantity != 0";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								$selected = "";
			  								if($row['product_id'] == $orderItemData['product_id']) { 
			  									echo "<p id='available_quantity".$row['product_id']."'>".$row['quantity']."</p>";
											}
			  								 else {
			  									$selected = "";
			  								}

			  								//echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."' ".$selected." >".$row['product_name']."</option>";
										 	} // /while 

			  						?>
									
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" value="<?php echo $orderItemData['quantity']; ?>" />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" value="<?php echo $orderItemData['total']; ?>"/>			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $orderItemData['total']; ?>"/>			  					
			  				</td>
			  				<td>

			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
		  			$x++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="subTotal" class="col-sm-3 control-label">Sub Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" value="<?php echo $data[6] ?>" />
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" value="<?php echo $data[6] ?>" />
				    </div>
				  </div> <!--/form-group-->			  

				  <input type="hidden" class="form-control" id="totalAmount" name="totalAmount" disabled="true" value="<?php echo $data[8] ?>" />
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" value="<?php echo $data[8] ?>"  />
				  			  
				  <!-- <div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Total Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true" value="<?php //echo $data[7] ?>" />
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" value="<?php //echo $data[7] ?>"  />
				    </div>
				  </div>  -->
				  <!--/form-group-->	
				  <div class="form-group">
				    <label for="shipping" class="col-sm-3 control-label">Shipping</label>
				    <div class="col-sm-9">
				      <input type="number" class="form-control" id="shipping_cost" name="shipping" onkeyup="addShippingCostToTotal(this)" autocomplete="off" value="<?php echo $data[9] ?>" />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="discount" class="col-sm-3 control-label">Discount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" value="<?php echo $data[10] ?>" />
				    </div>
				  </div> <!--/form-group-->	
				  <div class="form-group">
				    <label for="grandTotal" class="col-sm-3 control-label">Grand Total</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" value="<?php echo $data[11] ?>"  />
				      <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" value="<?php echo $data[11] ?>"  />
				    </div>
				  </div> <!--/form-group-->	
				  <div class="form-group">
				    <label for="vat" class="col-sm-3 control-label gst"><?php if($data[17] == 2) {echo "IGST 0%";} else echo "GST 5%"; ?></label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="vat" name="vat" disabled="true" value="<?php echo $data[7] ?>"  />
				      <input type="hidden" class="form-control" id="vatValue" name="vatValue" value="<?php echo $data[7] ?>"  />
				    </div>
				  </div> 
				  <!-- <div class="form-group">
				    <label for="gstn" class="col-sm-3 control-label gst">G.S.T.IN</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="gstn" name="gstn" value="<?php //echo $data[14] ?>"  />
				    </div>
				  </div> -->
				  <!--/form-group-->		  		  
			  </div> <!--/col-md-6-->

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="paid" class="col-sm-3 control-label">Paid Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" value="<?php echo $data[12] ?>"  />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="due" class="col-sm-3 control-label">Due Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="due" name="due" disabled="true" value="<?php echo $data[13] ?>"  />
				      <input type="hidden" class="form-control" id="dueValue" name="dueValue" value="<?php echo $data[13] ?>"  />
				    </div>
				  </div> <!--/form-group-->		
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentType" id="paymentType" >
				      	<option value="">~~SELECT~~</option>
				      	<option value="1" <?php if($data[14] == 1) {
				      		echo "selected";
				      	} ?> >paypal</option>
				      	<option value="2" <?php if($data[14] == 2) {
				      		echo "selected";
				      	} ?>  >western union</option>
				      	<option value="3" <?php if($data[14] == 3) {
				      		echo "selected";
				      	} ?> >wise</option>
				      	<option value="4" <?php if($data[14] == 4) {
				      		echo "selected";
				      	} ?> >bank Transfer</option>
				      	<option value="5" <?php if($data[14] == 5) {
				      		echo "selected";
				      	} ?> >cash</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->							  
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentStatus" id="paymentStatus">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1" <?php if($data[15] == 1) {
				      		echo "selected";
				      	} ?>  >paid</option>
				      	<option value="2" <?php if($data[15] == 2) {
				      		echo "selected";
				      	} ?> >Payment processing</option>
				      	<option value="3" <?php if($data[15] == 3) {
				      		echo "selected";
				      	} ?> >No Payment</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->
				  <!-- <div class="form-group">
				  	<label class="col-sm-3">Payment Place:</label>
				  	<div class="col-sm-9">
				  	  <input type="disabled" value="" class="form-control" disabled>
				  	</div>
				  </div> -->
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Place</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentPlace" id="paymentPlace">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1" <?php if($data[16] == 1) {
				      		echo "selected";
				      	} ?>  >USA</option>
				      	<option value="2" <?php if($data[16] == 2) {
				      		echo "selected";
				      	} ?> >Eu</option>
				      	<option value="3" <?php if($data[16] == 3) {
				      		echo "selected";
				      	} ?> >Uk</option>
				      	<option value="4" <?php if($data[16] == 4) {
				      		echo "selected";
				      	} ?> >Canada</option>
				      	<option value="5" <?php if($data[16] == 5) {
				      		echo "selected";
				      	} ?> >Signapore</option>
				      	<option value="6" <?php if($data[16] == 6) {
				      		echo "selected";
				      	} ?> >Hongkong</option>
				      	<option value="7" <?php if($data[16] == 7) {
				      		echo "selected";
				      	} ?> >Norway</option>
				      	<option value="8" <?php if($data[16] == 8) {
				      		echo "selected";
				      	} ?> >Switezerland</option>
				      	<option value="9" <?php if($data[16] == 9) {
				      		echo "selected";
				      	} ?> >Alaska & hawaii</option>
				      	<option value="10" <?php if($data[16] == 10) {
				      		echo "selected";
				      	} ?> >Aus</option>
				      	<option value="11" <?php if($data[16] == 11) {
				      		echo "selected";
				      	} ?> >Other</option>
				      </select>
				      <div id="otherPlace" class="mt-3" style="display: none;">
							  <label for="otherInput">Other Location:</label>
							  <input type="text" class="form-control" id="otherInput" name="otherInput">
							</div>
							<script>
							document.addEventListener("DOMContentLoaded", function() {
							  var paymentPlaceSelect = document.getElementById("paymentPlace");
							  var otherPlaceDiv = document.getElementById("otherPlace");
							  var otherInput = document.getElementById("otherInput");

							  paymentPlaceSelect.addEventListener("change", function() {
							    if (paymentPlaceSelect.value === "11") {
							      otherPlaceDiv.style.display = "block";
							    } else {
							      otherPlaceDiv.style.display = "none";
							      otherInput.value = ""; // Reset the input field when not selecting "Other"
							    }
							  });
							  
							  // Add an event listener to the input field to update the select value
							  otherInput.addEventListener("input", function() {
							    if (paymentPlaceSelect.value === "11") {
							      paymentPlaceSelect.value = otherInput.value;
							    }
							  });
							});
							</script>
				    </div>
				  </div>							  
			  </div> <!--/col-md-6-->


			  <div class="form-group editButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			    <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>

			    <input type="hidden" name="orderId" id="orderId" value="<?php echo $_GET['i']; ?>" />

			    <button type="submit" id="editOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
			      
			    </div>
			  </div>
			</form>

			<?php
		} // /get order else  ?>


	</div> <!--/panel-->	
</div> <!--/panel-->	


<!-- edit order -->
<div class="modal fade" tabindex="-1" role="dialog" id="paymentOrderModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-edit"></i> Edit Payment</h4>
      </div>      

      <div class="modal-body form-horizontal" style="max-height:500px; overflow:auto;" >

      	<div class="paymentOrderMessages"></div>

      	     				 				 
			  <div class="form-group">
			    <label for="due" class="col-sm-3 control-label">Due Amount</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="due" name="due" disabled="true" />					
			    </div>
			  </div> <!--/form-group-->		
			  <div class="form-group">
			    <label for="payAmount" class="col-sm-3 control-label">Pay Amount</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="payAmount" name="payAmount"/>					      
			    </div>
			  </div> <!--/form-group-->		
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="paymentType" id="paymentType" >
			      	<option value="">~~SELECT~~</option>
			      	<option value="1">Paypal</option>
			      	<option value="2">Western Union</option>
			      	<option value="3">Wise</option>
			      	<option value="4">Bank Transfer</option>
			      	<option value="5">Cash</option>
			      </select>
			    </div>
			  </div> <!--/form-group-->							  
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="paymentStatus" id="paymentStatus">
			      	<option value="">~~SELECT~~</option>
			      	<option value="1">Paid</option>
			      	<option value="2">Payment Processing</option>
			      	<option value="3">No Payment</option>
			      </select>
			    </div>
			  </div> <!--/form-group-->							  				  
      	        
      </div> <!--/modal-body-->
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="updatePaymentOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>	
      </div>           
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit order-->

<!-- remove order -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeOrderModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Order</h4>
      </div>
      <div class="modal-body">

      	<div class="removeOrderMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove order-->


<script src="custom/js/order.js"></script>

<?php require_once 'includes/footer.php'; ?>


	