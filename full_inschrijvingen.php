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

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

include "raw/user_info.php";

?>
<div id="inschrijvingen" class="span-3 last">
<h2>Inschrijvingen</h2>
<table border="0" cellspacing="0" cellpadding="0">
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

<tr class="nieuwe_inschrijving">
	<td class="check">
		<!--<a href="!#"><img src="add.png" /></a>-->
		<span style="color:green; font-weight:bold;">+</span>
	</td>
	<td colspan="2">
		 <a href="#!" onclick="display_inschrijven();"><b>Inschrijven voor studieonderdeel</b></a>
	</td>
</tr>

<?
include("inschrijvingen_html.php");
?>

</table>
<p></p>