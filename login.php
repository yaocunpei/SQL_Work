<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="css/login.css" type="text/css" rel="stylesheet" />
		<title>我有目标-登录</title>
	</head>
	<body>
		<div class="Background_box">
			<h1>我有目标</h1>
			<div class="login">
				<form  method="POST">
					<input type="text" name="id" value="" placeholder="账号" required/><br>
					<input type="password" name="password" value="" placeholder="密码" required/><br>
					<button type="submit">登录</button>
					<div class="top_box">
						<a href="#" class="a1">忘记密码?</a>
						<a href="sgin.php" class="a2">新用户注册</a>
						</div>
				</form>
			</div>
		</div>
	</body>
</html>
<?php
    include "php/sql.php";
    //判断是否有账号与密码
	setcookie("id","",time()-3600*2,'/');
	setcookie("user","",time()-3600*2,'/');
    if (@!$_POST['id']) {
        //若无则中止php
        // echo '123';
        if (@!$_POST['password']) {
            // echo '123';
            exit(0);
        }
    }

	$idlen =  strlen($_POST['id']);
	if($idlen==6){
		$user="s";
	}elseif($idlen=5){
		$user="p";
	}
	$results = Login($_POST['id'],$_POST["password"],$user);
	if($results){
		setcookie("id",$_POST['id'],time()+3600*2,'/');
		setcookie("user",$user,time()+3600*2,'/');
		header("location:index.php");
	}
	else{
		echo '<script>alert("账号或密码错误");</script>';
	}