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
		
		// check for which pages user has permission to access
		$stm_page = $db->prepare("SELECT 
										`users`.`username` ,  
										`users`.`permission` ,  
										`pages`.`pageID` ,  
										`pages`.`page` 
									FROM  `pages` 
										INNER JOIN  `users_pages` ON (`pages`.`pageID` =  `users_pages`.`pageID`) 
										INNER JOIN  `users` ON (`users`.`userID` =  `users_pages`.`userID`) 
									WHERE  `users`.`username` =  :username
									ORDER BY  `pages`.`pageID` ASC ");
		$stm_page->bindParam(":username", $username);
		$stm_page->execute();
		$data_page = $stm_page->fetchAll(PDO::FETCH_ASSOC);
		

		redirect_to($data_page[0]['page']);
		
		
	} else {
		redirect_to('index.php');
	}
	
	


	

?>