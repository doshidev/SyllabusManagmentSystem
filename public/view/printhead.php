<?php ob_start();?>
<?php require_once("../../includes/Sessions.inc"); ?>
<?php require_once("../../includes/Functions.inc"); ?>
<?php require_once("../../includes/DatabaseFunctions.inc"); ?>

<?php 

if(!isset($page_name)) {
	$page_name=" ";
}

?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <title><?php echo $page_name . " - Syllabi, Stratford Universty" ?></title>
  

  <!-- Bootstrap Core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">







	<!-- Custom Fonts -->
	<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

	
</head>

<body>



