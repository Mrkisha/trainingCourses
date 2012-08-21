<?php
	session_start();
	
	require 'includes/database.php';
	require 'includes/functions.php';

	if(!isset($_POST)){
		redirect_to('index.php');
	}

	foreach($_POST as $key => $value){
		$$key = $value;
	}
	
	
	
	$stm = $db->prepare("SELECT * FROM `users` WHERE `username` = :username AND `password` = :password");
	$stm->bindParam(":username", $username);
	$stm->bindParam(":password", hash("sha256", $password));
	$stm->execute();

	$row_count = $stm->rowCount();
	$data = $stm->fetchAll();
	
	if($row_count == 1){
		// set session vars
		$_SESSION['user']['username'] = $data[0]['username'];
		$_SESSION['user']['permission'] = $data[0]['permission'];
		
		if($data[0]['permission'] == 1 || $data[0]['permission'] == 3){
			redirect_to('training-public.php');
		} else {
			redirect_to('finance-public.php');
		}
		
	} else {
		redirect_to('index.php');
	}
	
	


	

?>