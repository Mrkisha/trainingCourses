<?php

	$stm = $db->query("SELECT * FROM `cts_locations` ");
	$stm->execute();

	$data = $stm->fetchAll(PDO::FETCH_ASSOC);

	if($stm->rowCount() > 0){	
		foreach ($data as $row) {
			echo "<option value='{$row['id']}'>{$row['locationName']}</option>";
		}
	}
	