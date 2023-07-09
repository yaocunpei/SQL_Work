<!DOCTYPE html>
<html >

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/index.css" rel="stylesheet">
		<link rel="stylesheet" href="css/day.css" rel="stylesheet">
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
					if($_POST['card']){
						if(HabitRecord($_COOKIE["id"],$_POST['verification'])){
							echo '<script>alert("打卡成功");</script>';
						}else{
							echo '<script>alert("今天已经打过卡了");</script>';
						}
					}
					// print_r($_POST);
					$r = GetUserHabit($_COOKIE["id"]);
					// print_r($r);
					$v = $_POST['verification2'];
					$v-=1;
					$ordm=date("m",strtotime($r[$v]['开始日期']));
					$ordd=date("d",strtotime($r[$v]['开始日期']));
					$endm=date("m",strtotime($r[$v]['结束日期']));
					$endd=date("d",strtotime($r[$v]['结束日期']));
					$data=[];
					$re = SetRecord($_COOKIE["id"],$_POST['verification']);
					$i=0;
					for($i;$i<count($re);$i++){
						$data[$i]=$re[$i]['执行日期'];
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
						<li ><a href="#" style="background-color: #5e5e5e;color:#fff">查看习惯</a></li>
						<li><a href="install.php" >添加习惯</a></li>
					</ul>
				</div>
				<div class="nav-body">
					<h2 ><?php echo $r[$v]['名称'];?></h2>
					<div class="calendar">
					    <div class="title">
					        <h1 class="green" id="calendar-title">Month</h1>
					        <h2 class="green" id="calendar-year">Year</h2>
					        <a href="" id="pre"></a>
					        <a href="" id="next"></a>
					    </div>
					
					    <div class="body">
					        <div class="day body-list">
					            <!--使用无序列表标签显示星期-->
					            <ul>
					                <li>日</li>
					                <li>一</li>
					                <li>二</li>
					                <li>三</li>
					                <li>四</li>
					                <li>五</li>
					                <li>六</li>
					            </ul>
					        </div>
					        <!--使用无序列表标签显示日期，日期使用JavaScript动态获取，然后使用innerHTML设置<ul>标签之间的HTML-->
					        <div class="darkgrey body-list">
					            <ul id="days">
					
					            </ul>
					        </div>
					    </div>
					</div>
					
					<script type="text/javascript">
					    var month_olypic = [31,29,31,30,31,30,31,31,30,31,30,31];//正常年份12个月对应的天数
					    var month_normal = [31,28,31,30,31,30,31,31,30,31,30,31];//闰年中12个月对应的天数
					    var month_name =["1月","2月","3月","4月","5月","6月","7月","8月","9月","10月","11月","12月"];//定义要显示的月份数组
					    //获取以上各个部分的id
					    var holder = document.getElementById("days");
					    var prev = document.getElementById("prev");//上个月份的超链接id
					    var next = document.getElementById("next");//下个月份的超链接id
					    var ctitle = document.getElementById("calendar-title");
					    var cyear = document.getElementById("calendar-year");
					    //获取当天的年月日
					    var my_date = new Date();
					    var my_year = my_date.getFullYear();//获取年份
					    var my_month = my_date.getMonth(); //获取月份，下标从0开始
					    var my_day = my_date.getDate();//获取当前日期
					
					    //根据年月获取当月第一天是周几
					    function dayStart(month,year){
					        var tmpDate = new Date(year, month, 1);
					        return (tmpDate.getDay());
					    }
					    //根据年份判断某月有多少天，主要是区分闰年
					    function daysMonth(month, year){
					        var tmp1 = year % 4;
					        var tmp2 = year % 100;
					        var tmp3 = year % 400;
					
					        if((tmp1 == 0 && tmp2 != 0) || (tmp3 == 0)){
					            return (month_olypic[month]);//闰年
					        }else{
					            return (month_normal[month]);//非闰年
					        }
					    }
					
					    function refreshDate(){
					        var str = "";
					        //计算当月的天数和每月第一天都是周几
					        var totalDay = daysMonth(my_month,my_year);
					        var firstDay = dayStart(my_month, my_year);
					        //添加每个月前面的空白部分，即若某个月的第一天是从周三开始，则前面的周一，周二需要空出来
					        for(var i = 0; i < firstDay; i++){
					            str += "<li>"+"</li>";
					        }
					
					        //从一号开始添加到totalDay（每个月的总天数），并为pre，next和当天添加样式
					        var myclass;
					        for(var i = 1; i <= totalDay; i++){
					            //如果是已经过去的日期，则用浅灰色显示
					            if((my_year < my_date.getFullYear())||(my_year == my_date.getFullYear() &&
					                my_month < my_date.getMonth()) || (my_year == my_date.getFullYear() &&
					                my_month == my_date.getMonth() && i < my_day)){
					                myclass = " clightgrey ";

					            }
					            //如果正好是今天，则用绿色显示
					            else if(my_year == my_date.getFullYear() && my_month == my_date.getMonth() && i == my_day){
					                myclass = "greenbox ";
					            }
					            //将来的日期用深灰色显示
					            else{
					                myclass = "darkgrey ";
					            }
								var hday=<?php echo $ordd;?>;
								var eday=<?php echo $endd;?>;
								var hm=Number("<?php echo $ordm;?>")-1;
								var re=[<?php 
								for($i=0;$i<count($data);$i++){
									echo date("d",strtotime($data[$i]));echo ",";
									}?>0];
								// var card=<php echo  SetRecord($_COOKIE["id"],$v,$date);
								if(i>=hday&&i<=eday&&hm==my_month){
									daye="";
									if(i==hday){
										myclass="ordday ";
										daye="<span class='qishi'>起始日期<span>";
										// str += "<li class='ordday'>"+i+re[1]+"<span class='qishi'>起始日期<span></li>";
									}
									else if(i==eday){
										myclass="ordday ";
										daye="<span class='qishi'>结束日期<span>";
										// str += "<li class='ordday'>"+i+"<span class='qishi'>结束日期<span></li>";
									}
									for(var ke=0;ke<re.length;ke++){
										if(re[ke]==i){
											myclass+="green ";
										}
									}
									str += "<li class='"+myclass+"'>"+i+daye+"</li>";
								}
								else{
									str += "<li class='"+myclass+"'>"+i+"</li>";
								}
					            
					        }
					        holder.innerHTML = str;//为日期的列表标签设置HTML；
					        ctitle.innerHTML = month_name[my_month];//设置当前显示的月份
					        cyear.innerHTML = my_year;//设置当前显示的年份
					    }
					    refreshDate();//显示日期，更新界面
					    //上个月的点击事件
					    pre.onclick = function(e){
					        e.preventDefault();
					        my_month--;
					        if(my_month < 0){
					            my_year--;
					            my_month = 11;
					        }
					        refreshDate();//更新界面
					    }
					    //下个月的点击事件
					    next.onclick = function(e){
					        e.preventDefault();
					        my_month++;
					        if(my_month > 11){
					            my_month = 0;
					            my_year++;
					        }
					        refreshDate();//更新界面
					    }
					</script>
					<div style="text-align: center;">
					<form  method="POST" action="index.php">
						<button type="submit">返回</button>
					</form>
					<form  method="POST" action="detail.php" id="sgin">
						<button type="submit">打卡</button>
						// <input type="hidden" name="card" value="1">
						<input type='hidden' name='verification2' value='<?php echo $_POST["verification2"];?>'>
						<input type='hidden' name='verification' value='<?php echo $_POST["verification"];?>'>
					</form>
					</div>
					
				</div>
			</div>
		</div>
		
	</body>

</html>
