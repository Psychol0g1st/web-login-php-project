<?php
require 'session.php';

function decodeFile($fileName) {
    $file = file_get_contents($fileName);
    $shiftingNumsOriginal = [5,-14,31,-9,3];
    $shiftingNums = $shiftingNumsOriginal;
    $decoded = '';
    $file = str_split($file);
    foreach ($file as $char) {
        if (ord($char) == 10) {
            $shiftingNums = $shiftingNumsOriginal;
            $decoded .= $char;
        } else {
            $charCode = ord($char);
            $charCode -= $shiftingNums[0];
            $decodedChar = chr($charCode);
            $decoded .= $decodedChar;
            array_push($shiftingNums, array_shift($shiftingNums));
        }
    }
    $decoded = substr_replace($decoded, '', -1);
    $decoded = explode(chr(10), $decoded);
    foreach ($decoded as $key => $value) {
        $decoded[$key] = explode('*', $value);
        $decoded[$key] = array('username' => $decoded[$key][0], 'password' => $decoded[$key][1]);
    }
    return $decoded;
}


$_SESSION['error'] = "";
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $decodedFile = decodeFile('./password.txt');
    $userExists = false;
    foreach ($decodedFile as $user) {
        if ($user["username"] === $username) {
            if($user["password"] === $password){
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $username;
            }
            else{
                $_SESSION['error'] = "Helytelen jelszó";
            }
            $userExists = true;
            break;
        }
    }
    if(!$userExists){
        $_SESSION['error']= "Ilyen felhasználó nem létezik";
    }
}
header("Location: index.php");
exit();
?>