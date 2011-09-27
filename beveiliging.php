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

include "header.php";
?>
<b><a href="/">Ga terug</a></b><br/><br/>
<hr/>
<h3>De beveiliging</h3>
<h2>
In het kort
</h2>
<ul>
<li>Je wachtwoord wordt <strong>versleuteld</strong>, alleen op <strong>jouw computer</strong>, <strong>tijdelijk</strong> bewaard.</li>
<li>Op de server van uCheck worden <strong>nooit</strong> wachtwoorden bewaard. Tenzij je je aanmeldt voor de mailservice.</li>
<li>Als je ervoor kiest je studentnummer/wachtwoord op te slaan in een cookie, loop je geen extra risico.</li>
<li>Als je uitlogt wordt je wachtwoord verwijderd. <a href="logout.php">Uitloggen</a>.</li>

</ul>

<br/>
<hr/>

<h3>Hoe is uCheck beveiligd?</h3>

<p>
uCheck communiceert met uSis via jouw inlognaam en wachtwoord. Je studentnummer en wachtwoord worden versleuteld opgeslagen in een zogenaamde sessie. Op de achtergrond wordt beveiligd met uSis gecommuniceerd.</p>

<p>Als je de website sluit dan wordt deze sessie, samen met dus je wachtwoord, verwijderd en moet je dus weer opnieuw inloggen op uCheck.</p>

<p>
Als je ervoor kiest je studentennummer en wachtwoord op te slaan in een cookie, dan worden deze ook versleuteld bewaard.
</p>

<h3>https:// beveiliging</h3>
<p>
Naast de versleuteling is uCheck nu ook beveiligd met SSL. Dit kan je zien aan het adres, daar staat namelijk https://. Ergens in de browser staat ook een slotje, dat is beide een teken van extra beveiliging. 
</p>

<p>
Lees meer over SSL/https: <a href="http://nl.wikipedia.org/wiki/HTTPS">HTTPS op wikipedia.</a>
</p>
<hr/>
<p>
Als je nog vragen hebt kun je mij bellen: 06-34856950
</p>

<!--
<h3>Hoe veilig is de cookie?</h3>
<p>
Een cookie is niet 100% veilig. Op een open (wifi-)netwerk, waar je op kan zonder wachtwoord, is het voor hackers mogelijk om cookies te stelen. Mocht een hacker uw cookie ontvangen dan ziet hij jouw gegevens <strong>niet</strong>. In plaats daarvan ziet hij hele rare tekens waar jouw wachtwoord in verborgen zit, aangezien alleen uCheck de sleutel heeft om dit te decoderen kan de hacker hier niets mee. 
</p>

<p>
Een handige hacker kan wel de cookie gebruiken om namens jouw in te loggen op uCheck, maar <strong>nooit</strong> op uSis. Om dit te voorkomen heeft uCheck nog extra beveiliging, maar uCheck kan geen 100% beveiliging garanderen.
</p>


<h3>Waarom gebruik je geen "https://"?</h3>
<p>
Omdat het geld kost. Ik ben ook nog niet overtuigd om https te gebruiken. Je kan mij overtuigen door <a href="hanspinckaers.com/contact">contact</a> op te nemen. 
</p>
-->
</div>
<? include "footer.php" ?>
