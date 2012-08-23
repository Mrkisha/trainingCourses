<?php
	session_start();

	require '../includes/database.php';
	require '../includes/functions.php';

	if(!isset($_POST) || empty($_POST)){
		redirect_to('../index.php');
	}

	foreach($_POST as $key => $value){
		$$key = $value;
	}

	// if no records in customer table we set $orderId = 1000001;
	$stm_customers = $db->query("SELECT  `orderId` 
									FROM  `mod_foxycart_customers` 
									WHERE CHAR_LENGTH(`orderId`) = 7
									ORDER BY  `orderId` DESC 
									LIMIT 0, 1");
	$stm_customers->execute();
	$data_customers = $stm_customers->fetch(PDO::FETCH_ASSOC);

	if($stm_customers->rowCount() == 0){
		$orderId = 1000001;
	} else {
		$orderId = (int)$data_customers['orderId'] + 1;
	}

	// set order date
	$orderDate = date("Y-m-d H:i:s");

	// insert customer
	$stm_customer = $db->prepare("INSERT INTO `mod_foxycart_customers` 
										(	orderId,
											orderDate, 
											customerFirstName, 
											customerLastName, 
											CustomerCompany, 
											CustomerPosition, 
											customerAddress1, 
											customerAddress2, 
											customerCity, 
											customerState, 
											customerPostCode, 
											customerCountry, 
											customerPhone, 
											customerWorkPhone, 
											customerEmail
										) 
									VALUES (
											'$orderId',
											'".$orderDate."', 
											:customerFirstName, 
											:customerLastName, 
											:customerCompany, 
											:customerPosition, 
											:customerAddress1, 
											:customerAddress2, 
											:customerCity, 
											:customerState, 
											:customerPostCode, 
											'AU',
											:customerPhone, 
											:customerWorkPhone, 
											:customerEmail)");

	$stm_customer->bindParam(":customerFirstName",	$customerFirstName);
	$stm_customer->bindParam(":customerLastName", 	$customerLastName);
	$stm_customer->bindParam(":customerCompany", 	$customerCompany);
	$stm_customer->bindParam(":customerPosition", 	$customerPosition);
	$stm_customer->bindParam(":customerAddress1", 	$customerAddress1);
	$stm_customer->bindParam(":customerAddress2", 	$customerAddress2);
	$stm_customer->bindParam(":customerCity", 		$customerCity);
	$stm_customer->bindParam(":customerState", 		$customerState);
	$stm_customer->bindParam(":customerPostCode", 	$customerPostCode);
	$stm_customer->bindParam(":customerPhone", 		$customerPhone);
	$stm_customer->bindParam(":customerWorkPhone", 	$customerWorkPhone);
	$stm_customer->bindParam(":customerEmail", 		$customerEmail);

	$stm_customer->execute();

/*	$orderId = $db->lastInsertId();*/

	if(!isset($chbox)){
/*		echo 1;*/
		$stm_billing = $db->prepare("INSERT INTO `mod_foxycart_billing` 
											(
												orderId, 
												billingFirstName, 
												billingLastName, 
												billingCompany, 
												billingAddress1, 
												billingAddress2, 
												billingCity, 
												billingState, 
												billingPostCode, 
												billingCountry
												) 
									VALUES (
												:orderId,
												:billingFirstName, 
												:billingLastName, 
												:billingCompany, 
												:billingAddress1, 
												:billingAddress2, 
												:billingCity, 
												:billingState,
												:billingPostCode, 
												'AU'
											)");

		$stm_billing->bindParam(":orderId",				$orderId);
		$stm_billing->bindParam(":billingFirstName",	$billingFirstName);
		$stm_billing->bindParam(":billingLastName", 	$billingLastName);
		$stm_billing->bindParam(":billingCompany", 		$billingCompany);
		$stm_billing->bindParam(":billingAddress1", 	$billingAddress1);
		$stm_billing->bindParam(":billingAddress2",		$billingAddress2);
		$stm_billing->bindParam(":billingCity", 		$billingCity);
		$stm_billing->bindParam(":billingState", 		$billingState);
		$stm_billing->bindParam(":billingPostCode", 	$billingPostCode);

		$stm_billing->execute();
	} else {
		/*echo "2";*/
		$stm_billing = $db->prepare("INSERT INTO `mod_foxycart_billing` 
											(
												orderId, 
												billingFirstName, 
												billingLastName, 
												billingCompany, 
												billingAddress1, 
												billingAddress2, 
												billingCity, 
												billingState, 
												billingPostCode, 
												billingCountry
												) 
									VALUES (
												:orderId,
												:billingFirstName, 
												:billingLastName, 
												:billingCompany, 
												:billingAddress1, 
												:billingAddress2, 
												:billingCity, 
												:billingState,
												:billingPostCode, 
												'AU'
											)");

		$stm_billing->bindParam(":orderId",				$orderId);
		$stm_billing->bindParam(":billingFirstName",	$customerFirstName);
		$stm_billing->bindParam(":billingLastName", 	$customerLastName);
		$stm_billing->bindParam(":billingCompany", 		$customerCompany);
		$stm_billing->bindParam(":billingAddress1", 	$customerAddress1);
		$stm_billing->bindParam(":billingAddress2",		$customerAddress2);
		$stm_billing->bindParam(":billingCity", 		$customerCity);
		$stm_billing->bindParam(":billingState", 		$customerState);
		$stm_billing->bindParam(":billingPostCode", 	$customerPostCode);

		$stm_billing->execute();
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	// calculate values to insert into orders
	$productPrice = 	(double)ltrim(str_replace(",", "", $productPrice), "$");
	$productPrice2 = 	(double)ltrim(str_replace(",", "", $productPrice2), "$");
	// check if $productPrice2 isset
	if(!isset($productPrice2)){
		$product2 = 0;
	}

	// calculate order products price
	$orderProduct = $productPrice + $productPrice2;

	// calculate $orderTax
	$orderTax = 0;

	if(isset($productTax)){
		$orderTax = $productPrice - ($productTax / 1.1);
	}

	if(isset($productTax2)){
		$orderTax = $orderTax + ($productPrice2 - ($productTax2 / 1.1));
	}

	$orderShipping = 0;
	$orderTotal = $productPrice + $productPrice2;

	// insert order
	$stm_order = $db->prepare("INSERT INTO `mod_foxycart_orders` 
								(
									orderid, 
									orderProduct, 
									orderTax, 
									orderShipping, 
									orderTotal
								) 
								VALUES (
									:orderId, 
									:orderProduct, 
									:orderTax, 
									:orderShipping, 
									:orderTotal
								)");

	$stm_order->bindParam(":orderId", 		$orderId);
	$stm_order->bindParam(":orderProduct", 	$orderProduct);
	$stm_order->bindParam(":orderTax", 		$orderTax);
	$stm_order->bindParam(":orderShipping", $orderShipping);
	$stm_order->bindParam(":orderTotal", 	$orderTotal);

	$stm_order->execute();

	// insert notes if not empty ////////////////////////////////////////////////////////////////////
	$noteDate = $orderDate;

	$stm_notes = $db->prepare("INSERT INTO `mod_foxycart_orders_notes` (orderId, note, noteDate, userId) 	
								VALUES (:orderId, :notes, :noteDate, :userId )");
	$stm_notes->bindParam(":orderId", 	$orderId);
	$stm_notes->bindParam(":notes",		$notes);
	$stm_notes->bindParam(":noteDate", 	$noteDate);
	$stm_notes->bindParam(":userId", 	user_id());



	$stm_notes->execute();


	// insert products //////////////////////////////////////////////////////////////////////////////
	$productStart = format_date($productStartDate)." ".$productStartTime;
	$productEnd  = 	format_date($productEndDate)." ".$productEndTime;

	if ($productCategory == 'onsite') {
		$productCode = '3152';
	}
	elseif ($productCategory == 'online') {
		$productCode = '3153';
	}
	elseif ($productCategory == 'workshop') {
		$productCode = '3154';
	}
	elseif ($productCategory == 'rpl') {
		$productCode = '3155';
	}

	$stm_product1 = $db->prepare("INSERT INTO `mod_foxycart_products` 
										(
											orderid, 
											productName, 
											productQuantity, 
											productPrice, 
											productCode, 
											productCategory, 
											productLocation, 
											productStart, 
											productEnd
										) 
									VALUES (
											:orderId, 
											:productName, 
											:productQuantity, 
											:productPrice, 
											:productCode, 
											:productCategory,
											:productLocation, 
											:productStart, 
											:productEnd
											)");

	$stm_product1->bindParam(":orderId", 			$orderId);
	$stm_product1->bindParam(":productName", 		$productName);
	$stm_product1->bindParam(":productQuantity", 	$productQuantity);
	$stm_product1->bindParam(":productPrice", 		$productPrice);
	$stm_product1->bindParam(":productCode", 		$productCode);
	$stm_product1->bindParam(":productCategory", 	$productCategory);
	$stm_product1->bindParam(":productLocation", 	$productLocation);
	$stm_product1->bindParam(":productStart", 		$productStart);
	$stm_product1->bindParam(":productEnd", 		$productEnd);

	$stm_product1->execute();
	/*echo "<br> product 1";*/
	$productId = $db->lastInsertId();

	// insert training task if checkbox is checked //////////////////////////////////////////////////////////////////////////////
	if($addWisenet == 1){
		$stm_task1 = $db->prepare("INSERT INTO `mod_foxycart_training_tasks` 
										(
											orderid, 
											productId, 
											task, 
											status, 
											dateInserted
										) 
									VALUES (
											:orderId, 
											:productId, 
											1,  
											0,
											'".$orderDate."'
											)");

		$stm_task1->bindParam(":orderId", 	$orderId);
		$stm_task1->bindParam(":productId", $productId);

		$stm_task1->execute();
	}

	// insert into onsite 
		if($productCategory == 'onsite'){
		for($i = 1; $i <= 10; $i++){
			$stm_onsite = $db->prepare("INSERT INTO `mod_foxycart_onsite_tasks` 
											(
												orderId, 
												productId, 
												task, 
												status, 
												dateInserted
											) 
											VALUES (
												$orderId, 
												$productId, 
												$i, 
												0, 
												'$orderDate')

								");
			$stm_onsite->execute();
		}
	}
	

	// insert product 2 if applicable //////////////////////////////////////////////////////////////
	if ($another == 'anotherCourse') {

	
		$productStart2 = 	format_date($productStartDate2)." ".$productStartTime2;
		$productEnd2 =		format_date($productEndDate2)." ".$productEndTime2;

		if ($productCategory2 == 'onsite') {
			$productCode2 = '3152';
		}
		elseif ($productCategory2 == 'online') {
			$productCode2 = '3153';
		}
		elseif ($productCategory2 == 'workshop') {
			$productCode2 = '3154';
		}
		elseif ($productCategory2 == 'rpl') {
			$productCode2 = '3155';
		}

		$stm_product2 = $db->prepare("INSERT INTO `mod_foxycart_products` (
											orderid, 
											productName, 
											productQuantity, 
											productPrice, 
											productCode, 
											productCategory, 
											productLocation, 
											productStart, 
											productEnd
										) 
										VALUES (
											:orderId, 
											:productName2, 
											:productQuantity2, 
											:productPrice2, 
											:productCode2, 
											:productCategory2,
											:productLocation2, 
											:productStart2, 
											:productEnd2
											)");
		$stm_product2->bindParam(":orderId", 			$orderId);
		$stm_product2->bindParam(":productName2", 		$productName2);
		$stm_product2->bindParam(":productQuantity2", 	$productQuantity2);
		$stm_product2->bindParam(":productPrice2", 		$productPrice2);
		$stm_product2->bindParam(":productCode2", 		$productCode2);
		$stm_product2->bindParam(":productCategory2", 	$productCategory2);
		$stm_product2->bindParam(":productLocation2", 	$productLocation2);
		$stm_product2->bindParam(":productStart2", 		$productStart2);
		$stm_product2->bindParam(":productEnd2", 		$productEnd2);

		$stm_product2->execute();

		$productId2 = $db->lastInsertId();

		if($addWisenet2 == 1){
			$stm_task2 = $db->prepare("INSERT INTO `mod_foxycart_training_tasks` 
											(
												orderId, 
												productId, 
												task, 
												status, 
												dateInserted
											) 
										VALUES (
												:orderId, 
												:productId2, 
												1,  
												0,
												'".$orderDate."'
												)");

			$stm_task2->bindParam(":orderId", 	$orderId);
			$stm_task2->bindParam(":productId2", $productId2);

			$stm_task2->execute();
		}

		if($productCategory2 == 'onsite'){
			for($i = 1; $i <= 7; $i++){
				$stm_onsite2 = $db->prepare("INSERT INTO `mod_foxycart_onsite_tasks` 
												(
													orderid, 
													productId, 
													task, 
													status, 
													dateInserted
												) 
												VALUES (
													$orderId, 
													$productId2, 
													$i, 
													0, 
													'$orderDate')

									");
				$stm_onsite2->execute();
			}
		}
		/*echo '<br>product 2';*/

		
	}
/*		echo $raiseInvoice;
		echo "<br>";
		echo "INSERT INTO `mod_foxycart_finance_tasks` 
										(
											orderId, 
											task, 
											status, 
											dateInserted
										) 
										VALUES (
											$orderId, 
											1, 
											0, 
											'".$orderDate."')";
die;*/
	if($raiseInvoice == 1){
		$stm_raise = $db->prepare("INSERT INTO `mod_foxycart_finance_tasks` 
									(
										orderId, 
										task, 
										status, 
										dateInserted
									) 
									VALUES (
										:orderId, 
										1, 
										0, 
										'".$orderDate."')");
		$stm_raise->bindParam(":orderId", $orderId);
		$stm_raise->execute();
	}

	// return data for jquery ajax //////////////////////////////////////////////////////////////////
	$return = array();

	$return['productName'] 		= $productName;
	$return['productCategory'] 	= $productCategory;
	$return['customerFirstName']= $customerFirstName;
	$return['customerLastName']	= $customerLastName;
	
	if(isset($productCategory2)){
		$return['productName2'] 		= $productName2;
		$return['productCategory2'] 	= $productCategory2;
	}

	$return['orderDate']	= date("d/m/Y H:i", strtotime($orderDate));
	$return['orderId']   	= $orderId;
	$return['productName'] 	= $productName;
	
	// total price
	$return['orderProduct'] = $orderProduct;
	/*$return['productPrice'] 	= $productPrice;
	$return['productPrice2']	= $productPrice2;*/

	print json_encode($return);
	
	
?>

