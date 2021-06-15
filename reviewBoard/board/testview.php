<?php
session_start();

require_once("../dbconfig.php");
$bNo = $_GET['bno'];
$page = $_GET['page'];
if(empty($page)){
  $page = 1;
}

if(!empty($bNo) && empty($_COOKIE['board_free_' . $bNo])) {
  $sql = 'update reviewBoard set bbs_hit = bbs_hit + 1 where bbs_no = ' . $bNo;
  $result = $conn->query($sql);
  if(empty($result)) {
    ?>
    <script>
      alert('오류가 발생했습니다.');
      history.back();
    </script>
    <?php
  } else {
    setcookie('board_free_' . $bNo, TRUE, time() + (60 * 60 * 24), '/');
  }
}

$sql = 'select bbs_title, bbs_content, bbs_date, bbs_hit, bbs_nickname from reviewBoard where bbs_no = ' . $bNo;
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

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
        <a class="navbar-brand" href="../../main.php">TRAVEL MATE</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="../../intro/introMain.php">ABOUT</a></li>
          <li><a href="../../travelMenu/travelList.php">NEW TRAVELS</a></li>
          <li><a href="./index.php">REVIEW BOARD</a></a></li>


          <?php
          if(!isset($_SESSION['is_login']) || !isset($_SESSION['nickname'])) {
            echo '<li><a href="../../logIn/logIn.php">로그인</a></li>';
            echo '<li><a href="../../signIn/signInInput.html">회원가입</a></li>';
          }else{
            echo '<li><a href="../../mypage/mypage.php">나의 정보</a></li>';
            echo '<li><a href="../../logIn/logOut.php">로그아웃</a></li>';
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
    <h1>REVIEW BOARD</h1>
    <p>여러분이 경험한 여행에 대한 정보를 자유롭게 공유하세요!</p>
  </div>


<br/><br/>


<article border="1">
  <!-- <h3>자유게시판 글쓰기</h3> -->
  <div>
    <h3 id="boardTitle"><?php echo $row['bbs_title']?></h3>
    <div id="boardInfo">
      <span id="boardID">작성자: <?php echo $row['bbs_nickname']?></span>
      <span id="boardDate">작성일: <?php echo $row['bbs_date']?></span>
      <span id="boardHit">조회: <?php echo $row['bbs_hit']?></span>
    </div>
    <div id="boardContent"><?php echo $row['bbs_content']?></div>
    <div class="btnSet">
      <a href="./write.php?bno=<?php echo $bNo?>">수정</a>
      <a href="./delete.php?bno=<?php echo $bNo?>">삭제</a>
      <!-- <a href="./index.php">목록</a> -->
      <form action="./index.php" method="get">
        <input type="hidden" name="page" value="<?echo $page?>">
        <input type="submit" value="목록">
      </form>
    </div>
  <div>
    <?php require_once('./comment.php') ?>
  </div>
  </div>
</article>



  <br/><br/><br/><br/>
  <hr/>
  <div class="col-md-12">
    <footer class="container-fluid text-center">
      <p class="text-center">
          <small><strong> 트래블메이트</strong></small><br>
          <small>대표 : 박재홍 ㆍ 주소 :  남성역 3번출구 ㆍ 전화 : 010-3056-0002</small><br>
          <small>Copyrightⓒ TEAMNOVA All rights reserved.</small>
      </p>
    </footer>
  </div>


</body>
</html>
