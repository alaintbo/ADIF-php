<?php
include("classe/import_adif.class.php");
include("connect.php");

// Nom du fichier ADIF:
$adif = 'import.adi';

$test = new ImportAdif();

// Paramètres de la classe:
$test->settingDate('-');			// '-' or '/' or other
$test->settingBand('lower');		//upper or lower
$test->settingTime('');				// nothing or ':'
$test->settingFreq('.');			// nothing or '.'
$test->settingMode('upper');		//upper or lower
$test->settingGrid('upper');		//upper or lower
$test->settingCountry('upper');		//upper or lower
$test->settingState('upper');		//upper or lower
$test->settingContinent('upper');	//upper or lower

$fichierADIF = fopen($adif, 'r');
if ($fichierADIF)
{
	while (!feof($fichierADIF))
	{
		$test->setData(fgets($fichierADIF));
		
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
		echo $qsodate." ".$indicatif." ".$timeOn." ".$timeOff." ".$bande." ".$freq." ".$rste." ".$rstr." ".$mode." ".$locator." ".$waz." ".$itu." ".$dxcc." ".$entite." ".$state." ".$continent." ".$qsle." ".$qslr."<br>";
	}
	fclose($fichierADIF);
}

// Faire ajout du mode-ext 

?>