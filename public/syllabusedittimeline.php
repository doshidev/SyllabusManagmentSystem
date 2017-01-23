<?php $page_name = "Manage Timeline Content" ?>
<?php include("head.php"); ?>

<style type="text/css">
@media screen and (min-width: 768px) {
  #myModal .modal-dialog  {width:800px;}
  #myModal .modal-body {height: 600px; }
}

#myModal .modal-dialog  {width:75%;}
</style>

<div id="wrapper">
  <!-- Navigation -->
  <?php require 'nav.php';?>
</div>

<!-- Check parameters -->
<?php
	//Check form parameters
	$check_params = checkFormParams(array("id", "action", "syllabus_id", "title", "pretext", "posttext"));

	if(isset($check_params["action"]) && $check_params["action"] == "update"){
		$update_params = array(
      "title" => $check_params["title"],
      "pretext"  => $check_params["pretext"],
      "posttext" => $check_params["posttext"]
    );
    updateById("syllabi_type_timeline", $check_params["id"], $update_params);
		redirectTo("syllabusview.php?id={$check_params["syllabus_id"]}");
	} 

  //Check query parameters
  $query_params = checkQueryParams(array("id", "syllabus_id"));
  if(isset($query_params["id"])){
    $syllabus_id = $query_params["syllabus_id"];
    $content = getById("syllabi_type_timeline", "id", $query_params["id"]);
    $title = $content["title"];
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
				      	<div id="errors">
                </div>

				      	<input class="form-control hidden" name="id" id="id" value="<?php echo $query_params["id"]; ?>">
				      	<input class="form-control hidden" name="syllabus_id" id="syllabus_id" value="<?php echo $query_params["syllabus_id"]; ?>">
				      	<input class="form-control hidden" name="action" id="action" value="update">

                <div class="form-group">
                  <label>Pre Text</label>
                  <textarea name="pretext" id="pretext" class="form-control" rows="3"><?php echo $content["pretext"]; ?></textarea>
                </div>

                <div class="form-group">
                  <label>Timeline Title</label>
                  <input type="text" class="form-control" name="title" id="title" value="<?php echo $title; ?>" placeholder="Enter Timeline Title">
                </div>
                
                <div class="panel panel-default">
                  <div class="panel-heading" style="height:50px;">
                      <i class="fa fa-clock-o fa-fw"></i> <span id = "titlespan"><?php echo $content["title"] ?></span>
                      <div class="btn-group pull-right">
                      
                      <a href="javascript:EditDetail(0, <?php echo $content["id"]; ?>, <?php echo $query_params["syllabus_id"]; ?>);" type="button" class="btn btn-sm btn-default">
                        <i class="fa fa-plus"></i>
                      </a>
                      </div>
                  </div>
                  <!-- /.panel-heading -->
                  <div class="panel-body">
                     <div class="alert alert-warning alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      All unsaved changes to the form will be lost on any actions taken (add, edit, delete or change of order) for the timeline content below.
                    </div>
                    <ul class="timeline">
                      <?php $cnt = 0;
                      $max_records = getMaxTimeline($content["id"]);
                      ?>
                      <?php $timelinedetails = getAll("syllabi_type_timelinedetails", array("timelineid"=>$content["id"]), "display_index", "asc");?>
                      <?php foreach($timelinedetails as $timeline){ ?>
                        <?php $cnt++; ?>
                        <li <?php echo ($cnt % 2 == 0) ? "class='timeline-inverted'" : "" ?>  id="t<?php echo $timeline["id"] ;?>">
                            <div class="timeline-badge <?php echo ($timeline["badgecolor"] != "stadard") ? $timeline["badgecolor"] : "" ?>">
                              <?php echo ($timeline["icon"] == "number") ? $cnt : "<i class='{$timeline["icon"]}'></i>" ?>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <div class="btn-group pull-right">
                                      <a href="syllabusmovetimelinedetails.php?id=<?php echo $timeline["id"];?>&syllabusid=<?php echo $syllabus_id;?>&timelineid=<?php echo $content["id"]; ?>&direction=up" class="btn btn-default btn-sm <?php echo $timeline["display_index"] == 1 ? "disabled" : "";?>">
                                        <i class="fa fa-arrow-up"></i>
                                      </a>
                                      <a href="syllabusmovetimelinedetails.php?id=<?php echo $timeline["id"];?>&syllabusid=<?php echo $syllabus_id;?>&timelineid=<?php echo $content["id"]; ?>&direction=down" class="btn btn-default btn-sm <?php echo $timeline["display_index"] == $max_records ? "disabled" : "";?>">
                                        <i class="fa fa-arrow-down"></i>
                                      </a>
                                      <a href="javascript:EditDetail(<?php echo $timeline["id"]; ?>, <?php echo $content["id"]; ?>, <?php echo $query_params["syllabus_id"]; ?>);" class="btn btn-default btn-sm">
                                        <i class="fa fa-edit"></i>
                                      </a>
                                      <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal<?php echo $timeline["id"];?>">
                                        <i class="fa fa-times"></i>
                                      </button> 

                                      
                                      <div class="modal fade text-left" id="myModal<?php echo $timeline["id"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                              <h4 class="modal-title" id="myModalLabel"><button type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button> Delete Timeline Detail?</h4>
                                            </div>
                                            <div class="modal-body alert alert-danger">                                              
                                              Are you sure you want to delete &quot;<?php echo $timeline["title"];?> &quot;?
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                              <a href="syllabusdeletetimelinedetails.php?id=<?php echo $timeline["id"];?>&syllabusid=<?php echo $query_params["syllabus_id"];?>&timelineid=<?php echo $query_params["id"]; ?>" class="btn btn-danger">Delete</a>
                                            </div>
                                          </div><!-- /.modal-content -->
                                        </div> <!-- /.modal-dialog -->
                                      </div><!-- /.modal -->

                                    </div>
                                    <h4 class="timeline-title"><?php echo $timeline["title"]; ?></h4>

                                </div>
                                <div class="timeline-body" style="width:100%; word-wrap: break-word; overflow-wrap: break-word; overflow:auto">
                                    <br/>
                                    <?php echo $timeline["content"]; ?>
                                </div>
                            </div>
                        </li>
                          
                      <?php } ?>
                    </ul>
                  </div>
                  <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
              
                <!-- modal -->
                <div class="modal fade text-left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-body">
                        <iframe name="timelineadd" id="timelineadd" width="100%" height="100%" src="syllabusedittimelineadd.php?id=0&timelineid=<?php echo $content["id"]; ?>"></iframe>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="modalclose" data-dismiss="modal">Close</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div> <!-- /.modal-dialog -->
                </div><!-- /.modal -->

                
                <div class="form-group">
                  <label>Post Text</label>
                  <textarea name="posttext" id="posttext" class="form-control" rows="10"><?php echo $content["posttext"]; ?></textarea>
                </div>

				        <a href="javascript:submitForm();" class="btn btn-default">Submit</a>
								<a href = "syllabusview.php?id=<?php echo $query_params["syllabus_id"]; ?>" type="cancel" class="btn btn-default">Cancel</a>

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
  
  $('#title').blur(function(){
    document.getElementById("titlespan").innerHTML = document.getElementById("title").value;
  });

});


function submitForm(){
  var formerrors = "";
  
  document.forms["syllabusform"].action = "syllabusedittimeline.php";
  document.forms["syllabusform"].submit();

}

function EditDetail(id, timelineid, syllabus_id){
  document.getElementById("timelineadd").src = "syllabusedittimelineadd.php?id=" + id + "&timelineid=" + timelineid +"&syllabus_id=" + syllabus_id;
  $('#myModal').modal('show');

}

function refreshTimeline(timelineid, syllabus_id, id){
  $('#myModal').modal('hide');
  window.location.assign("syllabusedittimeline.php?id=" + timelineid + "&syllabus_id=" + syllabus_id);
}

</script>