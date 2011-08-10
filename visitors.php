<?php
include "header.php";

// Check of student niet al gemaild heeft!
$filename = "raw/mail/hebben_gemaild.txt";

$hebben_gemaild[] = array();


if(filesize($filename) > 0){
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	$hebben_gemaild = unserialize($contents);
	
}

$handle = fopen("raw/mail/oude_nummers.txt", "r");
$contents = fread($handle, filesize("raw/mail/oude_nummers.txt"));
fclose($handle);

$a_users = explode("\n", $contents);
$stopped = array();

$filename = "raw/mail/bezocht.txt";

$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
$users = unserialize($contents);	

//$filename = "raw/mail/mail_verboden.txt";
//
//$handle = fopen($filename, "r");
//$contents = fread($handle, filesize($filename));
//$verboden = unserialize($contents);	
//
//$verboden_maar_gemaild = array();
//

foreach($users as $user)
{
	$t_user = substr($user, 1);
	
	if(!in_array($t_user, $a_users))
	{
		if(substr($user, 1, 2) > 2 && (substr($user, 1, 1) == 0 || substr($user, 1, 2) == 10))
		{
			$stopped[] = $user;
		}
	}
	
			
//	if(in_array($user, $verboden) && in_array($user, $hebben_gemaild))
//	{ 
//		$verboden_maar_gemaild[] = $user;
//	}
	
}

$not = array();
echo "<b>".count($hebben_gemaild)."</b> studenten hebben <b>".(count($hebben_gemaild)*5)."</b> mailtjes verstuurd. <br/><br/>";  
//echo "<b>".(count($verboden)-count($verboden_maar_gemaild))."</b> studenten hebben geen mailtjes verstuurd. <br/><br/>";  
//
//echo "<b>".count($verboden)."</b> studenten hebben het mailen weggevinkt. <br/>";  
//echo "<b>".count($verboden_maar_gemaild)."</b> studenten hebben toch gemaild, na wegvinken. <br/><br/>";  

echo "<b>".count($users)."</b> ".str_replace(".",",",round((count($users)/18000)*100, 1))."% studenten kennen uCheck. <br/>";  
//echo "<b>".(count($hebben_gemaild)+(count($verboden)-count($verboden_maar_gemaild)))."</b> studenten zijn ingelogd tijdens mailactie. <br/><br/>";  
echo "<br/><b>".count($stopped)."</b> student(en) zijn gestopt/hun studentnummer is geen geldig emailadres.<br/>";  
echo "<pre>Namelijk: \n";

foreach($stopped as $student)
{
echo $student."\n";
}

//sort($users);
echo "</pre>";

?>