<?php

	function cyrillic($string) {
		$table = array(
			'Š'=>'Ш', 'š'=>'ш', 'Đ' =>'Ђ',  'đ'=>'ђ', 'Dj'=>'Ђ', 'dj'=>'ђ',  'Ž'=>'Ж',  'ž'=>'ж',  'Č'=>'Ч',  'č'=>'ч',
			'Ć'=>'Ћ', 'ć'=>'ћ', 'Dž'=>'Џ', 'dž'=>'џ', 'Lj'=>'Љ', 'lj'=>'љ', 'Nj'=>'Њ', 'nj'=>'њ',  'A'=>'А',  'a'=>'а',
			'B'=>'Б', 'b'=>'б', 'V' =>'В',  'v'=>'в',  'G'=>'Г',  'g'=>'г',  'D'=>'Д',  'd'=>'д',  'E'=>'Е',  'e'=>'е',
			'Z'=>'З', 'z'=>'з', 'I' =>'И',  'i'=>'и',  'J'=>'Ј',  'j'=>'ј',  'K'=>'К',  'k'=>'к',  'L'=>'Л',  'l'=>'л',
			'M'=>'М', 'm'=>'м', 'N' =>'Н',  'n'=>'н',  'O'=>'О',  'o'=>'о',  'P'=>'П',  'p'=>'п',  'R'=>'Р',  'r'=>'р',
			'S'=>'С', 's'=>'с', 'T' =>'Т',  't'=>'т',  'U'=>'У',  'u'=>'у',  'F'=>'Ф',  'f'=>'ф',  'H'=>'Х',  'h'=>'х',
			'C'=>'Ц', 'c'=>'ц'
		);

		return strtr($string, $table);
	}

	function permission(){
		global $db;
		// first we check for session
		check_session();

		// get the file name that this file is included to
		$page = basename($_SERVER['SCRIPT_NAME']);

		// then we run the query to see if user has access to the page
		$stm = $db->query("SELECT
								`users`.`username`
								, `users`.`password`
								, `users`.`permission`
								, `pages`.`page`
								, `users_pages`.`userID`
								, `users_pages`.`pageID`
							FROM `pages`
								INNER JOIN `users_pages` ON (`pages`.`pageID` = `users_pages`.`pageID`)
								INNER JOIN `users` ON (`users`.`userID` = `users_pages`.`userID`)
							WHERE username = '{$_SESSION['user']['username']}' AND page = '$page'");
		$stm->execute();
		$data = $stm->rowCount();

		if($data != 1){
			if($_SESSION['user']['permission'] == 1){
				redirect_to('training-public.php');
			} elseif ($_SESSION['user']['permission'] == 2) {
				redirect_to('finance-raise-invoices.php');
			}
		}
	}
	
	function check_session(){
		if(!isset($_SESSION['user'])){
			redirect_to('index.php');
		}
	}

	function user_id(){
		global $db;

		// then we run the query to see if user has access to the page
		$stm = $db->prepare("SELECT userID
							FROM users
							WHERE username = :username ");
		$stm->bindParam(":username", $_SESSION['user']['username']);
		$stm->execute();
		$data = $stm->fetch(PDO::FETCH_ASSOC);

		return $data['userID'];
	}

	function redirect_user(){
		if(isset($_SESSION['user'])){
			if($_SESSION['user']['permission'] == 1 || $_SESSION['user']['permission'] == 3){
				redirect_to('training-public.php');
			} elseif ($_SESSION['user']['permission'] == 2) {
				redirect_to('finance-public.php');
			}
		}
	}

	function tasks_overdue_training_tasks1 (){
		// make PDO variable available for functions
		global $db;

		$stm_overdue = $db->prepare("SELECT DISTINCT `orderId`
										FROM mod_foxycart_training_tasks
										WHERE  `dateInserted` < DATE_SUB( NOW( ) , INTERVAL 48 HOUR ) AND `task` = 1 AND `status` = 0");
		$stm_overdue->execute();
		$overdue = $stm_overdue->rowCount();
		
		return $overdue;
	}

	function tasks_pending_training_tasks1 (){
		// make PDO variable available for functions
		global $db;
		
		$stm = $db->prepare("SELECT DISTINCT `orderId` FROM `mod_foxycart_training_tasks` WHERE `task` = 1 AND `status` = 0");
		$stm->execute();
		$pendingTasks = $stm->rowCount();

		return $pendingTasks;	
	}

	function tasks_overdue_training_tasks2(){
		// make PDO variable available for functions
		global $db;
		
		$stm_overdue = $db->prepare("SELECT DISTINCT `orderId`
											FROM mod_foxycart_training_tasks
											WHERE  `dateInserted` < DATE_SUB( NOW( ) , INTERVAL 48 HOUR ) AND `task` = 2 AND `status` = 0");
		$stm_overdue->execute();
		$overdue = $stm_overdue->rowCount();

		return $overdue;	
	}

	function tasks_pending_training_tasks2 (){
		// make PDO variable available for functions
		global $db;
		
		$stm = $db->prepare("SELECT DISTINCT `orderId` FROM `mod_foxycart_training_tasks` WHERE `task` = 2 AND `status` = 0");
		$stm->execute();
		$pendingTasks = $stm->rowCount();

		return $pendingTasks;	
	
	}

	function tasks_pending_finance(){
		global $db;

		$stm = $db->prepare("SELECT DISTINCT `orderId` FROM `mod_foxycart_finance_tasks` WHERE `task` = 1 AND `status` = 0");
		$stm->execute();

		$pendingTasks = $stm->rowCount();

		return $pendingTasks;	

	}

	function tasks_overdue_finance (){
		// make PDO variable available for functions
		global $db;
		
		$stm_overdue = $db->prepare("SELECT DISTINCT `orderId`
											FROM mod_foxycart_finance_tasks
											WHERE  `dateInserted` < DATE_SUB( NOW( ) , INTERVAL 48 HOUR ) AND `task` = 1 AND `status` = 0");
		$stm_overdue->execute();
		$overdue = $stm_overdue->rowCount();

		return $overdue;
	}

	function tasks_pending_finance2 (){
		global $db;

		$stm = $db->prepare("SELECT DISTINCT `orderId` FROM `mod_foxycart_finance_tasks` WHERE `task` = 2 AND `status` = 0");
		$stm->execute();

		$pendingTasks = $stm->rowCount();

		return $pendingTasks;	
	}

	function redirect_to($location = NULL) {
		if ($location != NULL) {
			header("Location:{$location}");
			exit;
		}
	}

	function myTruncate($string, $limit, $break=".", $pad="..."){
		// return with no change if string is shorter than $limit
		if(strlen($string) <= $limit) return $string;

		// is $break present between $limit and the end of the string?
		if(false !== ($breakpoint= strpos($string, $break, $limit))){
			if($breakpoint < strlen($string) -1){
				$string = substr($string, 0, $breakpoint) . $pad;
			}
		}
		return $string;
	}


	function pagination_sql($start, $limit, $tableName){
		$query1 = "SELECT * FROM $tableName LIMIT $start, $limit";
		$result = mysql_query($query1);
		return $result;
	}

	function pagination($tableName, $targetpage, $limit){
		//$tableName="properties";
		//$targetpage = "test2.php";

		//Must be set and integer if not redirect to page=1
		if(!isset($_GET['page']) || !(int)$_GET['page']){
			redirect_to($targetpage.'?page=1');
		}
		//Total pages
		$total_pages = total_pages($tableName);

		//redirect to page=1 if page > num rows in a query1
		if($_GET['page'] > ceil($total_pages/$limit)){
			redirect_to($targetpage.'?page=1');
		}

		$stages = 3;
		$page = mysql_escape_string($_GET['page']);
		$start = set_start($limit, $page);

		// Get page data
		pagination_sql($start, $limit, $tableName);

		// Initial page num setup
		if ($page == 0){$page = 1;}
		$prev = $page - 1;
		$next = $page + 1;
		$lastpage = ceil($total_pages/$limit);
		$LastPagem1 = $lastpage - 1;


		$paginate = '';
		if($lastpage > 1)
		{
			$paginate .= "<div class='paginate'>";
			// Previous
			if ($page > 1){
				$paginate.= "<a href='$targetpage?page=$prev'>previous</a>";
			}else{
				$paginate.= "<span class='disabled'>previous</span>";
			}

			// Pages
			if ($lastpage < 7 + ($stages * 2))	// Not enough pages to breaking it up
			{
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}
				}
			}
			elseif($lastpage > 5 + ($stages * 2))	// Enough pages to hide a few?
			{
				// Beginning only hide later pages
				if($page < 1 + ($stages * 2))
				{
					for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
					{
						if ($counter == $page){
							$paginate.= "<span class='current'>$counter</span>";
						}else{
							$paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}
					}
					$paginate.= "...";
					$paginate.= "<a href='$targetpage?page=$LastPagem1'>$LastPagem1</a>";
					$paginate.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";
				}
				// Middle hide some front and some back
				elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
				{
					$paginate.= "<a href='$targetpage?page=1'>1</a>";
					$paginate.= "<a href='$targetpage?page=2'>2</a>";
					$paginate.= "...";
					for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
					{
						if ($counter == $page){
							$paginate.= "<span class='current'>$counter</span>";
						}else{
							$paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}
					}
					$paginate.= "...";
					$paginate.= "<a href='$targetpage?page=$LastPagem1'>$LastPagem1</a>";
					$paginate.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";
				}
				// End only hide early pages
				else
				{
					$paginate.= "<a href='$targetpage?page=1'>1</a>";
					$paginate.= "<a href='$targetpage?page=2'>2</a>";
					$paginate.= "...";
					for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page){
							$paginate.= "<span class='current'>$counter</span>";
						}else{
							$paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}
					}
				}
			}

					// Next
			if ($page < $counter - 1){
				$paginate.= "<a href='$targetpage?page=$next'>next</a>";
			}else{
				$paginate.= "<span class='disabled'>next</span>";
				}

			$paginate.= "</div>";
			return $paginate;
		}
	}

	function age($dob){
		$age = date("Y", time()) - date("Y", strtotime($dob));
		return $age;
	}

	// this functions formats dd/mm/yyyy to mysql format Y-m-d
	function format_date($date){
		$date_details = explode("-", $date);
		return date("Y-m-d", mktime(0, 0, 0, $date_details[1], $date_details[0], $date_details[2]));
	}
?>