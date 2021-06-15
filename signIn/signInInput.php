<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  <meta http-equiv="X-UA-Compatible" content="ie=edge">

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

          <li><a href="../logIn/logIn.php">로그인</a></li>
          <li><a href="./signInInput.php">회원가입</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="jumbotron text-center">
    <h1>안녕하세요!</h1>
    <p>처음으로 만나게 되어 반갑습니다.</p>
  </div>




  <div class="container"><!-- 좌우측의 공간 확보 -->
      <!-- 헤더 들어가는 부분 -->


      <!--// 헤더 들어가는 부분 -->
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

          <!-- 본문 들어가는 부분 -->



  <form class="form-horizontal" role="form" method="post" action="signIn.php">
      <!-- <div class="form-group">
          <label for="provision" class="col-lg-2 control-label">회원가입약관</label>
          <div class="col-lg-10" id="provision">
              <textarea class="form-control" rows="8" style="resize:none">
약관동의
              </textarea>
              <div class="radio">
                  <label>
                      <input type="radio" class="provisionYn" name="provisionYn" value="Y" autofocus="autofocus" checked>
                      동의합니다.
                  </label>
              </div>
              <div class="radio">
                  <label>
                      <input type="radio" class="provisionYn" name="provisionYn" value="N">
                      동의하지 않습니다.
                  </label>
              </div>
          </div>
      </div>
      <div class="form-group">
          <label for="memberInfo" class="col-lg-2 control-label">개인정보취급방침</label>
          <div class="col-lg-10" id="memberInfo">
              <textarea class="form-control" rows="8" style="resize:none">
개인정보의 항목 및 수집방법
              </textarea>
              <div class="radio">
                  <label>
                      <input type="radio" class="memberInfoYn" name="memberInfoYn" value="Y" checked>
                      동의합니다.
                  </label>
              </div>
              <div class="radio">
                  <label>
                      <input type="radio" class="memberInfoYn" name="memberInfoYn" value="N">
                      동의하지 않습니다.
                  </label>
              </div>
          </div>
      </div> -->
      <div class="form-group" id="divId">
          <label for="inputId" class="col-lg-2 control-label">아이디</label>
          <div class="col-lg-10">
              <input type="text" class="form-control onlyAlphabetAndNumber" id="id" name="id" data-rule-required="true" placeholder="5자 이상 30자 이내의 알파벳, 언더스코어(_), 숫자만 입력 가능합니다. 입력 후 중복검사 버튼을 눌러주세요." maxlength="30">
              <button type="button" id="idcheck" onclick="idcheck()">아이디 중복검사</button>
          </div>
      </div>
      <div class="form-group" id="divPassword">
          <label for="inputPassword" class="col-lg-2 control-label">패스워드</label>
          <div class="col-lg-10">
              <input type="password" class="form-control" id="password" name="password" data-rule-required="true" placeholder="패스워드는 8자 이상 30자 이내로 숫자, 영문, 특수문자를 각각 하나 이상 포함해야 합니다." maxlength="30">
          </div>
      </div>
      <div class="form-group" id="divPasswordCheck">
          <label for="inputPasswordCheck" class="col-lg-2 control-label">패스워드 확인</label>
          <div class="col-lg-10">
              <input type="password" class="form-control" id="passwordCheck" data-rule-required="true" placeholder="패스워드 확인" maxlength="30">
          </div>
      </div>
      <!-- <div class="form-group" id="divName">
          <label for="inputName" class="col-lg-2 control-label">이름</label>
          <div class="col-lg-10">
              <input type="text" class="form-control onlyHangul" id="name" name="name" data-rule-required="true" placeholder="한글만 입력 가능합니다." maxlength="15">
          </div>
      </div> -->

      <div class="form-group" id="divNickname">
          <label for="inputNickname" class="col-lg-2 control-label">별명</label>
          <div class="col-lg-10">
              <input type="text" class="form-control" id="nickname" name="nickname" data-rule-required="true" placeholder="별명은 15자 이내로 작성해 주시기 바랍니다. 입력 후 중복검사 버튼을 눌러주세요." maxlength="15">
              <button type="button" id="nickcheck" onclick="nickcheck()">닉네임 중복검사</button>
          </div>
      </div>

      <div class="form-group" id="divEmail">
          <label for="inputEmail" class="col-lg-2 control-label">이메일</label>
          <div class="col-lg-10">
              <input type="email" class="form-control" id="email" name="email" data-rule-required="true" placeholder="이메일" maxlength="50">
          </div>
      </div>
      <!-- <div class="form-group" id="divPhoneNumber">
          <label for="inputPhoneNumber" class="col-lg-2 control-label">휴대폰 번호</label>
          <div class="col-lg-10">
              <input type="tel" class="form-control onlyNumber" id="phoneNumber" name="phoneNumber" data-rule-required="true" placeholder="-를 제외하고 숫자만 입력하세요." maxlength="11">
          </div>
      </div> -->
      <div class="form-group">
          <label for="inputGender" class="col-lg-2 control-label">성별</label>
          <div class="col-lg-10">
              <select class="form-control" id="gender" name="gender">
                  <option value="M">남</option>
                  <option value="F">여</option>
              </select>
          </div>
      </div>

      <div class="form-group">
          <div class="col-lg-offset-2 col-lg-10">
              <button type="submit" class="btn btn-default">Sign in</button>
          </div>
      </div>
  </form>



  <script>


          // function idcheck(){ //아이디 중복검사
          //  location.href = "duplicationCheck.php?checkId=" + $('#id').val() + "&checkPassword=" + $('#password').val()
          //                   + "&checkNickname=" + $('#nickname').val() + "&checkEmail=" + $('#email').val() + "&checkGender=" + $('#gender').val();
          // }
          //
          // function sscheck(){ //아이디 중복검사
          //  alert('<?php echo $_SESSION['checkId'] ?>');
          // }

            // 중복검사 여부 전역변수 선언

            var idDuplicationCheck = 'false';
            var nickDuplicationCheck = 'false';


          $(function(){
            $('#idcheck').click(function(){
                if(nickDuplicationCheck ==  'true'){
                  location.href = "idDuplicationCheck.php?checkId=" + $('#id').val() + "&checkPassword=" + $('#password').val()
                                   + "&checkNickname=" + $('#nickname').val() + "&checkEmail=" + $('#email').val() + "&checkGender=" + $('#gender').val() + "&nickDuplicationCheck=true";
                }else if(nickDuplicationCheck ==  'false'){
                  location.href = "idDuplicationCheck.php?checkId=" + $('#id').val() + "&checkPassword=" + $('#password').val()
                                   + "&checkNickname=" + $('#nickname').val() + "&checkEmail=" + $('#email').val() + "&checkGender=" + $('#gender').val() + "&nickDuplicationCheck=false";
                }
              });
          });

          $(function(){
            $('#nickcheck').click(function(){
                 if(idDuplicationCheck ==  'true'){
                   location.href = "nickDuplicationCheck.php?checkId=" + $('#id').val() + "&checkPassword=" + $('#password').val()
                                    + "&checkNickname=" + $('#nickname').val() + "&checkEmail=" + $('#email').val() + "&checkGender=" + $('#gender').val() + "&idDuplicationCheck=true";
                 }else if(idDuplicationCheck ==  'false'){
                   location.href = "nickDuplicationCheck.php?checkId=" + $('#id').val() + "&checkPassword=" + $('#password').val()
                                    + "&checkNickname=" + $('#nickname').val() + "&checkEmail=" + $('#email').val() + "&checkGender=" + $('#gender').val() + "&idDuplicationCheck=false";
                 }
              });
          });


          //아아디 중복 및 길이 체크 관련 세션 체크
          <?php
            if(($_SESSION['idDuplicationCheck'] == true) && ($_SESSION['previousPage'] == 'idDuplicationCheck') && ($_SESSION['idLengthCheck'] == true)){
              ?>
              $(function(){
                idDuplicationCheck = 'true';
                alert('사용할 수 있는 아이디입니다.');
                $('#id').val('<?php echo $_SESSION['checkId'] ?>');
                $('#password').val('<?php echo $_SESSION['checkPassword'] ?>');
                $('#nickname').val('<?php echo $_SESSION['checkNickname'] ?>');
                $('#email').val('<?php echo $_SESSION['checkEmail'] ?>');
                $('#gender').val('<?php echo $_SESSION['checkGender'] ?>');
                nickDuplicationCheck = '<?php echo $_SESSION['nickDuplicationCheck'] ?>';
              });
              <?php
                session_destroy();
            }else if(($_SESSION['idDuplicationCheck'] == false) && ($_SESSION['previousPage'] == 'idDuplicationCheck')){  //중복인 경우
              ?>
              $(function(){
                idDuplicationCheck = 'false';
                alert('이미 사용되고 있는 아이디입니다. 새로운 아이디를 적고 중복검사를 해주세요.');
                $('#password').val('<?php echo $_SESSION['checkPassword'] ?>');
                $('#nickname').val('<?php echo $_SESSION['checkNickname'] ?>');
                $('#email').val('<?php echo $_SESSION['checkEmail'] ?>');
                $('#gender').val('<?php echo $_SESSION['checkGender'] ?>');
                nickDuplicationCheck = '<?php echo $_SESSION['nickDuplicationCheck'] ?>';
              });
              <?php
                session_destroy();
            }else if(($_SESSION['previousPage'] == 'idDuplicationCheck') && ($_SESSION['idLengthCheck'] == false)){   //길이가 5자가 안되는 경우
              ?>
              $(function(){
                idDuplicationCheck = 'false';
                alert('아이디는 5자 이상이어야 합니다. 새로운 아이디를 적고 중복검사를 해주세요.');
                $('#password').val('<?php echo $_SESSION['checkPassword'] ?>');
                $('#nickname').val('<?php echo $_SESSION['checkNickname'] ?>');
                $('#email').val('<?php echo $_SESSION['checkEmail'] ?>');
                $('#gender').val('<?php echo $_SESSION['checkGender'] ?>');
                nickDuplicationCheck = '<?php echo $_SESSION['nickDuplicationCheck'] ?>';
              });
              <?php
                session_destroy();
            }
           ?>

           //닉네임 중복 체크
           <?php
             if(($_SESSION['nickDuplicationCheck'] == true) && ($_SESSION['previousPage'] == 'nickDuplicationCheck')){
               ?>
               $(function(){
                 nickDuplicationCheck = 'true';
                 alert('사용할 수 있는 닉네임입니다.');
                 $('#id').val('<?php echo $_SESSION['checkId'] ?>');
                 $('#password').val('<?php echo $_SESSION['checkPassword'] ?>');
                 $('#email').val('<?php echo $_SESSION['checkEmail'] ?>');
                 $('#gender').val('<?php echo $_SESSION['checkGender'] ?>');
                 idDuplicationCheck = '<?php echo $_SESSION['idDuplicationCheck'] ?>';
               });
               <?php
                 session_destroy();
             }else if(($_SESSION['nickDuplicationCheck'] == false) && ($_SESSION['previousPage'] == 'nickDuplicationCheck')){  //중복인 경우
               ?>
               $(function(){
                 nickDuplicationCheck = 'false';
                 alert('이미 사용되고 있는 닉네임입니다. 새로운 닉네임을 적고 중복검사를 해주세요.');
                 $('#id').val('<?php echo $_SESSION['checkId'] ?>');
                 $('#password').val('<?php echo $_SESSION['checkPassword'] ?>');
                 $('#email').val('<?php echo $_SESSION['checkEmail'] ?>');
                 $('#gender').val('<?php echo $_SESSION['checkGender'] ?>');
                 idDuplicationCheck = '<?php echo $_SESSION['idDuplicationCheck'] ?>';
               });
               <?php
                 session_destroy();
             }
            ?>




          //모달을 전역변수로 선언
          var modalContents = $(".modal-contents");
          var modal = $("#defaultModal");

          $('.onlyAlphabetAndNumber').keyup(function(event){
              if (!(event.keyCode >=37 && event.keyCode<=40)) {
                  var inputVal = $(this).val();
                  $(this).val($(this).val().replace(/[^_a-z0-9]/gi,'')); //_(underscore), 영어, 숫자만 가능
              }
          });

          $(".onlyHangul").keyup(function(event){
              if (!(event.keyCode >=37 && event.keyCode<=40)) {
                  var inputVal = $(this).val();
                  $(this).val(inputVal.replace(/[a-z0-9]/gi,''));
              }
          });

          $(".onlyNumber").keyup(function(event){
              if (!(event.keyCode >=37 && event.keyCode<=40)) {
                  var inputVal = $(this).val();
                  $(this).val(inputVal.replace(/[^0-9]/gi,''));
              }
          });

          //------- 검사하여 상태를 class에 적용
          $('#id').keyup(function(event){

              var divId = $('#divId');

              if($('#id').val()==""){
                  divId.removeClass("has-success");
                  divId.addClass("has-error");
              }else{
                  divId.removeClass("has-error");
                  divId.addClass("has-success");
              }

              if($('#id').val().length < 5){
                  divId.removeClass("has-success");
                  divId.addClass("has-error");
              }else{
                  divId.removeClass("has-error");
                  divId.addClass("has-success");
              }
          });


          $('#password').keyup(function(event){

              var divPassword = $('#divPassword');

              if($('#password').val()==""){
                  divPassword.removeClass("has-success");
                  divPassword.addClass("has-error");
              }else if($('#password').val().length < 8){  //길이 검사
                divPassword.removeClass("has-success");
                divPassword.addClass("has-error");
              }else{
                  divPassword.removeClass("has-error");
                  divPassword.addClass("has-success");
              }

              //조합검사
              var check = /^(?=.*[a-zA-Z])(?=.*[!@#$%^*+=-])(?=.*[0-9]).{6,16}$/;

               if (!check.test($('#password').val())){
                 divPassword.removeClass("has-success");
                 divPassword.addClass("has-error");
               }
              // if($('#password').val().length < 8){
              //     divPassword.removeClass("has-success");
              //     divPassword.addClass("has-error");
              // }else{
              //     divPassword.removeClass("has-error");
              //     divPassword.addClass("has-success");
              // }
              //
              // if($('#password').val()== /^(?=.*[a-zA-Z])(?=.*[!@#$%^*+=-])(?=.*[0-9]).{8,30}$/){
              //     divId.removeClass("has-success");
              //     divId.addClass("has-error");
              // }else{
              //     divId.removeClass("has-error");
              //     divId.addClass("has-success");
              // }
          });

          $('#passwordCheck').keyup(function(event){

              var passwordCheck = $('#passwordCheck').val();
              var password = $('#password').val();
              var divPasswordCheck = $('#divPasswordCheck');

              if((passwordCheck=="") || (password!=passwordCheck)){
                  divPasswordCheck.removeClass("has-success");
                  divPasswordCheck.addClass("has-error");
              }else{
                  divPasswordCheck.removeClass("has-error");
                  divPasswordCheck.addClass("has-success");
              }
          });

          // $('#name').keyup(function(event){
          //
          //     var divName = $('#divName');
          //
          //     if($.trim($('#name').val())==""){
          //         divName.removeClass("has-success");
          //         divName.addClass("has-error");
          //     }else{
          //         divName.removeClass("has-error");
          //         divName.addClass("has-success");
          //     }
          // });

          $('#nickname').keyup(function(event){

              var divNickname = $('#divNickname');

              if($.trim($('#nickname').val())==""){
                  divNickname.removeClass("has-success");
                  divNickname.addClass("has-error");
              }else{
                  divNickname.removeClass("has-error");
                  divNickname.addClass("has-success");
              }
          });

          $('#email').keyup(function(event){

              var divEmail = $('#divEmail');

              if($.trim($('#email').val())==""){
                  divEmail.removeClass("has-success");
                  divEmail.addClass("has-error");
              }else{
                  divEmail.removeClass("has-error");
                  divEmail.addClass("has-success");
              }
          });

          // $('#phoneNumber').keyup(function(event){
          //
          //     var divPhoneNumber = $('#divPhoneNumber');
          //
          //     if($.trim($('#phoneNumber').val())==""){
          //         divPhoneNumber.removeClass("has-success");
          //         divPhoneNumber.addClass("has-error");
          //     }else{
          //         divPhoneNumber.removeClass("has-error");
          //         divPhoneNumber.addClass("has-success");
          //     }
          // });


          //------- validation 검사
          $( "form" ).submit(function( event ) {

              var provision = $('#provision');
              var memberInfo = $('#memberInfo');
              var divId = $('#divId');
              var divPassword = $('#divPassword');
              var divPasswordCheck = $('#divPasswordCheck');
              // var divName = $('#divName');
              var divNickname = $('#divNickname');
              var divEmail = $('#divEmail');
              // var divPhoneNumber = $('#divPhoneNumber');

              // //회원가입약관
              // if($('.provisionYn:checked').val()=="N"){
              //     modalContents.text("회원가입약관에 동의하여 주시기 바랍니다."); //모달 메시지 입력
              //     modal.modal('show'); //모달 띄우기
              //
              //     provision.removeClass("has-success");
              //     provision.addClass("has-error");
              //     $('.provisionYn').focus();
              //     return false;
              // }else{
              //     provision.removeClass("has-error");
              //     provision.addClass("has-success");
              // }
              //
              // //개인정보취급방침
              // if($('.memberInfoYn:checked').val()=="N"){
              //     modalContents.text("개인정보취급방침에 동의하여 주시기 바랍니다.");
              //     modal.modal('show');
              //
              //     memberInfo.removeClass("has-success");
              //     memberInfo.addClass("has-error");
              //     $('.memberInfoYn').focus();
              //     return false;
              // }else{
              //     memberInfo.removeClass("has-error");
              //     memberInfo.addClass("has-success");
              // }

              //아이디 검사
              if($('#id').val()==""){
                  modalContents.text("아이디를 입력하여 주시기 바랍니다.");
                  modal.modal('show');

                  divId.removeClass("has-success");
                  divId.addClass("has-error");
                  $('#id').focus();
                  return false;
              }else{
                  divId.removeClass("has-error");
                  divId.addClass("has-success");
              }

              //아이디 길이 검사
              if($('#id').val().length < 5){
                  modalContents.text("아이디는 5 - 30 자 길이로 작성하여 주시기 바랍니다.");
                  modal.modal('show');

                  divId.removeClass("has-success");
                  divId.addClass("has-error");
                  $('#id').focus();
                  return false;
              }else{
                  divId.removeClass("has-error");
                  divId.addClass("has-success");
              }

              //패스워드 검사

              var check = /^(?=.*[a-zA-Z])(?=.*[!@#$%^*+=-])(?=.*[0-9]).{6,16}$/;

              if($('#password').val()==""){
                  modalContents.text("패스워드를 입력하여 주시기 바랍니다.");
                  modal.modal('show');

                  divPassword.removeClass("has-success");
                  divPassword.addClass("has-error");
                  $('#password').focus();
                  return false;
              }else if($('#password').val().length < 8){
                modalContents.text("패스워드는 8자 이상으로 작성하여 주시기 바랍니다.");
                modal.modal('show');

                divPassword.removeClass("has-success");
                divPassword.addClass("has-error");
                $('#password').focus();
                return false;
              }else if(!check.test($('#password').val())){
                modalContents.text("패스워드에 영문, 숫자, 특수문자를 각각 하나 이상 포함하여 작성하여 주시기 바랍니다.");
                modal.modal('show');

                divPassword.removeClass("has-success");
                divPassword.addClass("has-error");
                $('#password').focus();
                return false;
              }else{
                  divPassword.removeClass("has-error");
                  divPassword.addClass("has-success");
              }


              //패스워드 확인
              if($('#passwordCheck').val()==""){
                  modalContents.text("패스워드 확인을 입력하여 주시기 바랍니다.");
                  modal.modal('show');

                  divPasswordCheck.removeClass("has-success");
                  divPasswordCheck.addClass("has-error");
                  $('#passwordCheck').focus();
                  return false;
              }else{
                  divPasswordCheck.removeClass("has-error");
                  divPasswordCheck.addClass("has-success");
              }

              //패스워드 비교
              if($('#password').val()!=$('#passwordCheck').val() || $('#passwordCheck').val()==""){
                  modalContents.text("패스워드가 일치하지 않습니다.");
                  modal.modal('show');

                  divPasswordCheck.removeClass("has-success");
                  divPasswordCheck.addClass("has-error");
                  $('#passwordCheck').focus();
                  return false;
              }else{
                  divPasswordCheck.removeClass("has-error");
                  divPasswordCheck.addClass("has-success");
              }

              // //이름
              // if($('#name').val()==""){
              //     modalContents.text("이름을 입력하여 주시기 바랍니다.");
              //     modal.modal('show');
              //
              //     divName.removeClass("has-success");
              //     divName.addClass("has-error");
              //     $('#name').focus();
              //     return false;
              // }else{
              //     divName.removeClass("has-error");
              //     divName.addClass("has-success");
              // }

              //별명
              if($('#nickname').val()==""){
                  modalContents.text("닉네임을 입력하여 주시기 바랍니다.");
                  modal.modal('show');

                  divNickname.removeClass("has-success");
                  divNickname.addClass("has-error");
                  $('#nickname').focus();
                  return false;
              }else{
                  divNickname.removeClass("has-error");
                  divNickname.addClass("has-success");
              }

              //이메일
              if($('#email').val()==""){
                  modalContents.text("이메일을 입력하여 주시기 바랍니다.");
                  modal.modal('show');

                  divEmail.removeClass("has-success");
                  divEmail.addClass("has-error");
                  $('#email').focus();
                  return false;
              }else{
                  divEmail.removeClass("has-error");
                  divEmail.addClass("has-success");
              }

              //아이디 중복검사
              if(idDuplicationCheck=='false'){
                  modalContents.text("아이디 중복검사를 해주시기 바랍니다.");
                  modal.modal('show');

                  divId.removeClass("has-success");
                  divId.addClass("has-error");
                  $('#id').focus();
                  return false;
              }else{
                  divId.removeClass("has-error");
                  divId.addClass("has-success");
              }

              //닉네임 중복검사
              if(nickDuplicationCheck=='false'){
                  modalContents.text("닉네임 중복검사를 해주시기 바랍니다.");
                  modal.modal('show');

                  divNickname.removeClass("has-success");
                  divNickname.addClass("has-error");
                  $('#nickname').focus();
                  return false;
              }else{
                  divNickname.removeClass("has-error");
                  divNickname.addClass("has-success");
              }


              // //휴대폰 번호
              // if($('#phoneNumber').val()==""){
              //     modalContents.text("휴대폰 번호를 입력하여 주시기 바랍니다.");
              //     modal.modal('show');
              //
              //     divPhoneNumber.removeClass("has-success");
              //     divPhoneNumber.addClass("has-error");
              //     $('#phoneNumber').focus();
              //     return false;
              // }else{
              //     divPhoneNumber.removeClass("has-error");
              //     divPhoneNumber.addClass("has-success");
              // }

          });
//      });

  </script>
          <!--// 본문 들어가는 부분 -->
      <hr/>
      <!-- 푸터 들어가는 부분 -->

      <footer class="container-fluid text-center">
        <p class="text-center">
            <small><strong> 트래블메이트</strong></small><br>
            <small>대표 : JH PARK ㆍ 주소 :  SEOUL, KOREA ㆍ 전화 : 010-777-7777</small><br>
            <small>Copyrightⓒ JH Corp. All rights reserved.</small>
        </p>
      </footer>
      <!--// 푸터 들어가는 부분 -->
  </div>


</body>
</html>
