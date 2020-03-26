<?php
include'/login/include/session.php';
include'/login/db_info.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>DIRECTOR INFO</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="menubar.css" />
		<link rel="stylesheet" href="searchForm.css" />
		<link rel="stylesheet" href="list.css" />
		<style>
			button.movieForm{
				margin-top: 10px;
				margin-bottom: 10px;
				border: 1px solid rgb(109,109,109);
				background-color: rgba(0,0,0,0);
				padding: 5px;
			}
			
			button.movieForm:hover{
				color:white;
				background-color: rgb(71,71,71);
			}
		</style>
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
		<section>
			<?php
			$dName = $_GET['dName'];	
			$dInfoQuery = "SELECT director.DirectorNum, nationality.NationalityName, director.DirectorBirth
								FROM director, nationality
								WHERE director.DirectorName = '{$dName}'
										and director.NationalityNum = nationality.NationalityNum;";
			$dInfoResult = mysqli_query($dbConnect, $dInfoQuery);
			$row = mysqli_fetch_row($dInfoResult);
			$dNum=$row[0];
			$dNation=$row[1];
			$dBirth=$row[2];
			?>
			
			<?php
			echo "<img src='./img/director/".$dNum.".jpg' alt='director'>";
			?>
			
			<hr  size="1px">
			<p><strong>INFO</strong></p>
			<p><b>이름: </b><?php echo "$dName"; ?></p>
			<p><b>국적: </b><?php echo "$dNation"; ?></p>
			<p><b>출생: </b><?php echo "$dBirth"; ?></p>
			<hr  size="1px" noshade />
			<p><strong>작품</strong></p>
			<div class="child-page-listing" style="margin-top: 20px">
				<div class="grid-container">
				<?php 
				$mNumQuery="SELECT movie.MovieNum, movie.MovieTitle
								FROM movie, director, moviedirector
								WHERE director.directorNum = '{$dNum}' 
										and movie.movienum = moviedirector.MovieNum
										and moviedirector.directorNum = director.directorNum;";
				$mNumResult = mysqli_query($dbConnect, $mNumQuery);
				
				while ($row = mysqli_fetch_row($mNumResult)) {
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