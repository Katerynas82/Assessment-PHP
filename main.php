<!DOCTYPE html>
<html>

<?php
include('connect.php');
session_start();
//Check if the user is logged in.
if (!isset($_SESSION['username']) || !isset($_SESSION['logged_in'])) {
  //User not logged in. Redirect them back to the login.php page.
  header('Location: login.php');
  exit;
} ?>

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



  <link rel="stylesheet" href="./css/main_page.css" />
</head>

<body>
  <header>
    <div class="container">
      <h2>MY LIBRARY</h2>
      <ul class="header-list">
        <li><a href="home.php" class="navigation">SIGN UP</a></li>

      </ul>
    </div>
  </header>

  <main>
    <div style="background: rgba(253, 232, 192, 1);
  color: rgba(161, 74, 74, 0.7);">
      <h3>Welcome
        <?php echo $_SESSION["username"]; ?>. Here you can choose a book you like and read it.</h3>
    </div>

    <div class="bookshelf">
      <div class="shelf">
        <?php
        $sql = "SELECT * FROM `books_catalogue` LIMIT 14";
        $statement = $pdo->query($sql);
        $books = $statement->fetchAll();

        $colors = ['#d4d473', '#9c5a44', '#748fc8', '#8b5d33', '#9f867a', '#4d4570', '#e55651', '#eb8d2e', '#449c48', '#f0e62f', '#9f7a9a', '#50aab5', '#2a3ef1', '#d4555b'];

        foreach ($books as $index => $book) {
          // Choice of color for each block
          $color = $colors[$index % count($colors)];

          echo '<a href="read.php?ISBN_no=' . ($book['ISBN_no']) . '">';
          echo '<div class="book" style="background-color: ' . ($color) . ';">';
          echo '<span>';
          echo '<ul class="info-list">';
          echo '<li class="book-item"><p>' . ($book['author_name']) . '</p></li>';
          echo '<li><p class="book-title">' . ($book['book_title']) . '</p></li>';
          echo '<li style="padding-top: 40px; outline: 1px solid rgb(108, 72, 72);"><p>' . ($book['year_published']) . '</p></li>';
          echo '</ul>';
          echo '</span>';
          echo '</div>';
          echo '</a>';
        }
        ?>


      </div>


  </main>
  <footer>
    <p class="footer-title">&copy; 2024 Kateryna Sukovaia. All rights reserved (✿◠‿◠)</p>
  </footer>
</body>

</html>