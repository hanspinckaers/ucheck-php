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

include "user_info.php";

$cookiefile = $_SERVER["DOCUMENT_ROOT"]."raw/cookies/".$user."_vakken.txt";

$fields = array(
            'userid'=>$user,
            'pwd'=>$pwd,
            'timezoneOffset'=>'-60',
        );
        
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
//$fields_string = $fields_string."ICType=Panel&ICElementNum=0&ICAction=DERIVED_SAA_DPR_SSS_EXPAND_ALL&ICXPos=0&ICYPos=0&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=0&ICSID=l2NQFmLyPJGQ&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$22$=9999&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$116$=9999";

############## ############## ############## ############## ############## inschrijven!!!! ############## ############## ############## ############## ############## ############## 

$ch = curl_init();

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES.SAA_SS_DPR_ADB.GBL?PORTALPARAM_PTCNAV=HC_SAA_SS_DPR_ADB_GBL&EOPP.SCNode=HRMS&EOPP.SCPortal=EMPLOYEE&EOPP.SCName=CO_EMPLOYEE_SELF_SERVICE&EOPP.SCLabel=Selfservice&EOPP.SCPTfname=CO_EMPLOYEE_SELF_SERVICE&FolderPath=PORTAL_ROOT_OBJECT.CO_EMPLOYEE_SELF_SERVICE.HCCC_DEGPROG_GRAD.HC_SAA_SS_DPR_ADB_GBL&IsFolder=false&PortalActualURL=https%3a%2f%2fusis.leidenuniv.nl%2fpsc%2fS040PRD%2fEMPLOYEE%2fHRMS%2fc%2fSA_LEARNER_SERVICES.SAA_SS_DPR_ADB.GBL&PortalContentURL=https%3a%2f%2fusis.leidenuniv.nl%2fpsc%2fS040PRD%2fEMPLOYEE%2fHRMS%2fc%2fSA_LEARNER_SERVICES.SAA_SS_DPR_ADB.GBL&PortalContentProvider=HRMS&PortalCRefLabel=Mijn%20studievereisten&PortalRegistryName=EMPLOYEE&PortalServletURI=https%3a%2f%2fusis.leidenuniv.nl%2fpsp%2fS040PRD%2f&PortalURI=https%3a%2f%2fusis.leidenuniv.nl%2fpsc%2fS040PRD%2f&PortalHostNode=HRMS&NoCrumbs=yes';

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; nl-nl) AppleWebKit/533.18.1 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5");
curl_setopt($ch,CURLOPT_URL,$url);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);

curl_setopt($ch,CURLOPT_POST, 17);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

$result = curl_exec($ch);

curl_close($ch);

$ch = curl_init();

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES.SAA_SS_DPR_ADB.GBL';

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; nl-nl) AppleWebKit/533.18.1 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5");
curl_setopt($ch,CURLOPT_URL,$url);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);

curl_setopt($ch,CURLOPT_POST, 14);
curl_setopt($ch,CURLOPT_POSTFIELDS,"ICType=Panel&ICElementNum=0&ICAction=DERIVED_SAA_DPR_SSS_EXPAND_ALL&ICXPos=0&ICYPos=0&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=0&ICSID=l2NQFmLyPJGQ&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$22$=9999&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$116$=9999");

$html = curl_exec($ch);

curl_close($ch);

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
