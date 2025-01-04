<!DOCTYPE html>
<html lang="en">
<?php
include('connect.php');
session_start(); ?>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin page</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&family=Instrument+Serif:ital@0;1&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lovers+Quarrel&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="./css/viewbooks.css" />



</head>

<body>
  <header>
    <div class="container">
      <h2>MY LIBRARY</h2>
      <ul class="header-list">
        <li><a href="create_book.php" class="navigation">CREATE NEW BOOK</a></li>
        <li><a href="home.php" class="navigation">SIGN UP</a></li>
      </ul>
    </div>
  </header>
  <main>
    <div style="background: rgba(253, 232, 192, 1);
  color: rgba(161, 74, 74, 0.7);">
      <h3>Book directory of the administrator.</h3>
    </div>
    <div class="bg">
      <div class="container">

        <table class="table">
          <thead>
            <tr>
              <th>Title</th>
              <th>Author</th>
              <th>Published</th>
              <th>Price</th>
              <th>Publisher</th>
              <th>Genre</th>
              <th>Cover</th>
              <th></th>

            </tr>
          </thead>
          <tbody>

            <?php
            $sql = "SELECT * FROM `books_catalogue`";
            $statement = $pdo->query($sql);
            $books = $statement->fetchAll();

            foreach ($books as $row) {
              echo '<tr>';
              echo '<td>' . $row['book_title'] . '</td>';
              echo '<td>' . $row['author_name'] . '</td>';
              echo '<td>' . $row['year_published'] . '</td>';
              echo '<td>' . $row['price'] . '</td>';
              echo '<td>' . $row['publisher'] . '</td>';
              echo '<td>' . $row['genre'] . '</td>';
              if ($row['image']) {
                //create a variable which holds data from the images folder
                $imageDir = "images/";

                //create a second variable which holds the value of the image
                $img = $row['image'];
                echo "<td width = 15%>";

                //display the image
                echo "<center><img src='$img'alt='Book image' width='100' height='150'></center>";
              }
              echo '<td width=250>';
              echo '<a class="btn btn-primary" href="read-admin.php?ISBN_no=' . $row['ISBN_no'] . '">Read</a>';
              echo ' ';
              echo '<a class="btn btn-success" href="update.php?ISBN_no=' . $row['ISBN_no'] . '">Update</a>';
              echo ' ';
              echo '<a class="btn btn-danger" href="delete.php?ISBN_no=' . $row['ISBN_no'] . '">Delete</a>';
              echo '</td>';
              echo '</tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

   <footer>
    <p class="footer-title">&copy; 2024 Kateryna Sukovaia. All rights reserved (✿◠‿◠)</p>
  </footer>
</body>

</html>