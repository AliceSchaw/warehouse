<?php
header("Content-type: text/html; charset=utf-8");

if(!defined('CORE'))exit("error!"); 
    if($do==""){

    }

    if($do=="show"){
        $search .= " and UserName like '$_SESSION[inputid]'"; 
        //设置分页
        if($_POST[numPerPage]==""){$numPerPage="20";}
        else{$numPerPage=$_POST[numPerPage];}
        if($_GET[pageNum]==""||$_GET[pageNum]=="0" ){$pageNum="0";}
        else{$pageNum=($_GET[pageNum]-1)*$numPerPage;}
        $num=mysql_query("SELECT * FROM device where 1=1 $search");//当前频道条数
        $total=mysql_num_rows($num);//总条数
        $page=new page(array('total'=>$total,'perpage'=>$numPerPage));

        //查询
        $sql="SELECT * FROM device where 1=1 $search order by LentoutDate desc LIMIT $pageNum,$numPerPage";

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

    if($do=="borrow") 
    {
        if (preg_match('/^[D][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]$/i', $_POST['IndexID']))
        {
        //检测用户名是否存在
            $search .= " and UserName like '$_POST[IndexID]'";    
            $sql1="SELECT UserName FROM user where 1=1 $search";

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
                $num=mysql_query("SELECT * FROM device where 1=1 $search");//当前频道条数
                $total=mysql_num_rows($num);//总条数
                $page=new page(array('total'=>$total,'perpage'=>$numPerPage));

                //查询
                $sql="SELECT * FROM device where 1=1 $search order by LentoutDate desc LIMIT $pageNum,$numPerPage";

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
                    $returndate=date("Y-m-d H:i:s",strtotime("+1week"));
                    $sql = "UPDATE device SET
                    `UserName` = '{$_SESSION['inputid']}',
                    `Status` = '已借出',
                    `LentoutDate` = '$updated_at',
                    `ReturnBefore`='$returndate' 
                    WHERE `ProductID` ='$BorrowdDevice' LIMIT 1";
                    //echo $sql;

                    if ($db->query($sql)) {
                       // echo success("出借成功！","?action=borrow&do=show");
					   echo "<script language='javascript' type='text/javascript'>";
					   echo "window.location.href='?action=borrow&do=show'";
					   echo "</script>";
					   
                    } else {
                        echo error($msg);
                    }
                    $smt = new smarty();
                    smarty_cfg($smt);
                    exit;
                }
                else if($BorrowUser!=""&&($BorrowUser==$_SESSION['inputid'])) 
                {
                    $updated_at=date("Y-m-d H:i:s");
					$sql = "UPDATE device SET
                    `UserName` = '',
                    `Status` = '未借出',
                    `LentoutDate` = ' ',
                    `ReturnBefore`=' ' 
                    WHERE `ProductID` ='$BorrowdDevice' LIMIT 1 ";
                    echo $sql;
                    //归还历史纪录
                    $sql1="INSERT INTO `history`(`ProductID`,`UserName`,`ReturnDate`)VALUES('$BorrowdDevice','$BorrowUser','$updated_at')";
                    echo $sql1;
                    $db->query($sql1);
                    
                    //exit;
                    if ($db->query($sql)) {
                       // echo success("归还成功！","?action=borrow&do=show");
					   echo "<script language='javascript' type='text/javascript'>";
					   echo "window.location.href='?action=borrow&do=show'";
					   echo "</script>";
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
                    echo success("设备已借出，请先扫描工号","?action=borrow&do=show");
                    exit;
                }
            }
            else
            {
                    echo success("请检查输入");
                    exit;
                
            }
        }
    }

?>
