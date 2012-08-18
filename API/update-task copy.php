<?php

	require '../includes/database.php';

	print_r($_POST);

	$stm = $db->prepare("UPDATE `mod_foxycart_training_tasks` SET status = 1, dateCompleted = '" . date("y-m-d H:i:s") . "' WHERE Id = '{$_POST['taskID']}'");
	$stm->execute();
?>