<?php $page_name = "Update Header" ?>
<?php include("head.php"); ?>


<?php

$check_params = checkFormParams(array("header_id", "syllabus_id", "formaction"));
  if($check_params["cnt"] < 3) {
    redirectTo("syllabusmanage.php");
  }

$form_params = checkFormParams(array("header_id", "syllabus_id", "formaction", "header", "description", "group_id", "type_id", "icon", "faculty"));

// Create New Record
if($check_params["formaction"] == "Add") {
	$form_params["header_id"] = newHeader($form_params["syllabus_id"]);	

	// Get Max for setting priority
	if($form_params["group_id"] == "self") {
		$form_params["display_index"] = (getMaxHeaderGroups($form_params["syllabus_id"])) + 1;
		$form_params["child_index"] = 0;
	} else {
		$group_recordset = getById("syllabi_syllabus_header", "id", $form_params["group_id"]);
		$form_params["display_index"] = $group_recordset["display_index"];
		$form_params["child_index"] = (getMaxHeaderChild($form_params["syllabus_id"], $form_params["group_id"])) + 1;
	}
}

// Update Record
// Build a Query
$queryset = array(
	"icon" => $form_params["icon"],
	"header" => $form_params["header"],
	"type_id" => $form_params["type_id"],
	"description" => $form_params["description"],
    "faculty" => $form_params["faculty"],
	);
	if($form_params["group_id"] == "self"){
		$queryset["group_id"] = $form_params["header_id"];
	} else {
		$queryset["group_id"] = $form_params["group_id"];
	}
	
	if($check_params["formaction"] == "Add"){
		$queryset["display_index"] = $form_params["display_index"];
		$queryset["child_index"] = $form_params["child_index"];
	}

updateById("syllabi_syllabus_header", $form_params["header_id"], $queryset);


// Redirect
redirectTo("syllabusadd.php?id=" . $form_params["syllabus_id"]);
?>

<?php include("footer.php"); ?>