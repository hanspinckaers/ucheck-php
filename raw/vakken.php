<?
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

include "user_info.php";

$cookiefile = $_SERVER["DOCUMENT_ROOT"]."raw/cookies/".$user."_vakken.txt";
$filename = $_SERVER["DOCUMENT_ROOT"]."raw/cache/".$_GET['year']."/".$_GET['q'].".txt";

$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);

$inschrijven = unserialize($contents);		
