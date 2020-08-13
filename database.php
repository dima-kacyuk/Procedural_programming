<?php

	$link = mysqli_connect("localhost", "root", "", "ics");

	if(mysqli_connect_errno()) {

		echo "Ошибка в подключении к базе данных (".mysqli_connect_errno()."): ". mysqli_connect_error();

		exit();

	}

	else {

		// echo "БД успешно подключена";

	}

	// изменение набора символов на utf8
  mysqli_set_charset($link, "utf8");

?>
