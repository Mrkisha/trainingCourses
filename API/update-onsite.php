<?php

	
	require '../includes/database.php';
	include '../includes/functions.php';

	//echo $_POST['orderId'];

	if(!isset($_POST['onSiteId'])){
		redirect_to('../index.php');
		exit;
	}
	$dateInserted = date("Y-m-d H:i:s");
	// update onsite status ///////////////////////////////////////////////////////////////////
	$stm = $db->prepare("UPDATE `mod_foxycart_onsite_tasks` 
							SET 
								`status` = 1, 
								`dateCompleted` = '$dateInserted'
							WHERE Id = :Id");
	$stm->bindParam(":Id", $_POST['onSiteId']);
	$stm->execute();

	echo "<span>".date("d-m-Y H:s", strtotime($dateInserted))."</span>";
	

?>