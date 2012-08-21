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
								Id
								,`productLocation`
								, `productStart`
								, `productEnd`
								, `productCode`
								, `productCategory`
								, `productQuantity`
								, `productPrice`
								, `productName`
							FROM
								`mod_foxycart_products`
								WHERE (`productCategory` = 'onsite' AND `orderId` = :orderId);");
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

?>

<div class="leftCol">
	<table border="1" cellpadding="0" cellspacing="0" class="fc_details">
		<thead>
			<tr>
				<th colspan="2"><span>Onsite Course Tasks</span></th>
			</tr>
		</thead>
		<tbody>
			
			<?php
				foreach($data as $key){
					$stm_taks_status = $db->prepare("SELECT  `status`, dateCompleted FROM  `mod_foxycart_training_tasks` WHERE  `Id` =  '{$key['Id']}'");
					$stm_taks_status->execute();
					$data_taks_status = $stm_taks_status->fetch(PDO::FETCH_ASSOC);
					/*$status = $data_taks_status['status'];
					$date_completed = $data_taks_status['dateCompleted'];*/
					
					// get onsite tasks data
					$stm_onsite = $db->prepare("SELECT * FROM `mod_foxycart_onsite_tasks` WHERE `productId` = {$key['Id']}");
					$stm_onsite->execute();
					$data_onsite = $stm_onsite->fetchAll(PDO::FETCH_ASSOC);

					echo "<tr>";
					echo "<td colspan=\"2\"><span><strong>{$key['productName']}</strong></span>";
					echo "<div class=\"list arrowBlue\">";
					echo "<ul id='otherTasks'>";

					// create list of onsite tasks
					foreach($data_onsite as $site){
						$taskName = '';
						if ($site['task'] == 1) { $taskName = 'Save MOU to WSS'; }
						elseif ($site['task'] == 2) { $taskName = 'Create Work Order & Logistics Checklist'; }
						elseif ($site['task'] == 3) { $taskName = 'Send trainer Work Order & Client Notes'; }
						elseif ($site['task'] == 4) { $taskName = 'Call client – materials address & next steps'; }
						elseif ($site['task'] == 5) { $taskName = 'Order & send materials'; }
						elseif ($site['task'] == 6) { $taskName = 'Client - 1 week confirmation call'; }
						elseif ($site['task'] == 7) { $taskName = 'Trainer – 3 day confirmation call'; }
						elseif ($site['task'] == 8) { $taskName = 'Post course – trainer pack compliant & saved'; }
						elseif ($site['task'] == 9) { $taskName = 'Post course – client follow up * cert confirmation'; }
						elseif ($site['task'] == 10) { $taskName = 'Finish Task'; }
						if($site['status'] == 0){
							echo "<li>
										{$site['task']}. {$taskName} <a href='#' class='onSite'>Complete</a>
										<input type='hidden' name='siteId' value='{$site['Id']}'>
									</li>";
						} else {
							echo "<li>
										{$site['task']}. {$taskName}
										<span>".date("d-m-Y H:i", strtotime($site['dateCompleted']))."</span>
									</li>";
						}
					}
					echo "</ul>";
					echo "</td>";
				}

			?>
		</tbody>
		<tfoot>

			<tr>
				<td>Subtotal:</td>
				<td>
				<?php
					echo "$";
					echo $data_orders[0]['orderTotal'] - $data_orders[0]['discountAmount'];
				?>
				</td>
			</tr>
			<tr>
				<td>Discounts:</td>
				<td>
				<?php
					echo "$";
					echo $data_orders[0]['discountAmount'];
				?>
				</td>
			</tr>
			<tr>
				<td>GST Included:</td>
				<td>
				<?php
					echo "$";
					echo $data_orders[0]['orderTax'];
				?>
				</td>
			<tr>
				<td>Order Total:</td>
				<td>
				<?php
					echo "$";
					echo $data_orders[0]['orderTotal'];
				?>
				</td>
			</tr>
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
						echo $data_billing[0]['billingFirstName'] . " " . $data_billing[0]['billingLastName'] . "<br>";
						echo $data_billing[0]['billingCompany'] . "<br>";
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
	<table class="customer_details">
		<thead>
			<tr>
				<th width="590">Notes</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<div class="list plusBlue" id="allNotes">
						<ul>
					<?php
						// list notes here
						$stm_notes = $db->prepare("SELECT
														`mod_foxycart_orders_notes`.`orderId`
														, `mod_foxycart_orders_notes`.`note`
														, `mod_foxycart_orders_notes`.`noteDate`
														, `users`.`username`
													FROM `users`
														INNER JOIN `mod_foxycart_orders_notes` 
															ON (`users`.`userID` = `mod_foxycart_orders_notes`.`userId`)
													WHERE `orderId` = :orderId");
						$stm_notes->bindParam(":orderId", $_POST['orderId']);
						$stm_notes->execute();

						if($stm_notes->rowCount() > 0){
							$data_notes = $stm_notes->fetchAll(PDO::FETCH_ASSOC);
							
							foreach($data_notes as $key){
								echo "<li>".date("d/m/Y H:i", strtotime($key['noteDate']))." - {$key['note']} <i>".ucfirst($key['username'])."</i></li>";
							}
							
						} else {
							echo "<p>No notes for this order</p>";
						}
					?>
						</ul>
					</div>
					<form action="" class="mainForm notesForm">
						<fieldset>
							<label>
								<input type="text" id="note" name="inputtext" placeholder="enter your note here and press enter">
							</label>
						</fieldset>
					</form>
				</td>
			</tr>
		</tbody>
	</table>
</div>