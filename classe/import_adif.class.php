<?php

/**
* logjmh 
* Classe d'importation au Format ADIF
*/

class ImportAdif
{
	//private $contenu;
	private $ligne;
	private $file;
	private $result;
	//private $champ;


	function __construct(){
		$this->file = '';
	//	$this->contenu = '';
		$this->ligne ='';
		//$this->champ = $champ;
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
		return $this->result = $y."-".$m."-".$j;
	}

	private function convertBande($bande){
		// A AJOUTER TRAITEMENT.......................
		return $this->result = $bande;
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