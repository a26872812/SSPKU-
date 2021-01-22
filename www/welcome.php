<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>欢迎页</title>

 </head>

 <body>
    <h1>Welcome!Boss!</h1>

    <form>
		<p>
		<input type="button" value="注销" id="logout">
		</p>
	</form>

    <script>
		window.onload  = init;
		function init(){
			var button = document.getElementById("logout");
			button.onclick = handleButtonClick;
		}

		function handleButtonClick(){
			
         alert("注销成功");
         window.location.href = "logout.php";
		}
	</script>



 </body>
</html>