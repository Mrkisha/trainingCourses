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
	<!-- middle nav start -->
	<?php require 'includes/middle-nav.php'; ?>
	<!-- middle nav end -->
	<div class="fix"></div>
</div>

<?php

	$stm = $db->prepare("SELECT DISTINCT `orderId` FROM `mod_foxycart_training_tasks` WHERE `task` = 1 AND `status` = 0");
	$stm->execute();

	$pendingTasks = $stm->rowCount();

	$stm_overdue = $db->prepare("SELECT DISTINCT `orderId`
									FROM mod_foxycart_training_tasks
									WHERE  `dateInserted` < DATE_SUB( NOW( ) , INTERVAL 48 HOUR ) AND `task` = 1 AND `status` = 0");
	$stm_overdue->execute();

	$overdue = $stm_overdue->rowCount();
?>

<!-- Main wrapper -->

<div class="wrapper"> 
	
	<!-- Left navigation -->

	<?php include 'includes/left-nav.php'; ?>
	
	<!-- Content -->
	
	<div class="content">
		<div class="title">
			<h5>Public Courses</h5>
		</div>
		
		
		<!-- Statistics -->
		
		<div class="stats">
			<ul>
				<li><a href="#" class="count blue" title=""><?php echo $pendingTasks; ?></a><span>new pending tasks</span></li>
				<li class="last"><a href="#" class="count red" title=""><?php echo $overdue ?></a><span>overdue tasks</span></li>
			</ul>
			<div class="fix"></div>
		</div>
		
		<!-- Static table -->
		<div class="widget first">
			<div class="head">
				<h5 class="iFrames">Public courses to be added to Wisenet</h5>
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
									 INNER JOIN `mod_foxycart_training_tasks` ON (`mod_foxycart_orders`.`orderId` = `mod_foxycart_training_tasks`.`orderId`)
								 WHERE (`mod_foxycart_training_tasks`.`task` =1 AND `mod_foxycart_training_tasks`.`status` =0)
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
					<td width="50%">Items</td>
					<!--
					<td width="11%">Cost</td>
					-->
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
														WHERE (`productCategory` = 'default' 
																OR `productCategory` = 'new' 
																OR  `productCategory` = 'gst-exempt' 
																OR  `productCategory` = 'rto-units'
																OR  `productCategory` = 'onsite'
																OR  `productCategory` = 'onlne'
																OR  `productCategory` = 'workshop'
																OR  `productCategory` = 'rpl'
																) 
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
						//echo "<td>\${$key['orderTotal']}</td>";
						echo "<td>{$key['customerFirstName']} {$key['customerLastName']}</td>";
						echo "</tr>";
					}
				}
			?>
		</tbody>
			</table>
				</tbody>
			</table>
		</div>
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
		var orderId;

		$('.opener').live("click", function(){
			orderId = $(this).text();
			add_class_to_row = $(this).parent().parent();
			$.post("API/generate-dialogbox.php",  {orderId: orderId}, function(data){
				console.log(data);
				$("#dialog-message").empty();
				$("#dialog-message").append(data);
				$("#dialog-message").dialog("open");
				count_blueBtn = $(".blueBtn").length;
			});

			return false;
		});

		// remove element function
		function remove_loader(element){
			element.remove();
		}

		$(".blueBtn").live("click", function(){
			var clicked = $(this);
			// remove blue button
			clicked.fadeOut();
			// add loader
			//clicked.parent().append('<img id="loader6" src="images/loaders/loader6.gif" alt="">');
			$.post("API/update-task.php", {taskID: $(this).next().val()}, function(data){
				clicked.parent().prev().prev().find("ul").append("<li class='justAdded'><span>Added to Wisenet:</span> <span>" + data + "</span> </li>");
				clicked.remove();
				
				$(".blueBtn").lenght();

				// remove loader
				//clicked.parent().sibling('img').remove();
			});
			count_blueBtn = count_blueBtn - 1;
			
			if(count_blueBtn == 0){
				
				add_class_to_row.addClass("taskCompleted");
				
				// recalculate tasks counts
				var numberLeft = $(".numberLeft").text() - 1 ;
				$(".numberLeft").text(numberLeft);

				var blue = $(".blue").text() - 1 ;
				$(".blue").text(blue);

				var red = $(".red").text() - 1 ;
				$(".red").text(red);


			}
			//alert($(this).next().val());
			return false;
		});


		// submiting notes to db		
		$('#note').live("keydown", function(e){
			if(e.keyCode == 13){
				if ($("#allNotes p").length > 0){
 					$("#allNotes p").remove();
				}

				$.post("API/training-notes-standard.php", {note: $('#note').val(), orderId: orderId}, function(notes){
					console.log(notes);
					$("#allNotes ul").append(notes);
					$("#note").val("");
				});
				return false;
			}
			
		});	


		
	});
	

</script>
</body>
</html>
