<?php
include("classe/import_adif.class.php");

$test = new ImportAdif();

// Paramètres :
$test->settingDate('-');			// '-' or '/' or other
$test->settingBand('lower');		//upper or lower
$test->settingTime('');				// nothing or ':'
$test->settingFreq('.');			// nothing or '.'
$test->settingMode('upper');		//upper or lower
$test->settingGrid('upper');		//upper or lower
$test->settingCountry('upper');		//upper or lower
$test->settingState('upper');		//upper or lower
$test->settingContinent('upper');	//upper or lower

// Faire une boucle sur le fichier ADIF
// Fichier ADIF à lire :
//$test->setFile("import.adi");
$test->setData('<QSO_DATE:8>20150427<CALL:5>UW5KW<TIME_ON:4>2038<TIME_OFF:4>2042<BAND:3>20m<FREQ:6>14.078<RST_SENT:3>-03<RST_RCVD:3>-01<MODE:3>JT9<GRIDSQUARE:4>KO30<CQZ:2>16<ITUZ:2>29<DXCC:3>288<COUNTRY:7>UKRAINE<STATE:2>RI<CONT:2>EU<QSL_SENT:1>Y<QSL_RCVD:1>Y<EOR>');



		// Récupération :
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
		$qsle = $test->convert('QSL_SENT');
		$qslr = $test->convert('QSL_RCVD');


		// Ecriture dans la base :
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
		echo $qsle."<br>";
		echo $qslr."<br>";

/*
// Faire ajout du mode-ext :
	$mode = nb('MODE',$ligne);
fclose ($fichier_a_ouvrir);
*/
?>