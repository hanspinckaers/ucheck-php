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

include "raw/voortgang.php";
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
	<strong><? echo $studie['eenh_vereist'] - $studie['eenh_gevolgd']; ?></strong> ECTS <em>(<? echo 100-round(($studie['eenh_gevolgd'] / $studie['eenh_vereist'])*100) ?>%)</em>
	</div>
	<? } ?>
	
</div>
<div style="clear:both; position:relative; top:5px;  padding-bottom:1.5em;"> 
<? 
if (isset($studie['gem_werkelijk']) && $studie['gem_werkelijk'] != "" && $studie['gem_werkelijk'] != "0.000")
{
?>
Gemiddelde: <strong><? echo $studie['gem_werkelijk']?></strong>
<?
} else {
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
				<strong><? echo $onderdeel['eenh_vereist'] - $onderdeel['eenh_gevolgd']; ?></strong> ECTS<em> (<? echo 100-round(($onderdeel['eenh_gevolgd'] / $onderdeel['eenh_vereist'])*100) ?>%)</em>
				</div>
				<? } ?>
			</div>
		<?
		} // onderdeel['eenh_gevolgd']
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

				} else {
					echo "";
				} // end if onderdeel sub

			} else {
				echo "";
			} // end if onderdeel sub 

		} // isset($onderdeel['gem_werkelijk'])
		?>
		</div>

		<div style="position:relative; left:5%; width:95%;">
		<?
		####### SUBS
		if(!(count($onderdeel['sub']) == 1 && $onderdeel['sub'][0]['eenh_gevolgd'] == $onderdeel['eenh_gevolgd'] && $onderdeel['sub'][0]['eenh_vereist'] == $onderdeel['eenh_vereist']))
		{

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
				<strong><? echo $sub['eenh_vereist'] - $sub['eenh_gevolgd']; ?></strong> ECTS<em> (<? echo 100-round(($sub['eenh_gevolgd'] / $sub['eenh_vereist'])*100) ?>%)</em>
				</div>
				<? } ?>
			</div>

			<div style="clear:both; position:relative; top:5px; padding-bottom:1.5em;"> 
			<? 
			if (isset($sub['gem_werkelijk']) && $sub['gem_werkelijk'] != "" && $sub['gem_werkelijk'] != "0.000"){ 
			?>Gemiddelde: <strong>
			<? echo $sub['gem_werkelijk']?></strong> 
			<? } else { echo ""; } ?>
			</div>

			<? 
			} // end for-each 

		} // end if onderdeel['sub']
		?>
		</div>

	<? 
	} // end for each
	?>

	</div>

<?
} // end for-each
?>
</div>


<div id="refresh" style="position: relative; width: 1024px; top: -5px; height: 20px; margin-bottom: -20px; text-align: right;">
<a href="#!" style="color:#A1A1A1; font-size: 11px;" onclick="force_refresh_voortgang();">vernieuw voortgang</a>
</div>

<!-- Deze gegevens zijn meestal verouderd. -->
