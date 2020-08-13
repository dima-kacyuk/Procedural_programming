<?php

	include_once 'database.php';
	include_once 'functions.php';

 ?>

<?php include 'header-admin.php'; ?>

    <main>

	    <div class="container">

            <div class="centerdiv">
                <h1>Редактирование преподавателя</h1>
            </div>

                <?php 

                $professor_id = $_GET["id_professor"];

                $sql = mysqli_query($link, "SELECT * FROM `professors` WHERE id = '$professor_id'");

                $result = mysqli_fetch_array($sql);

                ?>

                <form id="addform" action="" method="post" enctype="multipart/form-data" onsubmit="checkmyform(this, event)">

                <p><input class="form-control" type="text" pattern="^[А-Яа-яЁё\s]+$" size="30" maxlength="30" name="last_name" required placeholder="Фамилия *" value="<?php echo $result['last_name']?>" autocomplete="off"/></p>
                <p><input class="form-control" type="text" pattern="^[А-Яа-яЁё\s]+$" size="30" maxlength="30" name="first_name" required placeholder="Имя *" value="<?php echo $result['first_name']?>" autocomplete="off"/></p>
                <p><input class="form-control" type="text" pattern="^[А-Яа-яЁё\s]+$" size="30" maxlength="30" name="patronymic" required placeholder="Отчество *" value="<?php echo $result['patronymic']?>" autocomplete="off"/></p>
                <p>
                <textarea style="height:300px;" class="form-control" name="description" required placeholder="Описание *" autocomplete="off"><?php echo $result['description']?></textarea>
                </p>

                 <?php

                    if(!empty($result['photo_name'])){

                        $temp_photo = $result['photo_name'];

                        echo"<img src='http://ics.odessa.ua/upload-images/professor photos/$temp_photo' width='100' height='auto' alt='professor.jpeg'>";

                    }

                    else {

                        echo "Картинка <br>отсутствует";

                    }
                    
                ?>

                <p>
                <div class="custom-file">
                    <input type="file" accept="image/*" name="img_upload" class="custom-file-input" id="customFile1">
                    <label class="custom-file-label" for="customFile">Добавить новое фото</label>
                </div>
                </p>

                <script type="application/javascript">

                    document.getElementById('customFile1').addEventListener('change',function(e){
                        var fileName = document.getElementById("customFile1").files[0].name;
                        var nextSibling = e.target.nextElementSibling
                        nextSibling.innerText = fileName
                    });

                </script>

                <?php 

                    $findme1 = 'Доктор технических наук';

                    $findme2 = 'Профессор';

                    $findme3 = 'Кандидат технических наук';

                    $findme4 = 'Доцент';

                    $temp_degree_result = $result['degree'];

                    $degree1 = stripos($temp_degree_result, $findme1);

                    $degree2 = stripos($temp_degree_result, $findme2);

                    $degree3 = stripos($temp_degree_result, $findme3);

                    $degree4 = stripos($temp_degree_result, $findme4);

                ?>
                <p>
                <select name="degree" class="form-control">
                    <option disabled>Выберите научную степень</option>
                    <option value="Доктор технических наук" <?php if ($degree1 !== false) { echo 'checked'; } ?> >Доктор технических наук</option>
                    <option value="Профессор" <?php if ($degree2 !== false) { echo 'checked'; } ?> >Профессор</option>
                    <option value="Кандидат технических наук" <?php if ($degree3 !== false) { echo 'checked'; } ?> >Кандидат технических наук</option>
                    <option value="Доцент" <?php if ($degree4 !== false) { echo 'checked'; } ?> >Доцент</option>
                </select>
                </p>

                <p>Консультации: </p>

                <?php

                $consultations_arr = explode(" ", $result['seq_consultations']);

                if(!empty($consultations_arr[0])) {

                    $first_consultation_id = $consultations_arr[0];

                    if(!empty($first_consultation_id)) {

                        $consultation_sql = mysqli_query($link, "SELECT * FROM `consultations` WHERE id = '$first_consultation_id'");

                        $first_consultation_id_result = mysqli_fetch_array($consultation_sql);

                    }
                    
                }
                
                ?>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

                <script>

                $(document).ready(function(){

                    $('.form-check-inline').each(function(){

                        if(this.value == '' || this.value == undefined){

                            $(this).parent(".form-check-inline1").hide();

                        }

                    })

                    $(".add").click(function(){

                        var x = $(".form-check-inline1:visible").length;

                        if(x != 5) { 

                            $(".form-check-inline1:eq(" + x + ")").show();

                        }
                        
                        else {

                            alert('Максимальное количество консультаций - 5');

                        }

                    });

                });

                </script>
                
                <p class="form-check-inline1">День: 
                <select id="day1" name="day1">
                    <option disabled>Выберите день недели</option>
                    <option value="Пн" <?php if (!empty($first_consultation_id_result)) { if (stripos($first_consultation_id_result['day'], 'Пн') !== false) { echo 'selected'; } } ?>>Понедельник</option>
                    <option value="Вт" <?php if (!empty($first_consultation_id_result)) { if (stripos($first_consultation_id_result['day'], 'Вт') !== false) { echo 'selected'; } } ?>>Вторник</option>
                    <option value="Ср" <?php if (!empty($first_consultation_id_result)) { if (stripos($first_consultation_id_result['day'], 'Ср') !== false) { echo 'selected'; } } ?>>Среда</option>
                    <option value="Чт" <?php if (!empty($first_consultation_id_result)) { if (stripos($first_consultation_id_result['day'], 'Чт') !== false) { echo 'selected'; } } ?>>Четверг</option>
                    <option value="Пт" <?php if (!empty($first_consultation_id_result)) { if (stripos($first_consultation_id_result['day'], 'Пт') !== false) { echo 'selected'; } } ?>>Пятница</option>
                    <option value="Сб" <?php if (!empty($first_consultation_id_result)) { if (stripos($first_consultation_id_result['day'], 'Сб') !== false) { echo 'selected'; } } ?>>Суббота</option>
                </select>
                Аудитория: <input autocomplete="off" class="form-check-inline" type="text" size="4" maxlength="4" id="auditory1" name="auditory1" placeholder="711" value="<?php if(!empty($first_consultation_id_result['room'])) { echo $first_consultation_id_result['room']; } ?>"/>
                Начало: <input type="time" id="start_consultations1" name="start_consultations1" value="<?php if(!empty($first_consultation_id_result['start_time'])) { echo $first_consultation_id_result['start_time']; } ?>"/>
                Конец: <input type="time" id="end_consultations1" name="end_consultations1" value="<?php if(!empty($first_consultation_id_result['finish_time'])) { echo $first_consultation_id_result['finish_time']; } ?>"/>
                <input type="button" class="clear1" id="clearButton1" value="Удалить консультацию">
                </p>

                <script>

                $(".clear1").click(function(){

                    $(this).parent(".form-check-inline1").hide();

                });

                    document.getElementById("clearButton1").onclick = function(e) {

                    document.getElementById("day1").value = "Пн";

                    document.getElementById("auditory1").value = "";

                    document.getElementById("start_consultations1").value = "";

                    document.getElementById("end_consultations1").value = "";

                }

                </script>

                <?php

                if(!empty($consultations_arr[1])){

                    $second_consultation_id = $consultations_arr[1];

                    if(!empty($second_consultation_id)) {

                        $consultation_sql = mysqli_query($link, "SELECT * FROM `consultations` WHERE id = '$second_consultation_id'");

                        $second_consultation_id_result = mysqli_fetch_array($consultation_sql);

                    }

                }
                
                ?>
                
                <p class="form-check-inline1">День: 
                <select id="day2" name="day2">
                    <option disabled>Выберите день недели</option>
                    <option value="Пн" <?php if (!empty($second_consultation_id_result)) { if (stripos($second_consultation_id_result['day'], 'Пн') !== false) { echo 'selected'; } } ?>>Понедельник</option>
                    <option value="Вт" <?php if (!empty($second_consultation_id_result)) { if (stripos($second_consultation_id_result['day'], 'Вт') !== false) { echo 'selected'; } } ?>>Вторник</option>
                    <option value="Ср" <?php if (!empty($second_consultation_id_result)) { if (stripos($second_consultation_id_result['day'], 'Ср') !== false) { echo 'selected'; } } ?>>Среда</option>
                    <option value="Чт" <?php if (!empty($second_consultation_id_result)) { if (stripos($second_consultation_id_result['day'], 'Чт') !== false) { echo 'selected'; } } ?>>Четверг</option>
                    <option value="Пт" <?php if (!empty($second_consultation_id_result)) { if (stripos($second_consultation_id_result['day'], 'Пт') !== false) { echo 'selected'; } } ?>>Пятница</option>
                    <option value="Сб" <?php if (!empty($second_consultation_id_result)) { if (stripos($second_consultation_id_result['day'], 'Сб') !== false) { echo 'selected'; } } ?>>Суббота</option>
                </select>
                Аудитория: <input autocomplete="off" class="form-check-inline" type="text" size="4" maxlength="4" id="auditory2" name="auditory2" placeholder="711" value="<?php if(!empty($second_consultation_id_result['room'])) { echo $second_consultation_id_result['room']; } ?>"/>
                Начало: <input type="time" id="start_consultations2" name="start_consultations2" value="<?php if(!empty($second_consultation_id_result['start_time'])) { echo $second_consultation_id_result['start_time']; } ?>"/>
                Конец: <input type="time" id="end_consultations2" name="end_consultations2" value="<?php if(!empty($second_consultation_id_result['finish_time'])) { echo $second_consultation_id_result['finish_time']; } ?>"/>
                <input type="button" class="clear2" id="clearButton2" value="Удалить консультацию">
                </p>

                <script>

                $(".clear2").click(function(){

                    $(this).parent(".form-check-inline1").hide();

                });

                    document.getElementById("clearButton2").onclick = function(e) {

                    document.getElementById("day2").value = "Пн";

                    document.getElementById("auditory2").value = "";

                    document.getElementById("start_consultations2").value = "";

                    document.getElementById("end_consultations2").value = "";

                }

                </script>

                <?php

                if(!empty($consultations_arr[2])) {

                    $third_consultation_id = $consultations_arr[2];

                    if(!empty($third_consultation_id)) {

                        $consultation_sql = mysqli_query($link, "SELECT * FROM `consultations` WHERE id = '$third_consultation_id'");

                        $third_consultation_id_result = mysqli_fetch_array($consultation_sql);

                    }

                }
                
                ?>
                
                <p class="form-check-inline1">День: 
                <select id="day3" name="day3">
                    <option disabled>Выберите день недели</option>
                    <option value="Пн" <?php if (!empty($third_consultation_id_result)) { if (stripos($third_consultation_id_result['day'], 'Пн') !== false) { echo 'selected'; } } ?>>Понедельник</option>
                    <option value="Вт" <?php if (!empty($third_consultation_id_result)) { if (stripos($third_consultation_id_result['day'], 'Вт') !== false) { echo 'selected'; } } ?>>Вторник</option>
                    <option value="Ср" <?php if (!empty($third_consultation_id_result)) { if (stripos($third_consultation_id_result['day'], 'Ср') !== false) { echo 'selected'; } } ?>>Среда</option>
                    <option value="Чт" <?php if (!empty($third_consultation_id_result)) { if (stripos($third_consultation_id_result['day'], 'Чт') !== false) { echo 'selected'; } } ?>>Четверг</option>
                    <option value="Пт" <?php if (!empty($third_consultation_id_result)) { if (stripos($third_consultation_id_result['day'], 'Пт') !== false) { echo 'selected'; } } ?>>Пятница</option>
                    <option value="Сб" <?php if (!empty($third_consultation_id_result)) { if (stripos($third_consultation_id_result['day'], 'Сб') !== false) { echo 'selected'; } } ?>>Суббота</option>
                </select>
                Аудитория: <input autocomplete="off" class="form-check-inline" type="text" size="4" maxlength="4" id="auditory3" name="auditory3" placeholder="711" value="<?php if(!empty($third_consultation_id_result['room'])) { echo $third_consultation_id_result['room']; } ?>"/>
                Начало: <input type="time" id="start_consultations3" name="start_consultations3" value="<?php if(!empty($third_consultation_id_result['start_time'])) { echo $third_consultation_id_result['start_time']; } ?>"/>
                Конец: <input type="time" id="end_consultations3" name="end_consultations3" value="<?php if(!empty($third_consultation_id_result['finish_time'])) { echo $third_consultation_id_result['finish_time']; }?>"/>
                <input type="button" class="clear3" id="clearButton3" value="Удалить консультацию">
                </p>

                <script>

                $(".clear3").click(function(){

                    $(this).parent(".form-check-inline1").hide();

                });

                    document.getElementById("clearButton3").onclick = function(e) {

                    document.getElementById("day3").value = "Пн";

                    document.getElementById("auditory3").value = "";

                    document.getElementById("start_consultations3").value = "";

                    document.getElementById("end_consultations3").value = "";

                }

                </script>

                <?php

                if(!empty($consultations_arr[3])) {

                    $fourth_consultation_id = $consultations_arr[3];

                    if(!empty($fourth_consultation_id)) {

                        $consultation_sql = mysqli_query($link, "SELECT * FROM `consultations` WHERE id = '$fourth_consultation_id'");

                        $fourth_consultation_id_result = mysqli_fetch_array($consultation_sql);

                    }

                }
                
                ?>
                
                <p class="form-check-inline1">День: 
                <select id="day4" name="day4">
                    <option disabled>Выберите день недели</option>
                    <option value="Пн" <?php if (!empty($fourth_consultation_id_result)) { if (stripos($fourth_consultation_id_result['day'], 'Пн') !== false) { echo 'selected'; } } ?>>Понедельник</option>
                    <option value="Вт" <?php if (!empty($fourth_consultation_id_result)) { if (stripos($fourth_consultation_id_result['day'], 'Вт') !== false) { echo 'selected'; } } ?>>Вторник</option>
                    <option value="Ср" <?php if (!empty($fourth_consultation_id_result)) { if (stripos($fourth_consultation_id_result['day'], 'Ср') !== false) { echo 'selected'; } } ?>>Среда</option>
                    <option value="Чт" <?php if (!empty($fourth_consultation_id_result)) { if (stripos($fourth_consultation_id_result['day'], 'Чт') !== false) { echo 'selected'; } } ?>>Четверг</option>
                    <option value="Пт" <?php if (!empty($fourth_consultation_id_result)) { if (stripos($fourth_consultation_id_result['day'], 'Пт') !== false) { echo 'selected'; } } ?>>Пятница</option>
                    <option value="Сб" <?php if (!empty($fourth_consultation_id_result)) { if (stripos($fourth_consultation_id_result['day'], 'Сб') !== false) { echo 'selected'; } } ?>>Суббота</option>
                </select>
                Аудитория: <input autocomplete="off" class="form-check-inline" type="text" size="4" maxlength="4" id="auditory4" name="auditory4" placeholder="711" value="<?php if(!empty($fourth_consultation_id_result['room'])) { echo $fourth_consultation_id_result['room']; } ?>"/>
                Начало: <input type="time" id="start_consultations4" name="start_consultations4" value="<?php if(!empty($fourth_consultation_id_result['start_time'])) { echo $fourth_consultation_id_result['start_time']; } ?>"/>
                Конец: <input type="time" id="end_consultations4" name="end_consultations4" value="<?php if(!empty($fourth_consultation_id_result['finish_time'])) { echo $fourth_consultation_id_result['finish_time']; } ?>"/>
                <input type="button" class="clear4" id="clearButton4" value="Удалить консультацию">
                </p>

                <script>

                $(".clear4").click(function(){

                    $(this).parent(".form-check-inline1").hide();

                });

                    document.getElementById("clearButton4").onclick = function(e) {

                    document.getElementById("day4").value = "Пн";

                    document.getElementById("auditory4").value = "";

                    document.getElementById("start_consultations4").value = "";

                    document.getElementById("end_consultations4").value = "";

                }

                </script>

                <?php

                if(!empty($consultations_arr[4])) {

                    $fifth_consultation_id = $consultations_arr[4];

                    if(!empty($fifth_consultation_id)) {

                        $consultation_sql = mysqli_query($link, "SELECT * FROM `consultations` WHERE id = '$fifth_consultation_id'");

                        $fifth_consultation_id_result = mysqli_fetch_array($consultation_sql);

                    }

                }
                
                ?>
                
                <p class="form-check-inline1">День: 
                <select id="day5" name="day5">
                    <option disabled>Выберите день недели</option>
                    <option value="Пн" <?php if (!empty($fifth_consultation_id_result)) { if (stripos($fifth_consultation_id_result['day'], 'Пн') !== false) { echo 'selected'; } } ?>>Понедельник</option>
                    <option value="Вт" <?php if (!empty($fifth_consultation_id_result)) { if (stripos($fifth_consultation_id_result['day'], 'Вт') !== false) { echo 'selected'; } } ?>>Вторник</option>
                    <option value="Ср" <?php if (!empty($fifth_consultation_id_result)) { if (stripos($fifth_consultation_id_result['day'], 'Ср') !== false) { echo 'selected'; } } ?>>Среда</option>
                    <option value="Чт" <?php if (!empty($fifth_consultation_id_result)) { if (stripos($fifth_consultation_id_result['day'], 'Чт') !== false) { echo 'selected'; } } ?>>Четверг</option>
                    <option value="Пт" <?php if (!empty($fifth_consultation_id_result)) { if (stripos($fifth_consultation_id_result['day'], 'Пт') !== false) { echo 'selected'; } } ?>>Пятница</option>
                    <option value="Сб" <?php if (!empty($fifth_consultation_id_result)) { if (stripos($fifth_consultation_id_result['day'], 'Сб') !== false) { echo 'selected'; } } ?>>Суббота</option>
                </select>
                Аудитория: <input autocomplete="off" class="form-check-inline" type="text" size="4" maxlength="4" id="auditory5" name="auditory5" placeholder="711" value="<?php if(!empty($fifth_consultation_id_result['room'])) { echo $fifth_consultation_id_result['room']; }?>"/>
                Начало: <input type="time" id="start_consultations5" name="start_consultations5" value="<?php if(!empty($fifth_consultation_id_result['start_time'])) { echo $fifth_consultation_id_result['start_time']; }?>"/>
                Конец: <input type="time" id="end_consultations5" name="end_consultations5" value="<?php if(!empty($fifth_consultation_id_result['finish_time'])) { echo $fifth_consultation_id_result['finish_time']; }?>"/>
                <input type="button" class="clear5" id="clearButton5" value="Удалить консультацию">
                </p>

                <script>

                $(".clear5").click(function(){

                    $(this).parent(".form-check-inline1").hide();

                });

                    document.getElementById("clearButton5").onclick = function(e) {

                    document.getElementById("day5").value = "Пн";

                    document.getElementById("auditory5").value = "";

                    document.getElementById("start_consultations5").value = "";

                    document.getElementById("end_consultations5").value = "";

                }

                </script>

                <p><input class="btn btn-outline-primary add" type="button" value="Добавить консультацию" /></p>

                <div class="centerdiv">
                <input class="btn btn-outline-primary" name="add_button" type="submit" value="Редактировать преподавателя" />

                <a href="http://ics.odessa.ua/page-all-professor.php"><input type="button" class="btn btn-outline-primary" value="Назад"></a>
                
                </div>
                

                <?php

                if(isset($_POST['add_button'])) {

                    $last_name_form = $_POST['last_name'];

                    $first_name_form = $_POST['first_name'];

                    $patronymic_form = $_POST['patronymic'];

                    $description_form = $_POST['description'];

                    if(!empty($result['photo_name'])){

                        $upload_image = $result['photo_name'];

                    }

                    else {

                        if(!empty($_FILES["img_upload"])) {

                            $upload_image=$_FILES["img_upload"]["name"];

                            $folder="upload-images/";

                            $upload_name = $folder.$upload_image;

                            move_uploaded_file($_FILES["img_upload"]["tmp_name"],"$folder".$_FILES["img_upload"]["name"]);

                        }

                        else {

                            $upload_image = '';

                        }

                    }

                    $degree_form = $_POST['degree'];

                    //Консультации

                    $consultation_arr = array();

                    if(!empty($_POST['day1'] && $_POST['auditory1'] && $_POST['start_consultations1'] && $_POST['end_consultations1'])){

                        $day_form = $_POST['day1'];

                        $auditory_form = $_POST['auditory1'];

                        $start_consultations_form = $_POST['start_consultations1'];

                        $end_consultations_form = $_POST['end_consultations1'];

                        if(!empty($first_consultation_id)) {

                            $link -> query("UPDATE consultations SET day = '$day_form', room = '$auditory_form', 
                            start_time = '$start_consultations_form', finish_time = '$end_consultations_form'
                            WHERE id = '$first_consultation_id'");

                            array_push($consultation_arr, $first_consultation_id);

                        }
                        else {
                            
                            $link -> query("INSERT INTO consultations (day, room, start_time, finish_time) 
                            VALUES ('$day_form', '$auditory_form', '$start_consultations_form', '$end_consultations_form')");

                            array_push($consultation_arr, $link->insert_id);

                        }

                    }
                    else {

                        $sql = mysqli_query($link, "DELETE FROM consultations WHERE id = '$first_consultation_id'");

                    }

                    if(!empty($_POST['day2'] && $_POST['auditory2'] && $_POST['start_consultations2'] && $_POST['end_consultations2'])){

                        $day_form = $_POST['day2'];

                        $auditory_form = $_POST['auditory2'];

                        $start_consultations_form = $_POST['start_consultations2'];

                        $end_consultations_form = $_POST['end_consultations2'];

                        if(!empty($second_consultation_id)) {

                            $link -> query("UPDATE consultations SET day = '$day_form', room = '$auditory_form', 
                            start_time = '$start_consultations_form', finish_time = '$end_consultations_form'
                            WHERE id = '$second_consultation_id'");

                            array_push($consultation_arr, $second_consultation_id);

                        }
                        else {
                            
                            $link -> query("INSERT INTO consultations (day, room, start_time, finish_time) 
                            VALUES ('$day_form', '$auditory_form', '$start_consultations_form', '$end_consultations_form')");

                            array_push($consultation_arr, $link->insert_id);

                        }

                    }
                    else {

                        $sql = mysqli_query($link, "DELETE FROM consultations WHERE id = '$second_consultation_id'");

                    }

                    if(!empty($_POST['day3'] && $_POST['auditory3'] && $_POST['start_consultations3'] && $_POST['end_consultations3'])){

                        $day_form = $_POST['day3'];

                        $auditory_form = $_POST['auditory3'];

                        $start_consultations_form = $_POST['start_consultations3'];

                        $end_consultations_form = $_POST['end_consultations3'];

                        if(!empty($third_consultation_id)) {

                            $link -> query("UPDATE consultations SET day = '$day_form', room = '$auditory_form', 
                            start_time = '$start_consultations_form', finish_time = '$end_consultations_form'
                            WHERE id = '$third_consultation_id'");

                            array_push($consultation_arr, $third_consultation_id);

                        }
                        else {
                            
                            $link -> query("INSERT INTO consultations (day, room, start_time, finish_time) 
                            VALUES ('$day_form', '$auditory_form', '$start_consultations_form', '$end_consultations_form')");

                            array_push($consultation_arr, $link->insert_id);

                        }

                    }
                    else {

                        $sql = mysqli_query($link, "DELETE FROM consultations WHERE id = '$third_consultation_id'");

                    }

                    if(!empty($_POST['day4'] && $_POST['auditory4'] && $_POST['start_consultations4'] && $_POST['end_consultations4'])){

                        $day_form = $_POST['day4'];

                        $auditory_form = $_POST['auditory4'];

                        $start_consultations_form = $_POST['start_consultations4'];

                        $end_consultations_form = $_POST['end_consultations4'];

                        if(!empty($fourth_consultation_id)) {

                            $link -> query("UPDATE consultations SET day = '$day_form', room = '$auditory_form', 
                            start_time = '$start_consultations_form', finish_time = '$end_consultations_form'
                            WHERE id = '$fourth_consultation_id'");

                            array_push($consultation_arr, $fourth_consultation_id);

                        }
                        else {
                            
                            $link -> query("INSERT INTO consultations (day, room, start_time, finish_time) 
                            VALUES ('$day_form', '$auditory_form', '$start_consultations_form', '$end_consultations_form')");

                            array_push($consultation_arr, $link->insert_id);

                        }

                    }
                    else {

                        $sql = mysqli_query($link, "DELETE FROM consultations WHERE id = '$fourth_consultation_id'");

                    }

                    if(!empty($_POST['day5'] && $_POST['auditory5'] && $_POST['start_consultations5'] && $_POST['end_consultations5'])){

                        $day_form = $_POST['day5'];

                        $auditory_form = $_POST['auditory5'];

                        $start_consultations_form = $_POST['start_consultations5'];

                        $end_consultations_form = $_POST['end_consultations5'];

                        if(!empty($fifth_consultation_id)) {

                            $link -> query("UPDATE consultations SET day = '$day_form', room = '$auditory_form', 
                            start_time = '$start_consultations_form', finish_time = '$end_consultations_form'
                            WHERE id = '$fifth_consultation_id'");

                            array_push($consultation_arr, $fifth_consultation_id);

                        }
                        else {
                            
                            $link -> query("INSERT INTO consultations (day, room, start_time, finish_time) 
                            VALUES ('$day_form', '$auditory_form', '$start_consultations_form', '$end_consultations_form')");

                            array_push($consultation_arr, $link->insert_id);

                        }

                    }
                    else {

                        $sql = mysqli_query($link, "DELETE FROM consultations WHERE id = '$fifth_consultation_id'");

                    }

                    $temp_arr = implode(" ", $consultation_arr);

                    $link -> query("UPDATE professors SET last_name = '$last_name_form', first_name = '$first_name_form', patronymic = '$patronymic_form', description = '$description_form',
                    photo_name = '$upload_image', degree = '$degree_form', seq_consultations = '$temp_arr' WHERE id = '$professor_id'");

                    header("Location: http://ics.odessa.ua/page-all-professor.php");
                    
                    exit;

                }

                ?>

            </form>

        </div>

        <script>

        function checkmyform(mythis, event) {
    
            var start_consultations1 = document.getElementById('start_consultations1').value;

            var end_consultations1 = document.getElementById('end_consultations1').value;

            var start_consultations2 = document.getElementById('start_consultations2').value;

            var end_consultations2 = document.getElementById('end_consultations2').value;

            var start_consultations3 = document.getElementById('start_consultations3').value;

            var end_consultations3 = document.getElementById('end_consultations3').value;

            var start_consultations4 = document.getElementById('start_consultations4').value;

            var end_consultations4 = document.getElementById('end_consultations4').value;

            var start_consultations5 = document.getElementById('start_consultations5').value;

            var end_consultations5 = document.getElementById('end_consultations5').value;

            var flag = true;

            if(start_consultations1.toLocaleString().length != 0 && end_consultations1.toLocaleString().length != 0) {
                
                if (start_consultations1.toLocaleString() < end_consultations1.toLocaleString()) {

                    flag = true;

                }

                else {

                    flag = false;

                    alert("Введенный промежуток времени в консультации № 1 - неверный.");

                }

            }

            if(start_consultations2.toLocaleString().length != 0 && end_consultations2.toLocaleString().length != 0) {

                if (start_consultations2.toLocaleString() < end_consultations2.toLocaleString()) {

                    flag = true;

                }

                else {

                    flag = false;

                    alert("Введенный промежуток времени в консультации № 2 - неверный.");

                }

            }

            if(start_consultations3.toLocaleString().length != 0 && end_consultations3.toLocaleString().length != 0) {

                if (start_consultations3.toLocaleString() < end_consultations3.toLocaleString()) {

                    flag = true;

                }

                else {

                    flag = false;

                    alert("Введенный промежуток времени в консультации № 3 - неверный.");

                }

            }

            if(start_consultations4.toLocaleString().length != 0 && end_consultations4.toLocaleString().length != 0) {

                if (start_consultations4.toLocaleString() < end_consultations4.toLocaleString()) {

                    flag = true;

                }

                else {

                    flag = false;

                    alert("Введенный промежуток времени в консультации № 4 - неверный.");

                }

            }

            if(start_consultations5.toLocaleString().length != 0 && end_consultations5.toLocaleString().length != 0) {

                if (start_consultations5.toLocaleString() < end_consultations5.toLocaleString()) {

                    flag = true;

                }

                else {

                    flag = false;

                    alert("Введенный промежуток времени в консультации № 5 - неверный.");

                }

            }

            var auditory_flag1 = true;

            let regexp = new RegExp("[^А-яЁё]");

            if (auditory1.value.length > 0) {

                var f1 = Number(auditory1.value[0]);

                var f2 = Number(auditory1.value[1]);

                var f3 = Number(auditory1.value[2]);

                if (auditory1.value.length != 4) {

                    if (auditory1.value.length != 3) {

                        alert('Количество символов в аудитории консультации № 1 дожно быть 3 или 4. Пример: 707 | 707ф');

                        auditory_flag1 =  false;

                    }

                    else {

                        if (Number.isInteger(f1) == true && Number.isInteger(f2) == true && Number.isInteger(f3) == true) {

                            auditory_flag1 = true;

                        }

                        else {

                            alert('Неверный формат аудитории в консультации № 1. Пример: 707');

                            auditory_flag1 = false;

                        }

                    }

                }

                else {

                    if(auditory1.value[0] == '0' || auditory1.value[2] == '0'){

                        alert('Неверный формат аудитории в консультации № 1. Пример: 707ф');

                        auditory_flag1 = false;

                    }

                    else {

                        var s_prim = auditory1.value[3];

                        if(regexp.test(s_prim)){

                            alert('Неверный формат аудитории в консультации № 1. Пример: 707ф');

                            auditory_flag1 = false;

                        }

                        else {

                            if (Number.isInteger(f1) == true && Number.isInteger(f2) == true && Number.isInteger(f3) == true) {

                                auditory_flag1 = true;

                            }

                            else {

                                alert('Неверный формат аудитории в консультации № 1. Пример: 707ф');

                                auditory_flag1 = false;

                            }

                        }

                    }

                }

            }

            var auditory_flag2 = true;

            if (auditory2.value.length > 0) {

                var f1 = Number(auditory2.value[0]);

                var f2 = Number(auditory2.value[1]);

                var f3 = Number(auditory2.value[2]);

                if (auditory2.value.length != 4) {

                    if (auditory2.value.length != 3) {

                        alert('Количество символов в аудитории консультации № 2 дожно быть 3 или 4. Пример: 707 | 707ф');

                        auditory_flag2 =  false;

                    }

                    else {

                        if (Number.isInteger(f1) == true && Number.isInteger(f2) == true && Number.isInteger(f3) == true) {

                            auditory_flag2 = true;

                        }

                        else {

                            alert('Неверный формат аудитории в консультации № 2. Пример: 707');

                            auditory_flag2 = false;

                        }

                    }

                }

                else {

                    if(auditory2.value[0] == '0' || auditory2.value[2] == '0'){

                        alert('Неверный формат аудитории в консультации № 2. Пример: 707ф');

                        auditory_flag2 = false;

                    }

                    else {

                        var s_prim = auditory2.value[3];

                        if(regexp.test(s_prim)){

                            alert('Неверный формат аудитории в консультации № 2. Пример: 707ф');

                            auditory_flag2 = false;

                        }

                        else {

                            if (Number.isInteger(f1) == true && Number.isInteger(f2) == true && Number.isInteger(f3) == true) {

                                auditory_flag2 = true;

                            }

                            else {

                                alert('Неверный формат аудитории в консультации № 2. Пример: 707ф');

                                auditory_flag2 = false;

                            }

                        }

                    }

                }

            }

            var auditory_flag3 = true;

            if (auditory3.value.length > 0) {

                var f1 = Number(auditory3.value[0]);

                var f2 = Number(auditory3.value[1]);

                var f3 = Number(auditory3.value[2]);

                if (auditory3.value.length != 4) {

                    if (auditory3.value.length != 3) {

                        alert('Количество символов в аудитории консультации № 3 дожно быть 3 или 4. Пример: 707 | 707ф');

                        auditory_flag3 =  false;

                    }

                    else {

                        if (Number.isInteger(f1) == true && Number.isInteger(f2) == true && Number.isInteger(f3) == true) {

                            auditory_flag3 = true;

                        }

                        else {

                            alert('Неверный формат аудитории в консультации № 3. Пример: 707');

                            auditory_flag3 = false;

                        }

                    }

                }

                else {

                    if(auditory3.value[0] == '0' || auditory3.value[2] == '0'){

                        alert('Неверный формат аудитории в консультации № 3. Пример: 707ф');

                        auditory_flag3 = false;

                    }

                    else {

                        var s_prim = auditory3.value[3];

                        if(regexp.test(s_prim)){

                            alert('Неверный формат аудитории в консультации № 3. Пример: 707ф');

                            auditory_flag3 = false;

                        }

                        else {

                            if (Number.isInteger(f1) == true && Number.isInteger(f2) == true && Number.isInteger(f3) == true) {

                                auditory_flag3 = true;

                            }

                            else {

                                alert('Неверный формат аудитории в консультации № 3. Пример: 707ф');

                                auditory_flag3 = false;

                            }

                        }

                    }

                }

            }

            var auditory_flag4 = true;

            if (auditory4.value.length > 0) {

                var f1 = Number(auditory4.value[0]);

                var f2 = Number(auditory4.value[1]);

                var f3 = Number(auditory4.value[2]);

                if (auditory4.value.length != 4) {

                    if (auditory4.value.length != 3) {

                        alert('Количество символов в аудитории консультации № 4 дожно быть 3 или 4. Пример: 707 | 707ф');

                        auditory_flag4 =  false;

                    }

                    else {

                        if (Number.isInteger(f1) == true && Number.isInteger(f2) == true && Number.isInteger(f3) == true) {

                            auditory_flag4 = true;

                        }

                        else {

                            alert('Неверный формат аудитории в консультации № 4. Пример: 707');

                            auditory_flag4 = false;

                        }

                    }

                }

                else {

                    if(auditory4.value[0] == '0' || auditory4.value[2] == '0'){

                        alert('Неверный формат аудитории в консультации № 4. Пример: 707ф');

                        auditory_flag4 = false;

                    }

                    else {

                        var s_prim = auditory4.value[3];

                        if(regexp.test(s_prim)){

                            alert('Неверный формат аудитории в консультации № 4. Пример: 707ф');

                            auditory_flag4 = false;

                        }

                        else {

                            if (Number.isInteger(f1) == true && Number.isInteger(f2) == true && Number.isInteger(f3) == true) {

                                auditory_flag4 = true;

                            }

                            else {

                                alert('Неверный формат аудитории в консультации № 4. Пример: 707ф');

                                auditory_flag4 = false;

                            }

                        }

                    }

                }

            }

            var auditory_flag5 = true;

            if (auditory5.value.length > 0) {

                var f1 = Number(auditory5.value[0]);

                var f2 = Number(auditory5.value[1]);

                var f3 = Number(auditory5.value[2]);

                if (auditory5.value.length != 4) {

                    if (auditory5.value.length != 3) {

                        alert('Количество символов в аудитории консультации № 5 дожно быть 3 или 4. Пример: 707 | 707ф');

                        auditory_flag5 =  false;

                    }

                    else {

                        if (Number.isInteger(f1) == true && Number.isInteger(f2) == true && Number.isInteger(f3) == true) {

                            auditory_flag5 = true;

                        }

                        else {

                            alert('Неверный формат аудитории в консультации № 5. Пример: 707');

                            auditory_flag5 = false;

                        }

                    }

                }

                else {

                    if(auditory5.value[0] == '0' || auditory5.value[2] == '0'){

                        alert('Неверный формат аудитории в консультации № 5. Пример: 707ф');

                        auditory_flag5 = false;

                    }

                    else {

                        var s_prim = auditory5.value[3];

                        if(regexp.test(s_prim)){

                            alert('Неверный формат аудитории в консультации № 5. Пример: 707ф');

                            auditory_flag5 = false;

                        }

                        else {

                            if (Number.isInteger(f1) == true && Number.isInteger(f2) == true && Number.isInteger(f3) == true) {

                                auditory_flag5 = true;

                            }

                            else {

                                alert('Неверный формат аудитории в консультации № 5. Пример: 707ф');

                                auditory_flag5 = false;

                            }

                        }

                    }

                }

            }

            var flag_for_first_file = false;

            var file1 = document.getElementById("customFile1").files[0];

            if (file1 != undefined){

                parts1 = file1.name.split('.');

                if (parts1.length > 1) {

                    ext1 = parts1.pop();

                }

                if (ext1 == 'jpg' || ext1 == 'png' || ext1 == 'jpeg') {

                    flag_for_first_file = true;

                    if (file1.size < 5242880) {

                        flag_for_first_file = true;

                    }

                    else {

                        flag_for_first_file = false;

                        alert("Недопустимый размер изображения. Максимальный размер изображения 5мб.");

                    }

                }

                else {

                    flag_for_first_file = false;

                    alert("Неверный тип картинки. Попробуйте jpg, jpeg или png.");

                }

            } else {
                
                flag_for_first_file = true;
                
            }


            if (flag == true && auditory_flag1 == true && auditory_flag2 == true && auditory_flag3 == true && auditory_flag4 == true && auditory_flag5 == true && flag_for_first_file == true) {

                alert('Преподователь успешно добавлен, вы будете перенаправлены на страницу Преподаватели');

                mythis.submit();

            }

            else {

                event.preventDefault();
                
            }

        }

        </script>
        
    </main>

    <?php include 'footer-admin.php'; ?>