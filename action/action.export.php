<?php
include './lib/phpexcel/PHPExcel.php';

$excel = new PHPExcel();
//Excel表格式,这里简略写了8列
$letter = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA');
//表头数组
$tableheader = array('Type','Category','Interface','Verden','Product','REV','FW','工具室料号','PropertyNum','DPN','ModelNum','Source','ProductName','Status','P_Date','UserName','LenOutDate','sign','Belong','BadEvent','BadSource','BadDate','Recorder','Badlife','退库时间','退库原因','ReturnBefore');
$sql="SELECT * FROM device";
$db->query($sql);
$data=$db->fetchAll();


//填充表头信息
for($i = 0;$i < count($tableheader);$i++) {
$excel->getActiveSheet()->setCellValue("$letter[$i]1","$tableheader[$i]");
}

//填充表格信息
for ($i = 2;$i <= count($data) + 1;$i++) {
$j = 0;
foreach ($data[$i - 2] as $key=>$value) {
$excel->getActiveSheet()->setCellValue("$letter[$j]$i","$value");
$j++;
} 
}
$write = new PHPExcel_Writer_Excel5($excel);
ob_end_clean();
header("Pragma: public");
header("Expires: 0");
header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
header("Content-Type:application/force-download");
header("Content-Type:application/vnd.ms-execl");
header("Content-Type:application/octet-stream");
header("Content-Type:application/download");;
header('Content-Disposition:attachment;filename="device(' . date('Ymd') . ').xls"');
header("Content-Transfer-Encoding:binary"); 
header("Content-type: text/html; charset=utf-8");
$write->save('php://output');

?>