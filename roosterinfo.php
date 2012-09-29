<?
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
ini_set(display_errors, 1);
setlocale(LC_TIME, 'NL_nl');
date_default_timezone_set("Europe/Amsterdam");

include 'raw/user_info.php';

$id = $_GET["id"];
$title = htmlspecialchars($_GET["title"]);

$cookiefile = $DOCUMENT_ROOT."raw/cookies/".$user."_rooster".time().".txt";

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

$url = "https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SNS_CUSTOMIZATIONS_NLD.SNS_CLS_DTL_OPT.NLD?Page=SNS_CLSRCH_RSLT&Action=U&CLASS_NBR=$id&INSTITUTION=LEI01&STRM=2121";

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; nl-nl) AppleWebKit/533.18.1 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5");
curl_setopt($ch,CURLOPT_URL,$url);

curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  

curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);

curl_setopt($ch, CURLOPT_HEADER, 'accept-language: nl');

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);

$html = curl_exec($ch);

//print_r(curl_getinfo($ch));

curl_close($ch);


$html = str_replace("<link rel='stylesheet' type='text/css' href='/cs/S040PRD/cache/SSS_STYLESHEET_DUT_1.css' />", "<link rel='stylesheet' type='text/css' href='min/usis.css' />", $html);

// /cs/S040PRD/cache/PS_CS_STATUS_OPEN_ICN_DUT_1.gif
// /cs/S040PRD/cache/PS_CS_STATUS_CLOSED_ICN_DUT_1.gif
// /cs/S040PRD/cache/PS_CS_STATUS_WAITLIST_ICN_DUT_1.gif 
// /cs/S040PRD/cache/PT_PROCESSING_DUT_1.gif
// /cs/S040PRD/cache/PS_COLLAPSE_ICN_1.gif 

$html = str_replace("/cs/S040PRD/cache/", "min/", $html);

$html = str_replace("<img align='right' src='min/PT_PROCESSING_DUT_1.gif' class='PSPROCESSING' alt='Verwerken... even wachten a.u.b.' title='Verwerken... even wachten a.u.b.' />","",$html);

preg_match_all("/[0-9]{1,}\/[0-9]{1,}\/[0-9]{4}/", $html, $dates);

foreach($dates[0] as $key => $value)
{
	$date = strftime('%d %h %Y', strtotime($value));
	$html = str_replace($value,$date,$html);
}


$html = str_replace("<span  class='PATRANSACTIONTITLE' >Rooster info</span>","<span  class='PATRANSACTIONTITLE' >$title</span>",$html);

echo $html;

unlink($cookiefile);

// echo "<pre>";

// print_r($dates);

?>