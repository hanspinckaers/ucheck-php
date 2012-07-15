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

ini_set('display_errors', 0);

include "../raw/setup.php";

function base64url_encode($data) { 
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
} 

function base64url_decode($data) { 
  return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
} 

$dangerous_characters = array(" ", '"', "'", "&", "/", "\\", "?", "#", ".");
$user = str_replace($dangerous_characters, '_', $_GET['user']);

if(file_exists("../geheim/iphone.php"))
{
    include("../geheim/iphone.php");

    $pwd = $geheim->decrypt($_GET['pass'], $key, true);
} else {
    $pwd =  base64url_decode($_GET['pass']);
}

$output = array();
exec(escapeshellcmd("$NODEJS_DIR $NODEJS_SERVERJS_DIR voortgang $user $pwd"), $output);
$html = implode("", $output);

$studiesraw = explode("<DIV id='win0divDERIVED_SAA_DPR_GROUPBOX1$", $html);

$studies = array();

foreach( $studiesraw as $studieonderdeel )
{	

    $studiedeelarr = explode("<tr><td class='PAGROUPDIVIDER'  align='left'>", $studieonderdeel);

//	print_r($studiedeelarr);

    preg_match("/border='0' \/><\/a>([^<]*)</", $studiedeelarr[0], $title);	
    preg_match("/([0-9\.]*) vereist, ([0-9\.]*) behaald, ([0-9\.]*) nodig/", $studiedeelarr[0], $punten);
    preg_match("/([0-9\.]*) vereist, ([0-9\.]*) werkelijk/", $studiedeelarr[0], $gem);		

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
//		echo $studiedeel;

        $counter++;
        if($counter == 0) continue;

        $studiesubdelen = explode("<table cellpadding='2' cellspacing='0' cols='1'  class='PSLEVEL1SCROLLAREABODYNBOWBO'", $studiedeel);		

//		print_r($studiesubdelen);

        preg_match("/([^<]*)</", $studiesubdelen[0], $title);
        preg_match("/([0-9\.]*) vereist, ([0-9\.]*) behaald, ([0-9\.]*) nodig/", $studiesubdelen[0], $punten);
        preg_match("/([0-9\.]*) vereist, ([0-9\.]*) werkelijk/", $studiesubdelen[0], $gem);		


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

            preg_match("/border='0' \/><\/a>([^<]*)</", $studiesubdeel, $title);
            preg_match("/([0-9\.]*) vereist, ([0-9\.]*) behaald, ([0-9\.]*) nodig/", $studiesubdeel, $punten);
            preg_match("/([0-9\.]*) vereist, ([0-9\.]*) werkelijk/", $studiesubdeel, $gem);		

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

//print_r($studies);
?>

<html>

<header>
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0"/>

<style type="text/css"> 
*
{
    margin: 0;
    padding: 0;

    font-size: 12px;
}

html, body, div, span, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, code,
del, dfn, em, img, q, dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td {
  margin: 0px;
  padding: 0;
  border: 0;
  font-weight: inherit;
  font-style: inherit;
  font-size: 12px;
  font-family: inherit;
  vertical-align: baseline;
}

/* --- Typography --- */

.grid p {
  line-height: 18px;
  font-size: 12px;
  font-family: Helvetica, sans-serif;
}

h1 { font-size: 2em; margin-bottom: 0.75em; line-height: 1.25em;   font-family: Georgia, serif; color:#000;}
h2 { font-size: 2em; margin-bottom: 0.75em;   line-height: 1.25em;   font-family: Georgia, serif; color:#8f8f8f;}
h3 { font-size: 1.5em; line-height: 1; line-height: 1.25em; margin-bottom: 0.5em; font-family: Georgia, serif; color:#8f8f8f;}
h4 { font-size: 1.2em; line-height: 1.25; margin-bottom: 1.25em; }
h5 { font-size: 1em; font-weight: bold; margin-bottom: 1.5em; }
h6 { font-size: 1em; font-weight: bold; }

p  { margin: 0 0 2em; min-height: 0.15em;}

em
{
    font-style: normal;
    font-weight: normal;
}

 body
 {	
     font-family: Helvetica;
     font-size: 12px;
     line-height: 18px;

     background-color: #f4f4f4;	
     width:100%;
 }

 small
 {
     padding-left: 7px;
     padding-bottom: 5px;
 }

 /* Voortgangs */

 div#voortgang
 {	
     color: #5a5a5a;
     padding: 10px 8px 0px 7px;
 }

div.hoofdbalk
{
    border-radius: 3px;

    width:100%; 

    line-height:24px;
    height: 34px;

    border: 1px #cecece solid;

    background-color: #abd3e9;
    text-align: right;

    font-size: 13px;

    background-image: -webkit-gradient(
        linear,
        left bottom,
        left top,
        color-stop(1, #fff),
          color-stop(0.98, #e9e9e9),
        color-stop(0.04, #eeeeee),
        color-stop(0.03, #f4f4f4)
    );
    background-image: -moz-linear-gradient(
        center bottom,
        #f4f4f4 3%,
        #eeeeee 4%,
        #e9e9e9 98%,
        #ffffff 100%
    );

    text-shadow: 0px 1px rgba(255,255,255,0.5);
}

div.filled_balk
{
    text-align:left; 
    float:left; 
    padding-top:5px; 
    color:#000; 
    background-color:#e5ecf9; 
    height:29px;

    position: relative;
    top: -1px;
    left: -1px;

    border-radius: 3px;
    border: 1px #97cead solid;

    background-image: -webkit-gradient(
        linear,
        left bottom,
        left top,
        color-stop(1, #fff),
          color-stop(0.98, #bfeece),
        color-stop(0.03, #abe9c2),
        color-stop(0.02, #d3f4e0)
    );

    min-width: 6px;

}

div.filled_balk_blauw
{
    text-align:left; 
    float:left; 
    padding-top:5px; 
    color:#000; 
    background-color:#e5ecf9; 
    height:29px;

    position: relative;
    top: -1px;
    left: -1px;

    border-radius: 3px;
    border: 1px #97bace solid;


    background-image: -webkit-gradient(
        linear,
        left bottom,
        left top,
        color-stop(1, #fff),
          color-stop(0.98, #bfdeee),
        color-stop(0.03, #abd3e9),
        color-stop(0.02, #d3e8f4)
    );

        min-width: 5px;
}

div.nog_balk
{
    padding-top: 5px;
    padding-right: 10px;
    overflow: hidden;
    height:29px;

}
</style> 
</header>
<body>

<div id="voortgang">

<? 
foreach($studies as $studie)
{
?>

<h1><? echo $studie['title']?></h1>
<!-- te lui voor in main css -->
<div class="hoofdbalk">
    <div  class="<? if($onderdeel['eenh_nodig'] == "0.000"){ echo "filled_balk"; } else { echo "filled_balk_blauw"; } ?>" style="width:<? echo round(($studie['eenh_gevolgd'] / $studie['eenh_vereist'])*100) ?>%;">
        <span style="display:block; padding-left:10px;  width:200px"><strong><? echo (int)$studie['eenh_gevolgd']; ?></strong> ECTS <em>(<? echo round(($studie['eenh_gevolgd'] / $studie['eenh_vereist'])*100) ?>%)</em></span>
    </div>

    <? if($studie['eenh_vereist'] - $studie['eenh_gevolgd'] != 0){ ?>
    <div class="nog_balk">
    <strong><? echo $studie['eenh_vereist'] - $studie['eenh_gevolgd']; ?></strong> ECTS <em>(<? echo 100-round(($studie['eenh_gevolgd'] / $studie['eenh_vereist'])*100) ?>%)</em>
    <? } ?>
    </div>

</div>
<p style="clear:both; position:relative; top:5px;"> 
<? 
if (isset($studie['gem_werkelijk']) && $studie['gem_werkelijk'] != "" && $studie['gem_werkelijk'] != "0.000")
{
?>
Gemiddelde: <strong><? echo $studie['gem_werkelijk']?></strong>
<?
} else {
echo "";
}
?>
</p>
<div style="position:relative; left:5%; width:95%;">
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
}
?>
<p style="clear:both; position:relative; top:5px;"> 
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
</p>

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
    <strong><? echo $sub['eenh_vereist'] - $sub['eenh_gevolgd']; ?></strong> ECTS<em> (<? echo 100-round(($sub['eenh_gevolgd'] / $sub['eenh_vereist'])*100) ?>%)</em>
    </div>
    <? } ?>

</div>
<p style="clear:both; position:relative; top:5px;"> 
<? 
if (isset($sub['gem_werkelijk']) && $sub['gem_werkelijk'] != "" && $sub['gem_werkelijk'] != "0.000"){ ?>Gemiddelde: <strong><? echo $sub['gem_werkelijk']?></strong> <? } else { echo ""; }
?>
</p>

<? } } ?>

</div>

<? } ?>

</div>

<!--</div>-->

<?
}
?>

<small style="color:grey;">Deze gegevens zijn meestal verouderd.</small>

</div>
</body>
</html>

<?
// Turn off all error reporting
try {
include('Galvanize.php');
$GA = new Galvanize('UA-4063156-9');
$GA->trackPageView();
} catch (Exception $e) {}
?>
