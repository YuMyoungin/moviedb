<?php
   include'/login/include/session.php';
   include'/login/db_info.php';

    $mNum=$_GET['nowMnum'];
    $star=$_GET['star'];
    $review=$_GET['review'];
    $uID=$_SESSION['userid'];
   
    if(isset($_SESSION['userid'])){
	$query = "SELECT usernum FROM moviedb.user WHERE userid='{$uID}'";
	$result = mysqli_query($dbConnect, $query);
	$res2=mysqli_fetch_row($result);
	$uNum=$res2[0];
	
	
    $sql="INSERT INTO moviedb.gradereview VALUES(null,'{$uNum}', '{$mNum}', '{$star}', '{$review}')";
	  
	mysqli_query($dbConnect, $sql) or die('Problem with it'.mysqli_error($dbConnect));
	  
    	if($result) {
			echo "입력 완료";
			echo("<script>location.replace('./movieIntroTest.php?mNum=".$mNum."');</script>");
		} else {
		echo "인설트 실패";
		}  
	} else {
		echo "<script>alert(\"로그인 후 이용가능합니다!\");</script>";
		echo("<script>location.replace('./movieIntroTest.php?mNum=".$mNum."');</script>");
   }
?>