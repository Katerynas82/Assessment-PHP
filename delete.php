<?php 
//Connection include
include('connect.php');
$ISBN = null;
//An if conditional using the get superglobal to check if the id parameter is not empty and assigns the value to the id variable, this is the id of the record to be deleted.
 if ( !empty($_GET['ISBN_no'])) {
$ISBN = $_REQUEST['ISBN_no'];
  }
//An if conditional using the post superglobal to check if the id parameter is not empty and assigns the value to id variable, which is used in the delete query below.
  if ( !empty($_POST)) {
$ISBN = $_POST['ISBN_no'];
$sql = "DELETE FROM `books_catalogue`  WHERE ISBN_no = :ISBN_no";
$statement = $pdo->prepare($sql);
$statement->execute(['ISBN_no' => $ISBN]);

  header("Location: viewbooks.php");
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Delete page</title>
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
       <h3 class="title">Delete a book</h3>
            
<!-- The form has the current php file as the action and the method set to post. It uses the hidden input type with the name id, when submit button "yes" is clicked, the id is passed to through to the variable on line 11 using post.-->
<form class="form-horizontal" action="delete.php" method="post">
<input type="hidden" name="ISBN_no" value="<?php echo $ISBN;?>"/>
<p class="alert">Are you sure you want to delete ?</p>
<div style="display: grid; place-items: center; height: 400px; width: 400px; border: none; margin: auto;">
<img src="./images/rb_4233.png" alt="Image" style="max-width: 100%; max-height: 100%;"> </div>

<ul class="main-list" style=" justify-content: center;">
    <li style="margin: 0px 50px;">
        <button type="submit" name="delete" class="nav-btn" >Yes</button>
    </li>
    <li style="margin: 0px 50px;">
        <a href="viewbooks.php">
            <button type="button" class="nav-btn">No</button>
        </a>
    </li>
</ul>
</form>
</div>
  <footer>
    <p class="footer-title">&copy; 2024 Kateryna Sukovaia. All rights reserved (✿◠‿◠)</p>
  </footer>
</body>
</html>
