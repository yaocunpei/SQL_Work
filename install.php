<!DOCTYPE html>
<html >

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/install.css" rel="stylesheet">
		<link href="css/login.css" type="text/css" rel="stylesheet" />
		<title>我有目标-添加习惯</title>
	</head>

	<body>
		<div>
			<div class="head">
				
				<?php
                if ($_COOKIE["id"]&&$_COOKIE["user"]) {
                    include 'php/sql.php';
					//$username = GetUser($_COOKIE["id"],$_COOKIE["user"]);
                    echo '
					<div class="topclick">
					    <div class="ltbox1 ">
					        <img src="img/mean.png" style="height: 30px; width: 30px;">
					    </div>
					        <ul class="ltbox2">
					            <li class="li1"><a href="user.php">用户信息</a></li>
					            <li><a href="login.php">退出登录</a></li>
					        </ul>
					</div>';
				if($_POST['verification']){
					// print_r($_POST);
					// echo $_POST['打卡频率'];
					// InsertHabitP($id,$habit=[])
					if(InsertHabitP($_COOKIE["id"],$_POST)){
						echo '<script>alert("添加成功");</script>';
					}else{
						echo '<script>alert("该习惯已存在");</script>';
					}
				}
                } else {
                    echo '<div class="tuichu"><a href="login.php">请先登录</a></div>';
                    exit(1);
                }
                ?>


			</div>
			<div class='table_box'>
				<h1 class="th1">我有目标</h1>
				<div class="nav-left">
					<ul>
						<li ><a href="index.php" >查看习惯</a></li>
						<li><a href="install.php" style="background-color: #5e5e5e;color:#fff">添加习惯</a></li>
					</ul>
				</div>
				<div class="nav-body" style="text-align: center;">
					<table border="0" style="margin:auto;margin-top:10px" class="sgint">
						<tr>
							<td style="text-align:justify;text-justify:distribute-all-lines;text-align-last:justify">习惯名称:</td>
							<td><input type="text" name="名称" value=""  form="sgin" required/><br></td>
						</tr>
						<tr>
							<td style="text-align:justify;text-justify:distribute-all-lines;text-align-last:justify">开始日期:</td>
							<td><input type="date" name="开始日期" value=""  form="sgin" required/><br></td>
						</tr>
						<tr>
							<td style="text-align:justify;text-justify:distribute-all-lines;text-align-last:justify">结束日期:</td>
							<td><input type="date" name="结束日期" value=""  form="sgin" /><br></td>
						</tr>
						<tr>
							<td style="text-align:justify;text-justify:distribute-all-lines;text-align-last:justify" >打卡频率:</td>
							<td><input type="text" name="打卡频率" value=""  form="sgin" /><br></td>
						</tr>
						<tr>
							<td style="text-align:justify;text-justify:distribute-all-lines;text-align-last:justify">奖励方式:</td>
							<td><textarea name="奖励方式" cols="29" rows="2" form="sgin"></textarea><br></td>
						</tr>
						<tr>
							<td style="text-align:justify;text-justify:distribute-all-lines;text-align-last:justify">描述:</td>
							<td><textarea name="描述" cols="29" rows="3" form="sgin"></textarea><br></td>
						</tr>
						</table>
				<div style="text-align: center;">
				<form  method="POST" action="index.php">
					<button type="submit">返回</button>
				</form>
				<form  method="POST" action="install.php" id="sgin">
					<button type="submit">添加</button>
					<input type='hidden' name='verification' value='1'>
					// <input type='hidden' name='s_id' value='<?php echo $_COOKIE["id"];?>'>
				</form>
				</div>
				</div>
				
			</div>
		</div>

	</body>

</html>
