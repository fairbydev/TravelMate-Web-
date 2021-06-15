<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>




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


  //모달

  .modal.modal-center {
    text-align: center;
  }

  @media screen and (min-width: 768px) {
    .modal.modal-center:before {
      display: inline-block;
      vertical-align: middle;
      content: " ";
      height: 30%;
    }
  }

  .modal-dialog.modal-center {
    display: inline-block;
    text-align: left;
    vertical-align: middle;
  }


//footer

footer .glyphicon {
    font-size: 20px;
    margin-bottom: 20px;
    color: #f4511e;
}

  </style>

</head>


<!-- 바디시작 -->
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
    <h1>안녕하세요!</h1>
    <p>로그인 페이지 입니다.</p>
  </div>


  <!-- <script>
  $(document).ready(function () {
   $('.forgot-pass').click(function(event) {
     $(".pr-wrap").toggleClass("show-pass-reset");
   });

   $('.pass-reset-submit').click(function(event) {
     $(".pr-wrap").removeClass("show-pass-reset");
   });
  });
  </script> -->
  <style>
  body
  {
      background: url('http://farm3.staticflickr.com/2832/12303719364_c25cecdc28_b.jpg') fixed;
      background-size: cover;
      padding: 0;
      margin: 0;
  }

  .wrap
  {
      width: 100%;
      height: 100%;
      min-height: 100%;
      position: absolute;
      top: 0;
      left: 0;
      z-index: 99;
  }

  p.form-title
  {
      font-family: 'Open Sans' , sans-serif;
      font-size: 20px;
      font-weight: 600;
      text-align: center;
      color: #FFFFFF;
      margin-top: 5%;
      text-transform: uppercase;
      letter-spacing: 4px;
  }

  form
  {
      width: 250px;
      margin: 0 auto;
  }

  form.login input[type="text"], form.login input[type="password"]
  {
      width: 100%;
      margin: 0;
      padding: 5px 10px;
      background: 0;
      border: 0;
      border-bottom: 1px solid #FFFFFF;
      outline: 0;
      font-style: italic;
      font-size: 12px;
      font-weight: 400;
      letter-spacing: 1px;
      margin-bottom: 5px;
      color: #FFFFFF;
      outline: 0;
  }

  form.login input[type="submit"]
  {
      width: 100%;
      font-size: 14px;
      text-transform: uppercase;
      font-weight: 500;
      margin-top: 16px;
      outline: 0;
      cursor: pointer;
      letter-spacing: 1px;
  }

  form.login input[type="submit"]:hover
  {
      transition: background-color 0.5s ease;
  }

  form.login .remember-forgot
  {
      float: left;
      width: 100%;
      margin: 10px 0 0 0;
  }
  form.login .forgot-pass-content
  {
      min-height: 20px;
      margin-top: 10px;
      margin-bottom: 10px;
  }
  form.login label, form.login a
  {
      font-size: 12px;
      font-weight: 400;
      color: #FFFFFF;
  }

  form.login a
  {
      transition: color 0.5s ease;
  }

  form.login a:hover
  {
      color: #2ecc71;
  }

  .pr-wrap
  {
      width: 100%;
      height: 100%;
      min-height: 100%;
      position: absolute;
      top: 0;
      left: 0;
      z-index: 999;
      display: none;
  }

  .show-pass-reset
  {
      display: block !important;
  }

  .pass-reset
  {
      margin: 0 auto;
      width: 250px;
      position: relative;
      margin-top: 22%;
      z-index: 999;
      background: #FFFFFF;
      padding: 20px 15px;
  }

  .pass-reset label
  {
      font-size: 12px;
      font-weight: 400;
      margin-bottom: 15px;
  }

  .pass-reset input[type="email"]
  {
      width: 100%;
      margin: 5px 0 0 0;
      padding: 5px 10px;
      background: 0;
      border: 0;
      border-bottom: 1px solid #000000;
      outline: 0;
      font-style: italic;
      font-size: 12px;
      font-weight: 400;
      letter-spacing: 1px;
      margin-bottom: 5px;
      color: #000000;
      outline: 0;
  }

  .pass-reset input[type="submit"]
  {
      width: 100%;
      border: 0;
      font-size: 14px;
      text-transform: uppercase;
      font-weight: 500;
      margin-top: 10px;
      outline: 0;
      cursor: pointer;
      letter-spacing: 1px;
  }

  .pass-reset input[type="submit"]:hover
  {
      transition: background-color 0.5s ease;
  }
  .posted-by
  {
      position: absolute;
      bottom: 26px;
      margin: 0 auto;
      color: #FFF;
      background-color: rgba(0, 0, 0, 0.66);
      padding: 10px;
      left: 45%;
  }

  .footer{
      color: #FFF;
  }
  </style>


  <!-- 모달창 -->
  <div class="modal modal-center fade" id="defaultModal">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title">알림</h4>
              </div>
              <div class="modal-body">
                  <p class="modal-contents"></p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
              </div>
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!--// 모달창 -->


    <div class="container">
      <div class="row">
          <div class="col-md-12">
              <!-- <div class="pr-wrap">
                  <div class="pass-reset">
                      <label>
                          Enter the email you signed up with</label>
                      <input type="email" placeholder="Email" />
                      <input type="submit" value="Submit" class="pass-reset-submit btn btn-success btn-sm" />
                  </div>
              </div> -->
              <div class="wrap">
                  <!-- <p class="form-title">
                      Sign In</p> -->
                  <br/><br/><br/><br/>
                  <!-- 아이디 비번 입력 폼 -->
                  <form class="login" role="form" id="form" method="post" action="logInCheck.php">
                  <input type="text" placeholder="User ID" name="id" id="id"/>
                  <input type="password" placeholder="Password" name="password" id="password"/>
                  <input type="submit" value="Log In" class="btn btn-success btn-sm" />
                  <!-- <div class="remember-forgot">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="checkbox">
                                  <label>
                                      <input type="checkbox" />
                                      Remember Me
                                  </label>
                              </div>
                          </div>
                            <div class="col-md-6 forgot-pass-content">
                              <a href="javascript:void(0)" class="forgot-pass">Forgot Password</a>
                          </div> -->
                      </div>
                  </div> -->
                  </form>

              </div>
          </div>
      </div>
  </div>



  <script>
  //
  $(function(){
      //모달을 전역변수로 선언
      var modalContents = $(".modal-contents");
      var modal = $("#defaultModal");

      //--------- validation 검사
      $("#form").submit(function( event ) {

          //아이디 검사
          if($('#id').val()==""){
              modalContents.text("아이디를 입력하여 주시기 바랍니다.");
              modal.modal('show');

              $('#id').focus();
              return false;
          }else{

          }

          //패스워드 검사
          if($('#password').val()==""){
              modalContents.text("패스워드를 입력하여 주시기 바랍니다.");
              modal.modal('show');

              $('#password').focus();
              return false;
          }else{

          }
        });
  });

  </script>


</body>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

<hr/>
<!-- 푸터 들어가는 부분 -->

<footer class="container-fluid text-center">
  <p class="text-center footer-text">
      <small><strong> 트래블메이트</strong></small><br>
      <small>대표 : JH PARK ㆍ 주소 :  SEOUL, KOREA ㆍ 전화 : 010-777-7777</small><br>
      <small>Copyrightⓒ JH Corp. All rights reserved.</small>
  </p>
</footer>
</html>
