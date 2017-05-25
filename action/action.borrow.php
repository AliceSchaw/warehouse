<?php
header("Content-type: text/html; charset=utf-8");

if(!defined('CORE'))exit("error!"); 



    if($do==""){
        
    }

    if($do=="borrow") 
    {
        if (preg_match('/^[D][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]$/', $_POST['IndexID']))
        {
        //检测用户名是否存在
            $search .= " and user.UserName like '$_POST[IndexID]'";    
            $sql1="SELECT UserName,Name FROM user where 1=1 $search";

            $db->query($sql1);
            $row1=$db->fetchAll();


            if($row1)
            {


                $_SESSION['inputid']=$_POST[IndexID];
               //设置分页
                if($_POST[numPerPage]==""){$numPerPage="20";}
                else{$numPerPage=$_POST[numPerPage];}
                if($_GET[pageNum]==""||$_GET[pageNum]=="0" ){$pageNum="0";}
                else{$pageNum=($_GET[pageNum]-1)*$numPerPage;}
                $num=mysql_query("SELECT * FROM device,user where device.UserName=user.UserName $search");//当前频道条数
                $total=mysql_num_rows($num);//总条数
                $page=new page(array('total'=>$total,'perpage'=>$numPerPage));

                //查询
                $sql="SELECT * FROM device,user where device.UserName=user.UserName $search order by LentoutDate desc LIMIT $pageNum,$numPerPage";

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
            $sql = "SELECT UserName FROM device WHERE `ProductID` LIKE '$BorrowdDevice'";
            $db->query($sql);
            $list = $db->fetchAll();
            //var_dump($list);
            if($list){
                foreach ($list as $key => $value) 
                {
                    $BorrowUser = $value[UserName];
                }

                if ($BorrowUser==""&&$_SESSION['inputid']!="")
                {
                    $updated_at=date("Y-m-d H:i:s");
                    $sql = "UPDATE device SET
                    `UserName` = '{$_SESSION['inputid']}',
                    `Status` = 'Been Borrowed !!',
                    `LentoutDate` = '$updated_at' 
                    WHERE `ProductID` ='$BorrowdDevice' LIMIT 1";
                    //echo $sql;

                    if ($db->query($sql)) {
                        echo success("出借成功！","?action=borrow&do=borrow");
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
                    `Status` = 'In Lab !!',
                    `LentoutDate` = '' 
                    WHERE `ProductID` ='$BorrowdDevice' LIMIT 1 ;";
                    if ($db->query($sql)) {
                        echo success("归还成功！","?action=borrow&do=borrow");
                    } else {
                        echo error($msg);
                    }
                    $smt = new smarty();
                    smarty_cfg($smt);
                    exit;
                }
                else if($_SESSION['inputid']=="")
                {
                    //查询设备信息
                     $search .= " and ProductID like '$BorrowdDevice'";

                   //设置分页
                    if($_POST[numPerPage]==""){$numPerPage="20";}
                    else{$numPerPage=$_POST[numPerPage];}
                    if($_GET[pageNum]==""||$_GET[pageNum]=="0" ){$pageNum="0";}
                    else{$pageNum=($_GET[pageNum]-1)*$numPerPage;}
                    $num=mysql_query("SELECT * FROM device where $search");//当前频道条数
                    $total=mysql_num_rows($num);//总条数
                    $page=new page(array('total'=>$total,'perpage'=>$numPerPage));

                    //查询
                    $sql="SELECT * FROM device where 1=1 $search order by LentoutDate desc LIMIT $pageNum,$numPerPage";

                    $db->query($sql);
                    $row=$db->fetchAll();

                    //var_dump($row);

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
                    echo success("设备已借出，请先扫描工号","?action=borrow&do=borrow");
                    exit;
                }
            }
            else
            {
                $search .= " and user.UserName like '$_SESSION[inputid]'";    
                $sql1="SELECT UserName,Name FROM user where 1=1 $search";

                //设置分页
                if($_POST[numPerPage]==""){$numPerPage="20";}
                else{$numPerPage=$_POST[numPerPage];}
                if($_GET[pageNum]==""||$_GET[pageNum]=="0" ){$pageNum="0";}
                else{$pageNum=($_GET[pageNum]-1)*$numPerPage;}
                $num=mysql_query("SELECT * FROM device,user where device.UserName=user.UserName $search");//当前频道条数
                $total=mysql_num_rows($num);//总条数
                $page=new page(array('total'=>$total,'perpage'=>$numPerPage));

                //查询
                $sql="SELECT * FROM device,user where device.UserName=user.UserName $search order by LentoutDate desc LIMIT $pageNum,$numPerPage";

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
        }
    }

?>
