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

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

include "user_info.php";

$forbidden_characters = array(" ", '"', "'", "&", "/", "\\", "?", "#", ".");

$safe_vak = str_replace($forbidden_characters, '_', $_GET['q']);
$safe_year = str_replace($forbidden_characters, '_', $_GET['year']);

$vak = str_replace("&", "%26", $safe_vak);

$filename = $DOCUMENT_ROOT."raw/cache/".$safe_year."/".$vak.".txt";

$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);

$inschrijven = unserialize($contents);	

try {
include('Galvanize.php');
$GA = new Galvanize('UA-4063156-10');
$GA->trackPageView("vakken.php", "vakken");
} catch (Exception $e) {}	
