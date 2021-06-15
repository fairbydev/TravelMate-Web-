<?php
  date_default_timezone_set('Asia/Seoul');
  session_start();
  require_once("../dbconfig.php");

  //세션 정보
  $is_login = $_SESSION['is_login'];  //로그인 엽
  $id = $_SESSION['id'];    //사용자 id
  $nickname = $_SESSION['nickname'];  //사용자 닉네임

	//$_GET['bno']이 있을 때만 $bno 선언, 없는 경우는 새글을 작성할 때임
	if(isset($_GET['bno'])) {
		$bNo = $_GET['bno'];
	}

  //페이지
  $page = $_GET['page'];
  if(empty($page)){
    $page = 1;
  }

	if(isset($bNo)) { // 수정의 경우

		$sql = 'select bbs_title, bbs_password, bbs_content, bbs_nickname from reviewBoard where bbs_no = ' . $bNo;
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

    // 예외처리 1. 비회원이 회원의 글을 수정 못하게 해야함 2. 로그인할 경우 다른 회원의 글에서 수정/삭제 버튼이 나타나지 않으므로 문제 없음

    if(isset($nickname) && ($nickname !== $row['bbs_nickname'])){ // 수정하고자 하는 글의 작성닉네임과 로그인 된 회원이 불일치 하는 경우
      ?>
      <script>
          alert("비정상적 접근으로 목록페이지로 돌아갑니다.");
          window.location.replace('http://192.168.56.101/reviewBoard/board/index.php');
      </script>
      <?php
    }
	}


?>
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


  .wrap-content{
    min-height: 150%;

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
          ?>

        </ul>
      </div>
    </div>
  </nav>

  <div class="jumbotron text-center">
    <h1>REVIEW BOARD</h1>
    <p>여러분이 경험한 여행에 대한 정보를 자유롭게 공유하세요!</p>
  </div>


<br/><br/><br/><br/>

  <div class="col-md-8 col-md-offset-2">
    <article class="boardArticle" width="100%">
      <!-- <h3>자유게시판 글쓰기</h3> -->
      <div id="boardWrite">
        <form action="./write_update.php" method="post">
          <!-- //페이지 히든 값 -->
          <input type="hidden" name="page" class="form-control" value="<?php echo $page ?>">
          <!-- 새글 등록/ 수정/ 삭제 메뉴 창은 유지한 채 로그인이 안된 경우 실행방지를 위한 히든값 -->
          <?php
          if(!isset($_SESSION['is_login']) || !isset($_SESSION['nickname'])) {
            ?>
          <input type="hidden" name="whetherNickSession" id="whetherNickSession" class="form-control" value="true">
          <?php
          }
          ?>

          <?php
          if(isset($bNo)) {
            echo '<input type="hidden" name="bno" value="' . $bNo . '">';
          }
          ?>
          <table id="boardWrite" border="1" width="100%">
            <!-- <caption class="readHide">자유게시판 글쓰기</caption> -->
            <tbody>
              <tr>
                <th scope="row"><label for="bID">닉네임</label></th>
                <td class="id">
                  <?php
                  if(isset($bNo)) { // 1. 글 수정 ( 회원/비회원 동일)
                    echo $row['bbs_nickname'];
                  }else{
                    if($is_login !== true){ //2-1. 새글 작성일 경우 & 비회원 작성 시
                  ?>
                      <input type="text" name="bID" id="bID" class="form-control" placeholder="비회원의 경우 입력 닉네임 뒤에 '(비회원)'이 붙어 표시됩니다.">
                  <?php
                    }else if($is_login === true & isset($nickname)){  // 2-2. 새글 작성 & 회원 로그인 상태로 작성시
                      echo $nickname;
                      ?>
                      <input type="hidden" name="bID" id="bID" class="form-control" value="<?php echo $nickname ?>">
                      <?php
                    }
                   }
                  ?>
                </td>
              </tr>
              <?php
              if(isset($bNo)) { // 기존 글 수정
                if($is_login === true){ // 1-1. 글 수정 (회원 => 사용자의 비밀번호 입력이 필요없음). 회원의 경우 모든 자신의 게시물 비밀번호는 아이디(아이디는 외부에 노출되지 않아 연상하기 힘듦)
              ?>
                <input type="hidden" name="bPassword" class="form-control" value="<?php echo $_SESSION['id'] ?>">
                 <!-- 회원이 로그인한 상태에서 작업한 것임을 알림 -->
                <input type="hidden" name="memberWriting" class="form-control" value="true">
              <?php
                }else if($is_login !== true){ // 1-2. 글 수정 (비회원 => 비밀번호 입력이 필요)
              ?>
                  <tr>
                    <th scope="row"><label for="bPassword">비밀번호</label></th>
                    <td class="password"><input type="password" name="bPassword" id="bPassword" class="form-control" placeholder="글 작성 시에 입력한 비밀번호를 입력하세요."></td>
                  </tr>
              <?php
                }
                // 표시할 내용 없음
              }else{ // 새글 작성
                if(isset($_SESSION['is_login']) && isset($_SESSION['id']) && $is_login === true){ // 1-1. 새글 작성 (회원 => 비밀번호 입력이 필요없음). 회원의 경우 모든 자신의 게시물 비밀번호는 아이디(아이디는 외부에 노출되지 않음)
                  ?>
                    <input type="hidden" name="bPassword" value="<?php echo $id ?>">
                     <!-- 회원이 로그인한 상태에서 작업한 것임을 알림 -->
                    <input type="hidden" name="memberWriting" class="form-control" value="true">
                  <?php
                }else if($is_login !== true){ // 1-2. 새글 작성 (비회원 => 비밀번호 입력이 필요)
              ?>
                  <tr>
                    <th scope="row"><label for="bPassword">비밀번호</label></th>
                    <td class="password"><input type="password" name="bPassword" id="bPassword" class="form-control" placeholder="비밀번호는 향후 해당 게시물의 수정 및 삭제에 필요합니다."></td>
                  </tr>
              <?php
                }
              } ?>
              <tr>
                <th scope="row"><label for="bTitle">제목</label></th>
                <td class="title"><input type="text" name="bTitle" id="bTitle" value="<?php echo isset($row['bbs_title'])?$row['bbs_title']:null?>" class="form-control"></td>
              </tr>
              <tr>
                <th scope="row"><label for="bContent">내용</label></th>
                <td class="content"><textarea name="bContent" id="bContent" style="width:100%;border:1;overflow:visible;text-overflow:ellipsis;" rows=15><?php echo isset($row['bbs_content'])?$row['bbs_content']:null?></textarea></td>
              </tr>
            </tbody>
          </table>
          <div class="col-md-offset-9" style="margin-top: 5px">
            <button type="submit" class="btnSubmit btn col-md-6 btn-primary">
              <?php echo isset($bNo)?'수정':'작성'?>
            </button>
            <a href="./index.php" style="color:white" class="btn col-md-6 btn-info">목록</a>
          </div>
        </form>
      </div>
    </article>
  </div>



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
