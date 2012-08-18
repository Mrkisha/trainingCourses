<?php
	
	require '../includes/database.php';
	include '../includes/functions.php';

	//echo $_POST['orderId'];

	if(!isset($_POST['orderId'])){
		redirect_to('../index.php');
		exit;
	}


// products /////////////////////////////////////////////////////////////////////////////////
	$stm = $db->prepare("SELECT
							    `productLocation`
							    , `productStart`
							    , `productEnd`
							    , `productCode`
							    , `productCategory`
							    , `productQuantity`
							    , `productPrice`
							    , `productName`
							FROM
							    `mod_foxycart_products`
							    WHERE (`productCategory` = 'default' OR `productCategory` = 'gst-exempt' OR `productCategory` = 'rto-units' OR `productCategory` = 'new')
							AND (`orderId` = :orderId);");
	$stm->bindParam(":orderId", $_POST['orderId']);
	$stm->execute();

	$data = $stm->fetchAll();

// orders /////////////////////////////////////////////////////////////////////////

	$stm_orders = $db->prepare("SELECT * 
									FROM  `mod_foxycart_orders`
									WHERE `orderId` = :orderId ");
	$stm_orders->bindParam(":orderId", $_POST['orderId']);
	$stm_orders->execute();

	$data_orders = $stm_orders->fetchAll();

// customers /////////////////////////////////////////////////////////////////////////

	$stm_customers = $db->prepare("SELECT * 
									FROM `mod_foxycart_customers`
									WHERE `orderId` = :orderId ");
	$stm_customers->bindParam(":orderId", $_POST['orderId']);
	$stm_customers->execute();

	$data_customers = $stm_customers->fetchAll();

// billing ///////////////////////////////////////////////////////////////////////////

	$stm_billing = $db->prepare("SELECT * 
									FROM  `mod_foxycart_billing` 
									WHERE `orderId` = :orderId ");
	$stm_billing->bindParam(":orderId", $_POST['orderId']);
	$stm_billing->execute();

	$data_billing = $stm_billing->fetchAll();

	/*echo "<pre>";
	print_r($data_billing);
	echo "</pre>";*/

?>

<div class="leftCol">
	<table class="fc_details">
		<thead>
			<tr>
				<th width="320"><span>Item</span></th>
				<th width="26"><span>Qty</span></th>
				<th width="73"><span>Price</span></th>
			</tr>
		</thead>
		<tbody>
			
			<?php
				foreach($data as $key){
					echo "<tr>";
					echo "<td><span><strong>{$key['productName']}</strong></span>";
					echo "<div class=\"list arrowBlue\">";
					echo "<ul>";
					echo "<li> <span>Location:</span> <span>{$key['productLocation']}</span> </li>";
					echo "<li> <span>Start:</span> <span>" . date("d/m/Y H:i:s", strtotime($key['productStart']))."</span> </li>";
					echo "<li> <span>End:</span> <span>".date("d/m/Y H:i:s", strtotime($key['productEnd']))."</span> </li>";
					echo "<li> <span>Code:</span> <span>{$key['productCode']}</span> </li>";
					echo "<li> <span>Category:</span> <span>{$key['productCategory']}</span> </li>";
					echo "</ul></div></td>";
					echo "<td>{$key['productQuantity']}</td>";
					$price_total = $key['productPrice'] * $key['productQuantity'];
					echo "<td><span>\${$price_total}<br />(\${$key['productPrice']} each)</span><input type=\"button\" value=\"+ Wisenet\" class=\"blueBtn\"></td>";
				}

			?>
		</tbody>
		<tfoot>

			<tr>
				<td colspan="2">Subtotal:</td>
				<td colspan="2">
				<?php
					echo "$";
					echo $data_orders[0]['orderTotal'] - $data_orders[0]['discountAmount'];
				?>
				</td>
			</tr>
			<tr>
				<td colspan="2">Discounts:</td>
				<td colspan="2">
				<?php
					echo "$";
					echo $data_orders[0]['discountAmount'];
				?>
				</td>
			</tr>
			<tr>
				<td colspan="2">Order Total:</td>
				<td colspan="2">
				<?php
					echo "$";
					echo $data_orders[0]['orderTotal'];
				?>
				</td>
			</tr>
			<tr>
				<td colspan="2">GST Included:</td>
				<td colspan="2">
				<?php
					echo "$";
					echo $data_orders[0]['orderTax'];
				?>
				</td>
			</tr>
		</tfoot>
	</table>
</div>
<div class="rightCol">
	<table class="customer_details">
		<thead>
			<tr>
				<th width="295">Attendee Details</th>
				<th width="295">Billing Details</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><p> 
				<?php
						echo $data_customers[0]['customerFirstName']." " . $data_customers[0]['customerLastName'] . "<br>";
						echo $data_customers[0]['customerCompany'] . "<br>";
						echo $data_customers[0]['customerAddress1'] . "<br>";
						if($data_customers[0]['customerAddress2'] != ''){
							echo $data_customers[0]['customerAddress2'] . "<br>";
						}
						echo "{$data_customers[0]['customerCity']} {$data_customers[0]['customerState']} {$data_customers[0]['customerPostcode']}<br>";
						echo $data_customers[0]['customerCountry'] . "<br>";
				?>
					</p>
					<p> <strong>Email:</strong> <?php echo $data_customers[0]['customerEmail']; ?><br>
						<strong>Phone:</strong> <?php echo $data_customers[0]['customerPhone']; ?><br>
					</p>
					<p> <strong>Customer Position:</strong> <?php echo $data_customers[0]['customerPosition']; ?><br>
						<strong>Work Phone:</strong> <?php echo $data_customers[0]['customerPhone']; ?><br>
					</p></td>
				<td>
					<p>
				<?php
						echo $data_billing[0]['billingFirstName'] . " " . $billingFirstName[0]['billingLastName'] . "<br>";
						echo $data_billing[0]['billingAddress1'] . "<br>";
						if($data_billing[0]['billingAddress2'] != ''){
							echo $data_billing[0]['billingAddress2'] . "<br>";
						}
						echo "{$data_billing[0]['billingCity']} {$data_billing[0]['billingState']} {$data_billing[0]['billingPostCode']}<br>";
						echo $data_billing[0]['billingCountry'] . "<br>";
				?>
					</p>
					<p> 
					<?php
						if($data_orders[0]['ewayId'] != ''){
							echo "<strong>eWay ID: </strong>" . $data_orders[0]['ewayId'];
						} else {
							echo "<strong>Purchase Order: </strong>" . $data_orders[0]['purchaseOrder'];
						}
					?>
				</td>
			</tr>
		</tbody>
	</table>
	<div class="widget no-margin">
		<div class="head closed normal">
			<h5>Notes</h5>
		</div>
		<div class="body" style="display: none; ">
			<div class="list plusBlue">
				<ul>
					<li>6/6/2012 8:51pm: Note 1</li>
					<li>6/6/2012 8:51pm: Note 2</li>
				</ul>
			</div>
			<form action="" class="mainForm notesForm">
				<fieldset>
					<label>
						<input type="text" name="inputtext">
					</label>
					<div class="formRight">
						<input type="submit" value="Add comment" class="greyishBtn submitForm">
					</div>
					<div class="fix"></div>
				</fieldset>
			</form>
		</div>
	</div>
</div>