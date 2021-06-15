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
	}

	//페이지
  $page = $_POST['page'];
  if(empty($page)){
    $page = 1;
  }

	//$_POST['bno']이 있을 때만 $bno 선언
	if(isset($_POST['bno'])) {
		$bNo = $_POST['bno'];
	}

	//bno이 없다면(글 쓰기라면) 변수 선언
	if(empty($bNo)) {
		$bID = $_POST['bID'];
		date_default_timezone_set('Asia/Seoul');
		$date = date('Y-m-d H:i:s');
	}

	//항상 변수 선언
	$bPassword = $_POST['bPassword'];
	$bTitle = $_POST['bTitle'];
	$bContent = $_POST['bContent'];
	$whetherNickSession = $_POST['whetherNickSession'];

//글 수정
if($memberWriting == true && isset($_SESSION['is_login'])){	// 로그인한 상태로 수정 및 등록을 실행 요청하고 실제로 로그인 상태가 유지되고 있을 때 실행
	if(isset($bNo)) {
		//수정 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크
		$sql = 'select count(bbs_password) as cnt from reviewBoard where bbs_password=password("' . $bPassword . '") and bbs_no = ' . $bNo;
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		//비밀번호가 맞다면 업데이트 쿼리 작성
		if($row['cnt']) {
			$sql = 'update reviewBoard set bbs_title="' . $bTitle . '", bbs_content="' . $bContent . '" where bbs_no = ' . $bNo;
			$msgState = '수정';
		//틀리다면 메시지 출력 후 이전화면으로
		}else {
			$msg = '비밀번호가 맞지 않습니다.';
		?>
			<script>
				alert("<?php echo $msg?>");
				history.back();
			</script>
		<?php
			exit;
		}

	//글 등록
	} else {
		if($is_login !== true){
			$bID = $bID.'(비회원)';
		}
		$sql = 'insert into reviewBoard (bbs_no, bbs_title, bbs_content, bbs_date, bbs_hit, bbs_nickname, bbs_password)
	          values(null, "' . $bTitle . '", "' . $bContent . '", "' . $date . '", 0, "' . $bID . '", password("' . $bPassword . '"))';

		// $sql = 'insert into reviewBoard (bbs_no, bbs_title, bbs_content, bbs_date, bbs_hit, bbs_nickname, bbs_password)
		//         values(null, "' . $bTitle . '", "' . $bContent . '", "' . $date . '", 0, "' . $bID . '", "' . $bPassword . '")';

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

}else if(!isset($memberWriting)){	// 비회원 글 등록 및 수정
	if(isset($bNo)) {
		//수정 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크
		$sql = 'select count(bbs_password) as cnt from reviewBoard where bbs_password=password("' . $bPassword . '") and bbs_no = ' . $bNo;
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		//비밀번호가 맞다면 업데이트 쿼리 작성
		if($row['cnt']) {
			$sql = 'update reviewBoard set bbs_title="' . $bTitle . '", bbs_content="' . $bContent . '" where bbs_no = ' . $bNo;
			$msgState = '수정'.$bPassword;
		//틀리다면 메시지 출력 후 이전화면으로
		}else {
			$msg = '비밀번호가 맞지 않습니다.';
		?>
			<script>
				alert("<?php echo $msg?>");
				history.back();
			</script>
		<?php
			exit;
		}

	//글 등록
	} else {
		if($is_login !== true){
			$bID = $bID.'(비회원)';
		}
		$sql = 'insert into reviewBoard (bbs_no, bbs_title, bbs_content, bbs_date, bbs_hit, bbs_nickname, bbs_password)
	          values(null, "' . $bTitle . '", "' . $bContent . '", "' . $date . '", 0, "' . $bID . '", password("' . $bPassword . '"))';

		// $sql = 'insert into reviewBoard (bbs_no, bbs_title, bbs_content, bbs_date, bbs_hit, bbs_nickname, bbs_password)
		//         values(null, "' . $bTitle . '", "' . $bContent . '", "' . $date . '", 0, "' . $bID . '", "' . $bPassword . '")';

		$msgState = '등록';
	}
}



//메시지가 없다면 (오류가 없다면)
if(empty($msg)) {
	$result = $conn->query($sql);

	//쿼리가 정상 실행 됐다면,
	if($result) {
		$msg = '정상적으로 글이 ' . $msgState . '되었습니다.';
		if(empty($bNo)) {
			$bNo = $conn->insert_id;
		}
		$replaceURL = './view.php?bno=' . $bNo.'&page='.$page;
	} else {
		$msg = '글을 ' . $msgState . '하지 못했습니다.';
?>
		<script>
			alert("<?php echo $msg?>");
			history.back();
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
