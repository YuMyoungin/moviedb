<?php
include'/login/include/session.php';
include'/login/db_info.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>AGENCY INFO</title>
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
		<section>
			<?php
			$agName = $_GET['agName'];	
			$agInfoQuery = "SELECT agencynum, agencyaddress, agencyphone
						FROM agency
						WHERE agencyname = '{$agName}';";
			$agInfoResult = mysqli_query($dbConnect, $agInfoQuery);
			$row = mysqli_fetch_row($agInfoResult);
			$agNum=$row[0];
			$agAddress=$row[1];
			$agTel=$row[2];
			?>
			
			<?php
			echo "<img src='/img/agency/".$agNum.".jpg' alt='Agency'>";
			?>
			
			<hr  size="1px">
			<p><strong>INFO</strong></p>
			<p><b>소속사명: </b><?php echo "$agName"; ?></p>
			<p><b>주소: </b><?php echo "$agAddress"; ?></p>
			<p><b>전화번호: </b><?php echo "$agTel"; ?></p>
			<hr  size="1px" noshade />
			<p><strong>소속 배우</strong></p>
			<div class="child-page-listing" style="margin-top: 20px">
				<div class="grid-container">
			<?php 
				$aNumQuery="SELECT actor.actornum, actor.actorname
								FROM actor, actoragency, agency
								WHERE agency.agencynum='{$agNum}'
										and actor.actornum = actoragency.actornum
										and actoragency.agencynum = agency.agencynum;";
				$aNumResult = mysqli_query($dbConnect, $aNumQuery);
				
				while ($arow = mysqli_fetch_row($aNumResult)) {
					
					echo "<article id='".$arow[0]."' class='location-listing'>
					<a class='location-title' href='actorForm.php?aName=".$arow[1]."'> ".$arow[1]." </a>
					<div class='location-image'>
					<a href='#'> <img class='poster' src='/img/actor/".$arow[0].".jpg'> </a>
					</div>
					</article>";
				}
			?>
			</div>
		</section>
	</body>
</html>