<div class="middleNav">
	<ul>
	<?php
		if($_SESSION['user']['permission'] == 1){
			echo '<li class="iUser"><a href="training-public.php" title="" class="on"><span>Training</span></a></li>';
		} else if ($_SESSION['user']['permission'] == 2){
			echo '<li class="iOrders"><a href="finance-raise-invoices.php" title=""><span>Finance</span></a></li>';
		} else {
			echo '<li class="iOrders"><a href="finance-raise-invoices.php" title="" class="'.(($page == 'finance')? "on" : "").'"><span>Finance</span></a></li>
					<li class="iUser"><a href="training-public.php" title="" class="'.(($page == 'training')? "on" : '').'"><span>Training</span></a></li>
					<li class="iStat"><a href="manager.php" title="" class="'.(($page == 'manager')? "on" : '').'"><span>Manager</span></a></li>';
		}
	?>			
	</ul>
</div>