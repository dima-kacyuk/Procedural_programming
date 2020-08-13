<?php

    include_once 'database.php';
    include_once 'functions.php';

 ?>

<?php include 'header.php'; ?>
<title>Все специальности</title>
<!-- <link rel="stylesheet" href="http://ics.odessa.ua/Local CSS/style_view_department.css" > -->
<link rel="stylesheet" href="http://ics.odessa.ua/Local CSS/style_view_department.css" >
    <main>
    <div class="container">
        
                <?php 

                $sql = mysqli_query($link, "SELECT * FROM `departments`");

                while ($result = mysqli_fetch_array($sql)) {
                 
                    echo "<div class = 'department_box'>";

                    echo "<div class='department_image'>";

                    echo "<div>";

                    if (empty($result['logo_name'])) {

                        echo "Логотип <br> отсутствует";
        
                    } else {
        
                        echo "<img class = 'logo_block' src='upload-images/department logos/" . $result['logo_name'] . "'  width=90 height=100>";
        
                    }

                    echo "</div>";

                    echo "</div>";

                    echo "<div>";
                    
                    echo "<p class='department_desc'><strong>Название кафедры:</strong> " . $result['name_specialty'] . " " . "(" . $result['code'] . ")" . "</p>" ; 

                    echo "<p class='department_desc'><strong>Код специальности:</strong> {$result['direction']}" . "</p>";

                    echo "<p class='department_desc'><strong>Направления подготовки:</strong> {$result['training_area']} " . "</p>";

                    echo "<p class='department_desc'><strong>Предметы:</strong> {$result['subject']} " . "</p>";

                    echo "<p class='department_desc'><strong>Профильные предметы:</strong> {$result['subject_area']} " . "</p>";

                    echo "<p class='department_desc'><strong>Возможное трудосустройство:</strong> {$result['work']} " . "</p>";

                    echo "<p class='department_desc'><strong> Сфера деятельности:</strong> {$result['sphere']} " . "</p>";
                    
                    echo '</div>';

                    echo '</div>';


                    // $edit_user_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 11 ");
                    // $result_edit_user = mysqli_fetch_array($edit_user_sql, MYSQLI_ASSOC); 
                    
                    // echo '<div class="d-flex justify-content-center">';
                    
                    // if ($result['id'] == $_SESSION['access_user_id'] ) {
                        
                    // }
                    // else{
                    //     if ($result_edit_user['access'] == 1 ) {
                       
                    //         //echo "<span class='indent'></span><a href='page-edit-department.php?id_department=" . $result['id'] . "&"."name_departments=". $result['name'] . "'><input type='button' class='btn btn-outline-primary' value='Редактировать'></a>";
        
                    //     }
                    
                    // $delete_user_sql = mysqli_query($link, "SELECT `access` FROM `roots$temp` WHERE id = 12 ");
                    // $result_delete_user = mysqli_fetch_array($delete_user_sql, MYSQLI_ASSOC); 
                    
                    //     if ($result_delete_user['access'] == 1 ) {
                       
                    //         echo '<div class = "delete_block">' ;

                    //         //echo "<span class='indent'></span><a href='page-delete-department.php?id_department=" . $result['id'] . "&"."name_departments=". $result['name'] .  "'><input type='button' class='btn btn-outline-primary' value='Удалить'></a>";

                    //         echo '</div>' ;
                       
                    //     }
                    // } 
                    
                   // echo '</div>' ;
                    
                }
                ?>
    </div>
            


</main>
<?php include 'footer.php'; ?>