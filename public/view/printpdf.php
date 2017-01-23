<?php $page_name = "Manage Content" ?>
<?php include("printhead.php"); ?>

<?php
  //Check query parameters
  
  $query_params = checkQueryParams(array("id"));
  if(isset($query_params["id"])){
    $syllabus_id = $query_params["id"];
  } else {
    //redirectTo("syllabusmanage.php");  
  }


  
  // Get all content types
  // $all_content_type = getAll("syllabi_content_types", null, "id", "asc") ;
  // $content_type = $all_content_type->fetch_array(MYSQLI_ASSOC);
  ?>

<?php $syllabus = getById("syllabi_syllabus", "id", $syllabus_id);?>
<?php $event = getVwById("VWSyllabi_event", "EVENT_ID", $syllabus["event_id"]);?>
<?php $department = getVwById("VWSyllabi_CODE_DEPARTMENT", "CODE_VALUE", $event["DEPARTMENT"]);?>
<?php $school = getVwById("VWSyllabi_organization", "ORG_CODE_ID", $syllabus["org_code_id"]);?> 

    
    <!-- Go To Top CSS -->
    <style>
    #top-link-block.affix-top {
        position: absolute; /* allows it to "slide" up into view */
        bottom: -88px;
        right: 10px;
    }
    #top-link-block.affix {
        position: fixed; /* keeps it on the bottom once in view */
        bottom: 12px;
        right: 10px;
    }

    .navbar-custom {
      color: #FFFFFF;
      background-color:#<?php echo $pagination_color[$syllabus["academic_session"]];?>;
    }
    </style>


<!-- Check query parameters -->

  

<div id="row">
	
  <!-- /.row -->	

  
  
  
  <?php 
  if(!$syllabus["academic_session"]){
    $syllabus["academic_session"]="D";
    $type="library";
  } else {
    $type="section";
  }
  ?>
  


  <?php 
  $query_array = array(
    "syllabus_id" => "{$query_params["id"]}",
    "id" => "_group_id",
    );
  ?>

  <?php $heads = getAll("syllabi_syllabus_header", $query_array, "display_index", "asc");?>


  



  

  <?php foreach ($heads as $header_group){ ?>
    <?php $has_child = getMaxHeaderChild($header_group["syllabus_id"], $header_group["id"]);?>
    <!-- Header Group Panel -->
    <div class="panel panel-warning" id="<?php echo $header_group["id"]?>">
      <div class="panel-heading">
          <div class="btn-group pull-right">
            <?php if($has_child == 0) { ?>
              <?php $content_type = getById("syllabi_content_types", "id", $header_group["type_id"]) ?>
            <?php } ?>
          </div>
          <h4><i class="<?php echo $header_group["icon"];?>"></i> <?php echo $header_group["header"]; ?> </span></h4>
      </div>
      
      
      
      <div class="panel-body">
        <?php if($has_child == 0) { ?>
          <p>
            <?php $content_id = $header_group["content_id"]; ?>
            <?php include("{$content_type["viewpage"]}"); ?>
          </p>
        <?php } else { ?>

          <?php 
          $query_array = array(
            "syllabus_id" => "{$query_params["id"]}",
            "group_id" => "{$header_group["id"]}",
            );
          ?>

          <?php $childs = getAll("syllabi_syllabus_header", $query_array, "child_index", "asc");?>
          <?php foreach ($childs as $child_headers){ ?>
            <?php if($child_headers["child_index"] > 0) {?>
              <?php $content_type = getById("syllabi_content_types", "id", $child_headers["type_id"]) ?>

              <!-- Child Panel -->
              <div class="panel panel-default" id="<?php echo $child_headers["id"]?>">
                <div class="panel-heading">
                    
                    <h4><?php echo $child_headers["header"]; ?></h4>
                </div>
                        
                <div class="panel-body">
                  <p>
                    <?php $content_id = $child_headers["content_id"]; ?>
                    <?php include("{$content_type["viewpage"]}"); ?>
                  </p>
                </div>    
              </div> <!-- Ends Child Panel -->

            <?php } ?> 
          <?php } ?> <!-- End Child "For loop" -->
      <?php } ?>
      </div>    
    </div> <!-- Ends Header Group Panel -->
    
  <?php } ?>  

  <div class="row">
      
  </div>
  <!-- /.row -->
</div> <!-- /.page-wrapper -->



<?php include("printfooter.php"); ?>


