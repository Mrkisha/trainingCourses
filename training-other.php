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
	<?php require 'includes/middle-nav.php'; ?>
	<div class="fix"></div>
</div>
<?php

			$stm = $db->prepare("SELECT DISTINCT `orderId` FROM `mod_foxycart_onsite_tasks` WHERE `status` = 0");
			$stm->execute();

			$pendingTasks = $stm->rowCount();

		?>

<!-- Main wrapper -->

<div class="wrapper"> 
	
	<!-- Left navigation -->
	<?php include 'includes/left-nav.php'; ?>
	<!-- Left navigation -->
	
	<!-- Content -->
	
	<div class="content">
		<div class="title">
			<h5>Public Courses</h5>
		</div>
		
		
		<!-- Statistics -->
		
		<div class="stats">
			<ul>
				<li><a href="#" class="count blue" title=""><?php echo $pendingTasks; ?></a><span>new pending tasks</span></li>
				<!--
				<li class="last"><a href="#" class="count red" title=""><?php echo $overdue ?></a><span>overdue tasks</span></li>
			-->
			</ul>
			<div class="fix"></div>
		</div>
		
		<!-- Static table -->
		<div class="widget first">
			<div class="head">
				<h5 class="iFrames">Oher courses with incomplete tasks</h5>
			</div>
			<?php

				$stm = $db->prepare("SELECT DISTINCT
									 `mod_foxycart_customers`.`orderDate`
									 , `mod_foxycart_customers`.`orderId`
									 , `mod_foxycart_orders`.`orderTotal`
									 , `mod_foxycart_customers`.`customerFirstName`
									 , `mod_foxycart_customers`.`customerLastName`
								 FROM `mod_foxycart_orders`
									 INNER JOIN `mod_foxycart_customers` ON (`mod_foxycart_orders`.`orderId` = `mod_foxycart_customers`.`orderId`)
									 INNER JOIN `mod_foxycart_onsite_tasks` ON (`mod_foxycart_orders`.`orderId` = `mod_foxycart_onsite_tasks`.`orderId`)
								 WHERE `mod_foxycart_onsite_tasks`.`status` =0
								 ORDER BY orderDate ASC
								 ");
				$stm->execute();

				$data = $stm->fetchAll();

				if($stm->rowCount() > 0){
				
			?>
			<table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
				<thead>
				<tr>
					<td width="17%">Date</td>
					<td width="13%">ID</td>
					<td width="40%">Items</td>
					<td width="10%">Cost</td>
					<td width="20%">Customer</td>
				</tr>
				</thead>
				<tbody>
			<?php
					
					foreach($data as $key){
						echo "<tr>";
						echo "<td>".date("d/m/Y H:i", strtotime($key['orderDate']))."</td>";
						echo "<td><a href='#' class='opener'>{$key['orderId']}</a></td>";

						// list all the items in 1 table cell
						echo "<td><div class='list arrowBlue'><ul>";
						$stm_items = $db->prepare("SELECT * FROM `mod_foxycart_products` 
														WHERE `productCategory` = 'onsite' 
																AND `orderId`=".$key['orderId']);
						$stm_items->execute();
						$data_items = $stm_items->fetchAll();
						if($stm_items->rowCount() > 0){
							foreach($data_items as $key_items){
								echo "<li>" . $key_items['productName'] . "</li>";
							}
						}
						echo "</ul></div>";

						echo "</td>";
						echo "<td>\${$key['orderTotal']}</td>";
						echo "<td>{$key['customerFirstName']} {$key['customerLastName']}</td>";
						echo "</tr>";
					}
				}
			?>
		</tbody>
			</table>

		</div>
		<input type="button" value="Add Course" class="basicBtn" style="margin-top:30px; ">
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
	
	$(document).ready(function($) {
		

		var add_class_to_row;
		var count_blueBtn;
		
		$('.opener').live("click", function(){
			
			add_class_to_row = $(this).parent().parent();
			$.post("API/generate-dialogbox-other.php",  {orderId: $(this).text()}, function(data){
				console.log(data);
				$("#dialog-message").empty();
				$("#dialog-message").append(data);
				$( "#dialog-message" ).dialog("open");
				count_blueBtn = $(".blueBtn").length;
			});

			return false;
		});
			
		// open new course
		$('.basicBtn').live("click", function(){
			$.post("API/generate-dialogbox-other-add.php",  {i: 1}, function(data){
				// console.log(data);
				$("#dialog-message").empty();
				$("#dialog-message").append(data);
				$("#dialog-message" ).dialog("open");
				
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
				
				//===== Form to Wizard plugin =====//	

				$("#wizForm").formwizard({ 

					formPluginEnabled: false,

					validationEnabled: true,

					focusFirstInput : false,

					formOptions :{

						success: function(data){$("#status").fadeTo(500,1,function(){ $(this).html("You are now registered!").fadeTo(5000, 0); })},

						beforeSubmit: function(data){$("#data").html("data sent to the server: " + $.param(data));},

						dataType: 'json',

						resetForm: true

					},

					disableUIStyles : true/*,

					validationOptions : {

						rules: {


							customerFirstName: "required",

							customerLastName: "required",

							customerAddress1: "required",

							customerCity: "required",

							customerState: "required",

							customerPostCode: "required",

							customerPhone: "required",

							customerWorkPhone: "required",

							billingFirstName: "required",

							billingLastName: "required",

							billingCompany: "required",

							billingAddress1: "required",

							billingCity: "required",

							billingState: "required",

							billingPostCode: "required",

							productCategory: "required",

							productName: "required",

							productQuantity: "required",

							productPrice: "required",

							productLocation: "required",

							productCategory2: "required",

							productName2: "required",

							productQuantity2: "required",

							productPrice2: "required",

							productCode2: "required",

							productLocation2: "required",

							req: "required",

							sel: "required",

							chb: "required",

							customerEmail: {

								required: true,

								email: true

							}

							

						},

						messages: {



							customerFirstName: "This field is required",

							customerLastName: "This field is required",

							customerAddress1: "This field is required",

							customerCity: "This field is required",

							customerState: "This field is required",

							customerPostCode: "This field is required",

							customerPhone: "This field is required",

							customerWorkPhone: "This field is required",

							billingFirstName: "This field is required",

							billingLastName: "This field is required",

							billingCompany: "This field is required",

							billingAddress1: "This field is required",

							billingCity: "This field is required",

							billingState: "This field is required",

							billingPostCode: "This field is required",

							productCategory: "Oops, required!",

							productName: "This field is required",

							productQuantity: "This field is required",

							productPrice: "This field is required",

							productLocation: "This field is required",

							productCategory2: "Oops, required!",

							productName2: "This field is required",

							productQuantity2: "This field is required",

							productPrice2: "This field is required",

							productCode2: "This field is required",

							productLocation2: "This field is required",

							req: "This field is required",

							sel: "Oops, required!",

							chb: "Check it",

							customerEmail: {

								required: "Please specify customer's email",

								customerEmail: "Correct format is name@domain.com"

							}



						}

					}*/


				 });
				

			});

			return false;
		});
		
		// add new course
		$('input[value="Submit"]').live("click", function(){
			
			$.ajax({
				url: 'API/training-other-add-processing.php',
				type: "POST",
				data: $("#wizForm").serialize(),
				dataType: 'json',
				success: function(data) {
					console.log(data);

					if(data['productCategory'] == 'onsite'){
						var output1 = "<tr><td>" + data['orderDate'] + "</td><td><a href='#'' class='opener'>" + data['orderId'] + "</a></td><td><div class='list arrowBlue'><ul><li>" + data['productName'] + "</li>";

						//check if productCategory exists and is 'onsite'
						if(data['productCategory2'] !== undefined){
							if(data['productCategory2'] == 'onsite'){
								output1 = output1 + "<li>" + data['productName2'] + "</li>";
							} else {
								$(".head:nth-child(1)").after("<div class='nNote nSuccess hideit' style='margin: 0'><p><strong>SUCCESS </strong>You have added a " + $('#productCategory2 option:selected').html() + " with " + data['orderId'] + "</p></div>");
							}
						}

						output1 = output1 + "</ul></div></td><td>$" + data['orderProduct'] + "</td><td>" + data['customerFirstName'] + " " + data['customerLastName'] + "</td></tr>";

						

					} else {
						$(".head:nth-child(1)").after("<div class='nNote nSuccess hideit' style='margin: 0'><p><strong>SUCCESS </strong>You have added a " + $('#productCategory1 option:selected').html() + " with " + data['orderId'] + "</p></div>");

						if(data['productCategory2'] !== undefined){
							if(data['productCategory2'] == 'onsite'){
								var output1 ="<tr><td>" + data['orderDate'] + "</td><td><a href='#'' class='opener'>" + data['orderId'] + "</a></td><td><div class='list arrowBlue'><ul><li>" + data['productName2'] + "</li></ul></div></td><td>$" + data['orderProduct'] + "</td><td>" + data['customerFirstName'] + " " + data['customerLastName'] + "</td></tr>";
							} else {
								$(".head:nth-child(1)").after("<div class='nNote nSuccess hideit' style='margin: 0'><p><strong>SUCCESS </strong>You have added a " + $('#productCategory2 option:selected').html() + " with " + data['orderId'] + "</p></div>");
							}
						}
					}
					$(".tableStatic").append(output1);
					$(".nSuccess").delay(4000).animate({ height: 0, opacity: 0 }, 'slow');


					/*alert(data['orderId']);
					alert(data['option']);*/
					/*if(data['option'] == 1){
						// check if first productName is onsite
						if($("#productCategory").val() = "onsite"){
							alert("prodictName = onsite");
						} else {
							alert("prodictName != onsite");
						}

						if($("#productName2").val() == "onsite"){
							alert("prodictName2 = onsite");
						} else {
							alert("prodictName2 != onsite");
						}

						alert(data['option']);
						var html_data_part1 = "<tr><td>" + data['orderDate'] + "</td><td><a href='#'' class='opener'>" + data['orderId'] + "</a></td><td><div class='list arrowBlue'><ul><li>" + data['productName'] + "</li>";

						if(data['productName2'].length > 0){
							alert("Product2");
						}

						var html_data_part3 = "</ul></div></td><td>" + data['orderProduct'] + "</td><td>$customerFirstName $customerLastName</td></tr>";
					} else {
						// close dialogbox 
						$( "#dialog-message" ).dialog("close");
						// add success for first product
						$(".head:nth-child(1)").fadeIn("slow").after("<div class='nNote nSuccess hideit' style='margin: 0'><p><strong>SUCCESS </strong>You have added a " + $('#productCategory option:selected').html() + " with " + data['orderId'] + "</p></div>");
						// add success for  product 2 if exists
						if(data['productName2'].length > 0){
							$(".head:nth-child(1)").fadeIn("slow").after("<div class='nNote nSuccess hideit' style='margin: 0'><p><strong>SUCCESS </strong>You have added a " + $('#productCategory2 option:selected').html() + " with " + data['orderId'] + "</p></div>");
						}
						
						// fade out success message
						$(".nSuccess").delay(4000).animate({ height: 0, opacity: 0 }, 'slow');

					}*/
					/*var products = */
					// if at least 1 course is onsite we insert it into table on page
					/*if($.isNumeric(data) = false){
						alert("numeric");
						$(".tableStatic").append(data);
						$( "#dialog-message" ).dialog("open");

						// check if product category is not onsite, if so insert data above table
						if($("#productCategory").val() != 'onsite'){
							alert("Product 1: " + $("#productCategory").val());
							// insertAfter .head and before table
							

						}

						// check if product category 2 is not onsite, if so insert data above table
						if($("#productCategory2").val() != 'onsite'){
							alert("Product 2: " + $("#productCategory").val());
						}
					} else {*/
						///////////////////////////////////
						

						//////////////////////////
					/*	alert(1);*/
						/*alert($("#productCategory").val()); option:selected').html()
						alert($("#productCategory2").val());*/
						/*$( "#dialog-message" ).dialog("close");
						// here we get orderID from ajax
						$(".head:nth-child(1)").after("<div class='nNote nSuccess hideit' style='margin: 0'><p><strong>SUCCESS </strong>You have added a " + $('#productCategory option:selected').html() + " with orderId</p></div>");
						$(".head:nth-child(1)").after("<div class='nNote nSuccess hideit' style='margin: 0'><p><strong>SUCCESS </strong>You have added a " + $('#productCategory2 option:selected').html() + " with orderId</p></div>");
						// fade out success message
						$(".nSuccess").delay(2500).animate({ height: 0, opacity: 0 }, 'slow');*/


						// /*"<div class='nNote nSuccess hideit'><p><strong>SUCCESS: </strong>You have added a {course-name} with orderId" + $("tr:last td:eq(1) a").text() + "</p></div>"*/	
					/*}*/
					
					/*console.log($("tr:last td:eq(1) a").text());*/
				}
			});

			return false;
		});

		// update onsite status
		var clickedOnSite;
		$(".onSite").live("click", function(){
			//alert($(this).next().val());
			clickedOnSite = $(this);
			var parent = $(this).parent();

			$.post("API/update-onsite.php", {onSiteId: $(this).next().val()}, function(data_onsite){
				clickedOnSite.remove();
				parent.append(data_onsite);
			});
			return false;
		});

	});
	

</script>
</body>
</html>