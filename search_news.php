<?php 

	include_once 'database.php';
	include_once 'functions.php';

	global $link;

  if (isset($_POST)) {

  	$newsTitleFragment = $_POST['searchParameter'];

  	$resultInfo = array('check' => 0, 'message' => '', 'html' => '');
		$successCheck = 1;
		$finalHTML = '';

		$getNewsByNewsTitleFragmentSQL = "SELECT * FROM newstable WHERE LOWER(title) LIKE '%$newsTitleFragment%';";

		$getAllNewsSQL = "SELECT * FROM newstable ORDER BY date DESC;";

		$getNewsSQL = '';

		if ($newsTitleFragment == '') {

  		$getNewsSQL = $getAllNewsSQL;

  	}

  	else {

  		$newsTitleFragment = mb_strtolower($newsTitleFragment);

			$getNewsSQL = $getNewsByNewsTitleFragmentSQL;

		}

		$getNewsSqlResult = mysqli_query($link, $getNewsSQL);

		$getNewsSqlResultCheck = mysqli_num_rows($getNewsSqlResult);

		if ($getNewsSqlResultCheck > 0) {

    	$finalHTML = viewNews($getNewsSQL);

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