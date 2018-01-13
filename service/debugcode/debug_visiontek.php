<?php
	
	$path="debug_visiontek.csv";
	
	$fp=fopen($path,'r');
 
      $filedata=fread($fp,filesize($path));
	 
	 
	$splittedstring=explode('$',$filedata);
	
//print_r($splittedstring);
	
	 $datacount = count($splittedstring);
	
	   $value=$splittedstring[ $datacount - 1]."<br />\n";

 list($a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k, $l, $m, $n) = preg_split("/[,#]/", $value);
   $str = "$c $d $e $f $g $h $i $j $n<br />\n"; 

     $date = "20$e-$d-$c";
     $oldtime = "$f:$g:$h";
  
  $oldtime = @strtotime("$f:$g:$h");
    $time = @date("H:i:s", strtotime('+330 minutes', $oldtime));
  
    $lat = "$i"; 

   $long = "$j"; 

  $gps = "$n";

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
  <input type="text" name="userid" id="userid" value="">
<input type="radio" name="searchtype" id="searchtype2" value="imei"   checked="checked" />Imei
<input type="submit" name="submit" value="submit">&nbsp;&nbsp;<!-- <a href='data-error-log/26-07-13.txt' target='_blank'>Last Vehcile Erros</a> -->
</form>
<div id="filetime"></div><div id="datatime"></div><br> 
 File Found <br> 
File Modified Time=<b>2013/07/26 16:45:19</b><br>Last Record in Telemetry at:2013-07-26 16:45:19<br>Registartion No=<b>DL1PB3123</b><br><br>
  <span class="style3">LAST RECORD  =></span>
 <span class="style3">
 
 <?php
  echo $data ="$date $time $lat $long $gps"; 
?>
 </span>
 
 <br>  <br><table width="463" border="1">
  <tr>
    <td width="120" height="20"><span class="style3">GPS TIME STATUS</span></td>
    <td width="127"><span class="style3">LAT LONG STATUS</span></td>
    <td width="90"><span class="style3">AC STATUS</span></td>
    <td width="98"><span class="style3">GPS STATUS</span></td>
  </tr>
  <tr>
    <td height="22">
	<span class="style2"><?php
$todaydate = @date('Y-m-d');
$time_now=@mktime(@date('G'),@date('i'),@date('s'));
$NowisTime=@date('G:i:s',$time_now);
$endtime = @date('G:i:s', strtotime("-5 minutes", strtotime($NowisTime))); 
 

if($NowisTime >= $time and $time >= $endtime and $date >= $todaydate) {
$image = "green.jpg"; 
   echo "<img src=".$image." Style=width:35px;height:35px;>"."<br />";
 }  else {
    $image1 = "red.png";  
	echo "<img src=".$image1." Style=width:31px;height:31px;>"."<br />";
   } 
   ?>
  </span></td>
    <td> <span class="style2">
 <?php
 
if ($lat ==0 and $long ==0){
  	$image = "red.png";
   echo "<img src=".$image." Style=width:31px;height:31px;>"."<br />";
 }  else {
    $image1 = "green.jpg";  
	echo "<img src=".$image1." Style=width:35px;height:35px;>"."<br />";
   } 
   ?>
  </span></td>
    <td><span class="style2">
 	<?php
   if ($ign ==0){
   $image = "red.png";
  echo "<img src=".$image." Style=width:31px;height:31px;>"."<br />";
 }  else {
    $image1 = "green.jpg";  
	echo "<img src=".$image1." Style=width:35px;height:35px;>"."<br />";
   } 
   ?>
   </span></td>
   
    <td>
	<span class="style2">
  <?php
   if ($gps ==V){
   $image = "red.png";
  echo "<img src=".$image." Style=width:31px;height:31px;>";
 }  else {
    $image1 = "green.jpg";  
	echo "<img src=".$image1." Style=width:35px;height:35px;>";
   } 
 ?>
</span></td>
  </tr>
</table>  
</div></body></html>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
function countChar(val) {
        var len = val.length;
        if (len >= 100) {
      return false;
          val.value = val.substring(0, 100);
    
        } else {
          $('#charNum').text(0 + len);
        }
      };
	  
	</script>
	
	<div id="charNum"></div>
