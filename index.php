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

include "raw/user_info.php";
include "header.php";

$_SESSION['cijfers_token'] = file_get_contents($NODE_SERVER."cijfers_token/$user/$pwd/", "r");
// $_SESSION['inschrijvingen_token'] = file_get_contents($NODE_SERVER."inschrijvingen_token/$user/$pwd/11/", "r");

?>

<div id="voortgang" class="span-6">

<?

$filename = $DOCUMENT_ROOT."voortgang_cache/".$user.".txt";

if(file_exists($filename) && ((time()-filemtime($filename))/(60*60) < 24*7))
{
	include "voortgang.php";
} else {
?>
<h1 class="first">Voortgang</h1>
<p>
<img class="loading" src="ajax-loader.gif"/>
</p>
<?
}
?>
</div>

<div id="cijfers_inschrijvingen" class="span-6">

<div id="toon_alles" style="display:none;">
<p>
<div class="word_line">
</div>
<span id="filter_year_keuze" class="word_line"><a href="#!" rel="10" onclick="load_year(10);" class="selectable"  style="display:none;">2010 - 2011</a> | <a href="#" onclick="load_year(11);" rel="11" class="selectable selected">2011 - 2012</a></span>
</p>
</div>

<p><hr style="position:relative; top:-4px;"/></p>


<div id="filter_studies" style="display:none;">

<p>
<div class="word_line">
</div>
<span id="filter_studies_keuze" class="word_line">
<a href="#!" class="selected selectable">Alles</a>
</span>
</p>

</div>


<div id="cijfers" class="span-3">


<h2>Cijfers</h2>

<table  border="0" cellspacing="0" cellpadding="0" id="cijfers">

<colgroup>
    <col class="vak" />
    <col class="cijfer" />
    <col class="ects" />
    <col class="datum" />
</colgroup> 

<tr>
<th class="vak round-top-left">
	 vak
</th>
<th class="cijfer">
</th>
<th class="ects">
	 ects
</th>
<th class="datum round-top-right">
	 datum
</th>
</tr>

<tr style="background-color:white;">
	<td class="laden last" colspan="4">
		Cijfers laden vanuit uSis (2 sec) <img class="loading" src="ajax-loader.gif"/>
	</td>
</tr>

</table>
<p></p>
</div>

<div id="inschrijvingen" class="span-3 last">

<h2>Inschrijvingen</h2>

<table  border="0" cellspacing="0" cellpadding="0" id="inschrijvingen">

<colgroup>
    <col class="checkbox" />
    <col class="vak" />
    <col class="info" />
</colgroup> 
<tr>
	<th class="checkbox">
	</th>
	<th class="vak">
		 vak
	</th>
	<th class="info" style="padding:0;">
		 rooster
	</th>
</tr>


<tr style="background-color:white;">
	<td class="laden last" colspan="4">
		Inschrijvingen laden vanuit uSis (5 sec) <img class="loading" src="ajax-loader.gif"/>
	</td>
</tr>

</table>
<p></p>
</div>

<div id="inschrijvingen_laden" style="display:none">
<h2>Inschrijvingen</h2>

<table  border="0" cellspacing="0" cellpadding="0" id="inschrijvingen">

<colgroup>
    <col class="checkbox" />
    <col class="vak" />
    <col class="info" />
</colgroup> 
<tr>
	<th class="checkbox">
	</th>
	<th class="vak">
		 vak
	</th>
	<th class="info">
		 info
	</th>
</tr>


<tr style="background-color:white;">
	<td class="laden last" colspan="4">
		Inschrijvingen laden vanuit uSis (3 sec) <img class="loading" src="ajax-loader.gif"/>
	</td>
</tr>

</table>
<p></p>
</div>

<div style="clear:both">
</div>

<div id="toon_alles">
<p>
</p>
</div>

<br/>

<div id="inschrijven" style="display:none;">

<h1>Inschrijven</h1>

<div id="toon_year_inschrijven" style="display:none;">
<p>
<div class="word_line">
</div>
<span id="filter_year_keuze_inschrijven" class="word_line"><a href="#!" rel="10" onclick="load_year_and_studie(10);" class="selectable">2010 - 2011</a> | <a href="#" onclick="load_year_and_studie(11);" rel="11" class="selected selectable">2011 - 2012</a></span>
</p>
</div>

<div id="eigen_studies">
<p>
<div class="word_line">
</div>
<span id="eigen_studies_keuze" class="word_line"><a href="#!" rel="10" onclick="load_year(10);" class="selectable">GNK</a></span>
</p>
</div>

<div id="toon_studies">
<p>
<div class="word_line">
</div>
<span id="filter_year_keuze" class="word_line">
<select name="Studies" id="studies" onchange="laadstudie()" style="">
<option value="" selected='selected'>--- Kies een studie ---</option>
<option value="ALG">Algemeen vakgebied</option>
<option value="ARAB">Arabische talen en culturen</option>
<option value="ARCH">Archeologie en prehistorie</option>
<option value="ASA">Area Studies Asia</option>
<option value="BSKE">Bestuurskunde</option>
<option value="BFW">Bio-farmaceutische wetenschap</option>
<option value="BIO">Biologie</option>
<option value="BIOM">Biomedische wetenschappen</option>
<option value="BOEK">Boek en digitale media</option>
<option value="CHE">Chemistry</option>
<option value="CLANEC">Classics Ancient Near East Civ</option>
<option value="CANS">Cult. antropologie ontw. soc.</option>
<option value="DUITS">Duitse taal en cultuur</option>
<option value="DUTCHST">Dutch Studies (Nederlandkunde)</option>
<option value="EGYPTE">Egyptische taal en cultuur</option>
<option value="ENGELS">Engelse taal en cultuur</option>
<option value="EUS">European Union Studies</option>
<option value="FGWALG">FGW Algemeen</option>
<option value="W%26N">Faculteit W&amp;N</option>
<option value="PHOTOGS">Film and Photographic studies</option>
<option value="FRANS">Franse taal en cultuur</option>
<option value="GNK">Geneeskunde</option>
<option value="GS">Geschiedenis</option>
<option value="GODG">Godgeleerdheid</option>
<option value="GRIEKLAT">Griekse Latijnse Taal &amp; Cult.</option>
<option value="HJS">Hebreeuwse en Joodse Studies</option>
<option value="HERV">Hervormde Kerk</option>
<option value="INDECO">Industrial Ecology</option>
<option value="INF">Informatica</option>
<option value="ISLM">Islamic Studies</option>
<option value="ISLT">Islamitische theologie</option>
<option value="ITAL">Italiaanse taal en cultuur</option>
<option value="JOURNIME">Journalistiek en nieuwe media</option>
<option value="FGWKERN">Kerncurriculum FGW</option>
<option value="FDK">Kunsten</option>
<option value="KG">Kunstgeschiedenis</option>
<option value="LAAS">Latin American Amerindian Stud</option>
<option value="LEIALG">Leiden algemeen</option>
<option value="LO">Lerarenopleiding</option>
<option value="FLEBYVAK">Letteren Bijvak</option>
<option value="FLEALG">Letteren algemeen</option>
<option value="LETTERK">Letterkunde</option>
<option value="LA%26S">Liberal Arts &amp; Sciences</option>
<option value="LST">Life Science and technology</option>
<option value="LITW">Literatuurwetenschap</option>
<option value="MANAGEME">Management</option>
<option value="MIDOOST">Midden Oosten Studies</option>
<option value="MST">Molecular science &amp; Technology</option>
<option value="MUZIEK">Muziek</option>
<option value="NSC">Nanoscience</option>
<option value="NTK">Natuurkunde</option>
<option value="NED">Nederlandse taal en cultuur</option>
<option value="NP">Nieuwperzische taal en cultuur</option>
<option value="OCMW">Oude Culturen van de Mediter W</option>
<option value="PEDA">Pedagogische wetenschappen</option>
<option value="POWE">Politicologie</option>
<option value="PKST">Praktijkstudies</option>
<option value="PREUNIV">Pre-university</option>
<option value="PSYC">Psychologie</option>
<option value="LAW">Rechten</option>
<option value="SEMI">Semitische talen en culturen</option>
<option value="SLAV">Slavische talen cult/Ruslandk.</option>
<option value="STK">Sterrenkunde</option>
<option value="TCIA">T&amp;C van Indiaans Amerika</option>
<option value="TCMA">T&amp;C van Mesopota &amp; Anatolië</option>
<option value="TAALK">Taalkunde</option>
<option value="TW">Taalwetenschap</option>
<option value="INDTIBET">Talen en Cult. India en Tibet</option>
<option value="INDONES">Talen en Culturen Indonesië</option>
<option value="AFRIKA">Talen en Culturen van Afrika</option>
<option value="TCLA">Talen en culturen Latijns Am</option>
<option value="CHINA">Talen en culturen van China</option>
<option value="JAPAN">Talen en culturen van Japan</option>
<option value="KOREA">Talen en culturen van Korea</option>
<option value="TCC">Talencentrum: Communicatie</option>
<option value="THEA">Theater- en filmwetenschap</option>
<option value="TURK">Turkse talen en culturen</option>
<option value="VIET">Vergelijkende Indo-Europese TW</option>
<option value="VTW">Vergelijkende Taalwetenschap</option>
<option value="LAVA">Vitality and ageing</option>
<option value="WYSB">Wijsbegeerte</option>
<option value="WSK">Wiskunde en statistiek</option>
<option value="ZZOAZIE">Zuid en Zuid-Oost Azië</option>
</select>
</span>
</p>
</div>

<div id="loopbaan_filter">
<p>
<div class="word_line">
</div>
<span id="loopbaan_keuze" class="word_line"><a href="#!" rel="10" onclick="" class="selectable">Alles</a></span>
</p>
</div>
   
<div id="toon_zoek">
<p>
<div class="word_line">
</div>
<span id="filter_year_keuze" class="word_line">
<input type="text" id="input_filter_zoek" />
</span>
</p>
</div>
<p>
<input type="checkbox" name="troep" value="" id="troep" onchange="laadstudie()" checked>
<label for="troep">Filter troep</label>
</p>
<table border="0" cellspacing="0" cellpadding="0" id="onderdelen">
</table>
<br/><small>Vak niet gevonden? Schakel de troep-filter uit en check voor de zekerheid uSis. Vak wel op uSis niet op uCheck? Geef dan alsjeblieft feedback.</small>
</div>

</div>

<!-- footer -->
<div style="clear:both">
<hr/>
<span style="color:gray">
<a href="http://nl.linkedin.com/in/hanspinckaers">Hans Pinckaers</a> &#8212; uCheck is <b>open-source</b>! Help mee via GitHub: <a href="https://github.com/HansPinckaers/ucheck-php">https://github.com/HansPinckaers/ucheck-php</a></span>
<br/>
</div>

</div>

<div id="background" style="display:none; position:fixed; top:0px; left:0; background-color:#f4f4f4; filter:alpha(opacity=75); -moz-opacity:0.75; -khtml-opacity: 0.75; opacity: 0.75;" onclick="hide()">
</div>

<div id="popup" style="display:none; border: 5px #d0d0d0 solid; z-index:999; position:absolute; top:200px; left:50%; margin-left:-360px; width:700px; height:auto; padding:10px; background-color:white; -moz-border-radius: 5px; border-radius: 5px; padding-bottom: 12px;" class="">
</div>

<div id="sluiten_help" style="display:none; position:absolute;  position:absolute; top:200px; left:50%; margin-left:380px; width:100px;">
<small>klik buiten<br/>om te sluiten</small>
</div>

<script type="text/javascript" src="min/javascript.js"></script>

<script type="text/javascript">
	window.addEvent('domready', function() {
		var myRequest = new Request({url: 'cijfers_html.php', method: 'get', onSuccess: function(responseText, responseXML) {
				$("cijfers").set('html',responseText);		
				
				check_filter("cijfers");
	/*
			  	setTimeout(function(){
			  		$("facebook").src= "https://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fucheck.nl&layout=button_count&show_faces=false&width=220&action=like&colorscheme=light&height=28";		  	
			  	}, 500);
	*/
			
			var myRequest = new Request({url: 'full_inschrijvingen.php?year=11', evalScripts:true, method: 'get', onSuccess: function(responseText, responseXML) {
				$("inschrijvingen").set('html',responseText);	
				
				<?
				
				$filename = $DOCUMENT_ROOT."voortgang_cache/".$user.".txt";
				
				if(file_exists($filename) && ((time()-filemtime($filename))/(60*60) < 24*7))
				{
				} else {				
				?>
				
				var myRequest = new Request({url: 'voortgang.php', evalScripts:true, method: 'get', onSuccess: function(responseText, responseXML) {
					$("voortgang").set('html',responseText);	
				}}).send();
				
				<?
				} 
				?>
				
				check_filter("inschrijvingen");
				
			}}).send();
			
		}}).send();
		
		setTimeout(function(){
			$("facebook").src= "https://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fucheck.nl&layout=button_count&show_faces=false&width=220&action=like&colorscheme=light&height=28";		  	
		},20 );
	});


</script>

<script type="text/javascript">
var myTips = new Tips('.tooltip', {
	fixed: true,
	offset: {x: 0, y: 25}

});

var myTips2 = new Tips('.tooltip_big', {
	fixed: true,
	offset: {x: 0, y: 28}
});
<? 
if(!$gemaild) {
?>
if($("mail_button")){
$("mail_button").addEvent("click", function(e)
{	
	var myRequest = new Request({url: 'mail.php', method: 'get', onSuccess: function(responseText, responseXML) {}}).send();
	
	e.target.rel = "Je hebt 5 medestudenten geholpen door ze te wijzen op uCheck. <br/><b>Namens hen: bedankt!</b>";
	e.target.innerHTML = "Bedankt voor het mailen!";
	e.target.title = "";
	
	e.target.store('tip:title', '');
	e.target.store('tip:text', 'Je hebt 5 medestudenten geholpen door ze te wijzen op uCheck. <br/><b>Namens hun: bedankt!</b>');

	myTips.setTitle("");
	myTips.setText("Je hebt 5 medestudenten geholpen door ze te wijzen op uCheck. <br/><b>Namens hen: bedankt!</b>");
	
	$("mail_button").removeEvents("click");
});
}
<? } ?>
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


<a href="https://hanspinckaers.wufoo.com/forms/z7x3k7/" onclick="window.open(this.href,  null, 'height=470, width=680, toolbar=0, location=0, status=1, scrollbars=1, resizable=1'); return false" title="uCheck Feedback" style="top:77px; height:105px; color:white; cursor:pointer; text-indent:-100000px; overflow:hidden; position:absolute; z-index:100000; right:0px; left:auto; margin-right:0px; margin-left:auto; width:32px; background-image:url(Feedback.png); background-position:-3px center; opacity:0.9">Please fill out my form.</a>

<?  
if(file_exists("raw/mail/bezocht.txt"))
{
	$filename = "raw/mail/bezocht.txt";

	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	$users = unserialize($contents);	
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {	
		if($users && !in_array(strtolower($user), $users) &&  
			strtolower(substr($user, 0, 1)) == "s" && 
			(strlen($user) == 8))
		{
			$users[] = strtolower($user);
		
			fclose($handle);
			$handle = fopen($filename, "w");
			fwrite($handle, serialize($users));		
			
			try {
			include('Galvanize.php');
			$GA = new Galvanize('UA-4063156-10');
			$GA->trackPageView("index.php", "nieuwe student");
			} catch (Exception $e) {}	
		}
	}
		
	fclose($handle);
}
?>

</body>
</html>
