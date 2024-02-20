<?php require_once 'includes/header.php'; ?>

<div class="row">

	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="glyphicon glyphicon-check"></i>	Price Type Order Report
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				
				<form class="form-horizontal" action="php_action/getOrderReport.php" method="post" id="getOrderReportForm">
				  <div class="form-group">
				    <label for="startDate" class="col-sm-2 control-label">Start Date</label>
				    <div class="col-sm-10">
				      <input type="date" class="form-control" id="startDate" name="startDate" placeholder="Start Date" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="endDate" class="col-sm-2 control-label">End Date</label>
				    <div class="col-sm-10">
				      <input type="date" class="form-control" id="endDate" name="endDate" placeholder="End Date" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="paymentType" class="col-sm-2 control-label">Specify Payment Type</label>
				    <div class="col-sm-10">
				        <select class="form-select form-control" name="product_price_type" aria-label="Default select example">
						  <!-- <option selected>Price Type</option> -->
						    <option value="rate">Retail Price</option>
						    <option value="wholesale">Wholesale</option>
						    <option value="thb">THB</option>
						</select>
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-success" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Generate Report</button>
				    </div>
				  </div>
				</form>

			</div>
			<!-- /panel-body -->
		</div>
	</div>
	<!-- /col-dm-12 -->


	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="glyphicon glyphicon-check"></i>  Specific Product Report
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				
				<form class="form-horizontal" action="php_action/getProductReport.php" method="post" id="getProductReportForm">
				  <div class="form-group">
				    <label for="startDate" class="col-sm-2 control-label">Start Date</label>
				    <div class="col-sm-10">
				      <input type="date" class="form-control" id="startDate" name="startDate" placeholder="Start Date" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="endDate" class="col-sm-2 control-label">End Date</label>
				    <div class="col-sm-10">
				      <input type="date" class="form-control" id="endDate" name="endDate" placeholder="End Date" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="endDate" class="col-sm-2 control-label">Specify Product</label>
				    <div class="col-sm-10">
				        <select class="form-select form-control" name="product_name" aria-label="Default select example">
						  <!-- <option selected>Specify Product</option> -->
						    <?php
	  							$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 AND quantity != 0";
	  							$productData = $connect->query($productSql);
	  							while($row = $productData->fetch_array()) {
								echo "<option value='".$row['product_name']."' id='changeProduct".$row['product_name']."'>".$row['product_name']."</option>";
								 	}  
	  						?>
						</select>
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-success" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Generate Report</button>
				    </div>
				  </div>
				</form>

			</div>
			<!-- /panel-body -->
		</div>
	</div>



	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="glyphicon glyphicon-check"></i>  Specific Operator Report
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				
				<form class="form-horizontal" action="php_action/getOperatorReport.php" method="post" id="getOperatorReportForm">
				  <div class="form-group">
				    <label for="startDate" class="col-sm-2 control-label">Start Date</label>
				    <div class="col-sm-10">
				      <input type="date" class="form-control" id="startDate" name="startDate" placeholder="Start Date" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="endDate" class="col-sm-2 control-label">End Date</label>
				    <div class="col-sm-10">
				      <input type="date" class="form-control" id="endDate" name="endDate" placeholder="End Date" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="endDate" class="col-sm-2 control-label">Specify Operator</label>
				    <div class="col-sm-10">
				      <select class="form-select form-control" name="operator_number" aria-label="Default select example">
						  <!-- <option selected>Specify Operator</option> -->
						    <option value="001">001</option>
						    <option value="002">002</option>
						    <option value="003">003</option>
						    <option value="004">004</option>
						</select>
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-success" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Generate Report</button>
				    </div>
				  </div>
				</form>

			</div>
			<!-- /panel-body -->
		</div>
	</div>


	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="glyphicon glyphicon-check"></i>  Specific Contaminated Plant Report
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				
				<form class="form-horizontal" action="php_action/getContaminatedReport.php" method="post" id="getContaminatedReportForm">
				  <div class="form-group">
				    <label for="startDate" class="col-sm-2 control-label">Start Date</label>
				    <div class="col-sm-10">
				      <input type="date" class="form-control" id="startDate" name="startDate" placeholder="Start Date" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="endDate" class="col-sm-2 control-label">End Date</label>
				    <div class="col-sm-10">
				      <input type="date" class="form-control" id="endDate" name="endDate" placeholder="End Date" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="endDate" class="col-sm-2 control-label">Specify Contaminated Operator</label>
				    <div class="col-sm-10">
				      <select class="form-select form-control" name="operator_number" aria-label="Default select example">
						  <!-- <option selected>Specify Contaminated Operator</option> -->
						    <option value="001">001</option>
						    <option value="002">002</option>
						    <option value="003">003</option>
						    <option value="004">004</option>
						</select>
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-success" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Generate Report</button>
				    </div>
				  </div>
				</form>

			</div>
			<!-- /panel-body -->
		</div>
	</div>


</div>
<!-- /row -->

<script src="custom/js/report.js"></script>

<?php require_once 'includes/footer.php'; ?>