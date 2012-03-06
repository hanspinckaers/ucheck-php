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

include "raw/uitschrijven.php";

if(isset($matches[0]))
{
	echo "{'respons':".json_encode($matches[0][0])."}";
} else {
	echo "{'respons': 'Het is niet bekend of het goed gegaan is, vernieuw de pagina en controleer onder inschrijvingen of deze eronder staat.'}";
}

?>