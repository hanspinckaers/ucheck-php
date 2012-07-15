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

session_start();
$_SESSION = array();
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
    }
}
$_SESSION['user'] = "";
$_SESSION['pwd'] = "";

session_destroy();

setcookie ("user", "", time() - 3600 - 3600- 3600);
setcookie ("pwd", "", time() - 3600- 3600- 3600);

include "header.php" ?>

<div id="login">
<h3>uSis vervelend &amp; ingewikkeld? Probeer uCheck!</h3>
<hr/>
<? if($_GET['uitloggen']){ ?>
<h4 style="color:green;">uitgelogd</h4>
<? } ?>
<? 
//Detect special conditions devices
$iPod = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
$iPhone = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
// $iPad = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
$android= stripos($_SERVER['HTTP_USER_AGENT'],"android");
// $webOS= stripos($_SERVER['HTTP_USER_AGENT'],"webOS");

if( $iPod || $iPhone ){
?>
<b>Op een iPhone/iPod touch? <a href="http://itunes.apple.com/nl/app/ucheck/id449171216?l=nl&ls=1&mt=8">Download de gratis uCheck app in de App Store!</a></b>
<br/><br/>
<hr/>
<?
} else if($android)
{
?>
<b>Op een Android? <a href="https://play.google.com/store/apps/details?id=info.vanderkooy.ucheck">Download de gratis uCheck app op Google Play!</a></b>
<br/><br/>
<hr/>
<?
}
?>
<? if($_GET['error']){ ?>
<br/>
<h4 style="color:red;"><? echo htmlspecialchars($_GET['error']); ?></h4>
<p style="color:gray;">Probeer het opnieuw:</p>
<? } ?>

<p></p>
<form name="input" action="/" method="post">
<em>Studentnummer</em><br/><input type="text" name="user" /><br/><br/>
<em>Wachtwoord</em><br/><input name="pwd" type="password" /><br/><br/>
<input type="checkbox" name="cookie" value="cookie" id="cookie" /><label for="cookie"> Onthoud mijn nummer &amp; wachtwoord</label> <br/><br/>
<div id="mail_checkbox_div">
</div>
<input id="inloggen" type="submit" value="inloggen" />
<p></p>
<hr/>
<b>Tip:</b> krijg een mail bij nieuwe cijfers. <a href="https://ucheck.nl/mail/">Aanmelden mailservice.</a><br/>Of klik na inloggen bovenaan op <i>"aanmelden mailservice"</i>.<br/><br/>
<hr/>
<small>
Geen student of eerst even kijken? <br/>Probeer het <a href="demo/">demo-account</a>.
<br/><br/>
<strong>Je gegevens worden niet opgeslagen.</strong><br/><a href="beveiliging">Lees over de beveiliging</a>.
</small>

</form>

</div>
<!-- footer -->
<div style="clear:both">
<hr/>
<span style="color:gray">
<a href="http://nl.linkedin.com/in/hanspinckaers">Hans Pinckaers</a> &#8212; uCheck is <b>open-source</b>; help mee via GitHub: <a href="https://github.com/HansPinckaers/ucheck-php">PHP backend</a> en de <a href="https://github.com/HansPinckaers/ucheck-node">Node.js backend</a> 
<br/><em>De Android app is gemaakt door <a href="mailto:niek@vanderkooy.info">Niek van der Kooy</a> in samenwerking met uCheck. De app is open-source: <a href="https://github.com/niekvanderkooy/ucheck-android">https://github.com/niekvanderkooy/ucheck-android</a></em>
<br/>
<br/><em>Tip: Artikels buiten de universiteit lezen? Gebruik de proxy van de uni op: <a href="https://ucheck.nl/ez/">https://ucheck.nl/ez/</a></em>
</span>
<br/>
</div>

<script type="text/javascript" src="min/javascript.js"></script>

<script type="text/javascript">
window.addEvent('domready', function() {
	var user_textfield = $$("input[name='user']")[0];

	user_textfield.focus();
});
setTimeout(function(){
	$("facebook").src= "https://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fucheck.nl&layout=button_count&show_faces=false&width=220&action=like&colorscheme=light&height=28";		  	
}, 500);
</script>
<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-4063156-7']);
	_gaq.push(['_trackPageview']);
	_gaq.push(['_trackPageLoadTime']);

	(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script>