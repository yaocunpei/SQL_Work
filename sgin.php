<!DOCTYPE html>
<html lang="zh-CN">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/index.css" rel="stylesheet">
		<link rel="stylesheet" href="css/login.css" rel="stylesheet">
		<title>我有目标-个人信息</title>
	</head>

	<body>
		
	<div class="Background_box" style="height: 400px;top:120px;left: 430px;">
		<h1>注册</h1>
		<div class="login" style="margin-top: 10px;">
			<table border="0" style="margin-top: 0px;" class="sgint">
				<tr>
					<td style="text-align:justify;text-justify:distribute-all-lines;text-align-last:justify">账号:</td>
					<td><input type="text" name="id" value="" placeholder="家长5位,学生6位"  form="sgin" required/><br></td>
				</tr>
				<tr>
					<td style="text-align:justify;text-justify:distribute-all-lines;text-align-last:justify">密码:</td>
					<td><input type="text" name="密码" value=""  form="sgin" required/><br></td>
				</tr>
				<tr>
					<td style="text-align:justify;text-justify:distribute-all-lines;text-align-last:justify">姓名:</td>
					<td><input type="text" name="用户名" value=""  form="sgin" required/><br></td>
				</tr>
				<tr>
					<td style="text-align:justify;text-justify:distribute-all-lines;text-align-last:justify" >电话:</td>
					<td><input type="tel" name="电话号码" value=""  form="sgin" required/><br></td>
				</tr>
				<tr>
					<td style="text-align:justify;text-justify:distribute-all-lines;text-align-last:justify">邮箱:</td>
					<td><input type="email" name="邮箱" value=""  form="sgin"/><br></td>
				</tr>
				<tr>
					<td style="text-align:justify;text-justify:distribute-all-lines;text-align-last:justify">身份:</td>
					<td style="text-align:center">
						<input type="radio" name="user" value="p" form="sgin" required/><span style="margin-left:5px;">家长</span>
						<input type="radio" name="user" value="s" form="sgin" required/><span style="margin-left:5px;">学生</span>
					</td>
				</tr>
			</table>
			<div class="siginb">
				<form  method="POST" action="login.php">
					<button type="submit">返回登录</button>
				</form>
				<form  method="POST" action="sgin.php" id="sgin">
					<button type="submit">注册</button>
					<input type="hidden" name="ver" value="1">
				</form>
			</div>
		</div>
	</div
	</body>
</html>
<?php
	if(!$_POST["ver"]){
		exit();
	}
	$len=strlen($_POST['id']);
	// echo $len;

	if($len!=6&&$_POST['user']=="s"){
		echo '<script>alert("学生账号要6位");</script>';
		exit();
	}
	if($len!=5&&$_POST['user']=="p"){
		echo '<script>alert("家长账号要5位");</script>';
		exit();
	}
	// echo 123;
	include "php/sql.php";
	$r = Sgin($_POST);
	if($r){
		$_POST["ver"]=0;
		echo '<script>alert("注册成功，请返回登陆页面");</script>';
	}else{
		$_POST["ver"]=0;
		echo '<script>alert("注册失败，账号重复");</script>';
		
	}
