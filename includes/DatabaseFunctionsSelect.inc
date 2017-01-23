<?php
// Generic
// -- Get a particular database record by column value
function getAutoReplicate() {
	global $connection;

	$query  = "SELECT *";
	$query .= " FROM syllabi_syllabus";
	$query .= " WHERE autoreplicate = 'y'";
	$query .= " AND autoreplicatestatus = 'n'";
	$query .= " Limit 1";
	
	//echo $query;

	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	return $record_set->fetch_array(MYSQLI_ASSOC);
}

// Generic
// -- Get a particular database record by column value
function getById($database, $column, $id) {
	global $connection;

	$query  = "SELECT *";
	$query .= " FROM {$database}";
	$query .= " WHERE {$column} = '{$id}'";
	$query .= " Limit 1";
	
	//echo $query;

	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	return $record_set->fetch_array(MYSQLI_ASSOC);
}


// Generic - Views
// -- Get a particular database record by column value
function getVwById($database, $column, $id) {
	global $connection;

	$query  = "SELECT *";
	$query .= " FROM {$database}";
	$query .= " WHERE {$column} = '{$id}'";
	$query .= " Limit 1";
	
	//echo $query;

	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	return $record_set->fetch_array(MYSQLI_ASSOC);
}


// Generic
// -- Get all database records
// @param: database name, query_array (associative array of criteria: column => value), sort field and sort order
function getAll($database, $query_array, $sort_field, $sort_order) {
	global $connection;

	$query  = "SELECT *";
	$query .= " FROM {$database}";
	if(isset($query_array)){
		$query .= " WHERE";	
		$cnt=0;
		foreach ($query_array as $key => $value) {
			if($cnt > 0) $query .= " AND";
			$query .= " {$key} = ";
			if (substr($value, 0, 1) == "_"){
				$query .= substr($value, 1);			
			} else {
				$query .= " '" . $value . "'";
			}
			$cnt++;
		}
	}
	
	if(isset($sort_field)){
		$query .= " ORDER BY";	
		$query .= " {$sort_field}";	
	}

	if(isset($sort_order)){
		$query .= " {$sort_order}";	
	}

	//echo $query;

	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	return $record_set;
}


// Generic
// -- Get all database records
// @param: database name, query_array (associative array of criteria: column => value), sort field and sort order
function getVwAll($database, $query_array, $sort_field, $sort_order) {
	global $connection;

	$query  = "SELECT *";
	$query .= " FROM {$database}";
	if(isset($query_array)){
		$query .= " WHERE";	
		$cnt=0;
		foreach ($query_array as $key => $value) {
			if($cnt > 0) $query .= " AND";
			$query .= " {$key} = ";
			if (substr($value, 0, 1) == "_"){
				$query .= substr($value, 1);			
			} else {
				$query .= " '" . $value . "'";
			}
			$cnt++;
		}
	}
	
	if(isset($sort_field)){
		$query .= " ORDER BY";	
		$query .= " {$sort_field}";	
	}

	if(isset($sort_order)){
		$query .= " {$sort_order}";	
	}

	//echo $query;

	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	return $record_set->fetch_array(MYSQLI_ASSOC);
}





// Generic
// -- Get count of particular query
// @param: table name, query_array (associative array of criteria: column => value)
function getCount($table, $query_array) {
	global $connection;

	$query  = "SELECT count(*) as cnt";
	$query .= " FROM {$table}";
	if(isset($query_array)){
		$query .= " WHERE";	
		$cnt=0;
		foreach ($query_array as $key => $value) {
			if($cnt > 0) $query .= " AND";
			$query .= " {$key} = ";
			if (substr($value, 0, 1) == "_"){
				$query .= substr($value, 1);			
			} else {
				$query .= " '" . $value . "'";
			}
			$cnt++;
		}
	}
	

	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	return $record_set->fetch_array(MYSQLI_ASSOC)["cnt"];
}



// acdemiccalendar
// -- Get academic Calendar between two dates for an academic session
function getAcademicQuarterByDate($queryDate, $academic_session) {
	
	$date=getdate($queryDate);	
	global $connection;
	$academic_quarter;

	$query  = "SELECT * ";
	$query .= "FROM academiccalendar ";
	$query .= "WHERE start_date <= '{$date["year"]}/{$date["mon"]}/{$date["mday"]}' " ;
	$query .= "AND end_date >= '{$date["year"]}/{$date["mon"]}/{$date["mday"]}' " ;
	$query .= "AND academic_session = '{$academic_session}' " ;
	$query .= "limit 1";
	
	//echo "<h4>" . $query . "</h4><br/><br/>";

	$academiccalendar_set = mysqli_query($connection, $query);
	
	confirm_query($academiccalendar_set);
	if($result = mysqli_fetch_assoc($academiccalendar_set)) {
		$academic_quarter = array(
			'academic_year' => $result["ACADEMIC_YEAR"],
			'academic_term' => $result["ACADEMIC_TERM"],
			'academic_session' => $result["ACADEMIC_SESSION"],
			'start_date' => $result["START_DATE"],
			'end_date' => $result["END_DATE"],
		);
		return  $academic_quarter;
	}
	else {
		return null;
	}
}


// acdemiccalendar
// -- Get distinct academic terms for a particular academic year
function getAcademicTerms($year) {

	global $connection;

	$query  = "SELECT distinct ACADEMIC_TERM";
	$query .= " FROM academiccalendar";
	$query .= " WHERE ACADEMIC_YEAR = " . $year;
	$query .= " ORDER BY ACADEMIC_TERM ASC" ;
	
	//echo $query;

	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	return $record_set;
}


// acdemiccalendar
// -- Get list of academic session for a particular term and year
function getAcademicSessions($year, $term) {
	global $connection;

	$query  = "SELECT * ";
	$query .= " FROM academiccalendar";
	$query .= " WHERE ACADEMIC_YEAR = " . $year;
	$query .= " AND ACADEMIC_TERM = '" . $term . "'";	
	$query .= " ORDER BY ACADEMIC_SESSION ASC" ;
	
	// echo $query;

	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	return $record_set;
}


// code_department
// -- Gets all active departments
function getDepartments() {
	global $connection;

	$query  = "SELECT *";
	$query .= " FROM code_department";
	$query .= " WHERE STATUS = 'A'";
	$query .= " ORDER BY LONG_DESC ASC" ;
	
	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	return $record_set;
}


// event, sections
// -- Get list of all events for a particular department (school)
function getEventsbyDepartment($query_array) {
	global $connection;

	$query  = "SELECT COUNT(sections.EVENT_ID) as sec_count, event.EVENT_ID, event.EVENT_LONG_NAME, event.PROGRAM, event.CREDITS";
	$query .= " FROM event, sections";
	$query .= " WHERE event.EVENT_ID = sections.EVENT_ID";
	$query .= "	AND event.DEPARTMENT = '{$query_array["department"]}'";
	$query .= " AND sections.ACADEMIC_TERM = '{$query_array["term"]}'";
	$query .= " AND sections.ACADEMIC_YEAR = {$query_array["year"]}";
	$query .= " AND sections.ACADEMIC_SESSION = '{$query_array["session"]}'";
	$query .= " GROUP BY event.EVENT_ID, event.EVENT_LONG_NAME, event.PROGRAM, event.CREDITS";
	
	// echo $query;

	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	return $record_set;

	// $event_set = mysqli_query($connection, $query);
	// confirm_query($event_set);
	// return $event_set;
}


// sections, organization
// -- Get list of all sections for a particular organization
// @param: expects associative array (term, year, session, and event)
function getSectionsBySchool($query_array) {
	global $connection;

	$query  = "SELECT sections.*, organization.ORG_NAME_1 from sections, organization";
	$query .= " WHERE sections.ACADEMIC_TERM = '{$query_array["term"]}'";
	$query .= " AND sections.ACADEMIC_YEAR = {$query_array["year"]}";
	$query .= " AND sections.ACADEMIC_SESSION = '{$query_array["session"]}'";
	$query .= " AND sections.EVENT_ID = '{$query_array["event"]}'";
	$query .= " AND organization.ORG_CODE_ID = sections.ORG_CODE_ID";
	$query .= " ORDER By organization.ORG_NAME_1, sections.section";

	//echo $query;

	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	return $record_set;

}


// syllabi_syllabus
// -- Gets a syllabus attached to a particular section
// @param: expects associative array (term, year, session, event, section, organization)
function getSyllabusBySection($query_array) {
	global $connection;

	$query  = "SELECT * from syllabi_syllabus";
	$query .= " WHERE ACADEMIC_TERM = '{$query_array["term"]}'";
	$query .= " AND ACADEMIC_YEAR = {$query_array["year"]}";
	$query .= " AND ACADEMIC_SESSION = '{$query_array["session"]}'";
	$query .= " AND EVENT_ID = '{$query_array["event"]}'";
	$query .= " AND SECTION = '{$query_array["section"]}'";
	$query .= " AND ORG_CODE_ID = '{$query_array["organization"]}'";
	$query .= " Limit 1";

	$syllabus_set = mysqli_query($connection, $query);
	confirm_query($syllabus_set);
	return $syllabus_set;
}


// syllabi_syllabus_header
// -- Provides count of group level headers
// @param: expects syllabus_id
function getMaxHeaderGroups($syllabus_id) {
	global $connection;

	$query  = "SELECT count(*) as maxgroups";
	$query .= " FROM syllabi_syllabus_header";
	$query .= " WHERE syllabus_id = {$syllabus_id}";
	$query .= " AND group_id = id";
	
	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	return $record_set->fetch_array(MYSQLI_ASSOC)["maxgroups"];
}


// syllabi_syllabus_header
// -- Provides count of child level headers for a particular group header
// @param: expects syllabus_id, group_id
function getMaxHeaderChild($syllabus_id, $group_id) {
	global $connection;

	$query  = "SELECT count(*) as maxchild";
	$query .= " FROM syllabi_syllabus_header";
	$query .= " WHERE syllabus_id = {$syllabus_id}";
	$query .= " AND group_id = {$group_id}";
	
	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	return ($record_set->fetch_array(MYSQLI_ASSOC)["maxchild"]) - 1;
}


// syllabi_syllabus_header, syllabi_content_types
// -- Gets list of all headers linked to particular syllabus
// @param: expects syllabus_id
function getHeadersBySyllabus($syllabus_id) {
	global $connection;

	$query  = "SELECT syllabi_syllabus_header.*, syllabi_content_types.var_content_type, syllabi_content_types.var_img";
	$query .= " FROM syllabi_syllabus_header, syllabi_content_types";
	$query .= " WHERE syllabi_syllabus_header.syllabus_id = {$syllabus_id}";
	$query .= " AND syllabi_syllabus_header.type_id = syllabi_content_types.id";
	$query .= " ORDER BY syllabi_syllabus_header.display_index, syllabi_syllabus_header.child_index";
	
	$header_set = mysqli_query($connection, $query);
	confirm_query($header_set);
	return $header_set;
}


// syllabi_type_timelinedetails
// -- Provides count of timeline
// @param: expects timelineid
function getMaxTimeline($timelineid) {
	global $connection;

	$query  = "SELECT count(*) as maxgroups";
	$query .= " FROM syllabi_type_timelinedetails";
	$query .= " WHERE timelineid = {$timelineid}";
	
	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	return $record_set->fetch_array(MYSQLI_ASSOC)["maxgroups"];
}


// syllabi_type_groupdetails
// -- Provides count of Group
// @param: expects groupid
function getMaxGroup($groupid) {
	global $connection;

	$query  = "SELECT count(*) as maxgroups";
	$query .= " FROM syllabi_type_groupdetails";
	$query .= " WHERE groupid = {$groupid}";
	
	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	return $record_set->fetch_array(MYSQLI_ASSOC)["maxgroups"];
}


// syllabi_syllabus_header, syllabi_syllabus
// -- Provides inheritence source details
// @param: expects actionid
function getInheritance($actionid) {
	global $connection;

	$query  = "SELECT b.*";
	$query .= " FROM syllabi_syllabus_header as a, syllabi_syllabus as b";
	$query .= " WHERE a.id = {$actionid}";
    $query .= " AND a.syllabus_id = b.id";
    //$query .= " AND b.id = select ";

	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
    $detail = $record_set->fetch_array(MYSQLI_ASSOC);
    switch ($detail["type"]){
        case "university":
            return "University Level Template / ". $detail["templatename"];
        case "department":
            return "Department Level Template / ". $detail["department_code"] . " / " . $detail["templatename"];
        case "course":
            return "Course Level Template / ". $detail["department_code"] . " / " . $detail["event_id"] . " / " . $detail["templatename"];
        case "section":
            return "Section / " . $detail["academic_year"] . " / " . $detail["academic_term"] . ", Session " . $detail["academic_session"] . " / " . $detail["section"] . " / " . $detail["event_id"];
        default:
            return null;
    }
}


// SectionPrereq
// -- Get distinct Prereq_event_ids for a particular sectionId
function getPrereq($SectionId) {
  global $conn;

  $query  = "Select DISTINCT ACADEMIC_YEAR, ACADEMIC_TERM, SECTION, EVENT_ID, PREREQ_EVENT_ID, SectionId from prereq";
  $query .= " WHERE SectionId = " . $SectionId;

  //echo $query;

  $record_set = $conn->prepare($query);
  $record_set -> execute();
  $result = $record_set->fetchAll();
  return $result;
}