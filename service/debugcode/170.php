<?php

$data="ID-1039951,GPSdate-29-07-2013 06:22:02,Indiadate-29-07-2013 11:52:02,Lat-28.5847979367895,Long-77.1654293022111,Speed-0,Direction-51,Ign-0,Satellite-6,GPS-1,MainPower-1,BatteryPower-1,MainpowerVol-26.117647058817,BattVol-4.08470588104,TransmissionReason-11,Tempring-0,Temp-0
ID-1039951,GPSdate-29-07-2013 06:25:02,Indiadate-29-07-2013 11:55:02,Lat-28.5847979367895,Long-77.1654293022111,Speed-0,Direction-51,Ign-0,Satellite-6,GPS-1,MainPower-1,BatteryPower-1,MainpowerVol-26.117647058817,BattVol-4.08470588104,TransmissionReason-11,Tempring-0,Temp-0
ID-1039951,GPSdate-29-07-2013 06:28:02,Indiadate-29-07-2013 11:58:02,Lat-28.5848592432736,Long-77.1652367883919,Speed-0,Direction-52,Ign-0,Satellite-6,GPS-1,MainPower-1,BatteryPower-1,MainpowerVol-26.117647058817,BattVol-4.08470588104,TransmissionReason-11,Tempring-0,Temp-0
ID-1039951,GPSdate-29-07-2013 06:31:03,Indiadate-29-07-2013 12:01:03,Lat-28.5848592432736,Long-77.1652367883919,Speed-0,Direction-52,Ign-0,Satellite-6,GPS-1,MainPower-1,BatteryPower-1,MainpowerVol-26.117647058817,BattVol-4.08470588104,TransmissionReason-11,Tempring-0,Temp-0
ID-1039951,GPSdate-29-07-2013 06:34:04,Indiadate-29-07-2013 12:04:04,Lat-28.5848592432736,Long-77.1652367883919,Speed-0,Direction-52,Ign-0,Satellite-6,GPS-1,MainPower-1,BatteryPower-1,MainpowerVol-26.117647058817,BattVol-4.08470588104,TransmissionReason-11,Tempring-0,Temp-0
ID-1039951,GPSdate-29-07-2013 06:37:04,Indiadate-29-07-2013 12:07:04,Lat-28.5848592432736,Long-77.1652367883919,Speed-0,Direction-52,Ign-0,Satellite-6,GPS-1,MainPower-1,BatteryPower-1,MainpowerVol-26.117647058817,BattVol-4.08470588104,TransmissionReason-11,Tempring-0,Temp-0
ID-1039951,GPSdate-29-07-2013 06:40:06,Indiadate-29-07-2013 12:10:06,Lat-28.5848592432736,Long-77.1652367883919,Speed-0,Direction-52,Ign-0,Satellite-6,GPS-1,MainPower-1,BatteryPower-1,MainpowerVol-26.117647058817,BattVol-4.08470588104,TransmissionReason-11,Tempring-0,Temp-0
ID-1039951,GPSdate-29-07-2013 06:43:06,Indiadate-29-07-2013 12:58:10,Lat-28.5848626810204,Long-77.1653347641749,Speed-0,Direction-221,Ign-0,Satellite-5,GPS-1,MainPower-1,BatteryPower-1,MainpowerVol-26.117647058817,BattVol-4.08470588104,TransmissionReason-11,Tempring-0,Temp-0";

$string=explode("\n",$data);
$toEnd = count($string);
foreach($string as $key=>$value) {
  if (0 === --$toEnd) {
   "$value"."<br />"."<br />";
  }
}

list($a, $b, $c, $d, $e, $f , $g , $h ,$i, $j, $k, $l, $m) = preg_split("/[\s,]+/", $value);
$str = "$d $e $f $j $k $l<br />\n"; 

$str1 = substr("$str", 21, 8);
$str2 = substr("$str", 34, 17);
$str3 = substr("$str", 55, 1);
$str4 = substr("$str", 67, 1);
$str5 = substr("$str", 73, 1);
$str6 = substr("$str", 10, 10);



/*echo $str1."<br />";
echo $str2."<br />";
echo $str3."<br />";
echo $str4."<br />";
echo $str5."<br />";
echo $str6;
*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link rel="stylesheet" href="css/style.css" />
<style>
.page{
font-family:Arial, Helvetica, sans-serif;
font-size:12px;
}
table{
border:1px;
}

</style>
<link href="../../css/admin.css" rel="stylesheet" type="text/css">
<link href="../../css/controls.css" rel="stylesheet" type="text/css">
<link href="../../css/mouse_over.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #6D97C9;
}
.style2 {font-size: 14px}
.style3 {color: #6D97C9; font-weight: bold;}
-->
</style>
</head>

<body>
<div class="page">
<script src="../../js/ajax.js"></script>
<script>
function filetime(file,service_id){

	ajaxpage_get('filetime.php?qry=testimonials&file='+file+'&service_id='+service_id,'filetime','');


}
</script>
<script>
function submitme(){
//alert("hi");
if(document.getElementById('searchtype1').checked==true){
document.form1.action='debug.php';
}
document.form1.submit();
//document.form1.action='debug.php';
return false;
}
</script>
<form method="post" action="" onsubmit="return submitme();" name="form1">
  <input type="text" name="userid" id="userid" value="1039951"><select name="selecttype">
<option id="0" value="0"  selected="selected" >All Vehicles</option>
<option id="1" value="1" >Not Working Vehicles</option>
</select>
<input type="radio" name="searchtype" id="searchtype1" value="user"   />User
<input type="radio" name="searchtype" id="searchtype2" value="imei"   checked="checked" />Imei
<input type="submit" name="submit" value="submit">&nbsp;&nbsp;<!-- <a href='data-error-log/26-07-13.txt' target='_blank'>Last Vehcile Erros</a> -->
</form>
<div style="text-align:right"> <a href="debug.php"> Search by Username </a>&nbsp;&nbsp;&nbsp;<a href="list_vehicles_by_group_name.php"> Search All </a> &nbsp;&nbsp;&nbsp; <a href="list_all_vehicles_by_group_name.php" target="_blank">Group Vehciles by Account</a> <a href="save_as_excel.php?type=print" target="_blank"></a>&nbsp;&nbsp;<a href="save_as_excel.php?manage=&username=1039951" target="_blank"></a></div>
<div id="filetime"></div><div id="datatime"></div>
 File Found <br> 

 <span class="style1">GPS TIME STATUS=&gt;</span>
 <span class="style2">
 <?php
$todaydate = @date('d-m-Y');
$time_now=@mktime(@date('G'),@date('i'),@date('s'));
$NowisTime=@date('G:i:s',$time_now);
$endtime = @date('G:i:s', strtotime("-5 minutes", strtotime($NowisTime))); 
 
if($NowisTime >= $str1 and $str1 >= $endtime and $todaydate == $str6) {
$image = "green.jpg"; 
   echo "<img src=".$image." Style=width:50px;height:50px;>";
 }  else {
    $image1 = "red.png";  
	echo "<img src=".$image1." Style=width:45px;height:45px;>";
   } 
   ?>
 <span class="style3">LAT LONG STATUS=&gt;</span></span>
 <span class="style2">
 <?
if ($str2 =='0'){
  	$image = "red.png";
   echo "<img src=".$image." Style=width:45px;height:45px;>";
 }  else {
    $image1 = "green.jpg";  
	echo "<img src=".$image1." Style=width:50px;height:50px;>";
   } 
   ?>
 <span class="style3">AC STATUS=&gt;</span></span>
  <span class="style2">
  <?
   if ($str3 =='0'){
  $image = "red.png";
   echo "<img src=".$image." Style=width:45px;height:45px;>";
 }  else {
    $image1 = "green.jpg";  
	echo "<img src=".$image1." Style=width:50px;height:50px;>";
   } 
   ?>
  <span class="style3">SATELLITE STATUS=&gt;</span></span>
  <span class="style2">
  <?
   if ($str4 =='0'){
   $image = "red.png";
  echo "<img src=".$image." Style=width:45px;height:45px;>";
 }  else {
    $image1 = "green.jpg";  
	echo "<img src=".$image1." Style=width:50px;height:50px;>";
   } 
   ?>
 
  <span class="style3">GPS STATUS=&gt;</span></span>
  <?
   if ($str5 =='0'){
   $image = "red.png";
  echo "<img src=".$image." Style=width:45px;height:45px;>";
 }  else {
    $image1 = "green.jpg";  
	echo "<img src=".$image1." Style=width:50px;height:50px;>";
   } 
 ?>

<textarea cols="200" rows="20" wrap="hard" id="test">
ID-1039951,GPSdate-29-07-2013 06:22:02,Indiadate-29-07-2013 11:52:02,Lat-28.5847979367895,Long-77.1654293022111,Speed-0,Direction-51,Ign-0,Satellite-6,GPS-1,MainPower-1,BatteryPower-1,MainpowerVol-26.117647058817,BattVol-4.08470588104,TransmissionReason-11,Tempring-0,Temp-0
ID-1039951,GPSdate-29-07-2013 06:25:02,Indiadate-29-07-2013 11:55:02,Lat-28.5847979367895,Long-77.1654293022111,Speed-0,Direction-51,Ign-0,Satellite-6,GPS-1,MainPower-1,BatteryPower-1,MainpowerVol-26.117647058817,BattVol-4.08470588104,TransmissionReason-11,Tempring-0,Temp-0
ID-1039951,GPSdate-29-07-2013 06:28:02,Indiadate-29-07-2013 11:58:02,Lat-28.5848592432736,Long-77.1652367883919,Speed-0,Direction-52,Ign-0,Satellite-6,GPS-1,MainPower-1,BatteryPower-1,MainpowerVol-26.117647058817,BattVol-4.08470588104,TransmissionReason-11,Tempring-0,Temp-0
ID-1039951,GPSdate-29-07-2013 06:31:03,Indiadate-29-07-2013 12:01:03,Lat-28.5848592432736,Long-77.1652367883919,Speed-0,Direction-52,Ign-0,Satellite-6,GPS-1,MainPower-1,BatteryPower-1,MainpowerVol-26.117647058817,BattVol-4.08470588104,TransmissionReason-11,Tempring-0,Temp-0
ID-1039951,GPSdate-29-07-2013 06:34:04,Indiadate-29-07-2013 12:04:04,Lat-28.5848592432736,Long-77.1652367883919,Speed-0,Direction-52,Ign-0,Satellite-6,GPS-1,MainPower-1,BatteryPower-1,MainpowerVol-26.117647058817,BattVol-4.08470588104,TransmissionReason-11,Tempring-0,Temp-0
ID-1039951,GPSdate-29-07-2013 06:37:04,Indiadate-29-07-2013 12:07:04,Lat-28.5848592432736,Long-77.1652367883919,Speed-0,Direction-52,Ign-0,Satellite-6,GPS-1,MainPower-1,BatteryPower-1,MainpowerVol-26.117647058817,BattVol-4.08470588104,TransmissionReason-11,Tempring-0,Temp-0
ID-1039951,GPSdate-29-07-2013 06:40:06,Indiadate-29-07-2013 12:10:06,Lat-28.5848592432736,Long-77.1652367883919,Speed-0,Direction-52,Ign-0,Satellite-6,GPS-1,MainPower-1,BatteryPower-1,MainpowerVol-26.117647058817,BattVol-4.08470588104,TransmissionReason-11,Tempring-0,Temp-0
ID-1039951,GPSdate-29-07-2013 06:43:06,Indiadate-29-07-2013 12:13:06,Lat-28.5848626810204,Long-77.1653347641749,Speed-0,Direction-221,Ign-0,Satellite-5,GPS-1,MainPower-1,BatteryPower-1,MainpowerVol-26.117647058817,BattVol-4.08470588104,TransmissionReason-11,Tempring-0,Temp-0
</textarea>

																		<br>
									Insert Error Log File
									<br>
									<textarea cols="200" rows="20">ID-1039951,GPSdate-26-07-2013 08:09:11,Indiadate-26-07-2013 13:39:11,Long-77.1651250616219,Speed-0,Direction-72,Ign-0,Satellite-5,GPS-1,MainPower-1,BatteryPower-1,MainpowerVol-25.9999999999935,BattVol-4.06823529281,TransmissionReason-11,Tempring-0,Temp-0
</textarea>
									
									
									<pre>File Modified Time=<b>2013/07/26 16:45:19</b><br>Last Record in Telemetry at:2013-07-26 16:45:19<br>Registartion No=<b>DL1PB3123</b><br><br><div style='height:300px; width:400px;overflow:scroll;'>Log=--------------------------------------
Date: 22-05-2013 17:02:14
Notes: 
**Created**
--------------------------------------
--------------------------------------
Date: 22-05-2013 17:02:14
Notes: 
Added to Vimal
--------------------------------------
--------------------------------------
Date: 22-05-2013 17:02:14
Notes: 
Added to Jupiter Travels
--------------------------------------
</pre>

</form>
</body>
</html>