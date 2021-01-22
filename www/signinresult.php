
	<?php
		//echo 1表示注册成功
		//echo 2用户名重复

		$servername = "localhost:3306";
		$username = "root";
		$password = "1232112321";
		$dbname = "redis";
 
		try {
    		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			//echo "连接成功!"; 
			$newusername =$_POST["newusername"];
			$newpassword =$_POST["newpassword"];

		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		$sql = "INSERT INTO crm_user VALUES ('$newusername', '$newpassword',2)";
    		//使用 exec() ，没有结果返回 
    		$conn->exec($sql);
			echo 1;
		}
	
		catch(PDOException $e)
		{
   			echo 2;
		}

		




	?>

