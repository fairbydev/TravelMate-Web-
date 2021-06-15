<?php
	session_start();

	//세션 정보
  $is_login = $_SESSION['is_login'];  //로그인 엽
  $id = $_SESSION['id'];    //사용자 id
  $nickname = $_SESSION['nickname'];  //사용자 닉네임

	$sql = 'select * from comment_free where co_no=co_order and bbs_no=' . $bNo;
	$result = $conn->query($sql);
?>



<div id="commentView">
	<form action="comment_update.php" method="post">
		<input type="hidden" name="bno" value="<?php echo $bNo?>">

    <!-- //1depth출력 -->
		<?php
			while($row = $result->fetch_assoc()) {
		?>
		<ul class="oneDepth list-group">
			<li class="list-group-item">
				<div id="co_<?php echo $row['co_no']?>" class="commentSet">
					<div class="commentInfo">
						<div class="commentId">작성자: <span class="coId"><?php echo $row['co_nickname']?></span></div>
						<div class="commentBtn">

							<?php
								if($is_login !== true && !isset($nickname)){ //1. 비회원이 댓글을 보면 모든 글 댓글, 수정, 삭제 접근은 가능하나 비밀번호 요구
									?>
									<a href="#" class="comt write">댓글</a>
									<a href="#" class="comt modify">수정</a>
									<a href="#" class="comt delete">삭제</a>
									<?php
								}else if($is_login === true && $nickname !== $row['co_nickname']){	//2. 회원이 댓글을 보는데 자신의 댓글이 아니면 수정/삭제가 나타나지 않음
									?>
									<a href="#" class="comt write">댓글</a>
									<?php
								}else if($is_login === true && $nickname === $row['co_nickname']){	// 3. 자신의 글이라 댓글, 수정, 삭제 모두 가능
									?>
									<a href="#" class="comt write">댓글</a>
									<a href="#" class="comt modify">수정</a>
									<a href="#" class="comt delete">삭제</a>
									<?php
								}
							?>

						</div>
					</div>
					<div class="commentContent"><?php echo $row['co_content']?></div>
				</div>

        <!-- //2depth 출력 -->
				<?php
					$sql2 = 'select * from comment_free where co_no!=co_order and co_order=' . $row['co_no'];
					$result2 = $conn->query($sql2);

					while($row2 = $result2->fetch_assoc()) {
				?>
				<ul class="twoDepth list-group">
					<li class="list-group-item">
						<div id="co_<?php echo $row2['co_no']?>" class="commentSet">
							<div class="commentInfo">
								<div class="commentId">작성자:  <span class="coId"><?php echo $row2['co_nickname']?></span></div>
								<div class="commentBtn">
									<!-- <a href="#" class="comt modify">수정</a>
									<a href="#" class="comt delete">삭제</a> -->

									<?php
										if($is_login !== true && !isset($nickname)){ //1. 비회원이 댓글을 보면 모든 글 댓글, 수정, 삭제 접근은 가능하나 비밀번호 요구
											?>
											<a href="#" class="comt modify">수정</a>
											<a href="#" class="comt delete">삭제</a>
											<?php
										}else if($is_login === true && $nickname !== $row2['co_nickname']){	//2. 회원이 댓글을 보는데 자신의 댓글이 아니면 수정/삭제가 나타나지 않음
											?>
											<!-- 실행내용없음 -->
											<?php
										}else if($is_login === true && $nickname === $row2['co_nickname']){	// 3. 자신의 글이라 댓글, 수정, 삭제 모두 가능
											?>
											<a href="#" class="comt modify">수정</a>
											<a href="#" class="comt delete">삭제</a>
											<?php
										}
									?>

								</div>
							</div>
							<div class="commentContent"><?php echo $row2['co_content'] ?></div>
						</div>
					</li>
				</ul>
				<?php
					}
				?>
			</li>
		</ul>
		<?php } ?>
	</form>
</div>
<form action="comment_update.php" method="post">
	<input type="hidden" name="bno" value="<?php echo $bNo?>">
	<table border="1" >
		<tbody>
			<tr>
				<th scope="row"><label for="coId">닉네임</label></th>
				<?php
					if($is_login == true && isset($nickname)){ //1. 회원 댓글 작성시
						?>
						<td><label><?php echo $nickname; ?></label></td>
						<input type="hidden" name="coId" id="coId" class="form-control" value="<?php echo $nickname ?>">
						<?php
					}else{	//2. 비회원 댓글 작성시
						?>
						<td><input type="text" name="coId" id="coId" class="form-control"></td>
						<input type="hidden" name="guestCheck" id="guestCheck" class="form-control" value="true">

						<?php
					}
				?>
			</tr>
					<?php
						if($is_login !== true && !isset($nickname)){ //1. 비회원 댓글 작성시 비밀번호 입력란 표시
							?>
							<tr>
			<th scope="row">
				<label for="coPassword">비밀번호</label></th>
							<td><input type="password" name="coPassword" id="coPassword" class="form-control" ></td>
			</tr>
							<?php
						}else{	//2. 회원 댓글 작성시 코멘트 비밀번호 히든으로 입력
							?>
							<input type="hidden" name="coPassword" id="coPassword" class="form-control" value="<?php echo $nickname ?>">
							<?php
						}
					?>
			<tr>
				<th scope="row"><label for="coContent">내용</label></th>
				<td><textarea name="coContent" id="coContent" style="width:100%;border:1;overflow:visible;text-overflow:ellipsis;" rows=5></textarea></td>
			</tr>
		</tbody>
	</table>

	<div class="btnSet">
		<input type="submit" value="댓글 작성">
	</div>
</form>

<script>
	$(document).ready(function () {
		var action = '';

		$('#commentView').delegate('.comt', 'click', function () {
			//현재 위치에서 가장 가까운 commentSet 클래스를 변수에 넣는다.
			var thisParent = $(this).closest('.commentSet');

			//현재 작성 내용을 변수에 넣고, active 클래스 추가.
			var commentSet = thisParent.html();
			thisParent.addClass('active');

			//취소 버튼
			var commentBtn = '<a href="#" class="addComt cancel">취소</a>';

			//버튼 삭제 & 추가
			$('.comt').hide();
			$(this).parents('.commentBtn').append(commentBtn);


			//commentInfo의 ID를 가져온다.
			var co_no = thisParent.attr('id');

			//전체 길이에서 3("co_")를 뺀 나머지가 co_no
			co_no = co_no.substr(3, co_no.length);

			//변수 초기화
			var comment = '';
			var coId = '';
			var coContent = '';

			if($(this).hasClass('write')) {
				//댓글 쓰기
				action = 'w';
				//ID 영역 출력
				//coId = '<input type="text" name="coId" id="coId">';

				<?php
					if($is_login == true && isset($nickname)){ //1. 회원 댓글 작성시
						?>
						coId = '<label><?php echo $nickname ?></label> <input type="hidden" name="coId" id="coId" class="form-control" value="<?php echo $nickname ?>">';
						<?php
					}else{	//2. 비회원 댓글 작성시
						?>
						coId = '<input type="text" name="coId" id="coId">';
						<?php
					}
				?>

			} else if($(this).hasClass('modify')) {
				//댓글 수정
				action = 'u';

				coId = thisParent.find('.coId').text();
				var coContent = thisParent.find('.commentContent').text();

			} else if($(this).hasClass('delete')) {
				//댓글 삭제
				action = 'd';
			}

				comment += '<div class="writeComment">';
				comment += '	<input type="hidden" name="w" value="' + action + '">';
				comment += '	<input type="hidden" name="co_no" value="' + co_no + '">';
				comment += '	<table>';
				comment += '		<tbody>';
				if(action !== 'd') {
					comment += '			<tr>';
					comment += '				<th scope="row"><label for="coId">닉네임</label></th>';
					comment += '				<td>' + coId + '</td>';
					comment += '			</tr>';
				}


				// comment += '			<tr>';
				// comment += '				<th scope="row">';
				// comment += '			<label for="coPassword">비밀번호</label></th>';
				// comment += '				<td><input type="password" name="coPassword" id="coPassword"></td>';
				// comment += '			</tr>';
				<?php
					if($is_login !== true && !isset($nickname)){ //1. 비회원 댓글 작성시 비밀번호 입력란 표시
						?>
						comment += '			<tr>';
						comment += '				<th scope="row">';
						comment += '			<label for="coPassword">비밀번호</label></th>';
						comment += '				<td><input type="password" name="coPassword" id="coPassword"></td>';
						comment += '			</tr>';
						<?php
					}else if($is_login === true && $nickname != $row['co_nickname']){	//2. 댓글의 작성자와 로그인 회원의 닉네임이 다를 경우
						?>
						comment += '<input type="hidden" name="coPassword" id="coPassword" class="form-control" value="<?php echo $nickname ?>">';
						<?php
					}else{	//2. 회원 댓글 작성시 코멘트 비밀번호 히든으로 입력
						?>
						comment += '<input type="hidden" name="coPassword" id="coPassword" class="form-control" value="<?php echo $nickname ?>">';
						<?php
					}
				?>

				if(action !== 'd') {
					comment += '			<tr>';
					comment += '				<th scope="row"><label for="coContent">내용</label></th>';
					comment += '				<td><textarea name="coContent" id="coContent">' + coContent + '</textarea></td>';
					comment += '			</tr>';
				}
				comment += '		</tbody>';
				comment += '	</table>';
				comment += '	<div class="btnSet">';
				comment += '		<input type="submit" value="확인">';
				comment += '	</div>';
				comment += '</div>';

				thisParent.after(comment);
			return false;
		});

		$('#commentView').delegate(".cancel", "click", function () {
				$('.writeComment').remove();
				$('.commentSet.active').removeClass('active');
				$('.addComt').remove();
				$('.comt').show();
			return false;
		});
	});
</script>
