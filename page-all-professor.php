<?php

  include_once 'database.php';
    include_once 'functions.php';

?>

<?php include 'header-admin.php'; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://localhost/ics.odessa/JS/all_professors.js"></script>

    <main>

      <link rel="stylesheet" href="http://localhost/ics.odessa/Local CSS/all_professors.css">

      <link rel="stylesheet" href="style.css">

        <div class="container">

            <div class="d-flex justify-content-between" style="margin-top: 20px;">

                <div class="d-flex justify-content-around">

                <div style="margin-right: 15px;">

                    <h3>Все преподаватели</h3>

                </div>

                <div>

                    <a href="http://localhost/ics.odessa/page-add-professor.php"><input class="btn btn-outline-primary" type="button" value="Добавить преподавателя" /></a>

                </div>

                </div>

                <div class="d-flex justify-content-around">

                <div style="margin-right: 15px;">

                    <h3>Поиск</h3>

                </div>

                <div>

                  <input class="form-control" type="text" size="40" name="professor_search" id="professor_search" placeholder="Введите фрагмент имени преподавателя" autocomplete="off">

                  <p id="professors-search-info"></p>

                </div>

                </div>

            </div>

        <hr>


        <div id="view_professors">
        </div>


        </div>

</main>