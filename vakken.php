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

include "raw/vakken.php";
?>
<colgroup>
    <col class="naam" />
    <col class="loopbaan" />
    <col class="ects" />
    <col class="identificatie" />
    <col class="bekijk" />
</colgroup> 


<tr>
  <th>naam van onderdeel</th>
  <th class="center">loopbaan</th>
  <th class="center">ects</th>
  <th class="center">nummer</th>
  <th class="center">bekijk</th>
</tr>
<?

function subval_sort($a,$subkey) {
	foreach($a as $k=>$v) {
		$b[$k] = strtolower($v[$subkey]);
	}
	asort($b);
	foreach($b as $k=>$v) {
		$c[] = $a[$k];
	}
	return $c;
}

$inschrijven = subval_sort($inschrijven, "gidsnummer");

$counter = 0;

$gehaalden = $_SESSION['gehaald'];
$inschrevenarr = $_SESSION['ingeschreven'];

foreach($inschrijven as $vak){ 

$gehaald = false;
$inschreven = false;
$voorbij = false;

//if(in_array($vak['gidsnummer'], $inschrevenarr))
//{
//	$inschreven = true;
//}

//if(isset($gehaalden))
//{
//	foreach($gehaalden as $shit)
//	{			
//		if(strpos($vak['gidsnummer'], $shit) !== false)
//		{
//			$gehaald = true;
//		} 
//	}
//}

if(!$gehaald){
	
//	$voorbij = true;
	
//	foreach($vak['deelactiviteiten'] as $deelactiviteit)
//	{
//		foreach($deelactiviteit['data'] as $data)
//		{
//				
//			//hij is nog geldig
//			if($data['orginele_datum'] - time() >= 0)
//			{
//				$voorbij = false;
//			} 	
			
//			if(!isset($data['orginele_datum']))
//			{
//				$voorbij = false;
//			}
			
//		}			
//	}	
	
}
		
$eerste_vier_cijfers_t = substr($vak["gidsnummer"], 0, 4);

if($eerste_vier_cijfers_t != $eerste_vier_cijfers && $counter != 0)
{
$counter++;
?>
<tr class="space">
<td style="background-color:white;" colspan="5">
<div class="word_line"></div>
<span class="word_line"></span>
</td>
</tr> 
<?
}
$eerste_vier_cijfers = $eerste_vier_cijfers_t;

$counter++;
?>
<tr style="<? 
	if($voorbij) { ?> color:gray; <? 
	} else if($gehaald) { ?>
	color:gray;
	<? } else if($inschreven)
	{ ?>
	color:green;
	<? } ?>" id="id_<? echo $counter; ?>">  	
<td class="title"><? 
$explodedTitle = explode("(",$vak["titel"], 2);    
if(count($explodedTitle) == 2) echo "<b>".$explodedTitle[0]."</b> (".$explodedTitle[1];
else echo "<b>".$explodedTitle[0]."</b>";
?>
<span style="display:none" class="usis_id"></span></td>

<td class="loopbaan"><em><? echo $vak["loopbaan"] ?></em></td>
<td><? echo $vak["eenheden"] ?></td>
<td><small><? echo $vak["gidsnummer"] ?></small></td>

<td><a href="javascript:display_detail('id_<? echo $counter; ?>','<? echo $vak["gidsnummer"] ?>')" style="<? if($gehaald || $inschreven || $voorbij) { ?> color:gray; <? } ?>">Bekijk</a></td>
</tr>

<? } 
//
?>