<?php

	require '../includes/database.php';
	require '../includes/functions.php';

	/*$stm = $db->prepare("UPDATE `mod_foxycart_finance_tasks` SET status = 1, dateCompleted = '" . date("y-m-d H:i:s") . "' WHERE orderId = :orderID");
	$stm->bindParam(":orderID", $_POST['orderID']);
	$stm->execute();*/
	echo  "UPDATE `mod_foxycart_orders` SET paymentDate = '{$_POST['invoiceDate']}' WHERE orderId = {$_POST['orderID']}";
die;
	$stm = $db->prepare("UPDATE `mod_foxycart_orders` SET paymentDate = :invoiceDate WHERE orderId = :orderID");
	$stm->bindParam(":invoiceDate", format_date($_POST['invoiceDate']));
	$stm->bindParam(":orderID", $_POST['orderID']);
	$stm->execute();
	
	echo $_POST['invoiceDate'];

?>