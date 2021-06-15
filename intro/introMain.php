<?php session_start(); ?>>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

  <!-- (Optional) Latest compiled and minified JavaScript translation files -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/i18n/defaults-*.min.js"></script>


  <title>TravelMate Homepage</title>
  <style>
  .jumbotron {
      background-color: #f4511e;
      color: #fff;
      padding: 100px 0px;
      font-family: Montserrat, sans-serif;
      margin-bottom: -30px;
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



  //스크롤 사진화면
  .carousel-control.right, .carousel-control.left {
    background-image: none;
    color: #f4511e;
}

.carousel-indicators li {
    border-color: #f4511e;
}

.carousel-indicators li.active {
    background-color: #f4511e;
}

.item h4 {
    font-size: 19px;
    line-height: 1.375em;
    font-weight: 400;
    font-style: italic;
    margin: 70px 0;
    width: inherit;
    height: auto;
}



.item span {
    font-style: normal;
}


.carousel-caption{
  margin-bottom: 10%;
}

#item2image {
    position:relative;
    float:left; /* optional */
    padding-bottom: 5px;
}
#item1image #item1text {
    position:absolute;
    top:10px; /* in conjunction with left property, decides the text position */
    left:10px;
    width:300px; /* optional, though better have one */
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
          <li><a href="introMain.php">ABOUT</a></li>
          <li><a href="../travelMenu/travelList.php">NEW TRAVELS</a></li>
          <li><a href="../reviewBoard/board/index.php">FREE BOARD</a></li>


          <?php
          if(!isset($_SESSION['is_login']) || !isset($_SESSION['nickname'])) {
            echo '<li><a href="../logIn/logIn.php">로그인</a></li>';
            echo '<li><a href="../signIn/signInInput.html">회원가입</a></li>';
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
    <h1>About US</h1>
    <p>당신의 여행을 응원합니다!</p>
  </div>


<br/><br/>


<!-- Container (The Band Section) -->
<div id="band" class="container text-center">
  <h3>TRAVEL MATE</h3>
  <p><em>새로운 세상과 친구들을 만나세요!</em></p>
  <p>뭔가 신나는 여행을 해보고 싶은데 무얼 해야할지 모르겠다면? 가고싶은 여행지가 있는데 같이할 친구들을 찾는다면?<br/>
    혼자 여행을 계획하다가 고민만 하다 보면 적당한 곳을 찾아도 계속 미루게 되는것이 현실입니다. 혼자서 하는 여행도 얻을 것이 많지만 사람과 함꼐하는 여행은 추억을 더 풍부하게 합니다.<br/>
    트래블 메이트는 사람들을 모아 여행을 함께 즐기고 소통하며 더 행복한 삶을 살 수 있게 하고자 합니다. 지친 일상속에서 새로운 사람들과 여행을 통해 활력을 찾아보는건 어떨까요?</p>
  <br>
  <div class="row">
    <div class="col-sm-4">
      <p class="text-center"><strong>ENHANCEMENT</strong></p><br>
      <a href="#demo" data-toggle="collapse">
        <img src="../images/enhancement.jpg" class="img-circle img1" alt="Random Name" width="255" height="255">
      </a>
      <div id="demo" class="collapse sentence">
        <br/>
        <p>다양한 경험을 통해 우리모두가 더 넓은 세상을 경험하고,<br/> 풍부한 삶을 살고자 합니다.</p>
      </div>
    </div>
    <div class="col-sm-4">
      <p class="text-center"><strong>INSPIRATION</strong></p><br>
      <a href="#demo2" data-toggle="collapse">
        <img src="../images/inspiration.jpg" class="img-circle img2" alt="Random Name" width="255" height="255">
      </a>
      <div id="demo2" class="collapse sentence">
        <br/>
        <p>여행의 가치와 문화를 나누는 기쁨과 열정이 </br>개인을, 그리고 사회를 고취시킵니다.</p>

      </div>
    </div>
    <div class="col-sm-4">
      <p class="text-center"><strong>COMMUNITY</strong></p><br>
      <a href="#demo3" data-toggle="collapse">
        <img src="../images/communication.jpg" class="img-circle img3" alt="Random Name" width="255" height="255">
      </a>
      <div id="demo3" class="collapse sentence">
        <br/>
        <p>비슷한 관심사와 목적지를 가진 다양한 친구들을 만나<br/> 여행을 통해 자유롭게 소통해보세요!</p>
      </div>
    </div>
  </div>
</div>

  <br/><br/><br/><br/>
  <hr/>
  <div class="col-md-12">
    <footer class="container-fluid text-center">
      <p class="text-center">
          <small><strong> 트래블메이트</strong></small><br>
          <small>대표 : JH PARK ㆍ 주소 :  SEOUL, KOREA ㆍ 전화 : 010-777-7777</small><br>
          <small>Copyrightⓒ JH Corp. All rights reserved.</small>
      </p>
    </footer>
  </div>


</body>



<script>
// $('.img-circle').hover(
//   //마우스 들어올 때
//   function() {
//     $(this).stop().animate({
//       opacity: "0.5"
//     }, 300);
//     $(this).find(".sentence").stop().animate({
//       height: "toggle",
//       opacity: "toggle"
//     }, 300);
//   },
//   //마우스 나갈 때
//   function() {
//     $(this).stop().animate({
//       opacity: "1"
//     }, 300);
//   }
// );

$('.img1').hover(
  //마우스 들어올 때
  function() {
    $(this).stop().animate({
      opacity: "0.6"
    }, 300);
    $("#demo").stop().animate({
      height: "toggle",
      opacity: "1"
    }, 300);
  },
  //마우스 나갈 때
  function() {
    $(this).stop().animate({
      opacity: "1"
    }, 300);
    $("#demo").stop().animate({
      height: "toggle",
      opacity: "0"
    }, 300);
  }
);

$('.img2').hover(
  //마우스 들어올 때
  function() {
    $(this).stop().animate({
      opacity: "0.6"
    }, 300);
    $("#demo2").stop().animate({
      height: "toggle",
      opacity: "1"
    }, 300);
  },
  //마우스 나갈 때
  function() {
    $(this).stop().animate({
      opacity: "1"
    }, 300);
    $("#demo2").stop().animate({
      height: "toggle",
      opacity: "0"
    }, 300);
  }
);

$('.img3').hover(
  //마우스 들어올 때
  function() {
    $(this).stop().animate({
      opacity: "0.6"
    }, 300);
    $("#demo3").stop().animate({
      height: "toggle",
      opacity: "1"
    }, 300);
  },
  //마우스 나갈 때
  function() {
    $(this).stop().animate({
      opacity: "1"
    }, 300);
    $("#demo3").stop().animate({
      height: "toggle",
      opacity: "0"
    }, 300);
  }
);

</script>
</html>
