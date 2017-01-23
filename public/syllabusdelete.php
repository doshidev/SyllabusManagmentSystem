<?php $page_name = "Delete Syllabus" ?>
<?php include("head.php"); ?>


<?php

$query_params = checkQueryParams(array("id", "returnpage"));
  if($query_params["cnt"] != 2) {
    redirectTo("syllabusmanage.php");
  }


// Delete Syllabus
  deleteTemplate($query_params["id"]);

//Redirect
redirectTo($query_params["returnpage"]);
?>

<?php include("footer.php"); ?>