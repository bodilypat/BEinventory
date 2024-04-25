<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	$qItem = 'SELECT * FROM item';
	$itemStatement = $dbcon->prepare($qItem);
	$itemStatement->execute();
	/* get item object form database */
	$output = '<table id="itemSearchTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
				<thead>
					<tr>
						<th>Product ID</th>
						<th>Item Number</th>
						<th>Item Name</th>
						<th>Discount %</th>
						<th>Stock</th>
						<th>Unit Price</th>
						<th>Status</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>';
	
	/* create item table from object in database */
	while($resultset = $itemStatement->fetch(PDO::FETCH_ASSOC)){
		
		$output .= '<tr>' .
						'<td>' . $resultset['productID'] . '</td>' .
						'<td>' . $resultset['itemNumber'] . '</td>' .
						'<td><a href="#" class="itemDetailsHover" data-toggle="popover" id="' . $resultset['productID'] . '">' . $resultset['itemName'] . '</a></td>' .
						'<td>' . $resultset['discount'] . '</td>' .
						'<td>' . $resultset['stock'] . '</td>' .
						'<td>' . $resultset['unitPrice'] . '</td>' .
						'<td>' . $resultset['status'] . '</td>' .
						'<td>' . $resultset['description'] . '</td>' .
					'</tr>';
	}
	
	$itemStatement->closeCursor();
	
	$output .= '</tbody>
					<tfoot>
						<tr>
							<th>Product ID</th>
							<th>Item Number</th>
							<th>Item Name</th>
							<th>Discount %</th>
							<th>Stock</th>
							<th>Unit Price</th>
							<th>Status</th>
							<th>Description</th>
						</tr>
					</tfoot>
				</table>';
	echo $output;
?>