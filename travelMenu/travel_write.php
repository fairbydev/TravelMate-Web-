<?php
  date_default_timezone_set('Asia/Seoul');
  session_start();
  require_once("./dbconfig.php");

  //세션 정보
  $is_login = $_SESSION['is_login'];  //로그인 엽
  $id = $_SESSION['id'];    //사용자 id
  $nickname = $_SESSION['nickname'];  //사용자 닉네임

	//$_GET['pno']이 있을 때만 $pno 선언, 없는 경우는 새글을 작성할 때임
	if(isset($_GET['pno'])) {
		$pno = $_GET['pno'];
	}

  //페이지
  $page = $_GET['page'];
  if(empty($page)){
    $page = 1;
  }

	if(isset($pno)) { // 수정의 경우

		$sql = 'select nickname, posting_password, posting_title, posting_subtitle, posting_ddate, posting_rdate, posting_expireDate,
            posting_locationCode, posting_place, posting_gender, posting_maxperson, posting_contact, posting_content, posting_pic, posting_hit from travelBoard where pno = ' . $pno;
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

    // 예외처리 1. 비회원이 회원의 글을 수정 못하게 해야함 2. 로그인할 경우 다른 회원의 글에서 수정/삭제 버튼이 나타나지 않으므로 문제 없음

    if(isset($nickname) && ($nickname !== $row['nickname'])){ // 수정하고자 하는 글의 작성닉네임과 로그인 된 회원이 불일치 하는 경우
      ?>
      <script>
          alert("비정상적 접근으로 목록페이지로 돌아갑니다.");
          window.location.replace('http://192.168.56.101/travelMenu/travelList.php');
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
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- 셀렉트박스 부트스트랩 -->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

  <!-- (Optional) Latest compiled and minified JavaScript translation files -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/i18n/defaults-*.min.js"></script>

  //card
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">



  <title>TravelMate Homepage</title>
  <style>
  .jumbotron {
      background-color: #f4511e;
      color: #fff;
      padding: 100px 0px;
      font-family: Montserrat, sans-serif;
      margin-bottom: 0px;
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



//card

.post-module {
  position: relative;
  z-index: 1;
  display: block;
  background: #FFFFFF;
  min-width: 270px;
  height: 350px;
  -webkit-box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.15);
  -moz-box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.15);
  box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.15);
  -webkit-transition: all 0.3s linear 0s;
  -moz-transition: all 0.3s linear 0s;
  -ms-transition: all 0.3s linear 0s;
  -o-transition: all 0.3s linear 0s;
  transition: all 0.3s linear 0s;
}
.post-module:hover,
.hover {
  -webkit-box-shadow: 0px 1px 35px 0px rgba(0, 0, 0, 0.3);
  -moz-box-shadow: 0px 1px 35px 0px rgba(0, 0, 0, 0.3);
  box-shadow: 0px 1px 35px 0px rgba(0, 0, 0, 0.3);
}
.post-module:hover .thumbnail img,
.hover .thumbnail img {
  -webkit-transform: scale(1.1);
  -moz-transform: scale(1.1);
  transform: scale(1.1);
  opacity: .6;
}
.post-module .thumbnail {
  background: #000000;
  height: 350px;
  overflow: hidden;padding: 0;
}
.post-module .thumbnail .date {
  position: absolute;
  top: 20px;
  right: 20px;
  z-index: 1;
  background: #f2b202;
  width: 55px;
  height: 55px;
  padding: 12.5px 0;
  -webkit-border-radius: 100%;
  -moz-border-radius: 100%;
  border-radius: 100%;
  color: #FFFFFF;
  font-weight: 700;
  text-align: center;
  -webkti-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
.post-module .thumbnail .date .day {
 font-size: 18px;
    line-height: 31px;
    color: #fff;
}
.post-module .thumbnail .date .month {
  font-size: 12px;
  text-transform: uppercase;
}
.post-module .thumbnail img {
  display: block;
  width: 120%;
  -webkit-transition: all 0.3s linear 0s;
  -moz-transition: all 0.3s linear 0s;
  -ms-transition: all 0.3s linear 0s;
  -o-transition: all 0.3s linear 0s;
  transition: all 0.3s linear 0s;
}
.post-module .post-content {
  position: absolute;
  bottom: 0;
  background: #FFFFFF;
  width: 100%;
    padding: 0 30px;
  -webkti-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-transition: all 0.3s cubic-bezier(0.37, 0.75, 0.61, 1.05) 0s;
  -moz-transition: all 0.3s cubic-bezier(0.37, 0.75, 0.61, 1.05) 0s;
  -ms-transition: all 0.3s cubic-bezier(0.37, 0.75, 0.61, 1.05) 0s;
  -o-transition: all 0.3s cubic-bezier(0.37, 0.75, 0.61, 1.05) 0s;
  transition: all 0.3s cubic-bezier(0.37, 0.75, 0.61, 1.05) 0s;
}
.post-module .post-content .category {
  position: absolute;
  top: -34px;
  left: 0;
  background: #f2b202;
  padding: 10px 15px;
  color: #FFFFFF;
  font-size: 14px;
  font-weight: 600;
  text-transform: uppercase;
}
.post-module .post-content .title {
  margin: 0;
  padding: 0 0 10px;
  color: #222 !important;
  font-size: 24px !important;
  font-weight: 700;    margin: 40px 0 0 !important;
}
.post-module .post-content .sub_title {
  margin: 0;
  padding: 0 0 20px;
  color: #f2b202;
  font-size: 20px;
  font-weight: 400;
}
.post-module .post-content .description {
  display: none;
  color: #666666;
  font-size: 14px;
  line-height: 1.8em;
}
.post-module .post-content .post-meta {
  margin: 0px 0px 10px;
  color: #999999;
}
.post-module .post-content .post-meta .timestamp {
  margin: 0 16px 0 0;
}
.post-module .post-content .post-meta a {
  color: #999999;
  text-decoration: none;
}
.hover .post-content .description {
  display: block !important;
  height: auto !important;
  opacity: 1 !important;
}

.container .column {
     width: 100%;
    /* padding: 0 25px; */
    -webkti-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    float: left;
}
.container .column .demo-title {
  margin: 0 0 15px;
  color: #666666;
  font-size: 18px;
  font-weight: bold;
  text-transform: uppercase;
}
.container .info {
  width: 300px;
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 24px;
  font-weight: bold;
  color: #333333;
}
.container .info span {
  color: #666666;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #f2b202;
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
footer{margin-top:50.9em;height:1.9em}


  </style>

</head>
<body>
  <!-- //네비게이션바 시작 -->
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
          <li><a href="travelList.php">NEW TRAVELS</a></li>
          <li><a href="../reviewBoard/board/index.php">REVIEW BOARD</a></li>
          <!-- 세션확인 후 메뉴 페이지 변경 -->
          <?php
          if(!isset($_SESSION['is_login']) || !isset($_SESSION['nickname'])) {
            echo '<li><a href="../logIn/logIn.php">로그인</a></li>';
            echo '<li><a href="../signIn/signInInput.php">회원가입</a></li>';
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
  <!-- //네비게이션바 끝 -->

  <!-- //점보트론 -->
  <div class="jumbotron text-center">
    <h1>트래블 리스트 등록</h1>
    <p>당신의 메이트들에게 새로운 여행을 제안해 보세요!</p>
  </div>
  <!-- //점보트론 끝 -->

  <br/><br/>

<div class="wrap-content">
    <div class="col-md-8 col-md-offset-2">
      <article class="boardArticle" width="100%">
        <!-- <h3>자유게시판 글쓰기</h3> -->
        <div id="boardWrite">
          <form action="./travel_write_update.php" method="post"  enctype="multipart/form-data">
            <!-- //페이지 히든 값 -->
            <input type="hidden" name="page" class="form-control" value="<?php echo $page ?>">
            <!-- 새글 등록/ 수정/ 삭제 메뉴 창은 유지한 채 로그인이 안된 경우 실행방지를 위한 히든값 -->

            <input type="hidden" name="whetherNickSession" id="whetherNickSession" class="form-control" value="true">

            <?php
            if(isset($pno)) {
              echo '<input type="hidden" name="pno" value="' . $pno . '">';
            }
            ?>
            <table id="boardWrite" border="1" width="100%">
              <!-- <caption class="readHide">캡션 쓰는 곳</caption> -->
              <tbody>
                    <?php
                    if(isset($pno)) { // 1. 글 수정
                      //echo $row['bbs_nickname'];
                    }else{  // 2. 새글작성
                        //echo $nickname;
                        ?>
                        <input type="hidden" name="nickname" id="nickname" class="form-control" value="<?php echo $nickname ?>">
                        <?php
                     }
                    ?>
                <?php
                if(isset($pno)) { // 기존 글 수정
                    // 1-1. 글 수정 (회원 => 사용자의 비밀번호 입력이 필요없음). 회원의 경우 모든 자신의 게시물 비밀번호는 아이디(아이디는 외부에 노출되지 않아 연상하기 힘듦)
                ?>
                  <input type="hidden" name="posting_password" class="form-control" value="<?php echo $_SESSION['id'] ?>">
                   <!-- 회원이 로그인한 상태에서 작업한 것임을 알림 -->
                  <input type="hidden" name="memberWriting" class="form-control" value="true">

                  <tr>
                    <th scope="row"><label for="posting_title">사진</label></th>
                    <td class="posting_pic"><input type="file" name="posting_pic" id="posting_pic" class="form-control"></td>
                  </tr>


                <?php
                  // 표시할 내용 없음
                }else{ // 새글 작성 (회원 => 비밀번호 입력이 필요없음). 회원의 경우 모든 자신의 게시물 비밀번호는 아이디(아이디는 외부에 노출되지 않음)
                    ?>
                      <input type="hidden" name="posting_password" value="<?php echo $id ?>">
                       <!-- 회원이 로그인한 상태에서 작업한 것임을 알림 -->
                      <input type="hidden" name="memberWriting" class="form-control" value="true">
                      <tr>
                        <th scope="row"><label for="posting_title">사진</label></th>
                        <td class="posting_pic"> <input type="file" name="posting_pic" id="posting_pic" class="form-control"></td>
                      </tr>
                    <?php
                } ?>


                <!-- <tr>
                  <th scope="row"><label for="posting_title">사진</label></th>
                  <td class="posting_title">    <input type="file" name="posting_pic" id="posting_pic" class="form-control"></td>
                </tr> -->


                <tr>
                  <th scope="row"><label for="posting_title">주제</label></th>
                  <td class="posting_title"><input type="text" name="posting_title" id="posting_title" placeholder="간단한 여행의 주제를 적어주세요." value="<?php echo isset($row['posting_title'])?$row['posting_title']:null?>" class="form-control"></td>
                </tr>

                <tr>
                  <th scope="row"><label for="posting_subtitle">부제</label></th>
                  <td class="posting_subtitle"><input type="text" name="posting_subtitle" id="posting_subtitle" placeholder="주제를 설명하는 한 줄 글을 적어주세요." value="<?php echo isset($row['posting_subtitle'])?$row['posting_subtitle']:null?>" class="form-control"></td>
                </tr>


                <tr>
                  <th scope="row"><label for="bTitle">여행기간</label></label></th>
                  <td class="date">출발일<input type="date" name="posting_ddate" min="<?php echo Date('Y-m-d') ?>" id="posting_ddate" value="<?php echo isset($row['posting_ddate'])?$row['posting_ddate']:null?>" class="form-control">
                  복귀일<input type="date" name="posting_rdate" min="<?php echo Date('Y-m-d') ?>" id="posting_rdate" value="<?php echo isset($row['posting_rdate'])?$row['posting_rdate']:null?>" class="form-control"></td>
                </tr>


                <tr>
                  <th scope="row"><label for="posting_expireDate">모집마감일</label></label></th>
                  <td class="posting_expireDate"><input type="date" name="posting_expireDate" min="<?php echo Date('Y-m-d') ?>"  id="posting_expireDate" value="<?php echo isset($row['posting_expireDate'])?$row['posting_expireDate']:null?>" class="form-control"></td>
                </tr>


                <tr>
                  <th scope="row"><label for="posting_locationCode">여행지역 분류</label></th>
                  <td class="posting_locationCode">
                    <select class="form-control" id="posting_locationCode" name="posting_locationCode">
                        <option value="서울">서울</option>
                        <option value="경기도">경기도</option>
                        <option value="충청도">충청도</option>
                        <option value="강원도">강원도</option>
                        <option value="전라도">전라도</option>
                        <option value="경상도">경상도</option>
                        <option value="제주도">제주도</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <th scope="row"><label for="posting_place">세부 목표여행지</label></th>
                  <td class="posting_place"><input type="text" name="posting_place" id="posting_place" placeholder="여행 장소에 대한 세부주소를 적어주세요." value="<?php echo isset($row['posting_place'])?$row['posting_place']:null?>" class="form-control"></td>
                </tr>

                <tr>
                  <th scope="row"><label for="posting_gender">성별제한</label></th>
                  <td class="posting_gender">
                    <select class="form-control" id="posting_gender" name="posting_gender">
                        <option value="N">성별무관</option>
                        <option value="M">남성만</option>
                        <option value="F">여성만</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <th scope="row"><label for="posting_maxperson">여행인원</label></th>
                  <td class="posting_maxperson">
                    <select class="form-control" id="posting_maxperson" name="posting_maxperson">
                        <option value="2">2명</option>
                        <option value="3">3명</option>
                        <option value="4">4명</option>
                        <option value="5">5명</option>
                        <option value="6">6명</option>
                        <option value="7">7명</option>
                        <option value="8">8명</option>
                        <option value="9">9명</option>
                        <option value="10">10명</option>
                    </select>
                  </td>
                </tr>


                <tr>
                  <th scope="row"><label for="posting_contact">연락처</label></th>
                  <td class="posting_contact"><input type="text" name="posting_contact" id="posting_contact" placeholder="메이트들로부터 연락받을 메일주소를 적어주세요." value="<?php echo isset($row['posting_contact'])?$row['posting_contact']:null?>" class="form-control"></td>
                </tr>


                <tr>
                  <th scope="row"><label for="posting_content">내용 및 세부계획</label></th>
                  <td class="posting_content"><textarea name="posting_content" id="posting_content" placeholder="여행의 세부계획에 대한 정보를 입력해주세요." style="width:100%;border:1;overflow:visible;text-overflow:ellipsis;" rows=8><?php echo isset($row['posting_content'])?$row['posting_content']:null?></textarea></td>
                </tr>



              </tbody>



            </table>
            <div class="col-md-offset-9" style="margin-top: 5px">
              <button type="submit" class="btnSubmit btn col-md-6 btn-primary">
                <?php echo isset($pno)?'수정':'등록'?>
              </button>
              <a href="./travelList.php" style="color:white" class="btn col-md-6 btn-info">목록</a>
            </div>
          </form>
        </div>
      </article>
    </div>

  <br/><br/><br/><br/>

  <div>
    <footer class="container-fluid text-center">
      <p class="text-center">
          <hr/>
          <small><strong> 트래블메이트</strong></small><br>
          <small>대표 : 박재홍 ㆍ 주소 :  남성역 3번출구 ㆍ 전화 : 010-3056-0002</small><br>
          <small>Copyrightⓒ TEAMNOVA All rights reserved.</small>
      </p>
    </footer>
  </div>
</div>


</body>







<script>
// $("#countrySelect").change(function(){
//       //alert($(this).val());
//       //alert($(this).children("option:selected").text());
//     if($(this).val() == "해외여행"){
//       //alert($("#areaSelect").val());
//       $("#areaSelect").html("<option>-전체-</option> <option>동남아/대만/서남아</option> <option>중국/홍콩</option> <option>일본</option> <option>남태평양</option> <option>유럽/아프리카</option> <option>미주/중남미/하와이</option>");
//       //$("#areaSelect").selectmenu("refresh", true);
//       $("#areaSelect").selectpicker("refresh", true); //selectmenu가 아니라 selectpicker로 해줘야 정상작동함s
//
//     }else if($(this).val() == "국내여행"){
//       $("#areaSelect").html("<option>-전체-</option> <option>서울</option> <option>경기도</option> <option>충청도</option> <option>강원도</option> <option>전라도</option> <option>경상도</option> <option>제주도</option>");
//       //$("#areaSelect").selectmenu("refresh", true);
//       $("#areaSelect").selectpicker("refresh", true); //selectmenu가 아니라 selectpicker로 해줘야 정상작동함s
//     }
// });
//
//
//   //card
//     $('.post-module').hover(function() {
//       $(this).find('.description').stop().animate({
//         height: "toggle",
//         opacity: "toggle"
//       }, 300);
//     });

</script>
</html>
