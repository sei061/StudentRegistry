<?php
	spl_autoload_register(function ($class_name) {
		require_once $class_name . '.class.php';
	});
    require_once 'auth_pdo.php'; 
    require_once 'vendor/autoload.php';

    $studReg = new StudentRegister($db);
    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader);

    if(isset($_POST['alter']) || isset($_POST['add'])) {
        $student = new Student();
        $klasseid = filter_input(INPUT_POST, 'klasse', FILTER_SANITIZE_NUMBER_INT);
        $student->settEtterNavn(filter_input(INPUT_POST, 'etternavn', FILTER_SANITIZE_STRING));
        $student->settForNavn(filter_input(INPUT_POST, 'fornavn', FILTER_SANITIZE_STRING));
        $student->settKlasse($klasseid);
        $student->settMobil(filter_input(INPUT_POST, 'mobil', FILTER_SANITIZE_STRING));
        $student->settURL(filter_input(INPUT_POST, 'www', FILTER_SANITIZE_URL));
        $student->settEpost(filter_input(INPUT_POST, 'epost', FILTER_SANITIZE_EMAIL));
        if(isset($_POST['add']))
            $studReg->leggTilStudent($student);
        else if(isset($_POST['alter']))
            $studReg->redigerStudent($student, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));

    }
    if(isset($_GET['id']) && ctype_digit($_GET['id']))
    {
        $id = intval($_GET['id']);
        if(isset($_GET['alter'])) {
            $student = $studReg->visStudent($id);
            if($student == null) {
                echo $twig->render("iderror.twig");
            }
            else {
                $klasser = $studReg->visAlleKlasser();
                echo $twig->render("alter.twig", array('student' => $student, 'klasser' => $klasser, 'success' => (isset($_POST['success'])) ? $_POST['success'] : ""));
            }
        }
        else {
            $student = $studReg->visStudent($id);
            //Has to use php >= 7.1 to be able to return null
            if($student == null) {
                echo $twig->render("iderror.twig");
            }
            else
                echo $twig->render("index.twig", array('student' => $student));
        }
    }
    else if(isset($_GET['add'])) {
        $klasser = $studReg->visAlleKlasser();
        echo $twig->render("add.twig", array('klasser' => $klasser, 'success' => (isset($_POST['success'])) ? $_POST['success'] : ""));
    }
    else {
    	$studenter = $studReg->visAlle();  
    	echo $twig->render("index.twig", array('studenter' => $studenter));
    }
     
?>