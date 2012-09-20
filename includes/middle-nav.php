<?php
	$stm_training = $db->prepare("SELECT 
									`users`.`username` ,  
									`users`.`permission` ,  
									`pages`.`pageID` ,  
									`pages`.`page` ,
									`pages`.`description`
								FROM  `pages` 
									INNER JOIN  `users_pages` ON (`pages`.`pageID` =  `users_pages`.`pageID`) 
									INNER JOIN  `users` ON (`users`.`userID` =  `users_pages`.`userID`) 
								WHERE  `users`.`username` =  :username AND `pages`.`description` = 'training'
								ORDER BY  `pages`.`pageID` ASC
								LIMIT 0, 1");
	$stm_training->bindParam(":username", $_SESSION['user']['username']);
	$stm_training->execute();
	$data_training = $stm_training->fetchAll(PDO::FETCH_ASSOC);
	
	$stm_finance = $db->prepare("SELECT 
									`users`.`username` ,  
									`users`.`permission` ,  
									`pages`.`pageID` ,  
									`pages`.`page` ,
									`pages`.`description`
								FROM  `pages` 
									INNER JOIN  `users_pages` ON (`pages`.`pageID` =  `users_pages`.`pageID`) 
									INNER JOIN  `users` ON (`users`.`userID` =  `users_pages`.`userID`) 
								WHERE  `users`.`username` =  :username AND `pages`.`description` = 'finance'
								ORDER BY  `pages`.`pageID` ASC
								LIMIT 0, 1");
	$stm_finance->bindParam(":username", $_SESSION['user']['username']);
	$stm_finance->execute();
	$data_finance = $stm_finance->fetchAll(PDO::FETCH_ASSOC);
		
?>


<div class="middleNav">
	<ul>
	<?php
		if($_SESSION['user']['permission'] == 1){
			echo '<li class="iUser"><a href="' . $data_training[0]['page'] . '" title="" class="on"><span>Training</span></a></li>';
		} else if ($_SESSION['user']['permission'] == 2){
			echo '<li class="iOrders"><a href="' . $data_finance[0]['page'] . '" title=""><span>Finance</span></a></li>';
		} else {
			echo '<li class="iOrders"><a href="finance-raise-invoices.php" title="" class="'.(($page == 'finance')? "on" : "").'"><span>Finance</span></a></li>
					<li class="iUser"><a href="training-public.php" title="" class="'.(($page == 'training')? "on" : '').'"><span>Training</span></a></li>
					<li class="iStat"><a href="manager.php" title="" class="'.(($page == 'manager')? "on" : '').'"><span>Manager</span></a></li>';
		}
	?>			
	</ul>
</div>