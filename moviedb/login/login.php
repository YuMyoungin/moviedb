<!DOCTYPE html>
<html>
	<head>
		<title>LOGIN</title>
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
    				include"/include/session.php";
    				include"/include/dbConnect.php";

				    $custId = $_POST['id'];
				    $custPassword = $_POST['pw'];    


				    $sql = "SELECT * FROM user WHERE userid = '{$custId}' AND userpassword = '{$custPassword}'";
				    $res = mysqli_query($dbConnect,$sql);
					if($res->num_rows!=0){
						$_SESSION['userid']=$custId;
						if(isset($_SESSION['userid'])){
							echo '<br>';
							echo $custId.'님 안녕하세요!';
							echo '<br>';
							echo '<br>';
							echo "<a href='../Home.php'>시작하기!</a>";
							}
							else {
								echo '<br>';
								echo "세션 저장 실패";	
							}
						}
						else {
							echo "Your Login Name or Password is invalid";
							echo "<br><a href='login.html'>뒤로가기</a>";
						}
				?>
			</div>
		</section>
</html>