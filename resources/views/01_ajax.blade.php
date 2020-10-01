<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<h2>hi,I am ajax</h2>
	<script>
		// 1.创建Ajax对象
		var xhr = new XMLHttpRequest();
		// 2.告诉ajax对象要向哪里发送请求，以什么方式发送请求
		// 1）请求方式 2）请求地址（即路由）
		//xhr.open('get','http://www.edu.com:81/admin/public/login');
		xhr.open('get','http://www.edu.com:81/ajax/getServerData');
		// error 因为跨域请求 xhr.open('get','https://www.baidu.com/');
		// 3.发送请求
		xhr.send();
		// 4.获取服务器端响应到客户端的数据，但由于请求是客户端发到服务器端，请求会受到网络快慢的影响，所以是在不确定的时间内获得相应结果，所以不能直接获得响应结果。 --解决该问题，用XMLHttpRequest 下的onload事件（监听onload事件）等拿到结果后，再获得结果。从服务器端获得的结果，是保存在 xhr的responseText属性中
		xhr.onload = function(){
			console.log(xhr.responseText);
			//服务器返回的是字符类型
			console.log(typeof xhr.responseText);
		}
	</script>


	
</body>
</html>