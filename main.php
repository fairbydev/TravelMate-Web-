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
        <a class="navbar-brand" href="main.php">TRAVEL MATE</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="./intro/introMain.php">ABOUT</a></li>
          <li><a href="./travelMenu/travelList.php">NEW TRAVELS</a></li>
          <li><a href="./reviewBoard/board/index.php">REVIEW BOARD</a></li>

          <?php
          if(!isset($_SESSION['is_login']) || !isset($_SESSION['nickname'])) {
            echo '<li><a href="./logIn/logIn.php">로그인</a></li>';
            echo '<li><a href="./signIn/signInInput.php">회원가입</a></li>';
          }else{
            // echo '<li><a href="./mypage/mypage.php">나의 정보</a></li>';
            echo '<li><a href="./logIn/logOut.php">로그아웃</a></li>';
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
    <h1>트래블 메이트</h1>
    <p>새로운 세상을 여행할 친구들을 만나세요!</p>

    <form role="form" id="form" method="get" action="./travelMenu/travelList.php">
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



  <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox" \>
      <div class="item active">
        <img id="item2image" src="./images/friends2.jpg"/>
        <div class="container">
          <div class="carousel-caption">
            <h4 id="item2text">"여행은 목적지로 향하는 과정이지만, 그 자체로 보상이다."<br><span style="font-style:normal;">- 스티브 잡스</span></h4>
          </div>
        </div>
      </div>
      <div class="item">
        <img id="item4image" src="./images/friends4.jpg"/>
        <div class="container">
          <div class="carousel-caption">
            <h4 id="item4text">"친구를 갖는다는 것은 곧 또 하나의 인생을 얻는 것이다."<br><span style="font-style:normal;">-발타자르 그라시안</span></h4>
          </div>
        </div>
      </div>
      <div class="item">
        <img id="item3image" src="./images/friends3.jpg"/>
        <div class="container">
          <div class="carousel-caption">
            <h4 id="item3text">"당신의 인생에서 할 지 모르는 가장 큰 여행은, 여행 도중 사람을 만나는 것이다."<br><span style="font-style:normal;">- 헨리 보예</span></h4>
          </div>
        </div>
      </div>
      <div class="item">
        <img id="item1image" src="./images/friends1.jpg"/>
        <div class="container">
          <div class="carousel-caption">
            <h4 id="item1text">"세계는 한 권의 책이다. 여행하지 않는 자는 그 책의 단지 한 페이지만을 읽을 뿐이다."<br><span style="font-style:normal;">- 성 아우구스티누스</span></h4>
          </div>
        </div>
      </div>

    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="false"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>


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


</script>
</html>
