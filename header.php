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
  <meta name="viewport" content="width=1024" >
	<meta property="fb:admins" content="1004437365" />

  <link rel="stylesheet" href="min/style.css" />
  <link rel="stylesheet" href="min/grid.css" />
  <link rel="image_src" href="https://ucheck.nl/Logo.png" />
<!--[if IE]><link rel="stylesheet" href="min/ie.css" type="text/css"><![endif]-->

</head>
<body>

<div id="container">

<div class="span-1">
<h2>uCheck</h2>
</div>



<!-- <a href="http://itunes.apple.com/nl/app/ucheck/id449171216?l=nl&ls=1&mt=8"><img src="App_Store_Badge.png" style="float:left; z-index:99; position:relative; left:-50px"/></a> -->
<?
if(isset($user))
{
?>
<div class="span-3" id="app_store">
<div style="color:gray; position:relative; left:82px; margin-top:0px;">
<?
$maillogfilename = "/home/geneesleer/ucheck/mail/cache/".$user;

if(!file_exists($maillogfilename) || filesize($maillogfilename) == 0)
{
	$post = array();
} else {
	$logfile = fopen($maillogfilename, 'r');
	if($logfile) $contents = fread($logfile, filesize($maillogfilename));
	$post = unserialize($contents);
}

if ($post && base64_decode($post["pass"]) != "") 
{
?>
<b>Mailservice</b>: uCheck mailt bij nieuwe cijfers. <a href="mail/">Wijzig.</a>
<?
} else {
?>
<b>Krijg een mail bij nieuwe cijfers!</b> <a href="mail/">Aanmelden mailservice.</a> <br/><small><i style="color:gray;">(je bent nog niet aangemeld)</i></small>
<?
}
?>
</div>
</div>
<?
}
?>


<div class="span-1 <? if(!isset($user)) { ?>push-3<? } ?>" id="facebook_mailen">
<iframe src="javascript:''" id="facebook" scrolling="no" 
frameborder="0" 
style="border:none; display:block; position:relative; top:12px; left:100px; overflow:hidden; width:130px; height:21px;" allowTransparency="true">
<div></div>
</iframe>
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
<hr />

<div style="color:gray; text-align: center;">
<p style="float:left; position: absolute; margin-top: 2em;">
<strong>Nieuw: </strong> De Android app voor uCheck!
</p>
<p>
<a href="http://itunes.apple.com/nl/app/ucheck/id449171216?l=nl&ls=1&mt=8" target="_blank"><img src="App_Store_Badge_EN.png" style=""/></a>
<a href="https://play.google.com/store/apps/details?id=info.vanderkooy.ucheck&hl=nl" target="_blank">
<img alt="Get it on Google Play" src="android_app_on_play_logo_large.png" />
</a>
</p>
<hr />
</div>
