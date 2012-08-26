<?php

	require '../includes/database.php';
	include '../includes/functions.php';

	//echo $_POST['orderId'];

	if(!isset($_POST['courseID'])){
		redirect_to('../index.php');
		exit;
	}

	//echo $_POST['locationID'];

	$stm = $db->prepare("DELETE FROM `cts_courses` WHERE id = :courseID ");
	$stm->bindParam(":courseID", $_POST['courseID']);
	$stm->execute();