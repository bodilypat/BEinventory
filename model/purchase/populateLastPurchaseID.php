<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/dbconnect.php');
	
	$qPurch = "SELECT MAX(purchaseID) FROM purchase";
	$purchStatement = $dbcon->prepare($qPurch);
	$purchStatement->execute();
	$result = $purchStatement->fetch(PDO::FETCH_ASSOC);
	
	echo $result['MAX(purchaseID)'];
?>
