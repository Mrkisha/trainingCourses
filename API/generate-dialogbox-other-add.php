	<div class="content">

		<form id="wizForm" class="mainForm">
			<div class="widget">
				<div class="head"></div>

				<fieldset class="step" id="first">
					<h5>Attendee Details - 1 of 4</h5>

					<div class="left">

						<div class="rowElem noborder">
							<label>Email:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="customerEmail" />
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>First Name:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="customerFirstName" />
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Last Name:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="customerLastName" />
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Company:</label>
							<div class="formRight">
								<input type="text" name="customerCompany"/>
							</div><div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Position Title:</label>
							<div class="formRight">
								<input type="text" name="customerPosition"/>
							</div><div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Mobile Phone:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="customerPhone" />
							</div>
							<div class="fix"></div>
						</div>

					</div>

					<div class="right">

						<div class="rowElem">
							<label>Address 1:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="customerAddress1" />
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Address 2:</label>
							<div class="formRight">
								<input type="text" name="customerAddress2"/>
							</div><div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>City:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="customerCity" />
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>State:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="customerState" />
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Postcode:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="customerPostCode" />
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Work Phone:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="customerWorkPhone" />
							</div>
							<div class="fix"></div>
						</div>

					</div>

				</fieldset>


				<fieldset class="step" id="second">
					<h5>Billing Details - 2 of 4</h5>

					<div class="left">

						<div class="rowElem noborder">
							<label>Use same details:</label>
							<div class="formRight">
								<input type="checkbox" id="check1" name="chbox" value="1"/><label for="check1" value="1"></label>
							</div>
							<div class="fix"></div>
						</div>
					
						<div class="rowElem">
							<label>Billing First Name:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="billingFirstName" />
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Billing Last Name:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="billingLastName" />
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Billing Company:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="billingCompany" />
							</div>
							<div class="fix"></div>
						</div>

					</div>
					<div class="right">

						<div class="rowElem">
							<label>Billing Address 1:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="billingAddress1" />
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Billing Address 2:</label>
							<div class="formRight">
								<input type="text" name="billingAddress2"/>
							</div><div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Billing Suburb:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="billingCity" />
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Billing State:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="billingState" />
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Billing Postcode:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="billingPostCode" />
							</div>
							<div class="fix"></div>
						</div>
					</div>

				</fieldset>


				 <fieldset class="step" id="third">
					<h5>Item Details - 3 of 4</h5>

					<div class="left">

						<div class="rowElem noborder">
							<label>Category:<span class="req">*</span></label>
							<div class="formRight ">
							<select name="productCategory"  id="productCategory">
								<option value="">Please select..</option>
								<option value="onsite">Onsite Course</option>
								<option value="online">Online Course</option>
								<option value="workshop">Workshop</option>
								<option value="rpl">RPL</option>
							</select>
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Item Name:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="productName" />
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Item Quantity:<span class="req">*</span></label>
							<div class="formRight onlyNums">
								<input type="text" value="1" name="productQuantity" id="s1" class="onlyNums"/></div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Item Price:<span class="req">*</span></label>
							<div class="formRight onlyNums">
								<input type="text" name="productPrice" id="productPrice" class="onlyNums"/></div>
								<div class="fix"></div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Location:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="productLocation" />
							</div>
							<div class="fix"></div>
						</div>

					</div>
					<div class="right">

						<div class="rowElem">
							<label>Start Date:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="productStartDate" id="productStartDate" class="datepicker" value="<?php echo date("d/m/Y"); ?>"/>
								<input type="text" name="productStartTime" class="timepicker" size="10" value="<?php echo "9:00:00"; ?>">
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem" id="hide">
							<label>End Date:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="productEndDate" id="productEndDate" class="datepicker" value="<?php echo date("d/m/Y"); ?>"/> 
								<input type="text" name="productEndTime" class="timepicker" size="10" value="<?php echo "17:00:00"; ?>">
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>GST included:</label>
							<div class="formRight">
								<input type="checkbox" id="productTax" name="productTax" checked="checked" value="1"/><label for="productTax"></label>
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Add to Wisenet task:</label>
							<div class="formRight">
								<input type="checkbox" id="addWisenet" name="addWisenet" checked="checked" value="1"/><label for="addWisenet"></label>
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Add another item?</label>
							<div class="formRight">
								<select class="link" name="another" id="anotherCourse">
									<option value="fourth" selected="selected">No thanks</option>
									<option value="anotherCourse">Yes please</option>
								</select>
							</div>
							<div class="fix"></div>
						</div>

					</div>

				</fieldset>


				<fieldset class="step" id="anotherCourse">
					<h5>Item Details - 3a of 4</h5>

					<div class="left">

						<div class="rowElem noborder">
							<label>Category:<span class="req">*</span></label>
							<div class="formRight ">
							<select name="productCategory2" id="productCategory2" >
								<option value="">Please select..</option>
								<option value="onsite">Onsite Course</option>
								<option value="online">Online Course</option>
								<option value="workshop">Workshop</option>
								<option value="rpl">RPL</option>
							</select>
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Item Name:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="productName2" id="productName2"/>
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Item Quantity:<span class="req">*</span></label>
							<div class="formRight onlyNums">
								<input type="text" value="1" name="productQuantity2" class="onlyNums"/></div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Item Price:<span class="req">*</span></label>
							<div class="formRight onlyNums">
								<input type="text" name="productPrice2" id="productPrice2" class="onlyNums"/></div>
								<div class="fix"></div>
							<div class="fix"></div>
						</div>

					</div>
					<div class="right">

						<div class="rowElem">
							<label>Location:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="productLocation2" />
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Start Date:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="productStartDate2" id="productStartDate2" class="" value="<?php echo date("d/m/Y"); ?>"/>
								<input type="text" name="productStartTime2" class="timepicker" size="10" value="<?php echo "9:00:00"; ?>">
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>End Date:<span class="req">*</span></label>
							<div class="formRight">
								<input type="text" name="productEndDate2" id="productEndDate2" class="" value="<?php echo date("d/m/Y"); ?>"/> 
								<input type="text" name="productEndTime2" class="timepicker" size="10" value="<?php echo "17:00:00"; ?>">
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>GST included:</label>
							<div class="formRight">
								<input type="checkbox" id="productTax2" name="productTax2" checked="checked" value="1"/><label for="productTax2"></label>
							</div>
							<div class="fix"></div>
						</div>

						<div class="rowElem">
							<label>Add to Wisenet task:</label>
							<div class="formRight">
								<input type="checkbox" id="addWisenet2" name="addWisenet2" checked="checked" value="1"/><label for="addWisenet2"></label>
							</div>
							<div class="fix"></div>
						</div>
					</div>
				</fieldset>


				 <fieldset class="step" id="fourth">
					<h5>Order Details - 4 of 4</h5>

					<!--

					<div class="rowElem noborder">
						<label>Item Name:</label>
						<div class="formRight">
							<input type="text" readonly="readonly" value="" name="productNameReview" id="productNameReview"/>
						</div>
						<div class="fix"></div>
					</div>

					<div class="rowElem" id="itemCategory">
						<label>Item Category:</label>
						<div class="formRight">
							<input type="text" readonly="readonly" value="" name="productCategoryReview" id="productCategoryReview"/>
						</div>
						<div class="fix"></div>
					</div>

					<div class="rowElem" id="itemName2">
						<label>Item Name 2:</label>
						<div class="formRight">
							<input type="text" readonly="readonly" value="" name="productNameReview2" id="productNameReview2"/>
						</div>
						<div class="fix"></div>
					</div>

					<div class="rowElem" id="itemCategory2">
						<label>Item Category 2:</label>
						<div class="formRight">
							<input type="text" readonly="readonly" value="" name="productCategoryReview2" id="productCategoryReview2"/>
						</div>
						<div class="fix"></div>
					</div>



					<div class="rowElem">
						<label>Order Total:</label>
						<div class="formRight">
							<input type="text" readonly="readonly" value="" name="orderTotal" id="orderTotal"/>
						</div>
						<div class="fix"></div>
					</div>

					<div class="rowElem">
						<label>Tax Included:</label>
						<div class="formRight">
							<input type="text" readonly="readonly" name="orderTax" id="orderTax"/>
						</div>
						<div class="fix"></div>
					</div>

									-->

					<div class="rowElem">
						<label>Raise Invoice:</label>
						<div class="formRight">
							<input type="checkbox" id="raiseInvoice" name="raiseInvoice" checked="checked" value="1"/><label for="raiseInvoice"></label>
						</div>
						<div class="fix"></div>
					</div>                    

					<div class="rowElem">
						<label>Notes:</label>
						<div class="formRight">
							<textarea rows="5" cols="" name="notes"></textarea>
						</div>
						<div class="fix"></div>
					</div>
				</fieldset>



				<div class="wizNav">                            
					<input class="basicBtn" id="back" value="Back" type="reset" />
					<input class="blueBtn" id="next" value="Next" type="submit" />
				</div>
			</div>
		</form>
		

	</div>
