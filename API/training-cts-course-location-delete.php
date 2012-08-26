<?php

	require '../includes/database.php';
	include '../includes/functions.php';

	//echo $_POST['orderId'];

	if(!isset($_POST['locationID'])){
		redirect_to('../index.php');
		exit;
	}

	//echo $_POST['locationID'];

	$stm = $db->prepare("DELETE FROM `cts_courses_locations` WHERE id = :locationID ");
	$stm->bindParam(":locationID", $_POST['locationID']);
	$stm->execute();

	echo 1;