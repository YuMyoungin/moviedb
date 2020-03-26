<?php
include'/include/session.php';
session_unset();
$res=session_destroy();
if($res){
	echo("<script>location.replace('../Home.php');</script>"); 
}
?>