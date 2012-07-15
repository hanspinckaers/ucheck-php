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

//ini_set('display_errors', 0);

include "user_info.php";

$filename = $DOCUMENT_ROOT."voortgang_cache/".$user.".txt";

if(file_exists($filename) && ((time()-filemtime($filename))/(60*60) < 24*7))
{	
	$html = @file_get_contents($filename);
} else {

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
	
		$html = file_get_contents($UCHECK_API_SERVER."raw_voortgang?user=$safe_user&pass=$key");	
	}
	else {
		$output = array();
		exec(escapeshellcmd("$NODEJS_DIR $NODEJS_SERVERJS_DIR voortgang $user $pwd"), $output);	
		$html = implode("", $output);
	}

	$logfile = fopen($filename, 'w') or die("can't open file");	
	
	fwrite($logfile, $html);

	fclose($logfile);
}

//echo $html;

$studiesraw = explode("<DIV id='win0divDERIVED_SAA_DPR_GROUPBOX1$", $html);

$studies = array();

foreach($studiesraw as $studieonderdeel)
{	

	$studiedeelarr = explode("<tr><td class='PAGROUPDIVIDER'  align='left'>", $studieonderdeel);
	
	// print_r($studiedeelarr);
	// Studiepunten (eenh.): 180.00 vereist, 146.00 behaald, 34.00 nodig
	preg_match("/border='0' \/><\/a>([^<]*)</", $studiedeelarr[0], $title);	
	preg_match("/([0-9\.]*) vereist, ([0-9\.]*) behaald, ([0-9\.]*) nodig/", $studiedeelarr[0], $punten);
	preg_match("/([0-9\.]*) vereist, ([0-9\.]*) werkelijk/", $studiedeelarr[0], $gem);		

	if(!isset($punten[1])) continue;	
		
 	$studies[]['title'] = strip_tags(str_replace("&nbsp;", "", $title[1]));
	$studies[count($studies)-1]['eenh_vereist'] = strip_tags($punten[1]);
	$studies[count($studies)-1]['eenh_gevolgd'] = strip_tags($punten[2]);
	$studies[count($studies)-1]['eenh_nodig'] = strip_tags($punten[3]);

	$studies[count($studies)-1]['gem_vereist'] = strip_tags($gem[1]);
	$studies[count($studies)-1]['gem_werkelijk'] = strip_tags($gem[2]);
					
	$counter = -1;



	foreach($studiedeelarr as $studiedeel)
	{
//		echo $studiedeel;
	
		$counter++;
		if($counter == 0) continue;
				
		$studiesubdelen = explode("<table cellpadding='2' cellspacing='0' cols='1'  class='PSLEVEL1SCROLLAREABODYNBOWBO'", $studiedeel);		
		
//		print_r($studiesubdelen);
		preg_match("/([^<]*)</", $studiesubdelen[0], $title);
		preg_match("/([0-9\.]*) vereist, ([0-9\.]*) behaald, ([0-9\.]*) nodig/", $studiesubdelen[0], $punten);
		preg_match("/([0-9\.]*) vereist, ([0-9\.]*) werkelijk/", $studiesubdelen[0], $gem);		

	 	$studies[count($studies)-1]['onderdelen'][$counter-1]['title'] = strip_tags(str_replace("&nbsp;", "", $title[1]));
		$studies[count($studies)-1]['onderdelen'][$counter-1]['eenh_vereist'] = strip_tags($punten[1]);
		$studies[count($studies)-1]['onderdelen'][$counter-1]['eenh_gevolgd'] = strip_tags($punten[2]);
		$studies[count($studies)-1]['onderdelen'][$counter-1]['eenh_nodig'] = strip_tags($punten[3]);

		$studies[count($studies)-1]['onderdelen'][$counter-1]['gem_vereist'] = strip_tags($gem[1]);
		$studies[count($studies)-1]['onderdelen'][$counter-1]['gem_werkelijk'] = strip_tags($gem[2]);
				
		$subcounter = -1;
				
		if(!isset($title[1])) continue;
		
		$studies[count($studies)-1]['onderdelen'][$counter-1]['sub'] = array();
		
		foreach($studiesubdelen as $studiesubdeel)
		{
			if($subcounter == -1){
				$subcounter = 0;
				 continue;
			}
		
			preg_match("/border='0' \/><\/a>([^<]*)</", $studiesubdeel, $title);
			preg_match("/([0-9\.]*) vereist, ([0-9\.]*) behaald, ([0-9\.]*) nodig/", $studiesubdeel, $punten);
			preg_match("/([0-9\.]*) vereist, ([0-9\.]*) werkelijk/", $studiesubdeel, $gem);		
								
			if(isset($title[1])  && isset($punten[1]) ){
				$studies[count($studies)-1]['onderdelen'][$counter-1]['sub'][$subcounter]['title'] = strip_tags(str_replace("&nbsp;", "", $title[1]));
											
				$studies[count($studies)-1]['onderdelen'][$counter-1]['sub'][$subcounter]['eenh_vereist'] = strip_tags($punten[1]);
				$studies[count($studies)-1]['onderdelen'][$counter-1]['sub'][$subcounter]['eenh_gevolgd'] = strip_tags($punten[2]);
				$studies[count($studies)-1]['onderdelen'][$counter-1]['sub'][$subcounter]['eenh_nodig'] = strip_tags($punten[3]);
		
				$studies[count($studies)-1]['onderdelen'][$counter-1]['sub'][$subcounter]['gem_vereist'] = strip_tags($gem[1]);
				$studies[count($studies)-1]['onderdelen'][$counter-1]['sub'][$subcounter]['gem_werkelijk'] = strip_tags($gem[2]);
			}
			
			$subcounter++;
		}
	}
}

?>
