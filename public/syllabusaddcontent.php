<?php $page_name = "Add Content" ?>
<?php include("head.php"); ?>


<?php

$query_params = checkQueryParams(array("datatable", "header_id", "syllabus_id", "editpage"));
  if($query_params["cnt"] != 4) {
    redirectTo("syllabusmanage.php");
  }

// Add New Record in Content Type Database
$content_id = insertBlank($query_params["datatable"]);

// Update Content Id in Header
updateById("syllabi_syllabus_header", $query_params["header_id"], array("content_id" => "{$content_id}"));

//Redirect to Content Edit Page
redirectTo($query_params["editpage"] . "?id=" . $content_id . "&syllabus_id=" . $query_params["syllabus_id"]);
?>

<?php include("footer.php"); ?>