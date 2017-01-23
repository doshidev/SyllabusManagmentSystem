<?php $page_name = "Manage Content" ?>
<?php include("head.php"); ?>
    



<!-- Check query parameters -->
<?php
  //Check query parameters
  
  $query_params = checkQueryParams(array("user", "sectionid"));
  var_dump($query_params);
  if(isset($query_params["sectionid"])){
    $id = getById("syllabi_syllabus", "SectionId", intval($query_params["sectionid"]));
    if(!$id){
      redirectTo("notfound.php");
    } else {
      redirectTo("syllabus.php?id=".$id["id"]);
    }
  } else {
      redirectTo("notfound.php");  
  }



?>
<?php include("footer.php"); ?>
