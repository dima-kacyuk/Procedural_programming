<?php

	include_once 'database.php';
    include_once 'functions.php';

?>

<?php include 'header-admin.php'; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://localhost/ics.odessa/JS/all_news.js"></script>

    <main>

      <!-- <link rel="stylesheet" href="http://ics.odessa.ua/Local CSS/all_news.css"> -->

      <link rel="stylesheet" href="style.css">

        <div class="container">

            <div class="d-flex justify-content-between" style="margin-top: 20px;">

                <div class="d-flex justify-content-around">

                <div style="margin-right: 15px;">

                    <h3>Все новости</h3>

                </div>

                <div>

                    <a href="http://ics.odessa.ua/page-add-news.php"><input class="btn btn-outline-primary" type="button" value="Добавить новость" /></a>

                </div>

                </div>

                <div class="d-flex justify-content-around">

                <div style="margin-right: 15px;">

                    <h3>Поиск</h3>

                </div>

                <div>

		              <input class="form-control" type="text" size="40" name="news_search" id="news_search" placeholder="Введите фрагмент названия новости" autocomplete="off">

                  <p id="news-search-info"></p>

                </div>

                </div>

            </div>

        <hr>


        <div id="view_news">
        </div>


        </div>

</main>

<?php include 'footer-admin.php'; ?>