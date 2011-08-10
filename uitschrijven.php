<?
include "raw/uitschrijven.php";

if(isset($matches[0]))
{
	echo "{'respons':".json_encode($matches[0])."}";
} else {
	echo "{'respons': 'Het is niet bekend of het goed gegaan is, vernieuw de pagina en controleer onder inschrijvingen of deze eronder staat. Sorry!'}";
}

?>