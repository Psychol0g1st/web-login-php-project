<?php
function getColorFromDb($username){
    $db_servername = "sql112.epizy.com";
    $db_username = "epiz_34076006";
    $db_password = "QpyIcDahMnT";
    $db_dbname = "epiz_34076006_adatok";

    $conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $stmt = mysqli_prepare($conn, "SELECT * FROM tabla WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    while ($row = mysqli_fetch_assoc($result)) {
        return $row["titkos"];
    }
}
?>
