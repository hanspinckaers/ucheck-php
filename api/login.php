<?
//ini_set('display_errors', 0);

$user = $_GET['user'];
$pass_get = $_GET['pass'];

if($pass_get == "" || !$pass_get || $user == "" || !$user)
{
	echo "err: Niet alles ingevuld.";
	exit();
}

//extract data from the post
//set POST variables
$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES_2.SSS_MY_CRSEHIST.GBL';

$fields = array(
            'userid'=>$user,
            'pwd'=>$pass_get,
            'timezoneOffset'=>'-60',
        );

//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string,'&');

//open connection
$ch = curl_init();

$ip=$_SERVER['REMOTE_ADDR'];

//set the url, number of POST vars, POST data
$useragent="Fake Mozilla 5.0";


curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
curl_setopt($ch, CURLOPT_COOKIESESSION, TRUE); 
curl_setopt($ch, CURLOPT_HEADER, 0); 
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiesfile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiesfile);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);  

preg_match("/<p class=\"psloginerror\"> (.*) <\/p>/", $result, $out);

function base64url_encode($data) { 
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
} 

function base64url_decode($data) { 
  return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
} 

if(!$out[1])
{
	if(file_exists("../geheim/iphone.php"))
	{
		include("../geheim/iphone.php");
		echo $cryptastic->encrypt($pass_get, $key, true);
	} else {
		echo base64url_encode($pass_get);
	}
			
	$filename = "../raw/mail/bezocht.txt";

	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	$users = unserialize($contents);	
	
	$user = $_GET['user'];
	
	
	if($users && !in_array(strtolower($user), $users) &&  
		strtolower(substr($user, 0, 1)) == "s" && 
		(strlen($user) == 8))
	{
		$users[] = strtolower($user);
		
		fclose($handle);
		$handle = fopen($filename, "w");
		fwrite($handle, serialize($users));			
	}
		
	fclose($handle);
	
} else {
	echo "err: ".$out[1];
}

// Turn off all error reporting
error_reporting(0);
ini_set("display_errors",0);
try {
include('Galvanize.php');
$GA = new Galvanize('UA-4063156-9');
$GA->trackPageView();
} catch (Exception $e) {}
?>