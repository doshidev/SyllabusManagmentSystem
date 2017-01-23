<?php $page_name = "Move Header" ?>
<?php include("head.php"); ?>


<?php

$query_params = checkQueryParams(array("id", "syllabusid", "type", "direction"));
  if($query_params["cnt"] < 4) {
    redirectTo("syllabusmanage.php");
  }

// Change Display Index of Other Items
moveDisplayIndex($query_params["type"], $query_params["syllabusid"], $query_params["id"], $query_params["direction"]);

//Redirect
redirectTo("syllabusadd.php?id=" . $query_params["syllabusid"]);
?>

<?php include("footer.php"); ?>