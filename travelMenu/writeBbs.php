<?php
date_default_timezone_set("Asia/Seoul");

	require_once("../dbconfig.php");



//글 등록

  for ($i=0; $i <120 ; $i++) {
    $sql = 'insert into reviewBoard (bbs_no, bbs_title, bbs_content, bbs_date, bbs_hit, bbs_nickname, bbs_password)
            values(null, "' . 'title'.$i. '", "' . 'content'.$i. '", "' . $date . '", 0, "' . 'nickname'.$i . '", password("' . $i . '"))';

	$sql = 'insert into travelBoard (pno, nickname, posting_password, posting_title, posting_subtitle, posting_ddate, posting_rdate, posting_expireDate,
					posting_locationCode, posting_place, posting_gender, posting_maxperson, posting_contact, posting_content, posting_pic, posting_hit)
          values(null, "부산사나이", password("seaman1111"), "부산 맛집 투어", "해산물 덕후 모두 모여라", "2017-05-25", "2017-05-26", "2017-05-21",
					 "경상도", "자갈치 시작을 중심으로 시작", "N", "5", "카톡아이디 seaman01", "부산에서 1박 2일 식도락가들을 모십니다", "../images/uploads/부산.jpg", "0")';


					 insert into travelBoard (pno, nickname, posting_password, posting_title, posting_subtitle, posting_ddate, posting_rdate, posting_expireDate,
					 				posting_locationCode, posting_place, posting_gender, posting_maxperson, posting_contact, posting_content, posting_pic, posting_hit)
					 				values(null, "부산사나이", password("seaman1!"), "부산 맛집 투어", "해산물 덕후 모두 모여라", "2017-05-25", "2017-05-26", "2017-05-21",
					 				 "경상도", "자갈치 시작을 중심으로 시작", "N", "5", "카톡아이디 seaman01", "부산에서 1박 2일 식도락가들을 모십니다", "../images/uploads/부산.jpg", "0");


insert into travelBoard (pno, nickname, posting_password, posting_title, posting_subtitle, posting_ddate, posting_rdate, posting_expireDate,
posting_locationCode, posting_place, posting_gender, posting_maxperson, posting_contact, posting_content, posting_pic, posting_hit)
values(null, "4번째", password("testtest4"), "서울 한강 투어", "밤도꺠비 야시장도 고고", "2017-05-25", "2017-05-25", "2017-05-21",
"서울", "여의도 한강 공원을 중심으로 시작", "N", "4", "카톡아이디 seoul555", "즐거운 저녁을 보내보아요!", "../images/uploads/seoul.jpeg", "0");

insert into travelBoard (pno, nickname, posting_password, posting_title, posting_subtitle, posting_ddate, posting_rdate, posting_expireDate,
posting_locationCode, posting_place, posting_gender, posting_maxperson, posting_contact, posting_content, posting_pic, posting_hit)
values(null, "4번째", password("testtest4"), "인천 맛집투어", "소래포구와 차이나타운을 가다", "2017-05-25", "2017-05-25", "2017-05-15",
"경기도", "차이나타운, 소래포구", "F", "6", "카톡아이디 inchoen555", "인천의 맛을 위하여!", "../images/uploads/incheon.jpg", "0");

insert into travelBoard (pno, nickname, posting_password, posting_title, posting_subtitle, posting_ddate, posting_rdate, posting_expireDate,
posting_locationCode, posting_place, posting_gender, posting_maxperson, posting_contact, posting_content, posting_pic, posting_hit)
values(null, "4번째", password("testtest4"), "대관령 양떼목장", "양고기도 먹고 치즈도 먹자", "2017-05-25", "2017-05-27", "2017-05-21",
"강원도", "대관령 일대", "N", "9", "카톡아이디 kang555", "시원한 대관령과 귀여운 양뗴 체험!", "../images/uploads/kangwon.jpg", "0");

insert into travelBoard (pno, nickname, posting_password, posting_title, posting_subtitle, posting_ddate, posting_rdate, posting_expireDate,
posting_locationCode, posting_place, posting_gender, posting_maxperson, posting_contact, posting_content, posting_pic, posting_hit)
values(null, "4번째", password("testtest4"), "충청도 괴산 등반", "등산으로 챙기는 건강", "2017-05-25", "2017-05-25", "2017-05-21",
"충청도", "오송역에서 모여 출발", "M", "7", "카톡아이디 mountain", "등산 후 회식 진행합니다!", "../images/uploads/chung.jpg", "0");

insert into travelBoard (pno, nickname, posting_password, posting_title, posting_subtitle, posting_ddate, posting_rdate, posting_expireDate,
posting_locationCode, posting_place, posting_gender, posting_maxperson, posting_contact, posting_content, posting_pic, posting_hit)
values(null, "4번째", password("testtest4"), "대구 팔공산 기도", "부처님 믿고 성불하세요", "2017-05-25", "2017-05-25", "2017-05-22",
"경상도", "경북 팔공산 갓바위", "N", "9", "카톡아이디 buddhaYo", "보살님들의 많은 참여바랍니다.", "../images/uploads/daegu.jpg", "0");

insert into travelBoard (pno, nickname, posting_password, posting_title, posting_subtitle, posting_ddate, posting_rdate, posting_expireDate,
posting_locationCode, posting_place, posting_gender, posting_maxperson, posting_contact, posting_content, posting_pic, posting_hit)
values(null, "4번째", password("testtest4"), "전남 순천만 여행", "자연의 포근함을 느껴보세요", "2017-05-25", "2017-05-29", "2017-05-22",
"전라도", "순천역에서 출발", "F", "4", "카톡아이디 nature11", "남도식 백반도 함께 먹어요!", "../images/uploads/geonra.jpg", "0");

insert into travelBoard (pno, nickname, posting_password, posting_title, posting_subtitle, posting_ddate, posting_rdate, posting_expireDate,
posting_locationCode, posting_place, posting_gender, posting_maxperson, posting_contact, posting_content, posting_pic, posting_hit)
values(null, "4번째", password("testtest4"), "제주 올레길 여행", "일주일간의 아름다운 여정", "2017-05-23", "2017-05-29", "2017-05-23",
"제주도", "제주 올레길 탐방", "N", "3", "카톡아이디 island", "게스트 하우스도 같이 잡으면 좋겠네요!", "../images/uploads/jeju.jpg", "0");
-----------------------------------------------------------------------------------------------------------------------------------------------


insert into travelBoard (pno, nickname, posting_password, posting_title, posting_subtitle, posting_ddate, posting_rdate, posting_expireDate,
posting_locationCode, posting_place, posting_gender, posting_maxperson, posting_contact, posting_content, posting_pic, posting_hit)
values(null, "testtest1", password("testtest1"), "서울 한강 투어", "밤도꺠비 야시장도 고고", "2017-05-25", "2017-05-25", "2017-05-21",
"서울", "여의도 한강 공원을 중심으로 시작", "N", "4", "카톡아이디 seoul555", "즐거운 저녁을 보내보아요!", "../images/uploads/seoul.jpeg", "0");

insert into travelBoard (pno, nickname, posting_password, posting_title, posting_subtitle, posting_ddate, posting_rdate, posting_expireDate,
posting_locationCode, posting_place, posting_gender, posting_maxperson, posting_contact, posting_content, posting_pic, posting_hit)
values(null, "testtest1", password("testtest1"), "인천 맛집투어", "소래포구와 차이나타운을 가다", "2017-05-25", "2017-05-25", "2017-05-15",
"경기도", "차이나타운, 소래포구", "F", "6", "카톡아이디 inchoen555", "인천의 맛을 위하여!", "../images/uploads/incheon.jpg", "0");

insert into travelBoard (pno, nickname, posting_password, posting_title, posting_subtitle, posting_ddate, posting_rdate, posting_expireDate,
posting_locationCode, posting_place, posting_gender, posting_maxperson, posting_contact, posting_content, posting_pic, posting_hit)
values(null, "testtest1", password("testtest1"), "대관령 양떼목장", "양고기도 먹고 치즈도 먹자", "2017-05-25", "2017-05-27", "2017-05-21",
"강원도", "대관령 일대", "N", "9", "카톡아이디 kang555", "시원한 대관령과 귀여운 양뗴 체험!", "../images/uploads/kangwon.jpg", "0");

insert into travelBoard (pno, nickname, posting_password, posting_title, posting_subtitle, posting_ddate, posting_rdate, posting_expireDate,
posting_locationCode, posting_place, posting_gender, posting_maxperson, posting_contact, posting_content, posting_pic, posting_hit)
values(null, "testtest1", password("testtest1"), "충청도 괴산 등반", "등산으로 챙기는 건강", "2017-05-25", "2017-05-25", "2017-05-21",
"충청도", "오송역에서 모여 출발", "M", "7", "카톡아이디 mountain", "등산 후 회식 진행합니다!", "../images/uploads/chung.jpg", "0");

insert into travelBoard (pno, nickname, posting_password, posting_title, posting_subtitle, posting_ddate, posting_rdate, posting_expireDate,
posting_locationCode, posting_place, posting_gender, posting_maxperson, posting_contact, posting_content, posting_pic, posting_hit)
values(null, "testtest1", password("testtest1"), "대구 팔공산 기도", "부처님 믿고 성불하세요", "2017-05-25", "2017-05-25", "2017-05-22",
"경상도", "경북 팔공산 갓바위", "N", "9", "카톡아이디 buddhaYo", "보살님들의 많은 참여바랍니다.", "../images/uploads/daegu.jpg", "0");

insert into travelBoard (pno, nickname, posting_password, posting_title, posting_subtitle, posting_ddate, posting_rdate, posting_expireDate,
posting_locationCode, posting_place, posting_gender, posting_maxperson, posting_contact, posting_content, posting_pic, posting_hit)
values(null, "testtest1", password("testtest1"), "전남 순천만 여행", "자연의 포근함을 느껴보세요", "2017-05-25", "2017-05-29", "2017-05-22",
"전라도", "순천역에서 출발", "F", "4", "카톡아이디 nature11", "남도식 백반도 함께 먹어요!", "../images/uploads/geonra.jpg", "0");

insert into travelBoard (pno, nickname, posting_password, posting_title, posting_subtitle, posting_ddate, posting_rdate, posting_expireDate,
posting_locationCode, posting_place, posting_gender, posting_maxperson, posting_contact, posting_content, posting_pic, posting_hit)
values(null, "testtest1", password("testtest1"), "제주 올레길 여행", "일주일간의 아름다운 여정", "2017-05-23", "2017-05-29", "2017-05-23",
"제주도", "제주 올레길 탐방", "N", "3", "카톡아이디 island", "게스트 하우스도 같이 잡으면 좋겠네요!", "../images/uploads/jeju.jpg", "0");


-----------------------------------------------------------------------------------------------------------------------------------------------
insert into travelBoard (pno, nickname, posting_password, posting_title, posting_subtitle, posting_ddate, posting_rdate, posting_expireDate,
posting_locationCode, posting_place, posting_gender, posting_maxperson, posting_contact, posting_content, posting_pic, posting_hit)
values(null, "부산사나이", password("seaman1111"), "부산 맛집 투어", "해산물 덕후 모두 모여라", "2017-05-25", "2017-05-26", "2017-05-21",
"경상도", "자갈치 시작을 중심으로 시작", "N", "5", "카톡아이디 seaman01", "부산에서 1박 2일 식도락가들을 모십니다", "../images/uploads/부산.jpg", "0");











    $result = $conn->query($sql);

  }
  $msgState = '등록';



//메시지가 없다면 (오류가 없다면)
if(empty($msg)) {
	// $result = $conn->query($sql);

	//쿼리가 정상 실행 됐다면,
	if($result) {
		$msg = '정상적으로 글이 ' . $msgState . '되었습니다.';
		if(empty($bNo)) {
			$bNo = $conn->insert_id;
		}
		$replaceURL = './view.php?bno=' . $bNo;
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
