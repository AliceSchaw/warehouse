<?php
require_once './lib/phpreader/reader.php';// ExcelFile($filename, $encoding); $data = new Spreadsheet_Excel_Reader(); // Set output Encoding. $data->setOutputEncoding('gbk');   
$data=new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('UTF-8');
$data->read($_POST[fileUpload]);
$db=mysqli_connect('127.0.0.1','root','','qtwarehouse') or
die("Could not connect to database.");//?????  
mysqli_query($db,"set names 'utf8'");//????  
mysqli_select_db($db,'qtwarehouse');//?????
error_reporting(E_ALL^E_NOTICE);
$sql = "TRUNCATE device";
$res = mysqli_query($db,$sql);
for($i=1;$i<=$data->sheets[0]['numRows'];$i++){
    $sql = "INSERT INTO device VALUES('".

        $data->sheets[0]['cells'][$i][1]."','".
        $data->sheets[0]['cells'][$i][2]."','".
        $data->sheets[0]['cells'][$i][3]."','".
        $data->sheets[0]['cells'][$i][4]."','".
        $data->sheets[0]['cells'][$i][5]."','".
        $data->sheets[0]['cells'][$i][6]."','".
        $data->sheets[0]['cells'][$i][7]."','".
        $data->sheets[0]['cells'][$i][8]."','".
        $data->sheets[0]['cells'][$i][9]."','".
        $data->sheets[0]['cells'][$i][10]."','".
        $data->sheets[0]['cells'][$i][11]."','".
        $data->sheets[0]['cells'][$i][12]."','".
        $data->sheets[0]['cells'][$i][13]."','".
        $data->sheets[0]['cells'][$i][14]."','".
        $data->sheets[0]['cells'][$i][15]."','".
        $data->sheets[0]['cells'][$i][16]."','".
        $data->sheets[0]['cells'][$i][17]."','".
        $data->sheets[0]['cells'][$i][18]."','".
        $data->sheets[0]['cells'][$i][19]."','".
        $data->sheets[0]['cells'][$i][20]."','".
        $data->sheets[0]['cells'][$i][21]."','".
        $data->sheets[0]['cells'][$i][22]."','".
        $data->sheets[0]['cells'][$i][23]."','".
        $data->sheets[0]['cells'][$i][24]."','".
        $data->sheets[0]['cells'][$i][25]."','".
        $data->sheets[0]['cells'][$i][26]."','".
		$data->sheets[0]['cells'][$i][27]."')";

    echo $sql.'<br />';

    $res = mysqli_query($db,$sql);
    if($i==$data->sheets[0]['numRows']){
        echo success("设备数据导入成功，自动跳转","?action=address");
    };
/*
    $sql="INSERT INTO db_test (`Type`,`Category`,`Vendor`,`ProductName`) 
VALUES ('".

        $data->sheets[0]['cells'][$i][1]."','".
        $data->sheets[0]['cells'][$i][2]."','".
        $data->sheets[0]['cells'][$i][3]."','".
        $data->sheets[0]['cells'][$i][4]."')";
*/
}





?> 