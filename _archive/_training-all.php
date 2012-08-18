<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>Training - All Bookings</title>

<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Cuprum" rel="stylesheet" type="text/css" />

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

</head>

<body>

<?php
$link = mysql_connect('localhost', 'ncsiuxha_fcadmin', 'swEc2uth9st9');
$dbSelected = mysql_select_db('ncsiuxha_fc789132', $link);
?>

<!-- Top navigation bar -->
<div id="topNav">
    <div class="fixed">
        <div class="wrapper">
            <div class="welcome"><a href="#" title=""><img src="images/userPic.png" alt="" /></a><span>Hello, James!</span></div>
            <div class="userNav">
                <ul>
                    <!--
                    <li><a href="#" title=""><img src="images/icons/topnav/profile.png" alt="" /><span>Profile</span></a></li>
                    <li><a href="#" title=""><img src="images/icons/topnav/tasks.png" alt="" /><span>Tasks</span></a></li>
                    <li class="dd"><a title=""><img src="images/icons/topnav/messages.png" alt="" /><span>Messages</span><span class="numberTop">8</span></a>
                        <ul class="menu_body">
                            <li><a href="#" title="" class="sAdd">new message</a></li>
                            <li><a href="#" title="" class="sInbox">inbox</a></li>
                            <li><a href="#" title="" class="sOutbox">outbox</a></li>
                            <li><a href="#" title="" class="sTrash">trash</a></li>
                        </ul>
                    </li>
                    <li><a href="#" title=""><img src="images/icons/topnav/settings.png" alt="" /><span>Settings</span></a></li>
                -->
                    <li><a href="login.html" title=""><img src="images/icons/topnav/logout.png" alt="" /><span>Logout</span></a></li>
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
    <div class="leftNav">
        <ul id="menu">
            <li class="tables"><a href="tables.html" title=""><span>Public Courses</span><span class="numberLeft">6</span></a></li>
            <li class="tables"><a href="tables.html" title=""><span>Onsite Courses</span></a></li>
            <li class="tables"><a href="tables.html" title=""><span>Standards</span></a></li>
            <li class="tables"><a href="tables.html" title="" class="active"><span>All Bookings</span></a></li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="title"><h5>All Bookings</h5></div>
        
        <!-- Statistics -->
        <!--
        <div class="stats">
            <ul>
                <li><a href="#" class="count blue" title="">10</a><span>new pending tasks</span></li>   
                <li class="last"><a href="#" class="count red" title="">6</a><span>overdue tasks</span></li>
            </ul>
            <div class="fix"></div>
        </div>
    -->
        
        <!-- Static table -->
        <div class="widget first">
        <div class="table">
            <div class="head"></div>
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>ID</th>
                        <th>Items</th>
                        <th>Cost</th>
                        <th>Customer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Get the details of every order
                    $sql = "SELECT * FROM `mod_foxycart_orders`";
                    $result = mysql_query($sql);
                    while($row = mysql_fetch_array($result)) {
                        $orderId = $row['orderId'];
                        $orderTotal = $row['orderTotal'];
                        $sql_customers = "SELECT * FROM `mod_foxycart_customers` WHERE `orderID`=".$orderId;
                        $result_customers = mysql_query($sql_customers);
                        while($row_customers = mysql_fetch_array($result_customers)) {
                            $orderDate = $row_customers['orderDate'];
                            $customerFirstName = $row_customers['customerFirstName'];
                            $customerLastName = $row_customers['customerLastName'];
                        }
                        echo "<tr class='gradeA'><td>".$orderDate."</td>";
                        echo "<td><a href='#' id='opener'>".$orderId."</a></td>";
                        echo "<td><div class='list arrowBlue'><ul>";
                        $sql_products = "SELECT * FROM `mod_foxycart_products` WHERE `orderID`=".$orderId;
                        $result_products = mysql_query($sql_products);
                        while($row_products = mysql_fetch_array($result_products)) {
                            $productName = $row_products['productName'];
                            echo "<li>".$productName."</li>";
                        }
                        echo "</td>";
                        echo "<td>$".$orderTotal."</td>";
                        echo "<td>".$customerFirstName." ".$customerLastName."</td>";
                        echo "</tr>";
                    }
                    ?>

              

                    
                </tbody>
            </table>
        </div>
        </div>
        
        
    </div>
    <div class="fix"></div>
</div>

<!-- Footer -->
<div id="footer">
    <div class="wrapper">
        <span>&copy; Copyright 2012</span>
    </div>
</div>

<div class="uDialog">
    <div id="dialog-message" title="Course details">
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
                    <td>
                        <span><strong>products->productName</strong></span>
                        <div class="list arrowBlue">
                            <ul>
                                <li>
                                    <span>Location:</span>
                                    <span>products-productLocation</span>
                                </li>
                                <li>
                                    <span>Start:</span>
                                    <span>products-productStart</span>
                                </li>
                                <li>
                                    <span>End:</span>
                                    <span>products-productEnd</span>
                                </li>
                                <li>
                                    <span>Code:</span>
                                    <span>products-productCode</span>
                                </li>
                                <li>
                                    <span>Category:</span>
                                    <span>products-productCategory</span>
                                </li>
                            </ul>
                        </div>
                    </td>
                    <td>products-productQuantity</td>
                    <td>
                        <span>products-productPrice * products-productQty<br />(products-productPrice each)</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span><strong>products-productName</strong></span>
                        <div class="list arrowBlue">
                            <ul>
                                <li>
                                    <span>Code:</span>
                                    <span>products-productCode</span>
                                </li>
                                <li>
                                    <span>Category:</span>
                                    <span>products-productCategory</span>
                                </li>
                            </ul>
                        </div>
                    </td>
                    <td>products->productQuantity</td>
                    <td>
                        <span>products-productPrice * products-productQty<br />(products-productPrice each)</span>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Subtotal:</td>
                    <td colspan="2">order-orderTotal + orders-discountAmount</td>
                </tr>
                <tr>
                    <td colspan="2">Discounts:</td>
                    <td colspan="2">orders-discountAmount</td>
                </tr>
                <tr>
                    <td colspan="2">Order Total:</td>
                    <td colspan="2">order-orderTotal</td>
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
                        <p>
                            customers-customerFirstName customerLastName<br>customers-customerCompany<br>customers-customerAddress1<br>customers-customerAddress2<br>customers-customerCity State Postcode<br>customers-customerCountry<br>
                        </p>
                        <p>
                            <strong>Email:</strong> customers-customerEmail<br>
                            <strong>Phone:</strong> customers-customerPhone<br>                            
                        </p>
                        <p>
                            <strong>Customer Position:</strong> customers-customerPositionTitle<br>
                            <strong>Work Phone:</strong> customers-customerWorkPhone<br>
                        </p>                            
                    </td>
                    <td>
                        <p>
                            billing-billingFirstName billingLastName<br>billing-billingAddress1<br>billing-cbillingAddress2<br>billing-billingCity State Postcode<br>billing-billingCountry
                        </p>
                        <p>
                            <strong>Puchase Order:</strong>orders-purchaseOrder</p><p><strong>eWay ID:</strong> orders-ewayID
                        </p>    
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="widget no-margin">
            <div class="head closed normal"><h5>Notes</h5></div>
            <div class="body" style="display: none; ">
                <div class="list plusBlue">
                    <ul>
                        <li>6/6/2012 8:51pm: Note 1</li>
                        <li>6/6/2012 8:51pm: Note 2</li>
                    </ul>
                </div>
                <form action="" class="mainForm notesForm">
                <fieldset>
                    <label><input type="text" name="inputtext"></label>
                    <div class="formRight"><input type="submit" value="Add comment" class="greyishBtn submitForm"></div>
                    <div class="fix"></div>
                </fieldset>
                </form>
            </div>
        </div>   


</div>

     
    </div>
</div>

</body>
</html>