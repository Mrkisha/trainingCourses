<?php

	session_start();

	require 'includes/database.php';
	require 'includes/functions.php';

	permission();

	// set the page var to training, finance of manager
	// so the middle nav links could be properly highlighted
	// depending on what page you're on
	$page = 'training';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>Training - Public Courses</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Cuprum" rel="stylesheet" type="text/css" />
</head>
<body>
<!-- Top navigation bar -->

<div id="topNav">
	<div class="fixed">
		<div class="wrapper">
			<div class="welcome"><a href="#" title=""><img src="images/userPic.png" alt="" /></a><span>Hello, <?php echo ucfirst($_SESSION['user']['username']) ?>!</span></div>
			<div class="userNav">
				<ul>
					<li><a href="index.php" title=""><img src="images/icons/topnav/logout.png" alt="" /><span>Logout</span></a></li>
				</ul>
			</div>
			<div class="fix"></div>
		</div>
	</div>
</div>

<!-- Header -->

<div id="header" class="wrapper">
	<div class="logo"><a href="/" title=""><img src="images/ncsiLogo.png" alt="" /></a></div>
	<div class="middleNav">
		<ul>
			
			<!-- <li class="iStat"><a href="#" title=""><span>Statistics</span></a></li> -->
			
			<li class="iUser"><a href="#" title="" class="on"><span>Training</span></a></li>
			
			<!-- <li class="iOrders"><a href="#" title=""><span>Finance</span></a></li> -->
			
		</ul>
	</div>
	<div class="fix"></div>
</div>

<!-- Main wrapper -->

<div class="wrapper"> 
	
	<!-- Left navigation -->
	<?php include 'includes/left-nav.php'; ?>
	<!-- Left navigation -->
	
	<!-- Content -->
	
	<div class="content">

		<div class="title">
			<h5>Add Other Course</h5>
		</div>


		<form action="API/training-other-add-processing.php" method="post" id="wizForm" class="mainForm">
			<div class="widget">
				<div class="head"></div>

				<fieldset class="step" id="first">
					<h5>Attendee Details - 1 of 4</h5>

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
						<label>Mobile Phone:<span class="req">*</span></label>
						<div class="formRight">
							<input type="text" name="customerPhone" />
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
				</fieldset>


				<fieldset class="step" id="second">
					<h5>Billing Details - 2 of 4</h5>

					<div class="rowElem noborder">
						<label>Use same details for invoicing: </label>
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

				</fieldset>


				 <fieldset class="step" id="third">
					<h5>Item Details - 3 of 4</h5>
					<div class="rowElem noborder">
						<label>Category:<span class="req">*</span></label>
						<div class="formRight ">
						<select name="productCategory"  id="productCategory">
							<option value="">Please select..</option>
							<option value="onsite">Onsite Course</option>
							<option value="online">Online Course</option>
							<option value="workshop">Professional Development & Workshops</option>
							<option value="rpl">Recognition of Prior Learning</option>
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
							<input type="text" value="1" name="productQuantity" /></div>
						<div class="fix"></div>
					</div>

					<div class="rowElem">
						<label>Item Price:<span class="req">*</span></label>
						<div class="formRight onlyNums">
							<input type="text" name="productPrice" id="productPrice"/></div>
							<div class="fix"></div>
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
						<label>Location:<span class="req">*</span></label>
						<div class="formRight">
							<input type="text" name="productLocation" />
						</div>
						<div class="fix"></div>
					</div>

					<div class="rowElem">
						<label>Start Date:<span class="req">*</span></label>
						<div class="formRight">
							<input type="text" name="productStartDate" class="datepicker" value="<?php echo date("d-m-Y"); ?>"/>
							<input type="text" name="productStartTime" class="timepicker" size="10" value="<?php echo "9:00:00"; ?>">
						</div>
						<div class="fix"></div>
					</div>

					<div class="rowElem" id="hide">
						<label>End Date:<span class="req">*</span></label>
						<div class="formRight">
							<input type="text" name="productEndDate" class="datepicker" value="<?php echo date("d-m-Y"); ?>"/> 
							<input type="text" name="productEndTime" class="timepicker" size="10" value="<?php echo "17:00:00"; ?>">
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


				</fieldset>


				<fieldset class="step" id="anotherCourse">
					<h5>Item Details - 3a of 4</h5>

					<div class="rowElem noborder">
						<label>Category:<span class="req">*</span></label>
						<div class="formRight ">
						<select name="productCategory2" id="productCategory2" >
							<option value="">Please select..</option>
							<option value="onsite">Onsite Course</option>
							<option value="online">Online Course</option>
							<option value="workshop">Professional Development & Workshops</option>
							<option value="rpl">Recognition of Prior Learning</option>
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
							<input type="text" value="1" name="productQuantity2" /></div>
						<div class="fix"></div>
					</div>

					<div class="rowElem">
						<label>Item Price:<span class="req">*</span></label>
						<div class="formRight onlyNums">
							<input type="text" name="productPrice2" id="productPrice2"/></div>
							<div class="fix"></div>
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
							<input type="text" name="productStartDate2" class="datepicker" value="<?php echo date("d-m-Y"); ?>"/>
							<input type="text" name="productStartTime2" class="timepicker" size="10" value="<?php echo "9:00:00"; ?>">
						</div>
						<div class="fix"></div>
					</div>

					<div class="rowElem">
						<label>End Date:<span class="req">*</span></label>
						<div class="formRight">
							<input type="text" name="productEndDate2" class="datepicker" value="<?php echo date("d-m-Y"); ?>"/> 
							<input type="text" name="productEndTime2" class="timepicker" size="10" value="<?php echo "17:00:00"; ?>">
						</div>
						<div class="fix"></div>
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
	<div class="fix"></div>
</div>

<!-- Footer -->

<div id="footer">
	<div class="wrapper"> <span>&copy; Copyright 2012</span> </div>
</div>
<div class="uDialog">
	<div id="dialog-message" title="Course details">
		
	</div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/spinner/jquery.mousewheel.js"></script>
<script type="text/javascript" src="js/plugins/spinner/ui.spinner.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/plugins/wysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="js/plugins/wysiwyg/wysiwyg.image.js"></script>
<script type="text/javascript" src="js/plugins/wysiwyg/wysiwyg.link.js"></script>
<script type="text/javascript" src="js/plugins/wysiwyg/wysiwyg.table.js"></script>
<script type="text/javascript" src="js/plugins/flot/jquery.flot.js"></script>
<script type="text/javascript" src="js/plugins/flot/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="js/plugins/flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="js/plugins/flot/excanvas.min.js"></script>
<script type="text/javascript" src="js/plugins/flot/jquery.flot.resize.js"></script>
<script type="text/javascript" src="js/plugins/tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/plugins/tables/colResizable.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/forms.js"></script>
<script type="text/javascript" src="js/plugins/forms/autogrowtextarea.js"></script>
<script type="text/javascript" src="js/plugins/forms/autotab.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.validationEngine.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.dualListBox.js"></script>
<script type="text/javascript" src="js/plugins/forms/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="js/plugins/other/calendar.min.js"></script>
<script type="text/javascript" src="js/plugins/other/elfinder.min.js"></script>
<script type="text/javascript" src="js/plugins/uploader/plupload.js"></script>
<script type="text/javascript" src="js/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="js/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="js/plugins/uploader/jquery.plupload.queue.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.progress.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.alerts.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.colorpicker.js"></script>
<script type="text/javascript" src="js/plugins/wizards/jquery.form.wizard.js"></script>
<script type="text/javascript" src="js/plugins/wizards/jquery.validate.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.breadcrumbs.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.ToTop.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.listnav.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.sourcerer.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="js/custom.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		
		$("#check1").bind("change", function() {
			if($(this).attr('checked')){
				//alert(1);
				$("input[name='billingFirstName']").val($("input[name='customerFirstName']").val());
				$("input[name='billingLastName']").val($("input[name='customerLastName']").val());
				$("input[name='billingCompany']").val($("input[name='customerCompany']").val());
				$("input[name='billingAddress1']").val($("input[name='customerAddress1']").val());
				$("input[name='billingAddress2']").val($("input[name='customerAddress2']").val());
				$("input[name='billingCity']").val($("input[name='customerCity']").val());
				$("input[name='billingState']").val($("input[name='customerState']").val());
				$("input[name='billingPostCode']").val($("input[name='customerPostCode']").val());

			} else {
				$("input[name='billingFirstName']").val();
				$("input[name='billingLastName']").val();
				$("input[name='billingCompany']").val();
				$("input[name='billingAddress1']").val();
				$("input[name='billingAddress2']").val();
				$("input[name='billingCity']").val();
				$("input[name='billingState']").val();
				$("input[name='billingPostCode']").val();

			}
		});
		
		$("#menu:eq(2)").children().addClass("active");
/*
		$("#productCategory").change(function(){
			if($("#productCategory option:selected").val() != ''){
				$("#productCategoryReview").val($("#productCategory option:selected").text());
			}
		});

		$("input[name='productName']").change(function(){
			alert($(this).val());
			$("#productNameReview").val($(this).val());
		});

		$("#productCategory2").change(function(){
			if($("#productCategory2 option:selected").val() != ''){
				$("#productNameReview2").val($("#productCategory2 option:selected").text());
			} else {
				// remove row from last page
			}
		});

		$("#productName2").change(function(){
			$("#productCategoryReview2").val($(this).val());
		});
		
		// hide and show item2 and category2 fields
		$("#itemCategory2").hide();
		$("#itemName2").hide();
		$("#anotherCourse").change(function(){
			$("#itemCategory2").toggle();
			$("#itemName2").toggle();
		});

		// calculate totalOrder and place it on to page 4 //////////////////////////////////////////
		$('#productPrice').live("change", function() {
			var sum = 0;
			var sumTax = 0;
			sum += Number($(this).val());
			sum += Number($('#productPrice2').val());
			console.log(sum);

			$("#orderTotal").val(sum);

			if ($('#productTax').attr('checked')) {
				sumTax += $('#productPrice').val() - (Math.round($('#productPrice').val() / 1.1));
				console.log(sumTax);
			}
			if ($('#productTax2').attr('checked')) {
				sumTax += $('#productPrice2').val() - (Math.round($('#productPrice2').val() / 1.1));
				console.log(sumTax);
			}
			$("#orderTax").val(sumTax);
		});
		
		$('#productPrice2').live("change", function() {
			var sum = 0;
			var sumTax = 0;
			sum += Number($(this).val());
			sum += Number($('#productPrice').val());
			console.log(sum);

			$("#orderTotal").val(sum);

			if ($('#productTax').attr('checked')) {
				sumTax += $('#productPrice').val() - (Math.round($('#productPrice').val() / 1.1));
				console.log(sumTax);
			}
			if ($('#productTax2').attr('checked')) {
				sumTax += $('#productPrice2').val() - (Math.round($('#productPrice2').val() / 1.1));
				console.log(sumTax);
			}
			$("#orderTax").val(sumTax);
		});

*/



		////////////////////////////////////////////////////////////////////////////////////////////
	});
	

</script>
</body>
</html>
