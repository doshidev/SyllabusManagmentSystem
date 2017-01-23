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
	if(isset($_GET["date_current"])){
		$_SESSION["date_current"] = $_GET["date_current"];
	}

	//Check if current academic session date is set in the SESSION
	if(!isset($_SESSION["date_current"])){
		$_SESSION["date_current"] = strtotime("now");
	}
	

	//Fetch unique academic sessions and store in array
	$sessions = getAcademicSessions();	
	$i = 0;
	while ($result = mysqli_fetch_assoc($sessions)) {
		$academic_session[$i] = $result["ACADEMIC_SESSION"];
		$i++;
	}
	

	//Find out if form is submitted, else set default session to A 
	$selected_session = (isset($_GET["form_sessions"]) ? $_GET["form_sessions"] : $academic_session[0]);
	
	?>
    		
	<div class="row">
    <div class="col-lg-12"> <!-- /.col-lg-12 -->
			<form role="form" action="syllabusmanage.php" method="GET">
				<div class="input-group ">
          <select class="form-control" name="form_sessions" id="form_sessions">
			      <?php
			      foreach($academic_session as $key => $value) {
			      	echo '<option value="' . $value . '" '. ($value == $selected_session ? "selected" : null).'>Section ' . $value . '</option>';
			      }
			      ?>
			    </select>
          <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
            	<i class="fa fa-filter"></i>
            </button>
        	</span>
        </div>
        <!-- /input-group -->
			</form>    
		</div>
	</div>
    
	<?php
	$currentQuarter = getAcademicQuarterByDate($_SESSION["date_current"], $selected_session);
	
	echo "<br/>";
	$date=getdate($_SESSION["date_current"]);
	$date_string = $date["month"] . ", " . $date["mday"] . " " . $date["year"];
	
	//echo date_format($date, 'Y-m-d H:i:s');
	echo "<br/>";

	if($currentQuarter) {
		
		echo "<ul>";
		echo "<li>Session: " . $currentQuarter["academic_session"] . "</li>";
		echo "<li>Academic Year: " . $currentQuarter["academic_year"] . "</li>";
		echo "<li>Term: " . $currentQuarter["academic_term"] . "</li>";
		echo "<li>Start Date: " . $currentQuarter["start_date"] . "</li>";
		echo "<li>End Date: " . $currentQuarter["end_date"] . "</li>";
		
		echo "</ul>";
		//print_r($currentQuarter);
	}
	else {
		echo'<div class="alert alert-warning">';
        echo "There are no active sessions for {$date_string}. Click on &quotPrevious&quot or &quotNext&quot to search";
    echo '</div>';
		
	}
	
	$date_prev = dateMath($currentQuarter["start_date"], "-70 days");
	$date_next = dateMath($currentQuarter["end_date"], "70 days");
	$date_default = strtotime("now");
	?>
	
	<div class="row">
    <div class="col-lg-12">
      <nav>
      <ul class="pager">
        <li class="previous"><a href="syllabusmanage.php?form_sessions=<?php echo $selected_session;?>&date_current=<?php echo $date_prev;?>"><span aria-hidden="true">&larr;</span> Previous</a></li>
        <li class="current"><a href="syllabusmanage.php?form_sessions=<?php echo $selected_session;?>&date_current=<?php echo $date_default;?>">Current</a></li>
        <li class="next"><a href="syllabusmanage.php?form_sessions=<?php echo $selected_session;?>&date_current=<?php echo $date_next;?>">Next <span aria-hidden="true">&rarr;</span></a></li>
      </ul>
      </nav>
    </div>
  </div>
  <!-- /.row -->

</div>

<?php include("footer.php"); ?>