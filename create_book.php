<!DOCTYPE html>
<html lang="en">
  <?php 

// Check if the form has been submitted
if ( !empty($_POST)) {
// initialising the error variables
        $ISBN_noError = null;
        $titleError = null;
        $authorError = null;
        $publishedError = null;
        $priceError = null;
        $publisherError = null;
        $genreError = null;

//Assigning the form data to the variables
        $ISBN = $_POST['ISBN'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $published = $_POST['published'];
        $price = $_POST['price'];
        $publisher = $_POST['publisher'];
        $genre = $_POST['genre'];

//initialising the validation check
        $valid = true;
//Checking to see field is empty, if so, update books error variable and set valid to false
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
//Check to see if valid is set to true, i.e there is form data
        if ($valid) {
        //Connection include
        include('connect.php');

            $sql = "INSERT INTO `books_catalogue` 
        (ISBN_no, book_title, author_name, year_published, price, publisher, genre, image) 
        VALUES (:ISBN_no, :book_title, :author_name, :year_published, :price, :publisher, :genre, :image)";

            $statement= $pdo->prepare($sql); $create = ['ISBN_no' => $ISBN,
  'book_title' => $title , 'author_name' => $author, 'year_published'=>
  $published, 'price'=> $price, 'publisher'=> $publisher, 'genre'=> $genre,
  'image' => 'https://loremflickr.com/350/550/nature'];
  $statement->execute($create); header("Location: viewbooks.php"); } } ?>

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&family=Instrument+Serif:ital@0;1&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lovers+Quarrel&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="./css/viewbooks.css" />
  </head>
  <body>
    <header>
      <div class="container">
        <h2>MY LIBRARY</h2>
        <ul class="header-list">
          <li>
            <a href="viewbooks.php" class="navigation">BACK TO ADMIN PAGE</a>
          </li>
          <li><a href="home.php" class="navigation">SIGN UP</a></li>
        </ul>
      </div>
    </header>
    <main>
      <div
        style="
          background: rgba(253, 232, 192, 1);
          color: rgba(161, 74, 74, 0.7);
        "
      >
        <h3>Book directory of the administrator.</h3>
      </div>
      <div class="bg">
        <h3 class="title">Create a new book</h3>

        <!-- form using the method post, it will use this file as the action-->
        <div style="max-width: 800px; margin: auto">
          <form class="form-horizontal" action="create_book.php" method="post">
            <div
              class="control-group <?php echo !empty($ISBN_noError)?'error':'';?>"
            >
              <label class="control-label" for="ISBN">ISBN number</label>

              <div class="controls">
                <input id="ISBN" name="ISBN" placeholder="0000-0000-0000" />

                <?php if (!empty($ISBN_noError)): ?>

                <span class="help-inline"><?php echo $ISBN_noError;?></span>

                <?php endif; ?>
              </div>
            </div>
            <div
              class="control-group <?php echo !empty($titleError)?'error':'';?>"
            >
              <label class="control-label">Book Title</label>

              <div class="controls">
                <input name="title" type="text" placeholder="title" />

                <?php if (!empty($titleError)): ?>

                <span class="help-inline"><?php echo $titleError;?></span>

                <?php endif; ?>
              </div>
            </div>

            <div
              class="control-group <?php echo !empty($authorError)?'error':'';?>"
            >
              <label class="control-label">Author</label>

              <div class="controls">
                <input name="author" type="text" placeholder="author" />

                <?php if (!empty($authorError)): ?>

                <span class="help-inline"><?php echo $authorError;?></span>

                <?php endif;?>
              </div>
            </div>

            <div
              class="control-group <?php echo !empty($publishedError)?'error':'';?>"
            >
              <label class="control-label">Published</label>

              <div class="controls">
                <input name="published" type="text" placeholder="published" />

                <?php if (!empty($publishedError)): ?>

                <span class="help-inline"><?php echo $publishedError;?></span>

                <?php endif;?>
              </div>
            </div>
            <div
              class="control-group <?php echo !empty($priceError)?'error':'';?>"
            >
              <label class="control-label">Price</label>

              <div class="controls">
                <input name="price" type="text" placeholder="price" />

                <?php if (!empty($priceError)): ?>

                <span class="help-inline"><?php echo $priceError;?></span>

                <?php endif;?>
              </div>
            </div>
            <div
              class="control-group <?php echo !empty($publisherError)?'error':'';?>"
            >
              <label class="control-label">Publisher</label>

              <div class="controls">
                <input name="publisher" type="text" placeholder="publisher" />

                <?php if (!empty($publisherError)): ?>

                <span class="help-inline"><?php echo $publisherError;?></span>

                <?php endif;?>
              </div>
            </div>
            <div
              class="control-group <?php echo !empty($genreError)?'error':'';?>"
            >
              <label class="control-label">Genre</label>

              <div class="controls">
                <input name="genre" type="text" placeholder="genre" />

                <?php if (!empty($genreError)): ?>

                <span class="help-inline"><?php echo $genreError;?></span>

                <?php endif;?>
              </div>
            </div>

            <ul class="main-list">
              <li>
                <button type="submit" name="create" class="nav-btn">
                  Create
                </button>
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
    </main>
    <footer>
      <p class="footer-title" >
        &copy; 2024 Kateryna Sukovaia. All rights reserved (✿◠‿◠)
      </p>
    </footer>
  </body>
</html>
