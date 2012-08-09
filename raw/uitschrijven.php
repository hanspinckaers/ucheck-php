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

$cookiefile = $DOCUMENT_ROOT."raw/cookies/".$user."_cijfersinschrijvingen.txt";

$fp = fopen($cookiefile, "w");

$year = $_GET['year'];

if(!$fp)
{
	echo "no cookie file";
}
fclose($fp);

if($demo)
{
	echo "{'respons': 'Het is niet mogelijk onderdelen uit te schrijven in het demo account'}";
	exit();
}

$fields = array(
            'userid'=>$user,
            'pwd'=>$pwd,
            'timezoneOffset'=>'-60',
        );

//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string,'&');

$y = ($year == '11') ? '10' : '21';
$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES.SSR_SSENRL_DROP.GBL?Page=SSR_SSENRL_DROP&Action=A&ACAD_CAREER=10&INSTITUTION=LEI01&STRM=21'.$y;
$html = req($url, $fields_string, $cookiefile);

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES.SSR_SSENRL_DROP.GBL';
$post ="ICType=Panel&ICElementNum=0&ICAction=DERIVED_REGFRM1_LINK_DROP_ENRL&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=1&ICSID=VWJH4XuwW5DikH2UFpQZhPt5WEK5u5nlWMeLNWNWIJI%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$5$=0100&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$105$=0100";

$vakken = explode(",", $_GET['q']);

foreach($vakken as $vak)
{
	if($vak && $vak != ""){
		$post .= "&DERIVED_REGFRM1_SSR_SELECT\$chk".$vak."=Y&DERIVED_REGFRM1_SSR_SELECT".$vak."=Y";
	}
}

$result = req($url, $post, $cookiefile);

preg_match("/class='SSSMSGWARNINGTEXT' >(.*)<\/span>/", $result, $matches);
$matches[0] = $matches[1];

if(isset($matches[1]))
{
	// error found
} else {
	$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES.SSR_SSENRL_DROP.GBL';
	$post_str = "Type=Panel&ICElementNum=0&ICAction=DERIVED_REGFRM1_SSR_PB_SUBMIT&ICXPos=0&ICYPos=1267&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=0&ICSID=qcNpMdLKb6My&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$4$=9999&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$100$=9999";
	$result = req($url, $post_str, $cookiefile);
		
	preg_match_all("/<B>(.*)./", $result, $matches);
}	

unlink($cookiefile);

try {
include('Galvanize.php');
$GA = new Galvanize('UA-4063156-10');
$GA->trackPageView("uitschrijven.php", "uitschrijven");
} catch (Exception $e) {}
?>