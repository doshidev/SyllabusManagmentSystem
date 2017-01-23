<?php $page_name = "Update Template" ?>
<?php include("head.php"); ?>


<?php

$check_params = checkFormParams(array("header_id", "type", "formaction"));
  if($check_params["cnt"] < 3) {
    redirectTo("syllabusmanage.php");
  }

$form_params = checkFormParams(array("type", "templatename", "event_id", "department_code"));
unset($form_params['cnt']);

if($check_params["formaction"] == "Add") {
	// Create New Record
	$check_params["header_id"] = insertFields('syllabi_syllabus', $form_params);
} 

if($check_params["type"]=="course"){
	$form_params["department_code"] = getVwById('VWSyllabi_event', 'EVENT_ID', $form_params["event_id"])["DEPARTMENT"];
}

// Update Record	
updateById("syllabi_syllabus", $check_params["header_id"], $form_params);	
	


// Redirect
redirectTo("templatelibrary". $check_params["type"] .".php");
?>

<?php include("footer.php"); ?>