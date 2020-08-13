<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700,700italic|Playfair+Display:400,700&subset=latin,cyrillic">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="./frontcss.css">
  <link href="https://fonts.googleapis.com/css?family=Rubik+Mono+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
</head>
<body>
<header>
    <nav class="container">
      <a class="logo" href="http://ics.odessa.ua/qa-index.php">
        <img src="img/logo-ics2.png" class="logo">
	    </a>
	  <div class="nav-toggle"><span></span></div>
      <ul id="menu">
        <li><a href="http://ics.odessa.ua/qa-page-applicants.php">Абитуриентам</a></li>
        <li><a href="http://ics.odessa.ua/qa-page-students.php">Студентам</a></li>
		    <li><a href="http://ics.odessa.ua/qa-page-graduates.php">Выпускникам</a></li>
        <li><a href="">Доска объявлений</a></li>
      </ul>
    </nav>
  </header>

<script>
$('.nav-toggle').on('click', function(){
  $('#menu').toggleClass('active');
});
</script>