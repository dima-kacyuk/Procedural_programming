<?php

include_once 'database.php';

	function getSpecialityCodes() {

		global $link;

		$sql = "SELECT id, code FROM departments;";

		$result = mysqli_query($link, $sql);

		return $result;		

	}

	function getSpecialityCodeById($specialityID) {

		global $link;

		$getSpecialityCodeByIdSQL = "SELECT code FROM departments WHERE id = '$specialityID';";
		$gotSpecialityCodeByIdResult = mysqli_query($link, $getSpecialityCodeByIdSQL);

		$gotSpecialityCodeByIdRow = mysqli_fetch_array($gotSpecialityCodeByIdResult, MYSQLI_ASSOC);
		$specialityCode = $gotSpecialityCodeByIdRow['code'];

		return $specialityCode;

	}

	function getProfessorInitialsById($professorID) {

		global $link;

		$getProfessorFullNameByIdSQL = "SELECT id, last_name, first_name, patronymic FROM professors WHERE id = '$professorID';";

		$getProfessorFullNameByIdSqlResult = mysqli_query($link, $getProfessorFullNameByIdSQL);
						
		$getProfessorFullNameByIdRow = mysqli_fetch_array($getProfessorFullNameByIdSqlResult, MYSQLI_ASSOC);

		$professorInitials = $getProfessorFullNameByIdRow['last_name'] . ' ' . mb_substr($getProfessorFullNameByIdRow['first_name'], 0, 1) . '.' . mb_substr($getProfessorFullNameByIdRow['patronymic'], 0, 1) . '.';

		return $professorInitials;

	}

	function getYearInGroupFormat($year) {

    $yearInGroupFormat = date("Y") % 2000 - $year;

    if (date("n") >= 9) {

      $yearInGroupFormat = $yearInGroupFormat + 1;

    }

		return $yearInGroupFormat;

	}

	function createStreamAndCorrespondingGroup($year, $specialityID) {

		global $link;

		$link -> query("INSERT INTO groups (year, number, id_subfaculty) VALUES ('$year', 1, '$specialityID')");

		$addedGroupID = $link -> insert_id;

		$link -> query("INSERT INTO streams (seq_groups) VALUES ('$addedGroupID')");

		return 1;

	}

	function convertFirstLetterToUpperCaseUTF8($str) {

		$char = mb_strtoupper(substr($str, 0, 2), "utf-8"); // это первый символ
 		$str[0] = $char[0];
  	$str[1] = $char[1];

  	return $str;

	}

  function findConditionalSubstringPosition($str, $substr) {

    $position = strripos($str, $substr);

    return (($position === false) ? false : $position);

  }

	function viewProfessors ($sqlRequest) {

		global $link;

		$finalHTML = '';

  	$getProfessorsSQL = $sqlRequest;
    $getAllProfessorsSQLResult = mysqli_query($link, $getProfessorsSQL);
    $getAllProfessorsSQLResultCheck = mysqli_num_rows($getAllProfessorsSQLResult);
            
    while ($row = mysqli_fetch_assoc($getAllProfessorsSQLResult)) {
            
      $professorID = $row['id'];
            
      $professorInitials = getProfessorInitialsById($professorID);

      $professorDescription = $row['description'];
      $professorPhoto = $row['photo_name'];

      $consultationsAndDegreesIndicator = 0;

      if ($row['degree'] != '0') {

        $consultationsAndDegreesIndicator++;
            
        $professorDegreesSequence = $row['degree'];

        $comma = ',';

        if (findConditionalSubstringPosition($professorDegreesSequence, $comma) != false) {

          $delimetrPosition = findConditionalSubstringPosition($professorDegreesSequence, $comma);

          $professorDegreesSequence = substr($professorDegreesSequence, 0, $delimetrPosition + 1) . ' ' . substr($professorDegreesSequence, $delimetrPosition + 1);

          $professorDegreesSequence = mb_strtolower($professorDegreesSequence);
          $professorDegreesSequence = convertFirstLetterToUpperCaseUTF8($professorDegreesSequence);

        }

        if ($row['seq_consultations'] != '0') {

          $consultationsAndDegreesIndicator++;
            
          $professorConsultationsIdSequence = $row['seq_consultations'];

          $professorConsultationsIdArray = explode(' ', $professorConsultationsIdSequence);
          $professorConsultationsArray = array();

          for ($i = 0; $i < count($professorConsultationsIdArray); $i++) {
            
            $getConsultationByIdSQL = "SELECT * FROM consultations WHERE id = '$professorConsultationsIdArray[$i]';";
            
            $getConsultationByIdSQLResult = mysqli_query($link, $getConsultationByIdSQL);
            $getConsultationByIdRow = mysqli_fetch_array($getConsultationByIdSQLResult, MYSQLI_ASSOC);
            
            $consultationObject = [
            
              "day" => $getConsultationByIdRow['day'],
              "room" => $getConsultationByIdRow['room'],
              "start_time" => substr($getConsultationByIdRow['start_time'], 0, -3),
              "finish_time" => substr($getConsultationByIdRow['finish_time'], 0, -3),
            
            ];
            
            $professorConsultationsArray[$i] = $consultationObject;
            
          }

        }

      }
            
      $finalHTML .= "<div class='professor_block' id='$professorID'>";

      $finalHTML .= "<div class='professor-photo-block'>";
            
        $finalHTML .= "<img src='upload-images\\professor photos\\" . $professorPhoto . "' width='75' alt='professor.jpeg'>";

        $finalHTML .= "</div>";

        $finalHTML .= "<div class='professor-left-info-block'>";
            
        $finalHTML .= "<h5>" . $professorInitials . "</h5>";

        if ($consultationsAndDegreesIndicator > 0) {

          $finalHTML .= "<p>" . $professorDegreesSequence . "</p>";

        }

        $finalHTML .= "<p>" . $professorDescription . "</p>";

        $finalHTML .= "</div>";

        if ($consultationsAndDegreesIndicator == 2) {

          $finalHTML .= "<div class='consultations_block'>";

          $finalHTML .=  "<b>Консультации:</b>";
            
          for ($i = 0; $i < count($professorConsultationsArray); $i++) {
            
            $finalHTML .= "<p>" . $professorConsultationsArray[$i]["day"] . ": ауд. " . $professorConsultationsArray[$i]["room"] . " (" . $professorConsultationsArray[$i]["start_time"] . "-" . $professorConsultationsArray[$i]["finish_time"] . ")" . "</p>";
            
          }

          $finalHTML .= "</div>";

        }
                     
      $finalHTML .= "</div>";

    }
            
		return $finalHTML;

	}

function viewNews($sqlRequest, $temp)
{

  global $link;

  $finalHTML = '';

  $getNewsSQL = $sqlRequest;
  $getAllNewsSqlResult = mysqli_query($link, $getNewsSQL);

  while ($row = mysqli_fetch_assoc($getAllNewsSqlResult)) {

    $newsID = $row['id'];
    $newsTitle = $row['title'];
    $newsDescription = $row['description'];
    $newsAuthor = $row['author'];
    $newsDate = $row['date'];
    $newsLink = $row['link'];

    $newsImageName = $row['image'];
    $newsFileName = $row['file'];

    $newsTag = explode(" ", $row['tag']);
    $newsCat = explode(" ", $row['cat']);

    $finalHTML .= "<div class='news_block' id='$newsID'>";

    $finalHTML .= "<div class='news_top'>";

    $finalHTML .= "<div class='news_image'>";

    if(!empty($newsImageName)){

      $finalHTML .= "<img src='http://ics.odessa.ua/upload-images/$newsImageName' alt='$newsImageName' width='120' height='auto'>";

    }

    else {

      $finalHTML .= "<p>Картинка <br>отсутствует</p>";

    }

    $finalHTML .= "</div>";

    $finalHTML .= "<div class='news_title_and_desc'>";

    $finalHTML .= "<p class='p_news'>Заголовок: $newsTitle</p>";

    $finalHTML .= "<p class='p_news'>Описание: $newsDescription</p>";

    $finalHTML .= "<p class='p_news'>Аудитории:";

    if (in_array(1, $newsTag)) {

      $finalHTML .= "<span> Абитуриентам</span>" . "  ";

    }
    if (in_array(2, $newsTag)) {

      $finalHTML .= "<span> Студентам</span>" . "  ";

    }
    if (in_array(3, $newsTag)) {

      $finalHTML .= "<span> Выпускникам</span>" . "  ";

    }

    $finalHTML .= "</p>";

    $finalHTML .= "<p class='p_news'>Теги:";

    if (in_array(1, $newsCat)) {

      $finalHTML .= "<span> Тег1</span>" . "  ";

    }
    if (in_array(2, $newsCat)) {

      $finalHTML .= "<span> Тег2</span>" . "  ";

    }
    if (in_array(3, $newsCat)) {

      $finalHTML .= "<span> Тег3</span>" . "  ";

    }
    if (in_array(4, $newsCat)) {

      $finalHTML .= "<span> Тег4</span>" . "  ";

    }
    if (in_array(5, $newsCat)) {

      $finalHTML .= "<span> Тег5</span>" . "  ";

    }

    $finalHTML .= "</p>";

    $finalHTML .= "</div>";

    $finalHTML .= "<div class='news_link_and_file'>";

    if(!empty($newsLink)){

      $finalHTML .= "<p class='p_news'>Ссылка: <a href='$newsLink'>Перейти</a></p>";

    }

    else {

      $finalHTML .= "<p class='p_news'>Ссылка отсутствует</p>";

    }

    if(!empty($newsFileName)){

      $finalHTML .= "<p class='p_news'>Файл: <a href='upload-files/$newsFileName' download>Скачать</a></p>";

    }

    else {

      $finalHTML .= "<p class='p_news'>Файл отсутствует</p>";

    }

    $finalHTML .= "</div>";

    $finalHTML .= "</div>";

    $finalHTML .= "<br>";

    $finalHTML .= "<div class='news_bottom'>";

    $finalHTML .= "<div class='news_date'>";

    $finalHTML .= "<p class='p_news'>Дата: $newsDate</p>";

    $finalHTML .= "</div>";

    $finalHTML .= "<div>";

    if(!empty($newsAuthor)){

      $finalHTML .= "<p class='p_news'>Автор: $newsAuthor</p>";

    }

    else {

      $finalHTML .= "<p class='p_news'>Автор отсутствует</p>";

    }

    $finalHTML .= "</div>";

    $finalHTML .= "</div>";

    $finalHTML .= "<br>";

    $finalHTML .= "<div class='news_buttons'>";

    $edit_new_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 2 ");
    $result_edit_new = mysqli_fetch_array($edit_new_sql, MYSQLI_ASSOC);
    
    $delete_new_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 3 ");
    $result_delete_new = mysqli_fetch_array($delete_new_sql, MYSQLI_ASSOC);

    if ($result_edit_new['access'] == 1) {
        $finalHTML .= "<a href='http://ics.odessa.ua/page-edit-news.php?id_news=" . $row['id'] . "'><input type='button' class='btn btn-outline-primary' value='Редактировать'></a>";
    }

    if ($result_delete_new['access'] == 1) {
        $finalHTML .= "<span class='indent'></span><a href='http://ics.odessa.ua/page-remove-news.php?id_news=" . $row['id'] . "'><input type='button' class='btn btn-outline-primary' value='Удалить'></a>";
    }

   

    $finalHTML .= "</div>";

    $finalHTML .= "</div>";

    $finalHTML .= "<hr>";
  }

  return $finalHTML;
}

function viewUsersss($sqlRequest, $temp){

    global $link;

    $finalHTML = '';

    $getUsersSQL = $sqlRequest;
    $getAllUsersSQLResult = mysqli_query($link, $getUsersSQL);
    $getAllUsersSQLResultCheck = mysqli_num_rows($getAllUsersSQLResult);

    while ($row = mysqli_fetch_assoc($getAllUsersSQLResult)) {

        if ($row['id'] == 241) {
        } else {

            $finalHTML .= "<div class='user_block'>";

            $userLogin = $row['login'];

            $userDescription = $row['description'];

            $finalHTML .=  "<b>Логин: </b>" .  $userLogin ;

            $finalHTML .=  "<br>";

            $finalHTML .=  "<b>Описание: </b>" .  $userDescription ;

            $temp_log = $row['login'];

            $all_sql_logs = mysqli_query($link, "SELECT * FROM `logs` WHERE name = '$temp_log' ORDER BY id DESC ");
            $result_logs = mysqli_fetch_array($all_sql_logs, MYSQLI_ASSOC);

            $all_sql_logs_order = mysqli_query($link, "SELECT * FROM `logs` WHERE name = '$temp_log' ORDER BY id DESC ");
            $count = 0;

            $finalHTML .= "<div class='d-flex justify-content-start'>";

            $finalHTML .=  "<b>Последние действия:</b>";
            $finalHTML .= "<div class='log_block' >";
            //$finalHTML .= "<table>";
            while ($row_log = mysqli_fetch_assoc($all_sql_logs_order)) {
                if ($count < 3) {
                    $count++;

                    $new_date = $row_log['time'];

                    $temp_date = strtotime($new_date);

                    $date_format = date("d.m.y H:i", $temp_date);

          //$finalHTML .= "<tr>";
          //$finalHTML .= " <td style=' padding-right: 15px' > " . $$row_log['action'] . "</td>";
          //$finalHTML .= " <td style=' padding-right: 15px' > " . $row_log['object'] . "</td>";
          //$finalHTML .= " <td style=' padding-right: 15px' > " . $date_format . "</td>";
          //$finalHTML .= "</tr>";

                    $finalHTML .= "<p>" . $row_log['action'] . " " . $row_log['object'] . " " . $date_format . "</p>";
                } else {
                    break;
                }
            }

            //$finalHTML .= "<table>";

            $finalHTML .= "</div>";

            $finalHTML .= "</div>";

            $finalHTML .= "<div class='d-flex justify-content-start'>";

            $finalHTML .=  "<b>Доступ:</b>";

            $finalHTML .= "<div class='root_block' >";

            $temp_tag = explode(" ", $row['root']);

            $tag_counter = count($temp_tag);

            if (in_array(1, $temp_tag) || in_array(2, $temp_tag) || in_array(3, $temp_tag)) {

                $finalHTML .= "<span>Новости</span>" . "  ";
            }

            if (in_array(4, $temp_tag) || in_array(5, $temp_tag) || in_array(6, $temp_tag)) {
                $finalHTML .= "<span>Преподаватели</span>" . "  ";
            }

            if (in_array(7, $temp_tag) || in_array(8, $temp_tag) || in_array(9, $temp_tag)) {

                $finalHTML .= "<span>Управления потоками</span>" . "  ";
            }

            if (in_array(10, $temp_tag) || in_array(11, $temp_tag) || in_array(12, $temp_tag)) {

                $finalHTML .= "<span>Кафедры</span>" . "  ";
            }

            if (in_array(13, $temp_tag) || in_array(14, $temp_tag) || in_array(15, $temp_tag)) {

                $finalHTML .= "<span>Пользователи</span>" . "  ";
            }

            $finalHTML .= "</div>";

            $finalHTML .= "</div>";

            $finalHTML .= "<div class='d-flex justify-content-end'>";

            $finalHTML .= "<div class = 'button_block'>";

            $finalHTML .= "<a href='http://ics.odessa.ua/page-show-logs-this-user.php?name_logs=" . $result_logs['name'] . "'><input type='button' class='btn btn-outline-primary btn-sm' value='Показать логи'></a>";

            $add_user_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 13 ");
            $result_add_user = mysqli_fetch_array($add_user_sql, MYSQLI_ASSOC);

            $edit_user_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 14 ");
            $result_edit_user = mysqli_fetch_array($edit_user_sql, MYSQLI_ASSOC);

            $delete_user_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 15 ");
            $result_delete_user = mysqli_fetch_array($delete_user_sql, MYSQLI_ASSOC);

            $edit_user_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 14 ");
            $result_edit_user = mysqli_fetch_array($edit_user_sql, MYSQLI_ASSOC);


            if ($row['id'] == $_SESSION['access_user_id']) {
            } else {
                if ($result_edit_user['access'] == 1) {
                    $finalHTML .= "<span class='indent'></span><a href='http://ics.odessa.ua/page-edit-user.php?id_user=" . $row['id'] . "&" . "login_user=" . $row['login'] . "'><input type='button' class='btn btn-outline-primary btn-sm' value='Редактировать'></a>";

                    $delete_user_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 15 ");
                    $result_delete_user = mysqli_fetch_array($delete_user_sql, MYSQLI_ASSOC);
                    if ($result_delete_user['access'] == 1) {
                        $finalHTML .= "<span class='indent'></span><a href='http://ics.odessa.ua/page-delete-user.php?id_user=" . $row['id'] . "&" . "login_user=" . $row['login'] . "'><input type='button' class='btn btn-outline-primary btn-sm' value='Удалить'></a>";
                    }
                }
            }

            $finalHTML .= "</div>";

            $finalHTML .= "</div>";

            $finalHTML .= "</div>";
        }
    }

    return $finalHTML;
}

  function sendMailActivation() {



  }

  function addGroup($year, $speciality) {

    global $link;

    $link -> query("INSERT INTO groups (year, number, id_subfaculty) VALUES ('$year', 1, '$speciality')");

    $addedGroupID = $link -> insert_id;

    $link -> query("INSERT INTO streams (seq_groups) VALUES ('$addedGroupID')");

  }

  function viewProfessorsInProperSection($getProfessorsSQL) {

    global $link;

    $finalHTML = '';

    $getProfessorsSQL = $getProfessorsSQL;
    $getAllProfessorsSQLResult = mysqli_query($link, $getProfessorsSQL);
    $getAllProfessorsSQLResultCheck = mysqli_num_rows($getAllProfessorsSQLResult);
            
    while ($row = mysqli_fetch_assoc($getAllProfessorsSQLResult)) {
            
      $professorID = $row['id'];
            
      // $professorInitials = getProfessorInitialsById($professorID);

      $professorLastName = $row['last_name'];
      $professorFirstName = $row['first_name'];
      $professorPatronymic = $row['patronymic'];

      $professorDescription = $row['description'];

      $professorPhoto = $row['photo_name'];
            
      $professorDegrees = $row['degree'];
            
      $professorConsultations = $row['seq_consultations'];
            
      $finalHTML .= "<div class='professor_box' id='$professorID'>";

        $finalHTML .= "<div class='professor_box_image'>";

        if(!empty($professorPhoto)){

          $finalHTML .= "<img src='http://ics.odessa.ua/upload-images/professor photos/$professorPhoto' width='100' height='auto' alt='professor.jpeg'>";
    
        }
    
        else {
    
          $finalHTML .= "<p>Фото <br>отсутствует</p>";
    
        }

        $finalHTML .= "</div>";

        $finalHTML .= "<div class='professor_box_desc'>";
            
        $finalHTML .= "<p>" . $professorLastName . " " . $professorFirstName . " " . $professorPatronymic . "<p>";

        if(!empty($professorDescription)){

          $finalHTML .= "<p>О преподавателе: " . $professorDescription . "</p>";
    
        }
    
        else {
    
          $finalHTML .= "<p>О преподавателе: Информация отсутствует</p>";
    
        }

        $finalHTML .= "<p>Учёные звания и степени: " . $professorDegrees . "</p>";

        $finalHTML .= "</div>";

        $consultationsAndDegreesIndicator = 0;

        if ($row['seq_consultations'] != '0') {

          $consultationsAndDegreesIndicator++;
            
          $professorConsultationsIdSequence = $row['seq_consultations'];

          $professorConsultationsIdArray = explode(' ', $professorConsultationsIdSequence);
          $professorConsultationsArray = array();

          for ($i = 0; $i < count($professorConsultationsIdArray); $i++) {
            
            $getConsultationByIdSQL = "SELECT * FROM consultations WHERE id = '$professorConsultationsIdArray[$i]';";
            
            $getConsultationByIdSQLResult = mysqli_query($link, $getConsultationByIdSQL);
            $getConsultationByIdRow = mysqli_fetch_array($getConsultationByIdSQLResult, MYSQLI_ASSOC);
            
            $consultationObject = [
            
              "day" => $getConsultationByIdRow['day'],
              "room" => $getConsultationByIdRow['room'],
              "start_time" => substr($getConsultationByIdRow['start_time'], 0, -3),
              "finish_time" => substr($getConsultationByIdRow['finish_time'], 0, -3),
            
            ];
            
            $professorConsultationsArray[$i] = $consultationObject;
            
          }

        }

        $finalHTML .= "<div class='professor_box_consultation'>";

        $finalHTML .= "<p>Консультации: </p>";

        for ($i = 0; $i < count($professorConsultationsArray); $i++) {
            
          $finalHTML .= "<p>" . $professorConsultationsArray[$i]["day"] . ": ауд. " . $professorConsultationsArray[$i]["room"] . " (" . $professorConsultationsArray[$i]["start_time"] . "-" . $professorConsultationsArray[$i]["finish_time"] . ")" . "</p>";
          
        }

        $finalHTML .= "</div>";

        $finalHTML .= "</div>";

        $finalHTML .= "<a href='http://ics.odessa.ua/page-edit-professor.php?id_professor=" . $row['id'] . "'><input type='button' class='btn btn-outline-primary' value='Редактировать'></a>";

        $finalHTML .= "<span class='indent'></span><a href='http://ics.odessa.ua/page-remove-professor.php?id_professor=" . $row['id'] . "'><input type='button' class='btn btn-outline-primary' value='Удалить'></a>";


      $finalHTML .= "<hr>";

    }                 
            
    return $finalHTML;

  }

  function viewNewsOfApplicants() {

    global $link;

    $finalHTML = '';

    $currentTime = date("Y-m-d H:i:s");

    $getNewsOfApplicantsSQL = "SELECT * FROM newstable WHERE tag LIKE '%1%' AND date <= '$currentTime' ORDER BY date DESC;";
    $getNewsOfApplicantsSqlResult = mysqli_query($link, $getNewsOfApplicantsSQL);
    $getNewsOfApplicantsSqlResultCheck = mysqli_num_rows($getNewsOfApplicantsSqlResult);

    if ($getNewsOfApplicantsSqlResultCheck == 0) {

      $finalHTML .= "<div>Новости отсутствуют<div>";

    }

    else {

      while ($row = mysqli_fetch_assoc($getNewsOfApplicantsSqlResult)) {

        $news_image = $row['image'];

        $finalHTML .= "<div id='news-box-'" . $row['id'] . "' class='news_container'>";

          $finalHTML .= "<div class='news_top'>";

            $finalHTML .= "<div>";

              if(!empty($news_image)){

                $finalHTML .= "<a href='#'><img src='http://ics.odessa.ua/upload-images/$news_image' alt='$news_image' class='news_image'></a>";
        
              }
        
              else {
        
                $finalHTML .= "<a href='#'><img src='http://ics.odessa.ua/img/logo-ics.png' alt='logo-ics.png' class='news_image'></a>";
        
              }

            $finalHTML .= "</div>";

            $finalHTML .= "<div>";

              $finalHTML .= "<a href='#'><p class='news_title'>" . $row['title'] . "</p></a>";

              $finalHTML .= "<p class='news_description'>" . $row['description'] . "</p>";

            $finalHTML .= "</div>";

          $finalHTML .= "</div>";

          $finalHTML .= "<div class='news_bottom'>";

            $date = date_create($row['date']);
            $view_date = date_format($date, 'd.m.Y H:i');

            $finalHTML .= "<div class='news_date'>" . $view_date . "</div>";

            $finalHTML .= "<div class='news_author'>" . $row['author'] . "</div>";

            $finalHTML .= "<a href='#'><div class='news_read'>Читать</div></a>";

          $finalHTML .= "</div>";

        $finalHTML .= "</div>";
        
      }

    }

    return $finalHTML;

  }

  function viewNewsForStudents() {

    global $link;

    $finalHTML = '';

    $currentTime = date("Y-m-d H:i:s");

    $getNewsForStudentsSQL = "SELECT * FROM newstable WHERE tag LIKE '%2%' AND date <= '$currentTime' ORDER BY date DESC;";

    $getNewsForStudentsSqlResult = mysqli_query($link, $getNewsForStudentsSQL);
    $getNewsForStudentsSqlResultCheck = mysqli_num_rows($getNewsForStudentsSqlResult);

    if ($getNewsForStudentsSqlResultCheck == 0) {

      $finalHTML .= "<div>Новости отсутствуют<div>";

    }

    else {

      while ($row = mysqli_fetch_assoc($getNewsForStudentsSqlResult)) {

        $news_id = $row['id'];

        $news_image = $row['image'];

        $finalHTML .= "<div id='news-for-students-box-'" . $row['id'] . "' class='news_container student_news_box'>";

          $finalHTML .= "<div class='news_top'>";

            $finalHTML .= "<div>";

              if(!empty($news_image)){

                $finalHTML .= "<a href='#'><img src='http://ics.odessa.ua/upload-images/$news_image' alt='$news_image' class='news_image students_image'></a>";
        
              }
        
              else {
        
                $finalHTML .= "<a href='#'><img src='http://ics.odessa.ua/img/logo-ics.png' alt='logo-ics.png' class='news_image students_image'></a>";
        
              }

            $finalHTML .= "</div>";

            $finalHTML .= "<div>";

              $finalHTML .= "<a href='#'><p class='news_title students_news_title'>" . $row['title'] . "</p></a>";

              $finalHTML .= "<p class='news_description students_news_description'>" . $row['description'] . "</p>";

            $finalHTML .= "</div>";

          $finalHTML .= "</div>";

          $finalHTML .= "<div class='news_bottom'>";

            $finalHTML .= "<div class='news_date students_box_bottom students_news_font_size'>" . $row['date'] . "</div>";

            $finalHTML .= "<div class='news_author students_news_font_size'>" . $row['author'] . "</div>";

            $finalHTML .= "<div class='news_read' id='$news_id'>Читать</div>";

          $finalHTML .= "</div>";

        $finalHTML .= "</div>";
        
      }

    }

    return $finalHTML;

  }

  function viewNewsForGraduates() {

    global $link;

    $finalHTML = '';

    $currentTime = date("Y-m-d H:i:s");

    $getNewsForStudentsSQL = "SELECT * FROM newstable WHERE tag LIKE '%3%' AND date <= '$currentTime' ORDER BY date DESC;";

    $getNewsForStudentsSqlResult = mysqli_query($link, $getNewsForStudentsSQL);
    $getNewsForStudentsSqlResultCheck = mysqli_num_rows($getNewsForStudentsSqlResult);

    if ($getNewsForStudentsSqlResultCheck == 0) {

      $finalHTML .= "<div>Новости отсутствуют<div>";

    }

    else {

      while ($row = mysqli_fetch_assoc($getNewsForStudentsSqlResult)) {

        $news_id = $row['id'];

        $news_image = $row['image'];

        $finalHTML .= "<div id='news-box-'" . $row['id'] . "' class='news_container'>";

          $finalHTML .= "<div class='news_top'>";

            $finalHTML .= "<div>";

              if(!empty($news_image)){

                $finalHTML .= "<img src='http://ics.odessa.ua/upload-images/$news_image' alt='$news_image' class='news_image' id='$news_id'>";
        
              }
        
              else {
        
                $finalHTML .= "<img src='http://ics.odessa.ua/img/logo-ics.png' alt='logo-ics.png' class='news_image' id='$news_id'>";
        
              }

            $finalHTML .= "</div>";

            $finalHTML .= "<div>";

              $finalHTML .= "<p class='news_title' id='$news_id'>" . $row['title'] . "</p>";

              $finalHTML .= "<p class='news_description'>" . $row['description'] . "</p>";

            $finalHTML .= "</div>";

          $finalHTML .= "</div>";

          $finalHTML .= "<div class='news_bottom'>";

            $finalHTML .= "<div class='news_date'>" . $row['date'] . "</div>";

            $finalHTML .= "<div class='news_author'>" . $row['author'] . "</div>";

            $finalHTML .= "<div class='news_read' id='$news_id'>Читать</div>";

          $finalHTML .= "</div>";

        $finalHTML .= "</div>";
        
      }

    }

    return $finalHTML;

  }

  function readNewsById($getNewsId) {

    global $link;

    $finalHTML = '';

    $getNewsById = "SELECT * FROM newstable WHERE id = '$getNewsId';";

    $getNewsForStudentsSqlResult = mysqli_query($link, $getNewsById);
    $getNewsForStudentsSqlResultCheck = mysqli_num_rows($getNewsForStudentsSqlResult);

    if ($getNewsForStudentsSqlResultCheck == 0) {

      $finalHTML .= "<div>Информация отсутствует<div>";

    }

    else {

      while ($row = mysqli_fetch_assoc($getNewsForStudentsSqlResult)) {

        $newsTitle = $row['title'];
        $newsDescription = $row['description'];
        $newsAuthor = $row['author'];
        $newsLink = $row['link'];

        $newsImageName = $row['image'];
        $newsFileName = $row['file'];

        $finalHTML .= "<p class='news_title modal_title'>" . $newsTitle . "</p>";

        $date = date_create($row['date']);
        $view_date = date_format($date, 'd.m.Y H:i');

        $finalHTML .= "<div class='modal_flex_space_between'>";

        $finalHTML .= "<div>";

        $finalHTML .= "<p class='news_description modal_desc'>$view_date</p>";

        $finalHTML .= "</div>";

        $finalHTML .= "<div>";

        if(!empty($newsAuthor)){

          $finalHTML .= "<p class='news_description modal_desc'>Автор: $newsAuthor</p>";

        }

        else {

          $finalHTML .= "<p class='news_description modal_desc'>Автор отсутствует</p>";

        }

        $finalHTML .= "</div>";

        $finalHTML .= "</div>";

        $finalHTML .= "<div>";

              if(!empty($newsImageName)){

                $finalHTML .= "<a href='#'><img src='http://ics.odessa.ua/upload-images/$newsImageName' alt='$newsImageName' class='news_image modal_image'></a>";
        
              }
        
              else {
        
                $finalHTML .= "<a href='#'><img src='http://ics.odessa.ua/img/logo-ics.png' alt='logo-ics.png' class='news_image modal_image'></a>";
        
              }

            $finalHTML .= "</div>";

        $finalHTML .= "<p class='news_description modal_desc'>" . $newsDescription . "</p>";

        $finalHTML .= "<div class='modal_flex_space_between'>";

        $finalHTML .= "<div>";

        if(!empty($newsLink)){

          $finalHTML .= "<p class='news_description modal_remove_height'>Ссылка: <a href='$newsLink'>Перейти</a></p>";
    
        }
    
        else {
    
          $finalHTML .= "<p class='news_description modal_remove_height'>Ссылка отсутствует</p>";
    
        }

        $finalHTML .= "</div>";

        $finalHTML .= "<div>";
    
        if(!empty($newsFileName)){
    
          $finalHTML .= "<p class='news_description modal_remove_height'>Файл: <a href='upload-files/$newsFileName' download>Скачать</a></p>";
    
        }
    
        else {
    
          $finalHTML .= "<p class='news_description modal_remove_height'>Файл отсутствует</p>";
    
        }

        $finalHTML .= "</div>";

        $finalHTML .= "</div>";
        
      }

    }

    return $finalHTML;

  }



  // function getGroupFullNameByID($groupID) {

  //   $getGroupFullNameFragsByIdSQL = "SELECT year, number, id_subfaculty FROM groups WHERE id = '$groupID';";
  //   $getGroupFullNameFragsByIdSQLResult = mysqli_query($link, $getGroupFullNameFragsByIdSQL);

  //   $getGroupFullNameFragsByIdSQLRow = mysqli_fetch_array($getGroupFullNameFragsByIdSQLResult, MYSQLI_ASSOC);

  //   $groupFullName = getSpecialityCodeById($getGroupFullNameFragsByIdSQLRow['id_subfaculty']) . '-' . getYearInGroupFormat($getGroupFullNameFragsByIdSQLRow['year']) . $getGroupFullNameFragsByIdSQLRow['number'];

  //   return $groupFullName;

  // }

?>