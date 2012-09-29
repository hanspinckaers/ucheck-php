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

ini_set('display_errors', 0);

include "../raw/setup.php";

$forbidden_characters = array(" ", '"', "'", "&", "/", "\\", "?", "#", ".");

$safe_vak = str_replace($forbidden_characters, '_', $_GET['vak']);
$safe_year = str_replace($forbidden_characters, '_', $_GET['year']);

$vak = str_replace("&", "%26", $safe_vak);

$filename = $DOCUMENT_ROOT."raw/cache/".$safe_year."/".$vak.".txt";

$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);

$inschrijven = unserialize($contents);	

echo json_encode($inschrijven);

?>