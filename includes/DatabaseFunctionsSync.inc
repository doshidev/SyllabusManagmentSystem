<?php 

// sections
// -- insert new section (from powercampus only)
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


// department
// -- insert new department (from powercampus only)
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


// event
// -- insert new event (from powercampus only)
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