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

include "raw/cijfers.php";

if(isset($vakken) && count($vakken) > 0)
{
?>
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
<th class="cijfer center">
</th>
<th class="ects center">
	 ects
</th>
<th class="datum round-top-right center">
	 datum
</th>
</tr>
<? 
$counter = 0;

foreach($vakken as $cijfer)
{ 

$counter++;

$raw_date = strtotime($cijfer["date"]);

$date = strftime('%d %h %Y', $raw_date);

$month = strftime("%m", $raw_date);
$year = strftime("%Y", $raw_date);

if($month < 9 && $previousMonth >= 9)
{
if($year == $previousYear)
{
?>
<tr class="space">
<td style="background-color:white;" colspan="5">
<div class="word_line"></div>
<span class="word_line">jaarwisseling</span>
</td>
</tr>
<?
$counter++;
}
}

$previousMonth = $month;
$previousYear = $year;

$key = array_search($cijfer, $vakken);
if($key == count($vakken)-1)
{
$last = true;
}
?>
  
<tr style="" rel="<? echo $cijfer["studie"]; ?>" class="shown">
<td class="vak <? if($last) echo 'last'; ?>">
	 <? if($cijfer["her"] == "ja") { ?> <span style="color:red;">HER </span> <? } ?><? echo $cijfer["vak"]; ?>
</td>
<td class="cijfer">
	<b <? if(!$cijfer["gehaald"]) { ?> style="color:#d63636;" <? } ?>><? echo $cijfer["cijfer"]; ?></b>
</td>
<td class="ects">
	<em><? echo $cijfer["ects"]; ?></em>
</td>
<td class="datum <? if($last) echo 'last'; ?>" >
	 <? echo $date; ?>
</td>
</tr>

<? } ?>

</table>
<p></p>
<!--
<div id="voortgang">
<hr/>
<h3>Voortgang studie</h3>
<p>
Jouw studievoortgang laden <img style="top:6px; position:relative;" src="ajax-loader.gif"/>
</p>
</div>
-->

<? } else { ?>

<h3>Geen cijfers gevonden, juiste inloggegevens ingevuld? <br/><br/><a href="logout.php">Opnieuw inloggen.</a></h3>

<? 
}  
?>
