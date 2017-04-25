<?php
if(!defined('CORE'))exit("error!"); 

//首页	
if($do==""){
	if(!isLogin()){exit($lang_cn['rabc_is_login']);} //判断是否登录
	$smt = new smarty();smarty_cfg($smt);
  //判断检索值
  if($_POST['keywords']&&$_POST['obj']){$search .= " and $_POST[obj] like '%".strip_tags($_POST[keywords])."%'";}
  if($_POST['time_start']!="" && $_POST['time_over']!=""){
    $search .= " and `created_at` > '".strtotime($_POST[time_start]." 00:00:00")."' AND `created_at` < '".strtotime($_POST[time_over] ." 23:59:59")."'";
  }

  //设置分页
  if($_POST[numPerPage]==""){$numPerPage="20";}else{$numPerPage=$_POST[numPerPage];}
  if($_GET[pageNum]==""||$_GET[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_GET[pageNum]-1)*$numPerPage;}
  //$num=mysql_query("SELECT * FROM device where 1=1 and roleid=2 $search");//当前频道条数
  $num=mysql_query("SELECT * FROM device where 1=1 and UserName='$_SESSION[userid]'  $search");//当前频道条数
  $total=mysql_num_rows($num);//总条数
  $page=new page(array('total'=>$total,'perpage'=>$numPerPage));

  //查询
  //$sql="SELECT * FROM device where 1=1 and roleid=2 $search order by id desc LIMIT $pageNum,$numPerPage";

  $sql="SELECT * FROM device where 1=1 and UserName='$_SESSION[userid]' $search order by Type desc LIMIT $pageNum,$numPerPage";
  $db->query($sql);
  $list=$db->fetchAll();
  //echo $list;
  //模版
  $smt = new smarty();smarty_cfg($smt);
  $smt->assign('list',$list);
  $smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
  $smt->assign('pageNum',$_GET[pageNum]); //当前页数
  $smt->assign('total',$total); //总条数
  $smt->assign ('page',$page->show());
  $smt->assign('title',"个人借用明细");
  $smt->display('index.htm');

	exit;
}



?>
