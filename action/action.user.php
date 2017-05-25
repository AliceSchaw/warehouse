<?php
if(!defined('CORE'))exit("error!"); 
//角色页面权限
function checkbox_area_action($areaid,$row_action){
	$action=explode(',',$row_action);
	$i=1;
	foreach($areaid as $key=>$val){
		if($key!="0"){
		if(in_array($key,$action)){
		$cbox.="<span style=\"float:left;width:150px\"><input name=\"areaid[]\" type=\"checkbox\" value=\"$key\" checked=\"checked\" />$val</span>\n";
		}else{
		$cbox.= "<span style=\"float:left;width:150px\"><input name=\"areaid[]\" type=\"checkbox\" value=\"$key\" />$val</span>\n";
		}
		}
		if($i==8){$cbox .="";}
		$i++;
	}
	return $cbox;
}


//验证登录
if($do=="loginok"){
	$name=$_POST[username];
	$pwd=md5($_POST[password]);
	
	$validate_arr=array($name,$pwd);
	Ifvalidate($validate_arr);
	
	$sql = "SELECT UserName,Name,roleid from user WHERE username = '$name' AND password = '$pwd' limit 1 ";
	//echo $sql;
	$db->query($sql);
	if ($record = $db->fetchRow()){	//登录成功
		$_SESSION['isLogin'] 	= true;
		$_SESSION['userid']		= $record['UserName'];
		$_SESSION['username']	= $record['Name'];
		$_SESSION['roleid']	    = $record['roleid'];
		exit($lang_cn['rabc_login_ok']);
	}
	else
		exit($lang_cn['rabc_login_error']);
	exit;
}


//登录	
if($do=="login"){
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('web_name',$web_name);
	$smt->assign('title',"登录");
	$smt->display('user_login.htm');
	exit;
}

//注册
if($do=="reg"){
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('web_name',$web_name);
	$smt->assign('title',"登录");
	$smt->display('user_reg.htm');
	exit;
}


//退出	
if($do=="logout"){
	$_SESSION = array();
	session_destroy();
	exit($lang_cn['rabc_logout']);
}

//列表	
if($do==""){
	If_rabc($action,$do); //检测权限
	is_admin($action,$do);

    if($keywords!="")
    {
        $search .= " and concat(Name,Division,ChineseName,UserName) like '%".strip_tags($keywords)."%'";
    }

	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and `created_at` >  '".strtotime($_POST[time_start]." 00:00:00")."' AND  `created_at` <  '".strtotime($_POST[time_over] ." 23:59:59")."'";
	}
	
	//设置分页
	if($_POST[numPerPage]==""){$numPerPage="20";}else{$numPerPage=$_POST[numPerPage];}
	if($_GET[pageNum]==""||$_GET[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_GET[pageNum]-1)*$numPerPage;}
	$num=mysql_query("SELECT * FROM user where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($num);//总条数	
	$page=new page(array('total'=>$total,'perpage'=>$numPerPage));

	//查询
	$sql="SELECT * FROM user  where 1=1 $search order by UserName LIMIT $pageNum,$numPerPage";
	
	//echo $sql;
	$db->query($sql);
	$list=$db->fetchAll();	
	
 	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_GET[pageNum]); //当前页数
	$smt->assign('total',$total);  //总条数
	$smt->assign ('page',$page->show());
	$smt->assign('title',"用户管理");
	$smt->display('user_list.htm');
	exit;
	
}


//新建	
if($do=="new"){	
	If_rabc($action,$do); //检测权限
	
	//角色数组
	$sql="SELECT UserName FROM `user`";
	$db->query($sql);
	$list=$db->fetchAll();
	
	//格式化角色数据
	foreach($list as $key=>$val){
		$role_cn[$list[$key][UserName]]=$list[$key][title];
	}
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('select_role_cn',select($role_cn,"roleid","","选择角色","required"));
	$smt->assign('checkbox_area_action',checkbox_area_action($areaid));
	$smt->assign('title',"新建用户");
	$smt->display('user_new.htm');
	exit;
}


//写入
if($do=="add"){

	//If_rabc($action,$do); //检测权限
	$created_at=date("Y-m-d H:i:s", time());
	$password=md5($_POST[password]);
	//$id=md5($_POST[id]);
	$areaid=implode(',',$_POST[areaid]);
	//echo $password;
	//查询
	$sql="SELECT * FROM `user` where username ='$_POST[username]' LIMIT 1";
	$db->query($sql);
	if($db->fetchRow()){echo  "<script>alert(\"用户名已存在!\");window.location=\"index.php?action=user&do=reg\";</script>";exit();}
	$created_at = time();
	$sql="INSERT INTO `user` (`Name` ,`UserName` ,`password` ,`MobilePhone` ,`Division` ,`MailAddress`,`roleid`)
	VALUES ('$_POST[name]','$_POST[username]', '$password', '$_POST[mobilephone]','$_POST[division]','$_POST[mailaddress]','$_POST[roleid]');";
	if($db->query($sql)){echo success($msg,"?action=user");}else{echo error($msg);}
	exit;
}


//编辑	
if($do=="edit"){	
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
    
	//查询
	$sql=" SELECT * FROM user where UserName='$UserName' LIMIT 1";
    $db->query($sql);
	$row=$db->fetchRow();

	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"编辑用户");
	$smt->display('user_edit.htm');
	exit;
}


//更新
if($do=="update"){
	If_rabc($action,$do); //检测权限	
	if(!$UserName){echo error($msg);exit;}

	$sql="UPDATE user SET 
	`Name`= '$_POST[Name]',
	`UserName` = '$UserName',
	`MobilePhone` = '$_POST[MobilePhone]',
	`Division` = '$_POST[Division]',
	`MailAddress` = '$_POST[MailAddress]' WHERE UserName ='$UserName' LIMIT 1";
	//echo $sql;
	if($db->query($sql)){echo success($msg,"?action=user");}else{echo error($msg);}
	exit;
}


//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	is_admin($action,$do); 
	$sql="delete from `user` where UserName='$UserName' limit 1";
	if($db->query($sql)){echo success($msg,"?action=user");}else{echo error($msg);}	
	exit;
}


//修改密码	
if($do=="editpass"){	
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql=" SELECT * FROM user where UserName='$username' LIMIT 1";
	
	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"修改密码");
	$smt->display('user_edit_pass.htm');
	exit;
}


//更新密码
if($do=="updatepass"){
	If_rabc($action,$do); //检测权限

	if($_POST[password]&&$_POST[password]==$_POST[password2]){
		$password=md5($_POST[password]);
        $sql="UPDATE user SET `password`='$password' WHERE UserName='$username' LIMIT 1";
        if($db->query($sql)){echo success($msg,"index.php");}else{echo error($msg);}
	}
	else{
        echo error($msg);
    }

    ///echo $sql;

	exit;
}
?>