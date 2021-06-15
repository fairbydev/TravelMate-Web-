<?php
  session_start();
	require_once("../dbconfig.php");

	//$_POST['bno']이 있을 때만 $bno 선언
	if(isset($_POST['bno'])) {
		$bNo = $_POST['bno'];
	}

	$bPassword = $_POST['bPassword'];

	//멤버 작성 및 수정 정보
	if(isset($_POST['memberWriting'])){
		$memberWriting = $_POST['memberWriting'];
	}

	if(isset($_SESSION['is_login'])) {
		$logIn = 'true';
	}

//글 삭제
	if($memberWriting == "true" && isset($logIn)){	// 로그인한 상태로 수정 및 등록을 실행 요청하고 실제로 로그인 상태가 유지되고 있을 때 실행
		//echo 'condition1';
		if(isset($bNo)) {
			//삭제 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크
			$sql = 'select count(bbs_password) as cnt from reviewBoard where bbs_password=password("' . $bPassword . '") and bbs_no = ' . $bNo;
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();

			//비밀번호가 맞다면 삭제 쿼리 작성
			if($row['cnt']) {
				$sql = 'delete from reviewBoard where bbs_no = ' . $bNo;
			//틀리다면 메시지 출력 후 이전화면으로
			} else {
				$msg = '비밀번호가 맞지 않습니다.';
			?>
				<script>
					alert("<?php echo $msg?>");
					history.back();
				</script>
			<?php
				exit;
			}
		}
			$result = $conn->query($sql);
	}else if($memberWriting == "true" && !isset($logIn)){	// 로그인한 상태로 수정 및 등록으로 들어왔으나 중간에 로그아웃하여 세션이 사라졌을 때
				//echo 'condition2';
			$msg = '비정상적 접근입니다.';
		?>
			<script>
				alert("<?php echo $msg?>");
				history.back();
			</script>
		<?php
			exit;
	}else if(!isset($memberWriting)){	// 비회원 글 등록 및 수정
				echo 'condition3';
		if(isset($bNo)) {
			//삭제 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크
			$sql = 'select count(bbs_password) as cnt from reviewBoard where bbs_password=password("' . $bPassword . '") and bbs_no = ' . $bNo;
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();

			//비밀번호가 맞다면 삭제 쿼리 작성
			if($row['cnt']) {
				$sql = 'delete from reviewBoard where bbs_no = ' . $bNo;
			//틀리다면 메시지 출력 후 이전화면으로
			} else {
				$msg = '비밀번호가 맞지 않습니다.';
			?>
				<script>
					alert("<?php echo $msg?>");
					history.back();
				</script>
			<?php
				exit;
			}
		}
			$result = $conn->query($sql);
	}


//쿼리가 정상 실행 됐다면,
if($result) {
	$msg = '정상적으로 글이 삭제되었습니다.';
	$replaceURL = './index.php';
} else {
	$msg = '글을 삭제하지 못했습니다.';
?>
	<script>
		alert("<?php echo $msg?>");
		history.back();
	</script>
<?php
	exit;
}


?>
<script>
	alert("<?php echo $msg?>");
	location.replace("<?php echo $replaceURL?>");
</script>
