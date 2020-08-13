<?php

include_once 'database.php';
include_once 'functions.php';

?>

<?php include 'qa-header.php'; ?>
<title>Студентам</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link href="dist/css/datepicker.css" rel="stylesheet" type="text/css">
<script src="dist/js/datepicker.min.js"></script>

<script src="http://ics.odessa.ua/JS/students.js"></script>

<main>

  <link rel="stylesheet" href="http://ics.odessa.ua/Local CSS/students.css">
  <div class="extra_menu">

    <div class="container">

      <ul class="extra_menu_ul">
        <li><a href="http://ics.odessa.ua/page-show-all-specialties.php">Специальности</a></li>
        <li><a href="">Самоуправление</a></li>
        <?php

          echo "<li><a href='http://ics.odessa.ua/page-";

          if(isset($_SESSION['userNameAndSurname']) || isset($_SESSION['companyName'])) {         

            if (isset($_SESSION['userNameAndSurname'])) {

              echo "user-private-office.php'>";     

          }

          else {

            echo "company-private-office.php'>";

          }

        }

      else {

        echo "authorization.php'>";

      }

      echo "Личный кабинет</a></li>"; 

      ?>
        <div class="dropdown">
          <button onclick="myFunction()" class="dropbtn">Фильтр</button>
          <div id="myDropdown" class="dropdown-content">
            <input type="checkbox" class="dropdown_content_checkbox">Наука<br>
            <input type="checkbox" class="dropdown_content_checkbox">Социальная культура<br>
            <input type="checkbox" class="dropdown_content_checkbox">Самоуправление<br>
            <input type="checkbox" class="dropdown_content_checkbox">Студенческая жизнь<br>
            <input type="checkbox" class="dropdown_content_checkbox">Прочие<br>
            <div class="dropdown_content_div_button">
              <input type="button" class="dropdown_content_button" value="Применить">
            </div>
          </div>
        </div>
      </ul>

    </div>

  </div>

  <script>

    function myFunction() {

      document.getElementById("myDropdown").classList.toggle("show");

    }

    window.onclick = function(event) {

      if (!event.target.matches('.dropbtn')) {

        if(!event.target.matches('.dropdown_content_checkbox') && !event.target.matches('.dropdown-content') && !event.target.matches('.dropdown_content_div_button')) {

          document.getElementById("myDropdown").classList.remove("show");

        }

      }

    }

  </script>

  <div class="container">

    <div class="modal_center">

      <div class="modal" id="modal">

        <p id="aco_info"></p>

      </div>

    </div>

  </div>

  <div class="container">

    <div class="div_audience">

      <h1 class="audience student_audience">Студентам</h1>

    </div>

    <div class="students_box">

      <div id="news_block">

                <!-- <div class="news_container student_news_box">

                    <div class="news_top">
                        <div>
                            <a href="#"><img src="img/logo-ics.png" alt="logo" class="news_image students_image"></a>
                        </div>
                        <div>
                            <a href="#"><p class="news_title students_news_title">Мала академія наук в ІКС ОНПУМала академія наук в ІКС ОНПУМала академія наук в ІКС ОНПУ</p></a>
                            <p class="news_description students_news_description">В ІКС ОНПУ систематично проводяться заходи в рамках співпраці з Одеським територіальним відділенням Малої академії наук (МАН). Черговий захід - обласна науково-практична конференція...В ІКС ОНПУ систематично проводяться заходи в рамках співпраці з Одеським територіальним відділенням Малої академії наук (МАН). Черговий захід - обласна науково-практична конференція...В ІКС ОНПУ систематично проводяться заходи в рамках співпраці з Одеським територіальним відділенням Малої академії наук (МАН). Черговий захід - обласна науково-практична конференція...В ІКС ОНПУ систематично проводяться заходи в рамках співпраці з Одеським територіальним відділенням Малої академії наук (МАН). Черговий захід - обласна науково-практична конференція...</p>
                        </div>
                    </div>
                    <div class="news_bottom">
                        <div class="news_date students_box_bottom students_news_font_size">22.10.19 14:30</div>
                        <div class="news_author students_news_font_size">Антощук С.Г.</div>
                        <a href="#"><div class="news_read">Читать</div></a>
                    </div>
            
                  </div> -->

                </div>

<!--             <div class="pagination">

              <ul>
                <li><a href="#" id="prev" class="prevnext">« Туда</a></li>
                <li><a href="#" id="next" class="prevnext">Сюда »</a></li>
              </ul>

              <br />

              <div id="page_number" class="page_number">1</div>

            </div> -->

            <div>

              <div id="control_panel" class="calendar_panel">

                <div class="current_week">

                  <p class="number">11</p>
                  <p class="text">Текущая неделя</p>

                </div>

                <div class="datepicker-here" id="datepicker"></div>

                <div id="stream_bar" class="calendar_select_flex">

                  <div id="year_block">
                    <select name="year_selection" id="year_selection" class="group_definers select-css">
                      <option name='year_option' value="0">Курс
                        <option name='year_option' value="1">1
                          <option name='year_option' value="2">2
                            <option name='year_option' value="3">3
                              <option name='year_option' value="4">4
                                <option name='year_option' value="5">5        
                                </select>
                              </div>

                              <div id="speciality_block">

                                <select name="speciality_selection" id="speciality_selection" class="group_definers select-css">  
                                </select>

                                <div></div>

                              </div>


                              <div id="group_block">
                                <select name="group_selection" id="group_selection" class="select-css">

                                  <option name='group_option' value="0">Группа

                                  </select>

                                  <div></div>

                                </div>

                              </div>

                              <div id="file-download-block" class="">

                               <div>
                                 <button class="calendar_button" id="btn-download-studies-shedule">Расписание занятий</button>
                                 <p id="download-studies-shedule-info" class="download_info"></p>
                               </div>
                               <div>
                                 <button class="calendar_button" id="btn-download-session-shedule">Расписание экзаменов</button>
                                 <p id="download-session-shedule-info" class="download_info"></p>
                               </div>
                               <div>
                                 <button class="calendar_button" id="btn-download-rating-list">Рейтинговые списки</button>
                                 <p id="download-rating-list-info" class="download_info"></p>
                               </div>

                             </div>

                             <div id="going-to-block">

                              <p>
                                <a href="http://ics.odessa.ua/page-professors.php"><button class="calendar_button">Преподаватели</button></a>
                              </p>
                              <p>
                                <a href="http://ics.odessa.ua/maps.php"><button class="calendar_button">Карта ОНПУ</button></a>
                              </p>

                            </div>

                          </div>

                        </div>

                      </div>

                    </div>

                    <script>

                      var modal = document.querySelector('.modal');

                      var overflow = document.createElement('div');

                      $(document).on('click', '.news_read', function() {

                        overflow.className = "overflow";

                        document.body.appendChild(overflow);

                        var height = modal.offsetHeight;

                        //modal.style.marginTop = - height / 2 + "px";

                        modal.style.top = "25%";

                      })

                      if (!Element.prototype.remove) {

                        Element.prototype.remove = function remove() {

                          if (this.parentNode) {

                            this.parentNode.removeChild(this);

                          }

                        };

                      }

                      overflow.onclick = function () {
                        modal.style.top = "-100%";
                        overflow.remove();
                      }

                    </script>

                  </main>

                  <?php include 'qa-footer.php'; ?>