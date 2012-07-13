uCheck (PHP backend)
======
 
uCheck automatiseert ingewikkelde stappen op uSis. Zodat Leidse studenten zich makkelijker kunnen inschrijven voor studieonderdelen en sneller hun cijfers kunnen controleren.
 


Install
-------
Gebruik de files op een server met PHP. MySQL database oid is niet nodig. Code werkt 'out-of-the-box'.
 
API
----

Gebruik: `https://ucheck.nl/api/login.php?user=<user>&pass=<wachtwoord>`
Om user/pass te controleren. 

Voorbeeld: [https://ucheck.nl/api/login.php?user=s0924121&pass=1234](https://ucheck.nl/api/login.php?user=s0924121&pass=1234https://ucheck.nl/api/login.php?user=s0924121&pass=1234https://ucheck.nl/api/login.php?user=s0924121&pass=1234)

Als het wachtwoord klopt krijg je een key terug. 
Bijvoorbeeld: `-abs8zOLQ0o9Lr2W8-l1ZFuA4fN9MDAEeIgHI1br0wefVCS8forpCV72Ar78EJ_vlWUu9JZ70D86RUxaXIKojKX9Sa5tTRtoVT1Mag9VKPU`

Gebruik deze key voor de volgende api functies, deze key kan je ook opslaan in de app:
* Cijfers: `https://ucheck.nl/api/cijfers.php?user=<user>&pass=<key>`
* Inschrijvingen: `https://ucheck.nl/api/inschrijvingen.php?user=<user>&pass=<key>`
* Voortgang (in html): `https://ucheck.nl/api/voortgang.php?user=<user>&pass=<key>`

Servers
-------

uCheck.nl draait op 2 servers. Eén met een php-backend en de ander met een node.js (serverside javascript) backend.

De [PHP backend](https://github.com/HansPinckaers/ucheck-php/) regelt:

*	De front-end van uCheck (html, css, javascript)
*	Het inschrijven/uitschrijven
*	Elke nacht worden de vakken van alle studies gedownload om lokaal te cachen
*	De api voor de uCheck iOS app

De [Node.js backend](https://github.com/HansPinckaers/ucheck-node/) regelt:

*	Het scrapen van de cijfers, inschrijvingen naar JSON
*	Het scrapen van de voortgang naar HTML (wordt geparst door de php-backend)

Ik heb 2 node.js servers staan. Eén op een betaalde hosting in Amsterdam en nog eentje op het gratis node.js hostingplatform [nodester](http://nodester.com/). De betaalde hosting is aanzienlijk sneller, daarom gebruik ik hem nog steeds.


Niet inbegrepen
---------------

In de repo zijn niet de encryptie en decryptie functies van uCheck toegevoegd. Deze blijven geheim ten behoeve van de beveiliging van uCheck.