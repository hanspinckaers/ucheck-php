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

ini_set('display_errors', 0);

if(isset($_SESSION['cijfers_token']))
{
		$json = file_get_contents("http://109.72.92.55:3000/token/".$_SESSION['cijfers_token']);	
		
	$_SESSION['cijfers_token'] = "";

	unset($_SESSION['cijfers_token']);	
} else {
	$json = file_get_contents("http://109.72.92.55:3000/cijfers/$user/$pwd/");
}

if($json == "Invalid token.")
{
	mail("hans.pinckaers@gmail.com", "Invalid token! (cijfers token) ".$_SESSION['cijfers_token'], "",  "From: geneesleer@alwaysdata.net");

	$json = file_get_contents("http://109.72.92.55:3000/cijfers/$user/$pwd/");
}

if(!$json)
{
	mail("hans.pinckaers@gmail.com", "Amsterdam server plat? Fallback voor $user (cijfers)", "",  "From: geneesleer@alwaysdata.net");

	$json = file_get_contents("http://ucheck.nodester.com/cijfers/$user/$pwd/");
	
	if(!$json)
	{
		mail("hans.pinckaers@gmail.com", "Vals alarm voor $user, JSON nog steeds nil (cijfers)", "",  "From: geneesleer@alwaysdata.net");
	}
}

$raw_vakken = json_decode($json, true);

$vakken =  $raw_vakken['vakken'];
$overige = $raw_vakken['overige'];

if(!isset($raw_vakken['vakken']))
{
	//include("cijfers_oud.php");
}

$gehaald = array();



if(!$vakken) $vakken = array();

foreach($vakken as $cfr)
{
	$cijfer =  (array)$cfr;
	
	if($cijfer['gehaald'] == 'ja')
	{
		if($cijfer['id'][strlen($cijfer['id'])-1] == "Y" && (int)$cijfer['ects'] != 0)
		{
			if(!in_array(substr($cijfer['id'], 0, -1), $gehaald) && strlen($cijfer['id']) > 8 )
			{
			
				$exploded = explode(" ", substr($cijfer['id'], 0, -1));
				
				$gehaald[] = $exploded[count($exploded)-1];
			}
			
		} else {
			if(!in_array($cijfer['id'], $gehaald) && strlen($cijfer['id']) > 8)
			{
				$exploded = explode(" ", $cijfer['id']);
			
				$gehaald[] = $exploded[count($exploded)-1];
			}
		}
	}
}

$_SESSION['gehaald'] = $gehaald;			
?>