<?php
include("classe/import_adif.class.php");

$test = new ImportAdif();
// Fichier ADIF à lire :
$test->setFile("import.adi");

// Paramètres :
$test->settingDate('-');
$test->settingBand('lower');
$test->settingTime('');
$test->settingFreq('.');
$test->settingMode('upper');





$qsodate = $test->convert('QSO_DATE');
$indicatif = $test->convert('CALL');
$timeOn = $test->convert('TIME_ON');
$timeOff = $test->convert('TIME_OFF');
$bande = $test->convert('BAND');
$freq = $test->convert('FREQ');
$rste = $test->convert('RST_SENT');
$rstr = $test->convert('RST_RCVD');
$mode = $test->convert('MODE');



echo $qsodate."<br>";
echo $indicatif."<br>";
echo $timeOn."<br>";
echo $timeOff."<br>";
echo $bande."<br>";
echo $freq."<br>";
echo $rste."<br>";
echo $rstr."<br>";
echo $mode."<br>";




/*
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