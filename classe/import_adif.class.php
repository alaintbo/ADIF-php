<?php

/**
* logjmh 
* Classe d'importation au Format ADIF
*/

class ImportAdif
{
	private $ligne;
	private $file;
	private $result;

	// Attribut de paramétrage - Setting attribut
	private $paramBande = 'upper';
	private $paramDate = '/';
	private $paramTime = ':';
	private $paramFreq = '.';

	function __construct(){
		$this->file = '';
		$this->ligne ='';
	}

	private function lireFichier(){
		$this->ligne = fgets($this->file);
	}

	public function setFile($file){
		$this->file = fopen($file, 'r');
		$this->lireFichier();
	}

	

//	public function getResult(){
//		return $this->result;
//	}

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
			default:
				$this->result = $result[1];
				break;
		}
		return $this->result;
	}

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

	public function __destruct(){
		fclose($this->file);
	}

}