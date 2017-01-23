<?php $page_name = "Template Library - University Level" ?>
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

      <a href="templatelibraryadd.php?type=university" class="btn btn-danger">Add New Template</a>
      <br/><br/>

      <?php 
      $query_array = array('type' => 'university');
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
                  <li><a href="syllabusadd.php?id=<?php echo $template["id"];?>"><i class="fa fa-list-alt"></i> Edit</a></li>
                  <li>
                    <a data-toggle="modal" data-target="#myModal<?php echo $template["id"];?>">
                      <i class="fa fa-times"></i> Delete
                    </a>
                    
                  </li>
                </ul>
                <div class="modal fade text-left" id="myModal<?php echo $template["id"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">
                          <button type="button" class="btn btn-danger btn-circle">
                            <i class="fa fa-times"></i>
                          </button>
                          Delete Syllabus?
                        </h4>
                      </div>
                      <div class="modal-body alert alert-danger">
                        Are you sure you want to delete &quot;<?php echo $template["templatename"];?> &quot;?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <a href="syllabusdelete.php?id=<?php echo  $template["id"];?>&returnpage=templatelibraryuniversity.php" class="btn btn-danger">Delete</a>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                </div>
            
            
            <h4>
              <?php echo $template["templatename"];?> 
              
            </h4>
          </div>
      
        <?php } ?>
      </ul>                
    

            
    </div>
  </div>
  <!-- /.row -->
	
</div>

<?php include("footer.php"); ?>


