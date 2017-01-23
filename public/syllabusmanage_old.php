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
	if(!isset($_SESSION["date_current"])){
		$_SESSION["date_current"] = strtotime("now");
	}
	$sessions = getAcademicSessions();
	
	$i = 0;
	//Store the academic sessions as array 
	while ($result = mysqli_fetch_assoc($sessions)) {
		$academic_session[$i] = $result["ACADEMIC_SESSION"];
		$i++;
	}
	
	?>
	<form>
		<div class="col-lg-3">
			<div class="form-group">
		    <select class="form-control" name="form_sessions" id="form_sessions">
		      <?php
		      foreach($academic_session as $key => $value) {
		      	echo '<option value=' . $value . '">Section ' . $value . '</option>';
		      }
		      ?>
		    </select>
			</div>
		</div>
		<div class="col-lg-1">
			<div class="form-group">
		    <button type="submit" class="btn btn-default btn-circle"><i class="fa fa-filter"></i></button>
			</div>
		</div>
	</form>


  <!-- /.col-lg-12 -->
  <div class="col-lg-12">
    <div class="panel panel-default">
      
      <div class="panel-body">
        <!-- Nav tabs -->

        <ul class="nav nav-pills">
        	<?php
        	foreach($academic_session as $key => $value) {
          	echo '<li';
          	if ($key == 0) {
          		echo " class='active'";
          	}
          	echo '>';
          	echo '<a href="#session_' . $key.'" data-toggle="tab">Section ' . $value . '</a>';
            echo '</li>';
          }
          ?>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <?php foreach($academic_session as $key => $value) {?>
            <div class="tab-pane fade in <?php echo ($key == 0 ? "active" : "");?>" id="session_<?php echo $key;?>">
                <h4>Session <?php echo $value;?></h4>
                 
                <p>
                	<?php
      	          $currentQuarter = getAcademicQuarter($_SESSION["date_current"], $value);
			
									if($currentQuarter) {
										echo "Current";
										echo "<br/>";
										print_r($currentQuarter);
										echo "<br/>";
										echo "<br/>";
										
									}
									
									
											
									$date_prev = dateMath($currentQuarter["start_date"], "-10 days");
									$prevQuarter = getAcademicQuarter($date_prev, $value);
									if($prevQuarter) {
										echo "Previous";
										echo "<br/>";
										print_r($prevQuarter);
										echo "<br/>";
										echo "<br/>";
									}

									$date_next = dateMath($currentQuarter["end_date"], "10 days");
									$nextQuarter = getAcademicQuarter($date_next, $value);
									if($nextQuarter) {
										echo "Next";
										echo "<br/>";
										print_r($nextQuarter);
										echo "<br/>";
										echo "<br/>";
										
									}
									?>
                </p>
            </div>
          <?php }?>
        </div>
      </div>
      <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
  </div>
  <!-- /.col-lg-12 -->

	

<?php include("footer.php"); ?>