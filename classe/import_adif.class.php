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


	function __construct(){
		$this->file = '';
		$this->contenu = '';
		$this->ligne ='';
	}

	public function setFile($file){
		$this->file = fopen($file, 'r');
	}

	private function readFile(){

		$this->ligne = fgets($this->file);
	}

//	public function getFile(){
//		echo $this->contenu;
//	}








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