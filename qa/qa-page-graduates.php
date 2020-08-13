<?php

include_once 'database.php';
include_once 'functions.php';

?>

<?php include 'qa-header.php'; ?>
<title>Выпускникам</title>

<script src="http://ics.odessa.ua/JS/graduates.js"></script>


<main>

  <link rel="stylesheet" href="http://ics.odessa.ua/Local CSS/graduates.css">

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

    <div class="container" id="news-for-graduates-container">

    <div class="div_audience student_audience">

        <h1 class="audience">Выпускникам</h1>

    </div>

    </div>

<!--     <div class="pagination">

      <ul>
          <li><a href="#" id="prev" class="prevnext">« Туда</a></li>
          <li><a href="#" id="next" class="prevnext">Сюда »</a></li>
      </ul>

      <br />

      <div id="page_number" class="page_number">1</div>

    </div> -->

<script>

var modal = document.querySelector('.modal');

var overflow = document.createElement('div');

$(document).on('click', '.news_read', function() {

    overflow.className = "overflow";

        document.body.appendChild(overflow);

        var height = modal.offsetHeight;

        // modal.style.marginTop = - height / 2 + "px";

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