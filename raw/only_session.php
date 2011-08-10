<?

if(!isset($session))
{
	$session = true;
	
	session_start();
	
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	setlocale(LC_ALL, 'nl_NL');

}

$logged_in = false;

if(!isset($_SESSION['user']) && !isset($_COOKIE['user']) && !isset($_POST['user'])){
	setcookie ("user", "", time() - 3600 - 3600- 3600);
	setcookie ("pwd", "", time() - 3600- 3600- 3600);

	session_destroy();

	header('Location: login') ;
} else {
	if(isset($_POST['user']))
	{
		include("user_info.php");
	}

	$logged_in = true;
}

?>