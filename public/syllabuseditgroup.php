<?php $page_name = "Manage Group Content" ?>
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
	$check_params = checkFormParams(array("id", "action", "syllabus_id", "type", "cols", "pretext", "posttext"));

	if(isset($check_params["action"]) && $check_params["action"] == "update"){
		$update_params = array(
      "type" => $check_params["type"],
      "pretext"  => $check_params["pretext"],
      "posttext" => $check_params["posttext"],
      "cols" => $check_params["cols"]
    );
    updateById("syllabi_type_group", $check_params["id"], $update_params);
		redirectTo("syllabusview.php?id={$check_params["syllabus_id"]}");
	} 

  //Check query parameters
  $query_params = checkQueryParams(array("id", "syllabus_id"));
  if(isset($query_params["id"])){
    $syllabus_id = $query_params["syllabus_id"];
    $content = getById("syllabi_type_group", "id", $query_params["id"]);
    $type = $content["type"];
    $pretext = $content["pretext"];
    $posttext = $content["posttext"];
    $cols = $content["cols"];

  } else {
    redirectTo("syllabusmanage.php");  
  }

  if(!isset($cols)) {
    $cols = 1;
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
                  <label>Group Type</label>
                  <select name="type" id="type" class="form-control" onchange>
                    <option value="panel" <?php echo ($type == "panel") ? "selected" : null;?>>Panel</option>
                    <option value="accordian" <?php echo ($type == "accordian") ? "selected" : null;?>>Collapsible Accordian Panel</option>
                    <option value="tabs" <?php echo ($type == "tabs") ? "selected" : null;?>>Tabs</option>
                    <option value="well" <?php echo ($type == "well") ? "selected" : null;?>>Well</option>
                  </select>
                </div>

                <div id="colsdiv" class="form-group <?php echo ($type == "panel" or $type == "well") ? null : "hidden" ?>">
                  <label>Columns</label>
                  <select name="cols" id="cols" class="form-control" onchange>
                    <option value="1" <?php echo ($cols == "1") ? "selected" : null;?>>1</option>
                    <option value="2" <?php echo ($cols == "2") ? "selected" : null;?>>2</option>
                    <option value="3" <?php echo ($cols == "3") ? "selected" : null;?>>3</option>
                    <option value="4" <?php echo ($cols == "4") ? "selected" : null;?>>4</option>
                    <option value="6" <?php echo ($cols == "6") ? "selected" : null;?>>6</option>
                  </select>
                </div>
                
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th class="text-center">&nbsp;</th>
                        <th class="text-center">Index</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th class="text-center">
                          <a href="javascript:EditDetail(0, <?php echo $content["id"]; ?>, <?php echo $query_params["syllabus_id"]; ?>);" class="btn btn-default btn-xs">
                            <i class="fa fa-plus"></i> Add
                          </a>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php $groupdetails = getAll("syllabi_type_groupdetails", array("groupid"=>$content["id"]), "display_index", "asc");?>
                      <?php $max_records = getMaxGroup($content["id"]); ?>

                      <?php foreach($groupdetails as $group) {  ?>
                        <tr>
                          
                          <td class="text-center" style="width:65px;">  
                            <!-- Action Buttons -->
                              <div class="btn-group">
                                <a href="syllabusmovegroupdetails.php?id=<?php echo $group["id"];?>&syllabusid=<?php echo $syllabus_id;?>&groupid=<?php echo $content["id"]; ?>&direction=up" class="btn btn-default btn-xs <?php echo $group["display_index"] == 1 ? "disabled" : null;?>">
                                  <i class="fa fa-arrow-up"></i>
                                </a>
                                <a href="syllabusmovegroupdetails.php?id=<?php echo $group["id"];?>&syllabusid=<?php echo $syllabus_id;?>&groupid=<?php echo $content["id"]; ?>&direction=down" class="btn btn-default btn-xs <?php echo $group["display_index"] == $max_records ? "disabled" : "";?>">
                                  <i class="fa fa-arrow-down"></i>
                                </a>
                              </div>
                          </td>

                          <td class="text-center">
                            <?php echo padString($group["display_index"], 2) . ". " ?>
                          </td>  
                          <td class="wrap">    
                            <?php
                            if(strlen($group["title"]) > 50) {
                              echo substr($group["title"], 0,50) . "...";
                            } else {
                              echo $group["title"];
                            } 
                            ?>
                          </td>
                          
                          <td>
                            <?php
                            if(strlen($group["content"]) > 150) {
                              echo substr($group["content"], 0,150) . "..."; 
                            } else {
                              echo $group["content"];
                            } 
                            ?>
                          </td>


                          <td class="text-center" style="width:65px;">  
                            <!-- Action Buttons -->
                              <div class="btn-group">
                                <a href="javascript:EditDetail(<?php echo $group["id"]; ?>, <?php echo $content["id"]; ?>, <?php echo $query_params["syllabus_id"]; ?>);" class="btn btn-default btn-xs">
                                  <i class="fa fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal<?php echo $group["id"];?>">
                                  <i class="fa fa-times"></i>
                                </button> 

                                
                                <div class="modal fade text-left" id="myModal<?php echo $group["id"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel"><button type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button> Delete Timeline Detail?</h4>
                                      </div>
                                      <div class="modal-body alert alert-danger">                                              
                                        Are you sure you want to delete &quot;<?php echo $group["title"];?> &quot;?
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <a href="syllabusdeletegroupdetails.php?id=<?php echo $group["id"];?>&syllabusid=<?php echo $query_params["syllabus_id"];?>&groupid=<?php echo $query_params["id"]; ?>" class="btn btn-danger">Delete</a>
                                      </div>
                                    </div><!-- /.modal-content -->
                                  </div> <!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                              </div>
                          </td>
                        </tr>
                      <?php } ?>
                      <?php if($groupdetails->num_rows == 0){?>
                        <tr>
                          <td colspan = "7" class="text-center">No headers found.</td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div> <!-- /.table-responsive -->


                <iframe name="displaygroup" id="displaygroup" style="border:none; height:5px; width:100%" scrolling="no" src="syllabuseditgroupdisplay.php?id=<?php echo $query_params["id"];?>&syllabus_id=<?php echo $query_params["syllabus_id"];?>&type=<?php echo $type;?>&cols=<?php echo $cols;?>"></iframe>
                <!-- Details -->
              
                <!-- modal -->
                <div class="modal fade text-left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-body">
                        <iframe name="groupadd" id="groupadd" width="100%" height="100%" src="syllabuseditgroupadd.php?id=0&timelineid=<?php echo $content["id"]; ?>"></iframe>
                      </div>
                      <div class="modal-footer">
                        <a href="javascript:window.frames['groupadd'].submitForm();" class="btn btn-default">Submit</a>
                        <button type="button" class="btn btn-default" id="modalclose" data-dismiss="modal">Close</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div> <!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <br/>
                
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
  
  $('#type').change(function(){
       changeType();
    });

  $('#cols').change(function(){
       changeType();
    });

});


function changeType(){
  cols = document.getElementById("cols").value;
  type = document.getElementById("type").value;
  id = document.getElementById("id").value;
  syllabus_id = document.getElementById("syllabus_id").value;

  if(type =="well" || type == "panel") {
    document.getElementById("colsdiv").className = "form-group";
  } else {
    document.getElementById("colsdiv").className = "form-group hidden";
  }

  document.getElementById("displaygroup").src = "syllabuseditgroupdisplay.php?id=" + id + "&syllabus_id=" + syllabus_id + "&type=" + type + "&cols=" + cols;
}

function submitForm(){
  var formerrors = "";
  
  document.forms["syllabusform"].action = "syllabuseditgroup.php";
  document.forms["syllabusform"].submit();

}

function EditDetail(id, groupid, syllabus_id){
  document.getElementById("groupadd").src = "syllabuseditgroupadd.php?id=" + id + "&groupid=" + groupid +"&syllabus_id=" + syllabus_id;
  $('#myModal').modal('show');

}

function refreshGroup(groupid, syllabus_id, id){
  $('#myModal').modal('hide');
  window.location.assign("syllabuseditgroup.php?id=" + groupid + "&syllabus_id=" + syllabus_id);
}


$(function(){
    
  var iFrames = $('iframe');
  function iResize() {

    // for (var i = 0, j = iFrames.length; i < j; i++) {
      document.getElementById('displaygroup').style.height = (20 + document.getElementById('displaygroup').contentWindow.document.body.offsetHeight) + 'px';}
    //}
  
    iFrames.load(function() { 
        document.getElementById('displaygroup').style.height =  (document.getElementById('displaygroup').contentWindow.document.body.offsetHeight + 20)  + 'px';
    });
  
  
  });

</script>