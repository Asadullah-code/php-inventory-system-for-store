<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>
<?php
    $contaminated_id = $_GET['id'];
    $prevQuan = $_GET['qua'];

    $sqlEdit = "SELECT * FROM contaminated_plants WHERE contaminated_id = '$contaminated_id'";
    $resultEdit = $connect->query($sqlEdit);

    if ($resultEdit->num_rows > 0) {
        // Fetch the row from the result set
        $rowEdit = $resultEdit->fetch_assoc();
        
        $product_id = $rowEdit['product_id'];
        $contaminated_id = $rowEdit['contaminated_id'];
        $contaminated_date = $rowEdit['contaminated_date'];
        $operator_number = $rowEdit['operator_number'];
        $contaminated_quantity = $rowEdit['contaminated_quantity'];
    } else {
        echo "";
    }

    // Close the database connection
    $connect->close();
?>



<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="contaminated.php">Contaminated</a></li>		  
		  <li class="active">Edit Contaminated</li>
		</ol>

		<!-- panel list -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Edit Contaminated</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages">
					<?php 
					if (isset($_GET['edit']) && $_GET['edit'] == 1) {
					    echo '<div class="alert alert-warning">Contaminated edit successfully</div>';
					}
					?>

				</div>
				
				<div>
					<form method="post" action="php_action/editContaminatedSql.php">
						<input type="hidden" value="<?php echo $contaminated_id; ?>" name="contaminated_id">
						<input type="hidden" value="<?php echo $prevQuan; ?>" name="prevQuan">
						<div class="row d-flex align-items-center justify-content-center">
							<div class="col-sm-6 form-group">
								<label for="date">Date:</label>
								<input class="form-control" value="<?php echo $contaminated_date; ?>" type="date" id="date" name="contaminated_date" required>
							</div>
							<div class="col-sm-6 form-group">
								<label for="product">Choose Product:</label>
								
								<select class="form-control" value="<?php echo $product_name; ?>" name="product_id" id="product" required>
									<?php

									// Establish a database connection
									$conn = new mysqli($servername, $username, $password, $dbname);

									// Check the connection
									if ($conn->connect_error) {
									    die("Connection failed: " . $conn->connect_error);
									}

									// SQL query to fetch data from the product table where status = 1 and active = 1
									$sql = "SELECT * FROM product WHERE status = 1 AND active = 1";
									$result = $conn->query($sql);

									// Check if there are any results
									if ($result->num_rows > 0) {
									    // Output data of each row using a while loop
									    while ($row = $result->fetch_assoc()) {
									        // Generate <option> tags with product names as values
									        echo '<option value="' . $row["product_id"] . '">' . $row["product_name"] . '</option>';
									    }
									} else {
									    echo '<option value="">No products found</option>';
									}

									// Close the database connection
									$conn->close();
									?>

								</select>
							</div>
							<div class="col-sm-6 form-group">
								<label for="operator_number">Choose Operator Number:</label>
								
								<select class="form-control" value="<?php echo $operator_number; ?>" name="operator_number" id="operator_number" required>
									<?php

									// Establish a database connection
									$conn = new mysqli($servername, $username, $password, $dbname);

									// Check the connection
									if ($conn->connect_error) {
									    die("Connection failed: " . $conn->connect_error);
									}

									// SQL query to fetch data from the product table where status = 1 and active = 1
									$sqlOperaC = "SELECT * FROM operators WHERE operator_quantity>0";
									$resultOperaC = $conn->query($sqlOperaC);

									// Check if there are any results
									if ($resultOperaC->num_rows > 0) {
									    // Output data of each row using a while loop
									    while ($rowOperaC = $resultOperaC->fetch_assoc()) {
									        // Generate <option> tags with product names as values
									        echo '<option value="' . $rowOperaC["operator_number"] . '">' . $rowOperaC["operator_number"] . '</option>';
									    }
									} else {
									    echo '<option value="">No operator number found</option>';
									}

									// Close the database connection
									$conn->close();
									?>

								</select>
							</div>
							<div class="col-sm-6 form-group">
								<label for="contaminated_quantity">Operator Quantity:</label>
								<input class="form-control" value="<?php echo $contaminated_quantity; ?>" type="number" name="contaminated_quantity" required>
							</div>
							<div class="col-sm-6 mt-2 form-group d-flex align-items-center justify-content-end">
								<button class="btn btn-md btn-primary btn-outline-success" type="sucess">Edit</button>
							</div>
						</div>
					</form>
				</div>
				
			</div> <!-- /panel-body -->
		</div> <!-- /panel -->

	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<?php require_once 'includes/footer.php'; ?>