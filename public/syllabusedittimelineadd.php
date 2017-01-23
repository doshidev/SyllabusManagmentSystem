<?php $page_name = "Manage Content" ?>
<?php include("head.php"); ?>

<!-- Check parameters -->
<?php
	//Check form parameters for add / update
	$check_params = checkFormParams(array("id", "action", "timelineid", "syllabus_id", "title", "content", "icon", "badgecolor"));
	if($check_params["cnt"] > 4){
    // Insert New
    if($check_params["id"] == 0){
     $check_params["display_index"] = getMaxTimeline($check_params["timelineid"]) + 1;
     // Insert New Record
      $check_params["id"] = insertFields("syllabi_type_timelinedetails", array(
        "timelineid" => "{$check_params["timelineid"]}",
        "title" => "{$check_params["title"]}",
        "content" => "{$check_params["content"]}",
        "icon" => "{$check_params["icon"]}",
        "badgecolor" => "{$check_params["badgecolor"]}",
        "display_index" => "{$check_params["display_index"]}"
      ));

		} else {
      // Update Record
      updateById("syllabi_type_timelinedetails", $check_params["id"], array(
        "title" => "{$check_params["title"]}",
        "content" => "{$check_params["content"]}",
        "icon" => "{$check_params["icon"]}",
        "badgecolor" => "{$check_params["badgecolor"]}"
      ));

    }
    
    // $redirecturl = "syllabusedittimeline.php?id={$check_params["timelineid"]}&syllabus_id={$check_params["syllabus_id"]}";
    // echo $redirecturl;
    ?>

    <script type="text/javascript">
      parent.refreshTimeline(<?php echo $check_params["timelineid"]?>, <?php echo $check_params["syllabus_id"]?>, <?php echo $check_params["id"]?>);
    </script>

    <?php

	}

  //Check query parameters
  $query_params = checkQueryParams(array("id", "timelineid", "syllabus_id"));
  if(isset($query_params["id"])){
    $id = $query_params["id"];
  } else {
    //redirectTo("syllabusmanage.php");  
  }

  //If Id is not zero, fetch data
  if($id > 0){
    $timelines = getById("syllabi_type_timelinedetails", "id", $id);
    $title = $timelines["title"];
    $content = $timelines["content"];
    $icon = $timelines["icon"];
    $badgecolor = $timelines["badgecolor"];
  } else {
    $title = "";
    $content = "";
    $icon = "number";
    $badgecolor = "standard";
  }


?>

<div id="wrapper">
	<div class="col-lg-12">
    
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header"><?php echo $page_name?></h1>
          </div>
          <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->	

      
      
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-body">

    				  <div class="row">
    				    <div class="col-lg-12">
    				      <form role="form" method="post" name="syllabusform" id="syllabusform">
    				      	
    				      	<input class="form-control hidden" name="id" id="id" value="<?php echo $query_params["id"]; ?>" onBlur="javascript:checkTriger();">
    				      	<input class="form-control hidden" name="timelineid" id="timelineid" value="<?php echo $query_params["timelineid"]; ?>">
                    <input class="form-control hidden" name="syllabus_id" id="syllabus_id" value="<?php echo $query_params["syllabus_id"]; ?>">
    				      	<input class="form-control hidden" name="action" id="action" value="update">

    				      	<div class="form-group">
                      <label>Title</label>
                      <input class="form-control" name="title" id="title" value="<?php echo $title; ?>">
                    </div>

                    <div class="form-group">
    									<label>Content</label>
                      <textarea name="content" id="content" class="form-control" rows="3"><?php echo $content; ?></textarea>
    				        </div>

                    <div class="form-group">
                      <label>Badge Icon</label><br/>
                      <input class="form-control hidden" name="icon" id="icon" value="<?php echo $icon;?>">
                      <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                          <?php if($icon == "number") { ?>
                            <i id="iconcontainer" class="fa fa-sort-numeric-asc"></i>
                          <?php } else { ?>
                            <i id="iconcontainer" class="<?php echo $icon?>"></i>
                          <?php } ?>
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                          <li><a href="javascript:changeIcon('fa fa-sort-numeric-asc');"> <i class="fa fa-sort-numeric-asc"></i> Dispaly Serial Number</a></li>
                          <li><a href="javascript:changeIcon('fa fa-graduation-cap');"> <i class="fa fa-graduation-cap"></i> Exam</a></li>
                          <li><a href="javascript:changeIcon('fa fa-play');"> <i class="fa fa-play"></i> Quarter Start</a></li>
                          <li><a href="javascript:changeIcon('fa fa-header');"> <i class="fa fa-header"></i> Holiday</a></li>
                          <li><a href="javascript:changeIcon('fa fa-home');"> <i class="fa fa-home"></i> Work From Home</a></li>
                          <li><a href="javascript:changeIcon('fa fa-desktop');"> <i class="fa fa-desktop"></i> Online Submissions</a></li>
                        </ul>
                      </div>

                    </div>


                    <div class="form-group">
                      <label>Badge Color</label><br/>
                      <input class="form-control hidden" name="badgecolor" id="badgecolor" value="<?php echo $badgecolor;?>">
                      <div class="dropdown">
                        <button class="btn btn-<?php echo $badgecolor; ?> dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                          <?php if($icon == "number") { ?>
                            <i id="badgecontainer" class="fa fa-sort-numeric-asc"></i>
                          <?php } else { ?>
                            <i id="badgecontainer" class="<?php echo $icon?>"></i>
                          <?php } ?>

                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                          <li class="padded5"><a href="javascript:changeBadge('standard');" class="btn btn-default">Default</a></li>
                          <li class="padded5"><a href="javascript:changeBadge('success');" class="btn btn-success">Green</a></li>
                          <li class="padded5"><a href="javascript:changeBadge('primary');" class="btn btn-primary">Primary Blue</a></li>
                          <li class="padded5"><a href="javascript:changeBadge('info');" class="btn btn-info">Info</a></li>
                          <li class="padded5"><a href="javascript:changeBadge('warning');" class="btn btn-warning">Warning</a></li>
                          <li class="padded5"><a href="javascript:changeBadge('danger');" class="btn btn-danger">Danger</a></li>
                        </ul>
                      </div>

                    </div>



    				        <a href="javascript:submitForm();" class="btn btn-default">Submit</a>
    								

    							</form>
    						</div>
    					</div>

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
  document.forms["syllabusform"].action = "syllabusedittimelineadd.php";
  document.forms["syllabusform"].submit();
}


function changeIcon(icon){
  if (icon == "fa fa-sort-numeric-asc") {
    document.getElementById("icon").value = "number";
  } else {
    document.getElementById("icon").value = icon;
  }
  document.getElementById("iconcontainer").className = icon;
  document.getElementById("badgecontainer").className = icon;  
}

function changeBadge(badgecolor){
  document.getElementById("badgecolor").value = badgecolor;
  if(badgecolor == "standard") {
    document.getElementById("dropdownMenu2").className = "btn btn-default dropdown-toggle";  
  } else {
    document.getElementById("dropdownMenu2").className = "btn btn-" + badgecolor + " dropdown-toggle";  
  }
  
}

</script>



