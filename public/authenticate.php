<?php 
require_once("../includes/Sessions.inc"); 
require_once('..\includes\AuthenticationFunctions.inc');
require_once('..\includes\Functions.inc');

// Bypassing LDAP for local development
$_SESSION["authenticated"] = true;
$_SESSION["syllabi_username"] = "ddoshi";
$_SESSION["syllabi_fname"] = "Devang";
$_SESSION["syllabi_lname"] = "Doshi";
$_SESSION["dn"] = "Organization";
redirectTo("myhome.php");
// Bypass ends

if (isset($_POST['submit'])) {
	
	


	// User-provided info
	$username = $_POST['syllabi_username'];
	$password = $_POST['syllabi_password'];

	$authentication_status = authenticateLDAP($username, $password);

	if ($authentication_status) {
		//Successfully authenticated in ldap, redirect to home
		redirectTo("myhome.php");
	} 
	else {
		$_SESSION["message"] = "Login failed!!!";
		redirectTo("index.php");
	}
}