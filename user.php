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
		<div>
			<div class="head">
				
				<?php
                if ($_COOKIE["id"]&&$_COOKIE["user"]) {
                    include 'php/sql.php';
					//$username = GetUser($_COOKIE["id"],$_COOKIE["user"]);
                    echo '<div class="topclick">
					            <div class="ltbox1 ">
					                <img src="img/mean.png" style="height: 30px; width: 30px;">
					            </div>
					                <ul class="ltbox2">
					                    <li class="li1"><a href="index.php">首页</a></li>
					                    <li><a href="login.php">退出登录</a></li>
					                </ul>
					        </div>';
                } else {
                    echo '<div class="tuichu"><a href="login.php">请先登录</a></div>';
                    exit(1);
                }
                ?>
			</div>
			<div class="Background_box">
				<h1>个人信息</h1>
				<div class="login">
					<table border="1" >
						<tr>
							<td>姓名:</td>
							<?php
								$user = GetUser($_COOKIE["id"],$_COOKIE["user"]);
								echo "<td>{$user['用户名']}</td>";
							?>
						</tr>
						<tr>
							<td>电话:</td>
							<?php
								echo "<td>{$user['电话号码']}</td>";
							?>
						</tr>
						<tr>
							<td>邮箱:</td>
							<?php
								echo "<td>{$user['邮箱']}</td>";
							?>
						</tr>
						<tr>
							<td>亲子关系:</td>
							<?php
								$p = GetPaternity($_COOKIE["id"],$_COOKIE["user"]);
								echo "<td>{$p["用户名"]}=>{$p["亲子关系"]}</td>";
							?>
						</tr>
						
					</table>
					<form  method="POST" action="index.php">
						<button type="submit">返回</button>
						</form>
				</div>
			</div>
		</div>

	</body>

</html>
