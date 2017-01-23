<?php
function redirectTo($page) {
	$host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  header("Location: http://$host$uri/$page");
  ob_end_flush();
  exit;
}


function isLoggedIn() {
	if (!isset($_SESSION["authenticated"])) {
		redirectTo("index.php");
	}
}




function confirm_query($result_set) {
	if (!$result_set) {
		die("Database query failed.");
	}
}

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

function dateMath($queryDate, $dateString) {
	$date=date_create($queryDate);
	date_add($date, date_interval_create_from_date_string($dateString));
	return strtotime(date_format($date, 'Y-m-d H:i:s'));
}

function checkQueryParams($param_array){
	$cnt = 0;
	for($i=0; $i < count($param_array); $i++){
		if(isset($_GET[$param_array[$i]])){
			$params_set[$param_array[$i]] = $_GET[$param_array[$i]];
			$cnt++;
		}
		$params_set["cnt"] = $cnt;
	}
	return $params_set;
}

function getAcademicTerms($year) {
	global $connection;

	$query  = "SELECT distinct ACADEMIC_TERM";
	$query .= " FROM academiccalendar";
	$query .= " WHERE ACADEMIC_YEAR = " . $year;
	$query .= " ORDER BY ACADEMIC_TERM ASC" ;
	
	$academicterms_set = mysqli_query($connection, $query);
	confirm_query($academicterms_set);
	return $academicterms_set;
}

function getAcademicSessions($year, $term) {
	global $connection;

	$query  = "SELECT * ";
	$query .= " FROM academiccalendar";
	$query .= " WHERE ACADEMIC_YEAR = " . $year;
	$query .= " AND ACADEMIC_TERM = '" . $term . "'";	
	$query .= " ORDER BY ACADEMIC_SESSION ASC" ;
	
	$academicsession_set = mysqli_query($connection, $query);
	confirm_query($academicsession_set);
	return $academicsession_set;
}

function insertSection($section) {
	global $connection;
	//INSERT INTO table_name (column1, column2, column3,...)
	//VALUES (value1, value2, value3,...)


	$query  = "INSERT into SECTIONS ";
	$query .= " (`ACADEMIC_YEAR`, `ACADEMIC_TERM`, `ACADEMIC_SESSION`, `EVENT_ID`, `EVENT_SUB_TYPE`, `SECTION`, `EVENT_MED_NAME`, `EVENT_LONG_NAME`, `EVENT_TYPE`, `ORG_CODE_ID`, `PROGRAM`, `COLLEGE`, `DEPARTMENT`, `CURRICULUM`, `CLASS_LEVEL`, `NONTRAD_PROGRAM`, `POPULATION`, `EVENT_STATUS`, `CIP_CODE`, `SPEEDE_CODE`, `SERIAL_ID`, `ROOM_TYPE`, `CREDIT_TYPE`, `CREDITS`, `CEU`, `MINUTES_WEEK`, `CONTACT_HOURS`, `REPORT_CARD_PRINT`, `TRANSCRIPT_PRINT`, `MIN_PARTICIPANT`, `TARGET_PARTICIPANT`, `MAX_PARTICIPANT`, `OTHER_ORG`, `OTHER_ORG_PART`, `OTHER_PROGRAM`, `OTHER_PROGRAM_PART`, `OTHER_COLLEGE`, `OTHER_COLLEGE_PART`, `OTHER_DEPARTMENT`, `OTHER_DEPT_PART`, `OTHER_CURRICULUM`, `OTHER_CURRIC_PART`, `OTHER_CLASS_LEVEL`, `OTHER_CLEVEL_PART`, `OTHER_NONTRAD`, `OTHER_NONTRAD_PART`, `OTHER_POPULATION`, `OTHER_POP_PART`, `ADDS`, `DROPS`, `WAIT_LIST`, `OTHER_ORG_ADD`, `OTHER_ORG_DROP`, `OTHER_ORG_WAIT`, `OTHER_PROGRAM_ADD`, `OTHER_PROGRAM_DROP`, `OTHER_PROGRAM_WAIT`, `OTHER_COLLEGE_ADD`, `OTHER_COLLEGE_DROP`, `OTHER_COLLEGE_WAIT`, `OTHER_DEPT_ADD`, `OTHER_DEPT_DROP`, `OTHER_DEPT_WAIT`, `OTHER_CURR_ADD`, `OTHER_CURR_DROP`, `OTHER_CURR_WAIT`, `OTHER_CLEVEL_ADD`, `OTHER_CLEVEL_DROP`, `OTHER_CLEVEL_WAIT`, `OTHER_NONTRAD_ADD`, `OTHER_NONTRAD_DROP`, `OTHER_NONTRAD_WAIT`, `OTHER_POP_ADD`, `OTHER_POP_DROP`, `OTHER_POP_WAIT`, `WEEK_NUMBER`, `START_DATE`, `END_DATE`, `DESCRIPTION`, `SEC_ENROLL_STATUS`, `CREATE_DATE`, `CREATE_TIME`, `CREATE_OPID`, `CREATE_TERMINAL`, `REVISION_DATE`, `REVISION_TIME`, `REVISION_OPID`, `REVISION_TERMINAL`, `ABT_JOIN`, `GENERAL_ED`, `CONTACT_HR_SESSION`, `MID_GRD_RECEIVED`, `FINAL_GRD_RECEIVED`, `SCHEDULE_PRIORITY`, `PUBLICATION_NAME_1`, `PUBLICATION_NAME_2`, `LATE_REG_FEE_DATE`, `REQUESTED_MEETINGS`, `SCHEDULED_MEETINGS`, `ANONYMOUS_GRADING`, `CANCEL_REASON`, `LAST_REFUND_DATE`, `ADJUSTMENT_POLICY_ID`, `REPEATABLE`, `ACTIVITY_TYPE_GRADING`, `REGISTRATION_TYPE`, `SectionId`, `AssignmentWeightingMethod`, `UseWeightedAssignmentTypes`, `RequiresGradeApproval`)";
	$query .= " VALUES";
	$query .= " ('{$section['ACADEMIC_YEAR']}', '{$section['ACADEMIC_TERM']}', '{$section['ACADEMIC_SESSION']}', '{$section['EVENT_ID']}', '{$section['EVENT_SUB_TYPE']}', '{$section['SECTION']}', '{$section['EVENT_MED_NAME']}', '{$section['EVENT_LONG_NAME']}', '{$section['EVENT_TYPE']}', '{$section['ORG_CODE_ID']}', '{$section['PROGRAM']}', '{$section['COLLEGE']}', '{$section['DEPARTMENT']}', '{$section['CURRICULUM']}', '{$section['CLASS_LEVEL']}', '{$section['NONTRAD_PROGRAM']}', '{$section['POPULATION']}', '{$section['EVENT_STATUS']}', '{$section['CIP_CODE']}', '{$section['SPEEDE_CODE']}', '{$section['SERIAL_ID']}', '{$section['ROOM_TYPE']}', '{$section['CREDIT_TYPE']}', '{$section['CREDITS']}', '{$section['CEU']}', '{$section['MINUTES_WEEK']}', '{$section['CONTACT_HOURS']}', '{$section['REPORT_CARD_PRINT']}', '{$section['TRANSCRIPT_PRINT']}', '{$section['MIN_PARTICIPANT']}', '{$section['TARGET_PARTICIPANT']}', '{$section['MAX_PARTICIPANT']}', '{$section['OTHER_ORG']}', '{$section['OTHER_ORG_PART']}', '{$section['OTHER_PROGRAM']}', '{$section['OTHER_PROGRAM_PART']}', '{$section['OTHER_COLLEGE']}', '{$section['OTHER_COLLEGE_PART']}', '{$section['OTHER_DEPARTMENT']}', '{$section['OTHER_DEPT_PART']}', '{$section['OTHER_CURRICULUM']}', '{$section['OTHER_CURRIC_PART']}', '{$section['OTHER_CLASS_LEVEL']}', '{$section['OTHER_CLEVEL_PART']}', '{$section['OTHER_NONTRAD']}', '{$section['OTHER_NONTRAD_PART']}', '{$section['OTHER_POPULATION']}', '{$section['OTHER_POP_PART']}', '{$section['ADDS']}', '{$section['DROPS']}', '{$section['WAIT_LIST']}', '{$section['OTHER_ORG_ADD']}', '{$section['OTHER_ORG_DROP']}', '{$section['OTHER_ORG_WAIT']}', '{$section['OTHER_PROGRAM_ADD']}', '{$section['OTHER_PROGRAM_DROP']}', '{$section['OTHER_PROGRAM_WAIT']}', '{$section['OTHER_COLLEGE_ADD']}', '{$section['OTHER_COLLEGE_DROP']}', '{$section['OTHER_COLLEGE_WAIT']}', '{$section['OTHER_DEPT_ADD']}', '{$section['OTHER_DEPT_DROP']}', '{$section['OTHER_DEPT_WAIT']}', '{$section['OTHER_CURR_ADD']}', '{$section['OTHER_CURR_DROP']}', '{$section['OTHER_CURR_WAIT']}', '{$section['OTHER_CLEVEL_ADD']}', '{$section['OTHER_CLEVEL_DROP']}', '{$section['OTHER_CLEVEL_WAIT']}', '{$section['OTHER_NONTRAD_ADD']}', '{$section['OTHER_NONTRAD_DROP']}', '{$section['OTHER_NONTRAD_WAIT']}', '{$section['OTHER_POP_ADD']}', '{$section['OTHER_POP_DROP']}', '{$section['OTHER_POP_WAIT']}', '{$section['WEEK_NUMBER']}', '{$section['START_DATE']}', '{$section['END_DATE']}', '{$section['DESCRIPTION']}', '{$section['SEC_ENROLL_STATUS']}', '{$section['CREATE_DATE']}', '{$section['CREATE_TIME']}', '{$section['CREATE_OPID']}', '{$section['CREATE_TERMINAL']}', '{$section['REVISION_DATE']}', '{$section['REVISION_TIME']}', '{$section['REVISION_OPID']}', '{$section['REVISION_TERMINAL']}', '{$section['ABT_JOIN']}', '{$section['GENERAL_ED']}', '{$section['CONTACT_HR_SESSION']}', '{$section['MID_GRD_RECEIVED']}', '{$section['FINAL_GRD_RECEIVED']}', '{$section['SCHEDULE_PRIORITY']}', '{$section['PUBLICATION_NAME_1']}', '{$section['PUBLICATION_NAME_2']}', '{$section['LATE_REG_FEE_DATE']}', '{$section['REQUESTED_MEETINGS']}', '{$section['SCHEDULED_MEETINGS']}', '{$section['ANONYMOUS_GRADING']}', '{$section['CANCEL_REASON']}', '{$section['LAST_REFUND_DATE']}', '{$section['ADJUSTMENT_POLICY_ID']}', '{$section['REPEATABLE']}', '{$section['ACTIVITY_TYPE_GRADING']}', '{$section['REGISTRATION_TYPE']}', '{$section['SectionId']}', '{$section['AssignmentWeightingMethod']}', '{$section['UseWeightedAssignmentTypes']}', '{$section['RequiresGradeApproval']}')";
	
	echo $query . "<br/>";

	$sections_set = mysqli_query($connection, $query);
	confirm_query($sections_set);
	return $sections_set;
}


function insertDepartment($department) {
	global $connection;
	//INSERT INTO table_name (column1, column2, column3,...)
	//VALUES (value1, value2, value3,...)


	$query  = "INSERT into CODE_DEPARTMENT ";
	$query .= "(CODE_VALUE_KEY, CODE_VALUE, SHORT_DESC, MEDIUM_DESC, LONG_DESC, STATUS, CREATE_DATE, CREATE_TIME, CREATE_OPID, CREATE_TERMINAL, REVISION_DATE, REVISION_TIME, REVISION_OPID, REVISION_TERMINAL, CODE_XVAL, CODE_XDESC, ABT_JOIN, DepartmentId)";
	$query .= " VALUES";
	$query .= "('{$department['CODE_VALUE_KEY']}', '{$department['CODE_VALUE']}', '{$department['SHORT_DESC']}', '{$department['MEDIUM_DESC']}', '{$department['LONG_DESC']}', '{$department['STATUS']}', '{$department['CREATE_DATE']}', '{$department['CREATE_TIME']}', '{$department['CREATE_OPID']}', '{$department['CREATE_TERMINAL']}', '{$department['REVISION_DATE']}', '{$department['REVISION_TIME']}', '{$department['REVISION_OPID']}', '{$department['REVISION_TERMINAL']}', '{$department['CODE_XVAL']}', '{$department['CODE_XDESC']}', '{$department['ABT_JOIN']}', '{$department['DepartmentId']}')";
	
	echo $query . "<br/>";

	$department_set = mysqli_query($connection, $query);
	confirm_query($department_set);
	return $department_set;
}

function insertEvent($event) {
	global $connection;
	//INSERT INTO table_name (column1, column2, column3,...)
	//VALUES (value1, value2, value3,...)


	$query  = "INSERT into EVENT ";
	$query .= "(EVENT_ID, EVENT_MED_NAME, EVENT_LONG_NAME, EVENT_TYPE, ORG_CODE_ID, PROGRAM, COLLEGE, DEPARTMENT, CURRICULUM, CLASS_LEVEL, NONTRAD_PROGRAM, POPULATION, EVENT_STATUS, CIP_CODE, SPEEDE_CODE, SERIAL_ID, CREDIT_TYPE, CREDITS, CEU, CREATE_DATE, CREATE_TIME, CREATE_OPID, CREATE_TERMINAL, REVISION_DATE, REVISION_TIME, REVISION_OPID, REVISION_TERMINAL, DESCRIPTION, ABT_JOIN, GENERAL_ED, SCHEDULE_PRIORITY, PUBLICATION_NAME_1, PUBLICATION_NAME_2, REPEATABLE, EventId)";
	$query .= " VALUES";
	$query .= "('{$event['EVENT_ID']}', '{$event['EVENT_MED_NAME']}', '{$event['EVENT_LONG_NAME']}', '{$event['EVENT_TYPE']}', '{$event['ORG_CODE_ID']}', '{$event['PROGRAM']}', '{$event['COLLEGE']}', '{$event['DEPARTMENT']}', '{$event['CURRICULUM']}', '{$event['CLASS_LEVEL']}', '{$event['NONTRAD_PROGRAM']}', '{$event['POPULATION']}', '{$event['EVENT_STATUS']}', '{$event['CIP_CODE']}', '{$event['SPEEDE_CODE']}', '{$event['SERIAL_ID']}', '{$event['CREDIT_TYPE']}', '{$event['CREDITS']}', '{$event['CEU']}', '{$event['CREATE_DATE']}', '{$event['CREATE_TIME']}', '{$event['CREATE_OPID']}', '{$event['CREATE_TERMINAL']}', '{$event['REVISION_DATE']}', '{$event['REVISION_TIME']}', '{$event['REVISION_OPID']}', '{$event['REVISION_TERMINAL']}', '{$event['DESCRIPTION']}', '{$event['ABT_JOIN']}', '{$event['GENERAL_ED']}', '{$event['SCHEDULE_PRIORITY']}', '{$event['PUBLICATION_NAME_1']}', '{$event['PUBLICATION_NAME_2']}', '{$event['REPEATABLE']}', '{$event['EventId']}')";
	
	echo $query . "<br/>";

	$event_set = mysqli_query($connection, $query);
	confirm_query($event_set);
	return $event_set;
}

function getEventsbyDepartment($query_array) {
	global $connection;

	$query  = "SELECT COUNT(sections.EVENT_ID) as sec_count, event.*";
	$query .= " FROM event, sections";
	$query .= " WHERE event.EVENT_ID = sections.EVENT_ID";
	$query .= "	AND event.DEPARTMENT = '{$query_array["department"]}'";
	$query .= " AND sections.ACADEMIC_TERM = '{$query_array["term"]}'";
	$query .= " AND sections.ACADEMIC_YEAR = {$query_array["year"]}";
	$query .= " AND sections.ACADEMIC_SESSION = '{$query_array["session"]}'";
	$query .= " GROUP BY event.EVENT_ID";
	
	$event_set = mysqli_query($connection, $query);
	confirm_query($event_set);
	return $event_set;
}


function getDepartments() {
	global $connection;

	$query  = "SELECT *";
	$query .= " FROM CODE_DEPARTMENT";
	$query .= " WHERE STATUS = 'A'";
	$query .= " ORDER BY LONG_DESC ASC" ;
	
	$department_set = mysqli_query($connection, $query);
	confirm_query($department_set);
	return $department_set;
}

function getById($database, $column, $id) {
	global $connection;

	$query  = "SELECT *";
	$query .= " FROM {$database}";
	$query .= " WHERE {$column} = '{$id}'";
	$query .= " Limit 1";
	
	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	return $record_set->fetch_array(MYSQLI_ASSOC);
}


function getAll($database, $query_array, $sort_field, $sort_order) {
	global $connection;

	$query  = "SELECT *";
	$query .= " FROM {$database}";
	if(isset($query_array)){
		$query .= " WHERE";	
		$cnt=0;
		foreach ($query_array as $key => $value) {
			if($cnt > 0) $query=" AND";
			$query .= " {$key} = '{$value}'";		
		}
	}
	
	if(isset($sort_field)){
		$query .= " ORDER BY";	
		$query .= " {$sort_field}";	
	}

	if(isset($sort_order)){
		$query .= " {$sort_order}";	
	}

	

	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	return $record_set;
}

function getSchoolsByEventId($query_array) {
	//Not used
	global $connection;

	$query  = "SELECT *";
	$query .= " FROM organization";
	$query .= " WHERE ORG_CODE_ID in (SELECT distinct ORG_CODE_ID from sections where";
	$query .= " ACADEMIC_TERM = '{$query_array["term"]}'";
	$query .= " AND ACADEMIC_YEAR = {$query_array["year"]}";
	$query .= " AND ACADEMIC_SESSION = '{$query_array["session"]}'";
	$query .= " AND EVENT_ID = '{$query_array["event"]}')";
	$query .= " ORDER BY ORG_NAME_1 ASC" ;

	$organization_set = mysqli_query($connection, $query);
	confirm_query($organization_set);
	return $organization_set;
}


function getSectionsBySchool($query_array) {
	global $connection;

	$query  = "SELECT sections.*, organization.ORG_NAME_1 from sections, organization";
	$query .= " WHERE sections.ACADEMIC_TERM = '{$query_array["term"]}'";
	$query .= " AND sections.ACADEMIC_YEAR = {$query_array["year"]}";
	$query .= " AND sections.ACADEMIC_SESSION = '{$query_array["session"]}'";
	$query .= " AND sections.EVENT_ID = '{$query_array["event"]}'";
	$query .= " AND organization.ORG_CODE_ID = sections.ORG_CODE_ID";
	$query .= " ORDER By organization.ORG_NAME_1, sections.section";

	$section_set = mysqli_query($connection, $query);
	confirm_query($section_set);
	return $section_set;
}

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

function newSyllabus($query_array) {
	$check = getSyllabusBySection($query_array)->fetch_array(MYSQLI_ASSOC);
	
	if($check){
		return $check["id"];
	} else {
		
		global $connection;

		$query  = "INSERT INTO syllabi_syllabus";
		$query .= "(academic_year, academic_term, academic_session, event_id, section, org_code_id, created_dt)";
		$query .= " VALUES";
		$query .= "('{$query_array['year']}', '{$query_array['term']}', '{$query_array['session']}', '{$query_array['event']}', '{$query_array['section']}', '{$query_array['organization']}', '" . currentDate() . "')";
		
		echo $query;

		$syllabus_set = mysqli_query($connection, $query);
		confirm_query($syllabus_set);
		
		return $connection->insert_id;
	}

}



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


function currentDate(){
	$date = date("Y-m-d");
	return $date;
}

function padString($number, $pad_len){
	$result=null;
	for($i=0; $i < $pad_len - strlen($number); $i++){
		$result .= "0";
	}
	$result .= $number;
	return $result;
}

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


