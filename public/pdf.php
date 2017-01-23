<?php 
$url = "http://syllabus.stratford.edu/view/syllabus.php?id=59";
$curlconnect = curl_init();
curl_setopt($curlconnect, CURLOPT_URL, 'http://www.spurdoc.com/api/make?url='. urlencode($url));
$result = curl_exec($curlconnect);
echo $result;

?>