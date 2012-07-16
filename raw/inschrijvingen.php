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

include "user_info.php";
ini_set('display_errors', 0);

$year = $_GET['year'];

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

	$json = file_get_contents($UCHECK_API_SERVER."inschrijvingen?user=$safe_user&pass=$key");	
}
else {
	$json = exec(escapeshellcmd("$NODEJS_DIR $NODEJS_SERVERJS_DIR inschrijvingen $user $pwd $year"));		
}

$raw_inschrijvingen = json_decode($json, true);

$inschrijvingen = $raw_inschrijvingen['inschrijvingen'];
$studies = $raw_inschrijvingen['studies'];

if(!isset($raw_inschrijvingen['inschrijvingen']))
{
	//include("inschrijvingen_oud.php");
}

$newinschrijvingen = array();
$inschrijvingen_gehaald = array();

$ingeschreven = array();
foreach($inschrijvingen as $inschrijving)
{		
		$exploded = explode(" ", $inschrijving['origineel_id']);
		
		$origineel_id =  $exploded[count($exploded)-1];
		
		$ingeschreven[] = $origineel_id;

		$smaller_id = substr($origineel_id, 0 , -1);

		if(in_array($smaller_id, $_SESSION['gehaald']) || 
			in_array($origineel_id, $_SESSION['cijfers_ids']))
		{		
			$inschrijvingen_gehaald[] = $inschrijving;
		} else {
			$newinschrijvingen[] = $inschrijving;
		}		
}

$inschrijvingen = $newinschrijvingen;

$_SESSION['ingeschreven'] = $ingeschreven;
?>
