<?php
include("classe/import_adif.class.php");

$test = new ImportAdif();
// Fichier ADIF à lire :
$test->setFile("import.adi");

// Paramètres :
$test->settingDate('-');
//$test->settingDate('/');
//$test->settingBand('upper');
$test->settingBand('lower');
$test->settingTime('');
//$test->settingTime(':');
$test->settingFreq('.');


$qsodate = $test->convert('QSO_DATE');
$indicatif = $test->convert('CALL');
$timeOn = $test->convert('TIME_ON');
$timeOff = $test->convert('TIME_OFF');
$bande = $test->convert('BAND');
$freq = $test->convert('FREQ');


echo $qsodate."<br>";
echo $indicatif."<br>";
echo $timeOn."<br>";
echo $timeOff."<br>";
echo $bande."<br>";
echo $freq."<br>";


/*
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