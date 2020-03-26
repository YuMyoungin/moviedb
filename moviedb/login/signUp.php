<?php
	include'db_info.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>SIGNUP</title>
		<meta charshet="UTF-8">
		<link rel="stylesheet" href="../menubar.css" />
		<link rel="stylesheet" href="form.css" />
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
			<div align="center">
				<?php
				$id = $_POST['id'];
				$pw = $_POST['pw'];
				$cpw = $_POST['cPw'];
				$name = $_POST['name'];
				$age = $_POST['age'];
				$sex = $_POST['sex'];

				$name = iconv("UTF-8", "EUC-KR", $name);
				$sex = iconv("UTF-8", "EUC-KR", $sex);

				$mysqli = mysqli_connect("localhost", "root", "", "moviedb") or die("실패ㅡㅡ");


				$sql = "SELECT * FROM user WHERE userid = '{$id}'";
				$res = $mysqli -> query($sql);

				if ($res -> num_rows >= 1) {
					echo '이미 존재하는 아이디가 있습니다.' . '<br>';
					echo '<a href="signUpNew.php">뒤로가기</a>';
					exit();
				}

				if ($pw != $cpw) {
					echo '비밀번호가 일치하지 않습니다.' . '<br>';
					echo '<a href="signUpNew.php">뒤로가기</a>';
					exit();
				}

				$signup = mysqli_query($mysqli, "INSERT INTO user VALUES (NULL, '$id', '$pw', '$name', '$age', '$sex');");

				if ($signup) {
					echo "축하합니다!" . "<br>";
					echo "<a href='login.html'>로그인하기</a>";
				} else {
					echo "회원가입 실패!!!" . "<br>";
					echo "<a href='login.html'>로그인 페이지로 가기</a>";
				}
				?>
			</div>
		</section>
</html>
