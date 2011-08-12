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
?>
<html>
<head>
  <meta charset="utf-8">
  
  <title>uCheck – Inschrijven & Cijfers – Universiteit Leiden</title>
  <meta name="author" content="Hans Pinckaers">
  <meta name="format-detection" content="telephone=no">
  <meta name="Description" content="uSis vervelend &amp; ingewikkeld? Probeer uCheck. uCheck automatiseert ingewikkelde stappen op uSis. Zodat jij je makkelijk inschrijft voor studieonderdelen.">
  
  <link rel="stylesheet" href="min/style.css" />
  <link rel="stylesheet" href="min/grid.css" />

<!--[if IE]><link rel="stylesheet" href="min/ie.css" type="text/css"><![endif]-->

</head>
<body>

<div id="container">

<div class="span-2">
<h2>uCheck</h2> 
</div>

<div class="span-1" id="app_store" style="">
<a href="http://itunes.apple.com/nl/app/ucheck/id449171216?l=nl&ls=1&mt=8"><img src="App_Store_Badge.png"/></a>
</div>

<div class="span-2" id="facebook_mailen">
<iframe src="blank.html" id="facebook" scrolling="no" frameborder="0" style="border:none; display:block; position:relative; top:0px; left:27px; overflow:hidden; width:220px; height:21px;" allowTransparency="true"></iframe>

<?
// Check of student niet al gemaild heeft!
$filename = "raw/mail/hebben_gemaild.txt";

$hebben_gemaild[] = array();
$gemaild = false;

if(filesize($filename) > 0 && $user){
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	$hebben_gemaild = unserialize($contents);
	
	if(in_array($user, $hebben_gemaild))
	{
		$gemaild = true;
	}
}

if($gemaild)
{
?>
<a href="#!" id="mail_button" style="position:relative; top:5px; left:27px; overflow:hidden; height:25px;" class="mail_button tooltip" title="" rel="Je hebt 5 medestudenten geholpen door ze te wijzen op uCheck. <br/><b>Namens hen: bedankt!</b>">Bedankt voor het mailen!</a>
<?
} else {
?>
<a href="#!" id="mail_button" style="position:relative; top:5px; left:27px; overflow:hidden; height:25px;" class="mail_button tooltip" title="Red uw medestudenten!" rel="Door hier te klikken verstuur jij <b>automatisch</b><br/> 5 mails naar medestudenten over uCheck, <br/> verspreid het woord!">Mail 5 medestudenten!</a>
<? } ?>
</div>

<?
if($user)
{
?>
<div class="span-1 last" style="text-align:right;">
<a href="logout" style="text-align:right; font-size:1.5em; font-family:Georgia;">uitloggen</a>
</div>
<?
}
?>
<!--<span style="color:red">
In verband met de aansluiting van uSis op Studielink zal uSis gesloten zijn voor alle gebruikers tussen donderdag 31 maart 14:00 uur en donderdag 7 april.
</span>
<hr class="space"/>
<hr />-->
<hr />
