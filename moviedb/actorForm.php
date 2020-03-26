<?php
include'/login/include/session.php';
include'/login/db_info.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ACTOR INFO</title>
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
			a.agency{
				text-decoration: none;
				color: black;
			}
			a.agency:hover{
				text-decoration: none;
				color: blue;
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
			$aName = $_GET['aName'];	
			$aInfoQuery = "SELECT actor.actornum , nationality.NationalityName, actor.ActorBirth
						FROM actor, nationality
						WHERE actor.ActorName = '{$aName}'
						and actor.NationalityNum = nationality.NationalityNum;";
			$aInfoResult = mysqli_query($dbConnect, $aInfoQuery);
			$row = mysqli_fetch_row($aInfoResult);
			$aNum=$row[0];
			$aNation=$row[1];
			$aBirth=$row[2];
			?>
			
			<?php
			echo "<img src='/img/actor/".$aNum.".jpg' alt='Actor'>";
			?>
			
			<hr  size="1px">
			<p><strong>INFO</strong></p>
			<p><b>이름: </b><?php echo "$aName"; ?></p>
			<p><b>소속사 : </b>
				<?php
				//소속사
				$agencyQuery ="SELECT agency.AgencyName
									FROM agency, actoragency, actor
									WHERE actor.ActorName = '{$aName}'
									and actor.ActorNum = actoragency.ActorNum
									and actoragency.AgencyNum = agency.AgencyNum;";
				$agResult = mysqli_query($dbConnect, $agencyQuery);
				$i=0;
				while($agRes2=mysqli_fetch_row($agResult)){
					if($i!=0){
						echo ", ";
					}
					$i++;
					echo "<a class='agency' href='agencyForm.php?agName=$agRes2[0]'>".$agRes2[0]."</a>";
				}
				?>
				</p>
			<p><b>국적: </b><?php echo "$aNation"; ?></p>
			<p><b>출생: </b><?php echo "$aBirth"; ?></p>
			<hr  size="1px" noshade />
			<p><strong>작품</strong></p>
			<div class="child-page-listing" style="margin-top: 20px">
				<div class="grid-container">
			<?php 
				$mNumQuery="SELECT movie.MovieNum, movie.MovieTitle
								FROM movie, actor, movieactor
								WHERE actor.ActorNum = '{$aNum}' 
										and movie.movienum = movieactor.MovieNum
										and movieactor.ActorNum = actor.ActorNum;";
				$mNumResult = mysqli_query($dbConnect, $mNumQuery);
				
				while ($row = mysqli_fetch_row($mNumResult)) {
					echo "<article id='".$row[0]."' class='location-listing'>
					<a class='location-title' href='movieIntroTest.php?mNum=".$row[0]."'> ".$row[1]." </a>
					<div class='location-image'>
					<a href='#'> <img class='poster' src='/img/".$row[0].".jpg'> </a>
					</div>
					</article>";
				}
			?>
			</div>
		</section>
	</body>
</html>