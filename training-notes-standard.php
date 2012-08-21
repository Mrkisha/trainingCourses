<?php
	session_start();

	require '../includes/database.php';
	require '../includes/functions.php';

	if(!isset($_POST['note'])){
		redirect_to('../training-public.php');
	}

	$date = date("Y-m-d H:i:s");
	$stm_notes = $db->prepare("INSERT INTO `mod_foxycart_orders_notes`
									( `orderId`, `note`, `noteDate`, `userId`) 
								VALUES (:orderId, :note, '".$date."', :user_id)");
	$stm_notes->bindParam(":orderId", $_POST['orderId']);
	$stm_notes->bindParam(":note", $_POST['note']);
	$stm_notes->bindParam(":user_id", user_id());
	$stm_notes->execute();

	echo "<li>".$date." Note {$_POST['i']} {$_POST['note']} <i>".ucfirst($_SESSION['user']['username'])."</i></li>";;

?>