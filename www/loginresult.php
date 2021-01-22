
    <?php
    //echo 1开头表成功
    //echo 2账号或密码错误
    //echo 3输错次数太多


    $ip = $_SERVER['REMOTE_ADDR'];
    //先看是否之前输错多次
    try{
        $redis		= new Redis();
        $hanedel	= $redis->connect('127.0.0.1',6379);
        if($hanedel){
            
            if($redis->get($ip) >= 5){
                echo 3;
                exit;
            }
        }else{
            echo 'redis服务器无法链接';
            exit;
        }
    }catch(RedisException $e){
        echo 'phpRedis扩展没有安装：' . $e->getMessage();
        exit;
    }



    
	 $id =$_POST["username"];
	 $mm =$_POST["password"];

     $servername = "localhost:3306";
     $username = "root";
     $password = "1232112321";
     $dbname = "redis";

    
    // 创建连接
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
 
    $sql = "SELECT * FROM crm_user";
    $result = $conn->query($sql);
 
    $mark = 0;
    if ($result->num_rows > 0) {
    // 输出数据
        while($row = $result->fetch_assoc()) {
            if($row["username"] == $id &&  $row["password"] == $mm)
            {
                

                date_default_timezone_set('Asia/Shanghai');
                srand(mktime());
               
                $name = $row["username"];
                $token = '' . rand() . $name;
                $token_md5 = md5($token);
                //每次重新登录删除原来的token
                $sql1 = "DELETE FROM user where username = '$name'";
                $conn->query($sql1);
                //token写入数据库
                $sql2 = "INSERT INTO user (username, token)
                VALUES ('$name','$token_md5')";
                 
                if ($conn->query($sql2) === TRUE) {
                    //echo "Token success!";
                } else {
                    //echo "Error: " . $sql . "<br>" . $conn->error;
                    //echo "Token existed!";
                }


                session_start();
                $lifeTime = 24 * 3600 * 7;
                setcookie('PHPSESSID', session_id(), time() + $lifeTime, "/");


                
                $_SESSION["admin"] = 1;
                $_SESSION["username"] = $row["username"];
                $_SESSION["token"] = $token_md5;

                $mark = 1;

                $sql = "SELECT * FROM crm_user where username = '$name'";
			    $result = $conn->query($sql);
                $row = $result->fetch_assoc();
            
                if($row["level"] == 2){
                    echo 12;
                    
                }
                if($row["level"] == 1){
                    echo 11;
                }
                if($row["level"] == 0){
                    echo 10;
                }
                echo $token_md5;
                
                break;
            }
        }

        if($mark == 0){
            echo 2;
            
            //进行redis记录，5次错误5分钟后再试
            try{
                $redis		= new Redis();
                $hanedel	= $redis->connect('127.0.0.1',6379);
                if($hanedel){
                    if(!$redis->setnx($ip, 0)){
                        $redis->expire($ip,20); 
                    }
                    $redis->incr($ip);
                }else{
                    echo 'redis服务器无法链接';
                    exit;
                }
            }catch(RedisException $e){
                echo 'phpRedis扩展没有安装：' . $e->getMessage();
                exit;
            }

        }         
    } else {
     echo "无用户";
    }
$conn->close();
    





	 /*if ($username!="admin"||$password!="admin")
	 {
		 echo("登录失败");
	 }
	 else
	 {
		echo("登录成功！");
	 }*/


	?>

