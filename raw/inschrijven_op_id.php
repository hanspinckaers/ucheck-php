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

# http://localhost:3000/raw/inschrijven_op_id.php?nummer=1&aantal_check=2&id=3883881V4Y

include("setup.php");
include("user_info.php");

$id = $_GET['nummer'];
$gids_id = $_GET['q'];
$aantal = $_GET['aantal_check'];

$keep_cookie = true;

// $cookiefile = $DOCUMENT_ROOT."raw/cookies/".$user."_vakken".time().".txt";

include "details.php";

if(count($onderdelen) != $aantal)
{
	echo "<span style='color:orange;'>Er is iets misgegaan. Probeer het later opnieuw.</span> ";
	echo "BUG: Aantal klopt niet. aantal = ".count($onderdelen)." check: ".$aantal;
	exit();
}


if($demo){
	echo "<span style='color:orange;'>Inschrijven is niet ondersteund in het demo-account.</span>";
	exit();
}

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SNS_CUSTOMIZATIONS_NLD.SNS_SSENRL_CART.GBL';
$post_str = "ICAJAX=1&ICNAVTYPEDROPDOWN=0&ICType=Panel&ICElementNum=0&ICAction=SNS_DERIVED_CLASS_SELECT_PB&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=0&ICSID=okPpeuAW5HBVlLNOw8ao1i2ZvpAFw0Sxu%2F4hoevly90%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$24$=0100&SNS_SS_DERIVED_SELECTED\$chk$".$id."=Y&SNS_SS_DERIVED_SELECTED$".$id."=Y&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$173$=0100";
$html = req($url, $post_str, $cookiefile);

preg_match("/class='SSSMSGWARNINGTEXT' >(.*)<\/span>/", $html, $fout);

if(isset($fout[0]))
{
	$melding = $fout[1];
	echo "<span style='color:red;'>".$melding."</span>";
	die();
}

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES_2.SSR_SSENRL_CART.GBL?Page=SSR_SSENRL_CART&Action=A&ACAD_CAREER=CAR&EMPLID=0924121&ENRL_REQUEST_ID=&INSTITUTION=INST&STRM=TERM';
$post_str = "";
$html = req($url, $post_str, $cookiefile);

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES_2.SSR_SSENRL_CART.GBL?Page=SSR_SSENRL_CART&Action=A&ACAD_CAREER=CAR&EMPLID=0924121&ENRL_REQUEST_ID=&INSTITUTION=INST&STRM=TERM';
$post_str = "ICType=Panel&ICElementNum=0&ICAction=DERIVED_SSS_SCT_SSS_TERM_LINK&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=1&ICSID=0QsQOKMTB5SvMCz9%2B5nJU4mlD6xHj%2FRBSbwamcLk7iA%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&%23ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO%2423%24=0100&P_SELECT%24chk%240=N&DERIVED_SSTSNAV_SSTS_MAIN_GOTO%24154%24=0100";
$html = req($url, $post_str, $cookiefile);

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES.SSR_SSENRL_CART.GBL';
$post_str = "ICNAVTYPEDROPDOWN=0&ICType=Panel&ICElementNum=0&ICAction=DERIVED_SSS_SCT_SSR_PB_GO&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=0&ICSID=0QsQOKMTB5SvMCz9%2B5nJU4mlD6xHj%2FRBSbwamcLk7iA%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$23$=0100&SSR_DUMMY_RECV1$sels$0=".$year_index."&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$67$=0100";
$html = req($url, $post_str, $cookiefile);

preg_match("/class='SSSMSGWARNINGTEXT' >(.*)<\/span>/", $html, $fout);

if(isset($fout[0]))
{
	$melding = $fout[1];
	echo "<span style='color:red;'>".$melding."</span>";
	die();
}

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES.SSR_SSENRL_CART.GBL';
// $post_str = "ICType=Panel&ICElementNum=0&ICAction=DERIVED_REGFRM1_LINK_ADD_ENRL$114$&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=1&ICSID=okPpeuAW5HBVlLNOw8ao1i2ZvpAFw0Sxu%2F4hoevly90%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$23$=0100&P_SELECT\$chk$0=Y&P_SELECT$0=Y&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$155$=0100";
$post_str = "ICType=Panel&ICElementNum=0&ICAction=DERIVED_REGFRM1_LINK_ADD_ENRL%24123%24&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=1&ICSID=38%2F5K44UdFe38TTEcT3H78Lly1lW%2B1NHWkqk%2Fv7oy30%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&%23ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO%2423%24=0100&P_SELECT%24chk%240=Y&P_SELECT%240=Y&DERIVED_SSTSNAV_SSTS_MAIN_GOTO%24163%24=0100";
$html = req($url, $post_str, $cookiefile);

preg_match("/class='SSSMSGWARNINGTEXT' >(.*)<\/span>/", $html, $fout);

if(isset($fout[0]))
{
	$melding = $fout[1];
	echo "<span style='color:red;'>".$melding."</span>";
	die();
}

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES.SSR_SSENRL_CART.GBL';
// $post_str = "ICType=Panel&ICElementNum=0&ICAction=DERIVED_REGFRM1_SSR_PB_SUBMIT&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=1&ICSID=okPpeuAW5HBVlLNOw8ao1i2ZvpAFw0Sxu%2F4hoevly90%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$5$=0100&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$61$=0100";
$post_str = "ICType=Panel&ICElementNum=0&ICAction=DERIVED_REGFRM1_SSR_PB_SUBMIT&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=0&ICSID=38%2F5K44UdFe38TTEcT3H78Lly1lW%2B1NHWkqk%2Fv7oy30%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$5$=0100&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$70$=0100";
$result = req($url, $post_str, $cookiefile);

preg_match("/<B>(.*)./", $result, $matches);

if(isset($matches[0]))
{
	$melding = $matches[0];
	echo "<span style='color:black;'>".$melding."</span>";
} else {
	echo "<span style='color:orange;'>Het is niet bekend of het goed gegaan is, controleer onder inschrijvingen of deze eronder staat. </span>";
}

unlink($cookiefile);

try {
include('Galvanize.php');
$GA = new Galvanize('UA-4063156-10');
$GA->trackPageView("inschrijven_op_id.php", "inschrijven");
} catch (Exception $e) {}
?>