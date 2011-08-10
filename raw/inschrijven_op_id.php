<?
$id = $_GET['nummer'];
$gids_id = $_GET['q'];
$aantal = $_GET['aantal_check'];

include "details.php";

if(count($onderdelen) != $aantal)
{
	echo "BUG: Aantal klopt niet. aantal = ".count($onderdelen)." check: ".$aantal;
	exit();
}


if($demo){
	echo "<span style='color:orange;'>Inschrijven is niet ondersteund in het demo-account.</span>";
	exit();
}


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

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

curl_setopt($ch,CURLOPT_POST, 14);
curl_setopt($ch,CURLOPT_POSTFIELDS,"ICType=Panel&ICElementNum=0&ICAction=SNS_DERIVED_CLASS_SELECT_PB&ICXPos=0&ICYPos=0&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=0&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$23$=0100&SNS_SS_DERIVED_SELECTED\$chk$".$id."=Y&SNS_SS_DERIVED_SELECTED$".$id."=Y&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$171$=0100");

curl_exec($ch);

unset($ch);

$ch = curl_init();

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES_2.SSR_SSENRL_CART.GBL?Page=SSR_SSENRL_CART&Action=A&ACAD_CAREER=10&EMPLID=0924121&ENRL_REQUEST_ID=&INSTITUTION=LEI01&STRM=2100';

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; nl-nl) AppleWebKit/533.18.1 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5");
curl_setopt($ch,CURLOPT_URL,$url);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

$result = curl_exec($ch);

$ch = curl_init();

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES_2.SSR_SSENRL_CART.GBL';

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; nl-nl) AppleWebKit/533.18.1 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5");
curl_setopt($ch,CURLOPT_URL,$url);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

curl_setopt($ch,CURLOPT_POST, 14);
curl_setopt($ch,CURLOPT_POSTFIELDS,"ICType=Panel&ICElementNum=0&ICAction=DERIVED_REGFRM1_LINK_ADD_ENRL$114$&ICXPos=0&ICYPos=0&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=0&%23ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$22$=0100&P_SELECT\$chk$0=Y&P_SELECT$0=Y&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$154$=0100");

curl_exec($ch);

unset($ch);

$ch = curl_init();

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES_2.SSR_SSENRL_CART.GBL';

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; nl-nl) AppleWebKit/533.18.1 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5");
curl_setopt($ch,CURLOPT_URL,$url);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

curl_setopt($ch,CURLOPT_POST, 14);
curl_setopt($ch,CURLOPT_POSTFIELDS,"ICType=Panel&ICElementNum=0&ICAction=DERIVED_REGFRM1_SSR_PB_SUBMIT&ICXPos=0&ICYPos=0&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=0&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$4$=0100&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$60$=0100");

// print_r(curl_getinfo($ch));
$result = curl_exec($ch);

preg_match("/<B>(.*)./", $result, $matches);

unset($ch);


if(isset($matches[0]))
{

	$melding = $matches[0];
	echo "<span style='color:green;'>".$melding."</span>";
} else {
	echo "<span style='color:orange;'>Het is niet bekend of het goed gegaan is, controleer onder inschrijvingen of deze eronder staat. Sorry!</span>";
}

//print_r($matches);
?>