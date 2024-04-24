<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	$unitPrice = 0;
	$quantity = 0;
	$totalPrice = 0;
	
	$qSale = 'SELECT * FROM sale';
	$saleStatement = $dbcon->prepare($qSale);
	$saleStatement->execute();

	$output = '<table id="saleSearchTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
				<thead>
					<tr>
						<th>Sale ID</th>
						<th>Item Number</th>
						<th>Customer ID</th>
						<th>Customer Name</th>
						<th>Item Name</th>
						<th>Sale Date</th>
						<th>Discount %</th>
						<th>Quantity</th>
						<th>Unit Price</th>
						<th>Total Price</th>
					</tr>
				</thead>
				<tbody>';
	
	// Create table rows from the selected data
	while($resultset = $saleStatement->fetch(PDO::FETCH_ASSOC)){
		  $unitPrice = $resultset['unitPrice'];
	      $quantity = $resultset['quantity'];
		  $discount = $resultset['discount'];
		  $totalPrice = $unitPrice * $quantity * ((100 - $discount)/100);
			
		$output .= '<tr>' .
						'<td>' . $resultset['saleID'] . '</td>' .
						'<td>' . $resultset['itemNumber'] . '</td>' .
						'<td>' . $resultset['customerID'] . '</td>' .
						'<td>' . $resultset['customerName'] . '</td>' .
						'<td>' . $resultset['itemName'] . '</td>' .
						'<td>' . $resultset['saleDate'] . '</td>' .
						'<td>' . $resultset['discount'] . '</td>' .
						'<td>' . $resultset['quantity'] . '</td>' .
						'<td>' . $resultset['unitPrice'] . '</td>' .
						'<td>' . $totalPrice . '</td>' .
					'</tr>';
	}
	
	$saleStatement->closeCursor();
	
	$output .= '</tbody>
					<tfoot>
						<tr>
							<th>Sale ID</th>
							<th>Item Number</th>
							<th>Customer ID</th>
							<th>Customer Name</th>
							<th>Item Name</th>
							<th>Sale Date</th>
							<th>Discount %</th>
							<th>Quantity</th>
							<th>Unit Price</th>
							<th>Total Price</th>
						</tr>
					</tfoot>
				</table>';
	echo $output;
?>
