<?php

	include_once 'database.php';
	include_once 'functions.php';

 ?>

<?php include 'header-admin.php'; ?>
    <main>
	    <div class="content">

                <?php

                $professor_id = $_GET["id_professor"];

                $sql = mysqli_query($link, "SELECT * FROM `professors` WHERE id = '$professor_id'");

                $result = mysqli_fetch_array($sql);

                $temp_consultations = explode(" ", $result['seq_consultations']);

                $consultations_counter = count($temp_consultations);

                for($i = 0; $i < $consultations_counter; $i++){
                        
                        $sql = mysqli_query($link, "DELETE FROM consultations WHERE id = '$temp_consultations[$i]'");

                }

                $link -> query("DELETE FROM professors WHERE id = '$professor_id'");

                echo '<script>
                    
                    alert("Запись с id '. $id_news .' успешно удалена, вы будете перенаправлены на страницу Новости");

                    location.href="http://ics.odessa.ua/page-all-professor.php";

                    </script>';

                ?>

        </div>

<?php include 'footer.php'; ?>