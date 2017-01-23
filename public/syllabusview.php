<?php $page_name = "Manage Content" ?>
<?php include("head.php"); ?>
    
    
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
    </style>
<div id="wrapper">
  <!-- Navigation -->
  <?php require 'nav.php';?>
</div>

<!-- Check query parameters -->
<?php
  //Check query parameters
  
  $query_params = checkQueryParams(array("id"));
  if(isset($query_params["id"])){
    $syllabus_id = $query_params["id"];
  } else {
    redirectTo("syllabusmanage.php");  
  }

  
  // Get all content types
  // $all_content_type = getAll("syllabi_content_types", null, "id", "asc") ;
  // $content_type = $all_content_type->fetch_array(MYSQLI_ASSOC);
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
  
  <?php $syllabus = getById("syllabi_syllabus", "id", $syllabus_id);?>
  <?php $event = getVwById("event", "EVENT_ID", $syllabus["event_id"]);?>
  <?php $department = getVwById("CODE_DEPARTMENT", "CODE_VALUE", $event["DEPARTMENT"]);?>
  <?php $school = getVwById("organization", "ORG_CODE_ID", $syllabus["org_code_id"]);?>
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
      <h2>
        <?php if($type=="section"){?>
            <?php echo $syllabus["event_id"] . ": " . $event["EVENT_LONG_NAME"]; ?>
        <?php } else { ?>
          <?php echo $syllabus["templatename"]; ?> 
        <?php } ?>
      </h2>
      <div class="btn-group">
        <a href="syllabusadd.php?id=<?php echo $syllabus_id;?>" class="btn btn-<?php echo $button_color[$syllabus["academic_session"]];?>">
            Manage Headers
        </a>
      </div>
      <br/><br/>
    </div>
  </div>


  <?php 
  $query_array = array(
    "syllabus_id" => "{$query_params["id"]}",
    "id" => "_group_id",
    );
  ?>

  <?php $heads = getAll("syllabi_syllabus_header", $query_array, "display_index", "asc");?>


  <!-- Footer Navbar for Syllabus -->
  <nav class="navbar navbar-inverse navbar-fixed-bottom">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <span class="navbar-brand" href="#">
          <?php if($type=="section"){?>
            <?php echo $syllabus["event_id"] . ": " . $event["EVENT_LONG_NAME"]; ?> 
          <?php } else { ?>
            <?php echo $syllabus["templatename"]; ?> 
          <?php } ?>
        </span>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <!-- <ul class="nav navbar-nav">
           <li><a href="#">Link</a></li> 
        </ul>-->  
        
        <ul class="nav navbar-nav navbar-right">
          <!-- <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form> -->
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Go To <span class="caret"></span></a>
            <ul class="dropdown-menu">
               <?php foreach ($heads as $header_group){ ?>
                <li><a href="#<?php echo $header_group["id"];?>"><?php echo $header_group["header"];?></a></li>
               <?php } ?>
            </ul>
          </li>
          <li>
            <a href="#top" onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
              Back To Top <i class="fa fa-chevron-circle-up"></i>
            </a>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>



  

  <?php foreach ($heads as $header_group){ ?>
    <?php $has_child = getMaxHeaderChild($header_group["syllabus_id"], $header_group["id"]);?>
    <!-- Header Group Panel -->
    <div class="panel panel-warning" id="<?php echo $header_group["id"]?>">
      <div class="panel-heading">
        <?php if($header_group["type_id"]!=8){?>  
          <div class="btn-group pull-right">
            <?php if($has_child == 0) { ?>
              <?php $content_type = getById("syllabi_content_types", "id", $header_group["type_id"]) ?>
              <?php if($header_group["action"] != "i") {?>
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
              <?php } else {?>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-lock"></i> <span class="caret"></span>
                  </button>
                  
                  <ul class="dropdown-menu">
                      <li style="padding:10px">Inherited From: <?php echo getInheritance($header_group["action_id"]);?></li>
                  </ul>
              <?php }?>
            <?php } ?>
          </div>
        <?php }?>
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
              <div class="panel panel-default">
                <div class="panel-heading">
                   <?php if($child_headers["type_id"]!=8){?>     
                    <div class="btn-group pull-right">
                      <?php if($child_headers["action"] != "i"){?>
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
                      <?php } else {?>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-lock"></i> <span class="caret"></span>
                        </button>

                        <ul class="dropdown-menu">
                            <li style="padding:10px">Inherited From: <?php echo getInheritance($child_headers["action_id"]);?></li>
                        </ul>
                      <?php }?>
                    </div>
                  <?php } ?>
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

</div> <!-- /.page-wrapper -->



<?php include("footer.php"); ?>
