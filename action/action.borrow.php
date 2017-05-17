<?php
header("Content-type: text/html; charset=utf-8");

if(!defined('CORE'))exit("error!"); 



if($do==""){

        $search .= " and UserName like '$_SESSION[inputid]'";
        
        //设置分页
        if($_POST[numPerPage]==""){$numPerPage="20";}else{$numPerPage=$_POST[numPerPage];}
        if($_GET[pageNum]==""||$_GET[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_GET[pageNum]-1)*$numPerPage;}
        $num=mysql_query("SELECT * FROM device where 1=1 $search");//当前频道条数
        $total=mysql_num_rows($num);//总条数
        $page=new page(array('total'=>$total,'perpage'=>$numPerPage));

        //查询
        $sql="SELECT * FROM device where 1=1 $search order by Type desc LIMIT $pageNum,$numPerPage";
        //echo "<br/>.<br/>.$sql";
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
}

if($do=="borrow") 
{
    if (preg_match('/^[a-zA-Z][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]$/', $_POST['IndexID']))
    {

        $search .= " and UserName like '$_POST[IndexID]'";    
        $sql1="SELECT * FROM user where 1=1 $search";

        $db->query($sql1);
        $row1=$db->fetchAll();


        if($row1)
        {
            $_SESSION['inputid']=$_POST[IndexID];
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
        else{
            echo success("用户名不存在，请重试");
            exit;
        }
    }
    else
    {
        $BorrowdDevice=strip_tags($_POST[IndexID]);
        $sql = "SELECT * FROM device WHERE `ProductID` LIKE '$BorrowdDevice'";
        $db->query($sql);
        $list = $db->fetchAll();
        //var_dump($list);
        foreach ($list as $key => $value) 
        {
            $BorrowUser = $value[UserName];
        }
        if ($BorrowUser==""&&$list)
         {
            $updated_at=date("Y-m-d H:i:s");
            $sql = "UPDATE device SET
    `UserName` = '{$_SESSION['inputid']}',
     `Status` = 'Been Borrowed !!',
     `LentoutDate` = '$updated_at' 
     WHERE `ProductID` ='{$_POST[IndexID]}' LIMIT 1";
            //echo $sql;
            if ($db->query($sql)) {
                echo success("出借成功！","?action=borrow");
            } else {
                echo error($msg);
            }
            $smt = new smarty();
            smarty_cfg($smt);
            exit;
        }
        else if($BorrowUser!=""&&($BorrowUser==$_SESSION['inputid'])) 
        {
            $sql = "UPDATE device SET
    `UserName` = '',
     `Status` = 'In Lab !!'
     WHERE `ProductID` ='{$_POST[IndexID]}' LIMIT 1 ;";
            if ($db->query($sql)) {
                echo success("归还成功！","?action=borrow");
            } else {
                echo error($msg);
            }
            $smt = new smarty();
            smarty_cfg($smt);
            exit;
        }
        else
        {
            echo success("设备已借出或不存在","?action=borrow");
            exit;
        }
    }
}

?>
