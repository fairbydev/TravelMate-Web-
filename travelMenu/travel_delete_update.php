<?php
  session_start();
	require_once("../dbconfig.php");

	//$_POST['pno']이 있을 때만 $pno 선언
	if(isset($_POST['pno'])) {
		$pno = $_POST['pno'];
	}

	$posting_password = $_POST['posting_password'];

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
		if(isset($pno)) {
			//삭제 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크
			$sql = 'select count(posting_password) as cnt from travelBoard where posting_password=password("' . $posting_password . '") and pno = ' . $pno;
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();

			//비밀번호가 맞다면 삭제 쿼리 작성
			if($row['cnt']) {
				$sql = 'delete from travelBoard where pno = ' . $pno;
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
		if(isset($pno)) {
			//삭제 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크
			$sql = 'select count(posting_password) as cnt from travelBoard where posting_password=password("' . $posting_password . '") and pno = ' . $pno;
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();

			//비밀번호가 맞다면 삭제 쿼리 작성
			if($row['cnt']) {
				$sql = 'delete from travelBoard where pno = ' . $pno;
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
	$replaceURL = './travelList.php';
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
