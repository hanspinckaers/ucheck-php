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

if(date("i") < 15)
{
	$studies = array("ALG","ARAB","ARCH","ASA","BFW","BIO","BIOM","BOEK","CHE","CLANEC","DUITS","DUTCHST","EGYPTE","ENGELS","EUS","FGWALG","PHOTOGS","FRANS","GS","GODG","HJS","HERV","INF","ISLM","ISLT","ITAL","JOURNIME","FGWKERN","FDK","KG","LAAS","LO","FLEBYVAK","FLEALG","LA&amp;S","LST","LITW","MANAGEME","MIDOOST","MST","MUZIEK","NSC","NTK","NED","NP","OCMW","POWE","PKST","PSYC");

	$logfilename = "/home/geneesleer/ucheck/scrapeusis/logs/".strftime('%d-%h-%Y', time())."_1.txt";

} else {
	$studies = array("LAW","SEMI","SLAV","STK","TCIA","TCMA","TW","INDTIBET","INDONES","AFRIKA","TCLA","CHINA","JAPAN","KOREA","TCC","THEA","TURK","VIET","VTW","W&amp;N","WSK","ZZOAZIE","GNK","BSKE","CANS","PEDA","GRIEKLAT");
	
	$logfilename = "/home/geneesleer/ucheck/scrapeusis/logs/".strftime('%d-%h-%Y', time())."_2.txt";
}

$studies = array("AFRIKA","ARAB","ARCH","ASA","KG","FDK","STK","BFW","BIO","BIOM","BOEK","CHE","CLANEC","VIET","VTW","INF","FGWKERN","CANS","DUTCHST","NED","PEDA","EGYPTE","ENGELS","EUS","FGWALG","PHOTOGS","FRANS","ALG","DUITS","GRIEKLAT","HJS","HERV","GS","FLEBYVAK","FLEALG","INDTIBET","INDONES","INDECO","ISLM","ISLT","ITAL","JAPAN","JOURNIME","KOREA","TCC","CHINA","TCIA","TCMA","TURK","LAAS","TCLA","LAW","LA&amp;S","LST","TAALK","TW","LETTERK","LITW","MANAGEME","WSK","GNK","MIDOOST","MST","MUZIEK","NSC","OCMW","NP","WYSB","NTK","POWE","PKST","PREUNIV","PSYC","BSKE","GODG","W&amp;N","SEMI","SLAV","ZZOAZIE","LO","THEA");

//include "user_info.php";
//$studies = array("GRIEKLAT");

//$studies = array("WYSB");
//$logfilename = "/home/geneesleer/ucheck/scrapeusis/logs/".strftime('%d-%h-%Y', time())."_3.txt";

$cookiefile = "/home/geneesleer/ucheck/raw/"."cookies/s0924121_vakken.txt";

$logfile = fopen($logfilename, 'w') or die("can't open file");

$years = array("10","11");

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

$fields = array(
            'userid'=>'s0924121',
            'pwd'=>'VoorDenise1',
            'timezoneOffset'=>'-60',
        );

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

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

curl_exec($ch);

// print_r(curl_getinfo($ch));

curl_close($ch);

sleep(1);

$ch = curl_init();

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SNS_CUSTOMIZATIONS_NLD.SNS_SSENRL_CART.GBL';

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; nl-nl) AppleWebKit/533.18.1 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5");
curl_setopt($ch,CURLOPT_URL,$url);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);

curl_setopt($ch,CURLOPT_POST, 13);
curl_setopt($ch,CURLOPT_POSTFIELDS,"ICType=Panel&ICElementNum=0&ICAction=SNS_DERIVED_DESCR20&ICXPos=0&ICYPos=0&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=0&ICSID=22T8J9xgNnGm&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$5$=0100&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$24$=0100");

curl_exec($ch);

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

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);

curl_setopt($ch,CURLOPT_POST, 13);
if($year == "10")
{
	curl_setopt($ch,CURLOPT_POSTFIELDS,"ICType=Panel&ICElementNum=0&ICAction=SNS_TERM_TBL_VW_DESCR$1&ICXPos=0&ICYPos=0&ICFocus=&ICSaveWarningFilter=0&ICChanged=0&ICResubmit=0&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$5$=0100&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$24$=0100");
} else {
	curl_setopt($ch,CURLOPT_POSTFIELDS,"ICType=Panel&ICElementNum=0&ICAction=SNS_TERM_TBL_VW_DESCR$0&ICXPos=0&ICYPos=0&ICFocus=&ICSaveWarningFilter=0&ICChanged=0&ICResubmit=0&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$5$=0100&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$24$=0100");
}

curl_exec($ch);

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

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

curl_setopt($ch,CURLOPT_POST, 13);
curl_setopt($ch,CURLOPT_POSTFIELDS,"ICType=Panel&ICElementNum=0&ICAction=SNS_DERIVED_FETCH_PUSHBUTTON&ICXPos=0&ICYPos=0&ICFocus=&ICSaveWarningFilter=0&ICChanged=0&ICResubmit=0&ICSID=22T8J9xgNnGm&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$5$=0100&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$24$=0100");

curl_exec($ch);

// print_r(curl_getinfo($ch));

curl_close($ch);

unset($ch);

sleep(1);

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
curl_setopt($ch,CURLOPT_POSTFIELDS,"ICType=Panel&ICElementNum=0&ICAction=SNS_CRSESRCH_WK_SEARCH_BTN&ICXPos=0&ICYPos=0&ICFocus=&ICSaveWarningFilter=0&ICChanged=0&ICResubmit=0&ICSID=M2TxhylnQWsd&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$4$=0100&SNS_CRSESRCH_WK_SUBJECT$54$=".$studie."&SNS_CRSESRCH_WK_CATALOG_NBR=&SNS_CRSESRCH_WK_DESCR1=&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$59$\$chk$0=Y&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$59$$0=Y&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$59$\$chk$1=N&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$59$\$chk$2=N&SNS_CRSESRCH_WK_SNS_SEL_OPERATOR=&SNS_CRSESRCH_WK_UNITS_MAXIMUM=0.00&SNS_CRSESRCH_WK_ACAD_ORG=&SNS_CRSESRCH_WK_SNS_CAR_SEL$69$\$chk$0=N&SNS_CRSESRCH_WK_SNS_CAR_SEL$69$$\chk$1=N&SNS_CRSESRCH_WK_SNS_CAR_SEL$69$\$chk$2=N&SNS_CRSESRCH_WK_LANGUAGE=&SNS_DERIVED_CRSE_ATTR=&SNS_DERIVED_CRSE_ATTR_VALUE=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$92$=0100");

$result = curl_exec($ch);

// print_r(curl_getinfo($ch));

unset($ch);

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

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

curl_setopt($ch,CURLOPT_POST, 28);
curl_setopt($ch,CURLOPT_POSTFIELDS,"ICType=Panel&ICElementNum=0&ICAction=RESULTS\$hviewall$0&ICXPos=0&ICYPos=0&ICFocus=&ICSaveWarningFilter=0&ICChanged=1&ICResubmit=0&ICSID=M2TxhylnQWsd&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$4$=0100&SNS_CRSESRCH_WK_SUBJECT$54$=".$studie."&SNS_CRSESRCH_WK_CATALOG_NBR=&SNS_CRSESRCH_WK_DESCR1=&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$59$\$chk$0=Y&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$59$$0=Y&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$59$\$chk$1=N&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$59$\$chk$2=N&SNS_CRSESRCH_WK_SNS_SEL_OPERATOR=&SNS_CRSESRCH_WK_UNITS_MAXIMUM=0.00&SNS_CRSESRCH_WK_ACAD_ORG=&SNS_CRSESRCH_WK_SNS_CAR_SEL$69$\$chk$0=N&SNS_CRSESRCH_WK_SNS_CAR_SEL$69$\$chk$1=N&SNS_CRSESRCH_WK_SNS_CAR_SEL$69$\$chk$2=N&SNS_CRSESRCH_WK_LANGUAGE=&SNS_DERIVED_CRSE_ATTR=&SNS_DERIVED_CRSE_ATTR_VALUE=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$92$=0100");

$result = curl_exec($ch);

// print_r(curl_getinfo($ch));


$arr = explode("<table dir='ltr' border='0' cellpadding='2' cellspacing='0' cols='6' width='100%' class='PSLEVEL1GRID' style='border-style:none' >", $result);

$onderdelen = array();

$studieonderdelen = explode("<tr valign='center'>",$arr[1]);

foreach($studieonderdelen as $studieonderdeel)
{

	$new_studieonderdeel = array();
	preg_match_all("/ >(.*)<\/a><\/span>/", $studieonderdeel, $values);
	
	if(count($values[1]) == 6)
	{
		$new_studieonderdeel['studie'] = $values[1][0];
		$new_studieonderdeel['gidsnummer'] = $values[1][1];
		$new_studieonderdeel['titel'] = $values[1][2];
		$new_studieonderdeel['eenheden'] = $values[1][3];
		$new_studieonderdeel['type'] = $values[1][4];
		$new_studieonderdeel['loopbaan'] = $values[1][5];
	
	
		$vak_pos = strpos($new_studieonderdeel['titel'], "Individueel vak");
			
		if($vak_pos === false)	
		{
			$onderdelen[] = $new_studieonderdeel;			
		}
	
	} else {
		//// print_r($values[1]);
	}
}


preg_match("/<span class='PSGRIDCOUNTER' >1-100 van (.*)<\/span>/", $result, $out);

// FETCHING ONDERDELEN!!!

if($out[1])
{

$run = ceil($out[1]/100) - 1;

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
	
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	
	curl_setopt($ch,CURLOPT_POST, 28);
	curl_setopt($ch,CURLOPT_POSTFIELDS,"ICType=Panel&ICElementNum=0&ICAction=RESULTS\$hdown$0&ICXPos=0&ICYPos=0&ICFocus=&ICSaveWarningFilter=0&ICChanged=1&ICResubmit=0&ICSID=22T8J9xgNnGm&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$4$=0100&SNS_CRSESRCH_WK_SUBJECT$54$=".$studie."&SNS_CRSESRCH_WK_CATALOG_NBR=&SNS_CRSESRCH_WK_DESCR1=&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$59$\$chk$0=Y&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$59$$0=Y&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$59$\$chk$1=N&SNS_CRSESRCH_WK_SNS_CRSETYPE_SEL$59$\$chk$2=N&SNS_CRSESRCH_WK_SNS_SEL_OPERATOR=&SNS_CRSESRCH_WK_UNITS_MAXIMUM=0.00&SNS_CRSESRCH_WK_ACAD_ORG=&SNS_CRSESRCH_WK_SNS_CAR_SEL$69$\$chk$0=N&SNS_CRSESRCH_WK_SNS_CAR_SEL$69$\$chk$1=N&SNS_CRSESRCH_WK_SNS_CAR_SEL$69$\$chk$2=N&SNS_CRSESRCH_WK_LANGUAGE=&SNS_DERIVED_CRSE_ATTR=&SNS_DERIVED_CRSE_ATTR_VALUE=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$92$=0100");
	
	$result = curl_exec($ch);
	
	// print_r(curl_getinfo($ch));
	
	$arr = explode("<table dir='ltr' border='0' cellpadding='2' cellspacing='0' cols='6' width='100%' class='PSLEVEL1GRID' style='border-style:none' >", $result);
	$viewalls = array();
	
	
	$studieonderdelen = explode("<tr valign='center'>",$arr[1]);
		
	foreach($studieonderdelen as $studieonderdeel)
	{
	
		$new_studieonderdeel = array();
		preg_match_all("/ >(.*)<\/a><\/span>/", $studieonderdeel, $values);
		
		if(count($values[1]) == 6)
		{
			$new_studieonderdeel['studie'] = $values[1][0];
			$new_studieonderdeel['gidsnummer'] = $values[1][1];
			$new_studieonderdeel['titel'] = $values[1][2];
			$new_studieonderdeel['eenheden'] = $values[1][3];
			$new_studieonderdeel['type'] = $values[1][4];
			$new_studieonderdeel['loopbaan'] = $values[1][5];
				
			$vak_pos = strpos($new_studieonderdeel['titel'], "Individueel vak");
				
			if($vak_pos === false)	
			{
				$onderdelen[] = $new_studieonderdeel;			
			}
			
		} else {
			//// print_r($values[1]);
		}
	}
	
	$run--;
}
} // if $out[1]

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



<?
function do_curl_helper()
{

}
function do_curl()
{

}

?>