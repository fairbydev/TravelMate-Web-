<?php
date_default_timezone_set('Asia/Seoul');

  session_start();
  require_once("../dbconfig.php");

	/* 페이징 시작 */
	// 페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.
	if(isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	}



  // get을 통한 지역별 검색
  	// if(isset($_GET['areaSelect']) && $_GET['previousPage'] == 'main') {
  	// 	$searchText = $_GET['areaSelect'];
  	// 	$subString .= '&amp;searchText=' . $searchText;
    //
    //   $searchColumn = 'posting_locationCode';
    //   $subString .= '&amp;searchColumn=' . $searchColumn;
    //
    //   if($_GET['areaSelect'] == '-전체-'){
    //     	$searchSql = '';
    //   }
    //
  	// }

	/* 검색 시작 */

	if(isset($_GET['searchColumn'])) {
		$searchColumn = $_GET['searchColumn'];
		$subString .= '&amp;searchColumn=' . $searchColumn;
	}
	if(isset($_GET['searchText'])) {
		$searchText = $_GET['searchText'];
		$subString .= '&amp;searchText=' . $searchText;
	}

	if(isset($searchColumn) && isset($searchText)) {
		$searchSql = ' where ' . $searchColumn . ' like "%' . $searchText . '%"';
	} else {
		$searchSql = '';
	}

  if($searchText == "-전체-") {
		$searchSql = '';
	}



	/* 검색 끝 */

	$sql = 'select count(*) as cnt from travelBoard' . $searchSql;
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();

	$allPost = $row['cnt']; //전체 게시글의 수

	if(empty($allPost)) {
		$emptyData = '<tr><td class="textCenter" colspan="5">글이 존재하지 않습니다.</td></tr>';
	} else {

		$onePage = 9; // 한 페이지에 보여줄 게시글의 수.
		$allPage = ceil($allPost / $onePage); //전체 페이지의 수

		if($page < 1 && $page > $allPage) {
?>
			<script>
				alert("존재하지 않는 페이지입니다.");
				history.back();
			</script>
<?php
			exit;
		}

		$oneSection = 10; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)
		$currentSection = ceil($page / $oneSection); //현재 섹션
		$allSection = ceil($allPage / $oneSection); //전체 섹션의 수

		$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지

		if($currentSection == $allSection) {
			$lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
		} else {
			$lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지
		}

		$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
		$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.

		$paging = '<ul class="pagination">'; // 페이징을 저장할 변수

		//첫 페이지가 아니라면 처음 버튼을 생성
		if($page != 1) {
			$paging .= '<li class="page page_start"><a href="./travelList.php?page=1' . $subString . '">처음</a></li>';
		}
		//첫 섹션이 아니라면 이전 버튼을 생성
		if($currentSection != 1) {
			$paging .= '<li class="page page_prev"><a href="./travelList.php?page=' . $prevPage . $subString . '">이전</a></li>';
		}

		for($i = $firstPage; $i <= $lastPage; $i++) {
			if($i == $page) {
				// $paging .= '<li class="page active">' . $i . '</li>';
        $paging .= '<li class="page active"><a href="./travelList.php?page=' . $i . $subString . '">' . $i . '</a></li>';
			} else {
				$paging .= '<li class="page"><a href="./travelList.php?page=' . $i . $subString . '">' . $i . '</a></li>';
			}
		}

		//마지막 섹션이 아니라면 다음 버튼을 생성
		if($currentSection != $allSection) {
			$paging .= '<li class="page page_next"><a href="./travelList.php?page=' . $nextPage . $subString . '">다음</a></li>';
		}

		//마지막 페이지가 아니라면 끝 버튼을 생성
		if($page != $allPage) {
			$paging .= '<li class="page page_end"><a href="./travelList.php?page=' . $allPage . $subString . '">끝</a></li>';
		}
		$paging .= '</ul>';

		/* 페이징 끝 */


		$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
		$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문

		$sql = 'select * from travelBoard' . $searchSql . ' order by pno desc' . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
		$result = $conn->query($sql);



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
  a.no-uline { text-decoration:none }

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
  min-height: 200%;

}

//footer

footer .glyphicon {
    font-size: 20px;
    margin-bottom: 20px;
    color: #f4511e;
}
footer{margin-top:90.9em;height:1.9em}


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
    <h1>트래블 리스트</h1>
    <p>새로운 여행을 제안하고, 다른 메이트들의 여행에 참가할 수 있습니다.</p>

    <form role="form" id="form" method="get" action="travelList.php">
      <div>
        <!-- <select class="selectpicker show-tick show-menu-arrow" name="countrySelect" id="countrySelect" data-width="auto">
          <option value="국내여행" selected="selected">국내여행</option>
          <option value="해외여행">해외여행</option>
        </select> -->
        <select class="selectpicker show-tick show-menu-arrow" data-container="body" name="searchText" id="areaSelect" data-width="auto">
          <option>-전체-</option>
          <option>서울</option>
          <option>경기도</option>
          <option>충청도</option>
          <option>강원도</option>
          <option>전라도</option>
          <option>경상도</option>
          <option>제주도</option>
        </select>
        <input type="hidden" name="searchColumn" class="form-control" value="posting_locationCode">
        <button type="submit" class="btn btn-danger">여행검색</button>
      </div>
    </form>
  </div>
  <!-- //점보트론 끝 -->



<div class="wrap-content">

      <div>
        <br/><br/>
        <div class="col-md-8 col-md-offset-2">
          <div class="row">
            <?php
            if(isset($emptyData)) {
              echo $emptyData;
            } else {
              while($row = $result->fetch_assoc())
              {
            ?>
                  <div class="col-md-4">
                    <div class="column">
                      <!-- Post-->
                      <div class="post-module">
                        <!-- Thumbnail-->
                        <div class="thumbnail" >
                          <!-- <div class="date"> <a href="#0">
                            <div class="day"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            </a> </div> -->

                          <?php if($row['posting_pic'] == ''){
                            ?>
                            <img src="../images/uploads/enhancement.jpg" class="img-responsive" alt="defaultImg"> </div>
                            <?php
                          }else{
                            ?>
                            <img src="<?php echo $row['posting_pic']?>" class="img-responsive" alt="../images/communication.jpg"> </div>
                            <?php
                          } ?>



                        <!-- Post Content-->
                        <div class="post-content">
                          <div class="category"><?php echo $row['posting_locationCode']?></div>
                          <a href="./travel_view.php?pno=<?php echo $row['pno']?>&amp;page=<?php echo $page?>" style="text-decoration:none"><h1 class="title"><?php echo $row['posting_title']?></h1></a></a>
                          <a href="./travel_view.php?pno=<?php echo $row['pno']?>&amp;page=<?php echo $page?>" style="text-decoration:none"><h2 class="sub_title"><?php echo $row['posting_subtitle']?></h2></a>
                          <a href="./travel_view.php?pno=<?php echo $row['pno']?>&amp;page=<?php echo $page?>" style="text-decoration:none"><p class="description"><?php echo $row['posting_content']?></p></a>
                          <div class="post-meta"><span class="timestamp"><i class="fa fa-clock-"><?php echo $row['posting_hit']?>hits</i></span></div>
                      </div>
                    </div>
                  </div>
                </div>
            <?php
              }
            }
            ?>
            </div>
          </div>
        </div>

  </div><!-- wrap-content 끝 -->

  <div class="col-md-1 col-md-offset-9">
      <br/><br/>
    <div class="btnSet">
      <a href="./travel_write.php" class="btnWrite btn">글쓰기</a>
    </div>
  </div>
  <div class="col-md-6 col-md-offset-4">
    <div class="paging">
      <?php echo $paging ?>
    </div>
    <div class="searchBox">
      <form action="./travelList.php" method="get">
        <select name="searchColumn">
          <option <?php echo $searchColumn=='posting_title'?'selected="selected"':null?> value="posting_title">주제</option>
          <option <?php echo $searchColumn=='posting_content'?'selected="selected"':null?> value="posting_content">내용</option>
          <option <?php echo $searchColumn=='nickname'?'selected="selected"':null?> value="nickname">작성자</option>
        </select>
        <input type="text" name="searchText" value="<?php echo isset($searchText)?$searchText:null?>">
        <button type="submit">검색</button>
      </form>
    </div>
  </div>




  <div>
    <footer class="container-fluid text-center">
      <p class="text-center">
          <br/><br/>
          <hr/>
          <small><strong> 트래블메이트</strong></small><br>
          <small>대표 : JH PARK ㆍ 주소 :  SEOUL, KOREA ㆍ 전화 : 010-777-7777</small><br>
          <small>Copyrightⓒ JH Corp. All rights reserved.</small>
      </p>
    </footer>
  </div>



</body>







<script>
$("#countrySelect").change(function(){
      //alert($(this).val());
      //alert($(this).children("option:selected").text());
    if($(this).val() == "해외여행"){
      //alert($("#areaSelect").val());
      $("#areaSelect").html("<option>-전체-</option> <option>동남아/대만/서남아</option> <option>중국/홍콩</option> <option>일본</option> <option>남태평양</option> <option>유럽/아프리카</option> <option>미주/중남미/하와이</option>");
      //$("#areaSelect").selectmenu("refresh", true);
      $("#areaSelect").selectpicker("refresh", true); //selectmenu가 아니라 selectpicker로 해줘야 정상작동함s

    }else if($(this).val() == "국내여행"){
      $("#areaSelect").html("<option>-전체-</option> <option>서울</option> <option>경기도</option> <option>충청도</option> <option>강원도</option> <option>전라도</option> <option>경상도</option> <option>제주도</option>");
      //$("#areaSelect").selectmenu("refresh", true);
      $("#areaSelect").selectpicker("refresh", true); //selectmenu가 아니라 selectpicker로 해줘야 정상작동함s
    }
});


  //card
    $('.post-module').hover(function() {
      $(this).find('.description').stop().animate({
        height: "toggle",
        opacity: "toggle"
      }, 300);
    });

    //여행클릭
    // $(function(){
    //   $('#travelThumbnail'+'<?php echo $row['pno']?>').click(function(){
    //
    //         location.href = "travel_view.php?pno=" + $('#getpnno'+'<?php echo $row['pno']?>').val();
    //     });
    // });




</script>
</html>
