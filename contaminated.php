<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Contaminated Plants</li>
		</ol>
	

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Add Contaminated Plants</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages">
					<?php 
					if (isset($_GET['status']) && $_GET['status'] == 1) {
					    echo '<div class="alert alert-success">Contaminated added successfully</div>';
					}
					?>
					<?php 
					if (isset($_GET['delete']) && $_GET['delete'] == 1) {
					    echo '<div class="alert alert-danger">Contaminated Delete successfully</div>';
					}
					?>

				</div>
				
				<div>
					<form method="post" action="php_action/createContaminated.php">
						<div class="row d-flex align-items-center justify-content-center">
							<div class="col-sm-6 form-group">
								<label for="date">Date:</label>
								<input class="form-control" type="date" id="date" name="contaminated_date" required>
							</div>
							<div class="col-sm-6 form-group">
								<label for="product">Choose Product:</label>
								
								<select class="form-control" name="product_name" id="product" required>
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
									        echo '<option value="' . $row["product_name"] . '">' . $row["product_name"] . '</option>';
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
								
								<select class="form-control" name="operator_number" id="operator_number" required>
									<?php

									// Establish a database connection
									$conn = new mysqli($servername, $username, $password, $dbname);

									// Check the connection
									if ($conn->connect_error) {
									    die("Connection failed: " . $conn->connect_error);
									}

									// SQL query to fetch data from the product table where status = 1 and active = 1
									$sqlOperaC = "SELECT * FROM operators";
									$resultOperaC = $conn->query($sqlOperaC);

									// Check if there are any results
									if ($resultOperaC->num_rows > 0) {
									    // Output data of each row using a while loop
									    while ($rowOperaC = $resultOperaC->fetch_assoc()) {
									        // Generate <option> tags with product names as values
									        echo '<option value="' . $rowOperaC["operator_number"] . '">' . $rowOperaC["operator_number"] . '</option>';
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
								<label for="contaminated_quantity">Contaminated Quantity:</label>
								<input class="form-control" type="number" name="contaminated_quantity" required>
							</div>
							<div class="col-sm-6 mt-2 form-group d-flex align-items-center justify-content-end">
								<button class="btn btn-md btn-primary btn-outline-success" type="sucess">Submit</button>
							</div>
						</div>
					</form>
				</div>
				

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->	
		<!-- panel list -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Contaminated</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">
				
				<div>
					<div class="row d-flex align-items-center justify-content-center">
						<div class="col-sm-12 form-group">
							<table class="table">
							  <thead>
							    <tr>
							      <th scope="col">Date</th>
							      <th scope="col">Product Name</th>
							      <th scope="col">Operator number</th>
							      <th scope="col">Qunatity</th>
							      <th scope="col">Action</th>
							    </tr>
							  </thead>
							  <tbody>
									<?php
										$sqlOper = "SELECT * FROM contaminated_plants";

										$resultOper = $connect->query($sqlOper);
										if ($resultOper->num_rows > 0) {
										    // Output data of each row using a while loop
										    while ($rowOper = $resultOper->fetch_assoc()) {
										        echo '<tr>';
										        echo '<th scope="row">' . $rowOper["contaminated_date"] . '</th>';
										        echo '<td>' . $rowOper["product_name"] . '</td>';
										        echo '<td>' . $rowOper["operator_number"] . '</td>';
										        echo '<td>' . $rowOper["contaminated_quantity"] . '</td>';
										        echo '<td>
										                <a class="btn btn-sm btn-warning" href="editContaminated.php?id=' . $rowOper["contaminated_id"] . '& qua= '.$rowOper["contaminated_quantity"].'">Edit</a>
										                <a class="btn btn-sm btn-danger" href="php_action/deleteContaminated.php?id=' . $rowOper["contaminated_id"] . '">Delete</a>
										              </td>';
										        echo '</tr>';
										    }
										} else {
										    echo '';
										}
										$connect->close();
										?>

					  
								</tbody>
							</table>

						</div>
					</div>
				</div>
				
			</div> <!-- /panel-body -->
		</div> <!-- /panel -->

	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<?php require_once 'includes/footer.php'; ?>