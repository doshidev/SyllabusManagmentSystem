<?php $page_name = "Delete Header" ?>
<?php include("head.php"); ?>


<?php

$query_params = checkQueryParams(array("id", "syllabusid", "timelineid"));
  if($query_params["cnt"] < 3) {
    redirectTo("syllabusmanage.php");
  }

// Change Display Index of Other Items
moveTimelineIndexBeforeDelete($query_params["timelineid"], $query_params["id"]);

// Delete Record
deleteById("syllabi_type_timelinedetails", "id", $query_params["id"]);

//Redirect
redirectTo("syllabusedittimeline.php?id=" . $query_params["timelineid"] . "&syllabus_id=" . $query_params["syllabusid"]);
?>

<?php include("footer.php"); ?>