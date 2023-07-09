<!DOCTYPE html>
<html >

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/index.css" rel="stylesheet">
		<title>我有目标-主页</title>
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
						<li ><a href="#" style="background-color: #5e5e5e;color:#fff">查看习惯</a></li>
						<li><a href="install.php" >添加习惯</a></li>
					</ul>
				</div>
				<div class="nav-body">
					<table  border=1px; class="table">
						<tr>
							<th>序号</th>
							<th>名称</th>
							<th>打卡频率</th>
							<th>描述</th>
							<th>奖励方式</th>
							<th>打卡</th>
						</tr>
						<?php
							if($_COOKIE["user"]=="s"){
								$r = GetUserHabit($_COOKIE["id"]);
							}else{
								exit();
							}
							
							// print_r($r);
							$i=0;
							while($row=$r[$i]){
								$i++;
								$j=$i-1;
								echo "<tr>
								<td style='margin-left:10px;margin-rigth:10px'>{$i}</td>
								<td>{$row['名称']}</td>

								<td>{$row['打卡频率']}</td>
								<td>{$row['描述']}</td>
								<td>{$row['奖励方式']}</td>
								<td>
									<form action='detail.php' method='POST'>
										<input type='submit' value='打卡'>
										<input type='hidden' name=verification2 value='{$i}'>
										<input type='hidden' name=verification value='{$row['h_id']}'>
									</form>
								</td>
								";
							}
						?>
					</table>
				</div>
			</div>
		</div>

	</body>

</html>
