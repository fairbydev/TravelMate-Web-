<?php       session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>TravelMate Homepage</title>
  <style>
  .jumbotron {
      background-color: #f4511e;
      color: #fff;
      padding: 100px 0px;
      font-family: Montserrat, sans-serif;
      margin-bottom: 30px;
  }

  .navbar {
      margin-bottom: 0;
      background-color: #f4511e;
      z-index: 9999;
      border: 0;
      font-size: 12px !important;
      line-height: 1.42857143 !important;
      letter-spacing: 4px;
      border-radius: 0;
      font-family: Montserrat, sans-serif;
  }
  .navbar li a, .navbar .navbar-brand {
      color: #fff !important;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
      color: #f4511e !important;
      background-color: #fff !important;
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
      color: #fff !important;
  }



  //버튼
  .btn{
    background-color: #f4511e;
  }



//footer

footer .glyphicon {
    font-size: 20px;
    margin-bottom: 20px;
    color: #f4511e;
}

  </style>

</head>
<body>

  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../main.php">TRAVEL MATE</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="../intro/introMain.php">ABOUT</a></li>
          <li><a href="../travelMenu/travelList.php">NEW TRAVELS</a></li>
          <li><a href="../reviewBoard/board/index.php">REVIEW BOARD</a></li>
          <?php
          session_start();
          if(!isset($_SESSION['is_login']) || !isset($_SESSION['nickname'])) {
            echo '<li><a href="../logIn/logIn.php">로그인</a></li>';
            echo '<li><a href="./signIn/signInInput.php">회원가입</a></li>';
          }else{
            //echo '<li><a href="../mypage/mypage.php">나의 정보</a></li>';
            echo '<li><a href="../logIn/logOut.php">로그아웃</a></li>';
          }
          $is_login = $_SESSION['is_login'];
          $id = $_SESSION['id'];
          $nickname = $_SESSION['nickname'];
          ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="jumbotron text-center">
    <h1>안녕하세요,
      <?php
      echo $_SESSION['nickname']; ?>님</h1>
  </div>

  <div class="container"><!-- 좌우측의 공간 확보 -->
      <!-- 헤더 들어가는 부분 -->


      <!--// 헤더 들어가는 부분 -->

          <!-- 본문 들어가는 부분 -->

          <div class="text-center">
            <h1>회원가입을 축하드립니다!</h1>
            <p>아래 버튼을 클릭하시면 메인화면으로 이동합니다.</p></br>
            <button type="button" onclick = "location.href = '../main.php' " class="btn">메인페이지로 이동</button>
          </div>
        </br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>

  <script>
  // 스크립트 들어가는 부분
  </script>
          <!--// 본문 들어가는 부분 -->
      <hr/>
      <!-- 푸터 들어가는 부분 -->

      <footer class="container-fluid text-center">
        <p class="text-center">
            <small><strong> 트래블메이트</strong></small><br>
            <small>대표 : 박재홍 ㆍ 주소 :  남성역 3번출구 ㆍ 전화 : 010-3056-0002</small><br>
            <small>Copyrightⓒ TEAMNOVA All rights reserved.</small>
        </p>
      </footer>
      <!--// 푸터 들어가는 부분 -->
  </div>

</body>
</html>
