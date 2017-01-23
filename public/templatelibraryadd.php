<?php $page_name = "Template Library - Add" ?>
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
  $query_params = checkQueryParams(array("type","header_id"));
  if($query_params["cnt"] == 2){
    $header_id = $query_params["header_id"];
    $type = $query_params["type"];
    $action = "Update";
  } elseif($query_params["cnt"] == 1 && isset($query_params["type"])) {
    $type = $query_params["type"];
    $header_id = 0;
    $action = "Add";
  } else {
    redirectTo("myhome.php");  
  }

  if($action == "Update"){
    $header_record = getById("syllabi_syllabus", "id", $header_id);
    $type = $header_record["type"];
    $templatename = $header_record["templatename"];
    $department_code = $header_record["department_code"];
    $event_id = $header_record["event_id"];
    
  } else {
    $templatename = null;
    $department_code = null;
    $event_id = null;
  }

  
	?>
	
  <div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
      <li><a href="myhome.php">Home</a></li>
      <li>Template Library</li>
      <li>Add Master Template</li>
      </ol>
    </div>
  </div>
  
  
  <?php $syllabus["academic_session"]="D"; ?>
  <div class="row">
    <div class="col-lg-12">
      <p>
        
          <button class="btn btn-outline btn-<?php echo $button_color[$syllabus["academic_session"]];?>">Master Template</button>
          <button class="btn btn-outline btn-<?php echo $button_color[$syllabus["academic_session"]];?>"><?php echo strtoupper($type);?></button>
      
      </p>
      </div>
  </div>

  
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
          
          <h2><?php echo $action; ?> Master Template</h2>
          
          
          
          
          <br/>
          <div class="row">
            <div class="col-lg-12">
              <form role="form" method="post" name="syllabusheader" id="syllabusheader">
                  
                  <div id="errors">
                  </div>

                  <input class="form-control hidden" name="header_id" id="header_id" value="<?php echo $header_id; ?>">
                  <input class="form-control hidden" name="type" id="type" value="<?php echo $type; ?>">
                  <input class="form-control hidden" name="formaction" id="formaction" value="<?php echo $action; ?>">

                  <div id="templatenamediv" name="templatenamediv" class="form-group <?php echo ($templatename == "") ? "has-error" : "";?>">
                    <label>Template Name</label>
                    <input type="text" class="form-control" name="templatename" id="templatename" value="<?php echo $templatename; ?>" placeholder="Enter Header" required>
                  </div>
  
                  <?php if($type == "course"){ ?>
                    <div id="event_iddiv" name="event_iddiv" class="form-group <?php echo ($event_id == "") ? "has-error" : "";?>">
                      <label>Event</label>
                      <select name="event_id" id="event_id" class="form-control" onchange>
                        <option value="0">Select Event</option>
                        <?php $event = getVwAll('VWSyllabi_event', null, 'EVENT_ID', 'asc');?>
                        <?php foreach($event as $events){ ?>
                          <option value="<?php echo $events["EVENT_ID"]; ?>"><?php echo $events["EVENT_ID"]; ?> - <?php echo $events["EVENT_LONG_NAME"]; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  <?php } ?>
                  
                  <?php if($type == "department"){ ?>
                    <div id="department_codediv" name="department_codediv" class="form-group <?php echo ($department_code == "") ? "has-error" : "";?>">
                      <label>Department</label>
                      <select name="department_code" id="department_code" class="form-control">
                        <option value="0">Select Department</option>
                        <?php $dept = getDepartments();?>
                        <?php foreach($dept as $depts){ ?>
                          <option value="<?php echo $depts["CODE_VALUE"]; ?>"><?php echo $depts["LONG_DESC"]; ?> [<?php echo $depts["CODE_VALUE"]; ?>]</option>
                        <?php } ?>
                      </select>
                    </div>
                  <?php } ?>
                  

                  

                  
                 
                  
                  <a href="javascript:submitForm('<?php echo $type?>');" id="submit" class="btn btn-default">Submit</a>
                  <button id="cancel" class="btn btn-default">Cancel</button>
              </form>
          </div>
          <!-- /.col-lg-12 (nested) -->
          </div> <!-- /.row -->
        </div> <!-- /. panel-body -->
      </div>
    </div>
  </div>
  

</div> <!-- /.page-wrapper -->

<?php include("footer.php"); ?>

<script>
    function submitForm(type){
    var formerrors = "";
    
    if(document.getElementById("templatename").value == "" || document.getElementById("templatename").value == null || document.getElementById("templatename").value == 0) {
      formerrors += "Enter Template Name. <br/>"
    }

    if(type=="course" && document.getElementById("event_id").value == 0) {
      formerrors += "Select Event. <br/>"
    }

    if(type=="department" && document.getElementById("department_code").value == 0) {
      formerrors += "Select Department. <br/>"
    }

    if (formerrors == "" || formerrors == null) {
      document.forms["syllabusheader"].action = "templatelibraryupdate.php";
      document.forms["syllabusheader"].submit();
    } else {
      document.getElementById("errors").innerHTML = formerrors;
      document.getElementById("errors").className="alert alert-danger";
    }

  }

  $(document).ready(function(){
  

    $('#event_id').change(function(){
      if(document.getElementById("event_id").value != "0"){
        document.getElementById("event_iddiv").className = "form-group has-success";
      } else {
        document.getElementById("event_iddiv").className = "form-group has-error";
      }

    });

    $('#templatename').blur(function(){
      if(document.getElementById("templatename").value != ""){
        document.getElementById("templatenamediv").className = "form-group has-success";
      } else {
        document.getElementById("templatenamediv").className = "form-group has-error";
      }
    });

    
  });


</script>