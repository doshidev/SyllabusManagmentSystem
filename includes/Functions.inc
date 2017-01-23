<?php
// Defaul Color Values by Sessions
$color= array(
	'A' => "green",
	'B' => "yellow",
	'C' => "primary",
	'D' => "danger",
	);
$button_color= array(
	'A' => "success",
	'B' => "warning",
	'C' => "primary",
	'D' => "danger",
	);
$pagination_color= array(
	'A' => "5cb85c",
	'B' => "f0ad4e",
	'C' => "337ab7",
	'D' => "337ab7",
	);


// Redirect Page to URI
function redirectTo($page) {
	$host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  header("Location: http://$host$uri/$page");
  ob_end_flush();
  exit;
}


// Check if User Is Logged In
function isLoggedIn() {
	if (!isset($_SESSION["authenticated"])) {
		redirectTo("index.php");
	}
}


// Convert Date
function dateMath($queryDate, $dateString) {
	$date=date_create($queryDate);
	date_add($date, date_interval_create_from_date_string($dateString));
	return strtotime(date_format($date, 'Y-m-d H:i:s'));
}


// Check Query Parameters and Return Array of all Params
function checkQueryParams($param_array){
	$cnt = 0;
	for($i=0; $i < count($param_array); $i++){
		if(isset($_GET[$param_array[$i]])){
			$params_set[$param_array[$i]] = $_GET[$param_array[$i]];
			$cnt++;
		}
		$params_set["cnt"] = $cnt;
	}
	return $params_set;
}


// Check Form Post Parameters and Return Array of all Params
function checkFormParams($param_array){
	$cnt = 0;
	for($i=0; $i < count($param_array); $i++){
		if(isset($_POST[$param_array[$i]])){
			$params_set[$param_array[$i]] = $_POST[$param_array[$i]];
			$cnt++;
		}
		$params_set["cnt"] = $cnt;
	}
	return $params_set;
}


// Return Current Server Date in DB Format
function currentDate(){
	$date = date("Y-m-d");
	return $date;
}


// Pad Strings with Preceding Zeros
function padString($number, $pad_len){
	$result=null;
	for($i=0; $i < $pad_len - strlen($number); $i++){
		$result .= "0";
	}
	$result .= $number;
	return $result;
}


// Generate Query String from Associative Array
function queryString($param_array){
	$cnt = 0;
	$qstring = null;
	foreach ($param_array as $key => $value){
		if($cnt > 0){
			$qstring .= "&" . $key . "=" . $value;
		} else {
			$qstring = $key . "=" . $value;
		}
		$cnt++;
	}
	return $qstring;
}