<?php

class StudentRegister implements StudentInterface
{
	private $db;
	
	public function __construct(PDO $db)
	{
		$this->db = $db;
	}
	
	public function visAlle(): array
	{
		$studenter= array();

        try
        {
            $resultat = $this->db->prepare("SELECT * FROM studenter");
            $resultat->execute();
            $studenter = $resultat->fetchAll(PDO::FETCH_CLASS, 'Student');
        }
        catch (Exception $e) {
            print $e->getMessage() . PHP_EOL;
        }
		
		return $studenter;
    }
    public function visAlleKlasser(): array
    {
        $klasser= array();

        try
        {
            $resultat = $this->db->prepare("SELECT * FROM klasse");
            $resultat->execute();
            $klasser = $resultat->fetchAll(PDO::FETCH_CLASS, 'Klasse');
        }
        catch (Exception $e) {
            print $e->getMessage() . PHP_EOL;
        }

        return $klasser;
    }

    public function visKlasse(int $id) : Klasse
    {
        try
        {
            $resultat = $this->db->prepare("SELECT * FROM klasse WHERE id = :id");
            $resultat->bindParam(':id', $id, PDO::PARAM_INT);
            $resultat->execute();

            return $resultat->fetchObject("Klasse");
        }
        catch (InvalidArgumentException $e) {
            print $e->getMessage() . PHP_EOL;
        }

    }

	public function visStudent(int $id) : ?Student
	{
        try
        {
            $resultat = $this->db->prepare('SELECT id, etternavn, fornavn, klasse, mobil, www, epost FROM studenter where id = :id');
            $resultat->bindParam(':id', $id, PDO::PARAM_INT);
            $resultat->execute();
            if($resultat->rowCount() < 1) {
                return null;
            }
            $student =  $resultat->fetchObject("Student");
            return $student;

        }
        catch (InvalidArgumentException $e) {
            print $e->getMessage() . PHP_EOL;
        }

	}

    public function leggTilStudent(Student $student) : int
    {
        try
        {
            $resultat = $this->db->prepare("INSERT INTO studenter (etternavn, fornavn, klasse, mobil, www, epost, opprettet)".
                " VALUES(?,?,?,?,?,?,now())");
            $etternavn = $student->hentEtterNavn();
            $fornavn = $student->hentForNavn();
            $klasse = $student->hentKlasse();
            $mobil = $student->hentMobil();
            $www = $student->hentURL();
            $epost = $student->hentEpost();
            $resultat->bindParam( 1, $etternavn);
            $resultat->bindParam( 2, $fornavn);
            $resultat->bindParam( 3, $klasse);
            $resultat->bindParam( 4, $mobil);
            $resultat->bindParam( 5, $www);
            $resultat->bindParam( 6, $epost);
            if($resultat->execute()) {
                $_POST['success'] = true;
            }

            return $this->db->lastInsertId();
        }
        catch (InvalidArgumentException $e) {
            print $e->getMessage() . PHP_EOL;
        }

    }

    public function redigerStudent(Student $student, int $id)
    {
        try
        {
            $resultat = $this->db->prepare(
                "UPDATE studenter SET etternavn = :etternavn, fornavn = :fornavn, klasse= :klasse, mobil = :mobil, ".
                "www = :www, epost = :epost WHERE id = :id");
            $etternavn = $student->hentEtterNavn();
            $fornavn = $student->hentForNavn();
            $klasse = $student->hentKlasse();
            $mobil = $student->hentMobil();
            $www = $student->hentURL();
            $epost = $student->hentEpost();
            $resultat->bindParam( ":etternavn", $etternavn, PDO::PARAM_STR);
            $resultat->bindParam( ":fornavn", $fornavn, PDO::PARAM_STR);
            $resultat->bindParam( ":klasse", $klasse, PDO::PARAM_INT);
            $resultat->bindParam( ":mobil", $mobil, PDO::PARAM_STR);
            $resultat->bindParam( ":www", $www, PDO::PARAM_STR);
            $resultat->bindParam( ":epost", $epost, PDO::PARAM_STR);
            $resultat->bindParam( ":id", $id, PDO::PARAM_INT);
            if($resultat->execute()) {
                $_POST['success'] = true;
            }
            
        }
        catch (InvalidArgumentException $e) {
            print $e->getMessage() . PHP_EOL;
        }

    }
}