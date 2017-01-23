<?php $page_name = "Test Views" ?>
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

<pre>
<?php 
$dept = getDepartments();
var_dump($dept);
?>
</pre>
<?php
foreach($dept as $depts){
  echo $depts["CODE_VALUE"] . "<br/>";
}
?>


</div>
<!-- /.page-wrapper -->

<?php include("footer.php"); ?>

