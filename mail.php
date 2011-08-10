<?
include("raw/user_info.php");

if(strlen($user) == 8)
{
	
	// Check of student niet al gemaild heeft!
	$filename = "raw/mail/hebben_gemaild.txt";
	
	$hebben_gemaild[] = array();


	if(filesize($filename) > 0){
		$handle = fopen($filename, "r");
		$contents = fread($handle, filesize($filename));
		$hebben_gemaild = unserialize($contents);
		
		if(in_array($user, $hebben_gemaild))
		{
			return;
		} else {
			$handle = fopen($filename, "w");
			$hebben_gemaild[] = $user;
			fwrite($handle, serialize($hebben_gemaild));
			fclose($handle);
		}
	} else {
		$handle = fopen($filename, "w");
		$hebben_gemaild[] = $user;
		fwrite($handle, serialize($hebben_gemaild));
		fclose($handle);
	}
	
	// Strip van alle nummers gemaild eraf
	$filename = "raw/mail/nummers.txt";
	
	$a_users = array();
	
	if(filesize($filename) > 0){
		$handle = fopen($filename, "r");
		$contents = fread($handle, filesize($filename));
		$a_users = explode("\n", $contents);
		
		fclose($handle);
	}
	
	$filename = "raw/mail/gemaild.txt";
	
	$gemaild = array();
	
	if(filesize($filename) > 0)
	{
		$handle = fopen($filename, "r");
		$contents = fread($handle, filesize($filename));
		$gemaild = unserialize($contents);	
	}
	
	if($gemaild){
		$nog_niet_gemaild = array_diff($a_users, $gemaild);
	} else {
		$nog_niet_gemaild = $a_users;
		$gemaild = array();
	}
	
	$filename = "raw/mail/bezocht.txt";

	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	$bezocht_users = unserialize($contents);	

	$new_bezocht_users = array();
	
	foreach($bezocht_users as $user)
	{
		$new_bezocht_users[] = substr($user, 1);
	}
	
	$nog_niet_gemaild = array_diff($nog_niet_gemaild, $new_bezocht_users);

	// Pak 5 nummers boven student/ of willekeurig
	$te_mailen_keys = array_rand($nog_niet_gemaild, 5);
	$te_mailen = array();
	foreach($te_mailen_keys as $key)
	{
		$te_mailen[] = $a_users[$key];
	}

	$filename = "raw/mail/gemaild.txt";

	$handle = fopen($filename, "w");
	fwrite($handle, serialize(array_merge($te_mailen, $gemaild)));
	fclose($handle);
	
	// Mail die studenten!
	foreach($te_mailen as $email)
	{
		$str = nl2br("<html><head></head><body>Beste,\n\nVind jij uSis ook vervelend en ingewikkeld? Dan is <a href=\"https://www.ucheck.nl/\" target=\"_blank\"><span>uCheck.nl</span></a> een site voor jou.\n\nOp uCheck kan je je cijfers en inschrijvingen binnen twee seconden controleren en is inschrijven voor een studieonderdeel een eitje. De universiteit ziet geen verschil tussen inschrijven via uCheck en via uSis. Hoe werkt uCheck: uCheck automatiseert (en bespaart jou) de vele stappen die jij bij het gebruik van uSis moet doorlopen.\n\nNeem eens een kijkje op uCheck: <a href=\"https://ucheck.nl/\" target=\"_blank\">https://ucheck.nl/</a> &mdash; het scheelt tijd.\n\nMet vriendelijke groet,\n\nHans Pinckaers\n\n<small>Dit bericht is eenmalig en verstuurd op verzoek van ".$user.".</small></body></html>");
	
		mail("s".$email."@umail.leidenuniv.nl", "=?ISO-8859-1?Q?uCheck=3A_een_=28onoffici=EBle=29_vervanging_voor_uSis=21?=", $str, "From: ".$user." <".$user."@umail.leidenuniv.nl>\r\nReply-To: Hans Pinckaers <mail@ucheck.nl>\r\nContent-type: text/html; charset=utf-8\r\nMIME-Version: 1.0");
	}
}
?>