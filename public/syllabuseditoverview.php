<?php $page_name = "Manage Overview Content" ?>
<?php include("head.php"); ?>
<div id="wrapper">
  <!-- Navigation -->
  <?php require 'nav.php';?>
</div>

<!-- Check parameters -->
<?php
	//Check form parameters
	$check_params = checkFormParams(array("id", "action", "syllabus_id", "pretext", "posttext", "class_schedule", "prerequisite", "cancellation_number", "faculty_name", "faculty_email", "office_hours", "office_location", "office_phone", "faculty_phone"));
	if(isset($check_params["action"]) && $check_params["action"] == "update"){
    $update_params = array(
      "class_schedule" => $check_params["class_schedule"],
      "prerequisite" => $check_params["prerequisite"],
      "cancellation_number" => $check_params["cancellation_number"],
      "faculty_name" => $check_params["faculty_name"],
      "faculty_email" => $check_params["faculty_email"],
      "office_hours" => $check_params["office_hours"],
      "office_location"  => $check_params["office_location"],
      "office_phone"  => $check_params["office_phone"],
      "faculty_phone"  => $check_params["faculty_phone"],
      "pretext"  => $check_params["pretext"],
      "posttext" => $check_params["posttext"]
    );
    updateById("syllabi_type_overview", $check_params["id"], $update_params);
		redirectTo("syllabusview.php?id={$check_params["syllabus_id"]}");
	}

  //Check query parameters
  $query_params = checkQueryParams(array("id", "syllabus_id"));
  if(isset($query_params["id"])){
    $syllabus_id = $query_params["id"];
    $content = getById("syllabi_type_overview", "id", $query_params["id"]);
    $class_schedule = $content["class_schedule"];
    $prerequisite = $content["prerequisite"];
    $cancellation_number = $content["cancellation_number"];
    $faculty_name = $content["faculty_name"];
    $faculty_email = $content["faculty_email"];
    $office_hours = $content["office_hours"];
    $office_location = $content["office_location"];
    $office_phone = $content["office_phone"];
    $faculty_phone = $content["faculty_phone"];
    $pretext = $content["pretext"];
    $posttext = $content["posttext"];

  } else {
    redirectTo("syllabusmanage.php");  
  }
  
?>

<div id="page-wrapper">
	<div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><?php echo $page_name?></h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->	

  <div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
      <li><a href="myhome.php">Home</a></li>
      <li>Manage Overview Content</li>
      </ol>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">

				  <div class="row">
				    <div class="col-lg-12">
				      <form role="form" method="post" name="syllabusform" id="syllabusform">
				      	
				      	<input class="form-control hidden" name="id" id="id" value="<?php echo $query_params["id"]; ?>">
				      	<input class="form-control hidden" name="syllabus_id" id="syllabus_id" value="<?php echo $query_params["syllabus_id"]; ?>">
				      	<input class="form-control hidden" name="action" id="action" value="update">

				      	<div class="form-group">  
									<label>Pre Text</label>
                  <textarea name="pretext" id="pretext" class="form-control" rows="3"><?php echo $pretext; ?></textarea>
				        </div>

             
                <div class="form-group input-group hidden">
                  <span class="input-group-addon">Class Schedule</span>
                  <input type="hidden" name="class_schedule" id="class_schedule" class="form-control" value="<?php echo $class_schedule; ?>">
                </div>

                <div class="form-group">  
                  <label>Prerequisite</label>
                  <textarea name="prerequisite" id="prerequisite" class="form-control" rows="3"><?php echo $prerequisite; ?></textarea>
                </div>

                <div class="form-group input-group">
                  <span class="input-group-addon">Cancellation #</span>
                  <input type="text" name="cancellation_number" id="cancellation_number" class="form-control" value="<?php echo $cancellation_number; ?>">
                </div>

                <div class="form-group input-group hidden">
                  <span class="input-group-addon">Faculty Name</span>
                  <input type="hidden" name="faculty_name" id="faculty_name" class="form-control" value="<?php echo $faculty_name; ?>">
                </div>

                <div class="form-group input-group hidden">
                  <span class="input-group-addon">Faculty Email</span>
                  <input type="hidden" name="faculty_email" id="faculty_email" class="form-control" value="<?php echo $faculty_email; ?>">
                </div>

                <div class="form-group input-group">
                  <span class="input-group-addon">Office Hours</span>
                  <input type="text" name="office_hours" id="office_hours" class="form-control" value="<?php echo $office_hours; ?>">
                </div>

                <div class="form-group input-group">
                  <span class="input-group-addon">Office Location</span>
                  <input type="text" name="office_location" id="office_location" class="form-control" value="<?php echo $office_location; ?>">
                </div>

                <div class="form-group input-group">
                  <span class="input-group-addon">Office Phone</span>
                  <input type="text" name="office_phone" id="office_phone" class="form-control" value="<?php echo $office_phone; ?>">
                </div>

                <div class="form-group input-group">
                  <span class="input-group-addon">Faculty Phone</span>
                  <input type="text" name="faculty_phone" id="faculty_phone" class="form-control" value="<?php echo $faculty_phone; ?>">
                </div>


                <div class="form-group">
                  <label>Post Text</label>
                  <textarea name="posttext" id="posttext" class="form-control" rows="3"><?php echo $posttext; ?></textarea>
                </div>

				        <a href="javascript:submitForm();" class="btn btn-default">Submit</a>
								<button type="cancel" class="btn btn-default">Cancel</button>

							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

</div> <!-- /.page-wrapper -->



<?php include("footer.php"); ?>


<script type="text/javascript">
$(document).ready(function() {
  $('#pretext').summernote();
  $('#posttext').summernote();
  $('#prerequisite').summernote();
});


function submitForm(){
  document.forms["syllabusform"].action = "syllabuseditoverview.php";
  document.forms["syllabusform"].submit();
}


</script>