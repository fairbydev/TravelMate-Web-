<?php
  session_start();

  require_once("../dbconfig.php");

  //$_GET['pno']이 있어야만 글삭제가 가능함.
	if(isset($_GET['pno'])) {
		$pno = $_GET['pno'];
	}
?>
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
            echo '<li><a href="../../signIn/signInInput.php">회원가입</a></li>';
          }else{
            //echo '<li><a href="../../mypage/mypage.php">나의 정보</a></li>';
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

<div class="col-md-2 col-md-offset-5">
  <article class="boardArticle">
    <h3>트리블리스트 글삭제</h3>
    <?php
      if(isset($pno)) {
        $sql = 'select count(pno) as cnt from travelBoard where pno = ' . $pno;
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if(empty($row['cnt'])) {
    ?>
    <script>
      alert('글이 존재하지 않습니다.');
      history.back();
    </script>
    <?php
      exit;
        }

        $sql = 'select posting_title from travelBoard where pno = ' . $pno;
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    ?>
    <div id="boardDelete">
      <form action="./travel_delete_update.php" method="post">
        <input type="hidden" name="pno" value="<?php echo $pno?>">
        <table>
          <!-- <caption class="readHide">자유게시판 글삭제</caption> -->
          <thead>
            <tr>
              <th scope="col" colspan="2"> 아래의 해당 게시물을 삭제합니다. </th>
              <br/>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">주제</th>
              <td>&nbsp;&nbsp;<?php echo $row['posting_title']?></td>
            </tr>

            <?php
            if(isset($_SESSION['is_login']) && isset($_SESSION['id'])) {
              ?>
                <input type="hidden" name="posting_password" id="posting_password" value="<?php echo $id ?>">
                <!-- 회원 로그인 상태에서 진입한 것임을 알려주는 히든값을 포스트로 넘기기 위한 인풋 -->
                <input type="hidden" name="memberWriting" class="form-control" value="true">
              <?php
            }else{
              ?>
              <script>
                alert('비정상적 접근입니다.');
                history.back();
              </script>
              <?php
            }
            ?>
          </tbody>
        </table>
        <br/><br/>
        <div class="btnSet">
          <button type="submit" class="btnSubmit btn">삭제</button>
          <a href="./travelList.php" class="btnList btn">목록</a>
        </div>
      </form>
    </div>
  <?php
    //$pno이 없다면 삭제 실패
    } else {
  ?>
    <script>
      alert('정상적인 경로를 이용해주세요.');
      history.back();
    </script>
  <?php
      exit;
    }
  ?>
  </article>
</div>
  <br/><br/>

  <div class="col-md-12">
      <br/><br/><br/><br/>  <br/><br/><br/><br/> <br/><br/><br/><br/><br/><br/>
    <footer class="container-fluid text-center">
      <p class="text-center">
        <br/><br/>
          <hr/>
          <small><strong> 트래블메이트</strong></small><br>
          <small>대표 : 박재홍 ㆍ 주소 :  남성역 3번출구 ㆍ 전화 : 010-3056-0002</small><br>
          <small>Copyrightⓒ TEAMNOVA All rights reserved.</small>
      </p>
    </footer>
  </div>


</body>


</html>
