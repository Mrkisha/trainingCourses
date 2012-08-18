<?php
	$current_page = basename($_SERVER['SCRIPT_NAME']);

	$stm_nav_left = $db->query("SELECT
										`users`.`username`
										, `users`.`permission`
										, `pages`.`page`
										, `users_pages`.`userID`
										, `users_pages`.`pageID`
										, `pages`.`description`
										, `pages`.`title`
									FROM `pages`
										INNER JOIN `users_pages` ON (`pages`.`pageID` = `users_pages`.`pageID`)
										INNER JOIN `users` ON (`users`.`userID` = `users_pages`.`userID`)
									WHERE username = '{$_SESSION['user']['username']}' AND `description` = '$page'
									ORDER BY `pages`.`sort` ASC");
	$stm_nav_left->execute();
	$data_nav_left = $stm_nav_left->fetchAll(PDO::FETCH_ASSOC);
	/*echo "<pre>";
	print_r($data_nav_left);
	echo "</pre>";*/
?>
<div class="leftNav">
	<ul id="menu">
	<?php
		foreach($data_nav_left as $key){
			// set active var for navigation button that should have class active if you're on that page
			$active = '';
			if($current_page == $key['page']){
				$active = 'active';
			}

			/*echo "<pre>";
			print_r($key);
			echo "</pre>";*/
			echo '<li class="tables">
					<a href="'.$key['page'].'" class="'.$active.'" title="'.$key['title'].'">
						<span>'.$key['title'].'</span>';
			if($key['page'] == 'training-public.php'){
				if(tasks_overdue_training_tasks1() > 0){
					echo "<span class='numberLeft'>".tasks_overdue_training_tasks1()."</span>";
				}

			} else if ($key['page'] == 'training-standards.php'){
				if(tasks_overdue_training_tasks2() > 0){
					echo "<span class='numberLeft task2'>".tasks_overdue_training_tasks2()."</span>";
				}

			} else if($key['page'] == 'finance-raise-invoices.php'){
				if(tasks_overdue_finance() > 0){
					echo "<span class='numberLeft'>".tasks_overdue_finance()."</span>";
				}
				
			}
			
			echo '</a></li>';
		}
	?>
		<!-- <li class="tables"><a href="training-public.php" title="Public Courses" class="active"><span>Public Courses</span><span class="numberLeft"><?php echo $overdue; ?></span></a></li>
		<li class="tables"><a href="training-other.php" title="Add Other Courses"><span>Add Other Courses</span></a></li>
		<li class="tables"><a href="training-standards.php" title="Standards"><span>Standards</span></a></li>
		<li class="tables"><a href="training-all.php" title="All Bookings"><span>All Bookings</span></a></li> -->
	</ul>
</div>