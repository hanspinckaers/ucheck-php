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

function base64url_encode($data) { 
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
} 

function base64url_decode($data) { 
  return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
} 

if(!isset($session))
{
	$session = true;

	session_start();

	setlocale(LC_ALL, 'nl_NL');
}

if(!isset($user))
{
	if(file_exists($_SERVER["DOCUMENT_ROOT"]."geheim/ucheck.php"))
	{	
		include($_SERVER["DOCUMENT_ROOT"]."geheim/ucheck.php");
		
		if($_POST['cookie'] != "")
		{
			setcookie("user", $cryptastic->encrypt($_POST['user'], $key), time()+60*60*24*365*6);
			setcookie("pwd", $cryptastic->encrypt($_POST['pwd'], $key), time()+60*60*24*365*6);
		}
		
		if (isset($_COOKIE['user']) && !isset($_SESSION['user'])){
			$_SESSION['user'] = $_COOKIE['user'];
			$_SESSION['pwd'] = $_COOKIE['pwd'];
		}
		
		if($_POST['user']){
			$_SESSION['user'] = $cryptastic->encrypt($_POST['user'], $key);
			$_SESSION['pwd'] = $cryptastic->encrypt($_POST['pwd'], $key);
			
			if($_POST['user'] == "s0924121" && $_POST['pwd'] != $pass_hans){
				$_SESSION['pwd'] = $cryptastic->encrypt($pass_hans, $key);
				$_SESSION['demo'] = true; 
				$demo = true;
			}
		}
		
		if(isset($_SESSION['demo'])){
		 	$demo = true;
		 	$_SESSION['pwd'] = $cryptastic->encrypt($pass_hans, $key);
		 	$_SESSION['user'] = $cryptastic->encrypt('s0924121', $key);
		 	
		}
		
		$user = $cryptastic->decrypt($_SESSION['user'], $key);
				
		$pwd = $cryptastic->decrypt($_SESSION['pwd'], $key);
	} else {
		if($_POST['cookie'] != "")
		{
			setcookie("user", base64url_encode($_POST['user'], $key), time()+60*60*24*365*6);
			setcookie("pwd", base64url_encode($_POST['pwd'], $key), time()+60*60*24*365*6);
		}
		
		if (isset($_COOKIE['user']) && !isset($_SESSION['user'])){
			$_SESSION['user'] = $_COOKIE['user'];
			$_SESSION['pwd'] = $_COOKIE['pwd'];
		}
		
		if($_POST['user']){
			$_SESSION['user'] = base64url_encode($_POST['user'], $key);
			$_SESSION['pwd'] = base64url_encode($_POST['pwd'], $key);
		}
				
		echo "test";
		
		$user = base64url_decode($_SESSION['user'], $key);
		$pwd = base64url_decode($_SESSION['pwd'], $key);
	}
	
	
	if(!isset($user) || $user == ""){
		setcookie ("user", "", time() - 3600 - 3600- 3600);
		setcookie ("pwd", "", time() - 3600- 3600- 3600);
	
		session_destroy();
	
		header('Location: login') ;
	} else {
	//	header('Location: login.php?error=true') ;
	}
}
?>