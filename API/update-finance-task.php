<?php

	require '../includes/database.php';

	$stm = $db->prepare("UPDATE `mod_foxycart_finance_tasks` SET status = 1, dateCompleted = '" . date("y-m-d H:i:s") . "' WHERE orderId = :orderID");
	$stm->bindParam(":orderID", $_POST['orderID']);
	$stm->execute();
	
	$stm = $db->prepare("UPDATE `mod_foxycart_orders` SET invoiceNumber = :inputtext WHERE orderId = :orderID");
	$stm->bindParam(":inputtext", $_POST['inputtext']);
	$stm->bindParam(":orderID", $_POST['orderID']);
	$stm->execute();
	
	$stm = $db->prepare("INSERT INTO `mod_foxycart_finance_tasks` (orderid, task, status, dateInserted) VALUES (:orderID, 2, 0, '" . date("y-m-d H:i:s") . "')");
	$stm->bindParam(":orderID", $_POST['orderID']);
	$stm->execute();

	echo $_POST['orderID'];

?>