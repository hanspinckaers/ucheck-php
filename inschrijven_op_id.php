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

include "raw/inschrijven_op_id.php";

if(isset($matches[0]))
{
	$melding = $matches[0];
	echo "<span style='color:black;'>".$melding."</span>";
} else {
	echo "<span style='color:orange;'>Het is niet bekend of het goed gegaan is, controleer onder inschrijvingen of deze eronder staat. </span>";
}

?>