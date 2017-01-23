<?php 

// Database Connection Parameters
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "r00t");
define("DB_NAME", "syllabi");


// Create database connection
$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// Test if connection succeeded
if(mysqli_connect_errno()) {
  die("Database connection failed: " . 
       mysqli_connect_error() . 
       " (" . mysqli_connect_errno() . ")"
  );
}


// Generic
// -- confirm query set
function confirm_query($result_set) {
	if (!$result_set) {
		die("Database query failed.");
	}
}


// Include Other Database Functions
// require_once("MsSQLDatabaseConnect.inc");
require_once("DatabaseFunctionsSelect.inc");
require_once("DatabaseFunctionsInsert.inc");
require_once("DatabaseFunctionsUpdate.inc");
require_once("DatabaseFunctionsDelete.inc");