<?php
    require 'session.php';
    if(isset($_SESSION['logged_in'])){
        if($_SESSION['logged_in']){
            header("Location: home.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="src/styles.css">
  <style>
    :root{
        --main-color: #f5f5f5;
    }
  </style>
  <title>Login</title>
</head>
<body>
  <h1>Login</h1>
  <form action="login.php" method="post">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <button type="submit" name="submit">Login</button>
  </form>
  <div class="error">
    <?php
        if(isset($_SESSION['error'])){
            echo $_SESSION['error'];
            if($_SESSION['error'] == "Helytelen jelszó"){
                $_SESSION['error']= "";
                header("refresh:3;url=https://police.hu");
                exit();
            }
            $_SESSION['error']= "";
        }
    ?>
  </div>
  <div class="footer">
    <h2>Svec Antal EZJRP1</h2>
  </div>
</body>
</html>