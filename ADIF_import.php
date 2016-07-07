<?php
include("classe/import_adif.class.php");

$test = new ImportAdif();

$test->setFile("import.adi");

$test->convert('QSO_DATE');
$test->getResult();


//	$fichier_a_ouvrir = fopen ("import.adi", "r");
//	$ligne = fgets($fichier_a_ouvrir);
//	echo $ligne;


/*
function nb($champ,$ligne){
	preg_match('~<'.$champ.':(\d)~', $ligne, $nb);
	preg_match('~<'.$champ.':'.$nb[1].'>(.{'.$nb[1].'})~', $ligne, $result);
	return $result;
}

	$fichier_a_ouvrir = fopen ("import.adi", "r");
	$ligne = fgets($fichier_a_ouvrir);

	$date = nb('QSO_DATE',$ligne);
	$y = substr($date[1], 0,4);
	$m = substr($date[1], 4,2);
	$j = substr($date[1], 6,2);
	$importDate = $y."-".$m."-".$j;
	
	$call = nb('CALL',$ligne);

	$timeOn = nb('TIME_ON',$ligne);

	$timeOff = nb('TIME_OFF',$ligne);

	$bande = nb('BAND',$ligne);

// Faire point obligatoire
	$freq = nb('FREQ',$ligne);

	$rste = nb('RST_SENT',$ligne);

	$rstr = nb('RST_RCVD',$ligne);

// Faire ajout du mode-ext :
	$mode = nb('MODE',$ligne);

	$locator = nb('GRIDSQUARE',$ligne);

	$waz = nb('CQZ',$ligne);

	$itu = nb('ITUZ',$ligne);

	$dxcc = nb('DXCC',$ligne);

	$entite = nb('COUNTRY',$ligne);

	$state = nb('STATE',$ligne);

	$continent = nb('CONT',$ligne);

	$qsle = nb('QSL_SENT',$ligne);

	$qslr = nb('QSL_RCVD',$ligne);

fclose ($fichier_a_ouvrir);
*/
?>