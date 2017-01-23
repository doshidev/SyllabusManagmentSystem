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
  $query_params = checkQueryParams(array("id","header_id"));
  if($query_params["cnt"] == 2){
    $header_id = $query_params["header_id"];
    $syllabus_id = $query_params["id"];
    $action = "Update";
  } elseif($query_params["cnt"] == 1 && isset($query_params["id"])) {
    $syllabus_id = $query_params["id"];
    $header_id = 0;
    $action = "Add";
  } else {
    redirectTo("syllabusmanage.php");  
  }

  if($action == "Update"){
    $header_record = getById("syllabi_syllabus_header", "id", $header_id);
    $icon = $header_record["icon"];
    $header = $header_record["header"];
    $description = $header_record["description"];
    $type_id = $header_record["type_id"];
    $group_id = ($header_record["group_id"] == $header_record["id"]) ? "self" : $header_record["group_id"];
    $faculty = $header_record["faculty"];
  } else {
    $icon = "fa fa-arrow-circle-right";
    $header = null;
    $description = null;
    $type_id = 0;
    $group_id = "self";
    $faculty = "no";
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
  <?php $event = getVwById("VWSyllabi_event", "EVENT_ID", $syllabus["event_id"]);?>
  <?php $department = getVwById("VWSyllabi_CODE_DEPARTMENT", "CODE_VALUE", $event["DEPARTMENT"]);?>
  <?php $school = getVwById("VWSyllabi_organization", "ORG_CODE_ID", $syllabus["org_code_id"]);?>
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
          <a href="syllabusmanage.php?year_current=<?php echo $syllabus["academic_year"];?>" class="btn btn-outline btn-<?php echo $button_color[$syllabus["academic_session"]];?>"><?php echo $syllabus["academic_year"];?></a>
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
          <h2><?php echo $action; ?> Header</h2>
          <?php $headers = getHeadersBySyllabus($syllabus_id);  ?>
          <?php $max_groups = getMaxHeaderGroups($syllabus_id);?>
          
          
          <br/>
          <div class="row">
            <div class="col-lg-12">
              <form role="form" method="post" name="syllabusheader" id="syllabusheader">
                  
                  <div id="errors">
                  </div>

                  <input class="form-control hidden" name="header_id" id="header_id" value="<?php echo $header_id; ?>">
                  <input class="form-control hidden" name="syllabus_id" id="syllabus_id" value="<?php echo $syllabus_id; ?>">
                  <input class="form-control hidden" name="formaction" id="formaction" value="<?php echo $action; ?>">

                  <div id="headerdiv" name="headerdiv" class="form-group <?php echo ($header == "") ? "has-error" : "";?>">
                    <label>Header</label>
                    <input type="text" class="form-control" name="header" id="header" value="<?php echo $header; ?>" placeholder="Enter Header" required>
                  </div>

                  <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3"><?php echo $description; ?></textarea>
                  </div> 

                  <div class="form-group">
                    <label>Header Group</label>
                    <?php $h_group = getAll("syllabi_syllabus_header", array("syllabus_id" => "{$syllabus_id}", "type_id" => "7"), "header", "asc");?>
                    <select name="group_id" id="group_id" class="form-control" onchange>
                        <option value="self">Self</option>
                        <?php foreach($h_group as $header_groups){ ?>
                          <option value="<?php echo $header_groups["id"]; ?>" <?php echo ($group_id == $header_groups["id"]) ? "selected" : null; ?>><?php echo $header_groups["header"]; ?></option>
                        <?php } ?>
                    </select>
                  </div>

                  <div id="type_iddiv" name="type_iddiv" class="form-group">
                    <label>Header Type</label><br/>
                    <input class="form-control hidden" name="type_id" id="type_id" value="<?php echo $type_id; ?>">
                    

                    <div class="panel-group">
                        <div class="panel panel-default">
                          <div class="panel-body">
                            
                            <?php $c_type = getAll("syllabi_content_types", null, "var_content_type", "asc");?>
            
                            <?php foreach($c_type as $content_type){ ?>
                              <?php if($group_id != "self" && $content_type["id"] == "7") {?>
                              <?php } else {?>
                                
                                  <a id="type_id<?php echo $content_type["id"]; ?>" class="btn btn-<?php echo ($type_id == $content_type["id"]) ? "success" : "default"; ?>" href="javascript:changeType('<?php echo $content_type["id"];?>');">
                                      <span class="<?php echo $content_type["var_img"]; ?>" aria-hidden="true"></span>
                                      <?php echo $content_type["var_content_type"]; ?>
                                  </a>
                                
                              <?php } ?>
                            <?php } ?>
                              
                            
                          </div> <!-- /.panel-body -->                          
                        </div><!-- /.panel --> 
                      

                    </div><!-- /.panel-group --> 
                  </div>

                 

                  <div id="icondiv" name="icondiv" class="form-group <?php echo ($group_id == "self") ? null : "hidden" ; ?>">
                    <label>Icon for Header</label>
                    <input class="form-control hidden" name="icon" id="icon" value="<?php echo $icon; ?>">
                    

                    <div class="panel-group" id="accordion">
                      
                        <div class="panel panel-default">
                          <div class="panel-heading">
                                <h4 class="panel-title">
                                  <span id="displayicon"><i style="font-size: 40px" class="<?php echo $icon; ?> img-thumbnail"></i></span>
                                  <a data-toggle="collapse" data-parent="#accordion" href="#showtable">Select Icons</a>
                                </h4>
                            
                          </div>

                          
                            <div id="showtable" class="panel-collapse collapse">
                              <div class="panel-body">
                                <div class="listicons">
                                  <ul class="bs-glyphicons-list"> 
                                    <?php $allicons=getAll("syllabi_icons", null, null, null); ?>    
                                    <?php foreach($allicons as $icon_list){ ?>    
                                      <a href="javascript:changeText('fa <?php echo $icon_list["icon"]?>');" class="text-<?php echo $button_color[$syllabus["academic_session"]];?>">
                                      <li>
                                        <span class="fa <?php echo $icon_list["icon"]?>" aria-hidden="true"></span>
                                      </li>
                                    </a>
                                    <?php } ?>  
                                  </ul>
                                </div>
                              </div>
                            </div>
                          
                        </div>
                      

                    </div><!-- /.panel-group --> 
                  </div>
                  
                  <div id="facultydiv" name="facultydiv" class="form-group" <?php echo ($type_id ==7) ? "style='display:none'" : null ?>>
                    <label>Allow Faculty to Edit?</label>
                    <select name="faculty" id="faculty" class="form-control">
                      <option value="no" <?php echo ($faculty == "no") ? "selected" : null; ?>>No</option>
                      <option value="yes" <?php echo ($faculty == "yes") ? "selected" : null; ?>>Yes</option>
                    </select>
                  </div>
                                 

                  
                  
                  <a href="javascript:submitForm();" class="btn btn-default">Submit</a>
                  <button type="cancel" class="btn btn-default">Cancel</button>
              </form>
          </div>
          <!-- /.col-lg-12 (nested) -->
          </div> <!-- /.row -->
        </div> <!-- /. panel-body -->
      </div>
    </div>
  </div>
  

</div> <!-- /.page-wrapper -->

<?php include("footer.php"); ?>

<script>
  function changeText(icon){
    document.getElementById('icon').value = icon;
    document.getElementById('displayicon').innerHTML = "<i class='" + icon + " img-thumbnail' style='font-size: 40px'></i>";
     $('#showtable').collapse('hide');
  }

  function changeType(newtype){
    currenttype = document.getElementById("type_id").value;
    if(currenttype != 0){
      document.getElementById("type_id"+currenttype).className = "btn btn-default";

    }  
    document.getElementById("type_id").value = newtype;
    document.getElementById("type_id"+newtype).className = "btn btn-success";
    
    if (newtype == 7) {
      document.getElementById("facultydiv").style.display = "none";
    } else {
      document.getElementById("facultydiv").style.display = "block";
    }

  }

  function submitForm(){
    var formerrors = "";
    if(document.getElementById("type_id").value == "" || document.getElementById("type_id").value == null || document.getElementById("type_id").value == 0) {
      formerrors += "Select Header Type. <br/>"
    }
    if(document.getElementById("header").value == "" || document.getElementById("header").value == null) {
      formerrors += "Enter Header. <br/>"
    }

    if (formerrors == "" || formerrors == null) {
      document.forms["syllabusheader"].action = "syllabusupdateheader.php";
      document.forms["syllabusheader"].submit();
    } else {
      document.getElementById("errors").innerHTML = formerrors;
      document.getElementById("errors").className="alert alert-danger";
    }

  }

  $(document).ready(function(){
  

    $('#group_id').change(function(){
      if(document.getElementById("group_id").value != "self"){
        document.getElementById("icon").value = null;
        document.getElementById("icondiv").style.display = "none";
        document.getElementById("type_id7").className = "btn btn-default disabled";
        if(document.getElementById("type_id").value == 7){
          document.getElementById("type_id").value = 0;
        }
      } else {
        document.getElementById("icon").value = "glyphicon glyphicon-circle-arrow-right";
        document.getElementById("icondiv").style.display = "block";
        document.getElementById("type_id7").className = "btn btn-default";
        $('#showtable').collapse('hide');
      }

    });

    $('#header').blur(function(){
      if(document.getElementById("header").value != ""){
        document.getElementById("headerdiv").className = "form-group has-success";
      } else {
        document.getElementById("headerdiv").className = "form-group has-error";
      }
    });

    $('#description').summernote();
  });


</script>