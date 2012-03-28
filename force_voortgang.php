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

//ini_set('display_errors', 0);

include "raw/user_info.php";

$filename = $DOCUMENT_ROOT."voortgang_cache/".$user.".txt";

unlink($filename);

include("voortgang.php");

?>