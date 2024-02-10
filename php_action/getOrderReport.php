<?php 

require_once 'core.php';

if($_POST) {

	$startDate = $_POST['startDate'];
	$date = DateTime::createFromFormat('m/d/Y',$startDate);
	$start_date = $date->format("Y-m-d");


	$endDate = $_POST['endDate'];
	$format = DateTime::createFromFormat('m/d/Y',$endDate);
	$end_date = $format->format("Y-m-d");

	$sql = "SELECT orders.*, order_item.product_price_type 
        FROM orders 
        JOIN order_item ON orders.order_id = order_item.order_id 
        WHERE orders.order_date >= '$start_date' 
        AND orders.order_date <= '$end_date' 
        AND orders.order_status = 1";

	$query = $connect->query($sql);

	$table = '<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>Order Date</th>
			<th>Client Name</th>
			<th>Contact</th>
			<th>Grand Total</th>
			<th>Price Type</th>
		</tr>
		<tr>';
		$totalAmount = 0;
		while ($result = $query->fetch_assoc()) {
			$table .= '<tr>
				<td><center>'.$result['order_date'].'</center></td>
				<td><center>'.$result['client_name'].'</center></td>
				<td><center>'.$result['client_contact'].'</center></td>
				<td><center>'.$result['grand_total'].'</center></td>
				<td><center>'.$result['product_price_type'].'</center></td>
			</tr>';	
			$totalAmount = $totalAmount + $result['grand_total'];
		}
		$table .= '
		</tr>
		<tr>
			<td colspan="3"><center>Total Amount</center></td>
			<td><center>'.$totalAmount.'</center></td>
		</tr>
	</table>
	';	

	echo $table;

}

?>