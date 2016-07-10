<?php

/**
* logjmh 
* Classe simple d'importation au Format ADIF basée sur les expressions régulières.
* Simple class for ADIF import with regular expressions
* 
* Paramètres :
* Bande en majuscule ou minuscule - Band upper or lower case
* Date avec '-' ou '/' ou autre - Date with '-' or '/' or other
* Heures avec ':' ou rien - Time with ':' or nothing
* Frequence séparateur '.' ou autre - Frequency with a '.' or other
* Mode en majuscule ou minuscule - Mode in upper or lower case
* Locator en majuscule ou minuscule - Gridsquare in upper or lower case
* Entités en majuscule ou minuscule - Country in upper or lower case
* Etat ou région en majuscule ou minuscule - State in upper or lower case
* Continent en majuscule ou minuscule - Continent in upper or lower case
*
* $ligne = ligne du fichier ADIF - One line of ADIF file
* $result = Resultat de la conversion - Result of convert
*
* Les différentes methodes convertXxxx sont là pour développement futur
*/

class ImportAdif
{
	private $ligne;
	private $result;
	private $bande;

	// Attribut de paramétrage - Setting attribut with default value
	private $paramBande = 'upper';
	private $paramDate = '/';
	private $paramTime = ':';
	private $paramFreq = '.';
	private $paramMode = 'upper';
	private $paramGrid = 'upper';
	private $paramCountry = 'upper';
	private $paramState = 'upper';
	private $paramContinent = 'upper';


	function __construct(){
		$this->ligne ='';
	}

	public function setData($ligne){
		$this->ligne = $ligne;	
	}

	public function convert($champ){
		preg_match('~<'.$champ.':(\d)~', $this->ligne, $nb);
		preg_match('~<'.$champ.':'.$nb[1].'>(.{'.$nb[1].'})~', $this->ligne, $result);
		
		switch ($champ) {
			case 'QSO_DATE':
				$this->convertDate($result[1]);
				break;
			case 'BAND':
				$this->convertBande($result[1]);
				break;
			case 'TIME_ON':
			case 'TIME_OFF':
				$this->convertTime($result[1]);
				break;
			case 'FREQ':
				$this->convertFreq($result[1]);
				break;
			case 'MODE':
				$this->convertMode($result[1]);
				break;	
			case 'GRIDSQUARE':
				$this->convertGrid($result[1]);
				break;	
			case 'COUNTRY':
				$this->convertCountry($result[1]);
				break;
			case 'STATE':
				$this->convertState($result[1]);
				break;
			case 'CONT':
				$this->convertContinent($result[1]);
				break;
			default:
				$this->result = $result[1];
				break;
		}
		return $this->result;
	}

/**
* Mise en forme de la date - Format date
*
*/
	private function convertDate($qsodate){
		$y = substr($qsodate, 0,4);
		$m = substr($qsodate, 4,2);
		$j = substr($qsodate, 6,2);
		return $this->result = $y.$this->paramDate.$m.$this->paramDate.$j;
	}

	private function convertBande($bande){
		$this->paramBande == 'lower' ? $bande = strtolower($bande) : $bande = strtoupper($bande);
		$this->bande = $bande;
		return $this->result = $bande;
	}

	private function convertTime($time){
		$h = substr($time, 0,2);
		$m = substr($time, 2,2);
		return $this->result = $h.$this->paramTime.$m;
	}

	private function convertFreq($freq){
		if ($this->verifFreq($this->bande,$freq)){
			$freq = str_replace('.', $this->paramFreq, $freq);
		return $this->result = $freq;
		}
	}

	private function convertMode($mode){
		$this->paramMode == 'lower' ? $mode = strtolower($mode) : $mode = strtoupper($mode);
		return $this->result = $mode;
	}

// Validation de la fréquence - Valid frequency
	private function verifFreq($bande,$freq){
		$low = array('2190m' => 0.136, '630m' => 0.472, '560m' => 0.501, '160m' => 1.8, '80m' => 3.5, '60m' => 5.102, '40m' => 7, '30m' => 10, '20m' => 14.0, '17m' => 18.068, '15m' => 21, '12m' => 24.89, '10m' => 28, '6m' => 50, '4m' => 70, '2m' => 144, '1.25m' => 222, '70cm' => 420, '33cm' => 902, '23cm' => 1240, '13cm' => 2300, '9cm' => 3300, '6cm' => 5650, '3cm' => 10000, '1.25cm' => 24000, '6mm' => 47000, '4mm' => 75500, '2.5mm' => 119980, '2mm' => 142000, '1mm' => 241000);
		$hight = array('2190m' => 0.137, '630m' => 0.479, '560m' => 0.504, '160m' => 2, '80m' => 3.8, '60m' => 5.4065, '40m' => 7.3, '30m' => 10.15, '20m' => 14.35, '17m' => 18.168, '15m' => 21.45, '12m' => 24.99, '10m' => 29.7, '6m' => 54, '4m' => 71, '2m' => 148, '1.25m' => 225, '70cm' => 450, '33cm' => 928, '23cm' => 1300, '13cm' => 2450, '9cm' => 3500, '6cm' => 5925, '3cm' => 10500, '1.25cm' => 24250, '6mm' => 47200, '4mm' => 81000, '2.5mm' => 120020, '2mm' => 149000, '1mm' => 250000);

		if($freq > $low[$bande] AND $freq < $hight[$bande]){
			return True;
		}else{
			return False;
		}
	}
	
	private function convertGrid($grid){
		$this->paramGrid == 'lower' ? $grid = strtolower($grid) : $grid = strtoupper($grid);
		return $this->result = $grid;
	}

	private function convertCountry($country){
		$this->paramCountry == 'lower' ? $country = strtolower($country) : $country = strtoupper($country);
		return $this->result = $country;
	}

	private function convertState($state){
		$this->paramState == 'lower' ? $state = strtolower($state) : $state = strtoupper($state);
		return $this->result = $state;
	}

	public function convertContinent($cont){
		$this->paramContinent == 'lower' ? $cont = strtolower($cont) : $cont = strtoupper($cont);
		return $this->result = $cont;
	}
	
	public function settingBand($set){
		$this->paramBande = $set;
	}

	public function settingDate($set){
		$this->paramDate = $set;
	}

	public function settingTime($set){
		$this->paramTime = $set;
	}

	public function settingFreq($set){
		$this->paramFreq = $set;
	}

	public function settingMode($set){
		$this->paramMode = $set;
	}

	public function settingGrid($set){
		$this->paramGrid = $set;
	}
	
	public function settingCountry($set){
		$this->paramCountry = $set;
	}
	
	public function settingState($set){
		$this->paramState = $set;
	}

	public function settingContinent($set){
		$this->paramContinent = $set;
	}


// DEBUG
	public function __set($attribut, $valeur) {
		echo "Tentative d'attribution à ".$nom." de la valeur ".$valeur;
	}

	public function __get($attribut) {
		echo "Tentative de consultation de l'attribut ".$attribut;
	}

	public function __call($methode, $arguments) {
		echo "Tentative d'appel de la méthode ".$methode." avec en paramètres :<br>";
		print_r($arguments);
	}
}