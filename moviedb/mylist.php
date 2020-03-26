<?php
	include'/login/include/session.php';
	include'/login/db_info.php';
	
	$mylistNum=$_GET['listNum'];
	$tfHeart=$_GET['tfHeart'];
	$mNum=$_GET['mNum'];
	$uNum=$_GET['uNum'];
	
	if(isset($_SESSION['userid'])){
		if($tfHeart==1){
			$deleteQuery="DELETE FROM mylist WHERE likeno='{$mylistNum}';";
			if(mysqli_query($dbConnect, $deleteQuery)){
				echo "<script>alert(\"MyList에서 삭제했습니다!\");</script>";
				echo("<script>location.replace('./movieIntroTest.php?mNum=".$mNum."');</script>");
			} else{
				echo "<script>alert(\"DELETE 실패 ㅠㅠㅠㅠ\");</script>";
				echo("<script>location.replace('./movieIntroTest.php?mNum=".$mNum."');</script>");
			}
		} else if($tfHeart==0){
			$insertQuery="INSERT INTO mylist VALUES (NULL, '{$uNum}', '{$mNum}');";
			if(mysqli_query($dbConnect, $insertQuery)){
				echo "<script>alert(\"MyList에 추가했습니다!\");</script>";
				echo("<script>location.replace('./movieIntroTest.php?mNum=".$mNum."');</script>");
			} else{
				echo "<script>alert(\"INSERT 실패 ㅠㅠㅠㅠ\");</script>";
				echo("<script>location.replace('./movieIntroTest.php?mNum=".$mNum."');</script>");
			}
		}
	} else {
		echo "<script>alert(\"로그인 후 이용가능한 기능입니다.\");</script>";
		echo("<script>location.replace('./movieIntroTest.php?mNum=".$mNum."');</script>");
	}
?>