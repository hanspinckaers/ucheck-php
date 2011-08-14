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

############## ############## ############## ############## test!!!! ############## ############## ############## ##############

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES.SSR_SSENRL_DROP.GBL?Page=SSR_SSENRL_DROP&Action=A&ACAD_CAREER=10&EMPLID=0924121&ENRL_REQUEST_ID=&INSTITUTION=LEI01&STRM=2'.$year.'0';

$fields = array(
            'userid'=>$user,
            'pwd'=>$pwd,
            'timezoneOffset'=>'-60',
        );

//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string,'&');

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
$useragent="Fake Mozilla 5.0";
curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_COOKIESESSION, TRUE); 
curl_setopt($ch, CURLOPT_HEADER, 0); 
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile); 
curl_setopt($ch, CURLOPT_COOKIE, session_name() . '=' . session_id()); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);  


############## ############## ############## ############## ############## controle!!!! ############## ############## ############## ############## ############## ############## 


$ch = curl_init();

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES.SSR_SSENRL_DROP.GBL';

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; nl-nl) AppleWebKit/533.18.1 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5");
curl_setopt($ch,CURLOPT_URL,$url);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);

$post = "Type=Panel&ICElementNum=0&ICAction=DERIVED_REGFRM1_LINK_DROP_ENRL&ICXPos=0&ICYPos=1267&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=0&ICSID=qcNpMdLKb6My&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$4$=9999&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$100$=9999";

$vakken = explode(",", $_GET['q']);

foreach($vakken as $vak)
{
	if($vak && $vak != ""){
		$post .= "&DERIVED_REGFRM1_SSR_SELECT\$chk".$vak."=Y&DERIVED_REGFRM1_SSR_SELECT".$vak."=Y";
	}
}

curl_setopt($ch,CURLOPT_POST, 14);
curl_setopt($ch,CURLOPT_POSTFIELDS, $post);

$result = curl_exec($ch);

preg_match("/class='SSSMSGWARNINGTEXT' >(.*)<\/span>/", $result, $matches);
$matches[0] = $matches[1];

if(isset($matches[1]))
{
	//echo "<span style='color:red;'>".$matches[1]."</span>";
	//exit();
} else {
	############## ############## ############## ############## ############## for sure!!!! ############## ############## ############## ############## ############## ############## 	
	
	$ch = curl_init();
	
	$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES.SSR_SSENRL_DROP.GBL';
	
	//set the url, number of POST vars, POST data
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; nl-nl) AppleWebKit/533.18.1 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5");
	curl_setopt($ch,CURLOPT_URL,$url);
	
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	 
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
	
	$post = "Type=Panel&ICElementNum=0&ICAction=DERIVED_REGFRM1_SSR_PB_SUBMIT&ICXPos=0&ICYPos=1267&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=0&ICSID=qcNpMdLKb6My&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$4$=9999&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$100$=9999";
	
	curl_setopt($ch,CURLOPT_POST, 14);
	curl_setopt($ch,CURLOPT_POSTFIELDS, $post);
	
	$result = curl_exec($ch);
		
	preg_match_all("/<B>(.*)./", $result, $matches);
}	

unlink($cookiefile);
?>