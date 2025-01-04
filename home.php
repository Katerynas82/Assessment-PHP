<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('connect.php');
?>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Library Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Jacques+Francois&family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Jacques+Francois&family=Jacques+Francois+Shadow&family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&family=Instrument+Serif:ital@0;1&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lovers+Quarrel&display=swap" rel="stylesheet">
    
   

  <link rel="stylesheet" href="./css/home.css" />
</head>

<body>
  <header>
    <div class="container">
      <h2>MY LIBRARY</h2>
      <ul class="header-list">
        <li><a href="login.php" class="navigation">LOG IN</a></li>
        <li><a href="register.php" class="navigation">REGISTER</a></li>
      </ul>
    </div>
    <header />
    <main>
      <div class="main-page">
        <section class="form">
          <h1>WELCOME TO <br> “MY LIBRARY”</h1>
          <ul class="main-list">
            <li><a href="login.php" class="nav-btn">Log in</a></li>
            <li><a href="register.php" class="nav-btn">Register</a></li>
          </ul>
        </section>
      </div>
    </main>
    <footer>
      <p class="footer-title">&copy; 2024 Kateryna Sukovaia. All rights reserved (✿◠‿◠)</p>
    </footer>
</body>

</html>