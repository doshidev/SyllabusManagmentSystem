<?php include("head.php");

//Check query parameters

$form_params = checkFormParams(array("id", "to"));
//echo $form_params["cnt"];
if($form_params["cnt"] != 2) {
  redirectTo("syllabusmanage.php");  
}

$id = $form_params["id"];
$to = $form_params["to"];  
$action = array();
$headers = getHeadersBySyllabus($id);


foreach($headers as $header) {
  if($_POST["action". $header["group_id"]] != "0"){
    $action[$header["id"]]["id"]=$header["id"];
    $action[$header["id"]]["syllabus_id"]=$header["syllabus_id"];
    $action[$header["id"]]["group_id"]=$header["group_id"];
    $action[$header["id"]]["action"]=$_POST["action". $header["group_id"]];
    $action[$header["id"]]["header_to"]=null;

    $action[$header["id"]]["header_to"] = newHeader($to); 
    if($header["id"] == $header["group_id"]) {
      $display_index = getMaxHeaderGroups($to) + 1;
      $child_index = 0;
    } else {
      $group_recordset = getById("syllabi_syllabus_header", "id", $action[$header["group_id"]]["header_to"]);
      $display_index = $group_recordset["display_index"];
      $child_index = (getMaxHeaderChild($to, $action[$header["group_id"]]["header_to"])) + 1;
    }


    // Update Record
    // Build a Query
    if($action[$header["id"]]["action"] == "i"){
      // Inherit
      // -------
      if($header["action"] == "i"){
        $actionid=$header["action_id"];
      } else {
        $actionid=$header["id"];
      }

      $queryset = array(
        "icon" => $header["icon"],
        "header" => $header["header"],
        "type_id" => $header["type_id"],
        "description" => $header["description"],
        "display_index" => $display_index,
        "child_index" => $child_index,
        "action" => "i",
        "action_id" => $actionid,
        "content_id" => $header["content_id"],
        "faculty" => $header["faculty"],
        );

      if($queryset["content_id"]==""){
        $queryset["content_id"] = 0;
      }

      if($header["id"] == $header["group_id"]){
        $queryset["group_id"] = $action[$header["id"]]["header_to"];
      } else {
        $queryset["group_id"] = $action[$header["group_id"]]["header_to"];
      }  
        
    } else if($action[$header["id"]]["action"] == "r"){
      // Replicate
      // ---------
      
      // Update Record
      // Build a Query
      $queryset = array(
        "icon" => $header["icon"],
        "header" => $header["header"],
        "type_id" => $header["type_id"],
        "description" => $header["description"],
        "display_index" => $display_index,
        "child_index" => $child_index,
        "action" => "r",
        "action_id" => $header["id"],
        "faculty" => $header["faculty"],
        );
      
      if($header["id"] == $header["group_id"]){
        $queryset["group_id"] = $action[$header["id"]]["header_to"];
      } else {
        $queryset["group_id"] = $action[$header["group_id"]]["header_to"];
      }  
      
      // Duplicate Content Record
      
      // 1. identify table
      echo "Get By Id table";
      $table = getById("syllabi_content_types", "id", $header["type_id"])["datatable"];
      echo "content, " . $table . " <br/>";
      if($table){
        $content = getById($table, "id", $header["content_id"]);
      }

      // 2. copy fields 
      $fields_array = array()  ;
      
      if($table == "syllabi_type_group"){
        // Build array of fields
        $fields_array["type"] = $content["type"];
        $fields_array["cols"] = $content["cols"];
        $fields_array["pretext"] = $content["pretext"];
        $fields_array["posttext"] = $content["posttext"];

        echo "<br/>";
        echo "<pre>";
        var_dump($fields_array);
        echo "</pre>";
        $queryset["content_id"] = insertFields($table, $fields_array);

        // copy group_details for new record
        $details_array = array();
        
        echo "<br/> - syllabi_type_groupdetails - getAll()";

        $group_details = getAll("syllabi_type_groupdetails", array("groupid"=>$header["content_id"]), "display_index", "asc");
        

        foreach($group_details as $details){
          unset($details_array);
          $details_array["groupid"] = $queryset["content_id"];
          $details_array["title"] = $details["title"];
          $details_array["titlecolor"] = $details["titlecolor"];
          $details_array["content"] = $details["content"];
          $details_array["footer"] = $details["footer"];
          $details_array["display_index"] = $details["display_index"];
          echo "<br/> - syllabi_type_groupdetails - insertFields()";
          insertFields("syllabi_type_groupdetails", $details_array);

        }
        

      }

      if($table == "syllabi_type_overview"){
        // Build array of fields
        $fields_array["class_schedule"] = $content["class_schedule"];
        $fields_array["prerequisite"] = $content["prerequisite"];
        $fields_array["cancellation_number"] = $content["cancellation_number"];
        $fields_array["faculty_name"] = $content["faculty_name"];
        $fields_array["faculty_email"] = $content["faculty_email"];
        $fields_array["office_hours"] = $content["office_hours"];
        $fields_array["office_location"] = $content["office_location"];
        $fields_array["office_phone"] = $content["office_phone"];
        $fields_array["faculty_phone"] = $content["faculty_phone"];
        $fields_array["pretext"] = $content["pretext"];
        $fields_array["posttext"] = $content["posttext"];

        echo "<br/> - syllabi_type_overview - insertFields()";

        $queryset["content_id"] = insertFields($table, $fields_array);
      }

      if($table == "syllabi_type_text"){
        // Build array of fields
        $fields_array["content"] = $content["content"];
        
        echo "<br/> - syllabi_type_text - insertFields()";
        
        echo "<br/>" . $table;
        echo "<pre>";
        var_dump($fields_array);
        echo "</pre>";

        $queryset["content_id"] = insertFields($table, $fields_array);
      }

      if($table == "syllabi_type_textbook"){
        // Build array of fields
        $fields_array["isbn"] = $content["isbn"];
        $fields_array["title"] = $content["title"];
        $fields_array["author"] = $content["author"];
        $fields_array["publisher"] = $content["publisher"];
        $fields_array["publisheddate"] = $content["publisheddate"];
        if($content["pagecount"]!=null && $content["pagecount"]!=''){
          $fields_array["pagecount"] = $content["pagecount"];
        }
        if($content["category"]!=null && $content["category"]!=''){
          $fields_array["category"] = $content["category"];
        }
        $fields_array["smallthumbnail"] = $content["smallthumbnail"];

        if($content["ebook"]!=null && $content["ebook"]!=''){
          $fields_array["ebook"] = $content["ebook"];
        }
        $fields_array["pretext"] = $content["pretext"];
        $fields_array["posttext"] = $content["posttext"];
        
        echo "<br/> - syllabi_type_textbook - insertFields()";

        $queryset["content_id"] = insertFields($table, $fields_array);
      }

      if($table == "syllabi_type_timeline"){
        // Build array of fields
        $fields_array["title"] = $content["title"];
        $fields_array["pretext"] = $content["pretext"];
        $fields_array["posttext"] = $content["posttext"];
        echo "<br/> - syllabi_type_timeline - insertFields()";
        $queryset["content_id"] = insertFields($table, $fields_array);
        
        // copy group_details for new record
        $timeline_array = array();
        $timeline_details = getAll("syllabi_type_timelinedetails", array("timelineid"=>$header["content_id"]), "display_index", "asc");
        foreach($timeline_details as $details){
          unset($timeline_array);
          $timeline_array["timelineid"] = $queryset["content_id"];
          $timeline_array["title"] = $details["title"];
          $timeline_array["content"] = $details["content"];
          $timeline_array["icon"] = $details["icon"];
          $timeline_array["badgecolor"] = $details["badgecolor"];
          $timeline_array["display_index"] = $details["display_index"];
          echo "<br/> - syllabi_type_timelinedetails - insertFields()";
          insertFields("syllabi_type_timelinedetails", $timeline_array);
        }

      }

    } // else if(action == "r")

    echo "<br/> - syllabi_syllabus_header - updateById()";
    updateById("syllabi_syllabus_header", $action[$header["id"]]["header_to"], $queryset);

  } //if(action !=0)


} // for loop 


// Redirect
redirectTo("syllabusadd.php?id=" . $to);

include("footer.php"); ?>