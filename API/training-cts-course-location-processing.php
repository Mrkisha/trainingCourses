<?php

	require '../includes/database.php';
	include '../includes/functions.php';

	//echo $_POST['courseName'];

	if(!isset($_POST)){
		redirect_to('../index.php');
		exit;
	}

	foreach ($_POST as $key => $value) {
		$$key = $value;
	}

	$courseStart = date("Y-m-d", strtotime($_POST['productStartDate2']))." ".$_POST['productStartTime2'];

	$stm = $db->prepare("INSERT INTO `cts_courses_locations`
							(
								  `courseNameId`
								, `courseLocationId`
								, `courseStart`
							) VALUES (
								  :courseName
								, :courseLocation
								, :courseStart
							)");
	/*	echo "INSERT INTO `cts_courses`
							(
								  `courseNameId`
								, `courseLocationId`
								, `courseStart`
							) VALUES (
								  {$_POST['courseName']}
								, {$_POST['courseLocation']}
								, '$courseStart'
							)";*/
	$stm->bindParam(":courseName", $_POST['courseName']);
	$stm->bindParam(":courseLocation", $_POST['courseLocation']);
	
	$stm->bindParam(":courseStart", $courseStart);
	$stm->execute();

	$return = array();

	$return['id'] = $db->lastInsertId();
	$return['courseStart'] = date("d/m/Y H:i", strtotime($courseStart));

	echo json_encode($return);