<?php
class student {
        private $id;
        private $etternavn;
        private $fornavn;
        private $klasse;
        private $mobil;
        private $www;
        private $epost;  
        private $klassenavn;
       
        function __construct() { }
           
        function hentId() {
            return htmlspecialchars($this->id);
        }   
        function hentNavn() {
            return htmlspecialchars($this->fornavn . " " . $this->etternavn);
        }   
        function hentEtterNavn() {
        	return htmlspecialchars($this->etternavn);
        }
        function hentForNavn() {
        	return htmlspecialchars($this->fornavn);
        }
        function hentMobil() {
            return htmlspecialchars($this->mobil);
        }  
        function hentURL() {
        	return htmlspecialchars($this->www);
        } 
        function hentKlasse() {
            return htmlspecialchars($this->klasse);
        }   
          function hentEpost() {
            return htmlspecialchars($this->epost);
        }  
        function hentKlasseNavn() {
        	return htmlspecialchars($this->klassenavn);
        } 
        //Setters
        function settForNavn($fornavn) {
        	$this->fornavn = $fornavn;
        }
        function settEtterNavn($etterNavn) {
        	 $this->etternavn = $etterNavn;
        }
        function settMobil($mobil) {
        	 $this->mobil = $mobil;
        }
        function settURL($www) {
        	 $this->www = $www;
        }
        function settKlasse($klasse) {
        	 $this->klasse = $klasse;
        }
        function settEpost($epost) {
        	 $this->epost = $epost;
        }
        function settKlasseNavn($klassenavn) {
                $this->klassenavn = $klassenavn;
        }
}
?>

