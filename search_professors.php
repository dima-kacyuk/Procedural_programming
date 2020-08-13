<?php 

	include_once 'database.php';
	include_once 'functions.php';

	global $link;

  if (isset($_POST)) {

  	$fioFrag = $_POST['searchParameter'];

  	$resultInfo = array('check' => 0, 'message' => '', 'html' => '');
		$successCheck = 1;
		$finalHTML = '';

		$getProfessorsByFioFragSQL = "SELECT * FROM professors WHERE CONCAT(LOWER(last_name), ' ', LOWER(first_name), ' ', LOWER(patronymic)) LIKE '%$fioFrag%';";

		$getAllProfessorsSQL = "SELECT * FROM professors;";

		$getProfessorsSQL = '';

		if ($fioFrag == '') {

  		$getProfessorsSQL = $getAllProfessorsSQL;

  	}

  	else {

  		$fioFrag = mb_strtolower($fioFrag);

			$getProfessorsSQL = $getProfessorsByFioFragSQL;

		}

		$getProfessorsSQLResult = mysqli_query($link, $getProfessorsSQL);

		$getProfessorsSQLResultCheck = mysqli_num_rows($getProfessorsSQLResult);

		if ($getProfessorsSQLResultCheck > 0) {

    	$finalHTML = viewProfessorsInProperSection($getProfessorsSQL);

			$resultInfo['check'] = $successCheck;
			$resultInfo['html'] = $finalHTML;

		}

		else {

			$resultInfo['message'] = '*Преподаватели не найдены';

		}
		
		$resultInfo = json_encode($resultInfo);

		die($resultInfo);

	}

 ?>