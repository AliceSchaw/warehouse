<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $this->_var['cfg']['webtitle']; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="<?php echo $this->_var['cfg']['website']; ?>/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo $this->_var['cfg']['website']; ?>/css/bootstrap-responsive.css" rel="stylesheet">
<link href="<?php echo $this->_var['cfg']['website']; ?>/css/datepicker.css" rel="stylesheet">
<link href="<?php echo $this->_var['cfg']['website']; ?>/css/common.css" rel="stylesheet">
<style type="text/css">
.sidebar-nav {padding: 9px 0;}
</style>

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
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
			     alert(HP01.replace("{}", "姓名"));
				 return false;
			}

			if($('#email').val()==""){
			     alert(HP01.replace("{}", "邮箱"));
				 return false;
			}else if(!pEmail.test($('#email').val())){
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


<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
	<div class="container-fluid">
	  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </a>
	  <a class="brand" href="<?php echo $this->_var['cfg']['website']; ?>"><?php echo $this->_var['cfg']['webtitle']; ?></a>
	  <div class="nav-collapse collapse">
		<p class="navbar-text pull-right">
		  <i class="icon-user icon-white" ></i> <span style="color:#FFFFFF;"><?php echo $_SESSION['username']; ?></span>
		</p>
		<ul class="nav">
			<li <?php if (strtolower ( $_GET['action'] ) == '' || strtolower ( $_GET['action'] ) == 'borrow'): ?>class="active"<?php endif; ?>><a href="<?php echo $this->_var['cfg']['website']; ?>"><i class="icon-home icon-white"></i> HOME</a></li>


			<li <?php if (strtolower ( $_GET['action'] ) == 'address'): ?>class="active"<?php endif; ?> ><a href="?action=address"><i class="icon-book icon-white"></i> 设备管理</a></li>
			
			
			<?php if ($_SESSION['roleid'] == "1"): ?>	
		
			<li <?php if (strtolower ( $_GET['action'] ) == 'user' && strtolower ( $_GET['do'] ) == '' || strtolower ( $_GET['action'] ) == 'user' && strtolower ( $_GET['do'] ) == 'edit'): ?>class="active"<?php endif; ?> ><a href="?action=user"><i class="icon-user icon-white"></i> 用户管理</a></li>
			
	        <?php else: ?>
		     
		    <?php endif; ?>	
			
			
			<li <?php if (strtolower ( $_GET['action'] ) == 'user' && strtolower ( $_GET['do'] ) == 'editpass'): ?>class="active"<?php endif; ?>><a href="?action=user&do=editpass&username=<?php echo $_SESSION['userid']; ?>"><i class="icon-wrench icon-white"></i> 个人中心</a></li>
		  
		  <li><a href="?action=user&do=logout"><i class="icon-off icon-white"></i> 退出</a></li>
		</ul>
	  </div>
	</div>
  </div>
</div>



<div class="container-fluid">
  <div class="row-fluid">
  <div class="span12 hidden-phone" style="padding-top:40px;">

  </div>