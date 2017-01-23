<?php
   $serverName = "FCPCDB02"; 
   $database = "CAMPUS6";

   // Get UID and PWD from application-specific files. 
   $uid = "syllabi_reader";
   $pwd = "e43UKBdUgX8M6gKK";

   try {
      $conn = new PDO( "sqlsrv:server=$serverName;Database = $database", $uid, $pwd); 
      $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
   }

   catch( PDOException $e ) {
      echo( "Status: Error connecting to SQL Server" ); 
      echo(print_r ($e));
      die;
   }
?>