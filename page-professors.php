<?php

include_once 'database.php';
include_once 'functions.php';

?>

<?php include 'header.php'; ?>
<link rel="stylesheet" href="http://ics.odessa.ua/Local CSS/professors.css">
<main>

    <div class="extra_menu">

        <div class="container">

        <ul class="extra_menu_ul">
            <li><a href="http://ics.odessa.ua/page-show-all-specialties.php">Специальности</a></li>
            <li><a href="">Самоуправление</a></li>
        </ul>

        </div>

    </div>

    <div class="container">

    <div class="div_audience">

        <h1 class="audience">Преподаватели</h1>

    </div>

        <?php

                $allsql = mysqli_query($link, "SELECT * FROM professors");

                while ($result = mysqli_fetch_array($allsql)) {

                    $professorLastName = $result['last_name'];

                    $professorFirstName = $result['first_name'];

                    $professorPatronymic = $result['patronymic'];

                    $professorDescription = $result['description'];

                    $professorPhoto = $result['photo_name'];

                    $professorDegrees = $result['degree'];

                    echo "<div class='pofessor_box'>";

                    echo "<div class='pofessor_top'>";

                    echo "<div>";

                    if(!empty($professorPhoto)){

                        echo "<img src='http://ics.odessa.ua/upload-images/professor photos/$professorPhoto' class='pofessor_image' alt='professor.jpeg'>";
                  
                    }
                  
                    else {
                  
                        echo "<p>Фото <br>отсутствует</p>";
                  
                    }

                    echo "</div>";

                  

                    echo "<div>";

                    echo "<p class='pofessor_fio'>" . $professorLastName . " " . $professorFirstName . " " . $professorPatronymic . "<p>";

                    if(!empty($professorDescription)){

                        echo "<p class='pofessor_description'><span class='bold_text'>О преподавателе: </span>" . $professorDescription . "</p>";
    
                    }
    
                    else {
    
                        echo "<p><span class='bold_text'>О преподавателе: </span>Информация отсутствует</p>";
    
                    }  

                    echo "<p class='pofessor_description pofessor_description_non_height'><span class='bold_text'>Учёные звания и степени: </span>" . $professorDegrees . "</p>";

                    $consultationsAndDegreesIndicator = 0;

                    if ($result['seq_consultations'] != '0') {

                        $consultationsAndDegreesIndicator++;
            
                        $professorConsultationsIdSequence = $result['seq_consultations'];

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
                            
                    echo "<p class='pofessor_description pofessor_description_non_height bold_text'>Консультации: </p>";
                            
                    for ($i = 0; $i < count($professorConsultationsArray); $i++) {
                        
                        echo "<p class='pofessor_description pofessor_description_non_height'>" . "День: " . $professorConsultationsArray[$i]["day"] . ".&nbsp&nbsp&nbsp Аудитория: " . $professorConsultationsArray[$i]["room"] . "&nbsp&nbsp&nbsp Часы приема: " . $professorConsultationsArray[$i]["start_time"] . "-" . $professorConsultationsArray[$i]["finish_time"] . "</p>";
                    
                    }

                    echo "</div>";
                    echo "</div>";
                    echo "</div>";

                }

            ?>

        </div>

</main>

<?php include 'footer.php'; ?>