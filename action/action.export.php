<?php

include_once ("connect.php");

$action = $_GET['action'];
if ($action=='export') { //导出CSV
    $result = mysql_query("select * from test1");
	$str = "Type,Category,Vendor,ProductName\n";
    $str .= iconv('utf-8','gb2312',$str);
	echo $row;
    while($row=mysql_fetch_array($result)){
        $Type=iconv('utf-8','gb2312',$row['Type']);
        $Category=iconv('utf-8','gb2312',$row['Category']);
        $Vendor=iconv('utf-8','gb2312',$row['Vendor']);
        $ProductName=iconv('utf-8','gb2312',$row['ProductName']);
        $ProductID=iconv('utf-8','gb2312',$row['ProductID']);
        $Status=iconv('utf-8','gb2312',$row['Status']);
        $UserName=iconv('utf-8','gb2312',$row['UserName']);
        $XorA=iconv('utf-8','gb2312',$row['XorA']);
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
?>