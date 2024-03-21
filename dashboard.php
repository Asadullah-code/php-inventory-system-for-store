<?php require_once 'includes/header.php'; ?>

<?php 

$currentDate = date('Y-m-d');


$sql = "SELECT * FROM product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;

$orderSql = "SELECT * FROM orders WHERE order_status = 1";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;

$totalRevenue = "";
while ($orderResult = $orderQuery->fetch_assoc()) {
	#$totalRevenue += $orderResult['paid'];
}

$lowStockSql = "SELECT * FROM product WHERE quantity <= 10 AND status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;

$userwisesql = "SELECT users.username , SUM(orders.grand_total) as totalorder FROM orders INNER JOIN users ON orders.user_id = users.user_id WHERE orders.order_status = 1 GROUP BY orders.user_id";
$userwiseQuery = $connect->query($userwisesql);
$userwieseOrder = $userwiseQuery->num_rows;

$connect->close();

?>


<style type="text/css">
	.ui-datepicker-calendar {
		display: none;
	}
</style>

<!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.print.css" media="print">


<div class="row">
	
	<div class="col-md-4">
		<div class="panel panel-success">
			<div class="panel-heading">
				
				<a href="product.php" style="text-decoration:none;color:black;">
					Total Product
					<span class="badge pull pull-right"><?php echo $countProduct; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->
	
	<div class="col-md-4">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<a href="product.php" style="text-decoration:none;color:black;">
					Low Stock
					<span class="badge pull pull-right"><?php echo $countLowStock; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->
	
	
 
		<div class="col-md-4">
			<div class="panel panel-info">
			<div class="panel-heading">
				<a href="orders.php?o=manord" style="text-decoration:none;color:black;">
					Total Orders
					<span class="badge pull pull-right"><?php echo $countOrder; ?></span>
				</a>
					
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
		</div> <!--/col-md-4-->

	

	<div class="col-md-4">
		<div class="card">
		  <div class="cardHeader">
		    <h1><?php echo date('d'); ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p><?php echo date('l') .' '.date('d').', '.date('Y'); ?></p>
		  </div>
		</div> 
		<br/>

	</div>
	

	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i> Date Wise Order</div>
			<div class="panel-body">
				<table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:40%;">Date</th>
			  			<th style="width:40%;">Name</th>
			  			<th style="width:20%;">Orders in $</th>
			  			<th style="width:20%;">Orders in THB</th>
			  		</tr>
			  	</thead>
			  	<tbody>
						<?php
							include 'php_action/db_connect.php';

							$sqlOrder = "SELECT o.order_date, o.client_name, o.grand_total, oi.product_price_type
							             FROM orders AS o
							             JOIN order_item AS oi ON o.order_id = oi.order_id
							             WHERE o.order_date = '$currentDate'
							             GROUP BY o.order_id";

							$resultOrder = $connect->query($sqlOrder);

							if ($resultOrder->num_rows > 0) {
							    // Output data of each row
							    while ($row = $resultOrder->fetch_assoc()) {
							    	echo $product_price_type = $row['product_price_type'];
							        echo "<tr>";
							        echo "<td>" . $row["order_date"] . "</td>";
							        echo "<td>" . $row["client_name"] . "</td>";
							        if ($product_price_type == 'wholesale' || $product_price_type == 'rate') {
							        	echo "<td>" . $row["grand_total"] . "</td>";
							        	echo "<td></td>";
							        }else
							        if ($product_price_type == 'thb') {
							        	echo "<td></td>";
							        	echo "<td>" . $row["grand_total"] . "</td>";
							        }else{
							        	echo "<td></td>";
							        }
							        echo "</tr>";
							    }
							} else {
							    echo "<tr><td colspan='4'>No records found for today's date</td></tr>";
							}

							// Close connection
							$connect->close();
							?>





				</tbody>
				</table>
				<!--<div id="calendar"></div>-->
			</div>	
		</div>
		
	</div> 
	
</div> <!--/row-->

<!-- fullCalendar 2.2.5 -->
<script src="assests/plugins/moment/moment.min.js"></script>
<script src="assests/plugins/fullcalendar/fullcalendar.min.js"></script>


<script type="text/javascript">
	$(function () {
			// top bar active
	$('#navDashboard').addClass('active');

      //Date for the calendar events (dummy data)
      var date = new Date();
      var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear();

      $('#calendar').fullCalendar({
        header: {
          left: '',
          center: 'title'
        },
        buttonText: {
          today: 'today',
          month: 'month'          
        }        
      });


    });
</script>

<?php require_once 'includes/footer.php'; ?>