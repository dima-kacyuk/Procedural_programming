<?php 

	include_once 'database.php';
	include_once 'functions.php';

	global $link;

    if (isset($_POST)) {

  	    $news_id = $_POST['readNewsId'];

        $resultInfo = array('check' => 0, 'message' => '', 'html' => '');
      
		$successCheck = 1;
		$finalHTML = '';

		$getNewsById = "SELECT * FROM newstable WHERE id = '$news_id';";

		$getNewsSqlResult = mysqli_query($link, $getNewsById);

		$getNewsSqlResultCheck = mysqli_num_rows($getNewsSqlResult);

		if ($getNewsSqlResultCheck > 0) {

    	    $finalHTML = readNewsById($news_id);

			$resultInfo['check'] = $successCheck;
			$resultInfo['html'] = $finalHTML;

		}

		else {

			$resultInfo['message'] = '*Ошибка чтения новости.';

		}
		
		$resultInfo = json_encode($resultInfo);

		die($resultInfo);

	}

 ?>