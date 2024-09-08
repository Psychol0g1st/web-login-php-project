<?php
    require 'session.php';
    require 'database.php';
    if(!isset($_SESSION['logged_in']) && !$_SESSION['logged_in']){
        header("Location: index.php");
        exit();
    }
    function getColorValue($colorName) {
    $colors = array(
        'piros' => '#ff0000',
        'zold' => '#00ff00',
        'sarga' => '#ffff00',
        'kek' => '#0000ff',
        'fekete' => '#000000',
        'feher' => '#ffffff'
    );
    $colorName = strtolower($colorName);
    return isset($colors[$colorName]) ? $colors[$colorName] : '#000000';
}
    $color = getColorFromDb($_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        :root{
            --main-color: <?=getColorValue($color)?>;
        }
    </style>
    <link rel="stylesheet" href="src/styles.css">
</head>
<body>
    <main>
        <div class="container">
            <h1><?=$_SESSION['username']?></h1>
            <form action="logout.php" method="post">
                <button type="submit" name="submit">Logout</button>
            </form>
        </div>
    </main>
    <div class="footer">
        <h2>Svec Antal EZJRP1</h2>
    </div>
</body>
</html>