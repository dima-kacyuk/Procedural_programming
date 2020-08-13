<?php

	include_once 'database.php';
	include_once 'functions.php';

 ?>

<?php include 'header-admin.php'; ?>

    <main>
	    <div class="content">

                <?php 

                $id_news = $_GET["id_news"];

                $link -> query("DELETE FROM newstable WHERE id = '$id_news'");

                echo '<script>
                    
                    alert("Запись с id '. $id_news .' успешно удалена, вы будете перенаправлены на страницу Новости");

                    location.href="http://ics.odessa.ua/page-all-news.php";

                    </script>';

                ?>

        </div>

<?php include 'footer.php'; ?>