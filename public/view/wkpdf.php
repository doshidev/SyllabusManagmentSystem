<?php $page_name = "Download PDF" ?>
<?php include("head.php"); ?>

<div id="wrapper">
	<div class="row">
      <div class="col-lg-12 text-center">
      <br />
      <br />
      <br />
      <br />
          <h1>Please Wait...</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->	
</div>

<?php
$filename=$_GET["eventid"] . "_" . date("YmdHis") . "pdf";
$return= shell_exec("c://progra~1//wkhtmltopdf//bin//wkhtmltopdf.exe http://syllabi.stratford.edu/view/printpdf.php?id={$_GET["id"]} c://projects//syllabi//public//pdf//filename.pdf");
echo $return;

$destimation = "../pdf/" . $filename;
redirectTo($filename);

?>