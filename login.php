<?php
session_start();
include('connect.php');

if (isset($_POST['login'])) {
    // get form's data
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;

    // Check empty line
    if (empty($username) || empty($passwordAttempt)) {
        header("Location: login.php?error=" . urlencode("empty_fields"));
        exit;
    }

    try {
        // SQL query to retrieve user data
        $sql = "SELECT id, username, password, role FROM users WHERE username = :username";
        $statement = $pdo->prepare($sql);
        $statement->execute([':username' => $username]);
        $user = $statement->fetch();

        // If the user is not found
        if (!$user) {
            header("Location: login.php?error=" . urlencode("incorrect_credentials"));
            exit;
        }

        // Password verification
        if (password_verify($passwordAttempt, $user['password'])) {
            // Saving session data
            $_SESSION['username'] = $user['username'];
            $_SESSION['logged_in'] = time();
            $_SESSION['role'] = $user['role'];

            //Role-based redirection
            if ($user['role'] === 'admin') {
                header('Location: viewbooks.php');
            } else {
                header('Location: main.php');
            }
            exit;
        } else {
            // Incorrect password
            header("Location: login.php?error=" . urlencode("incorrect_credentials"));
            exit;
        }
    } catch (PDOException $e) {
        // Database error handling
        header("Location: login.php?error=" . urlencode("database_error"));
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log in</title>
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
                <h1 class="main-title">LOG IN</h1>
                <p class="reg-title">Enter your login and password</p>

                <?php
                // get errors
                if (isset($_GET['error'])) {
                    $error = $_GET['error'];
                    if ($error === 'empty_fields') {
                        echo "<div style='color: red;'>Please fill in both fields.</div>";
                    } elseif ($error === 'incorrect_credentials') {
                        echo "<div style='color: red;'>Incorrect username or password. Please try again.</div>";
                    } elseif ($error === 'database_error') {
                        echo "<div style='color: red;'>Database error. Please try again later.</div>";
                    }
                }
                ?>

                <form action="login.php" method="post">
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
                            <button type="submit" name="login" class="nav-btn">Log in</button>
                        </li>
                        <li>
                            <a href="home.php">
                                <button type="button" class="nav-btn">Cancel</button>
                            </a>
                        </li>
                    </ul>
                </form>
                <a href="register.php" >
                    <h3 class="small-title">I don't have an account</h3>
                </a>
            </section>
        </div>
    </main>
    <footer>
        <p class="footer-title">&copy; 2024 Kateryna Sukovaia. All rights reserved (✿◠‿◠)</p>
    </footer>
</body>

</html>