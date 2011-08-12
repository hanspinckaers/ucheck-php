<?
## Copyright (c) 2011 by Hans Pinckaers 
##
## This work is licensed under the Creative Commons 
## Attribution-NonCommercial-ShareAlike 3.0 Unported License. 
## To view a copy of this license, visit 
## http://creativecommons.org/licenses/by-nc-sa/3.0/ 
##
## ucheck-php: https://github.com/HansPinckaers/ucheck-php
## ucheck-node: https://github.com/HansPinckaers/ucheck-node
##
?>
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