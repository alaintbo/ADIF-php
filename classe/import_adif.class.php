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
		return $this->result = $bande;
	}

	private function convertTime($time){
		$h = substr($time, 0,2);
		$m = substr($time, 2,2);
		return $this->result = $h.$this->paramTime.$m;
	}

	private function convertFreq($freq){
		$freq = str_replace('.', $this->paramFreq, $freq);
		return $this->result = $freq;
	}

	private function convertMode($mode){
		$this->paramMode == 'lower' ? $mode = strtolower($mode) : $mode = strtoupper($mode);
		return $this->result = $mode;
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