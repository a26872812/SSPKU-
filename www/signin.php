<!DOCTYPE html>
<html>
<head>
	<title>signin</title>
</head>
<body>
    <h1>这是注册页面！</h1>
    <form>
		<p>
		Username: <input type="text" name="newusername" id="text1"><br>
		Password: <input type="text" name="newpassword" id="text2"><br>
		<p id="resultText"></p>
		<input type="button" value="提交" id="button_submit">
		</p>
	</form>

	<script>
		var count  = 1;
		window.onload = init;
		function init(){
			
			var button_submit = document.getElementById("button_submit");
			button_submit.onclick = handleButtonSubmitClick;
			
		}

		function handleButtonSubmitClick(){
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
					if(xmlhttp.responseText == 1){

						resultText.innerHTML = "注册成功";
						var id = setInterval(timeTick,1000);
						var body = document.body;
						setTimeout(timeOver, count*1000);
					}
					else{
						resultText.innerHTML = "用户名已存在！";
					}
					
					
				}
			}
			xmlhttp.open("POST","signinresult.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("newusername="+text1.value+"&newpassword="+text2.value);		
		}

				
	
		function timeOver(){
			window.location.href = "index.php";
			clearInterval(id);
		}

		function timeTick()
		{
			count--;
			body.innerHTML = "还剩" + count + "s返回";
		}
		
	</script>
</body>
</html>

			