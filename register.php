<?php
session_start();
include('connect.php');

// Checking if the form has been submitted
if (isset($_POST['register'])) {
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;

    // Check for empty fields
    if (empty($username) || empty($pass)) {
        header("Location: register.php?error=empty_fields");
        exit;
    }

    // Checking if the user exists
    $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
    $statement = $pdo->prepare($sql);
    $statement->execute([':username' => $username]);
    $row = $statement->fetch();

    if ($row['num'] > 0) {
        header("Location: register.php?error=username_exists");
        exit;
    }

    // Password hashing
    $passwordHash = password_hash($pass, PASSWORD_BCRYPT);

    // Inserting a new user into the database
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $statement = $pdo->prepare($sql);
    $result = $statement->execute([':username' => $username, ':password' => $passwordHash]);

    if ($result) {
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Thank You!</title>
            <style>
                body {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                    font-family: Arial, sans-serif;
                    background-color: #f9f9f9;
                }
                .message {
                    text-align: center;
                    font-size: 20px;
                    color: #333;
                }
            </style>
        </head>
        <body>
            <div class='message'>
                <p>Thank you for registering!</p>
                <p>You will be redirected to the login page in 4 seconds.</p>
            </div>
            <script>
                setTimeout(function() {
                    window.location.href = 'login.php';
                }, 4000);
            </script>
        </body>
        </html>";
        exit();
    } else {
        echo "An error occurred. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Library Registration</title>
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
            <h2 class="logo">MY LIBRARY</h2>
            <ul class="header-list">
                <li><a href="home.php" class="navigation">HOME</a></li>
            </ul>
        </div>
    </header>
    <main>
        <div class="main-page">
            <section class="form">
                <h1 class="main-title">REGISTRATION</h1>
                <p class="reg-title">Enter your login and password</p>
                <?php
                if (isset($_GET['error'])) {
                    $error = ($_GET['error']); 
                    if ($error === 'empty_fields') {
                        echo "<div style='color: red;'>Please fill in both fields.</div>";
                    } elseif ($error === 'username_exists') {
                        echo "<div style='color: red;'>That username already exists!</div>";
                    }
                }
                ?>
                <form action="register.php" method="post">
                    <ul>
                        <li class="input-item" style="padding-top: 30px;">
                            <input class="input" type="text" id="username" name="username" placeholder="Username" required>
                        </li>
                        <li class="input-item" style="padding-top: 30px;">
                            <input class="input" type="password" id="password" name="password" placeholder="Password" required>
                        </li>
                    </ul>
                    <ul class="main-list" style="padding-top: 30px;">
                        <li>
                            <button type="submit" name="register" class="nav-btn">Register</button>
                        </li>
                        <li>
                            <a href="home.php">
                                <button type="button" class="nav-btn">Cancel</button>
                            </a>
                        </li>
                    </ul>
                </form>
            </section>
        </div>
    </main>
    <footer>
        <p class="footer-title">&copy; 2024 Kateryna Sukovaia. All rights reserved (✿◠‿◠)</p>
    </footer>
</body>

</html>