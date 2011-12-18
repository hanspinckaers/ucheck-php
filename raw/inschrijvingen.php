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

$token = $_SESSION['inschrijvingen_token'];

if(isset($_SESSION['inschrijvingen_token']))
{
	$json = file_get_contents($NODE_SERVER."token/".$_SESSION['inschrijvingen_token']);			
			
	$_SESSION['inschrijvingen_token'] = "";

	unset($_SESSION['inschrijvingen_token']);
} else {
	if($year)
	{
	$json = file_get_contents($NODE_SERVER."inschrijvingen/$user/$pwd/$year/");
	} else {
	$json = file_get_contents($NODE_SERVER."inschrijvingen/$user/$pwd/");
	}
}

if($json == "Invalid token.")
{
//	 mail("hans.pinckaers@gmail.com", "Invalid token! ".$token, "",  "From: geneesleer@alwaysdata.net");

	if($year)
	{
		$json = file_get_contents($NODE_SERVER."inschrijvingen/$user/$pwd/$year/");
	} else {
		$json = file_get_contents($NODE_SERVER."inschrijvingen/$user/$pwd/");
	}
}

if(!$json)
{	
	if($year)
	{
		$json = file_get_contents($NODE_FALLBACK."inschrijvingen/$user/$pwd/$year/");
	} else {
		$json = file_get_contents($NODE_FALLBACK."inschrijvingen/$user/$pwd/");
	}
	
	if(!$json)
	{
//		mail("hans.pinckaers@gmail.com", "Fallback voor $user (inschrijvingen)", "",  "From: geneesleer@alwaysdata.net");
	}
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
