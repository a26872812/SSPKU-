<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>logout</title>

 </head>

 <body>
    <?php
        session_start();
        session_destroy();
    ?>

    <script>
			var count  = 1;
			var id = setInterval(timeTick,1000);
			var body = document.body;
			setTimeout(timeOver, count * 1000);
	
			function timeOver(){
				window.location.href = "index.php";
				clearInterval(id);
			}

			function timeTick()
				{
				count--
				body.innerHTML = "还剩" + count + "s返回";
			}
		</script>
 </body>
</html>