<?php
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
    //loop through the array and and explode each element into an array by asterisk (*) and assign first element to username key and second element to password key
    foreach ($decoded as $key => $value) {
        $decoded[$key] = explode('*', $value);
        $decoded[$key] = array('username' => $decoded[$key][0], 'password' => $decoded[$key][1]);
    }
    return $decoded;
}



//check if post method was requested
if (isset($_POST['submit'])) {
    //check if username and password are empty
    if (empty($_POST['username']) || empty($_POST['password'])) {
        header("Location: index.php?error=emptyfields");
        exit();
    } else {
        //check if username and password are valid
        $username = $_POST['username'];
        $password = $_POST['password'];
        
    }
}
//  else {
//     header("Location: index.php");
//     exit();
// }

$decodedFile = decodeFile('password.txt');
var_dump($decodedFile);
?>