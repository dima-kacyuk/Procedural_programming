<?php

	include_once 'database.php';
	include_once 'functions.php';

 ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<?php include 'header-admin.php'; ?>

    <main>
    <div class="container">
            <div class="centerdiv">
            <h1>Добавить новость</h1>
            </div>
            
            
            <form id="addform" action="" method="post" enctype="multipart/form-data" onsubmit="checkmyform(this, event)">

                <p><input type="text" class="form-control" name="title" required placeholder="Заголовок новости *" autocomplete="off"/></p>
                <p>
                <textarea style="height:300px;" class="form-control" name="description" required placeholder="Описание новости *" autocomplete="off"></textarea>
                </p>
                <p><input type="text" class="form-control" name="link" placeholder="Ссылка" autocomplete="off"/></p>
                <p><input type="text" size="40" maxlength="40" pattern="^[А-Яа-яЁё\s.]+$" class="form-control" id="author" name="author" placeholder="Автор статьи" autocomplete="off"/></p>

                <!-- <script type="text/javascript">

                            var specificAllowedSymbols = "#%";

                            $('#author').alphanum({

                                allow: ".АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя",
                                allowSpace: false,
                                allowOtherCharSets: false

                            });
                            
                </script> -->
                
                <p>
                <div class="custom-file">
                    <input type="file" accept="image/*" name="img_upload" class="custom-file-input" id="customFile1">
                    <label class="custom-file-label" for="customFile">Выберете фото</label>
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

                <!-- <p>
                <div class="custom-file">
                    <input type="file" accept="application/pdf" multiple name="file_upload[]" class="custom-file-input" id="customFile2">
                    <label class="custom-file-label" for="customFile">Выберете файл(ы)</label>
                </div>
                </p>

                <p>
                    <input type="button" id="clearButton2" class="btn btn-outline-primary btn-sm" value="Очистить поле файлов">
                </p> -->

                <input id="uploadFile" style="visibility:hidden;" placeholder="Add files from My Computer"/>

                <div class="display_flex_start">
                        
                <div id="upload_prev"></div>

                <div class="fileUpload btn btn-outline-primary btn-sm">

                    Выбрать файлы<input id="uploadBtn" type="file" class="upload" multiple name="browsefile[]" value="Открыть проводник"/>
                        
                </div>

                </div>

                <script>

                $(document).on('click','.close',function(){
                	$(this).parents('span').remove();
                    
                })

                function removeFilea(myThis) {

                    alert(123);

                    var files = $('#uploadBtn')[0].files;

                    console.log(files);

                    var newFileList = Array.from(files);

                    newFileList.splice(1,1);

                    console.log(files);

                }

                document.getElementById('uploadBtn').onchange = uploadOnChange;

                function uploadOnChange() {
                    document.getElementById("uploadFile").value = this.value;
                    var filename = this.value;
                    var lastIndex = filename.lastIndexOf("\\");
                    if (lastIndex >= 0) {
                        filename = filename.substring(lastIndex + 1);
                    }
                    var files = $('#uploadBtn')[0].files;
                    for (var i = 0; i < files.length; i++) {
                     $("#upload_prev").append('<span>'+'<div class="filenameupload" name="filenameupload">'+files[i].name+'</div>'+'<p onclick="removeFilea(this)" class="close" >&times;</p></span>');
                    }
                    document.getElementById('filename').value = filename;
                }

                </script>

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

                    // document.querySelector('#customFile2').onchange = function(e) {
                    //    files = this.files;
                    // for(var a=0;a<files.length;a++)
                    // alert(files[a].name);}


                    document.getElementById('customFile2').addEventListener('change',function(e){

                        files = this.files;

                        var filesArr = [];

                        for( var i = 0; i < files.length; i++) {

                            var fileName = document.getElementById("customFile2").files[i].name;
                            
                            filesArr.push(files[i].name);

                            //console.log(filesArr);

                        }
                        var nextSibling = e.target.nextElementSibling
                        nextSibling.innerText = filesArr

                        
                    });

                </script>

                <link rel="stylesheet" href="https://snipp.ru/cdn/jqueryui/1.12.1/jquery-ui.min.css">

                <link rel="stylesheet" href="https://snipp.ru/cdn/jQuery-Timepicker-Addon/dist/jquery-ui-timepicker-addon.min.css">

                <style type="text/css">

                #datepicker {
	                width: 266px;
	                display: inline-block;
	                padding: 5px;
                }

                </style>

                <script src="https://snipp.ru/cdn/jquery/2.1.1/jquery.min.js"></script>

                <script src="https://snipp.ru/cdn/jqueryui/1.12.1/jquery-ui.min.js"></script>

                <script src="https://snipp.ru/cdn/jQuery-Timepicker-Addon/dist/jquery-ui-timepicker-addon.min.js"></script>

                <script>

                /* Локализация datepicker */
                $.datepicker.regional['ru'] = {
	                closeText: 'Закрыть',
	                prevText: 'Предыдущий',
	                nextText: 'Следующий',
	                currentText: 'Сегодня',
	                monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
	                monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
	                dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
	                dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
	                dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
	                weekHeader: 'Не',
	                dateFormat: 'yy-mm-dd',
	                firstDay: 1,
	                isRTL: false,
	                showMonthAfterYear: false,
	                yearSuffix: ''
                };

                /* Локализация timepicker */
                $.datepicker.setDefaults($.datepicker.regional['ru']);
                    $.timepicker.regional['ru'] = {
	                timeOnlyTitle: 'Выберите время',
	                timeText: 'Время',
	                hourText: 'Часы',
	                minuteText: 'Минуты',
	                secondText: 'Секунды',
	                millisecText: 'Миллисекунды',
	                timezoneText: 'Часовой пояс',
	                currentText: 'Сейчас',
	                closeText: 'Закрыть',
	                timeFormat: 'HH:mm',
	                amNames: ['AM', 'A'],
	                pmNames: ['PM', 'P'],
                    minDate: new Date(),
                    maxDate: "+10D",
	                isRTL: false
                };

                $.timepicker.setDefaults($.timepicker.regional['ru']);

                $(function(){
	                $("#datepicker").datetimepicker();
                    $("#datepicker").attr('autocomplete','off');
                    $("#datepicker").css({'z-index' : '1', 'position':'absolute'});
                });

                </script>

                <p><input type="text" class="form-control" id="datepicker" name="dateFrom" placeholder="Выберите дату и время *" required></p><br><br><br>
                <p>
                <input type="checkbox" name="option[]" value="1" id="ab">Абитуриентам
                <input type="checkbox" name="option[]" value="2" id="st">Студентам
                <input type="checkbox" name="option[]" value="3" id="vp">Выпускникам
                </p>
                <p>
                <input type="checkbox" name="cat[]" value="1" id="t1">Тег1
                <input type="checkbox" name="cat[]" value="2" id="t2">Тег2
                <input type="checkbox" name="cat[]" value="3" id="t3">Тег3
                <input type="checkbox" name="cat[]" value="4" id="t4">Тег4
                <input type="checkbox" name="cat[]" value="5" id="t5">Тег5
                </p>
                <div class="centerdiv">
                <input name="add_button" class="btn btn-outline-primary" type="submit" value="Опубликовать новость" />

                <a href="http://ics.odessa.ua/page-all-news.php"><input type="button" class="btn btn-outline-primary" value="Назад"></a>
                
                </div>
                <?php
                print_r($_FILES);
                if(isset($_POST['add_button'])) {

                    $title_form = $_POST['title'];

                    $description_form = $_POST['description'];

                    $author_form = $_POST['author'];

                    if(!empty($_POST['dateFrom'])) {

                        //$date_form = strtotime($_POST['dateFrom']);
                        $date = $_POST['dateFrom'];
                        $d1 = strtotime($date); // переводит из строки в дату
                        $date_form  = date("Y-m-d H:i", $d1); // переводит в новый формат

                    }

                    else {

                        $date_form = date("Y-m-d H:i");

                    }
                    
                    if(!empty($_FILES["img_upload"])) {

                        $upload_image=$_FILES["img_upload"]["name"];

                        $folder="upload-images/";

                        $upload_name = $folder.$upload_image;

                        move_uploaded_file($_FILES["img_upload"]["tmp_name"],"$folder".$_FILES["img_upload"]["name"]);

                    }

                    else {

                        $upload_image = '';

                    }

                    $upload_files_array = array();

                    if(!empty($_FILES["browsefile"])) {

                        print_r($_FILES['browsefile']);

                        exit;

                        $countfiles = count($_FILES['browsefile']['name']);

                        for($i = 0; $i < $countfiles; $i++){

                            $filename = $_FILES['browsefile']['name'][$i];
                           
                            move_uploaded_file($_FILES['browsefile']['tmp_name'][$i],'upload-files/'.$filename);

                            $temp_file_name = $_FILES['browsefile']['name'][$i];

                            array_push($upload_files_array, $temp_file_name);
                           
                        }

                    }

                    else {

                        $upload_files_array = '';

                    }

                    if(!empty($_POST['link'])) {

                        $findme = 'http';

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

                    //title, description, author, date, image, file, link, tag, cat 
                    $link -> query("INSERT INTO newstable (title, description, author, date, image, file, link, tag, cat) 
                    VALUES ('$title_form', '$description_form', '$author_form', '$date_form', '$upload_image', '$temp_arr', '$link_form', '$tag_form', '$cat_form')");

                    header("Location: http://ics.odessa.ua/page-all-news.php");
                    
                    exit;

                }

                ?>

            </form>

        <script>

        function checkmyform(mythis, event) {

            event.preventDefault();

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

            var flag_for_second_file = true;

            // var filesArray = document.getElementById("customFile2").files;

            // if(filesArray.length < 11) {

            //     for( var i = 0; i < filesArray.length; i++) {

            //         var file2 = filesArray[i].name;

            //         if (file2 != undefined && file2 != null){

            //         parts2 = file2.split('.');

            //         if (parts2.length > 1) {

            //             ext2 = parts2.pop();

            //         }

            //         if (ext2 == 'pdf') {

            //             flag_for_second_file = true;

            //             if (filesArray[i].size < 5242880) {

            //                 flag_for_second_file = true;

            //             }

            //             else {

            //                 flag_for_second_file = false;

            //                 alert("Недопустимый размер файла. Максимальный размер файла 5мб.");

            //                 break;

            //             }

            //         }

            //         else {

            //             flag_for_second_file = false;

            //             alert("Неверный тип файла. Попробуйте pdf.");

            //             break;

            //         }

            //         } else {
                
            //             flag_for_second_file = true;
                
            //         }
                            
            //     }

            // } else {

            //     flag_for_second_file = false;

            //     alert("Максимально количество файлов - 10.");
                
            // }

            if(flag == true && flag_for_first_file == true && flag_for_second_file == true) {

                alert('Запись успешно добавлена, вы будете перенаправлены на страницу Новости.');

                mythis.submit();

            }

            else {

                event.preventDefault();

            }

        }

        </script>
        
    </div>
    </main>

    <?php include 'footer-admin.php'; ?>