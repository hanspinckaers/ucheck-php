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

function base64url_encode($data) { 
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
} 

function base64url_decode($data) { 
  return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
}

$dangerous_characters = array(" ", '"', "'", "&", "/", "\\", "?", "#", ".");
$user = str_replace($dangerous_characters, '_', $_GET['user']);

$forbidden_characters = array(" ", '"', "'", "&", "/", "\\", "?", "#", ".");

// $safe_vak = str_replace($forbidden_characters, '_', $_GET['vak']);
// $safe_year = str_replace($forbidden_characters, '_', $_GET['year']);
// $vak = str_replace("&", "%26", $safe_vak);


if(file_exists("../geheim/iphone.php"))
{
	include("../geheim/iphone.php");

	$pwd = $geheim->decrypt($_GET['pass'], $key, true);
} 
else {
	$pwd =  base64url_decode($_GET['pass']);
}

include "../raw/details.php";

$new_onderdelen = array();
$nummer_onderdeel = -1;
$firstFilter = true;
$current_key = "";

foreach($onderdelen as $onderdeel)
{
	if( (!$onderdeel['Nr studieactiv.'] || $onderdeel['Nr studieactiv.'] == "") &&
		(!$onderdeel['enabled']) && count($onderdelen) != 1 && !$onderdeel['enabled'] && $firstFilter)
	{
		$firstFilter = false;
		continue;	
	}
	
	$nummer_onderdeel++;
	
	$hoofdvak = ($onderdeel['Verplicht'] != "" && $onderdeel['Omschr.'] != "");

	if($hoofdvak)
	{
		$current_key = $onderdeel['Omschr.'];
		$current_hoofdvak = $onderdeel;
		$new_onderdelen[$current_key] = array();
	}
	
	if($current_key)
	{
		$new_onderdeel = array();
		$new_onderdeel["titel"] = $current_hoofdvak["Omschr."];
		$new_onderdeel["nummer"] = $nummer_onderdeel;
		$new_onderdeel["eenheden"] = $current_hoofdvak["Eenheden"];
		$new_onderdeel["info"] = $onderdeel["Nr studieactiv."];
		$new_onderdeel["enabled"] = $onderdeel["enabled"];
		$new_onderdeel["verplicht"] = $current_hoofdvak["Verplicht"];
		$new_onderdelen[$current_key][] = $new_onderdeel;
	}

}

echo json_encode($new_onderdelen);
?>