<?php

	include_once 'database.php';
	include_once 'functions.php';

 ?>

<?php include 'header-admin.php'; ?>

    <main>

	    <div class="container">
            <div class="centerdiv">
                <h1>Редактирование новости</h1>
            </div>

                <?php 

                $id_news = $_GET["id_news"];

                $sql = mysqli_query($link, "SELECT * FROM `newstable` WHERE id = '$id_news'");

                $result = mysqli_fetch_array($sql);              

                ?>
                <form id="addform" action="" method="post" enctype="multipart/form-data" onsubmit="checkmyform(this, event)">

                <p><input type="text" class="form-control" name="title" required placeholder="Заголовок новости *" autocomplete="off" value="<?php echo $result['title']?>"/></p>
                <p>
                <textarea style="height:300px;" class="form-control" name="description" required placeholder="Описание новости *" autocomplete="off"><?php echo $result['description'];?></textarea>
                </p>
                <p><input type="text" class="form-control" placeholder="Ссылка" autocomplete="off" name="link" value="<?php echo $result['link']?>"/></p>
                <p><input type="text" class="form-control" pattern="^[А-Яа-яЁё\s.]+$" size="40" maxlength="40" placeholder="Автор статьи" autocomplete="off" name="author" value="<?php echo $result['author']?>"/></p>

                <p>
                <?php

                    if(!empty($result['image'])){

                        echo"<img src="."upload-images/".$result['image']."  height=100>";

                    }

                    else {

                        echo "Картинка <br>отсутствует";

                    }
                    
                ?>
                <div class="custom-file">
                    <input type="file" accept="image/*" name="img_upload" class="custom-file-input" id="customFile1">
                    <label class="custom-file-label" for="customFile">Добавить новое фото</label>
                </div>
                </p>
                
                <p>
                    <input type="button" id="clearButton1" class="btn btn-outline-primary btn-sm" value="Очистить поле файлов">
                </p>

                <script>

                        document.getElementById('clearButton1').addEventListener('click',function(e){

                            var temp = document.getElementById("customFile1");

                            temp.value = '';

                            var nextSibling = temp.nextElementSibling;

                            nextSibling.innerText = 'Выберете файл(ы)';
                        
                        });

                </script>

                <p>
                <?php
                if(!empty($result['file'])){

                        echo 'Файл: <a href="upload-files/'.$result['file'].'" download>Скачать</a> <br>';

                    }

                    else {

                        echo "Файл отсутствует<br>";

                    }
                ?>
                <div class="custom-file">
                    <input type="file" accept="application/pdf" multiple name="file_upload" class="custom-file-input" id="customFile2">
                    <label class="custom-file-label" for="customFile">Добавить новый файл</label>
                </div>
                </p>

                <p>
                    <input type="button" id="clearButton2" class="btn btn-outline-primary btn-sm" value="Очистить поле файлов">
                </p>

                <script>

                        document.getElementById('clearButton2').addEventListener('click',function(e){

                            var temp = document.getElementById("customFile2");

                            temp.value = '';

                            var nextSibling = temp.nextElementSibling;

                            nextSibling.innerText = 'Выберете файл(ы)';
                        
                        });

                </script>

                <script type="application/javascript">

                    document.getElementById('customFile1').addEventListener('change',function(e){
                        var fileName = document.getElementById("customFile1").files[0].name;
                        var nextSibling = e.target.nextElementSibling
                        nextSibling.innerText = fileName
                    });

                    document.getElementById('customFile2').addEventListener('change',function(e){

                        files = this.files;

                        var filesArr = [];

                        for( var i = 0; i < files.length; i++) {

                            var fileName = document.getElementById("customFile2").files[i].name;
                            
                            filesArr.push(files[i].name);

                        }
                        var nextSibling = e.target.nextElementSibling
                        nextSibling.innerText = filesArr

                    });

                </script>

                <p>Дата публикации: <?php echo $result['date'];?> Сделать снова активной - <input type="checkbox" name="active"></p>

                <?php 

                    $findme1 = '1';

                    $findme2 = '2';

                    $findme3 = '3';

                    $temp_audience_result = $result['tag'];

                    $audience1 = stripos($temp_audience_result, $findme1);

                    $audience2 = stripos($temp_audience_result, $findme2);

                    $audience3 = stripos($temp_audience_result, $findme3);

                ?>
                <p>
                    <input type="checkbox" name="option[]" value="1" id="ab" <?php if ($audience1 !== false) { echo 'checked'; } ?>>Абитуриентам
                    <input type="checkbox" name="option[]" value="2" id="st" <?php if ($audience2 !== false) { echo 'checked'; } ?>>Студентам
                    <input type="checkbox" name="option[]" value="3" id="vp" <?php if ($audience3 !== false) { echo 'checked'; } ?>>Выпускникам
                </p>
                <?php 

                    $findtag1 = '1';

                    $findtag2 = '2';

                    $findtag3 = '3';

                    $findtag4 = '4';

                    $findtag5 = '5';

                    $temp_tags_result = $result['cat'];

                    $tag1 = stripos($temp_tags_result, $findtag1);

                    $tag2 = stripos($temp_tags_result, $findtag2);

                    $tag3 = stripos($temp_tags_result, $findtag3);

                    $tag4 = stripos($temp_tags_result, $findtag4);

                    $tag5 = stripos($temp_tags_result, $findtag5);

                ?>
                <p>
                    <input type="checkbox" name="cat[]" value="1" id="t1" <?php if ($tag1 !== false) { echo 'checked'; } ?>>Тег1
                    <input type="checkbox" name="cat[]" value="2" id="t2" <?php if ($tag2 !== false) { echo 'checked'; } ?>>Тег2
                    <input type="checkbox" name="cat[]" value="3" id="t3" <?php if ($tag3 !== false) { echo 'checked'; } ?>>Тег3
                    <input type="checkbox" name="cat[]" value="4" id="t4" <?php if ($tag4 !== false) { echo 'checked'; } ?>>Тег4
                    <input type="checkbox" name="cat[]" value="5" id="t5" <?php if ($tag5 !== false) { echo 'checked'; } ?>>Тег5
                </p>
                <div class="centerdiv">
                <input name="add_button" class="btn btn-outline-primary" type="submit" value="Редактировать новость" />

                <a href="http://ics.odessa.ua/page-all-news.php"><input type="button" class="btn btn-outline-primary" value="Назад"></a>
                
                </div>
                

                <?php

                if(isset($_POST['add_button'])) {

                    $title_form = $_POST['title'];

                    $description_form = $_POST['description'];

                    $author_form = $_POST['author'];

                    if($_POST['active']) {

                        $time = date_default_timezone_set("Europe/Kiev");

                        $time_res = time();

                        $date_form = date("Y-m-d H:i", $time_res);

                    }
                    else {

                        $date_form = $result['date'];
                        
                    }

                    if(!empty($result['image'])){

                        $upload_image = $result['image'];

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

                    if(!empty($result['file'])){

                        $upload_file = $result['file'];

                    }

                    else {

                        $upload_files_array = array();

                        if(!empty($_FILES["file_upload"])) {

                            $countfiles = count($_FILES['file_upload']['name']);

                            for($i = 0; $i < $countfiles; $i++){

                                $filename = $_FILES['file_upload']['name'][$i];
                           
                                move_uploaded_file($_FILES['file_upload']['tmp_name'][$i],'upload-files/'.$filename);

                                $temp_file_name = $_FILES['file_upload']['name'][$i];

                                array_push($upload_files_array, $temp_file_name);
                           
                            }

                        }

                        else {

                            $upload_files_array = '';

                        }

                    }
                    
                    if(!empty($_POST['link'])) {

                        $findme    = 'http';

                        $mystring1 = $_POST['link'];

                        $pos1 = stripos($mystring1, $findme);

                        if($pos1 !== false) {

                            $link_form = $_POST['link'];

                        } 

                        else {

                            $addhttp = 'https://';

                            $link_form = $addhttp.''.$_POST['link'];

                        }

                    }

                    else {

                        $link_form = '';

                    }

                    $tag_form = implode(" ", $_POST['option']);

                    $cat_form = implode(" ", $_POST['cat']);

                    $temp_arr = implode(" ", $upload_files_array);

                    // $link -> query("UPDATE newstable SET title = '$title_form', description = '$description_form', author = '$author_form', date = '$date_form',
                    // image = '$img', file = '$file_form', link = '$link_form', tag = '$tag_form', cat = '$cat_form' WHERE id = '$id_news'");
                    //title, description, author, date, image, file, link, tag, cat 
                    $link -> query("UPDATE newstable SET title = '$title_form', description = '$description_form', author = '$author_form', date = '$date_form',
                    image = '$upload_image', file = '$temp_arr', link = '$link_form', tag = '$tag_form', cat = '$cat_form' WHERE id = '$id_news'");

                    header("Location: http://ics.odessa.ua/page-all-news.php");
                    
                    exit;

                }

                ?>

            </form>

        </div>

        <script>

        function checkmyform(mythis, event) {

            var flag = false;

            if ((ab.checked || st.checked || vp.checked) && (t1.checked || t2.checked || t3.checked || t4.checked || t5.checked))
            {

                flag = true;

            }

            else {

                flag = false;

                alert("Нужно отметить хотя бы 1 аудиторию и 1 тег.");

            }

            var flag_for_first_file = false;

            var file1 = document.getElementById("customFile1").files[0];

            if (file1 != undefined && file2 != null){

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

            var flag_for_second_file = false;

            var filesArray = document.getElementById("customFile2").files;

            if(filesArray.length < 11) {

                for( var i = 0; i < filesArray.length; i++) {

                    var file2 = filesArray[i].name;

                    if (file2 != undefined && file2 != null){

                    parts2 = file2.split('.');

                    if (parts2.length > 1) {

                        ext2 = parts2.pop();

                    }

                    if (ext2 == 'pdf') {

                        flag_for_second_file = true;

                        if (filesArray[i].size < 5242880) {

                            flag_for_second_file = true;

                        }

                        else {

                            flag_for_second_file = false;

                            alert("Недопустимый размер файла. Максимальный размер файла 5мб.");

                            break;

                        }

                    }

                    else {

                        flag_for_second_file = false;

                        alert("Неверный тип файла. Попробуйте pdf.");

                        break;

                    }

                    } else {
                
                        flag_for_second_file = true;
                
                    }
                            
                }

            } else {

                flag_for_second_file = false;

                alert("Максимально количество файлов - 10.");
                
            }

            if(flag == true && flag_for_first_file == true && flag_for_second_file == true) {

                alert('Запись успешно добавлена, вы будете перенаправлены на страницу Новости.');

                mythis.submit();

            }

            else {

                event.preventDefault();

            }

        }

        </script>

    </main>

    <?php include 'footer-admin.php'; ?>
