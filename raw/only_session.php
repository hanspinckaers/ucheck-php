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