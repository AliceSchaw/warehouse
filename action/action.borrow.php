<?php
header("Content-type: text/html; charset=utf-8");

if(!defined('CORE'))exit("error!"); 



if($do==""){


}
if($do=="return")
{
   
}
if($do=="borrow") 
{
    if($_POST[IndexID]!=""){
            $_SESSION['inputid']=$_POST[IndexID];
    }
    else{$_SESSION['inputid']='';}
    $search .= " and UserName like '$_SESSION[inputid]'";
    
    //设置分页
    if($_POST[numPerPage]==""){$numPerPage="20";}else{$numPerPage=$_POST[numPerPage];}
    if($_GET[pageNum]==""||$_GET[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_GET[pageNum]-1)*$numPerPage;}
    $num=mysql_query("SELECT * FROM device where 1=1 $search");//当前频道条数
    $total=mysql_num_rows($num);//总条数
    $page=new page(array('total'=>$total,'perpage'=>$numPerPage));

    //查询
    $sql="SELECT * FROM device where 1=1 $search order by Type desc LIMIT $pageNum,$numPerPage";

    $db->query($sql);
    $row=$db->fetchAll();


    //echo $row;
    //模版
    $smt = new smarty();smarty_cfg($smt);
    $smt->assign('row',$row);
    $smt->assign('numPerPage',$_POST[numPerPage]); //显示条数

    $smt->assign('pageNum',$_GET[pageNum]); //当前页数
    $smt->assign('total',$total);  //总条数


    $smt->assign ('page',$page->show());
    $smt->assign('title',"设备借还");
    $smt->display('index.htm');

    exit;   
}
?>
