<?php
include'/login/include/session.php';
include'/login/db_info.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>MyList</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="menubar.css" />
		<link rel="stylesheet" href="searchForm.css" />
		<link rel="stylesheet" href="list.css" />
	</head>
	<body>
		<header>
			<h1 align="center">MOVIE SEARCH</h1>
			
			<div class="menubar">
				<ul>
					<li><a href="Home.php">Home</a></li>
					<li><a>한국영화</a>
						<ul>
							<li><a href="posterList.php?cNum=1&gNum=1">액션</a></li>
							<li><a href="posterList.php?cNum=1&gNum=2">코미디</a></li>
							<li><a href="posterList.php?cNum=1&gNum=3">로맨스</a></li>
							<li><a href="posterList.php?cNum=1&gNum=4">SF&amp;판타지</a></li>
							<li><a href="posterList.php?cNum=1&gNum=5">범죄</a></li>
							<li><a href="posterList.php?cNum=1&gNum=6">스릴러</a></li>
							<li><a href="posterList.php?cNum=1&gNum=7">공포</a></li>
							<li><a href="posterList.php?cNum=1&gNum=8">다큐멘터리</a></li>
							<li><a href="posterList.php?cNum=1&gNum=9">기타</a></li>
						</ul>
					</li>
					<li><a>외국영화</a>
						<ul>
							<li><a href="posterList.php?cNum=2&gNum=1">액션</a></li>
							<li><a href="posterList.php?cNum=2&gNum=2">코미디</a></li>
							<li><a href="posterList.php?cNum=2&gNum=3">로맨스</a></li>
							<li><a href="posterList.php?cNum=2&gNum=4">SF&amp;판타지</a></li>
							<li><a href="posterList.php?cNum=2&gNum=5">범죄</a></li>
							<li><a href="posterList.php?cNum=2&gNum=6">스릴러</a></li>
							<li><a href="posterList.php?cNum=2&gNum=7">공포</a></li>
							<li><a href="posterList.php?cNum=2&gNum=8">다큐멘터리</a></li>
							<li><a href="posterList.php?cNum=2&gNum=9">기타</a></li>
						</ul>
					</li>
					<?php
					if(isset($_SESSION['userid'])){
						echo '<li class="rightLogin" style="margin-top: 15px; color: white;">'.$_SESSION['userid'].'님 안녕하신갑숑'.'
						<ul>
							<li><a href="showMylist.php">MyList</a></li>
							<li><a href="/login/logout.php">Logout</a></li>
						</ul></li></div>';
					} else {
						echo '<li class="rightLogin"><a href="/login/login.html">Login</a></li>';
					}
					?>
				</ul>
			</div>
		</header>
        <section><strong>찜목록</strong></section>
		<section>
			<div class="child-page-listing" style="margin-top: 20px">
				<div class="grid-container">
					<?php
					$uID=$_SESSION['userid'];
					$mylistQuery="SELECT MOVIE.MOVIENUM, MOVIE.MOVIETITLE
										FROM USER, MYLIST, MOVIE
										WHERE USER.USERID = '{$uID}'
												AND USER.USERNUM = MYLIST.USERNUM
												AND MYLIST.MOVIENUM = MOVIE.MOVIENUM;";
					$result = mysqli_query($dbConnect, $mylistQuery);

					while ($row = mysqli_fetch_row($result)) {
			
						echo "<article id='".$row[0]."' class='location-listing'>
						<a class='location-title' href='movieIntroTest.php?mNum=".$row[0]."'> ".$row[1]." </a>
						<div class='location-image'>
						<a href='#'> <img class='poster' src='./img/".$row[0].".jpg'> </a>
						</div>
						</article>";
					}
					?>
			</div>
		</section>
	</body>
</html>