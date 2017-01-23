<?php $page_name = "Delete Header" ?>
<?php include("head.php"); ?>


<?php

$query_params = checkQueryParams(array("id", "syllabusid", "groupid"));
  if($query_params["cnt"] < 3) {
    redirectTo("syllabusmanage.php");
  }

// Change Display Index of Other Items
moveGroupIndexBeforeDelete($query_params["groupid"], $query_params["id"]);

// Delete Record
deleteById("syllabi_type_groupdetails", "id", $query_params["id"]);

//Redirect
redirectTo("syllabuseditgroup.php?id=" . $query_params["groupid"] . "&syllabus_id=" . $query_params["syllabusid"]);
?>

<?php include("footer.php"); ?>