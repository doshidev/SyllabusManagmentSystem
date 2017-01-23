<?php $page_name = "Manage Content" ?>
<?php include("head.php"); ?>    


<?php
  

  $syllabus_id = 3;
  // Get all content types
  // $all_content_type = getAll("syllabi_content_types", null, "id", "asc") ;
  // $content_type = $all_content_type->fetch_array(MYSQLI_ASSOC);
  ?>


  

<div id="wrapper">
	<div class="col-lg-12">

  <?php $syllabus = getById("syllabi_syllabus", "id", $syllabus_id);?>
  <?php $event = getById("event", "EVENT_ID", $syllabus["event_id"]);?>
  <?php $department = getById("CODE_DEPARTMENT", "CODE_VALUE", $event["DEPARTMENT"]);?>
  <?php $school = getById("organization", "ORG_CODE_ID", $syllabus["org_code_id"]);?>
  <div class="row">
    <div class="col-lg-12">
      <h2><?php echo $syllabus["event_id"] . ": " . $event["EVENT_LONG_NAME"]; ?></h2>
    </div>
  </div>


  <?php 
  $query_array = array(
    "syllabus_id" => "3",
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
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-gear"></i> <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <?php if($header_group["content_id"] == 0) { ?>
                  <?php $querystring = queryString( array(
                    "datatable" => "{$content_type["datatable"]}",
                    "header_id" => "{$header_group["id"]}",
                    "syllabus_id" => "{$header_group["syllabus_id"]}",
                    "editpage" => "{$content_type["editpage"]}"
                    ));
                  ?>
                  <li><a href="syllabusaddcontent.php?<?php echo $querystring; ?>"><i class="fa fa-file-o"></i> Add</a></li>
                <?php } else { ?>
                  <li><a href="<?php echo $content_type["editpage"] ;?>?id=<?php echo $header_group["content_id"] ;?>&syllabus_id=<?php echo $query_params["id"] ;?>"><i class="fa fa-edit"></i> Edit</a></li>
                  <li><a href="#"><i class="fa fa-times"></i> Delete</a></li>
                <?php } ?>
              </ul>
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
            "syllabus_id" => "3",
            "group_id" => "{$header_group["id"]}",
            );
          ?>

          <?php $childs = getAll("syllabi_syllabus_header", $query_array, "child_index", "asc");?>
          <?php foreach ($childs as $child_headers){ ?>
            <?php if($child_headers["child_index"] > 0) {?>
              <?php $content_type = getById("syllabi_content_types", "id", $child_headers["type_id"]) ?>

              <!-- Child Panel -->
              <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="btn-group pull-right">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-gear"></i> <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <?php if($child_headers["content_id"] == 0) { ?>
                          <?php $querystring = queryString( array(
                            "datatable" => "{$content_type["datatable"]}",
                            "header_id" => "{$child_headers["id"]}",
                            "syllabus_id" => "{$child_headers["syllabus_id"]}",
                            "editpage" => "{$content_type["editpage"]}"
                            ));
                          ?>
                          <li><a href="syllabusaddcontent.php?<?php echo $querystring; ?>"><i class="fa fa-file-o"></i> Add</a></li>
                        <?php } else { ?>
                          <li><a href="<?php echo $content_type["editpage"] ;?>?id=<?php echo $child_headers["content_id"] ;?>&syllabus_id=<?php echo $query_params["id"] ;?>"><i class="fa fa-edit"></i> Edit</a></li>
                          <li><a href="#"><i class="fa fa-times"></i> Delete</a></li>
                        <?php } ?>
                      </ul>
                    </div>
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
  </div>
</div> <!-- /.page-wrapper -->



<?php include("footer.php"); ?>

<a href="//pdfcrowd.com/url_to_pdf/">Save to PDF</a>
