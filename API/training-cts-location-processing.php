<?php
	require '../includes/database.php';
	include '../includes/functions.php';

	//echo $_POST['courseName'];

	if(!isset($_POST['locationName'])){
		redirect_to('../index.php');
		exit;
	}

	$stm = $db->prepare("INSERT INTO `cts_locations`
							(
								`locationName`
							) VALUES (
								:locationName
							)");
	$stm->bindParam(":locationName", $_POST['locationName']);
	$stm->execute();

	echo $db->lastInsertId();