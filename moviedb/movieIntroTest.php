<?php
include'/login/include/session.php';
include'/login/db_info.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>MOVIE INFO</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="menubar.css" />
		<link rel="stylesheet" href="searchForm.css" />
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
			a.director{
				text-decoration: none;
				color: black;
			}
			a.director:hover{
				text-decoration: none;
				color: blue;
			}
			a.actor{
				text-decoration: none;
				color: black;
			}
			a.actor:hover{
				text-decoration: none;
				color: blue;
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
			$mNum = $_GET['mNum'];
			//무비넘버
			$query = "SELECT movieTitle FROM movie WHERE movienum='{$mNum}'";
			$result = mysqli_query($dbConnect, $query);
			$res2=mysqli_fetch_row($result);
			$mTitle=$res2[0];
			
			//제조국, 제조년도
			$npQuery = "SELECT nationality.NationalityName, movie.ProductionYear
										FROM movie, nationality
										WHERE movie.movienum = '{$mNum}'
										and movie.ProductionCountry=nationality.NationalityNum;";
			$npResult = mysqli_query($dbConnect, $npQuery);
			$npRes2=mysqli_fetch_row($npResult);
			$nName=$npRes2[0];
			$pDate=$npRes2[1];
			
			echo '<h2><'.$mTitle.'></h2>';
			echo "<img src='./img/".$mNum.".jpg' alt='Poster'>";
			?>
			
			<?php
				if(isset($_SESSION['userid'])){
					$uNumQuery="SELECT usernum FROM user WHERE userid='{$_SESSION['userid']}';";
					$uNumResult=mysqli_query($dbConnect, $uNumQuery);
					$uNumRes2=mysqli_fetch_row($uNumResult);
					$uNum=$uNumRes2[0];
				
					$mylistQuery="SELECT * FROM myList WHERE usernum='{$uNum}' and movienum='{$mNum}';";
					$mylistResult=mysqli_query($dbConnect, $mylistQuery);
					$mylistRes2=mysqli_fetch_row($mylistResult);
					$tfHeart=mysqli_num_rows($mylistResult);	
				}
			?>
			
			<button type="button" style="border: 0; background-color: white;" 
			onclick="location.href='mylist.php?uNum=<?php echo "$uNum"; ?>&mNum=<?php echo "$mNum"; ?>&tfHeart=<?php echo "$tfHeart"; ?>&listNum=<?php echo "$mylistRes2[0]"; ?>'">
			
			<?php
				
				if(isset($_SESSION['userid'])){
					if(mysqli_num_rows($mylistResult)==1){
						echo "<img src='./img/trueHeart.png' alt='true'/>";
					} else {
						echo "<img src='./img/falseHeart.png' alt='false'/>";
					}
				} else {
					echo "<img src='/img/falseHeart.png' alt='false'/>";
				}
			?>
			</button>
			
			
			<hr  size="1px">
			
			<p><strong>INFOINFOINFO</strong></p>
			<p><b>제조국: </b><?php echo "$nName"; ?>, <b>제조년도: </b><?php echo "$pDate"; ?></p>
			<p><b>장르: </b>
				<?php
				//장르
				$genreQuery ="SELECT genre.GenreName
								FROM movie, genre , moviegenre
								WHERE movie.movienum = '{$mNum}'
									and movie.MovieNum = moviegenre.MovieNum
									and moviegenre.GenreNum = genre.GenreNum;";
				$gResult = mysqli_query($dbConnect, $genreQuery);
				$i=0;
				while($gRes2=mysqli_fetch_row($gResult)){
					if($i!=0){
						echo ", ";
					}
					$i++;
					echo "$gRes2[0]";
				}
			?>
			</p>
			<p><b>감독 : </b>
				<?php
				//감독
				$directorQuery ="SELECT director.DirectorName
								FROM movie, director, moviedirector
								WHERE movie.MovieNum = '{$mNum}'
										and movie.movienum = moviedirector.MovieNum
										and moviedirector.DirectorNum = director.DirectorNum;";
				$dResult = mysqli_query($dbConnect, $directorQuery);
				$i=0;
				while($dRes2=mysqli_fetch_row($dResult)){
					if($i!=0){
						echo ", ";
					}
					$i++;
					echo "<a class='director' href='directorForm.php?dName=$dRes2[0]'>".$dRes2[0]."</a>";
				}
				?>
				</p>
			<p><b>배우 : </b>
				<?php
				//배우
				$actorQuery ="SELECT actor.actorname
								FROM actor, movieactor, movie
								WHERE movie.MovieNum = '{$mNum}'
										and movie.movienum = movieactor.movienum
										and movieactor.actorNum = actor.ActorNum;";
				$aResult = mysqli_query($dbConnect, $actorQuery);
				$i=0;
				while($aRes2=mysqli_fetch_row($aResult)){
					if($i!=0){
						echo ", ";
					}
					$i++;
					echo "<a class='actor' href='actorForm.php?aName=$aRes2[0]'>".$aRes2[0]."</a>";
				}
				?>
				</p>
			<p class="url"><strong>STORY</strong></p>
			<?php
				$storyQuery="SELECT summary FROM movie WHERE movienum='{$mNum}';";
				$storyResult=mysqli_query($dbConnect, $storyQuery);
				$storyRes2=mysqli_fetch_row($storyResult);
				echo "$storyRes2[0]";
			?>
			
			<hr  size="1px" noshade />
			<?php
			echo '<form method="get" action="addReview.php?mNum='.$mNum.'">';
			?>
				<table style="margin-left: 0px; text-align: left">
					<tr>
						<th>평점</th>
						<th>리뷰</th>
					</tr>
					<tr>
						<td>
  							<select name = "star">						       
						       <option value = "1">★☆☆☆☆</option>
						       <option value = "2">★★☆☆☆</option>
						       <option value = "3">★★★☆☆</option>
						       <option value = "4">★★★★☆</option>
						       <option value = "5" selected>★★★★★</option>
						    </select>
						</td>
						<td>
							<textarea name="review" cols="70" rows="3"></textarea>
						</td>
						<td>
							<?php
							echo '<input type="hidden" class="movieForm" name="nowMnum" value="'.$mNum.'" />';
							?>
						</td>
						<td>
							<button type='submit' class='movieForm' value='submit'><b>확인</b></button>
						</td>
					</tr>
				</table>
			</form>
			<form>
				<table style="margin-left: 0px; text-align: left">
					<?php	
						$query = 'SELECT grade, review, userid, gradereviewno FROM gradereview, user 
									WHERE movienum='.$mNum.' and gradereview.usernum=user.usernum;';
						$result = mysqli_query($dbConnect, $query);
						
						if(mysqli_num_rows($result)!=0){
							while($row=mysqli_fetch_row($result)){
							if($row[0]==1){
								$rating="★☆☆☆☆";
							} else if($row[0]==2){
								$rating =  "★★☆☆☆";
							} else if($row[0]==3){
								$rating =  "★★★☆☆";
							} else if($row[0]==4){
								$rating =  "★★★★☆";
							} else if($row[0]==5){
								$rating =  "★★★★★";
							}

							echo "<form method='get' action='deleteReview.php?$mNum'>
							<table style='margin-left: 0px; text-align: left'>
							<tr><td width='95'>$rating</td><td width='520'>$row[1]</td>
							<td width='100'>$row[2]</td>
							<td><input type='hidden' name='grNum' value='".$row[3]."'/></td>
							<td><input type='hidden' name='id' value='".$row[2]."'/></td>
							<td><input type='hidden' name='movieNum' value='".$mNum."'/></td>
							<td>
							<button type='submit' class='movieForm' value='submit' style='margin: 0px;'><b>삭제</b></button>
							</td></tr></table></form>";
							}						
						}		
					?>
				</table>
			</form>
		</section>
	</body>
</html>