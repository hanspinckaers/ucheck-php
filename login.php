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

<? if($_GET['uitloggen']){ ?>
<h4 style="color:green;">uitgelogd</h4>
<? } ?>

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
<br/>
<div style="clear:both">
<hr/>
<span style="color:gray">
<a href="http://nl.linkedin.com/in/hanspinckaers">Hans Pinckaers</a> &#8212; uCheck is <b>open-source</b>; Help mee via GitHub: <a href="https://github.com/HansPinckaers/ucheck-php">PHP backend</a> en de <a href="https://github.com/HansPinckaers/ucheck-node">Node.js backend</a></span>
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