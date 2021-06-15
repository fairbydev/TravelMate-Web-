<?php
session_start();


$checkId = $_GET["checkId"];
$checkPassword = $_GET["checkPassword"];
$checkNickname = $_GET["checkNickname"];
$checkEmail = $_GET["checkEmail"];
$checkGender = $_GET["checkGender"];

$_SESSION['checkId'] = $checkId;
$_SESSION['checkPassword'] = $checkPassword;
$_SESSION['checkNickname'] = $checkNickname;
$_SESSION['checkEmail'] = $checkEmail;
$_SESSION['checkGender'] = $checkGender;

//echo $_SESSION['checkId'].'1111';


$servername = "localhost";
$username = "root";
$mysqlpassword = "MyNewPassword";
$dbname = "travelMate";

// Create connection
$conn = new mysqli($servername, $username, $mysqlpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = 'select count(*) as cnt from memberInfo where id="'.$checkId.'"';
$result = $conn->query($sql);
$row = $result->fetch_assoc();

//echo $_SESSION['checkId'].'2222';

if($row['cnt'] == 0) { //맞는 결과가 없을 경우 종료
  $_SESSION['idDuplicationCheck'] = true;
  header('Location: ./signInInput.php');
  //echo $_SESSION['checkId'].'success';
} else {
  $_SESSION['idDuplicationCheck'] = false;
  header('Location: ./signInInput.php');
  //echo $_SESSION['checkId'].'fail';
}

$conn->close();

?>
