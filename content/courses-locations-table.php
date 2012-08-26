<?php

	$stm = $db->query("SELECT
							`cts_courses`.`courseName`
							, `cts_locations`.`locationName`
							, `cts_courses_locations`.`courseStart`
							, `cts_courses_locations`.`id`
						FROM `cts_courses`
							INNER JOIN `cts_courses_locations` ON (`cts_courses`.`id` = `cts_courses_locations`.`courseNameId`)
							INNER JOIN `cts_locations` ON (`cts_locations`.`id` = `cts_courses_locations`.`courseLocationId`);");
	$stm->execute();

	$data = $stm->fetchAll(PDO::FETCH_ASSOC);

	if($stm->rowCount() > 0){
		
		foreach ($data as $row) {

			echo "<tr>
						<td>".date("d/m/Y H:i", strtotime($row['courseStart']))."</td>
						<td>{$row['courseName']}</td>
						<td>{$row['locationName']}</td>
						<td align='center'>
							<a href='#' class='deleteCourseLocation'>
								<img src='images/icons/dark/close.png'>
							</a>
							<input type='hidden' name='locationID' value='{$row['id']}'>
						</td>
					</tr>";
		}
	}