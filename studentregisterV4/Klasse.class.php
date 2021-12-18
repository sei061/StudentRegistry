<?php
class Klasse {
        private $id;
        private $klassenavn;
        private $beskrivelse;
        private $aar;
       
        function __construct() { }
           
        function hentId() {
            return $this->id;   
        }   
        function hentNavn() {
            return $this->klassenavn;   
        }   
        function hentBeskrivelse() {
        	return $this->beskrivelse;
        }
        function hentAar() {
        	return $this->aar;
        }

}
?>

