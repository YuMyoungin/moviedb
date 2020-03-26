<?php
include 'db_info.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>SIGNUP</title>
		<link rel="stylesheet" href="../menubar.css" />
		<link rel="stylesheet" href="form.css" />
		<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
		<script>
			function checkId() {
				var popupX = (screen.width / 2) - (300 / 2);
				var popupY = (screen.height / 2) - 300;
				
				var custId = document.getElementById("id").value;
				if (custId) {
					url = "check.php?custId=" + custId;
					window.open(url, "chkid", "width=350,height=100,left="+popupX+",top="+popupY+"");
				} else {
					alert("아이디를 입력하세요");
				}
			}
		</script>
	</head>
	<body>
		<header>
			<h1 align="center">MOVIE SEARCH</h1>
			<div class="menubar">
				<ul>
					<li><a href="../Home.php">Home</a></li>
					<li><a>한국영화</a>
						<ul>
							<li><a href="../posterList.php?cNum=1&gNum=1">액션</a></li>
							<li><a href="../posterList.php?cNum=1&gNum=2">코미디</a></li>
							<li><a href="../posterList.php?cNum=1&gNum=3">로맨스</a></li>
							<li><a href="../posterList.php?cNum=1&gNum=4">SF&amp;판타지</a></li>
							<li><a href="../posterList.php?cNum=1&gNum=5">범죄</a></li>
							<li><a href="../posterList.php?cNum=1&gNum=6">스릴러</a></li>
							<li><a href="../posterList.php?cNum=1&gNum=7">공포</a></li>
							<li><a href="../posterList.php?cNum=1&gNum=8">다큐멘터리</a></li>
							<li><a href="../posterList.php?cNum=1&gNum=9">기타</a></li>
						</ul>
					</li>
					<li><a>외국영화</a>
						<ul>
							<li><a href="../posterList.php?cNum=2&gNum=1">액션</a></li>
							<li><a href="../posterList.php?cNum=2&gNum=2">코미디</a></li>
							<li><a href="../posterList.php?cNum=2&gNum=3">로맨스</a></li>
							<li><a href="../posterList.php?cNum=2&gNum=4">SF&amp;판타지</a></li>
							<li><a href="../posterList.php?cNum=2&gNum=5">범죄</a></li>
							<li><a href="../posterList.php?cNum=2&gNum=6">스릴러</a></li>
							<li><a href="../posterList.php?cNum=2&gNum=7">공포</a></li>
							<li><a href="../posterList.php?cNum=2&gNum=8">다큐멘터리</a></li>
							<li><a href="../posterList.php?cNum=2&gNum=9">기타</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</header>
		<section>
			<div id="formBox">
				<div id="form">
					<form name="frm" action="signUp.php" method="post" enctype="multipart/form-data">
						<fieldset>
							<legend style="text-align: center">
								SIGNUP
							</legend>
							<table>
								<tr>
									<td>ID</td>
									<td>
									<input type="text" size="9" name="id" id="id" required>
									<input type="button" onclick="checkId();" value="중복확인">
									</td>
								</tr>
								<tr>
									<td>PW</td>
									<td>
									<input type="password" size="20" name="pw" required/>
									</td>
								</tr>
								<tr>
									<td>Confirm PW</td>
									<td>
									<input type="password" size="20" name="cPw">
									</td>
								</tr>
								<tr>
									<td>Name</td>
									<td>
									<input type="text" size="20" maxlength="10" name="name">
									</td>
								</tr>
								<tr>
									<td>Age</td>
									<td>
									<input type="number" maxlength="4" name="age">
									</td>
								</tr>
								<tr>
									<td>Sex</td>
									<td>
									<input type="radio" value="남자" name="sex"/>
									male
									<input type="radio" value="여자" name="sex"/>
									female </td>
								</tr>
							</table>
							<button type="submit" value="submit">
								<b>가입</b>
							</button>
							<button type="reset" value="reset">
								<b>재작성</b>
							</button>
						</fieldset>
					</form>
					<input type="hidden" name="idCheck" class="idCheck" />
				</div>
			</div>
		</section>
	</body>
</html>