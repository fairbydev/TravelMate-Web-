<?php
	date_default_timezone_set('Asia/Seoul');

	require_once("../dbconfig.php");
	session_start();

	//세션 정보
  $is_login = $_SESSION['is_login'];  //로그인 엽
  $id = $_SESSION['id'];    //사용자 id
  $nickname = $_SESSION['nickname'];  //사용자 닉네임

	//멤버 작성 및 수정 정보
	if(isset($_POST['memberWriting'])){
		$memberWriting = $_POST['memberWriting'];
		// echo '멤버라이팅 ㅇㅈ';
	}

	//페이지
  $page = $_POST['page'];
  if(empty($page)){
    $page = 1;
  }

	//$_POST['pno']이 있을 때만 $pno 선언
	if(isset($_POST['pno'])) {
		$pno = $_POST['pno'];
	}

	//pno이 없다면(글 쓰기라면) 변수 선언
	if(empty($pno)) {
		$nickname = $_POST['nickname'];
		date_default_timezone_set('Asia/Seoul');
		$date = date('Y-m-d H:i:s');
	}


echo $_FILES["posting_pic"]["name"].'llll';


if($_FILES["posting_pic"]["name"] != null){
	echo $_FILES["posting_pic"]["name"].'jjjj';
	//사진 업로드 부분
	//	$target_dir = "/usr/local/apache/htdocs/php/images/uploads/";
	$target_dir = "../images/uploads/";
	$target_file = $target_dir . basename($_FILES["posting_pic"]["name"]);
	//$target_file = $target_dir . $_FILES["posting_pic"]["name"];
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["posting_pic"]["tmp_name"]);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["posting_pic"]["size"] > 2000000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["posting_pic"]["tmp_name"], $target_file)) {
	        echo "The file ". basename( $_FILES["posting_pic"]["name"]). " has been uploaded.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}

}


// print_r($_POST);
// print_r($_FILES);








	//항상 변수 선언
	$posting_password = $_POST['posting_password'];
	$posting_title = $_POST['posting_title'];
	$posting_subtitle = $_POST['posting_subtitle'];
	$posting_ddate = $_POST['posting_ddate'];
	$posting_rdate = $_POST['posting_rdate'];
	$posting_expireDate = $_POST['posting_expireDate'];
	$posting_locationCode = $_POST['posting_locationCode'];
	$posting_place = $_POST['posting_place'];
	$posting_gender = $_POST['posting_gender'];
	$posting_maxperson = $_POST['posting_maxperson'];
	$posting_contact = $_POST['posting_contact'];
	$posting_content = $_POST['posting_content'];
	//$posting_pic = $_POST['posting_pic'];
	//$posting_hit = $_POST['posting_hit'];
	$posting_pic = $target_file;
	//$posting_hit = 0;


	$whetherNickSession = $_POST['whetherNickSession'];

	// echo $posting_password;
	// echo $posting_title;
	// echo $_POST['posting_subtitle'];
	// echo $_POST['posting_ddate'];
	// echo $_POST['posting_rdate'];
	// echo $_POST['posting_expireDate'];
	// echo $_POST['posting_locationCode'];
	// echo $_POST['posting_place'];
	// echo $_POST['posting_gender'];
	// echo $_POST['posting_maxperson'];
	// echo $_POST['posting_contact'];
	// echo $_POST['posting_content'];
	// echo $posting_pic;
	// echo $posting_hit;



//글 수정
if($memberWriting == true && isset($_SESSION['is_login'])){	// 로그인한 상태로 수정 및 등록을 실행 요청하고 실제로 로그인 상태가 유지되고 있을 때 실행
	if(isset($pno)) {
		//수정 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크
		$sql = 'select count(posting_password) as cnt from travelBoard where posting_password=password("' . $posting_password . '") and pno = ' . $pno;
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		//비밀번호가 맞다면 업데이트 쿼리 작성
		if($posting_pic == null){
			echo '분기1';
			if($row['cnt']) {
				$sql = 'update travelBoard set posting_title="' . $posting_title . '", posting_subtitle="' . $posting_subtitle . '", posting_ddate="' .
								$posting_ddate . '", posting_rdate="' . $posting_rdate . '", posting_expireDate="' . $posting_expireDate . '", posting_locationCode="' . $posting_locationCode
								. '", posting_place="' . $posting_place . '", posting_gender="' . $posting_gender . '", posting_maxperson="' . $posting_maxperson
								.'", posting_contact="' . $posting_contact .'", posting_content="' . $posting_content .'" where pno = ' . $pno;
				$msgState = '수정';
				//틀리다면 메시지 출력 후 이전화면으로
				}else{
					$msg = '문제가 발생하여 이전 페이지로 돌아갑니다1.';
				?>
					<script>
						alert("<?php echo $msg?>");
						//history.back();
					</script>
				<?php
					exit;
				}
		}else if($posting_pic != null){
						echo '분기2';
			if($row['cnt']) {
				$sql = 'update travelBoard set posting_title="' . $posting_title . '", posting_subtitle="' . $posting_subtitle . '", posting_ddate="' .
								$posting_ddate . '", posting_rdate="' . $posting_rdate . '", posting_expireDate="' . $posting_expireDate . '", posting_locationCode="' . $posting_locationCode
								. '", posting_place="' . $posting_place . '", posting_gender="' . $posting_gender . '", posting_maxperson="' . $posting_maxperson
								.'", posting_contact="' . $posting_contact .'", posting_content="' . $posting_content .'", posting_pic="' . $posting_pic .'"  where pno = ' . $pno;
				$msgState = '수정';
				//틀리다면 메시지 출력 후 이전화면으로
				}else{
					$msg = '문제가 발생하여 이전 페이지로 돌아갑니다1.';
				?>
					<script>
						alert("<?php echo $msg?>");
						//history.back();
					</script>
				<?php
					exit;
				}
		}




	//글 등록
	} else {
		echo '일단 sql 진입';
		$sql = 'insert into travelBoard (pno, nickname, posting_password, posting_title, posting_subtitle, posting_ddate, posting_rdate, posting_expireDate,
						posting_locationCode, posting_place, posting_gender, posting_maxperson, posting_contact, posting_content, posting_pic, posting_hit)
	          values(null, "' . $nickname . '", password("' . $posting_password . '"), "' . $posting_title . '", "' . $posting_subtitle . '",
						 "' . $posting_ddate . '", "' . $posting_ddate . '", "' . $posting_expireDate . '", "' . $posting_locationCode.'", "'.$posting_place.'",
						 "'.$posting_gender.'", "'.$posting_maxperson.'", "'.$posting_contact.'", "'.$posting_content.'", "'.$posting_pic.'", "0")';

		$msgState = '등록';
	}
}else if($memberWriting == 'true' && !isset($_SESSION['is_login'])){	// 로그인한 상태로 수정 및 등록으로 들어왔으나 중간에 로그아웃하여 세션이 사라졌을 때
		$msg = '비정상적 접근입니다.';
	?>
		<script>
			alert("<?php echo $msg?>");
			history.back();
		</script>
	<?php
		exit;
}



//메시지가 없다면 (오류가 없다면)
if(empty($msg)) {
	$result = $conn->query($sql);

	//쿼리가 정상 실행 됐다면,
	if($result) {
		$msg = '정상적으로 글이 ' . $msgState . '되었습니다.';
		if(empty($pno)) {
			$pno = $conn->insert_id;
		}
		$replaceURL = './travel_view.php?pno=' . $pno.'&page='.$page;
	} else {
		$msg = '글을 ' . $msgState . '하지 못했습니다.';
?>
		<script>
			alert("<?php echo $msg?>");
			//history.back();
		</script>
<?php
		exit;
	}
}

?>
<script>
	alert("<?php echo $msg?>");
	location.replace("<?php echo $replaceURL?>");
</script>
