<?php session_start(); ?>
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
          <li><a href="logIn.php">로그인</a></li>
          <li><a href="../signIn/signInInput.php">회원가입</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="jumbotron text-center">
    <h1>
      <?php
      echo $_SESSION['nickname']; ?>님, 이용해주셔서 감사합니다.</h1>
      <?php session_destroy(); ?>


  </div>

  <div class="container"><!-- 좌우측의 공간 확보 -->
      <!-- 헤더 들어가는 부분 -->


      <!--// 헤더 들어가는 부분 -->

          <!-- 본문 들어가는 부분 -->
          <div class="text-center">
            <h1>로그아웃 되었습니다.</h1>
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
            <small>대표 : JH PARK ㆍ 주소 :  SEOUL, KOREA ㆍ 전화 : 010-777-7777</small><br>
            <small>Copyrightⓒ JH Corp. All rights reserved.</small>
        </p>
      </footer>
      <!--// 푸터 들어가는 부분 -->
  </div>

</body>
</html>
