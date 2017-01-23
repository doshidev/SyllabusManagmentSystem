<?php 
// general
// -- Update a record in particular table
// @param: expects id and associative array of fields and values to be updated
function updateById($table, $id, $fields_array){
	global $connection;
	
	$query = "UPDATE " . $table . " SET "; 
	$cnt = 0;
	foreach($fields_array as $key => $value){
		$query .= ($cnt > 0) ? ", " : " " ;
		$query .=	$key . "= '" . $value ."'";
		$cnt++;
	}
	$query .= " WHERE id = {$id}";
	
	// echo $query;

	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
}


// syllabi_syllabus_header
// -- Swap (move up or down) display_index (or child_index) for a particular syllabus
// @param: expects (type ("group" or "child"), syllabus_id, header_id, direction)
function moveDisplayIndex($type, $syllabus_id, $id, $direction){
	global $connection;

	
	$current_header = getById("syllabi_syllabus_header", "id", $id);

	// type = "group"
	if($type == "group"){

		// 1. Get current display index and new dispaly index
		$current_index = $current_header["display_index"];
		$new_index = $direction == "up" ? $current_index - 1 : $current_index + 1;

		echo "New Index = {$new_index} <br/>";
		echo "Step 1 Completed <br/>";

		// 2. set display index as -1 for the header
		$query = "UPDATE syllabi_syllabus_header SET display_index = -1 WHERE group_id = {$id}";
		echo $query . "<br/>";
		$record_set = mysqli_query($connection, $query);
		confirm_query($record_set);

		echo "Step 2 Completed <br/>";

		// 3. Update swap record display Index
		if( ($direction == "up" && $current_index > 1) || ($direction == "down" && $current_index < getMaxHeaderGroups($syllabus_id)) ) {
			$query = "UPDATE syllabi_syllabus_header";
			$query .= " SET display_index = {$current_index}";
			$query .= " WHERE syllabus_id = {$syllabus_id} AND display_index = {$new_index}";
			echo $query . "<br/>";
			$record_set = mysqli_query($connection, $query);
			confirm_query($record_set);
		}
		echo "Step 3 Completed <br/>";

		// 4. Update new index in current_header
		$query = "UPDATE syllabi_syllabus_header SET display_index = {$new_index} WHERE group_id = {$id}";
		echo $query . "<br/>";
		$record_set = mysqli_query($connection, $query);
		confirm_query($record_set);

		echo "Step 4 Completed <br/>";
	
	} elseif($type == "child"){

		// 1. Get current display index and new dispaly index
		$current_index = $current_header["child_index"];
		$new_index = $direction == "up" ? $current_index - 1 : $current_index + 1;
		$group_id = $current_header["group_id"];

		echo "New Index = {$new_index} <br/>";
		echo "Step 1 Completed <br/>";

		// 2. set display index as -1 for the header
		$query = "UPDATE syllabi_syllabus_header SET child_index = -1 WHERE id = {$id}";
		echo $query . "<br/>";
		$record_set = mysqli_query($connection, $query);
		confirm_query($record_set);

		echo "Step 2 Completed <br/>";

		// 3. Update swap record display Index
		if( ($direction == "up" && $current_index > 1) || ($direction == "down" && $current_index < getMaxHeaderGroups($syllabus_id)) ) {
			$query = "UPDATE syllabi_syllabus_header";
			$query .= " SET child_index = {$current_index}";
			$query .= " WHERE syllabus_id = {$syllabus_id} AND group_id = {$group_id} AND child_index = {$new_index}";
			echo $query . "<br/>";
			$record_set = mysqli_query($connection, $query);
			confirm_query($record_set);
		}
		echo "Step 3 Completed <br/>";

		// 4. Update new index in current_header
		$query = "UPDATE syllabi_syllabus_header SET child_index = {$new_index} WHERE id = {$id}";
		echo $query . "<br/>";
		$record_set = mysqli_query($connection, $query);
		confirm_query($record_set);

		echo "Step 4 Completed <br/>";
	}
}


// syllabi_syllabus_header
// -- Move display_index (or child_index) one level up before delete, for a particular syllabus
// @param: expects (type ("group" or "child"), syllabus_id, header_id)
function moveDisplayIndexBeforeDelete($type, $syllabus_id, $id){
	global $connection;

	
	$current_header = getById("syllabi_syllabus_header", "id", $id);

	// type = "group"
	if($type == "group"){

		// 1. Get current display index and new dispaly index
		$current_index = $current_header["display_index"];

		echo "New Index = {$new_index} <br/>";
		echo "Step 1 Completed <br/>";

		// 2. set display index as -1 for the header
		$query = "UPDATE syllabi_syllabus_header SET display_index = -1 WHERE group_id = {$id}";
		echo $query . "<br/>";
		$record_set = mysqli_query($connection, $query);
		confirm_query($record_set);

		echo "Step 2 Completed <br/>";

		// 3. Update display Index of all headers displayed below the one we are deleting
		
		$query = "UPDATE syllabi_syllabus_header";
		$query .= " SET display_index = display_index - 1";
		$query .= " WHERE syllabus_id = {$syllabus_id} AND display_index > {$current_index}";
		echo $query . "<br/>";
		$record_set = mysqli_query($connection, $query);
		confirm_query($record_set);
	
		echo "Step 3 Completed <br/>";

	
	} elseif($type == "child"){

		// 1. Get current display index and new dispaly index
		$current_index = $current_header["child_index"];
		$group_id = $current_header["group_id"];

		echo "New Index = {$new_index} <br/>";
		echo "Step 1 Completed <br/>";

		// 2. set display index as -1 for the header
		$query = "UPDATE syllabi_syllabus_header SET child_index = -1 WHERE id = {$id}";
		echo $query . "<br/>";
		$record_set = mysqli_query($connection, $query);
		confirm_query($record_set);

		echo "Step 2 Completed <br/>";

		// 3. Update display Index of all headers displayed below the one we are deleting
		
		$query = "UPDATE syllabi_syllabus_header";
		$query .= " SET child_index = child_index - 1";
		$query .= " WHERE syllabus_id = {$syllabus_id} AND group_id = {$group_id} AND child_index > {$current_index}";
		echo $query . "<br/>";
		$record_set = mysqli_query($connection, $query);
		confirm_query($record_set);
	
		echo "Step 3 Completed <br/>";
	}
}


// syllabi_type_timelinedetails
// -- Swap (move up or down) display_index (or child_index) for a particular timeline
// @param: expects timelineid, id, direction)
function moveTimelineIndex($timelineid, $id, $direction){
	global $connection;

	$current_record = getById("syllabi_type_timelinedetails", "id", $id);

	
	// 1. Get current display index and new dispaly index
	$current_index = $current_record["display_index"];
	$new_index = $direction == "up" ? $current_index - 1 : $current_index + 1;

	// 2. set display index as -1 for the header
	$query = "UPDATE syllabi_type_timelinedetails SET display_index = -1 WHERE id = {$id}";
	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);

	// 3. Update swap record display Index
	if( ($direction == "up" && $current_index > 1) || ($direction == "down" && $current_index < getMaxTimeline($timelineid)) ) {
		$query = "UPDATE syllabi_type_timelinedetails";
		$query .= " SET display_index = {$current_index}";
		$query .= " WHERE timelineid = {$timelineid} AND display_index = {$new_index}";
		$record_set = mysqli_query($connection, $query);
		confirm_query($record_set);

		// 4. Update new index in current_header
		$query = "UPDATE syllabi_type_timelinedetails SET display_index = {$new_index} WHERE id = {$id}";
		$record_set = mysqli_query($connection, $query);
		confirm_query($record_set);
	}
	
}


// syllabi_type_timelinedetails
// -- Move display_index one level up before delete, for a particular timeline
// @param: expects timelineid, detailsid)
function moveTimelineIndexBeforeDelete($timelineid, $id){
	global $connection;
	
	$current_record = getById("syllabi_type_timelinedetails", "id", $id);

	// 1. Get current display index and new dispaly index
	$current_index = $current_record["display_index"];

	// 2. set display index as -1 for the header
	$query = "UPDATE syllabi_type_timelinedetails SET display_index = -1 WHERE id = {$id}";
	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);

	// 3. Update display Index of all headers displayed below the one we are deleting
	
	$query = "UPDATE syllabi_type_timelinedetails";
	$query .= " SET display_index = display_index - 1";
	$query .= " WHERE timelineid = {$timelineid} AND display_index > {$current_index}";
	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	
}



// syllabi_type_groupdetails
// -- Swap (move up or down) display_index (or child_index) for a particular group
// @param: expects timelineid, id, direction)
function moveGroupIndex($groupid, $id, $direction){
	global $connection;

	$current_record = getById("syllabi_type_groupdetails", "id", $id);

	
	// 1. Get current display index and new dispaly index
	$current_index = $current_record["display_index"];
	$new_index = $direction == "up" ? $current_index - 1 : $current_index + 1;

	// 2. set display index as -1 for the header
	$query = "UPDATE syllabi_type_groupdetails SET display_index = -1 WHERE id = {$id}";
	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);

	// 3. Update swap record display Index
	if( ($direction == "up" && $current_index > 1) || ($direction == "down" && $current_index < getMaxGroup($groupid)) ) {
		$query = "UPDATE syllabi_type_groupdetails";
		$query .= " SET display_index = {$current_index}";
		$query .= " WHERE groupid = {$groupid} AND display_index = {$new_index}";
		$record_set = mysqli_query($connection, $query);
		confirm_query($record_set);

		// 4. Update new index in current_header
		$query = "UPDATE syllabi_type_groupdetails SET display_index = {$new_index} WHERE id = {$id}";
		$record_set = mysqli_query($connection, $query);
		confirm_query($record_set);
	}
	
}



// syllabi_type_groupdetails
// -- Move display_index one level up before delete, for a particular group
// @param: expects timelineid, detailsid)
function moveGroupIndexBeforeDelete($groupid, $id){
	global $connection;
	
	$current_record = getById("syllabi_type_groupdetails", "id", $id);

	// 1. Get current display index and new dispaly index
	$current_index = $current_record["display_index"];

	// 2. set display index as -1 for the header
	$query = "UPDATE syllabi_type_groupdetails SET display_index = -1 WHERE id = {$id}";
	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);

	// 3. Update display Index of all headers displayed below the one we are deleting
	
	$query = "UPDATE syllabi_type_groupdetails";
	$query .= " SET display_index = display_index - 1";
	$query .= " WHERE groupid = {$groupid} AND display_index > {$current_index}";
	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	
}