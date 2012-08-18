<?php
// FoxyCart API Key
$jdatafeedkey	 = 'gUaYYG35XI7hS12EYjCfyXYZz4xcYfZ541YTBVSuvTFhJyLCHfI67BZwvmyk';


require_once('class.rc4crypt.php');


$link = mysql_connect('localhost', 'uxhausco_fcadmin', 'swEc2uth9st9');
$dbSelected = mysql_select_db('uxhausco_fc789132', $link);

// You can change the following data if you want to customize what data gets written.
if (isset($_POST["FoxyData"])) {
	// Get the raw data and initialize variables
	$FoxyData_encrypted = urldecode($_POST["FoxyData"]);
	$FoxyData_decrypted = rc4crypt::decrypt($jdatafeedkey,$FoxyData_encrypted);

	$xml = new SimpleXMLElement($FoxyData_decrypted);
	
	foreach ($xml->transactions->transaction as $transaction) {
		$totalTaxable = 0;
		$totalGST = 0;
		$success = "foxy";
		// Loop through to get the product code, name, customer name, date, and transaction ID
		$orderid = $transaction->id;
		$orderDate = $transaction->transaction_date;
		$customerFirstName = mysql_real_escape_string($transaction->customer_first_name);
		$customerLastName = mysql_real_escape_string($transaction->customer_last_name);
		$customerCompany = mysql_real_escape_string($transaction->customer_company);
		$customerAddress1 = mysql_real_escape_string($transaction->customer_address1);
		$customerAddress2 = mysql_real_escape_string($transaction->customer_address2);
		$customerCity = mysql_real_escape_string($transaction->customer_city);
		$customerState = mysql_real_escape_string($transaction->customer_state);
		$customerPostCode = mysql_real_escape_string($transaction->customer_postal_code);
		$customerCountry = mysql_real_escape_string($transaction->customer_country);
		$customerPhone = mysql_real_escape_string($transaction->customer_phone);
		$customerEmail = mysql_real_escape_string($transaction->customer_email);
		// Get the Work_Phone custom field
		foreach ($transaction->custom_fields->custom_field as $cfield) {
			$cfield_name = $cfield->custom_field_name;
			$cfield_value = $cfield->custom_field_value;
			if ($cfield_name == 'Work_Phone') {
				$customerWorkPhone = $cfield_value;
			}
			if ($cfield_name == 'customer_position') {
				$customerPosition = $cfield_value;
			}
		}

		$sql = "INSERT INTO `mod_foxycart_customers` (orderid, orderDate, customerFirstName, customerLastName, CustomerCompany, CustomerPosition, customerAddress1, customerAddress2, customerCity, customerState, customerPostCode, customerCountry, customerPhone, customerWorkPhone, customerEmail) 
				  VALUES ($orderid, '$orderDate', '$customerFirstName', '$customerLastName', '$customerCompany', '$customerPosition', '$customerAddress1', '$customerAddress2', '$customerCity', '$customerState', '$customerPostCode', '$customerCountry', '$customerPhone', '$customerWorkPhone', '$customerEmail')";
		$result = mysql_query($sql);

		if ($result) {
			$billingFirstName = mysql_real_escape_string($transaction->shipping_first_name);
			$billingLastName = mysql_real_escape_string($transaction->shipping_last_name);
			$billingCompany = mysql_real_escape_string($transaction->shipping_company);
			$billingAddress1 = mysql_real_escape_string($transaction->shipping_address1);
			$billingAddress2 = mysql_real_escape_string($transaction->shipping_address2);
			$billingCity = mysql_real_escape_string($transaction->shipping_city);
			$billingState = mysql_real_escape_string($transaction->shipping_state);
			$billingPostCode = mysql_real_escape_string($transaction->shipping_postal_code);
			$billingCountry = mysql_real_escape_string($transaction->shipping_country);

			$sql = "INSERT INTO `mod_foxycart_billing` (orderid, billingFirstName, billingLastName, billingCompany, billingAddress1, billingAddress2, billingCity, billingState, billingPostCode, billingCountry) 
					  VALUES ($orderid, '$billingFirstName', '$billingLastName', '$billingCompany', '$billingAddress1', '$billingAddress2', '$billingCity', '$billingState', '$billingPostCode', '$billingCountry')";
			$result = mysql_query($sql);

			if ($result) {
				$orderProduct = mysql_real_escape_string($transaction->product_total);
				$orderTax = mysql_real_escape_string($transaction->tax_total);
				$orderShipping = mysql_real_escape_string($transaction->shipping_total);
				$orderTotal = mysql_real_escape_string($transaction->order_total);
				$purchaseOrder = mysql_real_escape_string($transaction->purchase_order);
				$ewayId = mysql_real_escape_string($transaction->processor_response);
				
				// If the processor response is Purchase Order then leave this empty so only eWay IDs are shown
				if ($ewayId == "Purchase Order") {
					$ewayId = "";
				}
				// If a discount has been applied then get the name
				$discountName = "";
				if (isset($transaction->discounts->discount->name)){
					$discountName = mysql_real_escape_string($transaction->discounts->discount->name);
				}
				// If a discount has been applied then get the value
				$discountAmount = 0;
				if (isset($transaction->discounts->discount->amount)){
					$discountAmount = mysql_real_escape_string($transaction->discounts->discount->amount);
				}
				$sql = "INSERT INTO `mod_foxycart_orders` (orderid, orderProduct, orderTax, orderShipping, orderTotal, purchaseOrder, ewayId, discountName, discountAmount) 
						  VALUES ($orderid, $orderProduct, $orderTax, $orderShipping, $orderTotal, '$purchaseOrder', '$ewayId', '$discountName', $discountAmount)";
				$result = mysql_query($sql);
				$get_orders_id = mysql_insert_id();

				// Create the Finance task for this order
				$sql = "INSERT INTO `mod_foxycart_finance_tasks` (orderid, task, status, dateInserted) 
						  VALUES ($orderid, 1, 0, '$orderDate')";
				$result = mysql_query($sql);

				if ($result) {
					foreach ($transaction->transaction_details->transaction_detail as $product) {
						// Get the product details
						$productName = $product->product_name;
						$productQuantity = $product->product_quantity;
						$productPrice = $product->product_price;
						$productCode = $product->product_code;
						$productCategory = $product->category_code;

						// Calculate the total of all products which have GST applied
						if ($productCategory != 'gst-exempt' && $productCategory != 'rto-units' && $productCategory != 'NEW') {
							$totalTaxable += $productPrice;
						}

						// If the product is a course then get the course transaction detail options
						if ($productCategory == 'DEFAULT' || $productCategory == 'NEW' || $productCategory == 'gst-exempt' || $productCategory == 'rto-units') {
							foreach ($product->transaction_detail_options->transaction_detail_option as $option) {
								$option_name = $option->product_option_name;
								$option_value = $option->product_option_value;

								if ($option_name == 'location') {
									$productLocation = $option_value;
								}
								if ($option_name == 'start') {
									$productStart = $option_value;
									$productStart = str_replace('/','-',$productStart);
									$productStart = date('Y-m-d H:i:s', strtotime($productStart));
								}
								if ($option_name == 'end') {
									$productEnd = $option_value;
									$productEnd = str_replace('/','-',$productEnd);
									$productEnd = date('Y-m-d H:i:s', strtotime($productEnd));
								}
							}
							$sql = "INSERT INTO `mod_foxycart_products` (orderid, productName, productQuantity, productPrice, productCode, productCategory, productLocation, productStart, productEnd) 
							  VALUES ($orderid, '$productName', $productQuantity, $productPrice, '$productCode', '$productCategory', '$productLocation', '$productStart', '$productEnd')";
							$result = mysql_query($sql);

							// Create the Training task for the course
							$sql = "INSERT INTO `mod_foxycart_training_tasks` (orderid, task, status, dateInserted) 
									  VALUES ($orderid, 1, 0, '$orderDate')";
							$result = mysql_query($sql);
						}

						// Else the product is a standard and does not have any transaction detail options
						else {
							$sql = "INSERT INTO `mod_foxycart_products` (orderid, productName, productQuantity, productPrice, productCode, productCategory) 
							  VALUES ($orderid, '$productName', $productQuantity, $productPrice, '$productCode', '$productCategory')";
							$result = mysql_query($sql);

							// Create the Training task for the standard
							$sql = "INSERT INTO `mod_foxycart_training_tasks` (orderid, task, status, dateInserted) 
									  VALUES ($orderid, 2, 0, '$orderDate')";
							$result = mysql_query($sql);
						}
						
						
						if (($result) && ($success == "foxy")) {
							$success = "foxy";
						} else {
							$success = "error";
						}
					}
					//Calculate the GST and update the order table
					$totalGST = $totalTaxable - ($totalTaxable/1.10);
					$sql = "UPDATE `mod_foxycart_orders` SET `orderTax`=$totalGST 
						  WHERE `id`=$get_orders_id LIMIT 1";
					$result = mysql_query($sql);
				}
				else {
					$success = "error";
				}		
			}
			else {
				$success = "error";
			}
		} else {
			$success = "error";
		}
		// Return value of $success to Foxycart so it know where it stands
		echo $success;
	}
}


?>