<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo $this->_var['cfg']['webtitle']; ?></title>
<link rel='stylesheet' href='./css/login.css' type='text/css' />
<script src="js/jquery-1.7.2.js" type="text/javascript"></script>
<script type="text/javascript">	
     function clearfrm(){
		var obj = document.getElementsByTagName("input");

		for (var i=0;i<obj.length ;i++ )
		{
			if (obj[i].type==="text" || obj[i].type==="password")
			{
				obj[i].value = "";
			}
		}

		document.getElementById("usrinfo").className = "";
		document.getElementById("usrinfo").innerHTML = "";

		document.getElementById("pwdinfo").className = "";
		document.getElementById("pwdinfo").innerHTML = "";

		document.getElementById("repwdinfo").className = "";
		document.getElementById("repwdinfo").innerHTML = "";

		document.getElementById("cpminfo").className = "";
		document.getElementById("cpminfo").innerHTML = "";

		document.getElementById("nmeinfo").className = "";
		document.getElementById("nmeinfo").innerHTML = "";

		document.getElementById("telinfo").className = "";
		document.getElementById("telinfo").innerHTML = "";

		document.getElementById("mblinfo").className = "";
		document.getElementById("mblinfo").innerHTML = "";

		document.getElementById("adrinfo").className = "";
		document.getElementById("adrinfo").innerHTML = "";

		document.getElementById("emlinfo").className = "";
		document.getElementById("emlinfo").innerHTML = "";
	}

	 $(function(){
		
	        var HP01="{}不能为空，请输入。";
			var HP02="{}格式错误，请重新输入。";
			var pUsername=/^[0-9a-zA-Z]{4,16}$/;
			var pPassword=/^[0-9a-zA-Z]{6,16}$/;
			var pEmail=/^[a-zA-Z0-9_.]+@([a-zA-Z0-9_]+.)+[a-zA-Z]{2,3}$/
		$('#register').click(function(event){
			if($('#username').val()==""){
			     alert(HP01.replace("{}", "用户名"));
				 return false;
			}
			if($('#name').val()==""){
			     alert(HP01.replace("{}", "英文名"));
				 return false;
			}

			if($('#mailaddress').val()==""){
			     alert(HP01.replace("{}", "邮箱"));
				 return false;
			}else if(!pEmail.test($('#mailaddress').val())){
			     alert(HP02.replace("{}", "邮箱"));
				 return false;
			}
			if($('#password').val()==""){
			     alert(HP01.replace("{}", "密码"));
				 return false;
			}else if($('#password').val().length < 6){
			     alert("密码必须大于6位。");
				 return false;
			}
			if($('#password2').val()==""){
			     alert(HP01.replace("{}", "再次输入密码"));
				 return false;
			}
			if($('#password').val()!=$('#password2').val()){
			     alert("两次密码不一致");
				 return false;
			}
			
			return true;
	    });
		 
	 });	
	</script>
</head>
<body>

<div id="login">
<h1><a href="#" title="">用户注册--QT 库房系统</a></h1>

	  <form class="form-horizontal" method="post" action="?action=user&do=add">
	<p>
		<label><span style="color:red">*</span>用户名：</label>
		<input class="input" id="username" name="username" size="20" type="text" />
	</p>

	<p>
		<label><span style="color:red">*</span>英文名</label>
		<input class="input" id="name" name="name" size="20" type="text" />
	</p>
	
	<p>
		<label><span style="color:red">*</span>邮箱</label>
		<input class="input" id="mailaddress" name="mailaddress" size="20" type="text" />
	</p>

	<p>
		<label>电话</label>
		<input class="input" id="mobilephone" name="mobilephone" size="20" type="text" />
	</p>

	<p>
		<label><span style="color:red">*</span>密码：</label>
		<input class="input" id="password" name="password" size="20" type="password" />
	</p>

	<p>
		<label><span style="color:red">*</span>再次密码：</label>
		<input class="input" id="password2" name="password2" size="20" type="password" />
	</p>

	<p>
		<input type="text" id="input01" class="input-xlarge" value="2" name="roleid" style="display:none">
	</p>

		<p class="submit">
		<input id="register" class="button-primary" name="commit" type="submit" value="提交" />
		<input class="button-primary" name="login" type="button" value="登录" onclick="javascript:window.location.href='?action=user&do=login' "/>
		</p>

</form>

</div>
</body>
</html>


