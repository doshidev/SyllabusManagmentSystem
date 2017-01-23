<?php $page_name = "Manage Headers" ?>
<?php include("head.php"); ?>

<div id="wrapper">
  <!-- Navigation -->
  <?php require 'nav.php';?>
</div>

<div id="page-wrapper">
	<div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><?php echo $page_name?></h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->	



	<?php
	//Check query parameters
	
  $query_params = checkQueryParams(array("year", "term", "session", "department", "organization", "event", "section", "school", "id", "type", "SectionId"));
  if(isset($query_params["id"])){
    $syllabus_id = $query_params["id"];
  } elseif($query_params["cnt"] == 10) {
    
    $event1 = getVwById("event", "EVENT_ID", $query_params["event"]);
    $query_params["templatename"] = $event1["EVENT_LONG_NAME"];
    $syllabus_id = newSyllabus($query_params);
    redirectTo("syllabusadd.php?id=" . $syllabus_id);
  } else {
    redirectTo("syllabusmanage.php");  
  }

  
	?>
	
  <div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
      <li><a href="myhome.php">Home</a></li>
      <li>Manage Headers</li>
      </ol>
    </div>
  </div>
  
  <?php $syllabus = getById("syllabi_syllabus", "id", $syllabus_id);?>
  <?php $event = getVwById("event", "EVENT_ID", $syllabus["event_id"]);?>
  <?php $department = getVwById("CODE_DEPARTMENT", "CODE_VALUE", $event["DEPARTMENT"]);?>
  <?php $school = getVwById("organization", "ORG_CODE_ID", $syllabus["org_code_id"]);?>
  <?php 
  if(!$syllabus["academic_session"]){
    $syllabus["academic_session"]="D";
    $type="library";
  } else {
    $type="section";
  }
  ?>
  <div class="row">
    <div class="col-lg-12">
      <p>
      <?php if($type=="section"){?>
        <button class="btn btn-outline btn-<?php echo $button_color[$syllabus["academic_session"]];?>"><?php echo $syllabus["academic_year"];?></button>
        <button class="btn btn-outline btn-<?php echo $button_color[$syllabus["academic_session"]];?>"><?php echo $syllabus["academic_term"];?></button>
        <button class="btn btn-outline btn-<?php echo $button_color[$syllabus["academic_session"]];?>">Session <?php echo $syllabus["academic_session"];?></button>
        <button class="btn btn-outline btn-<?php echo $button_color[$syllabus["academic_session"]];?>"><?php echo $department["LONG_DESC"];?></button>
        <button class="btn btn-outline btn-<?php echo $button_color[$syllabus["academic_session"]];?>"><?php echo $syllabus["event_id"];?></button>
        <button class="btn btn-outline btn-<?php echo $button_color[$syllabus["academic_session"]];?>"><?php echo $school["ORG_NAME_1"];?></button>
        <button class="btn btn-outline btn-<?php echo $button_color[$syllabus["academic_session"]];?>"><?php echo $syllabus["section"];?></button>
      <?php } else { ?>
        <button class="btn btn-outline btn-<?php echo $button_color[$syllabus["academic_session"]];?>">Master Template</button>
        <button class="btn btn-outline btn-<?php echo $button_color[$syllabus["academic_session"]];?>"><?php echo strtoupper($syllabus["type"]);?></button>
      <?php } ?>
      </p>
      </div>
  </div>

  

  
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <h2>
            <?php if($type=="section"){?>
              <?php echo $syllabus["event_id"] . ": " . $event["EVENT_LONG_NAME"]; ?> 
              <span class="btn btn-outline btn-<?php echo $button_color[$syllabus["academic_session"]]; ?>">
                <?php echo $syllabus["section"];?>
              </span>
            <?php } else { ?>
              <?php echo $syllabus["templatename"]; ?> 
            <?php } ?>
          </h2>
          <?php $headers = getHeadersBySyllabus($syllabus_id);  ?>
          <?php $max_groups = getMaxHeaderGroups($syllabus_id);?>
          
          <div class="btn-group">
            <a href="syllabusaddheader.php?id=<?php echo $syllabus_id;?>" class="btn btn-<?php echo $button_color[$syllabus["academic_session"]];?>">
                Add New Header
            </a>
            <?php if($headers->num_rows > 0){?>
            <a href="syllabusview.php?id=<?php echo $syllabus_id;?>" class="btn btn-<?php echo $button_color[$syllabus["academic_session"]];?>">
                Manage Content
            </a>
            <?php }?>
          </div>

          <div class="btn-group pull-right">
            <a href="syllabusaddinrep.php?to=<?php echo $syllabus_id;?>" class="btn btn-default">
                <i class="fa fa-copy"></i> Inherit / Replicate From
            </a>
          </div>
          <br/><br/>
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th class="text-center">&nbsp;</th>
                  <th class="text-center">Index</th>
                  <th>Header</th>
                  <th>Content Type</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                
                
                <?php foreach($headers as $header) {  ?>
                  <?php $header_type = ($header["group_id"] == $header["id"]) ? "group" : "child"; ?>
                  <tr <?php echo $header_type == "group" ? "class='warning'" : ""; ?>>
                    
                    <td class="text-center">                       
                      <?php if($header_type == "group") {?>                         
                      <div class="btn-group">
                        <a href="syllabusmoveheader.php?id=<?php echo  $header["id"];?>&syllabusid=<?php echo $header["syllabus_id"];?>&type=<?php echo $header_type; ?>&direction=up" class="btn btn-default btn-sm <?php echo $header["display_index"] == 1 ? "disabled" : "";?>">
                          <i class="fa fa-arrow-up"></i>
                        </a>
                        <a href="syllabusmoveheader.php?id=<?php echo  $header["id"];?>&syllabusid=<?php echo $header["syllabus_id"];?>&type=<?php echo $header_type; ?>&direction=down" class="btn btn-default btn-sm <?php echo $header["display_index"] == $max_groups ? "disabled" : "";?>">
                          <i class="fa fa-arrow-down"></i>
                        </a>
                      </div>
                      <?php } ?>
                    </td>

                    <td class="text-center">
                      <?php
                      $max_childs = getMaxHeaderChild($syllabus_id, $header["group_id"]);
                      if($header_type == "group") {
                        echo padString($header["display_index"], 2) . ". " ;
                      } else {
                        ?>
                        <div class="btn-group">
                          
                          <a href="syllabusmoveheader.php?id=<?php echo  $header["id"];?>&syllabusid=<?php echo $header["syllabus_id"];?>&type=<?php echo $header_type; ?>&direction=up" class="btn btn-default btn-circle btn-sm <?php echo $header["child_index"] == 1 ? "disabled" : "";?>">
                            <i class="fa fa-angle-double-up"></i>
                          </a>
                          <a href="syllabusmoveheader.php?id=<?php echo  $header["id"];?>&syllabusid=<?php echo $header["syllabus_id"];?>&type=<?php echo $header_type; ?>&direction=down" class="btn btn-default btn-circle btn-sm <?php echo $header["child_index"] == $max_childs ? "disabled" : "";?>">
                            <i class="fa fa-angle-double-down"></i>
                          </a>
                        </div>
                      <?php } ?>
                    </td>  
                    <td>    
                      <?php if($header_type == "group") {?>
                        <i class="<?php echo $header["icon"];?>"></i>
                        <?php echo $header["header"]; ?>
                      <?php } else { ?>
                        <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- " . $header["header"]; ?>
                      <?php } ?>
                    </td>
                    
                    <td>
                      <?php echo $header["var_content_type"]; ?> <i class="<?php echo $header["var_img"];?>"></i>
                    </td>


                    <td class="text-center">  
                      
                      <div class="btn-group">
                        <?php if($header["action"] != "i"){?>
                          <a href="syllabusaddheader.php?id=<?php echo $syllabus_id;?>&header_id=<?php echo $header["id"];?>" class="btn btn-default btn-sm">
                              <i class="fa fa-edit"></i>
                          </a>
                        <?php } else {?>

                            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="left" title="Inherited From: <?php echo getInheritance($header["action_id"]);?>">
                                <i class="fa fa-lock"></i>
                            </button>


                        <?php }?>
                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal<?php echo $header["id"];?>">
                          <i class="fa fa-times"></i>
                        </button> 
                        
                        <div class="modal fade text-left" id="myModal<?php echo $header["id"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel"><button type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button> Delete Header?</h4>
                              </div>
                              <div class="modal-body alert alert-danger">
                                <?php echo ($header_type == "group" and $max_childs > 0) ? "<div class='alert alert-warning'><i class='glyphicon glyphicon-alert'></i>&nbsp;&nbsp;&nbsp;All child headers will also be deleted. </div>" : ""; ?>
                                Are you sure you want to delete &quot;<?php echo $header["header"];?> &quot;?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <a href="syllabusdeleteheader.php?id=<?php echo  $header["id"];?>&syllabusid=<?php echo $header["syllabus_id"];?>&type=<?php echo $header_type; ?>" class="btn btn-danger">Delete</a>
                              </div>
                            </div><!-- /.modal-content -->
                          </div> <!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                      </div>
                      
                    </td>
                  </tr>
                <?php } ?>
                <?php if($headers->num_rows == 0){?>
                  <tr>
                    <td colspan = "7" class="text-center">No headers found.</td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div> <!-- /.table-responsive -->
        </div> <!-- /. panel-body -->
      </div>
    </div>
  </div>
  

</div> <!-- /.page-wrapper -->

<?php include("footer.php"); ?>