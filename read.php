<?php

$ISBN_no = null;

if (!empty($_GET['ISBN_no'])) {
  $ISBN_no = $_GET['ISBN_no'];
}

if (null == $ISBN_no) {
  header("Location: main.php");
} else {
  include('connect.php');
  $sql = "SELECT * FROM `books_catalogue` WHERE ISBN_no = :ISBN_no;";

  $statement = $pdo->prepare($sql);

  $statement->execute(['ISBN_no' => $ISBN_no]);

  $books = $statement->fetch();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Read page</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&family=Instrument+Serif:ital@0;1&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lovers+Quarrel&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/read_page.css" />

</head>

<body>
  <header>
    <div class="container">
      <h2>MY LIBRARY</h2>
      <ul class="header-list">
        <li><a href="main.php" class="navigation">BACK TO LIBRARY</a></li>
        <li><a href="home.php" class="navigation">SIGN UP</a></li>
      </ul>
    </div>
  </header>
  <main>
    <div style="background: rgba(253, 232, 192, 1);
  color: rgba(161, 74, 74, 0.7);">
      <h3>Read with pleasure.</h3>
    </div>
    <div class="bg">
      <div class="container ">
        <div class="book-image"><img class="book-image" src="<?php echo $books['image'];
                                                              ?>" alt="Book Image">
        </div>
        <div class="text-cont">
          <ul>
            <li>
              <h1 class="book-title"><?php echo $books['book_title'];
                                      ?></h1>
            </li>
            <li>
              <p class="book-item"><?php echo $books['author_name']; ?></p>
            </li>
            <li>
              <p class="book-item"><?php echo $books['year_published']; ?>
                <?php echo $books['publisher'];
                ?></p>
            </li>
            <li>
              <p class="book-item" style="padding-bottom: 20px;"><?php echo $books['genre'];
                                                                  ?></p>
            </li>
            <li>
              <p style="text-align: left; padding-bottom: 20px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum...
              </p>
            </li>
            <li>
              <p class="book-item" style="padding-right: 25px; color: rgba(161, 74, 74, 0.7); text-align: right;">Buy the full version: £ <?php echo $books['price'];
                                                                                                                                          ?>
            </li>
          </ul>
        </div>
      </div>

  </main>
  <footer>
    <p class="footer-title">&copy; 2024 Kateryna Sukovaia. All rights reserved (✿◠‿◠)</p>
  </footer>
</body>
</html>