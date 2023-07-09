<?php
	// 数据库链接
	function Connect()
	{
	    $cont = mysqli_connect("", "", "","");
	    mysqli_set_charset($cont,'utf8');
	    //echo $cont?'连接成功':'连接失败';//测试
	    return $cont;
	}
	
	// 登录接口
	function Login($id,$pw,$user)
	{
		// $id:	用户id
		// $pw:	密码
		// $user: 身份
		// return: 0-登陆失败.1-登陆成功
		$cont = Connect();
		$sql = "select 密码 from {$user}_user where {$user}_id = {$id};";
		//echo "<br/>".$sql;
		$results  = mysqli_query($cont, $sql);
		if(!$results){
			echo mysqli_error($cont);
			return 0;
		}
		// 读取密码
		$lists = [];
		while ($row = mysqli_fetch_assoc($results)) {
		    $lists[]=$row;
		}
		// 密码校验
		 echo $lists[0]["密码"];
		if($pw==$lists[0]["密码"]){
			echo "登陆成功";
			return 1;
		}
	}
	
	//获取基本用户信息
	function GetUser($id,$user){
		// $id: 用户id
		// return: 用户信息
		$cont = Connect();
		$sql = "select 用户名,电话号码,邮箱 from {$user}_user where {$user}_id={$id};";
		//echo "<br/>".$sql;
		$results  = mysqli_query($cont, $sql);
		if(!$results){
			echo mysqli_error($cont);
			return 0;
		}
		// 读取数据
		$lists = [];
		while ($row = mysqli_fetch_assoc($results)) {
		    $lists[]=$row;
		}
		return $lists[0];
	}
	
	// 获取常用习惯模板
	function GetHabit(){
		$cont = Connect();
		$sql = "select * from habit;";
		//echo "<br/>".$sql;
		$results  = mysqli_query($cont, $sql);
		if(!$results){
			echo mysqli_error($cont);
			return 0;
		}
		// 读取数据
		$lists = [];
		while ($row = mysqli_fetch_assoc($results)) {
		    $lists[]=$row;
		}
		return $lists;
	}
	
	// 获取用户习惯
	function GetUserHabit($id){
		$cont = Connect();
		$sql = "select * from s_habit where s_id = {$id} order by h_id asc;";
		//echo $sql;
		$results  = mysqli_query($cont, $sql);
		if(!$results){
			echo mysqli_error($cont);
			return 0;
		}
		// 读取数据
		$lists = [];
		while ($row = mysqli_fetch_assoc($results)) {
		    $lists[]=$row;
		}
		return $lists;
	}
	
	//获取亲子关系
	function GetPaternity($id,$user){
		$cont = Connect();
		if($user="s"){
			$user2="p";
		}else{
			$user2="s";
		}
		$sql = "select 用户名,亲子关系 from paternity NATURAL JOIN  {$user2}_user where {$user}_id = {$id};";
		//echo "<br/>".$sql;
		$results  = mysqli_query($cont, $sql);
		if(!$results){
			echo mysqli_error($cont);
			return 0;
		}
		// 读取数据
		$lists = [];
		while ($row = mysqli_fetch_assoc($results)) {
		    $lists[]=$row;
		}
		//print_r($lists);
		return $lists[0];
	}
	
	//添加亲子关系
	function SetPaternity($s_id,$p_id,$pate){
		$cont = Connect();
		$sql = "insert into paternity (s_id,p_id,亲子关系) values ({$s_id},{$p_id},'{$pate}');";
		// echo "<br/>".$sql;
		$results  = mysqli_query($cont, $sql);
		if($results){
			return 1;
		}else{
			return 0;
		}
	}
	
	//添加习惯
	function InsertHabitP($id,$habit=[]){
		$cont = Connect();
		$sql = "insert into s_habit (s_id,名称,开始日期,结束日期,打卡频率,奖励方式,描述) values ({$id},'{$habit['名称']}','{$habit['开始日期']}'
		,'{$habit['结束日期']}','{$habit['打卡频率']}','{$habit['奖励方式']}','{$habit['描述']}');";
		// echo "<br/>".$sql;
		$results  = mysqli_query($cont, $sql);
		if($results){
			return 1;
		}else{
			return 0;
		}
	}
	
	//打卡
	function HabitRecord($s_id,$h_id){
		$cont = Connect();
		$time = time();
		$data=date("y-m-d",$time);
		$sql = "insert into record (s_id,h_id,执行日期) values ({$s_id},{$h_id},'{$data}')";
		echo "<br/>".$sql;
		$results  = mysqli_query($cont, $sql);
		if($results){
			return 1;
		}else{
			return 0;
		}
		
	}
	
	//查询打卡记录
	function SetRecord($s_id,$h_id){
		$cont = Connect();
		$sql = "select 执行日期 from record where s_id={$s_id} and h_id={$h_id}";
		 // echo $sql;
		$results  = mysqli_query($cont, $sql);
		// echo $results->num_rows;
		$lists = [];
		while ($row = mysqli_fetch_assoc($results)) {
		    $lists[]=$row;
		}
		return $lists;
	}
	//登录
	function Sgin($user=[]){
		$cont = Connect();
		$sql = "insert into {$user['user']}_user ({$user['user']}_id,密码,用户名,电话号码,邮箱) values ({$user['id']}
		,'{$user['密码']}','{$user['用户名']}','{$user['电话号码']}','{$user['邮箱']}');";
		 //echo "<br/>".$sql;
		 $results  = mysqli_query($cont, $sql);
		 if($results){
		 	return 1;
		 }else{
		 	return 0;
		 }
	}
	
	//print_r(SetRecord(100000,1));
	// echo SetRecord(100000,1,"2023-07-8");
	//测试
	// echo Sgin($_POST);
	//HabitRecord($_COOKIE["id"],1);
	 //2010-08-29
	
	// $habit=array(
	// 	"s_id"=>"100000",
	// 	"名称"=>"每日锻炼",
	// 	"开始日期"=>"2023-07-07",
	// 	"结束日期"=>"2023-07-11",
	// 	"打卡频率"=>"每日",
	// 	"奖励方式"=>"奖励麦当劳穷鬼套餐",
	// 	"描述"=>"每天进行一小时的锻炼"
	// 	);
	
	// InsertHabitP($_COOKIE["id"],$habit);
	
	//echo SetPaternity(100001,10001,"母女");
	
	//GetPaternity($_COOKIE["id"],$_COOKIE["user"]);
	
	// $cont = Connect();
	// $results = Login(100000,"test","s",$cont);
	
	//echo $_COOKIE["id"];
	//$name = GetUser($_COOKIE["id"],$_COOKIE["user"]);
	//echo $name;
	
	// $habit = GetUserHabit($_COOKIE["id"]);
	// print_r($habit);
	
	
	// $m = date("d",strtotime("2023-07-30"));
	// print_r($m);
?>

