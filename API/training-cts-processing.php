<?php

	require '../includes/database.php';
	include '../includes/functions.php';

	//echo $_POST['courseName'];

	if(!isset($_POST['courseName'])){
		redirect_to('../index.php');
		exit;
	}

	$stm = $db->prepare("INSERT INTO `cts_courses`
							(
								`courseName`
							) VALUES (
								:courseName
							)");
	$stm->bindParam(":courseName", $_POST['courseName']);
	$stm->execute();

	echo 