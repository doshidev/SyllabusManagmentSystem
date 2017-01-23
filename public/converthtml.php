<?php require("pdfcrowd/pdfcrowd.php"); 

// Start output buffering
ob_start();
include("syllabusviewpdf.php"); 
// saving captured output to file
file_put_contents('filename.html', ob_get_contents());
// end buffering and displaying page
ob_end_flush();

?>
