<?php
	include'/login/include/session.php';
	include'/login/db_info.php';

	$mNum=$_GET['movieNum'];
    $uID=$_SESSION['userid'];
	$grNum=$_GET['grNum'];
	$userID=$_GET['id'];
	
	
    if(isset($_SESSION['userid'])){
		if($uID==$userID){
			$query = "DELETE FROM gradereview WHERE gradereviewno='{$grNum}'";
			$result = mysqli_query($dbConnect, $query);
		
			if($result){
				echo "<script>alert(\"삭제 완료!\");</script>";
				echo("<script>location.replace('./movieIntroTest.php?mNum=".$mNum."');</script>");
			} else {
				echo "삭제 실패";
			}
		} else {
			echo "<script>alert(\"본인이 작성한 댓글만 삭제가능!\");</script>";
			echo("<script>location.replace('./movieIntroTest.php?mNum=".$mNum."');</script>");
		}	 
	} else {
		echo "<script>alert(\"로그인 후 이용가능합니다!\");</script>";
		echo("<script>location.replace('./movieIntroTest.php?mNum=".$mNum."');</script>");
   }
?>