<?php

include_once 'database.php';
include_once 'functions.php';  

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>
<body>
	<header>
  <?php
      session_start();
 
      if(!$_SESSION['userid']){
        header("Location: http://ics.odessa.ua/page-login.php");
        exit;
      }
  ?>

	<?php

    $temp = $_SESSION['access_user_id'];

    $add_new_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 1 ");
	$result_add_new = mysqli_fetch_array($add_new_sql, MYSQLI_ASSOC); 

	$edit_new_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 2 ");
	$result_edit_new = mysqli_fetch_array($edit_new_sql, MYSQLI_ASSOC); 
		
	$delete_new_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 3 ");
    $result_delete_new = mysqli_fetch_array($delete_new_sql, MYSQLI_ASSOC);

    $add_professors_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 4 ");
	$result_add_professors = mysqli_fetch_array($add_professors_sql, MYSQLI_ASSOC); 

	$edit_professors_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 5 ");
	$result_edit_professors = mysqli_fetch_array($edit_professors_sql, MYSQLI_ASSOC); 
		
	$delete_professors_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 6 ");
    $result_delete_professors = mysqli_fetch_array($delete_professors_sql, MYSQLI_ASSOC);

    $add_stream_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 7 ");
	$result_add_stream = mysqli_fetch_array($add_stream_sql, MYSQLI_ASSOC); 

	$edit_stream_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 8 ");
	$result_edit_stream = mysqli_fetch_array($edit_stream_sql, MYSQLI_ASSOC); 
		
	$delete_stream_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 9 ");
    $result_delete_stream = mysqli_fetch_array($delete_stream_sql, MYSQLI_ASSOC); 	

    $add_department_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 10 ");
	$result_add_department = mysqli_fetch_array($add_department_sql, MYSQLI_ASSOC); 

	$edit_department_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 11 ");
	$result_edit_department = mysqli_fetch_array($edit_department_sql, MYSQLI_ASSOC); 
		
	$delete_department_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 12 ");
    $result_delete_department = mysqli_fetch_array($delete_department_sql, MYSQLI_ASSOC); 

	$add_user_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 13 ");
	$result_add_user = mysqli_fetch_array($add_user_sql, MYSQLI_ASSOC); 

	$edit_user_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 14 ");
	$result_edit_user = mysqli_fetch_array($edit_user_sql, MYSQLI_ASSOC); 
		
	$delete_user_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 15 ");
    $result_delete_user = mysqli_fetch_array($delete_user_sql, MYSQLI_ASSOC); 
	
	
	?>


    <div class="menu_container">
    <div class="menu">
    <div>
      <a href="http://ics.odessa.ua/" target="_blank"><img src="/img/logo-ics.png" alt="Логотип" class="logo"></a>
    </div>
    <div>


	<?php 
	  if ($result_add_new['access'] == 1 || $result_edit_new['access'] == 1 || $result_delete_new['access'] == 1 ) {
		?> <a class="link" href="http://ics.odessa.ua/page-all-news.php">Новости</a><?php
	  }
	  ?>

      

	  <?php 
	  if ($result_add_professors['access'] == 1 || $result_edit_professors['access'] == 1 || $result_delete_professors['access'] == 1 ) {
		?> <a class="link" href="http://ics.odessa.ua/page-all-professor.php">Преподаватели</a><?php
	  }
	  ?>

     

	  <?php 
	  if ($result_add_stream['access'] == 1 || $result_edit_stream['access'] == 1 || $result_delete_stream['access'] == 1 ) {
		?><a class="link" href="http://ics.odessa.ua/page-single-streams-admin.php">Управление потоками</a><?php
	  }
	  ?>

      

	  <?php 
	  if ($result_add_department['access'] == 1 || $result_edit_department['access'] == 1 || $result_delete_department['access'] == 1 ) {
		?><a class="link" href="http://ics.odessa.ua/page-show-all-departments.php">Кафедры</a><?php
	  }
	  ?>
      

	  <?php 
	  if ($result_add_user['access'] == 1 || $result_edit_user['access'] == 1 || $result_delete_user['access'] == 1 ) {
		?><a class="link" href="http://ics.odessa.ua/page-show-all-users.php" style="margin-right: 30px;">Пользователи</a><?php
	  }
	 
	 ?>


      
      <?php
					if(isset($_SESSION['userid'])){
    					echo " Вы вошли, как "; 
   						echo $_SESSION['userid'];
    				}
				?>
			<a href="http://ics.odessa.ua/page-logout.php" > <input type="button" class='btn btn-outline-primary btn-sm' value="Выйти"></a>
    </div>
    </div>
    </div>
</header>