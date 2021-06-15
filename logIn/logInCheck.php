<?php

$id = $_POST["id"];
$password = $_POST["password"];

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


//입력된 아이디를 가진 유저의 비밀번호가 입력된 비밀번호와 맞는지 체크
$sql = 'select count(password) as cnt from memberInfo where password="' .
        $password.'" and id = "'.$id.'"';
//$result = $db->query($sql);
$result = $conn->query($sql);
$row = $result->fetch_assoc();

//비밀번호가 맞다면
if($row['cnt'] == 1) {

  //입력된 아이디를 가진 유저의 닉네임 불러오기
  $sql = 'select nickname from memberInfo where password="' .
          $password.'" and id = "'.$id.'"';
  //$result = $db->query($sql);
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  session_start();
  $_SESSION['is_login'] = true;
  $_SESSION['id'] = $id;
  $_SESSION['nickname'] = $row['nickname'];

  //로그인 성공 메시지 알림
  $msg = $row['nickname'].'님 환영합니다.';
  ?>
      <script>
          alert("<?php echo $msg?>");
          window.location.replace('http://192.168.56.101/main.php');

      </script>
  <?php

  // header('Location: ../main.php');

} else {
    $msg = '비밀번호가 맞지 않습니다.';


?>
    <script>
        alert("<?php echo $msg?>");
        history.back();
    </script>
<?php
    exit;
}

$conn->close();


?>
