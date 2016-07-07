<?php

/**
* logjmh 
* Classe d'importation au Format ADIF
*/

class ImportAdif
{
	private $contenu;
	private $ligne;
	private $file;
	private $result;
	//private $champ;


	function __construct(){
		$this->file = '';
		$this->contenu = '';
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

	

	public function getResult(){
		echo $this->result;
	}

	public function convert($champ){
		preg_match('~<'.$champ.':(\d)~', $this->ligne, $nb);
		preg_match('~<'.$champ.':'.$nb[1].'>(.{'.$nb[1].'})~', $this->ligne, $result);
		if($champ == 'QSO_DATE'){
			$y = substr($result[1], 0,4);
			$m = substr($result[1], 4,2);
			$j = substr($result[1], 6,2);
			$this->result = $y."-".$m."-".$j;
		}else{
			$this->result = $result[1];
		}
		
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