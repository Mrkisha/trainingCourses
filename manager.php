<?php

	session_start();

	require 'includes/database.php';
	require 'includes/functions.php';

	permission();

	// set the page var to training, finance of manager
	// so the middle nav links could be properly highlighted
	// depending on what page you're on
	$page = 'manager';
   
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>Manager - Dashboard</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/custom.css" rel="stylesheet" type="text/css" />
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

<!-- Main wrapper -->

<div class="wrapper"> 
	
	<!-- Left navigation -->

	<?php include 'includes/left-nav.php'; ?>
	
	<!-- Content -->
	
<!-- Content -->
	<div class="content">
		<div class="title"><h5>Dashboard</h5></div>
		
		<!-- Widgets -->
		<div class="widgets">
			<div class="left">
				
				<!-- Training statistics -->

				<div class="widget">
					<div class="head"><h5 class="iChart8">Training Overview</h5></div>
					<table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
						<thead>
							<tr>
							  <td>Description</td>
							  <td width="21%">Pending</td>
							  <td width="21%">Overdue</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Public Courses</td>
								<td align="center"><strong class="green"><?php echo tasks_pending_training_tasks1 (); ?></strong></td>
								<td align="center"><strong class="<?php echo (tasks_overdue_training_tasks1() == 0) ? "green": "red"; ?>"><?php echo tasks_overdue_training_tasks1(); ?></strong></td>
							</tr>
							<tr>
								<td>Onsite Courses</td>
								<td align="center"><strong class="green">1</strong></td>
								<td align="center"><strong class="red">1</strong></td>
							</tr>
							<tr>
								<td>Standards</td>
								<td align="center"><strong class="green"><?php echo tasks_pending_training_tasks2(); ?></strong></td>
								<td align="center"><strong class="<?php echo (tasks_overdue_training_tasks2() == 0) ? "green": "red"; ?>"><?php echo tasks_overdue_training_tasks2(); ?></strong></td>
							</tr>
						</tbody>
					</table>                    
				</div>
			</div>
			<div class="right">

				<!-- Finance statistics -->

				<div class="widget">
					<div class="head"><h5 class="iChart8">Finance Overview</h5></div>
						<table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
						<thead>
							<tr>
							  <td>Description</td>
							  <td width="21%">Pending</td>
							  <td width="21%">Overdue</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Raise Invoices</td>
								<td align="center"><strong class="green"><?php echo tasks_pending_finance(); ?></strong></td>
								<td align="center"><strong class="<?php echo (tasks_overdue_finance() == 0) ? "green": "red"; ?>"><?php echo tasks_overdue_finance (); ?></strong></td>
							</tr>
							<tr>
								<td>Confirm Payments</td>
								<td align="center"><strong class="green"><?php echo tasks_pending_finance2(); ?></strong></td>
								<td align="center"><strong>-</strong></td>
							</tr>
							<tr>
								<td>Reraise Invoices</td>
								<td align="center"><strong class="green">1</strong></td>
								<td align="center"><strong class="red">1</strong></td>
							</tr>
						</tbody>
					</table>                    
				</div>
			</div>
		</div>

		<div class="fix"></div>
		
		<!-- Sales by month graph -->
		<div class="widget">
			<div class="head">
				<h5 class="iStats">Sales by month</h5>
				<select name="flotSalesByMonth" id="flotSalesByMonth" style="opacity: 0; " class="floatRight">
					<option value="1">This Financial Year</option>
					<option value="2">Last Financial Year</option>
				</select>
			</div>
			<div class="body">
				<div id="placeholder" style="width:700px; height:300px"></div>
			</div>
		</div>
		<!-- end of Sales by month graph -->
	</div><!-- end of content -->


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
<script type="text/javascript" src="js/charts/chart.js"></script>
<script type="text/javascript" src="js/charts/auto.js"></script>
<script type="text/javascript" src="js/charts/bar.js"></script>
<script type="text/javascript" src="js/charts/hBar.js"></script>
<script type="text/javascript" src="js/charts/pie.js"></script>
<script type="text/javascript" src="js/charts/barar.js"></script>
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
				$( "#dialog-message" ).dialog("open");
				count_blueBtn = $(".blueBtn").length;
			});

			return false;
		});
		
		$(".blueBtn").live("click", function(){
			var clicked = $(this);
			$.post("API/update-task.php", {taskID: $(this).next().val()}, function(data){
				clicked.fadeOut();
				clicked.parent().prev().prev().find("ul").append("<li class='justAdded'><span>Added to Wisenet:</span> <span>" + data + "</span> </li>");
				clicled.remove();
				$(".blueBtn").lenght();
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
				var num_of_notes = $("#allNotes li").length;

				$.post("API/training-notes-standard.php", {note: $('#note').val(), orderId: orderId, i: num_of_notes + 1}, function(notes){
					console.log(notes);
					$("#allNotes ul").append(notes);
					$("#note").val("");
				});
				return false;
			}
			
		});

		
		
	});

	//on load, show default graph for Sales by month
	$.ajax({
		url: 'API/flotBar.php',
		data: { option: $("#flotSalesByMonth").val()},
		type: "POST",
		dataType: 'json',
		success: function(data) {
			$.plot($("#placeholder"), [{
				data: data, 
				bars: { 
					show: true,
					align:'center', 
					barWidth: 0.3
				}
			}],
			{
				xaxis: { 
					ticks:[[1,'Jul'],[2,'Aug'],[3,'Sep'],[4,'Oct'],[5,'Nov'],[6,'Dec'],[7,'Jan'],[8,'Feb'],[9,'Mar'],[10,'Apr'],[11,'May'],[12,'Jun']]
				},
				grid:{ hoverable: true }
			});			
		}
	});


	// on dorp box change, change the data for graph
	$("#flotSalesByMonth").change(function(){
		$.ajax({
			url: 'API/flotBar.php',
			data: { option: $(this).val()},
			type: "POST",
			dataType: 'json',
			success: function(data) {
				$.plot($("#placeholder"), [{
					data: data, 
					bars: { 
						show: true,
						align:'center', 
						barWidth: 0.3
					}
				}],
				{
					xaxis: { 
						ticks:[[1,'Jul'],[2,'Aug'],[3,'Sep'],[4,'Oct'],[5,'Nov'],[6,'Dec'],[7,'Jan'],[8,'Feb'],[9,'Mar'],[10,'Apr'],[11,'May'],[12,'Jun']]
					},

					grid: { hoverable: true }
				});			
			}
		});
	});

	
	//tooltip function
	function showTooltip(x, y, contents, areAbsoluteXY) {
		var rootElt = 'body';
	
		$('<div id="tooltip2" class="tooltip">' + contents + '</div>').css( {
			position: 'absolute',
			display: 'none',
			top: y - 35,
			left: x - 5,
			border: '1px solid #000',
			padding: '1px 6px',
			'z-index': '9999',
			'background-color': '#202020',
			'color': '#fff',
			'font-size': '11px',
			'border-radius': '2px',
			'-webkit-border-radius': '2px',
			'-moz-border-radius': '2px',
			opacity: 0.8
		}).prependTo(rootElt).show();
	}

	//add tooltip event
$("#placeholder").bind("plothover", function (event, pos, item) {
	if (item) {
		if (previousPoint != item.datapoint) {
			previousPoint = item.datapoint;
 
			//delete de prГ©cГ©dente tooltip
			$('.tooltip').remove();
 
			var x = item.datapoint[0];
 
			//All the bars concerning a same x value must display a tooltip with this value and not the shifted value
			if(item.series.bars.order){
				for(var i=0; i < item.series.data.length; i++){
					if(item.series.data[i][3] == item.datapoint[0])
						x = item.series.data[i][0];
				}
			}
 
			var y = item.datapoint[1];
 
			showTooltip(item.pageX+5, item.pageY+5,y);
 
		}
	}
	else {
		$('.tooltip').remove();
		previousPoint = null;
	}
 
});
</script>
</body>
</html>
