<?php

	$stm = $db->query("SELECT * FROM `cts_locations` ");
	$stm->execute();

	$data = $stm->fetchAll(PDO::FETCH_ASSOC);

	if($stm->rowCount() > 0){
		
		foreach ($data as $row) {

			echo "<tr>
						<td>{$row['locationName']}</td>
						<td align='center'>
							<a href='#' class='deleteLocation'>
								<img src='images/icons/dark/close.png'>
							</a>
							<input type='hidden' name='locationID' value='{$row['id']}'>
						</td>
					</tr>";
		}
	}
