<?php $page_name = "Inherit / Replicate" ?>
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
	
  $query_params = checkQueryParams(array("to"));
  if(isset($query_params["to"])){
    $to = $query_params["to"];
  } else {
    redirectTo("syllabusmanage.php");  
  }

  
	?>
	
  <div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
      <li><a href="myhome.php">Home</a></li>
      <li>Inherit / Replicate</li>
      </ol>
    </div>
  </div>
  
  <?php $syllabus = getById("syllabi_syllabus", "id", $to);?>
  <?php $event = getVwById("VWSyllabi_event", "EVENT_ID", $syllabus["event_id"]);?>
  <?php $department = getVwById("VWSyllabi_CODE_DEPARTMENT", "CODE_VALUE", $event["DEPARTMENT"]);?>
  <?php $school = getVwById("VWSyllabi_organization", "ORG_CODE_ID", $syllabus["org_code_id"]);?>
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
      </div>
  </div>

  

  
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <h2>
            <?php if($type=="section"){?>
              <?php echo $syllabus["event_id"] . ": " . $event["EVENT_LONG_NAME"]; ?> 
              <span class="btn btn-outline btn-<?php echo $button_color[$syllabus["academic_session"]]; ?>">
                <?php echo $syllabus["section"];?>
              </span>
            <?php } else { ?>
              <?php echo $syllabus["templatename"]; ?> 
            <?php } ?>
          </h2>
          
          
          <!-- Nav tabs -->
          <ul class="nav nav-tabs">
              
              <li class="active"><a href="#home" data-toggle="tab">Recommended</a>
              </li>
              
              <li><a href="#messages" data-toggle="tab">Search</a>
              </li>
              <li class="pull-right"><h4>Select Source</h4></li>
              
          </ul>
          
          <!-- Tab panes -->
          <div class="tab-content">
              <div class="tab-pane fade in active" id="home">
                  
                <br/>
                <ul class="list-group">
                  
                  <!-- Course Level -->
                  <?php 
                  $query_array = array('type' => 'course', "event_id"=>$syllabus["event_id"]);
                  $templates = getAll('syllabi_syllabus', $query_array, 'templatename', 'ASC');
                  ?>
                
                
                  <?php foreach($templates as $template) {  ?>
                    <?php if($template["id"]!=$to){?>
                      <div class="list-group-item list-group-item-success">    
                        <div class="btn-group pull-right">
                            <a href="syllabusaddinrepview.php?id=<?php echo $template["id"]?>&to=<?php echo $to?>" class="btn btn-lg btn-success">Select</a>
                        </div>
                        <h4><?php echo $template["templatename"];?></h4>
                        <h5 class="text-muted">Course Level: <?php echo $syllabus["event_id"] . ": " . $event["EVENT_LONG_NAME"]; ?> </h5>
                      </div>
                    <?php } ?>  
                  <?php } ?>

                  <!-- Department Level -->
                  <?php 
                  $query_array = array('type' => 'department', "department_code"=>$event["DEPARTMENT"]);
                  $templates = getAll('syllabi_syllabus', $query_array, 'templatename', 'ASC');
                  ?>
                
                
                  <?php foreach($templates as $template) {  ?>
                    <?php if($template["id"]!=$to){?>
                      <div class="list-group-item list-group-item-danger">    
                        <div class="btn-group pull-right">
                            <a href="syllabusaddinrepview.php?id=<?php echo $template["id"]?>&to=<?php echo $to?>" class="btn btn-lg btn-danger">Select</a>
                        </div>
                        <h4><?php echo $template["templatename"];?></h4>
                        <h5 class="text-muted">Department Level: <?php echo $department["LONG_DESC"]; ?></h5>
                      </div>
                    <?php } ?>
                  <?php } ?>

                  <!-- University Level -->
                  <?php 
                  $query_array = array('type' => 'university');
                  $templates = getAll('syllabi_syllabus', $query_array, 'created_dt', 'DESC');
                  ?>
                
                
                  <?php foreach($templates as $template) {  ?>
                    <?php if($template["id"]!=$to){?>
                      <div class="list-group-item list-group-item-warning">    
                        <div class="btn-group pull-right">
                            <a href="syllabusaddinrepview.php?id=<?php echo $template["id"]?>&to=<?php echo $to?>" class="btn btn-lg btn-warning">Select</a>
                        </div>
                        <h4><?php echo $template["templatename"];?></h4>
                        <h5 class="text-danger">University Level</h5>
                      </div>
                    <?php } ?>
                  <?php } ?>
                
                  <!-- Similar Events -->
                  <?php 
                  $query_array = array('type' => 'section', "event_id"=>$syllabus["event_id"]);
                  $templates = getAll('syllabi_syllabus', $query_array, 'created_dt', 'DESC');
                  ?>
                
                
                  <?php foreach($templates as $template) {  ?>
                    <?php if($template["id"]!=$to){?>
                      <div class="list-group-item list-group-item-info">    
                        <div class="btn-group pull-right">
                            <a href="syllabusaddinrepview.php?id=<?php echo $template["id"]?>&to=<?php echo $to?>" class="btn btn-lg btn-info">Select</a>
                        </div>
                        <h4>
                          <?php echo getVwById('VWSyllabi_organization', 'ORG_CODE_ID', $template["org_code_id"])["ORG_NAME_1"];?> 
                          <span class="btn btn-outline btn-default"><?php echo $template["section"];?></span>
                          <span class="btn btn-outline btn-default"><?php echo $template["academic_year"];?></span>
                          <span class="btn btn-outline btn-default"><?php echo $template["academic_term"];?></span>
                        </h4>
                        <h5 class="text-success">Similar Event: <?php echo $template["event_id"];?> </h5>
                      </div>
                    <?php } ?>
                  <?php } ?>

                </ul>
                  
              </div>
              

              <!-- Search -->
              <div class="tab-pane fade" id="messages">
                <div class="dataTable_wrapper">
                  <br/>
                  <table class="table table-striped table-bordered table-hover" id="dataTable1">
                      <thead>
                          <tr>
                              <th>Event Id</th>
                              <th>Course Title</th>
                              <th>Campus</th>
                              <th>Section</th>
                              <th>Year / Term</th>
                              <th>&nbsp;</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $query_array = array('type' => 'section');
                        $templates = getAll('syllabi_syllabus', $query_array, 'created_dt', 'DESC');
                        ?>
                      
                      
                        <?php foreach($templates as $template) {  ?>
                          <?php if($template["id"]!=$to){?>
                            <tr>
                              <td><?php echo $template["event_id"]; ?></td>
                              <td><?php echo getVwById('VWSyllabi_event', 'EVENT_ID', $template["event_id"])["EVENT_LONG_NAME"];?></td>
                              <td><?php echo getVwById('VWSyllabi_organization', 'ORG_CODE_ID', $template["org_code_id"])["ORG_NAME_1"];?></td>
                              <td><?php echo $template["section"]; ?></td>
                              <td><?php echo $template["academic_year"];?> / <?php echo $template["academic_term"];?> / <?php echo $template["academic_session"];?></td>
                              <td><a href="syllabusaddinrepview.php?id=<?php echo $template["id"]?>&to=<?php echo $to?>" class="btn btn-default">Select</a></td>
                            </tr>
                          <?php } ?>
                        <?php } ?>
                      </tbody>
                      
                      
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              
          </div>
          
        </div> <!-- /. panel-body -->
      </div>
    </div>
  </div>
  

</div> <!-- /.page-wrapper -->

<?php include("footer.php"); ?>

<script>
  $(document).ready(function(){
    $("#dataTable1").DataTable();
  });
</script>