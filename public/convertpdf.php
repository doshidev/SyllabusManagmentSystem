<?php require("pdfcrowd/pdfcrowd.php"); ?>

<?php 
try
{   
    // create an API client instance
    $client = new Pdfcrowd("doshidev", "bef43cdd1796481fdcaf028addc886bd");

    // convert a web page and store the generated PDF into a $pdf variable
    $pdf = $client->convertUri('http://www.devangdoshi.com');
    

    // set HTTP response headers
    header("Content-Type: application/pdf");
    header("Cache-Control: max-age=0");
    header("Accept-Ranges: none");
    header("Content-Disposition: attachment; filename=\"syllabus3.pdf\"");

    // send the generated PDF 
    echo $pdf;
}
catch(PdfcrowdException $why)
{
    echo "Pdfcrowd Error: " . $why;
}
?>
