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
$test->settingGrid('upper');
$test->settingCountry('upper');
$test->settingState('upper');
$test->settingContinent('lower');



$qsodate = $test->convert('QSO_DATE');
$indicatif = $test->convert('CALL');
$timeOn = $test->convert('TIME_ON');
$timeOff = $test->convert('TIME_OFF');
$bande = $test->convert('BAND');
$freq = $test->convert('FREQ');
$rste = $test->convert('RST_SENT');
$rstr = $test->convert('RST_RCVD');
$mode = $test->convert('MODE');
$locator = $test->convert('GRIDSQUARE');
$waz = $test->convert('CQZ');
$itu = $test->convert('ITUZ');
$dxcc = $test->convert('DXCC');
$entite = $test->convert('COUNTRY');
$state = $test->convert('STATE');
$continent = $test->convert('CONT'); // -> problème



echo $qsodate."<br>";
echo $indicatif."<br>";
echo $timeOn."<br>";
echo $timeOff."<br>";
echo $bande."<br>";
echo $freq."<br>";
echo $rste."<br>";
echo $rstr."<br>";
echo $mode."<br>";
echo $locator."<br>";
echo $waz."<br>";
echo $itu."<br>";
echo $dxcc."<br>";
echo $entite."<br>";
echo $state."<br>";
echo $continent."<br>";



/*
// Faire ajout du mode-ext :
	$mode = nb('MODE',$ligne);

	$continent = nb('CONT',$ligne);

	$qsle = nb('QSL_SENT',$ligne);

	$qslr = nb('QSL_RCVD',$ligne);

fclose ($fichier_a_ouvrir);
*/
?>