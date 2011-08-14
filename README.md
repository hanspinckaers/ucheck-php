uCheck
======
 
uCheck automatiseert ingewikkelde stappen op uSis. Zodat Leidse studenten zich makkelijker kunnen inschrijven voor studieonderdelen en sneller hun cijfers kunnen controleren.
 
Servers
-------

uCheck.nl draait op 2 servers. Eén met een php-backend en de ander met een node.js (serverside javascript) backend.

De php-backend regelt 
* De front-end van uCheck (html, css, javascript)
* Het inschrijven/uitschrijven
* Elke nacht worden de vakken van alle studies gedownload om lokaal te cachen
* De api voor de uCheck iOS app

De node.js-backend regelt
* Het scrapen van de cijfers, inschrijvingen naar JSON
* Het scrapen van de voortgang naar HTML (wordt geparst door de php-backend)

Ik heb 2 node.js servers staan. Eén op een betaalde hosting in Amsterdam en nog eentje op het gratis node.js hostingplatform [nodester](http://nodester.com/). De betaalde hosting is aanzienlijk sneller, daarom gebruik ik hem nog steeds.

Niet inbegrepen
---------------

In de repo zijn niet de encryptie en decryptie functies van uCheck toegevoegd. Deze blijven geheim ten behoeve van de beveiliging van uCheck.