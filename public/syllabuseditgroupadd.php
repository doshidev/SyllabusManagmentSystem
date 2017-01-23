<?php $page_name = "Manage Content" ?>
<?php include("head.php"); ?>

<!-- Check parameters -->
<?php
	//Check form parameters for add / update
	$check_params = checkFormParams(array("id", "action", "groupid", "syllabus_id", "title", "content", "footer", "titlecolor"));
	if($check_params["cnt"] > 4){
    // Insert New
    if($check_params["id"] == 0){
     $check_params["display_index"] = getMaxGroup($check_params["groupid"]) + 1;
     // Insert New Record
      $check_params["id"] = insertFields("syllabi_type_groupdetails", array(
        "groupid" => "{$check_params["groupid"]}",
        "title" => "{$check_params["title"]}",
        "content" => "{$check_params["content"]}",
        "footer" => "{$check_params["footer"]}",
        "titlecolor" => "{$check_params["titlecolor"]}",
        "display_index" => "{$check_params["display_index"]}"
      ));

		} else {
      // Update Record
      updateById("syllabi_type_groupdetails", $check_params["id"], array(
        "title" => "{$check_params["title"]}",
        "content" => "{$check_params["content"]}",
        "footer" => "{$check_params["footer"]}",
        "titlecolor" => "{$check_params["titlecolor"]}"
      ));

    }
    
    ?>

    <script type="text/javascript">
      parent.refreshGroup(<?php echo $check_params["groupid"]?>, <?php echo $check_params["syllabus_id"]?>, <?php echo $check_params["id"]?>);
    </script>

    <?php

	}

  //Check query parameters
  $query_params = checkQueryParams(array("id", "groupid", "syllabus_id"));
  if(isset($query_params["id"])){
    $id = $query_params["id"];
  } else {
    //redirectTo("syllabusmanage.php");  
  }

  //If Id is not zero, fetch data
  if($id > 0){
    $groups = getById("syllabi_type_groupdetails", "id", $id);
    $title = $groups["title"];
    $content = $groups["content"];
    $footer = $groups["footer"];
    $titlecolor = $groups["titlecolor"];
  } else {
    $title = "";
    $content = "";
    $footer = "";
    $titlecolor = "default";
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
    				      	<input class="form-control hidden" name="groupid" id="groupid" value="<?php echo $query_params["groupid"]; ?>">
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
                      <label>Footer</label>
                      <textarea name="footer" id="footer" class="form-control" rows="3"><?php echo $footer; ?></textarea>
                    </div>

                    <div class="form-group">
                      <label>Title Color</label><br/>
                      <input class="form-control hidden" name="titlecolor" id="titlecolor" value="<?php echo $titlecolor;?>">
                      <div class="dropdown">
                        <button class="btn btn-<?php echo $titlecolor; ?> dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Title
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                          <li class="padded5"><a href="javascript:changeColor('default');" class="btn btn-default">Default</a></li>
                          <li class="padded5"><a href="javascript:changeColor('green');" class="btn btn-success">Green</a></li>
                          <li class="padded5"><a href="javascript:changeColor('primary');" class="btn btn-primary">Primary Blue</a></li>
                          <li class="padded5"><a href="javascript:changeColor('yellow');" class="btn btn-warning">Yellow</a></li>
                          <li class="padded5"><a href="javascript:changeColor('red');" class="btn btn-danger">Red</a></li>
                          
                        </ul>
                      </div>

                    </div>

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


<?php $muted = 1; ?>
<?php include("footer.php"); ?>

<script type="text/javascript">

$(document).ready(function() {
  $('#content').summernote();
  $('#footer').summernote();
  updateColor();
});


function submitForm(){
  footer = document.getElementById("footer").value;
  if (footer == "<p><br></p>") {
    document.getElementById("footer").value = null;
  }
  document.forms["syllabusform"].action = "syllabuseditgroupadd.php";
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

function changeColor(titlecolor){
  document.getElementById("titlecolor").value = titlecolor;
  updateColor();
}

function updateColor() {
  titlecolor = document.getElementById("titlecolor").value;
   btncolor = titlecolor;
  switch(titlecolor) {
    case "green":
        btncolor = "success";
        break;
    case "yellow":
        btncolor = "warning";
        break;
    case "red":
        btncolor = "danger";
        break;
    default:
        btncolor = titlecolor;
  }
  document.getElementById("dropdownMenu2").className = "btn btn-" + btncolor + " dropdown-toggle";
}

</script>



