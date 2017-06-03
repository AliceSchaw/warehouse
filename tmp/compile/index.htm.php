<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $this->_var['cfg']['webtitle']; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="refresh" content="120;url=http://localhost/warehouse/">

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
<?php echo $this->fetch('nav.htm'); ?>

<div class="span10">
    <?php if ($_SESSION['roleid'] != "1"): ?>

    <div class="span11">
        <div class="page-header">
            <h3><?php echo $this->_var['title']; ?></h3>

        </div>

        <form class="form-search"  action="" method="post">


            <select name="obj" class="input-medium" value="<?php echo $_REQUEST['obj']; ?>" >
                <option value="Category">Category</option>
                <option value="Status">Status</option>
                <option value="ProductName" selected="selected">ProductName</option>
            </select>
            <input type="text" name="keywords" class="input-medium" value="<?php echo $_REQUEST['keywords']; ?>"  placeholder="关键字">
            <?php echo $this->_var['select_userlist']; ?>

            <button type="submit" class="btn"><i class="icon-search"></i> 查询</button>
            <a href="" class="btn hidden-phone"><i class="icon-th-list"></i> 全部</a>

        </form>
        <div class="row-fluid">
            <div class="span12">

                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Type</th>
                        <th class="hidden-phone">Category</th>
                        <th class="hidden-phone">Vendor</th>
                        <th class="hidden-phone">ProductID</th>
                        <th class="hidden-phone">ProductName</th>
                        <th class="hidden-phone">REV</th>
                        <th class="hidden-phone">Status</th>
                        <th class="hidden-phone">借出日期</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>

                    <tr>
                        <td><?php echo $this->_var['row']['Type']; ?></td>
                        <td class="hidden-phone"><?php echo $this->_var['row']['Category']; ?></td>
                        <td class="hidden-phone"><?php echo empty($this->_var['row']['Vendor']) ? '无' : $this->_var['row']['Vendor']; ?></td>
                        <td class="hidden-phone"><?php echo empty($this->_var['row']['ProductID']) ? '无' : $this->_var['row']['ProductID']; ?></td>
                        <td class="hidden-phone"><?php echo empty($this->_var['row']['ProductName']) ? '无' : $this->_var['row']['ProductName']; ?></td>
                        <td class="hidden-phone"><?php echo empty($this->_var['row']['REV']) ? '' : $this->_var['row']['REV']; ?></td>
                        <td class="hidden-phone"><?php echo empty($this->_var['row']['Status']) ? '' : $this->_var['row']['Status']; ?></td>
                        <td class="hidden-phone"><?php echo $this->_var['row']['LentOutDate']; ?></td>

                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

                    </tbody>
                </table>
                <div class="pagination pagination-centered">
                    <ul class="">
                        <li><span class="btn">共<?php echo $this->_var['total']; ?>条</span></li>
                        <?php echo $this->_var['page']; ?>
                    </ul>
                </div>


            </div>
        </div>

    </div>
    <?php else: ?>

        <div class="page-header">
            <h3>设备借还</h3>

        </div>
    <div class="span11">


        <div class="row-fluid">

            <div class="span12">
            <div align="center">
        <form class="form-search" action="?action=borrow&do=borrow" method="post" autocomplete="off">
            <input type="text" name="IndexID" width="200" value=""  placeholder="请输入工号/设备ID" autofocus>
            <button type="submit" class="btn"><i class="icon-search"></i>提交</button>
        </form></div>
               <?php if ($this->_var['row'] != ""): ?>
                <table class="table table-bordered table-striped">
                    <thead>
 
                    <tr>

                        <th class="hidden-phone">ProductName</th>
                        <th class="hidden-phone">ProductID</th>
                        <th class="hidden-phone">Status</th>
                        <th class="hidden-phone">UserName</th>
                        <th class="hidden-phone">Name</th>
                        <th class="hidden-phone">借出日期</th>

                    </tr>

                    </thead>
                    <tbody>
                   
                    <?php $_from = $this->_var['row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list_0_11548500_1496470072');if (count($_from)):
    foreach ($_from AS $this->_var['list_0_11548500_1496470072']):
?>
                    <tr>
                        <td class="hidden-phone"><?php echo empty($this->_var['list_0_11548500_1496470072']['ProductName']) ? '无' : $this->_var['list_0_11548500_1496470072']['ProductName']; ?></td>
                        <td class="hidden-phone"><?php echo empty($this->_var['list_0_11548500_1496470072']['ProductID']) ? '无' : $this->_var['list_0_11548500_1496470072']['ProductID']; ?></td>
                        <td class="hidden-phone"><?php echo empty($this->_var['list_0_11548500_1496470072']['Status']) ? '无' : $this->_var['list_0_11548500_1496470072']['Status']; ?></td>
                        <td class="hidden-phone"><?php echo empty($this->_var['list_0_11548500_1496470072']['UserName']) ? '无' : $this->_var['list_0_11548500_1496470072']['UserName']; ?></td>
                        <td class="hidden-phone"><?php echo empty($this->_var['user_list'][$this->_var['list_0_11548500_1496470072']['UserName']]) ? '无' : $this->_var['user_list'][$this->_var['list_0_11548500_1496470072']['UserName']]; ?></td>
                        <td class="hidden-phone"><?php echo empty($this->_var['list_0_11548500_1496470072']['LentOutDate']) ? '无' : $this->_var['list_0_11548500_1496470072']['LentOutDate']; ?></td>
                        <!--<td><a class="btn btn-medium" href="?action=borrow&do=return">
                        <i class="icon-edit"></i>归还</a>
                        </td>-->
                


                    </tr>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>              
                    </tbody>

                </table>
                <div class="pagination pagination-centered">
                    <ul class="">
                        <li><span class="btn">共<?php echo $this->_var['total']; ?>条</span></li>
                        <?php echo $this->_var['page']; ?>
                    </ul>
                </div>
                   <?php endif; ?>
            </div>
        </div>


    </div>
    <?php endif; ?>

</div>
<?php echo $this->fetch('foot.htm'); ?>