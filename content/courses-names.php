<?php

	$stm = $db->query("SELECT * FROM `cts_courses` ");
	$stm->execute();

	$data = $stm->fetchAll(PDO::FETCH_ASSOC);

	if($stm->rowCount() > 0){
		
		foreach ($data as $row) {

			echo "<tr>
						<td>{$row['courseName']}</td>
						<td align='center'>
							<a href='#''>
								<img src='images/icons/dark/close.png'>
							</a>
							<input type='hidden' name='courseID' value='{$row['id']}'>
						</td>
					</tr>";
		}
	}