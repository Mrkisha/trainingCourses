<?php

	require '../includes/database.php';
	include '../includes/functions.php';

	$stm = $db->query("SELECT * FROM `cts_courses` ");
	$stm->execute();

	$data = $stm->fetchAll(PDO::FETCH_ASSOC);

	foreach ($data as $key => $value) {
		$$key = $value;
	}