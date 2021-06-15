<?php
  session_start();
  date_default_timezone_set('Asia/Seoul');

  //세션 정보
  $is_login = $_SESSION['is_login'];  //로그인 여부
  $id = $_SESSION['id'];    //사용자 id
  $nickname = $_SESSION['nickname'];  //사용자 닉네임

  require_once("../dbconfig.php");
	$pno = $_GET['pno'];
  $page = $_GET['page'];
  if(empty($page)){
    $page = 1;
  }


  //조회 수 중복 방지용 쿠키
  $date = date('Y-m-d');
  if(empty($nickname)){
    if(!empty($pno) && empty($_COOKIE['trevel_board_free_' .$pno.$date])) {
      $sql = 'update travelBoard set posting_hit = posting_hit + 1 where pno = ' . $pno;
      $result = $conn->query($sql);
      if(empty($result)) {
        ?>
        <script>
          alert('오류가 발생했습니다.1');
          history.back();
        </script>
        <?php
      } else {
        setcookie('trevel_board_free_' .$pno.$date, TRUE, time() + (60 * 60 * 24), '/');
      }
    }
  }else if(!empty($nickname)){
    if(!empty($pno) && empty($_COOKIE['trevel_board_free_' .$pno.$date.$nickname])) {
      $sql = 'update travelBoard set posting_hit = posting_hit + 1 where pno = ' . $pno;
      $result = $conn->query($sql);
      if(empty($result)) {
        ?>
        <script>
          alert('오류가 발생했습니다.2');
          history.back();
        </script>
        <?php
      } else {
        setcookie('trevel_board_free_' .$pno.$date.$nickname, TRUE, time() + (60 * 60 * 24), '/');
      }
    }
  }



	$sql = 'select nickname, posting_password, posting_title, posting_subtitle, posting_ddate, posting_rdate, posting_expireDate,
          posting_locationCode, posting_place, posting_gender, posting_maxperson, posting_contact, posting_content, posting_pic, posting_hit from travelBoard where pno = ' . $pno;
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  <meta http-equiv="X-UA-Compatible" content="ie=edge">

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
          <li><a href="../reviewBoard/board/index.php">REVIEW BOARD</a></a></li>


          <?php
          if(!isset($_SESSION['is_login']) || !isset($_SESSION['nickname'])) {
            echo '<li><a href="../../logIn/logIn.php">로그인</a></li>';
            echo '<li><a href="../../signIn/signInInput.php">회원가입</a></li>';
          }else{
            //echo '<li><a href="../../mypage/mypage.php">나의 정보</a></li>';
            echo '<li><a href="../../logIn/logOut.php">로그아웃</a></li>';
          }
          ?>

        </ul>
      </div>
    </div>
  </nav>

  <div class="jumbotron text-center">
    <h1>TRAVEL BOARD</h1>
    <p>마음에 드는 여행을 생각하고 있는 메이트에게 연락해보세요!</p>
  </div>


<br/><br/>
  <div class="col-md-8 col-md-offset-2">
    <article class="boardArticle" border="1" width="100%">
      <!-- <h3>자유게시판 글쓰기</h3> -->
      <div id="boardView">
        <div id="boardInfo">
          <h3 id="boardTitle"><?php echo '주제 : '.$row['posting_title']?></h3>
          <div style="float:right" >
            <span id="boardID">작성자: '<?php echo $row['nickname']?>',</span>
            <!-- <span id="boardDate">동행신청연락 마감일: <?php echo $row['posting_expireDate']?></span> -->
            <span id="boardHit"> 조회: <?php echo $row['posting_hit']?></span>
          </div>
          <br/>
        </div>

        <?php if($row['posting_pic'] == ''){
          ?>
          <div class="img" ><img src="../images/uploads/enhancement.jpg" class="img-responsive img-rounded" alt="defaultImg"> </div>
          <?php
        }else{
          ?>
          <div class="img" ><img src="<?php echo $row['posting_pic']?>" class="img-responsive img-rounded" alt="defaultImg"> </div>
          <?php
        } ?>

        <div> <br/><br/>
        <label><여행정보></label>
        <table class="table table-hover" border="1" width="100%" style="height: 100px; margin: auto; text-align: center;">
          <!-- <caption class="readHide">자유게시판</caption> -->
          <thead>
            <tr class="tr">
            </tr>
          </thead>
          <tbody>
              <!-- <tr>
                <td class="posting_subtitle">부제</td>
                <td class="posting_subtitle"><?php echo $row['posting_subtitle']?></td>
              </tr> -->
              <tr>
                <td class="posting_subtitle">출발일</td>
                <td class="posting_ddate"><?php echo $row['posting_ddate']?></td>
              </tr>
              <tr>
                <td class="posting_subtitle">복귀일</td>
                <td class="posting_rdate"><?php echo $row['posting_rdate']?></td>
              </tr>
              <tr>
                <td class="posting_subtitle">모집마감일</td>
                <td class="posting_rdate"><?php echo $row['posting_expireDate']?></td>
              </tr>
              <tr>
                <td class="posting_subtitle">여행장소</td>
                <td class="posting_place"><?php echo $row['posting_place']?></td>
              </tr>
              <tr>
                <td class="posting_subtitle">성별제한</td>
                <?php
                  if($row['posting_gender'] == 'F'){
                    ?>
                <td class="posting_gender">남자끼리</td>
                    <?php
                  }else if($row['posting_gender'] == 'M'){
                    ?>
                <td class="posting_gender">여자끼리</td>
                    <?php
                  }else if($row['posting_gender'] == 'N'){
                    ?>
                <td class="posting_gender">성별무관</td>
                    <?php
                  }
                 ?>
              </tr>
              <tr>
                <td class="posting_subtitle">예상 여행인원</td>
                <td class="posting_maxperson"><?php echo $row['posting_maxperson']?>명</td>
              </tr>
              <tr>
                <td class="posting_subtitle">메이트 연락처</td>

                <?php
                $date = date('Y-m-d');
                if($row['posting_expireDate'] < $date){
                  ?>
                  <td class="posting_contact">-모집마감일이 지났기 때문에 볼 수 없습니다-</td>
                  <?php
                }else{
                  if(!isset($_SESSION['is_login']) || !isset($_SESSION['nickname'])) {
                    ?>
                    <td class="posting_contact">-회원가입 후 확인 가능합니다-</td>
                    <?php
                  }else{
                    ?>
                    <td class="posting_contact"><?php echo $row['posting_contact']?></td>
                    <?php
                  }
                }
                ?>
              </tr>
          </tbody>
        </table>
      </div>


        <br/><br/>
        <label><세부정보></label>
        <div id="boardContent" class="well"><?php echo $row['posting_content']?></div>
        <hr/>


        <div class="btnSet" style="float:right">
          <?php
            if($is_login === true && $row['nickname'] === $nickname){ // 로그인한 회원이 자신의 게시물을 볼 때
          ?>
            <a href="./travel_write.php?pno=<?php echo $pno?>&amp;page=<?php echo $page?>">수정</a>
            <a href="./travel_delete.php?pno=<?php echo $pno?>">삭제</a>
          <?php
        }else if(!isset($is_login)){  //비회원이 글을 볼 때
          ?>

          <?php
          }
          ?>
          <form action="./travelList.php" method="get">
            <input type="hidden" name="page" value="<?echo $page?>">
            <input type="submit" value="목록">
          </form>
        </div>
        <br/><br/>



      </div>
    </article>

      <br/><br/><br/><br/>      <br/><br/><br/><br/>      <br/><br/><br/><br/>
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
  </div>



</body>




</html>
