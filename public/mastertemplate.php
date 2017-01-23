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
					<ul class="nav nav-tabs">
          <?php
	    		$terms = getAcademicTerms($_SESSION["year_current"]);
		      $x=0;
		      foreach($terms as $academic_terms) {	
		     	?>
		      	<li <?php echo ($x == 0 ? "class=active" : " ")?>><a href="#<?php echo $academic_terms["ACADEMIC_TERM"];?>" data-toggle="tab"><?php echo $academic_terms["ACADEMIC_TERM"];?></a></li>
          <?php
          $x++;
		      }
		      ?>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <?php
            $x=0;
            foreach($terms as $academic_terms) { 

            ?>
            <div class="tab-pane fade <?php echo ($x == 0 ?"in active" : " ")?>" id="<?php echo $academic_terms["ACADEMIC_TERM"];?>">
                <h4>&nbsp;</h4>
                <?php
                $sessions = getAcademicSessions($_SESSION["year_current"], $academic_terms["ACADEMIC_TERM"])	;
                foreach($sessions as $academic_sessions){
                ?>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4">
                  <div class="panel panel-<?php echo $color[$academic_sessions["ACADEMIC_SESSION"]]?>">
                    <div class="panel-heading">
                      Session <?php echo $academic_sessions["ACADEMIC_SESSION"]?>
                    </div>
                    <div class="panel-body">
                      <h4><i class="fa fa-calendar text-<?php echo $button_color[$academic_sessions["ACADEMIC_SESSION"]]?>"></i> <?php echo date('M, d Y', strtotime($academic_sessions["START_DATE"]))?> <small>to</small></h4>
                      <h4><i class="fa fa-calendar text-<?php echo $button_color[$academic_sessions["ACADEMIC_SESSION"]]?>"></i> <?php echo date('M, d Y', strtotime($academic_sessions["END_DATE"]))?></h4>
                      <br/>
                      <p>
                      	Academic Year: <?php echo $_SESSION["year_current"]?><br/>
                      	Academic Term: <?php echo $academic_terms["ACADEMIC_TERM"]?><br/>
                      	Academic Session: <?php echo $academic_sessions["ACADEMIC_SESSION"]?><br/>
                      </p>
                    </div>
                    <div class="panel-footer">
                      <?php $href = "syllabusmanagelistevents.php?year={$_SESSION["year_current"]}&term={$academic_terms["ACADEMIC_TERM"]}&session={$academic_sessions["ACADEMIC_SESSION"]}";?>
                      <a href="<?php echo $href?>">
                        <button type="button" class="btn btn-outline btn-<?php echo $button_color[$academic_sessions["ACADEMIC_SESSION"]]?>">
                          Select Session <?php echo $academic_sessions["ACADEMIC_SESSION"]?> <i class="glyphicon glyphicon-circle-arrow-right"></i>
                        </button>
                      </a>
                    </div>
                  </div>
                </div>
                <!-- /.col-lg-4 -->
                <?php }?>
            </div>
            <?php
		      	$x++;
		      	}
		      	?>
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