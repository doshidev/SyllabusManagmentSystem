<?php $page_name = "Move Group Details" ?>
<?php include("head.php"); ?>


<?php

$query_params = checkQueryParams(array("id", "groupid", "direction", "syllabusid"));
  if($query_params["cnt"] != 4) {
    //redirectTo("syllabusmanage.php");
  }

  echo "Count = " . $query_params["cnt"];


// Change Display Index of Other Items
moveGroupIndex($query_params["groupid"], $query_params["id"], $query_params["direction"]);

//Redirect
redirectTo("syllabuseditgroup.php?id=" . $query_params["groupid"] . "&syllabus_id=" . $query_params["syllabusid"]);
?>

<?php include("footer.php"); ?>