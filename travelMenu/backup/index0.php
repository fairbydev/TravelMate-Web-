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

	/* 검색 끝 */

	$sql = 'select count(*) as cnt from reviewBoard' . $searchSql;
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();

	$allPost = $row['cnt']; //전체 게시글의 수

	if(empty($allPost)) {
		$emptyData = '<tr><td class="textCenter" colspan="5">글이 존재하지 않습니다.</td></tr>';
	} else {

		$onePage = 10; // 한 페이지에 보여줄 게시글의 수.
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
			$paging .= '<li class="page page_start"><a href="./index.php?page=1' . $subString . '">처음</a></li>';
		}
		//첫 섹션이 아니라면 이전 버튼을 생성
		if($currentSection != 1) {
			$paging .= '<li class="page page_prev"><a href="./index.php?page=' . $prevPage . $subString . '">이전</a></li>';
		}

		for($i = $firstPage; $i <= $lastPage; $i++) {
			if($i == $page) {
				// $paging .= '<li class="page active">' . $i . '</li>';
        $paging .= '<li class="page active"><a href="./index.php?page=' . $i . $subString . '">' . $i . '</a></li>';
			} else {
				$paging .= '<li class="page"><a href="./index.php?page=' . $i . $subString . '">' . $i . '</a></li>';
			}
		}

		//마지막 섹션이 아니라면 다음 버튼을 생성
		if($currentSection != $allSection) {
			$paging .= '<li class="page page_next"><a href="./index.php?page=' . $nextPage . $subString . '">다음</a></li>';
		}

		//마지막 페이지가 아니라면 끝 버튼을 생성
		if($page != $allPage) {
			$paging .= '<li class="page page_end"><a href="./index.php?page=' . $allPage . $subString . '">끝</a></li>';
		}
		$paging .= '</ul>';

		/* 페이징 끝 */


		$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
		$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문

		$sql = 'select * from reviewBoard' . $searchSql . ' order by bbs_no desc' . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
		$result = $conn->query($sql);
	}


?>>
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



.tr{
  text-align: center;
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


<br/><br/><br/><br/>

  <div class="col-md-8 col-md-offset-2">
    <article class="boardArticle">
      <!-- <h3>자유게시판</h3> -->
      <div id="boardList">
        <table border="1" width="100%">
          <!-- <caption class="readHide">자유게시판</caption> -->
          <thead>
            <tr class="tr">
              <th scope="col" class="no">번호</th>
              <th scope="col" class="title">제목</th>
              <th scope="col" class="author">작성자</th>
              <th scope="col" class="date">작성일</th>
              <th scope="col" class="hit">조회</th>
            </tr>
          </thead>
          <tbody>
              <?php
              if(isset($emptyData)) {
                echo $emptyData;
              } else {
                while($row = $result->fetch_assoc())
                {
                  $datetime = explode(' ', $row['bbs_date']);
                  $date = $datetime[0];
                  $time = $datetime[1];
                  if($date == Date('Y-m-d'))
                    $row['bbs_date'] = $time;
                  else
                    $row['bbs_date'] = $date;
              ?>
              <tr>
                <td class="no"><?php echo $row['bbs_no']?></td>
                <td class="title">
                  <!-- 조회수 처리 -->
                  <?php
                  $sqlCount = 'select count(bbs_no) as cnt from comment_free where bbs_no='.$row['bbs_no'];
                  $resultCount = $conn->query($sqlCount);
                  $rowCount = $resultCount->fetch_assoc();

                  if($rowCount['cnt'] > 0){
                    ?>
                    <a href="./view.php?bno=<?php echo $row['bbs_no']?>&amp;page=<?php echo $page?>"><?php echo $row['bbs_title'].' ['.$rowCount['cnt'].']' ?></a>
                    <?php
                  }else if($rowCount['cnt'] == 0){
                  ?>
                  <a href="./view.php?bno=<?php echo $row['bbs_no']?>&amp;page=<?php echo $page?>"><?php echo $row['bbs_title']?></a>
                  <?php
                  }
                  ?>
                </td>
                <td class="author"><?php echo $row['bbs_nickname']?></td>
                <td class="date"><?php echo $row['bbs_date']?></td>
                <td class="hit"><?php echo $row['bbs_hit']?></td>
              </tr>
              <?php
                }
              }
              ?>
          </tbody>
        </table>
        <div class="btnSet">
          <a href="./write.php" class="btnWrite btn">글쓰기</a>
        </div>
        <div class="paging">
          <?php echo $paging ?>
        </div>
        <div class="searchBox">
          <form action="./index.php" method="get">
            <select name="searchColumn">
              <option <?php echo $searchColumn=='bbs_title'?'selected="selected"':null?> value="bbs_title">제목</option>
              <option <?php echo $searchColumn=='bbs_content'?'selected="selected"':null?> value="bbs_content">내용</option>
              <option <?php echo $searchColumn=='bbs_nickname'?'selected="selected"':null?> value="bbs_nickname">작성자</option>
            </select>
            <input type="text" name="searchText" value="<?php echo isset($searchText)?$searchText:null?>">
            <button type="submit">검색</button>
          </form>
        </div>
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
