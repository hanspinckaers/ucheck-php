<pre>
<?
$cookiefile = $_SERVER["DOCUMENT_ROOT"]."raw/cookies/".$user."_vakken.txt";
$filename = $_SERVER["DOCUMENT_ROOT"]."raw/cache/".$_GET['q'].".txt";

if(file_exists($filename))
{
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	fclose($handle);
		
	$inschrijven = unserialize($contents);
		
	print_r($inschrijven);
}