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

include "raw/inschrijvingen.php";
 
if(isset($inschrijvingen)){
?>

<? 
$counter = 0;
foreach($inschrijvingen as $inschrijving){ 
$counter++;
?>

<tr rel="<? echo $inschrijving['studie']; ?>" class="shown">
<td class="check">
<input type="checkbox" name="<? echo $inschrijving['stopid']; ?>" value="uitschrijven">
</td>
<td>
<? 
$explodedTitle = explode("(",$inschrijving['vak'], 2);    
if(count($explodedTitle) == 2) echo $explodedTitle[0]." (".$explodedTitle[1];
else echo $explodedTitle[0];
?>
</td>
<td>
<?
preg_match("/\(([0-9]+)/", $inschrijving['code'], $usis_code);
?>
<a style="display:block;" href="roosterinfo.php?id=<? echo $usis_code[1]; ?>&title=<? echo $explodedTitle[0]; ?> - <? echo $inschrijving['id']; ?>" target="_blank" onclick="window.open(this.href,'window','top=100,width=730,height=480,resizable,scrollbars,toolbar,menubar') ;return false;"><? echo $inschrijving['id']; ?></a>
</td>
</tr>


<? } 
if(count($inschrijvingen_gehaald) > 0)
{
?>
<tr class="space">
	<td style="background-color:white;" colspan="5">
		 <div class="word_line"/></div>
		 <span class="word_line">afgelopen</span>
	</td>
</tr>
<?
$counter++;

foreach($inschrijvingen_gehaald as $inschrijving){ 

$counter++;
?>

<tr style="color:gray;" rel="<? echo $inschrijving['studie']; ?>" class="shown">
<td class="check">
<input type="checkbox" name="<? echo $inschrijving['stopid']; ?>" value="uitschrijven">
</td>
<td>
<? 
$explodedTitle = explode("(",$inschrijving['vak'], 2);    
if(count($explodedTitle) == 2) echo $explodedTitle[0]." (".$explodedTitle[1];
else echo $explodedTitle[0];
?>
</td>
<td>
<? 
echo $inschrijving['id']; ?>
</td>
</tr>

<? }

}
?>
<tr style="background-color:white;">
	<td class="laden last" colspan="4" style="padding-top:11px;">
		<a href="#!" onclick="displayUitschrijven()">Geselecteerde inschrijvingen uitschrijven</a>
	</td>
</tr>


<? } ?>