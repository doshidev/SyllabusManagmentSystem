<?php $page_name = "Inherit / Replicate Source" ?>
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
	
  $query_params = checkQueryParams(array("year", "term", "session", "department", "organization", "event", "section", "school", "id", "type", "to"));
  // $syllabus_id = 172;
  
  
	?>
	<?php $to = getAutoReplicate()["id"];?>
  <?php $syllabus_id = getAutoReplicate()["autoreplicatefrom"];?>

  <div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
      <li><a href="myhome.php">Home</a></li>
      <li>Inherit / Replication Source to <?php echo $to; ?></li>
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
          
          <br/>
          <div class="table-responsive">
            <form role="form" method="post" name="syllabusinrep" id="syllabusinrep">
              <input class="form-control hidden" name="id" id="id" value="<?php echo $syllabus_id; ?>">
              <input class="form-control hidden" name="to" id="to" value="<?php echo $to; ?>">
              
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
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
                        <?php
                        $max_childs = getMaxHeaderChild($syllabus_id, $header["group_id"]);
                        if($header_type == "group") {
                          echo padString($header["display_index"], 2) . ". " ;
                        } ?>
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
                        <?php if($header_type == "group") {?>
                        <select class="form-control" name="action<?php echo $header["id"]?>" id=
                          action<?php echo $header["id"]?>>
                          <?php
                            if($header["header"] == "Instructional Methods and Assignments" || $header["header"] == "Credits & Grading" || $header["header"] == "Learning Resource Center (LRC)" || $header["header"] == "Policies & Procedures"){
                                echo "<option value='i'>Inherit</option>";
                            } else {
                                echo "<option value='r'>Replicate</option>";
                            }
                          ?>
                        </select>
                        <?php } ?>
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
            </form>
          </div> <!-- /.table-responsive -->
        </div> <!-- /. panel-body -->
        <div class="panel-footer text-right">
          <a href="javascript:submitForm();" class="btn btn-danger">Inherit / Replicate</a>
        </div> <!-- /. panel-footer --> 
      </div>
    </div>
  </div>
  

</div> <!-- /.page-wrapper -->

<?php include("footer.php"); ?>




<script>
     document.forms["syllabusinrep"].action = "autosyllabusupdateinrep.php?id=172&to=<?php echo $to?>";
     document.forms["syllabusinrep"].submit();
  
</script>