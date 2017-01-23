<?php 
// Generic
// -- Delete a particular record
// @param: expects database name, column name and value
function deleteById($database, $column, $value){
	global $connection;

	$query  = "DELETE FROM {$database}";
	$query .= " WHERE {$column} = {$value}";
	echo $query;
	
	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	
	return $record_set;
}


// syllabi_syllabus_header
// -- Delete a particular record
// @param: expects database name, column name and value
function deleteChildHeaders($id){
	global $connection;

	$query  = "DELETE FROM syllabi_syllabus_header";
	$query .= " WHERE group_id = {$id}";
	$query .= " AND child_index > 0";
	echo $query;
	
	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	
	return $record_set;
}


// syllabi_syllabus, syllabi_syllabus_header, syllabi_type_*
// -- Delete a Template
// @param: expects template id
function deleteTemplate($id){
  global $connection;

  $query  = "SELECT a.*, b.datatable FROM syllabi_syllabus_header as a, syllabi_content_types as b where a.type_id = b.id and a.action <> 'i' and a.syllabus_id =" . $id;
  
  $record_set = mysqli_query($connection, $query);
  confirm_query($record_set);
  $headers=$record_set;
  
  // Delete all contents (replicated or created)
  foreach($headers as $header){
    if($header["type_id"] < 7){
      $query  = "delete from ". $header["datatable"] . " where id = " . $header["content_id"];
      $record_set = mysqli_query($connection, $query);
      confirm_query($record_set);
    }
  }

  // Delete all headers
  $query  = "delete from syllabi_syllabus_header where syllabus_id = " . $id;
  $record_set = mysqli_query($connection, $query);
  confirm_query($record_set);


  // Delete Syllabus
  $query  = "delete from syllabi_syllabus where id = " . $id;
  $record_set = mysqli_query($connection, $query);
  confirm_query($record_set);
}





