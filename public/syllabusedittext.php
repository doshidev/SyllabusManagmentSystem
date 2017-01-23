<?php $page_name = "Manage Content" ?>
<?php include("head.php"); ?>
<div id="wrapper">
  <!-- Navigation -->
  <?php require 'nav.php';?>
</div>

<!-- Check parameters -->
<?php
	//Check form parameters
	$check_params = checkFormParams(array("id", "action", "syllabus_id", "content"));
	if($check_params["cnt"] == 4){
		updateById("syllabi_type_text", $check_params["id"], array("content" => "{$check_params["content"]}"));
		redirectTo("syllabusview.php?id={$check_params["syllabus_id"]}");
	}

  //Check query parameters
  $query_params = checkQueryParams(array("id", "syllabus_id"));
  if(isset($query_params["id"])){
    $syllabus_id = $query_params["id"];
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
      <li>Manage Content</li>
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
				          <?php $content = getById("syllabi_type_text", "id", $query_params["id"]); ?>
									<textarea name="content" id="content" class="form-control" rows="3"><?php echo $content["content"]; ?></textarea>
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
  $('#content').summernote();
});


function submitForm(){
  document.forms["syllabusform"].action = "syllabusedittext.php";
  document.forms["syllabusform"].submit();
}


</script>