<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
	</head>
	<body>
		<?php
	include'db_info.php';
	
	$id=$_GET['custId'];
    $sql= "SELECT * FROM user WHERE userid = '{$id}'";
    
    $res = mysqli_query($dbConnect,$sql);
	
    if(mysqli_num_rows($res)==0)
    {    
?>
		<div align="center" style="font-family:'malgun gothic';">
			<?php echo $id; ?>는 사용가능한 아이디입니다.
			<br></br>
			<button value="닫기" onclick="window.close()">닫기</button>
			</div>
		<?php
		}
		else
		{
		?>
		<div align="center" style='font-family:"malgun gothic";'>
			<?php echo $id; ?>중복된 아이디입니다.
			<br></br>
			<button value="닫기" onclick="window.close()">닫기</button>
			</div>
		<?php
		}
		?>
		<script></script>
	</body>
</html>