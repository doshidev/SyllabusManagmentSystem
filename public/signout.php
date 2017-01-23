<!doctype html>
<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Syllabi - Stratford Universty</title>
</head>

<?php 
require_once("../includes/Sessions.inc");
require_once("../includes/Functions.inc");
		
		$_SESSION["authenticated"] = null;
		$_SESSION["syllabi_username"] = null;
		$_SESSION["syllabi_fname"] = null;
		$_SESSION["syllabi_lname"] = null;
		$_SESSION["dn"] = null;

	// Destroy session
	//session_start();
	$_SESSION = array();
	if (isset($_COOKIE[session_name()])) {
	  setcookie(session_name(), '', time()-42000, '/');
	}
	session_destroy(); 
	redirectTo("index.php");
?>
</body>
</html>