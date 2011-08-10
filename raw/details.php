<?
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

$year = $_GET['year'];

include "user_info.php";

$cookiefile = $_SERVER["DOCUMENT_ROOT"]."raw/cookies/".$user."_vakken".time().".txt";

$fields = array(
            'userid'=>$user,
            'pwd'=>$pwd,
            'timezoneOffset'=>'-60',
        );

$fp = fopen($cookiefile, "w");
if($fp) fclose($fp);

foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string,'&');

$ch = curl_init();

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SNS_CUSTOMIZATIONS_NLD.SNS_SSENRL_CART.GBL';

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; nl-nl) AppleWebKit/533.18.1 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5");
curl_setopt($ch,CURLOPT_URL,$url);

curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  

curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

curl_exec($ch);

//print_r(curl_getinfo($ch));

curl_close($ch);

$ch = curl_init();

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SNS_CUSTOMIZATIONS_NLD.SNS_SSENRL_CART.GBL';

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; nl-nl) AppleWebKit/533.18.1 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5");
curl_setopt($ch,CURLOPT_URL,$url);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_NOBODY, 1);

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);

curl_setopt($ch,CURLOPT_POST, 13);
curl_setopt($ch,CURLOPT_POSTFIELDS,"ICType=Panel&ICElementNum=0&ICAction=SNS_DERIVED_DESCR20&ICXPos=0&ICYPos=0&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=0&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$5$=0100&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$24$=0100");

curl_exec($ch);

//print_r(curl_getinfo($ch));

curl_close($ch);

unset($ch);

$ch = curl_init();

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SNS_CUSTOMIZATIONS_NLD.SNS_SSENRL_CART.GBL';

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; nl-nl) AppleWebKit/533.18.1 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5");
curl_setopt($ch,CURLOPT_URL,$url);

curl_setopt($ch, CURLOPT_NOBODY, 1);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);

curl_setopt($ch,CURLOPT_POST, 13);

if($year == "10")
{
curl_setopt($ch,CURLOPT_POSTFIELDS,"ICType=Panel&ICElementNum=0&ICAction=SNS_TERM_TBL_VW_DESCR$1&ICXPos=0&ICYPos=0&ICFocus=&ICSaveWarningFilter=0&ICChanged=0&ICResubmit=0&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$5$=0100&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$24$=0100
");
} else {
curl_setopt($ch,CURLOPT_POSTFIELDS,"ICType=Panel&ICElementNum=0&ICAction=SNS_TERM_TBL_VW_DESCR$0&ICXPos=0&ICYPos=0&ICFocus=&ICSaveWarningFilter=0&ICChanged=0&ICResubmit=0&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$5$=0100&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$24$=0100
");
}

curl_exec($ch);

//print_r(curl_getinfo($ch));

curl_close($ch);

unset($ch);

$ch = curl_init();

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SNS_CUSTOMIZATIONS_NLD.SNS_SSENRL_CART.GBL';

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; nl-nl) AppleWebKit/533.18.1 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5");
curl_setopt($ch,CURLOPT_URL,$url);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);

curl_setopt($ch, CURLOPT_NOBODY, 1);

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

curl_setopt($ch,CURLOPT_POST, 13);
curl_setopt($ch,CURLOPT_POSTFIELDS,"ICType=Panel&ICElementNum=0&ICAction=SNS_DERIVED_FETCH_PUSHBUTTON&ICXPos=0&ICYPos=0&ICFocus=&ICSaveWarningFilter=0&ICChanged=0&ICResubmit=0&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$5$=0100&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$24$=0100");

curl_exec($ch);

//print_r(curl_getinfo($ch));

curl_close($ch);

unset($ch);

$ch = curl_init();

/// was hier

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SNS_CUSTOMIZATIONS_NLD.SNS_SSENRL_CART.GBL';

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; nl-nl) AppleWebKit/533.18.1 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5");
curl_setopt($ch,CURLOPT_URL,$url);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);

curl_setopt($ch, CURLOPT_NOBODY, 1);

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

curl_setopt($ch,CURLOPT_POST, 14);
curl_setopt($ch,CURLOPT_POSTFIELDS,"ICType=Panel&ICElementNum=0&ICAction=SNS_CRSESRCH_WK_SEARCH_BTN&ICXPos=0&ICYPos=0&ICFocus=&ICSaveWarningFilter=0&ICChanged=0&ICResubmit=0&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$4$=0100&SNS_CRSESRCH_WK_SUBJECT$54$=&SNS_CRSESRCH_WK_CATALOG_NBR=".$_GET['q']."&SNS_CRSESRCH_WK_DESCR1=&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$59$\$chk$0=N&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$59$\$chk$1=N&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$59$\$chk$2=N&SNS_CRSESRCH_WK_SNS_SEL_OPERATOR=&SNS_CRSESRCH_WK_UNITS_MAXIMUM=0.00&SNS_CRSESRCH_WK_ACAD_ORG=&SNS_CRSESRCH_WK_SNS_CAR_SEL$69$\$chk$0=N&SNS_CRSESRCH_WK_SNS_CAR_SEL$69$\$chk$1=N&SNS_CRSESRCH_WK_SNS_CAR_SEL$69$\$chk$2=N&SNS_CRSESRCH_WK_LANGUAGE=&SNS_DERIVED_CRSE_ATTR=&SNS_DERIVED_CRSE_ATTR_VALUE=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$92$=0100");

$result = curl_exec($ch);

unset($ch);

$ch = curl_init();

/// was hier

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SNS_CUSTOMIZATIONS_NLD.SNS_SSENRL_CART.GBL';

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; nl-nl) AppleWebKit/533.18.1 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5");
curl_setopt($ch,CURLOPT_URL,$url);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_NOBODY, 1);
 
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

curl_setopt($ch,CURLOPT_POST, 14);
curl_setopt($ch,CURLOPT_POSTFIELDS,"ICType=Panel&ICElementNum=0&ICAction=CATALOG_NBR$0&ICXPos=0&ICYPos=0&ICFocus=&ICSaveWarningFilter=0&ICChanged=0&ICResubmit=0&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$4$=0100&SNS_CRSESRCH_WK_SUBJECT$54$=&SNS_CRSESRCH_WK_CATALOG_NBR=".$_GET['q']."&SNS_CRSESRCH_WK_DESCR1=&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$59$\$chk$0=N&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$59$\$chk$1=N&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$59$\$chk$2=N&SNS_CRSESRCH_WK_SNS_SEL_OPERATOR=&SNS_CRSESRCH_WK_UNITS_MAXIMUM=0.00&SNS_CRSESRCH_WK_ACAD_ORG=&SNS_CRSESRCH_WK_SNS_CAR_SEL$69$\$chk$0=N&SNS_CRSESRCH_WK_SNS_CAR_SEL$69$\$chk$1=N&SNS_CRSESRCH_WK_SNS_CAR_SEL$69$\$chk$2=N&SNS_CRSESRCH_WK_LANGUAGE=&SNS_DERIVED_CRSE_ATTR=&SNS_DERIVED_CRSE_ATTR_VALUE=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$92$=0100");

// print_r(curl_getinfo($ch));
$result = curl_exec($ch);

unset($ch);

$ch = curl_init();

/// was hier

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SNS_CUSTOMIZATIONS_NLD.SNS_SSENRL_CART.GBL';

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; nl-nl) AppleWebKit/533.18.1 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5");
curl_setopt($ch,CURLOPT_URL,$url);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

curl_setopt($ch,CURLOPT_POST, 14);
if($year=="10")
{
curl_setopt($ch,CURLOPT_POSTFIELDS,"ICType=Panel&ICElementNum=0&ICAction=DERIVED_SSS_SCT_SSR_PB_GO&ICXPos=0&ICYPos=0&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=0&ICSID=jWTycNhQZ2gJ&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$22$=0100&SSR_DUMMY_RECV1\$sels$0=1&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$66$=0100");
} else {
curl_setopt($ch,CURLOPT_POSTFIELDS,"ICType=Panel&ICElementNum=0&ICAction=DERIVED_SSS_SCT_SSR_PB_GO&ICXPos=0&ICYPos=0&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=0&ICSID=jWTycNhQZ2gJ&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$22$=0100&SSR_DUMMY_RECV1\$sels$0=0&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$66$=0100");
}
// print_r(curl_getinfo($ch));
$result = curl_exec($ch);

unset($ch);

$arr = explode("<tr><td class='PSLEVEL1GRIDLABEL'  align='left'>Samenstelling</td></tr>", $result);

$t_onderdelen = explode("<tr valign='center'>", $arr[1]);
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

$counter == 0;
$headers = array();

foreach($t_onderdelen as $onderdeel)
{
	if($counter == 1)
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
					preg_match("/' >(.*)<\/span>/", $td, $td_out);
					
					if($td_out[1])
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
							preg_match("/>(.*)<\/a>/", $td, $td_out);
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

?>