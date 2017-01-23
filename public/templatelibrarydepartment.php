<?php $page_name = "Template Library - Department Level" ?>
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
      <div class="panel-group" id="accordion">
        <a href="templatelibraryadd.php?type=department" class="btn btn-danger">Add New Template</a>
              <br/><br/>
      <?php $dept = getDepartments();?>
      <?php $tableid = array(); ?>
      <?php foreach($dept as $departments) {  ?>
        <?php $templatecount= getCount('syllabi_syllabus', array("type"=>"department", "department_code"=>$departments["CODE_VALUE"]))?>
        <?php if($templatecount > 0){?>
        <?php $query_params["department"]=$departments["CODE_VALUE"]; ?>
        <div class="panel panel-danger">
          <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $departments["CODE_VALUE"];?>"><?php echo $departments["LONG_DESC"];?> (<?php echo $templatecount;?>)</a>
            </h4>
          </div>
          <div id="<?php echo $departments["CODE_VALUE"];?>" class="panel-collapse collapse">
            <div class="panel-body">
              
              

              <?php 
              $query_array = array('type' => 'department', 'department_code' => $departments["CODE_VALUE"]);
              $templates = getAll('syllabi_syllabus', $query_array, 'templatename', 'ASC');
              ?>
              
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

            </div>
          </div>
        </div>
        <?php }?>
      <?php }?>
      </div>    
    </div>
  </div>
            
	

</div>

<?php include("footer.php"); ?>