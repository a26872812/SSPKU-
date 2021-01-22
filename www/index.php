
<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>用户登录</title>

 </head>

 <body>
	<?php
		$servername = "localhost:3306";
		$username = "root";
		$password = "1232112321";
		$dbname = "redis";
		// 创建连接
		$conn = new mysqli($servername, $username, $password, $dbname);


		session_start();
		
		if($_SESSION["admin"] == 1)
        {
			$user = $_SESSION["username"];
			
			// Check connection
			if ($conn->connect_error) {
				die("连接失败: " . $conn->connect_error);
			}

			$sql = "SELECT * FROM crm_user where username = '$user'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			
				if($row["level"] == 2){
					?>
					<script>
						window.location.href = "welcome2.php";
					</script>
					<?php
				}
				if($row["level"] == 1){
					?>
					<script>
						window.location.href = "welcome1.php";
					</script>
					<?php
				}
				if($row["level"] == 0){
					?>
					<script>
						var reponseToken = localStorage.getItem("token");
						
						//模拟表单提交使页面跳转
						var generateHideElement = function (name, value) {
							var tempInput = document.createElement("input");
							tempInput.type = "hidden";
							tempInput.name = name;
							tempInput.value = value;
							return tempInput;
						}
						var form = document.createElement("form");
						document.body.appendChild(form);
						var tokenData = generateHideElement("token", reponseToken);
						form.method = "post";
						
						form.action = "index1.php";
						form.appendChild(tokenData);
						form.submit();
						//window.location.href = "index1.php";
					</script>
					<?php
				}
			
        }
        else{
			// Check connection
			$sql = "SELECT * FROM crm_user";
			$result = $conn->query($sql);


			
			
			?>

	<form action="loginresult.php" method="POST">
		<p>
		Username: <input type="text" name="username" id="text1"><br>
		Password: <input type="password" name="password" id="text2"><br>
		<p id="resultText"></p>
		<input type="button" value="登录" id="signup">
		<input type="button" value="注册" id="signin">
		</p>
	</form>
	
	<script>
		window.onload  = init;
		function init(){
			var button_signin = document.getElementById("signin");
			var button_signup = document.getElementById("signup");
			button_signin.onclick = handleButtonSignInClick;
			button_signup.onclick = handleButtonSignUpClick;
		}
		function handleButtonSignUpClick(){
			var text1 = document.getElementById("text1");
    		var text2 = document.getElementById("text2");

			if(text1.value==""||text2.value=="")
			{
				alert("请将登录信息填写完整！");
				return;
			}

			if (window.XMLHttpRequest){
				// IE7+, Firefox, Chrome, Opera, Safari 浏览器执行的代码
				xmlhttp=new XMLHttpRequest();
			}
			else{    
				//IE6, IE5 浏览器执行的代码
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					
					var resultText = document.getElementById("resultText");
					var reponseCode = xmlhttp.responseText.trim().substring(0,2);
					var reponseToken = xmlhttp.responseText.trim().substring(2);
					//resultText.innerHTML=xmlhttp.responseText;
					if(reponseCode == 12){
						resultText.innerHTML="登录成功";
						localStorage.setItem("token",reponseToken);
						window.location.href = "welcome2.php";
					}
					else if(reponseCode == 11){
						resultText.innerHTML="登录成功";
						localStorage.setItem("token",reponseToken);
						window.location.href = "welcome1.php";
					}
					else if(reponseCode == 10){
						resultText.innerHTML="登录成功";
						
						localStorage.setItem("token",reponseToken);
						
						//模拟表单提交使页面跳转
						var generateHideElement = function (name, value) {
							var tempInput = document.createElement("input");
							tempInput.type = "hidden";
							tempInput.name = name;
							tempInput.value = value;
							return tempInput;
						}
						var form = document.createElement("form");
						document.body.appendChild(form);
						var tokenData = generateHideElement("token", reponseToken);
						form.method = "post";
						
						form.action = "index1.php";
						form.appendChild(tokenData);
						form.submit();
						
						//window.location.href = "index1.php?token=" + reponseToken;
					}
					else if(xmlhttp.responseText == 3){
						resultText.innerHTML="登录失败！！！输入太频繁，请5分钟后尝试";
						window.location.reload(true);
					}
					else{

						resultText.innerHTML="登录失败！！！账号或密码错误！！！";
						window.location.reload(true);
						//alert(xmlhttp.responseText.trim().substring(0,2));
					}
				}
			}
			xmlhttp.open("POST","loginresult.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("username="+text1.value+"&password="+text2.value);		
		}
		function handleButtonSignInClick(){
			window.location.href = "signin.php";
		}

		
	</script>


    <?php
	}
	
	$conn->close();
 	?>


 </body>
</html>
