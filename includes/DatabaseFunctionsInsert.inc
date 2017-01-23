<?php 
// General
// -- Create a Blank Record
// @param: expects table name
function insertBlank($table) {

	global $connection;

	$query  = "INSERT INTO {$table}";
	$query .= "(created_by, created_dt)";
	$query .= " VALUES";
	$query .= "('{$_SESSION['syllabi_username']}', '" . currentDate() . "')";
	
	echo $query;

	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	
	return $connection->insert_id;
}


// General
// -- Create a Blank Record with selected fields
// @param: expects table, fields_array
function insertFields($table, $fields_array) {
	$keys = null;
	$values = null;
	global $connection;

	$query  = "INSERT INTO {$table}";
	$query .= "(created_by, created_dt";
	foreach($fields_array as $key => $value){
		$value1 = mysqli_real_escape_string($connection, $value);
		$keys .= ", {$key}";
		$values .= ", '{$value1}'";
	}
	$query .= $keys;
	$query .= ")";
	$query .= " VALUES";
	$query .= "('{$_SESSION['syllabi_username']}', '" . currentDate() . "'";
	$query .= $values;
	$query .= ")";
	
	echo $query;

	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	
	return $connection->insert_id;
}


// syllabi_syllabus
// -- Checks if syllabus is available in database for a particular section, 
// -- if not it will add new create new syllabus entry in the database
// @param: expects associative array (year, term, session, event, section, organization)
function newSyllabus($query_array) {
	$check = getSyllabusBySection($query_array)->fetch_array(MYSQLI_ASSOC);
	if($check){
		return $check["id"];
	} else {
		
		global $connection;

		$query  = "INSERT INTO syllabi_syllabus";
		$query .= "(templatename, SectionId, academic_year, academic_term, academic_session, event_id, section, org_code_id, type, created_by, created_dt)";
		$query .= " VALUES";
		$query .= "('{$query_array['templatename']}', '{$query_array['SectionId']}', '{$query_array['year']}', '{$query_array['term']}', '{$query_array['session']}', '{$query_array['event']}', '{$query_array['section']}', '{$query_array['organization']}', '{$query_array['type']}', '{$_SESSION['syllabi_username']}', '" . currentDate() . "')";
		
		echo $query;

		$syllabus_set = mysqli_query($connection, $query);
		confirm_query($syllabus_set);
		
		return $connection->insert_id;
	}
}


// syllabi_syllabus_header
// -- Create new syllabus header in the database
// @param: expects syllabus_id
function newHeader($syllabus_id) {

	global $connection;

	$query  = "INSERT INTO syllabi_syllabus_header";
	$query .= "(syllabus_id, created_by, created_dt)";
	$query .= " VALUES";
	$query .= "('{$syllabus_id}', '{$_SESSION['syllabi_username']}', '" . currentDate() . "')";
	
	echo $query;

	$syllabus_set = mysqli_query($connection, $query);
	confirm_query($syllabus_set);
	
	return $connection->insert_id;

}


// Replicate
// -- Replicate header and contents
function replicate($header_id, $to) {

	global $connection;

	// 1. Get Source Header
	$source = getById('syllabi_syllabus_header', 'id', $header_id);

	// 2. Insert new header
	$query  = "INSERT INTO syllabi_syllabus_header";
	$query .= " (syllabus_id, icon, header, description, type_id, content_id, action, action_id, created_by, created_dt)";
	$query .= " VALUES";
	$query .= "('{$to}', '{$source["icon"]}', '{$source["header"]}', '{$source["header"]}', '{$source["description"]}', '{$source["type_id"]}', '{$source["content_id"]}', 'R', '{$source["id"]}', '{$_SESSION['syllabi_username']}', '" . currentDate() . "')";
	
	// echo $query;

	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	
	$new_id = $connection->insert_id;

	// 3. Update group_id
	if($source["id"] == $source["group_id"]){
		
	}
}


