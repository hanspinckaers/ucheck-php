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

include "raw/setup.php";

function base64url_encode($data) { 
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
} 

function base64url_decode($data) { 
  return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
} 

$user = $_GET['user'];

if(file_exists("../geheim/iphone.php"))
{
	include("../geheim/iphone.php");
	
	$pwd = $geheim->decrypt($_GET['pass'], $key, true);
} else {
	$pwd =  base64url_decode($_GET['pass']);
}
	
	
echo $json = file_get_contents($NODE_SERVER."inschrijvingen/$user/$pwd/");

// Turn off all error reporting
try {
include('Galvanize.php');
$GA = new Galvanize('UA-4063156-9');
$GA->trackPageView();
} catch (Exception $e) {}
?>