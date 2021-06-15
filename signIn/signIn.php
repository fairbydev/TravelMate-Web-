<?php

$id = $_POST["id"];
$password = $_POST["password"];
$nickname = $_POST["nickname"];
$email = $_POST["email"];
$gender = $_POST["gender"];

// echo $id;
// echo $password;
// // echo $name;
// echo $nickname;
// echo $email;
// // echo $phoneNumber;
// echo $gender;

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

$sql = "insert into memberInfo (id, password, nickname, email, gender) values";
$sql = $sql."('".$id."', '".$password."', '".$nickname."', '".$email."', '".$gender."')";

if ($conn->query($sql) === TRUE) {

  // 가입 성공시 세션 설정 및 가입성공 페이지로 이동
  session_start();
  $_SESSION['is_login'] = true;
  $_SESSION['id'] = $id;
  $_SESSION['nickname'] = $nickname;
  header('Location: ./signInSuccess.php');

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();











?>
