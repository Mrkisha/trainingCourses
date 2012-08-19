<?php

	require '../includes/database.php';
	require '../includes/functions.php';

	$option = $_POST['option'];
	$sql_flotSalesByMonth;

	switch ($option) {
		case '1':
			$sql_flotSalesByMonth = 'SELECT `YEAR`, `MONTH`, `total` FROM (
										SELECT * FROM 
											(SELECT YEAR(CURRENT_DATE) AS YEAR
											UNION
											 SELECT (YEAR(CURRENT_DATE)+1) AS YEAR
											) AS `year`, 
											(SELECT 1 AS MONTH UNION 
											 SELECT 2 AS MONTH UNION 
											 SELECT 3 AS MONTH UNION 
											 SELECT 4 AS MONTH UNION 
											 SELECT 5 AS MONTH UNION 
											 SELECT 6 AS MONTH UNION 
											 SELECT 7 AS MONTH UNION 
											 SELECT 8 AS MONTH UNION 
											 SELECT 9 AS MONTH UNION 
											 SELECT 10 AS MONTH UNION 
											 SELECT 11 AS MONTH UNION 
											 SELECT 12 AS MONTH
											 )
											 AS `month`  
										WHERE (`month` >= 7 AND `year` = YEAR(CURRENT_DATE)) OR (`month` <= 6 AND `year` = YEAR(CURRENT_DATE)+1)
										ORDER BY `year`, `month`
									) AS `calendar`

									LEFT JOIN (
										SELECT
											 SUM(`mod_foxycart_orders`.`orderTotal`) AS `total`
										   , MONTH(`mod_foxycart_customers`.`orderDate`) AS `monthTotal`
										   , YEAR(`mod_foxycart_customers`.`orderDate`) AS `yearTotal`
										FROM `mod_foxycart_orders`
											INNER JOIN `mod_foxycart_customers` ON (`mod_foxycart_orders`.`orderId` = `mod_foxycart_customers`.`orderId`)
										WHERE (MONTH(`mod_foxycart_customers`.`orderDate`) >= 7 AND YEAR(`mod_foxycart_customers`.`orderDate`) = YEAR(CURRENT_DATE)) 
											OR 
											  (MONTH(`mod_foxycart_customers`.`orderDate`) <= 6 AND YEAR(`mod_foxycart_customers`.`orderDate`) = YEAR(CURRENT_DATE)+1)
										GROUP BY `monthTotal`, `yearTotal`
										ORDER BY `yearTotal` ASC, `monthTotal` ASC
									) `total` ON (`calendar`.`month` = `total`.`monthTotal` AND `calendar`.`year` = `total`.`yearTotal`)';
			break;

		case '2':
			$sql_flotSalesByMonth = '';
			break;

	}

	$stm_flotSalesByMonth = $db->query($sql_flotSalesByMonth);
	$stm_flotSalesByMonth->execute();
	$data_flotSalesByMonth = $stm_flotSalesByMonth->fetchAll(PDO::FETCH_ASSOC);

	$counter = 1;
	foreach($data_flotSalesByMonth as $key){
		$json_data[] = array(
			(int)$counter, 
			(int)$key['total']
		);
		$counter++;
	}

	echo json_encode($json_data);


