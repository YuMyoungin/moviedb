<?php
	include'/login/include/session.php';
	include'/login/db_info.php';
	
	$keyword=$_GET['keyword'];
	
	$dNameQuery="SELECT directorname FROM director WHERE directorname='{$keyword}';";
	$dNameResult = mysqli_query($dbConnect, $dNameQuery);
	
	$aNameQuery="SELECT actorname FROM actor WHERE actorname='{$keyword}';";
	$aNameResult = mysqli_query($dbConnect, $aNameQuery);
	
	$mNameQuery="SELECT movienum FROM movie WHERE movietitle='{$keyword}';";
	$mNameResult = mysqli_query($dbConnect, $mNameQuery);
	
	if(mysqli_num_rows($dNameResult)==1){
		$drow = mysqli_fetch_row($dNameResult);
		$dName=$drow[0];
		echo("<script>location.replace('./directorForm.php?dName=".$dName."');</script>");
	} else if(mysqli_num_rows($aNameResult)==1){
		$arow = mysqli_fetch_row($aNameResult);
		$aName=$arow[0];
		echo("<script>location.replace('./actorForm.php?aName=".$aName."');</script>");
	} else if(mysqli_num_rows($mNameResult)==1){
		$mrow = mysqli_fetch_row($mNameResult);
		$mNum=$mrow[0];
		echo("<script>location.replace('./movieIntroTest.php?mNum=".$mNum."');</script>");
	} else {
		echo "<script>alert(\"검색가능한 키워드가 없습니다!\");</script>";
		echo("<script>location.replace('./Home.php');</script>");
	}
?>