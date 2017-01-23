<?php $page_name = "Manage Syllabus" ?>
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
	
  $query_params = checkQueryParams(array("year", "term", "session", "department", "event"));
  if($query_params["cnt"] < 5) {
    redirectTo("syllabusmanage.php");
  }

  
	?>
	
  <div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
      <li><a href="myhome.php">Home</a></li>
      <li><a href="syllabusmanage.php?year_current=<?php echo $query_params["year"];?>">Syllabus</a></li>
      <li><a href="syllabusmanagelistevents.php?year=<?php echo $query_params["year"];?>&amp;term=<?php echo $query_params["term"];?>&amp;session=<?php echo $query_params["session"];?>">Events List</a></li>
      <li>Sections List </li>
      </ol>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-12">
      <p>
        <button class="btn btn-outline btn-<?php echo $button_color[$query_params["session"]];?>"><?php echo $query_params["year"];?></button>
        <button class="btn btn-outline btn-<?php echo $button_color[$query_params["session"]];?>"><?php echo $query_params["term"];?></button>
        <button class="btn btn-outline btn-<?php echo $button_color[$query_params["session"]];?>">Session <?php echo $query_params["session"];?></button>
        <button class="btn btn-outline btn-<?php echo $button_color[$query_params["session"]];?>"><?php echo $query_params["department"];?></button>
        <button class="btn btn-outline btn-<?php echo $button_color[$query_params["session"]];?>"><?php echo $query_params["event"];?></button>
      </p>
      </div>
  </div>

  <?php $event = getVwById("event", "EVENT_ID", $query_params["event"]);?>
  
  <div class="row">
    <div class="col-lg-12">
      <div class="well well-lg">
        
        <h2><?php echo $query_params["event"] . ": " . $event["EVENT_LONG_NAME"]; ?></h2>
        <p><?php echo $event["DESCRIPTION"]; ?></p>        
        
        <?php $sect = getSectionsBySchool($query_params);?>
        
        <div class="row">
            <ul class="list-group">
              <?php foreach($sect as $sections) {  ?>
              
                <?php $query_params["organization"]=$sections["ORG_CODE_ID"]; ?>
                <?php $query_params["section"]=$sections["SECTION"]; ?>
                <?php $syllabus = getSyllabusBySection($query_params)->fetch_array(MYSQLI_ASSOC);?>

                <?php
                $href = "syllabusadd.php?";
                $href .= "year=" . $query_params["year"];
                $href .= "&term=" . $query_params["term"];
                $href .= "&session=" . $query_params["session"];
                $href .= "&organization=" . $query_params["organization"];
                $href .= "&school=" . $sections["ORG_NAME_1"];
                $href .= "&department=" . $query_params["department"];
                $href .= "&event=" . $query_params["event"];
                $href .= "&section=" . $query_params["section"];
                $href .= "&type=" . "section";
                $href .= "&SectionId=" . $sections["SectionId"];


                ?>

                <div class="list-group-item">    
                  <div class="btn-group pull-right">
                    <?php if(isset($syllabus)){ ?>
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-gear"></i> <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a href="syllabusadd.php?id=<?php echo $syllabus["id"];?>"><i class="fa fa-list-alt"></i> Manage Headers</a></li>
                        <li><a href="syllabusview.php?id=<?php echo $syllabus["id"];?>"><i class="fa fa-list-alt"></i> Manage Content</a></li>
                        <li><a href="#"><i class="fa fa-copy"></i> Replicate</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#"><i class="fa fa-times"></i> Delete</a></li>
                      </ul>
                    <?php } else { ?>
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-plus"></i> <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a href="<?php echo $href;?>"><i class="fa fa-plus"></i> Add Syllabus</a></li>
                        <li><a href="#"><i class="fa fa-copy"></i> Copy From</a></li>
                        
                      </ul>
                    <?php }?>
                  </div>
                  
                  
                  <h4>
                    <span class="label label-<?php echo $button_color[$query_params["session"]]; ?>">
                      <?php echo $sections["SECTION"];?>
                    </span>
                    &nbsp;<?php echo $sections["ORG_NAME_1"];?> 
                    
                  </h4>
                </div>
            
              <?php } ?>
            </ul>
        </div>
        <!-- /.row -->
      </div>
    </div>
  </div>
  

</div> <!-- /.page-wrapper -->

<?php include("footer.php"); ?>