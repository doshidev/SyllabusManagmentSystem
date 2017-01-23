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
	
  $query_params = checkQueryParams(array("year", "term", "session"));
  if($query_params["cnt"] < 3) {
    redirectTo("syllabusmanage.php");
  }

  
	?>
	
  <ol class="breadcrumb">
    <li><a href="myhome.php">Home</a></li>
    <li><a href="syllabusmanage.php?year_current=<?php echo $query_params["year"];?>">Syllabus</a></li>
    <li>Events List</li>
  </ol>

  <div class="row">
    <div class="col-lg-12">
      <p>
        <button class="btn btn-outline btn-<?php echo $button_color[$query_params["session"]];?>"><?php echo $query_params["year"];?></button>
        <button class="btn btn-outline btn-<?php echo $button_color[$query_params["session"]];?>"><?php echo $query_params["term"];?></button>
        <button class="btn btn-outline btn-<?php echo $button_color[$query_params["session"]];?>">Session <?php echo $query_params["session"];?></button>
      </p>
      </div>
  </div>

  <?php $dept = getDepartments();?> 
  <!--
  -->
   <div class="row">
      <div class="col-lg-12">
        <div class="panel-group" id="accordion">
          <?php $tableid = array(); ?>
          
          <?php foreach($dept as $departments) {  ?>

            <?php $query_params["department"]=$departments["CODE_VALUE"]; ?>
            <div class="panel panel-<?php echo $color[$query_params["session"]];?>">
              <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $departments["CODE_VALUE"];?>"><?php echo $departments["LONG_DESC"];?></a>
                </h4>
              </div>
              <div id="<?php echo $departments["CODE_VALUE"];?>" class="panel-collapse collapse">
                <div class="panel-body">
                  
                  <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="sectionTable_<?php echo $departments["CODE_VALUE"];?>">
                        <thead>
                            <tr>
                                <th>Event Id</th>
                                <th>Course Title</th>
                                <th>Program</th>
                                <th>Credits</th>
                                <th class="dt-center">Sections</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $sects = getEventsByDepartment($query_params);
                        foreach($sects as $sections) { 
                          $href = "syllabusmanagelistsections.php?";
                          $href .= "year=" . $query_params["year"];
                          $href .= "&term=" . $query_params["term"];
                          $href .= "&session=" . $query_params["session"];
                          $href .= "&department=" . $departments["LONG_DESC"];
                          $href .= "&event=" . $sections["EVENT_ID"];
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $sections["EVENT_ID"];?></td>
                                <td><?php echo $sections["EVENT_LONG_NAME"];?></td>
                                <td class="text-center"><?php echo $sections["PROGRAM"];?></td>
                                <td class="text-center"><?php echo $sections["CREDITS"];?></td>
                                <td class="text-center"><?php echo $sections["sec_count"];?></td>
                                <td class="text-center"><a href="<?php echo $href;?>"><button type="button" class="btn btn-<?php echo $button_color[$query_params["session"]];?> btn-xs"><i class="fa fa-list-alt"></i></button></a></td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                  <?php 
                  $tablename = "#sectionTable_" . $departments["CODE_VALUE"];
                  array_push($tableid, $tablename);
                  ?>

                </div>
              </div>
            </div>
          <?php }?>

        </div>
        <!-- /.panel-group --> 
      </div> <!-- /.col-lg-12 -->
    </div> <!-- /.row -->
  

</div>
<!-- /.page-wrapper -->

<?php include("footer.php"); ?>

<?php 
for($j=0; $j < count($tableid); $j++) {
?>
<script>
  $(document).ready( function () {
    $("<?php echo $tableid[$j]?>").DataTable();
  } );
</script>

<?php }?>