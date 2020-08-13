<?php 

	include_once 'database.php';
	include_once 'functions.php';

	global $link;

  if (isset($_POST)) {

  	$titleFrag = $_POST['searchParam'];

  	$resultInfo = array('check' => 0, 'message' => '', 'html' => '');
		$successCheck = 1;
		$finalHTML = '';

		$getNewsByTitleFragSQL = "SELECT * FROM newstable WHERE title LIKE '%$titleFrag%';";

		$getAllNewsSQL = "SELECT * FROM newstable;";

		$getNewsSQL = '';

		if ($titleFrag == '') {

			$resultInfo['message'] = '*Строка для поиска пуста';

  			$getNewsSQL = $getAllNewsSQL;

  	}

  	else {

  		$titleFrag = mb_strtolower($titleFrag);

			$getNewsSQL = $getNewsByTitleFragSQL;

		}

		$getNewsSQLResult = mysqli_query($link, $getNewsSQL);

		$getNewsSQLResult = mysqli_num_rows($getNewsSQLResult);

		if ($getNewsSQLResult > 0) {

    	$finalHTML = viewProfessors($getNewsSQL);

			$resultInfo['check'] = $successCheck;
			$resultInfo['html'] = $finalHTML;

		}

		else {

			$resultInfo['message'] = '*Новости не найдены';

		}
		
		$resultInfo = json_encode($resultInfo);

		die($resultInfo);

	}

 ?>