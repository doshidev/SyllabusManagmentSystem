<?php $page_name = "Move Timeline Details" ?>
<?php include("head.php"); ?>


<?php

$query_params = checkQueryParams(array("id", "timelineid", "direction", "syllabusid"));
  if($query_params["cnt"] != 4) {
    //redirectTo("syllabusmanage.php");
  }

  echo "Count = " . $query_params["cnt"];


// Change Display Index of Other Items
moveTimelineIndex($query_params["timelineid"], $query_params["id"], $query_params["direction"]);

//Redirect
redirectTo("syllabusedittimeline.php?id=" . $query_params["timelineid"] . "&syllabus_id=" . $query_params["syllabusid"] . "#t" . $query_params["id"]);
?>

<?php include("footer.php"); ?>