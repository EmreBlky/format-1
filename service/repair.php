<?php
include("include/header.inc.php");
include("config.php");
ob_start();

if(isset($_POST['submit']))
{

$group2=$_POST['group2'];
$name=$_POST['name'];
$veh_reg=$_POST['veh_reg'];
$model=$_POST['model'];
$deviceid=$_POST['deviceid'];

$comp_name=$_POST['comp_name'];
$per_name=$_POST['per_name'];
$hc_date=$_POST['hc_date'];
$hc_prob=$_POST['hc_prob'];

$sql=mysql_query("SELECT name FROM users WHERE user_id='$name'");
$row=mysql_fetch_array($sql);

$sql_repair="INSERT INTO repai_device(group2,name,veh_reg,model,deviceid,comp_name,per_name,hc_date,hc_prob)VALUES('".$group2."','".$row['name']."','".$veh_reg."','".$model."','".$deviceid."','".$comp_name."','".$per_name."','".$hc_date."','".$hc_prob."')";

$repair_execute=mysql_query($sql_repair);
header("location:open_device.php");
}


?>
<script language="JavaScript">
function setVisibility(id, visibility) {
document.getElementById(id).style.display = visibility;
}
</script>

<script type="text/javascript">
function getXMLHTTP() { //fuction to return the xml http object
var xmlhttp=false;
try{
xmlhttp=new XMLHttpRequest();
}
catch(e) {
try{
xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
}
catch(e){
try{
xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
}
catch(e1){
xmlhttp=false;
}
}
}
 
return xmlhttp;
}
 
function getYear(user_id) {
 
var strURL="ajax.php?user_id="+user_id;
var req = getXMLHTTP();
 
if (req) {
 
req.onreadystatechange = function() {

if (req.readyState == 4) {
// only if "OK"
if (req.status == 200) {
document.getElementById('statediv').innerHTML=req.responseText;
} else {
alert("There was a problem while using XMLHTTP:\n" + req.statusText);
}
}
}
req.open("GET", strURL, true);
req.send(null);
}
}

</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body >
<form name="form1" method="post" action="">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td height="29" align="right">Client Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>
<?php
include("config.php");
$query="SELECT user_id,name FROM users";
$result=mysql_query($query);

?> 

 
<select name="name" onChange="getYear(this.value)">
<option>Select Name</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['user_id']?>><?=$row['name']?></option>
<? } ?>
</select></td>
</tr>
<tr style="">
<td align="right">Vehicle No:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td ><div id="statediv"><select name="veh_reg">
<option>Select Name First</option>
</select></div></td>
</tr>

<tr>
<td height="32" align="right">Model:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="model" value="" /></td>
</tr>
<tr>
<td height="32" align="right">Device Id:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="deviceid" value="" /></td>
</tr>

</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
 <td width="378" height="32" align="right">Select One:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  <td width="580"><input type="radio" name="group2" value='host_comp' onClick="setVisibility('sub3', 'inline');";>To Host Company
<input type="radio" name="group2" value='int_repaired' onClick="setVisibility('sub3', 'none');";>Internal Repaired<br></td>
</tr></table>
<div id="sub3">
<table width="100%" border="0" cellpadding="0" cellspacing="">

<tr>
<td width="39%" height="27" align="right">Company Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td width="61%"><input type="text" name="comp_name" value="" /></td>
</tr>
<tr>
<td align="right" height="29">Person Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td width="61%"><input type="text" name="per_name" value="" /></td>
</tr>
<tr>
<td align="right" height="32">Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td width="61%"><input type="text" name="hc_date" value="" /></td>
</tr>
<tr>
<td align="right">Problem:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td width="61%"><input type="text" name="hc_prob" value="" /></td>
</tr>

</table>
</div>
<br />
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td width="42%" align="right">
  <input type="submit" value="submit" name="submit" />&nbsp;&nbsp;&nbsp;</td><td width="58%" align="left"><input type="button" name="Cancel" value="Cancel" onClick="window.location = 'open_device.php' " /></td></tr>
</table>
</form>
</body>
</html>
<?
include("include/footer.inc.php");

?>
