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
<title>Training - Correct Training Systems</title>
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

<!-- Main wrapper -->

<div class="wrapper"> 
	
	<!-- Left navigation -->

	<?php include 'includes/left-nav.php'; ?>
	
	<!-- Content -->
	
	<div class="content">
		<div class="title">
			<h5>Correct Training Systems</h5>
		</div>
		
			<?php
			/*

				$stm = $db->prepare("SELECT DISTINCT
									 `cts_courses_locations`.`courseStart`
									 , `cts_courses_locations`.`courseNameId`
									 , `cts_courses_locations`.`courseLocationId`
									 , `cts_courses`.`courseName`
									 , `cts_locations`.`locationName`
								 FROM `cts_courses_locations`
									 INNER JOIN `cts_courses` ON (`cts_courses_locations`.`courseNameId` = `cts_courses`.`id`)
									 INNER JOIN `cts_courses` ON (`cts_courses_locations`.`courseLocationId` = `cts_locations`.`id`)
								 ORDER BY id DESC
								 ");
				$stm->execute();

				$data = $stm->fetchAll();

				if($stm->rowCount() > 0){
				*/
			?>		
		
		<!-- Static table -->


			<div class="widget first">
				<form action="" method="post" class="mainForm">
                    <div class="head"><h5>Add a CTS course to the NCSI website</h5></div>
					<div class="rowElem noborder">
						<label>Course Name:<span class="req">*</span></label>
						<div class="formRight ">
						<select name="courseName" id="courseName" >
							<option value="">Please select..</option>
							<option value="123">Course name 1</option>
						</select>
						</div>
						<div class="fix"></div>
					</div>
					<div class="rowElem">
						<label>Course Location:<span class="req">*</span></label>
						<div class="formRight ">
						<select name="courseLocation" id="courseLocation" >
							<option value="">Please select..</option>
							<option value="123">Course name 1</option>
						</select>
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
						<input class="blueBtn" id="" value="Submit" type="submit" />
					</div>
                </form>
            </div>


		<div class="widget">
			<div class="table">
				<div class="head"><h5>CTS Courses</h5></div>	
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th width="20%">Date</th>
						<th width="25%">Name</th>
						<th width="25%">Location</th>
						<th width="20%">Remove</th>
					</tr>
				</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>

<div class="widgets">
			<div class="left">
				
				<!-- Training statistics -->

				<div class="widget">
					<div class="head"><h5>Course names</h5></div>
					<table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
						<thead>
							<tr>
							  <td>Course Name</td>
							  <td width="20%">Remove</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Course name 1</td>
								<td align="center"><a href='#'><img src='images/icons/dark/close.png' /></a></td>
							</tr>
						</tbody>
					</table>                    
				</div>
				<form action="" class="mainForm notesForm CTS">
						<fieldset>
							<label>
								<input type="text" id="cName" name="inputtext" placeholder="type course name and press enter to add..">
							</label>
						</fieldset>
					</form>
			</div>
			<div class="right">

				<!-- Finance statistics -->

				<div class="widget">
					<div class="head"><h5 class="iChart8">Course locations</h5></div>
						<table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
						<thead>
							<tr>
							  <td>Location</td>
							  <td width="20%">Remove</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Location name 1</td>
								<td align="center"><a href='#'><img src='images/icons/dark/close.png' /></a></td>
							</tr>
						</tbody>
					</table>                    
				</div>
				<form action="" class="mainForm notesForm CTS">
						<fieldset>
							<label>
								<input type="text" id="cLocation" name="inputtext" placeholder="type course location and press enter to add..">
							</label>
						</fieldset>
					</form>
			</div>
		</div>

		<div class="fix"></div>


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

		// submiting new course to db
		$('#cName').live("keydown", function(e){
			if(e.keyCode == 13){

				if ($("#cName").length > 0){
					$.post("API/training-cts-processing.php", {courseName: $("#cName").val()}, function(courseName){
						
					});
				}

				return false;
			}
			
		});	


		
	});
	

</script>
</body>
</html>
