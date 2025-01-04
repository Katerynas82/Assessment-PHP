<!DOCTYPE html>
<html lang="en">

<?php
$ISBN_no = null;
if (!empty($_GET['ISBN_no'])) {
  $ISBN_no = $_GET['ISBN_no'];
}
if (null == $ISBN_no) {
  header("Location: viewbooks.php");
  exit;
}
if (!empty($_POST)) {
  // create three new variables, and set their values to null
  $ISBN_noError = null;
  $titleError = null;
  $authorError = null;
  $publishedError = null;
  $priceError = null;
  $publisherError = null;
  $genreError = null;

  // create another three, and assign them the values from the HTML boxes
  $ISBN = $_POST['ISBN'];
  $title = $_POST['title'];
  $author = $_POST['author'];
  $published = $_POST['published'];
  $price = $_POST['price'];
  $publisher = $_POST['publisher'];
  $genre = $_POST['genre'];

  /* We need to check that each of the variables has a value before we try to put them into the database.
    Create a value variable, and set it to true*/
  $valid = true;

  //If the book field has been left empty, create an error message for the user and set the value of $value to false
  if (empty($ISBN)) {
    $ISBN_noError = 'Please enter ISBN number of book';
    $valid = false;
  }
  if (empty($title)) {
    $titleError = 'Please enter title of book';
    $valid = false;
  }
  if (empty($author)) {
    $authorError = 'Please enter author name';
    $valid = false;
  }
  if (empty($published)) {
    $publishedError = 'Please enter the year of published';
    $valid = false;
  }
  if (empty($price)) {
    $priceError = 'Please enter price';
    $valid = false;
  }
  if (empty($publisher)) {
    $publisherError = 'Please enter publisher name';
    $valid = false;
  }
  if (empty($genre)) {
    $genreError = 'Please enter the genre of book';
    $valid = false;
  }
  // If all the fields are complete, create the connection to the database
  if ($valid) {
    include('connect.php');
    //Where changes have been made, update the values of the fields in the database
    $sql = "UPDATE `books_catalogue` 
    SET ISBN_no = :ISBN_no, book_title = :book_title, author_name = :author_name, year_published = :year_published, 
        price = :price, publisher = :publisher, genre = :genre, image = :image 
    WHERE ISBN_no = :ISBN_no";
    $statement = $pdo->prepare($sql);
    $statement->execute(['book_title' => $title, 'author_name' => $author, 'year_published' => $published, 'price' => $price, 'publisher' => $publisher, 'genre' => $genre, 'ISBN_no' => $ISBN_no, 'image' => 'https://loremflickr.com/350/550/nature']);
    header("Location: viewbooks.php");
  }
} else {
  include('connect.php');
  //If no changes need to be made, show the value of the fields in the database
  $sql = "SELECT * FROM `books_catalogue` where ISBN_no = :ISBN_no";
  $statement = $pdo->prepare($sql);
  $statement->execute(['ISBN_no' => $ISBN_no]);
  $books = $statement->fetch();

  $ISBN = $books['ISBN_no'];
  $title = $books['book_title'];
  $author = $books['author_name'];
  $published = $books['year_published'];
  $price = $books['price'];
  $publisher = $books['publisher'];
  $genre = $books['genre'];
}
?>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Update page</title>
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
        <li><a href="viewbooks.php" class="navigation">BACK TO ADMIN PAGE</a></li>
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

      <h3 class="title">Update book</h3>

      <div style="max-width: 800px; margin: auto;">
        <!--print out the value of a record, uses the post method-->
        <form class="form-horizontal" action="update.php?ISBN_no=<?php echo $ISBN_no ?>" method="post">
          <!-- Updates the control group style class to error when the artisterror variable is not empty, i.e when there is an error.-->

          <div class="control-group <?php echo !empty($ISBN_noError) ? 'error' : ''; ?>">
            <label class="control-label">ISBN number</label>
            <div class="controls">
              <!-- This section uses short hand if statements. If the artist field is not empty, i.e it has a value, use the value in the artist variable, else use a blank string -->
              <input name="ISBN" type="text" placeholder="0000-0000-0000" value="<?php echo !empty($ISBN) ? $ISBN : ' '; ?>" required>
              <!-- If the artist error variable is not empty, i.e. There is an error associated, call the value of the artistError variable -->
              <?php if (!empty($ISBN_noError)): ?>
                <span class="help-inline"><?php echo $ISBN_noError; ?></span>
              <?php endif; ?>
            </div>
          </div>

          <div class="control-group <?php echo !empty($titleError) ? 'error' : ''; ?>">
            <label class="control-label">Book Title</label>
            <div class="controls">
              <!-- This section uses short hand if statements. If the artist field is not empty, i.e it has a value, use the value in the artist variable, else use a blank string -->
              <input name="title" type="text" placeholder="Title" value="<?php echo !empty($title) ? $title : ' '; ?>" required>
              <!-- If the artist error variable is not empty, i.e. There is an error associated, call the value of the artistError variable -->
              <?php if (!empty($titleError)): ?>
                <span class="help-inline"><?php echo $titleError; ?></span>
              <?php endif; ?>
            </div>
          </div>

          <div class="control-group <?php echo !empty($authorError) ? 'error' : ' '; ?>">
            <label class="control-label">Author</label>
            <div class="controls">
              <input name="author" type="text" placeholder="Author" value="<?php echo !empty($author) ? $author : ' '; ?>" required>
              <?php if (!empty($authorError)): ?>
                <span class="help-inline"><?php echo $authorError; ?></span>
              <?php endif; ?>
            </div>
          </div>

          <div class="control-group <?php echo !empty($publishedError) ? 'error' : ' '; ?>">
            <label class="control-label">Published</label>
            <div class="controls">
              <input name="published" type="number" placeholder="Published" value="<?php echo !empty($published) ? $published : ' '; ?>" required>
              <?php if (!empty($publishedError)): ?>
                <span class="help-inline"><?php echo $publishedError; ?></span>
              <?php endif; ?>
            </div>
          </div>

          <div class="control-group <?php echo !empty($priceError) ? 'error' : ' '; ?>">
            <label class="control-label">Price</label>
            <div class="controls">
              <input name="price" type="number" placeholder="Price" value="<?php echo !empty($price) ? $price : ' '; ?>" required>
              <?php if (!empty($priceError)): ?>
                <span class="help-inline"><?php echo $priceError; ?></span>
              <?php endif; ?>
            </div>
          </div>

          <div class="control-group <?php echo !empty($publisherError) ? 'error' : ' '; ?>">
            <label class="control-label">Publisher</label>
            <div class="controls">
              <input name="publisher" type="text" placeholder="Publisher" value="<?php echo !empty($publisher) ? $publisher : ' '; ?>" required>
              <?php if (!empty($publisherError)): ?>
                <span class="help-inline"><?php echo $publisherError; ?></span>
              <?php endif; ?>
            </div>
          </div>

          <div class="control-group <?php echo !empty($genreError) ? 'error' : ' '; ?>">
            <label class="control-label">Genre</label>
            <div class="controls">
              <input name="genre" type="text" placeholder="Genre" value="<?php echo !empty($genre) ? $genre : ' '; ?>" required>
              <?php if (!empty($genreError)): ?>
                <span class="help-inline"><?php echo $genreError; ?></span>
              <?php endif; ?>
            </div>
          </div>



          <ul class="main-list" style="padding-top: 10px;">
            <li>
              <button type="submit" name="create" class="nav-btn">Update</button>
            </li>
            <li>
              <a href="viewbooks.php">
                <button type="button" class="nav-btn">Back</button>
              </a>
            </li>
          </ul>

        </form>
      </div>
    </div>
    </div> 
    </div>
  </main>
  <footer>
    <p class="footer-title">&copy; 2024 Kateryna Sukovaia. All rights reserved (✿◠‿◠)</p>
  </footer>
</body>

</html>