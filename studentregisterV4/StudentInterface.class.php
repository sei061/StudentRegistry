<?php

interface StudentInterface {

    public function visAlle() : array;                          // Returnerer arrary med Student referanser
    public function visAlleKlasser() : array;                   // Returnerer arrary med Klasse referanser
    public function visStudent(int $id) : ?Student;              // Returnerer referanse til Student med angitt id
    public function leggTilStudent(Student $student) : int;     // Returnerer id for nyopprettet Student
    public function redigerStudent(Student $student,int $id);
    public function visKlasse(int $id) : Klasse;
}