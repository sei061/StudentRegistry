<?php

    $host = "kark.uit.no";
    $dbname = "stud_v20_eiklands";
    $username = "stud_v20_eiklands";
    $password = "Ragnhild2019";

	try
	{
		$db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	}
	catch(PDOException $e)
	{
		//throw new Exception($e->getMessage(), $e->getCode);
		print($e->getMessage());
	}

?>