<?php
	/*------------------------------------------------------
	 * 系统入口文件
	 * 访问模式：
	 * http://ip/index.php?app=app&c=order&a=buypub
	 * 
	 *------------------------------------------------------
	*/
	//检查token
	if(isset($_POST['token'])){
		$token = $_POST['token'];

		$servername = "localhost:3306";
		$username = "root";
		$password = "1232112321";
		$dbname = "redis";
 
		try {
    		// 创建连接
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("连接失败: " . $conn->connect_error);
			}
		
			$sql = "SELECT * FROM user where token = '$token'";
			$result = $conn->query($sql);
		
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				$name = $row["username"];
				//header('location:index.php?name=1');
				//exit;
				echo 'Hello! ' . $name;
			}
			else{
				header('location:index.php');
				exit;
			}
		}
	
		catch(PDOException $e)
		{
   			
		}


	}
	else{
		header('location:index.php');
		exit;
	}


	date_default_timezone_set('Asia/Shanghai');
	include 'Common/bootstrop.php';

	$app 			= isset($_GET['app']) 	? $_GET['app'] 	: 'app';
	$controller		= isset($_GET['c']) 	? $_GET['c'] 	: 'goods';
	$action			= isset($_GET['a']) 	? $_GET['a'] 	: 'goodsLits';
	$file			= SEC_ROOT_PATH. '/' .$app. '/' .$controller.'.php';

	if(is_file($file)){
		defined('APP') 			or define('APP',$app);
		defined('CONTROLLER') 	or define('CONTROLLER',$controller);
		defined('ACTION')		or define('ACTION',$action);
		include $file;
		$appClass = new $controller();
		$appClass->$action();
	}else{
		throw new Exception("应用错误", 1);
	}