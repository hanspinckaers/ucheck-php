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

if(!$keep_cookie)
{
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
}

$year = $_GET['year'];

include "user_info.php";

$cookiefile = $DOCUMENT_ROOT."raw/cookies/".$user."_vakken".time().".txt";

$fields = array(
            'userid'=>$user,
            'pwd'=>$pwd,
            'timezoneOffset'=>'-60',
        );

$fp = fopen($cookiefile, "w");
if($fp) fclose($fp);

foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string,'&');

/////////////////////////////////////////////

// BACHELOR

// request winkelwagen
$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES_2.SSR_SSENRL_CART.GBL?Page=SSR_SSENRL_CART&Action=A&ACAD_CAREER=10&INSTITUTION=LEI01&STRM=2110';
$result = req($url, $fields_string, $cookiefile);

preg_match_all("/chk\\$[0-9]+'/", $result, $onderdelen);

// empty winkelwagen
$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES_2.SSR_SSENRL_CART.GBL?Page=SSR_SSENRL_CART&Action=A&ACAD_CAREER=10&INSTITUTION=LEI01&STRM=2110';
$post_str = "ICAJAX=1&ICNAVTYPEDROPDOWN=0&ICType=Panel&ICElementNum=0&ICAction=DERIVED_REGFRM1_SSR_PB_DELETE%24121%24&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=0&ICSID=JOBdk%2FU0EaVFbhG6Nm%2FKEOMwts2pQycs3gyT%2BRIZXB8%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$23$=0100";

$count = 0;
foreach($onderdelen[0] as $onderdeel)
{
	$post_str .= "&P_SELECT\$chk$$count=Y&P_SELECT$$count=Y";
	$count++;
}

$post_str .= "&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$163$=0100";
$result = req($url, $post_str, $cookiefile);

// MASTER

// request winkelwagen
$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES_2.SSR_SSENRL_CART.GBL?Page=SSR_SSENRL_CART&Action=A&ACAD_CAREER=15&INSTITUTION=LEI01&STRM=2110';
$result = req($url, $fields_string, $cookiefile);

preg_match_all("/chk\\$[0-9]+'/", $result, $onderdelen);

// empty winkelwagen
$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES_2.SSR_SSENRL_CART.GBL?Page=SSR_SSENRL_CART&Action=A&ACAD_CAREER=15&INSTITUTION=LEI01&STRM=2110';
$post_str = "ICAJAX=1&ICNAVTYPEDROPDOWN=0&ICType=Panel&ICElementNum=0&ICAction=DERIVED_REGFRM1_SSR_PB_DELETE%24121%24&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=0&ICSID=JOBdk%2FU0EaVFbhG6Nm%2FKEOMwts2pQycs3gyT%2BRIZXB8%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$23$=0100&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$163$=0100";

$count = 0;
foreach($onderdelen[0] as $onderdeel)
{
	$post_str .= "&P_SELECT\$chk$$count=Y&P_SELECT$$count=Y";
	$count++;
}

$post_str .= "&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$163$=0100";
$result = req($url, $post_str, $cookiefile);

/////////////////////////////////////////////

// new cookie for details
$cookiefile = $DOCUMENT_ROOT."raw/cookies/".$user."_vakken".time().".txt";

// request inschrijven
$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SNS_CUSTOMIZATIONS_NLD.SNS_SSENRL_CART.GBL';
req($url, $fields_string, $cookiefile);

// selecteer inschrijfmethode
$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SNS_CUSTOMIZATIONS_NLD.SNS_SSENRL_CART.GBL';
$post_str = "ICType=Panel&ICElementNum=0&ICAction=SNS_DERIVED_DESCR20&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=1&ICSID=VWJH4XuwW5DikH2UFpQZhPt5WEK5u5nlWMeLNWNWIJI%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$6$=0100&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$25$=0100";
req($url, $post_str, $cookiefile);

// studiejaar
$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SNS_CUSTOMIZATIONS_NLD.SNS_SSENRL_CART.GBL';
if($year == "11") $index = "1";
elseif($year == "12") $index = "0";
$post_str = "ICAJAX=1&ICNAVTYPEDROPDOWN=0&ICType=Panel&ICElementNum=0&ICAction=SNS_TERM_TBL_VW_DESCR%24$index&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=0&ICResubmit=0&ICSID=PTVRqgpo%2Buc28JPRndVg9OJHKpnPosqu%2BjUfl%2FQ5ieo%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$6$=0100&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$25$=0100";
req($url, $post_str, $cookiefile);

// zoeken
$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SNS_CUSTOMIZATIONS_NLD.SNS_SSENRL_CART.GBL';
$post_str = "ICType=Panel&ICElementNum=0&ICAction=SNS_DERIVED_FETCH_PUSHBUTTON&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=0&ICResubmit=1&ICSID=VWJH4XuwW5DikH2UFpQZhPt5WEK5u5nlWMeLNWNWIJI%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$6$=0100&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$25$=0100";
req($url, $post_str, $cookiefile);

// zoeken invullen
$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SNS_CUSTOMIZATIONS_NLD.SNS_SSENRL_CART.GBL';
$post_str = "ICAJAX=1&ICNAVTYPEDROPDOWN=0&ICType=Panel&ICElementNum=0&ICAction=SNS_CRSESRCH_WK_SEARCH_BTN&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=0&ICResubmit=0&ICSID=hhq125A6NVo2MnE%2FWKjD01%2B7%2B9Upy%2F2VtOGXVAoYYlk%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$5$=0100&SNS_CRSESRCH_WK_SUBJECT$55$=&SNS_CRSESRCH_WK_CATALOG_NBR=".$_GET['q']."&SNS_CRSESRCH_WK_DESCR1=&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$\$chk$0=Y&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$\$0=Y&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$\$chk$1=N&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$\$chk$2=N&SNS_CRSESRCH_WK_SNS_SEL_OPERATOR=&SNS_CRSESRCH_WK_UNITS_MAXIMUM=0.00&SNS_CRSESRCH_WK_ACAD_ORG=&SNS_CRSESRCH_WK_SNS_CAR_SEL$70$\$chk$0=N&SNS_CRSESRCH_WK_SNS_CAR_SEL$70$\$chk$1=N&SNS_CRSESRCH_WK_SNS_CAR_SEL$70$\$chk$2=N&SNS_DERIVED_SNS_LANGUAGE=&SNS_DERIVED_CRSE_ATTR=&SNS_DERIVED_CRSE_ATTR_VALUE=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$95$=0100";
// $post_str = "ICAJAX=1&ICNAVTYPEDROPDOWN=0&ICType=Panel&ICElementNum=0&ICAction=SNS_CRSESRCH_WK_SEARCH_BTN&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=0&ICResubmit=0&ICSID=VWJH4XuwW5DikH2UFpQZhPt5WEK5u5nlWMeLNWNWIJI%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$5$=0100&SNS_CRSESRCH_WK_SUBJECT$55$=&SNS_CRSESRCH_WK_CATALOG_NBR=".$_GET['q']."&SNS_CRSESRCH_WK_DESCR1=&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$\$chk$0=Y&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$$0=Y&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$\$chk$1=N&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$\$chk$2=N&SNS_CRSESRCH_WK_SNS_SEL_OPERATOR=&SNS_CRSESRCH_WK_UNITS_MAXIMUM=0.00&SNS_CRSESRCH_WK_ACAD_ORG=&SNS_CRSESRCH_WK_SNS_CAR_SEL\$70$\$chk$0=N&SNS_CRSESRCH_WK_SNS_CAR_SEL\$70$\$chk$1=N&SNS_CRSESRCH_WK_SNS_CAR_SEL\$70$\$chk$2=N&SNS_CRSESRCH_WK_LANGUAGE=&SNS_DERIVED_CRSE_ATTR=&SNS_DERIVED_CRSE_ATTR_VALUE=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$94$=0100";
req($url, $post_str, $cookiefile);

// klik op resultaat
$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SNS_CUSTOMIZATIONS_NLD.SNS_SSENRL_CART.GBL';
$post_str = "ICType=Panel&ICElementNum=0&ICAction=DESCR50$0&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=0&ICResubmit=1&ICSID=VWJH4XuwW5DikH2UFpQZhPt5WEK5u5nlWMeLNWNWIJI%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$5$=0100&SNS_CRSESRCH_WK_SUBJECT$55$=&SNS_CRSESRCH_WK_CATALOG_NBR=3883881V2Y&SNS_CRSESRCH_WK_DESCR1=&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$\$chk$0=N&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$\$chk$1=N&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$\$chk$2=N&SNS_CRSESRCH_WK_SNS_SEL_OPERATOR=&SNS_CRSESRCH_WK_UNITS_MAXIMUM=0.00&SNS_CRSESRCH_WK_ACAD_ORG=&SNS_CRSESRCH_WK_SNS_CAR_SEL\$70$\$chk$0=N&SNS_CRSESRCH_WK_SNS_CAR_SEL\$70$\$chk$1=N&SNS_CRSESRCH_WK_SNS_CAR_SEL\$70$\$chk$2=N&SNS_CRSESRCH_WK_LANGUAGE=&SNS_DERIVED_CRSE_ATTR=&SNS_DERIVED_CRSE_ATTR_VALUE=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$94$=0100";
$result = req($url, $post_str, $cookiefile);

// klik doorgaan bij jaarkeuze
$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SNS_CUSTOMIZATIONS_NLD.SNS_SSENRL_CART.GBL';
// $post_str = "ICAJAX=1&ICNAVTYPEDROPDOWN=0&ICType=Panel&ICElementNum=0&ICAction=DERIVED_SSS_SCT_SSR_PB_GO&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=0&ICSID=PTVRqgpo%2Buc28JPRndVg9OJHKpnPosqu%2BjUfl%2FQ5ieo%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$23$=0100&SSR_DUMMY_RECV1\$sels$0=1&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$67$=0100";

preg_match_all("/value='(\d)' checked='checked'/", $result, $sel);

$year_index = count($sel[1]) - 1;

$post_str = "ICType=Panel&ICElementNum=0&ICAction=DERIVED_SSS_SCT_SSR_PB_GO&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=1&ICSID=ZiDqU3%2FOo5ELjPoDyqsk8hxAP2y%2BFwMcLGBALkdVyUA%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&%23ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$23$=0100&SSR_DUMMY_RECV1\$sels$0=".$year_index."&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$67$=0100";
$result = req($url, $post_str, $cookiefile);

$arr = explode("Samenstelling", $result);
$t_onderdelen = explode("<tr id='trSNS_CLASS_TR_VW$0_row", $arr[1]);

$onderdelen = array();

/*
<th scope='col' width='15' class='PSLEVEL1GRIDCOLUMNHDR' >&nbsp;</th>
<th scope='col' width='24' align='CENTER' class='PSLEVEL1GRIDCOLUMNHDR' >&nbsp;</th>
<th scope='col' width='21' align='left' class='PSLEVEL1GRIDCOLUMNHDR' >&nbsp;</th>
<th scope='col' width='242' align='left' class='PSLEVEL1GRIDCOLUMNHDR' >&nbsp;</th>
<th scope='col' width='80' align='left' class='PSLEVEL1GRIDCOLUMNHDR' ><a name='SNS_CLASS_TR_VW$srt6$0' tabindex='372' class='PSLEVEL1GRIDCOLUMNHDR' href="javascript:submitAction_win0(document.win0,'SNS_CLASS_TR_VW$srt6$0');" title="Klik op kolomkop om in oplopende volgorde te sorteren">Vakgebied</a></th>
<th scope='col' width='200' align='left' class='PSLEVEL1GRIDCOLUMNHDR' ><a name='SNS_CLASS_TR_VW$srt8$0' tabindex='374' class='PSLEVEL1GRIDCOLUMNHDR' href="javascript:submitAction_win0(document.win0,'SNS_CLASS_TR_VW$srt8$0');" title="Klik op kolomkop om in oplopende volgorde te sorteren">Omschrijving</a></th>
<th scope='col' width='78' align='CENTER' class='PSLEVEL1GRIDCOLUMNHDR' ><a name='SNS_CLASS_TR_VW$srt10$0' tabindex='376' class='PSLEVEL1GRIDCOLUMNHDR' href="javascript:submitAction_win0(document.win0,'SNS_CLASS_TR_VW$srt10$0');" title="Klik op kolomkop om in oplopende volgorde te sorteren">Verplicht</a></th>
<th scope='col' width='70' align='left' class='PSLEVEL1GRIDCOLUMNHDR' ><a name='SNS_CLASS_TR_VW$srt12$0' tabindex='378' class='PSLEVEL1GRIDCOLUMNHDR' href="javascript:submitAction_win0(document.win0,'SNS_CLASS_TR_VW$srt12$0');" title="Klik op kolomkop om in oplopende volgorde te sorteren">Eenheden</a></th>
<th scope='col' width='78' align='left' class='PSLEVEL1GRIDCOLUMNHDR' ><a name='SNS_CLASS_TR_VW$srt13$0' tabindex='379' class='PSLEVEL1GRIDCOLUMNHDR' href="javascript:submitAction_win0(document.win0,'SNS_CLASS_TR_VW$srt13$0');" title="Klik op kolomkop om in oplopende volgorde te sorteren">Sessie</a></th>
<th scope='col' width='100' align='left' class='PSLEVEL1GRIDCOLUMNHDR' ><a name='SNS_CLASS_TR_VW$srt16$0' tabindex='382' class='PSLEVEL1GRIDCOLUMNHDR' href="javascript:submitAction_win0(document.win0,'SNS_CLASS_TR_VW$srt16$0');" title="Klik op kolomkop om in oplopende volgorde te sorteren">Nr studieactiv.</a></th>
<th scope='col' width='41' align='left' class='PSLEVEL1GRIDCOLUMNHDR' >Status</th>
*/

$counter = 0;
$headers = array();

foreach($t_onderdelen as $onderdeel)
{
	if($counter == 0)
	{
		//TABLE HEADERS!!
		preg_match_all("/<th scope='col'.* >(.*)<\/th>/", $onderdeel, $out);
			
		foreach($out[1] as $th)
		{
			$pos = strpos($th, "<a");
						
			if($pos === false)
			{
				$headers[] = (is_array($th)) ? $th[0] : $th;
			} else {
				preg_match("/>(.*)<\/a>/", $th, $a_parsed);
				$headers[] = $a_parsed[1];
			}
		}				
	} else {
	
		$tds = explode("<td ", $onderdeel);
	
		$td_counter = 0;
	
		foreach($tds as $td)
		{		
			$check_pos = strpos($td, "type='checkbox'");
			$error_pos = strpos($td, "name='SNS_SHOW_ERRORS");
			$id_pos = strpos($td, "\"text-align:left\"");			
			
			if($td_counter == 0 || $td_counter == 1)
			{
				//niks is nummer
			} 
			else if($check_pos !== false) 
			{
				$pos = strpos($td, "disabled='disabled'");
				
				if($pos === false) {
				 // string needle NOT found in haystack
					 $new_onderdeel['enabled'] = '1';
				} else {
					 $new_onderdeel['enabled'] = '0';			
				}
			}
			else if($error_pos !== false) 
			{
				preg_match("/title='(.*)'b/", $td, $error_out);
				
				$new_onderdeel['error'] = $error_out[1];
			}
			else if($id_pos !== false)
			{
				//echo $td;
				preg_match("/\"\/?>([0-9A-Za-z]*)<\/div>/", $td, $td_out);
				$new_onderdeel['id'] = $td_out[1];				
			}
			else {
				if($td_counter <= count($headers))
				{	
					//left or center
					preg_match("/<span.*'>(.*)<\/span>/", $td, $td_out);
																	
					$link_pos = strpos($td, "</a>");
										
					if($link_pos !== false)
					{
						preg_match("/<a.*>(.*)<\/a>/", $td, $td_out);
						$new_onderdeel[$headers[$td_counter-1]] = $td_out[1];	
					} 
					else if($td_out[1])
					{
						$new_onderdeel[$headers[$td_counter-1]] = $td_out[1];
					} else {
						//link?
						$link_pos = strpos($td, "<a");
						
						//status?
						$status_pos = strpos($td, "width=\"16\" height=\"16\" alt=\"");
						
						$leeg_pos = strpos($td, "&nbsp;");
						
						if($link_pos !== false)
						{
							preg_match("/>(.*)<\/a>/", $td_out[1], $td_out);
							$new_onderdeel[$headers[$td_counter-1]] = $td_out[1];
						} 
						else if($status_pos !== false)
						{
							preg_match("/alt=\"(.*)\" /", $td, $td_out);
							$new_onderdeel[$headers[$td_counter-1]] = $td_out[1];
						} 
						else if($leeg_pos !== false)
						{
							$new_onderdeel[$headers[$td_counter-1]] = "";
						}
						else {
							//$new_onderdeel[$headers[$td_counter-1]] = $td;
							$new_onderdeel[$headers[$td_counter-1]] = "";					
						}
					}
					
				} else {
					break;
				}
			}
		
			$td_counter++;
		}	
	}
				
	//er is geen checkbox			
	if(!$new_onderdeel['enabled'])
	{
		$new_onderdeel['enabled'] = '0';
	}			
				
	
	if(count($new_onderdeel) > 1)
	{
		$onderdelen[] = $new_onderdeel;
	}
		
	$counter++;
}

//print_r($onderdelen);

if(!isset($keep_cookie))
{
	unlink($cookiefile);

	try {
	include('Galvanize.php');
	$GA = new Galvanize('UA-4063156-10');
	$GA->trackPageView("details.php", "details");
	} catch (Exception $e) {}
	}

?>