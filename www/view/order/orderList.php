<!DOCTYPE html>
<html>
<head>
	<title>订单列表</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" >
	<style>
		#logout{
			position: absolute;
			right:500px;
			z-index: 999;
		}
	</style>
</head>
<body>
<!-- new 注销 -->
<form>
		<p>
		<input type="button" value="注销" id="logout">
		</p>
</form>

<div class="container">
	<div class="row">
		<div class="col-md-2"><a href="./index1.php" class="btn btn-default">商品列表</a></div>
		<div class="col-md-8">
			<h3 style="text-align: center;color:green;">订单列表</h3>
			<table class="table">
				<tr>
					<th>序号</th>
					<th>订单编号</th>
					<th>商品id</th>
					<th>用户id</th>
					<th>操作时间</th>
				</tr>
				<?php
					foreach($list as $v){
						echo '<tr><td>'.$v['id'].'</td><td>'.$v['order_id'].'</td><td>'.$v['goods_id'].'</td><td>'.$v['uid'].'</td><td>'.$v['addtime'].'</td></tr>';
					}
				?>
				</table>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>
	<script>
		
		window.onload = init;
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
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>