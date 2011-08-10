<?
ini_set('display_errors', 0);

include("raw/user_info.php");

$filename = $_SERVER["DOCUMENT_ROOT"]."voortgang_cache/".$user.".txt";

if(file_exists($filename) && ((time()-filemtime($filename))/(60*60) < 24*7))
{	
	$html = file_get_contents($filename);
} else {
	
	$url = "http://109.72.92.55:3000/voortgang/$user/$pwd/";
	
	//open connection
	$ch = curl_init();
	
	$ip=$_SERVER['REMOTE_ADDR'];
	
	//set the url, number of POST vars, POST data
	$useragent="Fake Mozilla 5.0";
	
	curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
	
	//execute post
	$html = curl_exec($ch);
	
	//close connection
	curl_close($ch);  

	$logfile = fopen($filename, 'w') or die("can't open file");	
	
	fwrite($logfile, $html);

	fclose($logfile);
}

$studiesraw = explode("<td class='PSGROUPBOXLABEL'  align='left'><a name='DERIVED_SAA_DPR_GROUPBOX", $html);

$studies = array();

foreach( $studiesraw as $studieonderdeel )
{	

	$studiedeelarr = explode("<tr><td class='PAGROUPDIVIDER' align='left'>", $studieonderdeel);
			
	preg_match("/border='0' \/><\/a>(.*)<\/td><\/tr>/", $studiedeelarr[0], $title);	
	preg_match("/Eenh.: ([0-9\.]*) vereist, ([0-9\.]*) gevolgd, ([0-9\.]*) nodig/", $studiedeelarr[0], $punten);
	preg_match("/Cijfergemiddelde: ([0-9\.]*) vereist, ([0-9\.]*) werkelijk/", $studiedeelarr[0], $gem);		
		
	if(!isset($punten[1])) continue;	
		
 	$studies[]['title'] = str_replace("&nbsp;", "", $title[1]);
	$studies[count($studies)-1]['eenh_vereist'] = $punten[1];
	$studies[count($studies)-1]['eenh_gevolgd'] = $punten[2];
	$studies[count($studies)-1]['eenh_nodig'] = $punten[3];

	$studies[count($studies)-1]['gem_vereist'] = $gem[1];
	$studies[count($studies)-1]['gem_werkelijk'] = $gem[2];
					
	$counter = -1;
			
	foreach($studiedeelarr as $studiedeel)
	{
		$counter++;
		if($counter == 0) continue;
				
		$studiesubdelen = explode("<table cellpadding='0' cellspacing='0' cols='1'  class='PSLEVEL1SCROLLAREABODYNBOWBO'  width='603'>", $studiedeel);		
		
		preg_match("/(.*)<\/td><\/tr>/", $studiesubdelen[0], $title);
		preg_match("/Eenh.: ([0-9\.]*) vereist, ([0-9\.]*) gevolgd, ([0-9\.]*) nodig/", $studiesubdelen[0], $punten);
		preg_match("/Cijfergemiddelde: ([0-9\.]*) vereist, ([0-9\.]*) werkelijk/", $studiesubdelen[0], $gem);		
							
	 	$studies[count($studies)-1]['onderdelen'][$counter-1]['title'] = str_replace("&nbsp;", "", $title[1]);
		$studies[count($studies)-1]['onderdelen'][$counter-1]['eenh_vereist'] = $punten[1];
		$studies[count($studies)-1]['onderdelen'][$counter-1]['eenh_gevolgd'] = $punten[2];
		$studies[count($studies)-1]['onderdelen'][$counter-1]['eenh_nodig'] = $punten[3];

		$studies[count($studies)-1]['onderdelen'][$counter-1]['gem_vereist'] = $gem[1];
		$studies[count($studies)-1]['onderdelen'][$counter-1]['gem_werkelijk'] = $gem[2];
				
		$subcounter = -1;
				
		if(!isset($title[1])) continue;
		
		$studies[count($studies)-1]['onderdelen'][$counter-1]['sub'] = array();
		
		foreach($studiesubdelen as $studiesubdeel)
		{
			if($subcounter == -1){
				$subcounter = 0;
				 continue;
			}
		
			preg_match("/border='0' \/><\/a>(.*)<\/td><\/tr>/", $studiesubdeel, $title);
			preg_match("/Eenh.: ([0-9\.]*) vereist, ([0-9\.]*) gevolgd, ([0-9\.]*) nodig/", $studiesubdeel, $punten);
			preg_match("/Cijfergemiddelde: ([0-9\.]*) vereist, ([0-9\.]*) werkelijk/", $studiesubdeel, $gem);		
								
			if(isset($title[1])  && isset($punten[1]) ){
				$studies[count($studies)-1]['onderdelen'][$counter-1]['sub'][$subcounter]['title'] = str_replace("&nbsp;", "", $title[1]);
											
				$studies[count($studies)-1]['onderdelen'][$counter-1]['sub'][$subcounter]['eenh_vereist'] = $punten[1];
				$studies[count($studies)-1]['onderdelen'][$counter-1]['sub'][$subcounter]['eenh_gevolgd'] = $punten[2];
				$studies[count($studies)-1]['onderdelen'][$counter-1]['sub'][$subcounter]['eenh_nodig'] = $punten[3];
		
				$studies[count($studies)-1]['onderdelen'][$counter-1]['sub'][$subcounter]['gem_vereist'] = $gem[1];
				$studies[count($studies)-1]['onderdelen'][$counter-1]['sub'][$subcounter]['gem_werkelijk'] = $gem[2];
			}
			
			$subcounter++;
		}
	}
}
?>

<div id="voortgang_inner">

<? 
$counter = 0;

foreach($studies as $studie)
{
$counter++;
?>

<h1 class="<? if($counter == 1) echo 'first'; ?>"><? echo $studie['title']?></h1>
<!-- te lui voor in main css -->
<div class="hoofdbalk" onclick="display_voortgang('<? echo $counter; ?>')" style="cursor:pointer;">
	<div  class="<? if($onderdeel['eenh_nodig'] == "0.000"){ echo "filled_balk"; } else { echo "filled_balk_blauw"; } ?>" style="width:<? echo round(($studie['eenh_gevolgd'] / $studie['eenh_vereist'])*100) ?>%;">
		<span style="display:block; padding-left:10px;  width:200px"><strong><? echo (int)$studie['eenh_gevolgd']; ?></strong> ECTS <em>(<? echo round(($studie['eenh_gevolgd'] / $studie['eenh_vereist'])*100) ?>%)</em></span>
	</div>
	
	<? if($studie['eenh_vereist'] - $studie['eenh_gevolgd'] != 0){ ?>
	<div class="nog_balk">
	nog <strong><? echo $studie['eenh_vereist'] - $studie['eenh_gevolgd']; ?></strong> ECTS <em>(<? echo 100-round(($studie['eenh_gevolgd'] / $studie['eenh_vereist'])*100) ?>%)</em>
	<? } ?>
	</div>
	
</div>
<div style="clear:both; position:relative; top:5px;  padding-bottom:1.5em;"> 
<? 
if (isset($studie['gem_werkelijk']) && $studie['gem_werkelijk'] != "" && $studie['gem_werkelijk'] != "0.000")
{
?>
Gemiddelde: <strong><? echo $studie['gem_werkelijk']?></strong>
<?
} else {
?>
<?
}
?>
</div>
<div style="position:relative; left:5%; width:95%;display:none;" id="hidden_<? echo $counter ?>">
<? 
####### SUBSTUDIES
foreach($studie['onderdelen'] as $onderdeel)
{
?>
<h3><? echo $onderdeel['title']?></h3>
<!-- te lui voor in main css -->
<? 
if($onderdeel['eenh_gevolgd'] && $onderdeel['eenh_vereist'])
{
?>
<div class="hoofdbalk">
	<div class="<? if($onderdeel['eenh_nodig'] == "0.000"){ echo "filled_balk"; } else { echo "filled_balk_blauw"; } ?>" style="width:<? echo round(($onderdeel['eenh_gevolgd'] / $onderdeel['eenh_vereist'])*100) ?>%;">

	<? 
	//if($onderdeel['eenh_nodig'] == "0.000") echo "E9F9E0"; 
	//else echo "e5ecf9"; 
	?>
	<span style="display:block; padding-left:10px;  width:200px"><strong><? echo (int)$onderdeel['eenh_gevolgd']; ?></strong> ECTS <em>(<? echo round(($onderdeel['eenh_gevolgd'] / $onderdeel['eenh_vereist'])*100) ?>%)</em></span>
	</div>
	
	<? if($onderdeel['eenh_vereist'] - $onderdeel['eenh_gevolgd'] != 0){ ?>
	<div class="nog_balk">
	nog <strong><? echo $onderdeel['eenh_vereist'] - $onderdeel['eenh_gevolgd']; ?></strong> ECTS<em> (<? echo 100-round(($onderdeel['eenh_gevolgd'] / $onderdeel['eenh_vereist'])*100) ?>%)</em>
	</div>
	<? } ?>
	
</div>
<?
}
?>
<div style="clear:both; position:relative; top:5px;  padding-bottom:1.5em;"> 
<? 
if (isset($onderdeel['gem_werkelijk']) && $onderdeel['gem_werkelijk'] != "" && $onderdeel['gem_werkelijk'] != "0.000")
{ ?>
Gemiddelde: <strong><? echo $onderdeel['gem_werkelijk']?></strong> 
<? 
} else {

if(!(count($onderdeel['sub']) == 1 && $onderdeel['sub'][0]['eenh_gevolgd'] == $onderdeel['eenh_gevolgd'] && $onderdeel['sub'][0]['eenh_vereist'] == $onderdeel['eenh_vereist']))
{ 
if (isset($onderdeel['sub'][0]['gem_werkelijk']) && $onderdeel['sub'][0]['gem_werkelijk'] != "" && $onderdeel['sub'][0]['gem_werkelijk'] != "0.000")
{
?>
Gemiddelde: <strong><? echo $onderdeel['sub'][0]['gem_werkelijk'] ?></strong> 
<?
}  else {
echo "";
}
} else {
echo "";
} //endif 
} //end if gem sucks
?>
</div>

<div style="position:relative; left:5%; width:95%;">
<?
####### SUBS
if(!(count($onderdeel['sub']) == 1 && $onderdeel['sub'][0]['eenh_gevolgd'] == $onderdeel['eenh_gevolgd'] && $onderdeel['sub'][0]['eenh_vereist'] == $onderdeel['eenh_vereist'])){
foreach($onderdeel['sub'] as $sub)
{
?>
<h3><? echo $sub['title']?></h3>
<!-- te lui voor in main css -->
<div class="hoofdbalk">
	<div class="<? if($onderdeel['eenh_nodig'] == "0.000"){ echo "filled_balk"; } else { echo "filled_balk_blauw"; } ?>" style="width:<? echo round(($sub['eenh_gevolgd'] / $sub['eenh_vereist'])*100) ?>%;">
	<? 
	//if($sub['eenh_nodig'] == "0.000") echo "E9F9E0"; 
	//else echo "e5ecf9"; 
	?>
	<span style="display:block; padding-left:10px;  width:200px"><strong><? echo (int)$sub['eenh_gevolgd']; ?></strong> ECTS <em>(<? echo round(($sub['eenh_gevolgd'] / $sub['eenh_vereist'])*100) ?>%)</em></span>
	</div>
	
	<? if($sub['eenh_vereist'] - $sub['eenh_gevolgd'] != 0){ ?>
	<div class="nog_balk">
	nog <strong><? echo $sub['eenh_vereist'] - $sub['eenh_gevolgd']; ?></strong> ECTS<em> (<? echo 100-round(($sub['eenh_gevolgd'] / $sub['eenh_vereist'])*100) ?>%)</em>
	</div>
	<? } ?>
	
</div>
<div style="clear:both; position:relative; top:5px; padding-bottom:1.5em;"> 
<? 
if (isset($sub['gem_werkelijk']) && $sub['gem_werkelijk'] != "" && $sub['gem_werkelijk'] != "0.000"){ ?>Gemiddelde: <strong><? echo $sub['gem_werkelijk']?></strong> <? } else { echo ""; }
?>
</div>

<? } } ?>

</div>

<? } ?>

</div>

<?
}
?>

<!-- Deze gegevens zijn meestal verouderd. -->

</div>