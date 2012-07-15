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

setlocale(LC_ALL, 'nl_NL');

date_default_timezone_set("Europe/Berlin");

if(date("i") < 10)
{
	$logfilename = "/home/geneesleer/ucheck/scrapeusis/logs/".strftime('%d-%h-%Y', time())."_1.txt";
 	
 	// 2011 - 2012
 	$years = array("11");
} 
else {	
	$logfilename = "/home/geneesleer/ucheck/scrapeusis/logs/".strftime('%d-%h-%Y', time())."_2.txt";
	
	// year f = 2011 - 2012, maar niet geselecteerd op onderwijseenheid, maar alle resultaten van een studie
	$years = array("f");
}

// oude studies
// $studies = array("ARCH", "W%26N","LA%26S","ALG","ARAB","ARCH","ASA","BSKE","BFW","BIO","BIOM","BOEK","CHE","CLANEC","CANS","DUITS","DUTCHST","EGYPTE","ENGELS","EUS","FGWALG","PHOTOGS","FRANS","GNK","GS","GODG","GRIEKLAT","HJS","HERV","INDECO","INF","ISLM","ISLT","ITAL","JOURNIME","FGWKERN","FDK","KG","LAAS","LEIALG","LO","FLEBYVAK","FLEALG","LETTERK","LST","LITW","MANAGEME","MIDOOST","MST","MUZIEK","NSC","NTK","NED","NP","OCMW","PEDA","POWE","PKST","PREUNIV","PSYC","LAW","SEMI","SLAV","STK","TCIA","TCMA","TAALK","TW","INDTIBET","INDONES","AFRIKA","TCLA","CHINA","JAPAN","KOREA","TCC","THEA","TURK","VIET","VTW","LAVA","WYSB","WSK","ZZOAZIE");

$studies = array("ALG","ARAB","ARCH","ASA","ASS","BSKE","BFW","BIO","BIOM","BOEK","CHE","CLANEC","CANS","DUITS","DUTCHST","EGYPTE","ENGELS","EUS","FGWALG","W&amp;N","PHOTOGS","FRANS","GNK","GS","GODG","GRIEKLAT","HJS","HERV","INDECO","INF","INTST","ISLM","ISLT","ITAL","JOURNIME","FGWKERN","FDK","KG","LAAS","LEIALG","LO","FLEBYVAK","FLEALG","LETTERK","LA&amp;S","LST","LING","LITST","LITW","MANAGEME","MEDIA","MIDOOST","MST","MUZIEK","NSC","NTK","NED","NP","NOAMST","OCMW","CAC","PEDA","POWE","PKST","PREUNIV","PSYC","LAW","SEMI","SLAV","STK","TCIA","TCMA","TAALK","TW","INDTIBET","INDONES","AFRIKA","TCLA","CHINA","JAPAN","KOREA","TCC","THEA","TURK","VIET","VTW","LAVA","WYSB","WSK","ZZOAZIE");

$cookiefile = "/home/geneesleer/ucheck/raw/"."cookies/s0924121_vakken.txt";

$logfile = fopen($logfilename, 'w') or die("can't open file");

if(file_exists("/home/geneesleer/ucheck/geheim/ucheck.php"))
{	
	include("/home/geneesleer/ucheck/geheim/ucheck.php");
	
	$fields = array(
	            'userid'=>'s0924121',
	            'pwd'=>$pass_hans,
	            'timezoneOffset'=>'-60',
	        );	
}
else {
	$fields = array(
	            'userid'=>'<s0924121>',
	            'pwd'=>'<wachtwoord>',
	            'timezoneOffset'=>'-60',
	        );
}


foreach($years as $year)
{

$error = false;

$start_total = time();

fwrite($logfile, "We gaan beginnen \n \n");

foreach($studies as $studie)
{

fwrite($logfile, "\n----------\n");
fwrite($logfile, $studie."\n\n");

echo "\n----------\n";
echo $studie."\n\n";

$start = time();

$fp = fopen($cookiefile, "w");
if($fp) fclose($fp);

foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string,'&');

sleep(1);

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

// curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

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

// curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);

curl_setopt($ch,CURLOPT_POST, 13);
curl_setopt($ch,CURLOPT_POSTFIELDS,"ICType=Panel&ICElementNum=0&ICAction=SNS_DERIVED_DESCR20&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=1&ICSID=VWJH4XuwW5DikH2UFpQZhPt5WEK5u5nlWMeLNWNWIJI%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$6$=0100&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$25$=0100");

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

// curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);

curl_setopt($ch,CURLOPT_POST, 13);


curl_setopt($ch,CURLOPT_POSTFIELDS,"ICType=Panel&ICElementNum=0&ICAction=SNS_DERIVED_FETCH_PUSHBUTTON&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=0&ICResubmit=1&ICSID=VWJH4XuwW5DikH2UFpQZhPt5WEK5u5nlWMeLNWNWIJI%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$6$=0100&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$25$=0100");

curl_exec($ch);
//print_r(curl_getinfo($ch));

curl_close($ch);

unset($ch);

sleep(1);

$ch = curl_init();

sleep(1);

// FETCHING ONDERDELEN!!!

$ch = curl_init();

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SNS_CUSTOMIZATIONS_NLD.SNS_SSENRL_CART.GBL';

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; nl-nl) AppleWebKit/533.18.1 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5");
curl_setopt($ch,CURLOPT_URL,$url);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($ch, CURLOPT_TIMEOUT, 120);

curl_setopt($ch,CURLOPT_POST, 28);

if($year == "f")
{
curl_setopt($ch,CURLOPT_POSTFIELDS,"ICAJAX=1&ICNAVTYPEDROPDOWN=0&ICType=Panel&ICElementNum=0&ICAction=SNS_CRSESRCH_WK_SEARCH_BTN&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=0&ICResubmit=0&ICSID=FNtHY0VXBaV0lLnbK75%2Bmz93HcvCjQuhxes8ReR%2FOTQ%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$5$=0100&SNS_CRSESRCH_WK_SUBJECT$55$=".$studie."&SNS_CRSESRCH_WK_CATALOG_NBR=&SNS_CRSESRCH_WK_DESCR1=&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$\$chk$0=N&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$\$chk$1=N&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$\$chk$2=N&SNS_CRSESRCH_WK_SNS_SEL_OPERATOR=&SNS_CRSESRCH_WK_UNITS_MAXIMUM=0.00&SNS_CRSESRCH_WK_ACAD_ORG=&SNS_CRSESRCH_WK_SNS_CAR_SEL\$70$\$chk$0=N&SNS_CRSESRCH_WK_SNS_CAR_SEL\$70$\$chk$1=N&SNS_CRSESRCH_WK_SNS_CAR_SEL\$70$\$chk$2=N&SNS_CRSESRCH_WK_LANGUAGE=&SNS_DERIVED_CRSE_ATTR=&SNS_DERIVED_CRSE_ATTR_VALUE=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$94$=0100");
} 
else 
{
curl_setopt($ch,CURLOPT_POSTFIELDS,"ICAJAX=1&ICNAVTYPEDROPDOWN=0&ICType=Panel&ICElementNum=0&ICAction=SNS_CRSESRCH_WK_SEARCH_BTN&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=1&ICResubmit=0&ICSID=FNtHY0VXBaV0lLnbK75%2Bmz93HcvCjQuhxes8ReR%2FOTQ%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$5$=0100&SNS_CRSESRCH_WK_SUBJECT$55$=".$studie."&SNS_CRSESRCH_WK_CATALOG_NBR=&SNS_CRSESRCH_WK_DESCR1=&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$\$chk$0=Y&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$$0=Y&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$\$chk$1=N&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$\$chk$2=N&SNS_CRSESRCH_WK_SNS_SEL_OPERATOR=&SNS_CRSESRCH_WK_UNITS_MAXIMUM=0.00&SNS_CRSESRCH_WK_ACAD_ORG=&SNS_CRSESRCH_WK_SNS_CAR_SEL\$70$\$chk$0=N&SNS_CRSESRCH_WK_SNS_CAR_SEL\$70$\$chk$1=N&SNS_CRSESRCH_WK_SNS_CAR_SEL\$70$\$chk$2=N&SNS_CRSESRCH_WK_LANGUAGE=&SNS_DERIVED_CRSE_ATTR=&SNS_DERIVED_CRSE_ATTR_VALUE=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$94$=0100");
}
$result = curl_exec($ch);
// print_r(curl_getinfo($ch));

curl_close($ch);

unset($ch);

sleep(1);

$ch = curl_init();

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SNS_CUSTOMIZATIONS_NLD.SNS_SSENRL_CART.GBL';

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; nl-nl) AppleWebKit/533.18.1 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5");
curl_setopt($ch,CURLOPT_URL,$url);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($ch, CURLOPT_TIMEOUT, 120);

curl_setopt($ch,CURLOPT_POST, 28);


if($year == "f")
{
curl_setopt($ch,CURLOPT_POSTFIELDS,"ICAJAX=1&ICNAVTYPEDROPDOWN=0&ICType=Panel&ICElementNum=0&ICAction=RESULTS%24hviewall%240&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=0&ICResubmit=0&ICSID=FNtHY0VXBaV0lLnbK75%2Bmz93HcvCjQuhxes8ReR%2FOTQ%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$5$=0100&SNS_CRSESRCH_WK_SUBJECT$55$=".$studie."&SNS_CRSESRCH_WK_CATALOG_NBR=&SNS_CRSESRCH_WK_DESCR1=&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$\$chk$0=N&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$\$chk$1=N&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$\$chk$2=N&SNS_CRSESRCH_WK_SNS_SEL_OPERATOR=&SNS_CRSESRCH_WK_UNITS_MAXIMUM=0.00&SNS_CRSESRCH_WK_ACAD_ORG=&SNS_CRSESRCH_WK_SNS_CAR_SEL\$70$\$chk$0=N&SNS_CRSESRCH_WK_SNS_CAR_SEL\$70$\$chk$1=N&SNS_CRSESRCH_WK_SNS_CAR_SEL\$70$\$chk$2=N&SNS_CRSESRCH_WK_LANGUAGE=&SNS_DERIVED_CRSE_ATTR=&SNS_DERIVED_CRSE_ATTR_VALUE=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$94$=0100");
} 
else 
{
curl_setopt($ch,CURLOPT_POSTFIELDS,"ICAJAX=1&ICNAVTYPEDROPDOWN=0&ICType=Panel&ICElementNum=0&ICAction=RESULTS%24hviewall%240&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=1&ICResubmit=0&ICSID=FNtHY0VXBaV0lLnbK75%2Bmz93HcvCjQuhxes8ReR%2FOTQ%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$5$=0100&SNS_CRSESRCH_WK_SUBJECT$55$=".$studie."&SNS_CRSESRCH_WK_CATALOG_NBR=&SNS_CRSESRCH_WK_DESCR1=&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$\$chk$0=Y&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$$0=Y&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$\$chk$1=N&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$\$chk$2=N&SNS_CRSESRCH_WK_SNS_SEL_OPERATOR=&SNS_CRSESRCH_WK_UNITS_MAXIMUM=0.00&SNS_CRSESRCH_WK_ACAD_ORG=&SNS_CRSESRCH_WK_SNS_CAR_SEL\$70$\$chk$0=N&SNS_CRSESRCH_WK_SNS_CAR_SEL\$70$\$chk$1=N&SNS_CRSESRCH_WK_SNS_CAR_SEL\$70$\$chk$2=N&SNS_CRSESRCH_WK_LANGUAGE=&SNS_DERIVED_CRSE_ATTR=&SNS_DERIVED_CRSE_ATTR_VALUE=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$94$=0100");
}

$result = curl_exec($ch);
// print_r(curl_getinfo($ch));

$arr = explode("class='PSLEVEL1GRID' style='border-style:none' >", $result);

$onderdelen = array();

$studieonderdelen = explode("<tr id='trRESULTS$0_row",$arr[1]);

foreach($studieonderdelen as $studieonderdeel)
{	
	$new_studieonderdeel = array();
	preg_match_all("/<a.*>(.*)<\/a>/", $studieonderdeel, $values);
	
	if(count($values[1]) > 4)
	{
		$new_studieonderdeel['studie'] = $values[1][0];
		$new_studieonderdeel['gidsnummer'] = $values[1][1];
		$new_studieonderdeel['titel'] = $values[1][2];
		$new_studieonderdeel['eenheden'] = $values[1][3];
		
		if(count($values[1]) == 5)
		{
			$new_studieonderdeel['loopbaan'] = $values[1][4];		
		} else {
			$new_studieonderdeel['type'] = $values[1][4];
			$new_studieonderdeel['loopbaan'] = $values[1][5];
		}
	
	
		$vak_pos = strpos($new_studieonderdeel['titel'], "Individueel vak");
			
		if($vak_pos === false)	
		{
			$onderdelen[] = $new_studieonderdeel;			
		}
	
	} else {
		if(count($values[1]) > 0) print_r($values[1]);
	}
}


preg_match("/<span class='PSGRIDCOUNTER' >1-[0-9]+ van (.*)<\/span>/", $result, $out);

unset($onderdelen[0]);

// print_r($out);

$counter = 0;

// FETCHING ONDERDELEN!!!

if($out[1])
{

$run = ceil($out[1]/100)-1;

while($run > 0)
{	
	unset($ch);
	
	sleep(1);
			
	$ch = curl_init();
	
	$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SNS_CUSTOMIZATIONS_NLD.SNS_SSENRL_CART.GBL';
	
	//set the url, number of POST vars, POST data
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; nl-nl) AppleWebKit/533.18.1 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5");
	curl_setopt($ch,CURLOPT_URL,$url);
	
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	 
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
	
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	curl_setopt($ch, CURLOPT_TIMEOUT, 120);
	
	curl_setopt($ch,CURLOPT_POST, 28);
	
	if($year == "f")
	{
		curl_setopt($ch,CURLOPT_POSTFIELDS,"ICAJAX=1&ICNAVTYPEDROPDOWN=0&ICType=Panel&ICElementNum=0&ICAction=RESULTS%24hdown%240&ICXPos=0&ICYPos=110&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=1&ICResubmit=0&ICSID=FNtHY0VXBaV0lLnbK75%2Bmz93HcvCjQuhxes8ReR%2FOTQ%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$5$=0100&SNS_CRSESRCH_WK_SUBJECT$55$=ARCH&SNS_CRSESRCH_WK_CATALOG_NBR=&SNS_CRSESRCH_WK_DESCR1=&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$$chk$0=N&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$$chk$1=N&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$$chk$2=N&SNS_CRSESRCH_WK_SNS_SEL_OPERATOR=&SNS_CRSESRCH_WK_UNITS_MAXIMUM=0.00&SNS_CRSESRCH_WK_ACAD_ORG=&SNS_CRSESRCH_WK_SNS_CAR_SEL$70$$chk$0=N&SNS_CRSESRCH_WK_SNS_CAR_SEL$70$$chk$1=N&SNS_CRSESRCH_WK_SNS_CAR_SEL$70$$chk$2=N&SNS_CRSESRCH_WK_LANGUAGE=&SNS_DERIVED_CRSE_ATTR=&SNS_DERIVED_CRSE_ATTR_VALUE=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$94$=0100");
	}
	else {
		curl_setopt($ch,CURLOPT_POSTFIELDS,"ICAJAX=1&ICNAVTYPEDROPDOWN=0&ICType=Panel&ICElementNum=0&ICAction=RESULTS%24hdown%240&ICXPos=0&ICYPos=110&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=1&ICResubmit=0&ICSID=FNtHY0VXBaV0lLnbK75%2Bmz93HcvCjQuhxes8ReR%2FOTQ%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$5$=0100&SNS_CRSESRCH_WK_SUBJECT$55$=ARCH&SNS_CRSESRCH_WK_CATALOG_NBR=&SNS_CRSESRCH_WK_DESCR1=&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$$chk$0=Y&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$$0=Y&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$$chk$1=N&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$60$$chk$2=N&SNS_CRSESRCH_WK_SNS_SEL_OPERATOR=&SNS_CRSESRCH_WK_UNITS_MAXIMUM=0.00&SNS_CRSESRCH_WK_ACAD_ORG=&SNS_CRSESRCH_WK_SNS_CAR_SEL$70$$chk$0=N&SNS_CRSESRCH_WK_SNS_CAR_SEL$70$$chk$1=N&SNS_CRSESRCH_WK_SNS_CAR_SEL$70$$chk$2=N&SNS_CRSESRCH_WK_LANGUAGE=&SNS_DERIVED_CRSE_ATTR=&SNS_DERIVED_CRSE_ATTR_VALUE=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$94$=0100");
	
	}
	
	
	$result = curl_exec($ch);
	
	// print_r(curl_getinfo($ch));
	
	$arr = explode("class='PSLEVEL1GRID' style='border-style:none' >", $result);
	$viewalls = array();
	
	$studieonderdelen = explode("<tr id='trRESULTS$0_row",$arr[1]);
				
				
	$first = true;			
	
	foreach($studieonderdelen as $studieonderdeel)
	{
		if($first)
		{
			$first = false;
			continue;
		}
		$new_studieonderdeel = array();
		preg_match_all("/<a.*>(.*)<\/a>/", $studieonderdeel, $values);
		
		if(count($values[1]) > 4)
		{
			$new_studieonderdeel['studie'] = $studie;
			$new_studieonderdeel['gidsnummer'] = $values[1][1];
			$new_studieonderdeel['titel'] = $values[1][2];
			$new_studieonderdeel['eenheden'] = $values[1][3];
			
			if(count($values[1]) == 5)
			{
				$new_studieonderdeel['loopbaan'] = $values[1][4];		
			} else {
				$new_studieonderdeel['type'] = $values[1][4];
				$new_studieonderdeel['loopbaan'] = $values[1][5];
			}
				
			$vak_pos = strpos($new_studieonderdeel['titel'], "Individueel vak");
				
			if($vak_pos === false)	
			{
				$onderdelen[] = $new_studieonderdeel;			
			}
			else {
				$counter++;
			}
			
		} else {
			if(count($values[1]) > 0) print_r($values[1]);
		}
	}
			
	$run--;
}
} // if $out[1]

// print_r($onderdelen);

$studiefile = "/home/geneesleer/ucheck/raw/"."cache/".$year."/".$studie.".txt";

if(count($onderdelen) > 0)
{

	$fh = fopen($studiefile, 'w') or fwrite($logfile, "can't open file");
	if($fh)
	{
		fwrite($fh, serialize($onderdelen));
		fclose($fh);
	} else {
		$error = true;	 
	}

} else {
	fwrite($logfile, "geen vakken!\n");
}

fwrite($logfile, (time()-$start)." seconden voor ".$studie."\n");
fwrite($logfile, count($onderdelen)." vakken voor ".$studie."\n");

echo (time()-$start)." seconden voor ".$studie."\n";
echo count($onderdelen)." vakken voor ".$studie."\n";
	
// echo "BUG! ".$studie." aantal: ".count($onderdelen)." moet zijn: ".$out[1]. " filtert: ".$counter." mist: ".(($out[1]-$counter)-count($onderdelen))."\n";
	
if(count($onderdelen) != ($out[1]-$counter))
{
	echo "BUG! ".$studie." aantal: ".count($onderdelen)." moet zijn: ".$out[1]. " filtert: ".$counter." mist: ".(($out[1]-$counter)-count($onderdelen))."\n";
}

} // end for loop

fwrite($logfile, "\n----------\n\n");

fwrite($logfile, (time()-$start_total)/(60*60)." uur voor alles \n");
fwrite($logfile, (time()-$start_total)/(60)." minuten voor alles \n");
fwrite($logfile, (time()-$start_total)." seconden voor alles \n");

$handle = fopen($logfilename, "r");
$contents = fread($handle, filesize($logfilename));
fclose($handle);

} //year!

fclose($logfile);

mail("hans.pinckaers@gmail.com", ($error)?"Fout in scrape!" : round((time()-$start_total)/(60))." minuten gescraped", $contents, "From: geneesleer@alwaysdata.net");

?>
