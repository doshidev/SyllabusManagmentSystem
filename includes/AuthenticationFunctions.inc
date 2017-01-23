<?php
function authenticateLDAP($username, $password) {
	$status=true;
	// Application specific LDAP login
	$app_user = "svc_scripts@stratford";
	$app_pass = "qe6GedvrHw";

	// Here we'll put user's DN
	$userdn = '';

	// Connect to LDAP service
  $adServer = "10.12.46.7";
  //$adServer = "199.19.68.236"; // External IP for AD Server
  $conn_status = ldap_connect($adServer);
  $ldap_dn = "OU=Management,DC=stratford,DC=edu";

	if ($conn_status === FALSE) {
	  die("Couldn't connect to LDAP service");
	  $status=false;
	}

	if ($status) {
		// Bind as application
		$bind_status = ldap_bind($conn_status, $app_user, $app_pass);
	}
	
	if ($bind_status === FALSE) {
	  die("Couldn't bind to LDAP as application user");
	  $status=false;
	}

	if ($status) {
		// Find the user's DN
		$search_base = "OU=Management, DC=stratford, DC=edu";
		
		// Query
		$query="(samAccountName=$username)";
		$search_status = ldap_search($conn_status, $search_base, $query);
		ldap_sort($conn_status, $search_status, "sn");
	}
	
	if ($search_status === FALSE) {
	  //die("Search on LDAP failed");
	  $status=false;
	}

	if ($status) {
		// Pull the search results
		$result = ldap_get_entries($conn_status, $search_status);
	}
	
	if ($result === FALSE) {
	  //die("Couldn't pull search results from LDAP");
	  $status=false;
	} 
	
	if ((int) @$result['count'] > 0) {
	  $userdn = $result[0]['dn'];
	}
	if (trim((string) $userdn) == '') {
	    //die("Empty DN. Something is wrong.");
	    $status=false;
	}
	
	if ($status) {
		// Authenticate with the newly found DN and user-provided password
		$auth_status = ldap_bind($conn_status, $userdn, $password);
	}

	if ($status) {
		if ($auth_status === FALSE) {
		    //die("Couldn't bind to LDAP as user!");
		    $status=false;
		} 
	}
	
	if ($status) {
		$_SESSION["authenticated"] = true;
		$_SESSION["syllabi_username"] = $result[0]["samaccountname"][0];
		$_SESSION["syllabi_fname"] = $result[0]["givenname"][0];
		$_SESSION["syllabi_lname"] = $result[0]["sn"][0];
		$_SESSION["dn"] = $result[0]["dn"];

	} 
	else {
		$_SESSION["authenticated"] = null;
		$_SESSION["syllabi_username"] = null;
		$_SESSION["syllabi_fname"] = null;
		$_SESSION["syllabi_lname"] = null;
		$_SESSION["dn"] = null;
	}
		
	return $status;
}