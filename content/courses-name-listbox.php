<?php

	$stm = $db->query("SELECT * FROM `cts_courses` ");
	$stm->execute();

	$data = $stm->fetchAll(PDO::FETCH_ASSOC);

	if($stm->rowCount() > 0){	
		foreach ($data as $row) {
			echo "<option value='{$row['id']}'>{$row['courseName']}</option>";
		}
	}
	