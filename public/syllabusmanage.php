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
	//Check if prev or next clicked
	if(isset($_GET["year_current"])){
		$_SESSION["year_current"] = $_GET["year_current"];
	}

	//Check if current academic session date is set in the SESSION
	if(!isset($_SESSION["year_current"])){
		$_SESSION["year_current"] = date('Y');
	}
	

	
	$year_prev = $_SESSION["year_current"] - 1;
	$year_next = $_SESSION["year_current"] + 1;
	$year_default = date('Y');
	?>
	
  <ol class="breadcrumb">
    <li><a href="myhome.php">Home</a></li>
    <li>Syllabus</li>
  </ol>
	

	

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            Calendar Year: <?php echo $_SESSION["year_current"]?>
        </div>
        <!-- /.panel-heading -->
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
        <div class="panel-footer">
            <ul class="pager">
			        <li class="previous"><a href="syllabusmanage.php?year_current=<?php echo $year_prev;?>"><span aria-hidden="true">&larr;</span> <?php echo $year_prev;?></a></li>
			        <li class="current"><a href="syllabusmanage.php?year_current=<?php echo $year_default;?>">Current</a></li>
			        <?php if($year_next <= date('Y') + 2){?>
			        	<li class="next"><a href="syllabusmanage.php?year_current=<?php echo $year_next;?>"><?php echo $year_next;?> <span aria-hidden="true">&rarr;</span></a></li>
			        <?php }?>
			      </ul>
        </div>
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