<?php $page_name = "Template Library" ?>
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



	
  <ol class="breadcrumb">
    <li><a href="myhome.php">Home</a></li>
    <li><?php echo $page_name?></li>
  </ol>
	

	

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        
        <div class="panel-body">
          <!-- Academic Terms -->
					<ul class="nav nav-pills">
		      	<li class="active"><a href="#univ" data-toggle="tab">University Level</a></li>
            <li><a href="#dept" data-toggle="tab">Department Level</a></li>
            <li><a href="#course" data-toggle="tab">Course Level</a></li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            
            <div class="tab-pane fade in active" id="univ">
              <?php 
              $query_array = array('type' => 'university', 'status' => 'active');
              $templates = getAll('syllabi_library', $query_array, 'templatename', 'ASC');
              ?>
              <br/>
              <ul class="list-group">
                <?php foreach($templates as $template) {  ?>
                
                  <div class="list-group-item">    
                    <div class="btn-group pull-right">
                      
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-gear"></i> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a href="syllabusadd.php?id=<?php echo $template["id"];?>"><i class="fa fa-list-alt"></i> Manage Headers</a></li>
                          <li><a href="syllabusview.php?id=<?php echo $template["id"];?>"><i class="fa fa-list-alt"></i> Manage Content</a></li>
                          <li role="separator" class="divider"></li>
                          <li><a href="#"><i class="fa fa-times"></i> Delete</a></li>
                        </ul>
                    </div>
                    
                    
                    <h4>
                      <?php echo $template["templatename"];?> 
                      
                    </h4>
                  </div>
              
                <?php } ?>
              </ul>                
            </div> <!-- tab-pane / univ -->

            <div class="tab-pane" id="dept">
              <div class="row">&nbsp;</div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="panel-group" id="accordion">
                  <?php $dept = getDepartments();?>
                  <?php $tableid = array(); ?>
                  <?php foreach($dept as $departments) {  ?>
                    <?php $query_params["department"]=$departments["CODE_VALUE"]; ?>
                    <div class="panel panel-default">
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
                </div>
              </div>
            </div> <!-- tab-pane / dept -->

            <div class="tab-pane" id="course">
                
                
            </div> <!-- tab-pane / course -->
            
          </div>
        </div>
        <!-- /.panel-body -->
        
      </div>
      <!-- /.panel -->
    </div>
  </div>
  <!-- /.row -->
	<div class="row">
    <div class="col-lg-12">
      
      
      
    </div>
  </div>
  <!-- /.row -->

</div>

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