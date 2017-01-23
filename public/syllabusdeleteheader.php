<?php $page_name = "Delete Header" ?>
<?php include("head.php"); ?>


<?php

$query_params = checkQueryParams(array("id", "syllabusid", "type"));
  if($query_params["cnt"] < 3) {
    redirectTo("syllabusmanage.php");
  }

// Change Display Index of Other Items
moveDisplayIndexBeforeDelete($query_params["type"], $query_params["syllabusid"], $query_params["id"]);

// Delete all childs
deleteChildHeaders($query_params["id"]);

// Delete Header
deleteById("syllabi_syllabus_header", "id", $query_params["id"]);

//Redirect
redirectTo("syllabusadd.php?id=" . $query_params["syllabusid"]);
?>

<?php include("footer.php"); ?>