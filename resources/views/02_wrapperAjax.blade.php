<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<script type="text/javascript">
		/** 
		* 客户端向server发送请求时候，传递的参数如何处理？
		* 1.（请求参数位置问题）客户端发起不同请求时候，通过什么方式发送给server？
			1）get类型 --需要拼接请求地址后面
			2）post类型 --需要放在请求体中，要放在ajax的send方法中
		2.（请求参数格式的问题）在post请求下，客户端发起数据类型不同的时候，如何处理
			1）（字符串类型）application/x-www-form-urlencoded
			   参数名称=参数值&参数名称=参数值
			   name=zhangsan&age=20
			2) （对象类型）application/json
				{name: 'zhangsan', age: 20}

			--1.传递对象数据类型对于函数调用者更加友好
			--2.在函数内部，对象数据类型转为字符串数据类型更加方便
		3.请求类型2种，每一种有2种请求数据类型，get的处理方式一样，post要区分json和字符串类型
		*/

		function ajax (options) {

			// 设置默认值，如果用户

			// 创建ajax对象
			var xhr = new XMLHttpRequest();
			// 判断客户端请求的方式，如果是get，需要进行拼接
			var params = '';				
			// 遍历对象 for(key in value) ,不用options.data.arr是因为arr是一个变量，不能属性调用，所以用[arr]
			// console.log(options.data.username); --echo zhangsan
			// console.log(options.data[age]); --error: age is no defined
			// 以上再次证明，如果取对象中的属性，用 . ,如果是对象中的变量，用[]

			for (var arr in options.data) {
				params += arr + '=' + options.data[arr] + '&';
			}
			// 将参数最后面的&截取掉
			// 将截取的结果重新复制给params变量
			params =params.substr(0, params.length - 1);
			// console.log(params);
			if(options.type == 'get'){
				options.url = options.url + '?' + params;
			}
			// 配置ajax对象
			xhr.open(options.type,options.url);
			//判断客户端请求的方式
			if(options.type == 'post'){
				// post方式下，把data传到send方法中
				var contentType = options.header['Content-Type'];
				// post方式下，要明确请求参数的格式的类型
				// [-]出现，要用['']包括起来，js中，如果[-]不是在字符串中，则不合法，所以上方函数使用'Content-type',不能直接是 options.header[Content-type],而是 options.header['Content-type'],如果是要应用变量，但不能有[-]，可以是options.header[ContentType]
				xhr.setRequestHeader('Content-Type',contentType);
				// post方式下，判断用户向server传递的请求参数类型			
				if (contentType == 'application/json'){
					// 如果是json格式，转换成json字符串格式，传给send，发送请求
					xhr.send(JSON.stringify(options.data))
				}else{			
					// 如果是字符串类型，进行拼接后，传给send，发送请求
					xhr.send(params);
				}
								
			}else{
				// get方式下，把参数拼接到网址后面
				// 发送请求
				xhr.send();
			}
			
			// 监听xhr对象下面的onload事件
			// 当xhr对象接收完响应数据后触发
			// 下面返回的数据应该交给外部用户使用，而不是函数内调用，函数只处理数据，所以要进行修改为 ，当onload触发时候时候，把数据给外头，可以通过参数调用实现
			xhr.onload = function () {
				// console.log(xhr.responseText);
				options.success(xhr.responseText);
			}
		}
		// 调用ajax函数
		// 传入一个参数，该参数类型为对象{}，该对象里包括请求方式，请求地址等
		// 在调用函数时候，传入的参数为实参，所以对应的要在对象中加入形参。目前实参为一个对象
		ajax ({
			// 请求方式
			type: 'post',
			// 请求地址
			 url: 'https://www.baidu.com/',
			// url: 'http://www.edu.com:81/ajax/getServerData' ,
			// ajax向server发送的数据，使用json（对象数据类型），原因参考上方
			data: {
				username: 'zhangsan',
				age: 41
			},
			// 数据格式
			header: {
				// [-]出现，要用['']包括起来，js中，如果[-]不是在字符串中，则不合法，所以上方函数使用'Content-type',不能直接是 options.header[Content-Type],而是 options.header['Content-Type'],如果是要应用变量，但不能有[-]，可以是options.header[ContentType]

				'Content-Type': 'application/json'
			},

			// 获得ajax返回的数据,定义一个success函数，形参为data，对应上方实参xhr.responseText ，success(data),要使用data，在函数内写一个输出函数即可 
			success: function (data) {
				console.log('this is success function:' + data);

			}

		})
	</script>
	
</body>
</html>