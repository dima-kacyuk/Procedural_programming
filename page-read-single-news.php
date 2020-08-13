<?php

	include_once 'database.php';
	include_once 'functions.php';

 ?>

<?php include 'header.php'; ?>

    <main>

	    <div class="container">

            <?php 

            $id_news = $_GET["id_news"];

            $sql = mysqli_query($link, "SELECT * FROM `newstable` WHERE id = '$id_news'");

            $result = mysqli_fetch_array($sql); 

                $show_img = base64_encode($result['image']);

                if(!empty($result['image'])){

                    echo"<img src="."upload-images/".$result['image']."  height=100>";

                }

                 else {

                    echo "Картинка <br>отсутствует";

                }

                echo "{$result['title']}<br>";

                echo '<div class="ops">';

                echo "{$result['description']}";

                echo '</div><br>';

                if(!empty($result['link'])){

                    echo 'Ссылка: <a href="'.$result['link'].'" target="_blank"> Ссылка </a><br>';

                }

                else {

                    echo "Ссылка отсутствует<br>";

                }

                if(!empty($result['file'])){

                    echo 'Файл: <a href="upload-files/'.$result['file'].'" download>Скачать</a> <br>';

                }

                else {

                    echo "Файл отсутствует<br>";

                }

                $news_date = $result['date'];

                $temp_date = strtotime($news_date);

                $date_format = date("d-m-Y H:i", $temp_date);

                echo "Дата: $date_format";


                if(!empty($result['author'])){

                    echo "Автор: {$result['author']}";

                }

                else {

                    echo "Автор отсутствует";

                }


            ?>
                

        </div>

    </main>