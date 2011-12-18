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

include "raw/details.php";

$nummer_onderdeel = -1;
$first = true;
$table = false;
$firstFilter = true;
$last_begin_title = "";

foreach($onderdelen as $onderdeel)
{
$nummer_onderdeel++;

if( (!$onderdeel['Nr studieactiv.'] || $onderdeel['Nr studieactiv.'] == "") &&
	(!$onderdeel['enabled']) && count($onderdelen) != 1 && !$onderdeel['enabled'] && $first && $firstFilter)
{
	$firstFilter = false;
	continue;	
}

$deelvak = ($onderdeel['Verplicht'] != "" && $onderdeel['Omschrijving'] != "");

if($deelvak || !$table)
{

if(!$first){
?>

</table>
<br/>
<? 
} else {
	$first = false;
} //first
?>

<p></p>
<h4>
<? echo $onderdeel['Omschrijving']; 
$last_begin_title = $onderdeel['Omschrijving'];
 if($onderdeel['Verplicht'] != "Ja"){ 
?>
 <span style="color: gray">niet verplicht</span>
<? } else { ?>
 <span style="color: red">verplicht</span>
<?
}
?></h4>

<table  border="0" cellspacing="0" cellpadding="0" class="deelactiviteit">

<colgroup>
<col style="width:428px;" />
<col style="width:75px;" />
<col style="width:75px;" />
<col style="width:90px;" />
</colgroup> 

<tr class="no_hover class_<? echo str_replace("$", "", $onderdelen[0]['id']);  ?>">		
<th>info</th>
<th>eenheden</th>
<th>status</th>
<th></th>
</tr>

<? 
$table = true;
}
// 
preg_match("/\(([0-9]+)/", $onderdeel['Nr studieactiv.'], $usis_code);
?>
<tr id="row_detail_<? echo $onderdeel['id']; echo "_".$nummer_onderdeel ?>">
  <td><? echo ($onderdeel['Nr studieactiv.']) ? $onderdeel['Nr studieactiv.'] : $onderdeel['Omschrijving'] ; ?> (<i><a href="roosterinfo.php?id=<? echo $usis_code[1]; ?>&title=<? echo $last_begin_title; ?> - <? echo $onderdeel['Nr studieactiv.']; ?>" target="_blank" onclick="window.open(this.href,'window','top=100,width=730,height=480,resizable,scrollbars,toolbar,menubar') ;return false;">roosterinformatie</a></i>)</td>
  <td><? echo $onderdeel['Eenheden']; ?></td>
  <td><? echo $onderdeel['Status']; ?></td>
  <td class="inschrijving_link">
  <? if($onderdeel['enabled']) { 
  $number_check = count($onderdelen);
  ?>
  <a href="#!" onclick="<? 
  	echo "inschrijven_detail('".$_GET['q']."', '".$onderdeel['id']."_".$nummer_onderdeel."', '".$nummer_onderdeel."', '".$number_check."');"  
  ?>">Inschrijven</a>
  <? } ?></td>
</tr>
	
<?
if($deelvak)
{ 


 } //$deelvak ?>

<?
} //end onderdelen
?>
</table>

<p></p>
<p style="color:gray">Link inschrijven niet aanwezig? Dan sta je of al ingeschreven, of inschrijven is (nog) niet mogelijk.</p>