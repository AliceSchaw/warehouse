<?php
//====================================================
//		FileName: action.device.php
//		Summary:  设备信息
//====================================================
header("Content-type: text/html; charset=utf-8");

if(!defined('CORE'))exit("error!"); 


//导出
if($do=="export"){	
	//查询
	$sql="select * from device";
	
	//echo $sql;
	$db->query($sql);
	$list=$db->fetchAll();
	
    $result = mysql_query($sql);
	$str = "Type,Category,Vendor,ProductName,ProductID\n";
    $str .= iconv('utf-8','gb2312',$str);
	//echo $row;
    while($row=$list){
        $Type=iconv('utf-8','gb2312',$row['Type']);
        $Category=iconv('utf-8','gb2312',$row['Category']);
        $Vendor=iconv('utf-8','gb2312',$row['Vendor']);
        $ProductName=iconv('utf-8','gb2312',$row['ProductName']);
        $ProductID=iconv('utf-8','gb2312',$row['ProductID']);
        $Status=iconv('utf-8','gb2312',$row['Status']);
        $UserName=iconv('utf-8','gb2312',$row['UserName']);
        $REV=iconv('utf-8','gb2312',$row['REV']);
        $str .=$Type.",".$Category.",".$Vendor.",".$ProductName.",".$ProductID."\n";
        
    }
    $filename = "QT 库房系统-".date('Ymd').'.csv';
    export_csv($filename,$str);
}


function export_csv($filename,$data) {
    header("Content-type:text/csv");
    header("Content-Disposition:attachment;filename=".$filename);
    header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
    header('Expires:0');
    header('Pragma:public');
    echo $data;
}



//列表
if($do==""){
	//var_dump($user_list);
	//判断检索值
    if($keywords!="")
    {
    	$search .= " and concat(Type,ProductName,ProductID,Category,Vendor,Status,UserName,REV) like '%".strip_tags($keywords)."%'";
    }
	/*if($_POST['keywords']&&$_POST['obj'])
	{$search .= " and $_POST[obj] like '%".strip_tags($_POST['keywords'])."%'";}
	else
	{$search .= " and concat(Type,ProductName,ProductID,Category,Vendor,Status,UserName,REV) like '%".strip_tags($_POST[keywords])."%'";}
	*/

	//设置分页
	if($_POST[numPerPage]==""){$numPerPage="20";}else{$numPerPage=$_POST[numPerPage];}
	if($_GET[pageNum]==""||$_GET[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_GET[pageNum]-1)*$numPerPage;}
	//$num=mysql_query("SELECT * FROM device where 1=1 and roleid=2 $search");//当前频道条数
    $num=mysql_query("SELECT * FROM device where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($num);//总条数
	$page=new page(array('total'=>$total,'perpage'=>$numPerPage));

	//查询
	//$sql="SELECT * FROM device where 1=1 and roleid=2 $search order by id desc LIMIT $pageNum,$numPerPage";
    $sql="SELECT * FROM device where 1=1 $search order by P_Date desc LIMIT $pageNum,$numPerPage";


    $db->query($sql);
	$row=$db->fetchAll();

    $sql1="SELECT distinct Type FROM device where 1=1 $search";
    $sql2="SELECT distinct Category FROM device where 1=1 $search";

    $db->query($sql1);
    $Objrow=$db->fetchAll();
    $db->query($sql2);
    $Objrow2=$db->fetchAll();

	//清空缓存
	$_SESSION['Obj']="";
	$_SESSION['Obj2']="";
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('row',$row);
    $smt->assign('Objrow',$Objrow);
    $smt->assign('Objrow2',$Objrow2);
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数

	$smt->assign('pageNum',$_GET[pageNum]); //当前页数
	$smt->assign('total',$total);  //总条数


	$smt->assign ('page',$page->show());
	$smt->assign('title',"设备管理");
	$smt->display('device_list.htm');

	exit;	
}




//新建	
if($do=="new"){	
	// If_rabc($action,$do); //检测权限
	// is_admin($action,$do); 
	// $smt = new smarty();smarty_cfg($smt);
	// //模版	
	// $smt->assign('title',"添加");
	// $smt->display('device_new.htm');
	// exit
	    If_rabc($action,$do); 
    is_admin($action,$do);
    //查询
     $sql="SELECT * FROM device ORDER BY P_Date DESC LIMIT 0,1";
     $db->query($sql);
     $row=$db->fetchRow();
    //模版
    $smt = new smarty();smarty_cfg($smt);
    $smt->assign('row',$row);
    $smt->display('device_new.htm');
    exit;
}

//写入
if($do=="add"){
	// If_rabc($action,$do); //检测权限
	
	//if(!$_POST[url]){echo error($msg);exit;}
	// $created_at=date("Y-m-d H:i:s");
	// $sql="INSERT INTO device(Type,Category,Vendor,ProductID,ProductName,Status,REV,P_Date)VALUES('$_POST[Type]','$_POST[Category]','$_POST[Vendor]','$_POST[ProductID]','$_POST[ProductName]','$_POST[Status]','$_POST[REV]','$created_at')";
	// echo $created_at;
	// if($db->query($sql)){echo success($msg,"?action=address");}
	// else{echo error($msg);}
	// exit;
	If_rabc($action,$do); //检测权限
    is_admin($action,$do);
    date_default_timezone_set("PRC");
    $P_Date=date("Y.n.j H:i:s");
    $sql="INSERT INTO `device`(`Type`,`Interface`,`Category`,`Vendor`,`ProductID`,`REV`,`FW`,`工具室料号`,
 `PropertyNum`,`DPN`,`ModelNum`,`Source`,`ProductName`,`Status`,`P_Date`,`UserName`,`LentOutDate`,`Sign`,`Belong`)VALUES('$_POST[Type]',
 '$_POST[Interface]','$_POST[Category]','$_POST[Vendor]','$_POST[ProductID]','$_POST[REV]','$_POST[FW]',
 '$_POST[工具室料号]','$_POST[PropertyNum]','$_POST[DPN]','$_POST[ModelNum]','$_POST[Source]','$_POST[ProductName]',
 '$_POST[Status]','$P_Date','$_POST[UserName]','$P_Date','$_POST[Sign]','$_POST[Belong]')";
 //echo $sql;
    if($db->query($sql)){
    	echo success($msg,"?action=address");
	}
    else{echo error($msg);}
    exit;
}


//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	is_admin($action,$do); 
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql=" SELECT * FROM device where ProductID='{$ProductID}' LIMIT 1";

	$db->query($sql);
	$row=$db->fetchRow();
	
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"编辑");
	$smt->display('device_edit.htm');
	exit;
}

//更新
if($do=="updata"){
    If_rabc($action,$do); //检测权限
    is_admin($action,$do);

    if(!$_POST[ProductID]){echo error($msg);exit;}
    date_default_timezone_set("PRC");
    //$updated_at=date("Y-m-d H:i:s");
    $sql="UPDATE device SET
	`Type` = '$_POST[Type]',
	`Category` = '$_POST[Category]',
	`Vendor` = '$_POST[Vendor]',
	`ProductID` = '$_POST[ProductID]',
	`ProductName` = '$_POST[ProductName]',
	`REV` = '$_POST[REV]',
	`BadEvent` = '$_POST[BadEvent]',
	`BadSource` = '$_POST[BadSource]',
	`BadDate` = '$_POST[BadDate]',
	`Badlife` = '$_POST[Badlife]',
	`Recorder` = '$_POST[Recorder]',
	`Status`='$_POST[Status]' WHERE `ProductID` ='$_POST[ProductID]' LIMIT 1";

    if($db->query($sql)){echo success($msg,"?action=address");}else{echo error($msg);}
    exit;

}

//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	is_admin($action,$do); 
	$sql="delete from `device` where `ProductID`='$ProductID' limit 1";
	if($db->query($sql)){echo success($msg,"?action=address");}else{echo error($msg);}		
	exit;
}

//筛选
if($do=="select"){

    //判断检索值
    if($keywords!="")
    {
        $search .= " and concat(Type,ProductName,ProductID,Category,Vendor,Status,UserName,REV) like '%".strip_tags($keywords)."%'";
    }
	if($_POST[Obj]!=""){
	    	$_SESSION['Obj']=$_POST[Obj];
	    	}
	if($_POST[Obj2]!=""){
	    	$_SESSION['Obj2']=$_POST[Obj2];
	    	}
	if($_SESSION['Obj']!=""&&$_SESSION['Obj2']!=""){
	    	$search .= " and Type LIKE '$_SESSION[Obj]' and Category LIKE '$_SESSION[Obj2]'";} 

	else if($_SESSION['Obj2']!=""){
	    	$search .= " and Category LIKE '$_SESSION[Obj2]'";} 
	else if($_SESSION['Obj']!=""){
	    	$search .= " and Type LIKE '$_SESSION[Obj]'";} 

    //设置分页
    if($_POST[numPerPage]==""){$numPerPage="20";}else{$numPerPage=$_POST[numPerPage];}
    if($_GET[pageNum]==""||$_GET[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_GET[pageNum]-1)*$numPerPage;}
    //$num=mysql_query("SELECT * FROM device where 1=1 and roleid=2 $search");//当前频道条数
    $num=mysql_query("SELECT * FROM device where 1=1 $search");//当前频道条数
    $total=mysql_num_rows($num);//总条数
    $page=new page(array('total'=>$total,'perpage'=>$numPerPage));

    //查询
    //$sql="SELECT * FROM device where 1=1 and roleid=2 $search order by id desc LIMIT $pageNum,$numPerPage";
    $sql="SELECT * FROM device where 1=1 $search order by ProductID LIMIT $pageNum,$numPerPage";

    $db->query($sql);
    $row=$db->fetchAll();

    $sql1="SELECT distinct Type FROM device where 1=1 $search";
    $sql2="SELECT distinct Category FROM device where 1=1 $search";

    $db->query($sql1);
    $Objrow=$db->fetchAll();
    $db->query($sql2);
    $Objrow2=$db->fetchAll();

    //echo $row;
    //模版
    $smt = new smarty();smarty_cfg($smt);
    $smt->assign('row',$row);
    $smt->assign('Objrow',$Objrow);
    $smt->assign('Objrow2',$Objrow2);
    $smt->assign('numPerPage',$_POST[numPerPage]); //显示条数

    $smt->assign('pageNum',$_GET[pageNum]); //当前页数
    $smt->assign('total',$total);  //总条数


    $smt->assign ('page',$page->show());
    $smt->assign('title',"设备管理");
    $smt->display('device_list.htm');
    exit;
	
}
//筛选超期
if($do=="returnlate"){
		
		$updated_at=date("Y-m-d");
    	$search .= " and ReturnBefore <= '$updated_at' and ReturnBefore >0";



	//设置分页
	if($_POST[numPerPage]==""){$numPerPage="20";}else{$numPerPage=$_POST[numPerPage];}
	if($_GET[pageNum]==""||$_GET[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_GET[pageNum]-1)*$numPerPage;}
	//$num=mysql_query("SELECT * FROM device where 1=1 and roleid=2 $search");//当前频道条数
    $num=mysql_query("SELECT * FROM device where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($num);//总条数
	$page=new page(array('total'=>$total,'perpage'=>$numPerPage));

	//查询
	//$sql="SELECT * FROM device where 1=1 and roleid=2 $search order by id desc LIMIT $pageNum,$numPerPage";
    $sql="SELECT * FROM device where 1=1 $search order by ReturnBefore LIMIT $pageNum,$numPerPage";
    //echo "<br/>"."<br/>".$sql;

    $db->query($sql);
	$row=$db->fetchAll();



	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('row',$row);

	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数

	$smt->assign('pageNum',$_GET[pageNum]); //当前页数
	$smt->assign('total',$total);  //总条数


	$smt->assign ('page',$page->show());
	$smt->assign('title',"设备管理");
	$smt->display('device_list.htm');

	exit;	
}
?>
