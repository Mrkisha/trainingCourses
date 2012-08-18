<?php

	require '../includes/database.php';

	echo 1;
	echo $_POST['orderId'];

	$id = 11639854;

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
			<tr>
				<td><span><strong>productName</strong></span>
					<div class="list arrowBlue">
						<ul>
							<li> <span>Location:</span> <span>productLocation</span> </li>
							<li> <span>Start:</span> <span>productStart</span> </li>
							<li> <span>End:</span> <span>productEnd</span> </li>
							<li> <span>Code:</span> <span>productCode</span> </li>
							<li> <span>Category:</span> <span>productCategory</span> </li>
						</ul>
					</div></td>
				<td>productQuantity</td>
				<td><span>productPrice * productQty<br />
					(productPrice each)</span>
					<input type="button" value="+ Wisenet" class="blueBtn"></td>
			</tr>
			<tr>
				<td><span><strong>productName</strong></span>
					<div class="list arrowBlue">
						<ul>
							<li> <span>Location:</span> <span>productLocation</span> </li>
							<li> <span>Start:</span> <span>productStart</span> </li>
							<li> <span>End:</span> <span>productEnd</span> </li>
							<li> <span>Code:</span> <span>productCode</span> </li>
							<li> <span>Category:</span> <span>productCategory</span> </li>
							<li> <span>Added to Wisenet:</span> <span>DATETIME <a href="#">Undo</a></span> </li>
						</ul>
					</div></td>
				<td>productQuantity</td>
				<td><span>productPrice * productQty<br />
					(productPrice each)</span>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="2">Subtotal:</td>
				<td colspan="2">orderTotal - discountAmount</td>
			</tr>
			<tr>
				<td colspan="2">Discounts:</td>
				<td colspan="2">discountAmount</td>
			</tr>
			<tr>
				<td colspan="2">Order Total:</td>
				<td colspan="2">orderTotal</td>
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
				<td>
					<?php
						$stm_customer = $db->prepare("SELECT * FROM `mod_foxycart_customers` 
														WHERE `orderId`=".$id);
						$stm_customer->execute();
						$data_customer = $stm_customer->fetchAll();
						if($stm_customer->rowCount() > 0){
							foreach($data_customer as $key_customer){
								echo $key_customer['customerFirstName'] . " " . $key_customer['customerLastName'] . "<br />";
								echo $key_customer['customerCompany'] . "<br />";
							}
						}
						?>




					<p> customerFirstName customerLastName<br>
						customerCompany<br>
						customerAddress1<br>
						customerAddress2<br>
						customerCity State Postcode<br>
						customerCountry<br>
					</p>
					<p> <strong>Email:</strong> customerEmail<br>
						<strong>Phone:</strong> customerPhone<br>
					</p>
					<p> <strong>Customer Position:</strong> customerPositionTitle<br>
						<strong>Work Phone:</strong> customerWorkPhone<br>
					</p></td>
				<td><p> billingFirstName billingLastName<br>
						billingAddress1<br>
						billingAddress2<br>
						billingCity State Postcode<br>
						billingCountry </p>
					<p> <strong>Puchase Order:</strong>purchaseOrder</p>
					<p><strong>eWay ID:</strong> ewayID </p></td>
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