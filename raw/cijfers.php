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

if($USES_UCHECK_API)
{	
	$safe_user = urlencode($user);

	if(!isset($_SESSION['key']))
	{		
		$safe_pass = urlencode($pwd);
					
		$_SESSION['key'] = file_get_contents($UCHECK_API_SERVER."login?user=$safe_user&pass=$safe_pass");	
	}
		
	$key = $_SESSION['key'];
	
	if(strstr($key, "err:"))
	{
		echo "loginerror";
		exit();
	}
	
	$json = file_get_contents($UCHECK_API_SERVER."cijfers?user=$safe_user&pass=$key");	
}
else {
	$json = exec(escapeshellcmd("$NODEJS_DIR $NODEJS_SERVERJS_DIR cijfers $user $pwd"));	
}

$raw_vakken = json_decode($json, true);

if($raw_vakken["error"] == "usiserror")
{
	echo "usiserror";
	exit();
} else if($raw_vakken["error"] == "loginerror")
{
	echo "loginerror";
	exit();
} else if($json == "")
{
	exit();
}

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
