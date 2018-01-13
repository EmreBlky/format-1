<?php
include("include/header.inc.php");
include("config.php");
ob_start();

if(isset($_REQUEST['action'])==edit)
{
$id=$_GET['id'];
$query=mysql_query("SELECT * FROM repai_device WHERE id='$id'");

$rows=mysql_fetch_array($query);
}
$msg="";
if(isset($_POST['submit']))
{
if($_POST['group2']=='host_comp')
{

if($_POST['comp_name']==""||$_POST['per_name']=="")
{
$msg="enter company name and person name";
}
}
if($msg=="")
{
$name=$_POST['name'];
//echo $name;die();
$veh_reg=$_POST['veh_reg'];
$model=$_POST['model'];
$deviceid=$_POST['deviceid'];
$sim_status=$_POST['sim_status'];
$new_sim_no=$_POST['new_sim_no'];
$old_sim_no=$_POST['old_sim_no'];
$Imei=$_POST['Imei'];
$date=$_POST['date'];
$problem=$_POST['problem'];
$group2=$_POST['group2'];
$comp_name=$_POST['comp_name'];
$per_name=$_POST['per_name'];
$Actual_bloblem=$_POST['Actual_bloblem'];
$Spare_cost=$_POST['Spare_cost'];
$Repaired=$_POST['Repaired'];
if($Repaired!="")
	{
	$group2=$Repaired;
	}
/*$hc_date=$_POST['hc_date'];
$hc_prob=$_POST['hc_prob'];*/
//echo $msg;die();


if($_POST['old_imei']!="")
	{
	$old_imei=$Imei;
	$Imei=$_POST['old_imei'];
	$old_q=" , old_imei='$old_imei'";
	}
 $sql_repair="UPDATE repai_device SET name='$name', veh_reg='$veh_reg', model='$model', deviceid='$deviceid', sim_status='$sim_status', new_sim_no='$new_sim_no', old_sim_no='$old_sim_no', Imei='$Imei',  date='$date',problem='$problem',group2='$group2',comp_name='$comp_name',close_date='".date("Y-m-d")."',Actual_bloblem='$Actual_bloblem',Spare_cost='$Spare_cost',per_name='$per_name' $old_q WHERE id='$id'";

 

$repair_execute=mysql_query($sql_repair);
$pg=$_GET['pg'];
header("location:open_device.php?pg=$pg");
} 

}

?>
<script language="JavaScript">
function rep_validate()
	{
	if(document.form1.Repaired.value=="")
		{ 
		alert("Please Select Repaired Or Not");
		return false;
	}
	}
	
function setVisibility(id, visibility) {
document.getElementById(id).style.display = visibility;
}
function show_newimei()
	{
	document.getElementById('divi').style.display='';
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
<form method="post" action="" name="form1">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td><td><input name="id" type="hidden" readonly="readonly" id="id" value="<?php echo $rows['id'];?>"></td></td></tr>
 <tr>
<td height="30" align="right">Client Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="name" id="name" readonly="readonly" value="<?php echo $rows['name'];?>" /></td>
</tr>
<tr style="">
<td height="29" align="right">Vehicle No:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="veh_reg" id="veh_reg" readonly="readonly" value="<?php echo $rows['veh_reg'];?>" /></td>
</tr>
<td height="28" align="right">Model:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="model" id="model" readonly="readonly" value="<?php echo $rows['model'];?>" /></td>
</tr>
<tr>
<td height="31" align="right">Device Id:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="deviceid" id="deviceid" readonly="readonly" value="<?php echo $rows['deviceid'];?>" /></td>
</tr>
<tr>
<td height="31" align="right">SIM Status:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="sim_status" id="sim_status" readonly="readonly" value="<?php echo $rows['sim_status'];?>" /></td>
</tr>

<tr>
<td height="27" align="right">Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="date" id="date" readonly="readonly" value="<?php echo $rows['date'];?>" /></td>
</tr>
<tr>
<td height="28" align="right">Problem:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="problem" id="problem" readonly="readonly" value="<?php echo $rows['problem'];?>" /></td>
</tr>
<tr>
<td height="29" align="right">Imei:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="Imei" id="Imei" readonly="readonly" value="<?php echo $rows['Imei'];?>" /><input type="button"  value="Add New" onClick="show_newimei();" /></td>
</tr>
</table>
<div id="divi" style="display:none; padding-right:315px;">
<table align="center">
<tr>
<td height="27" align="right"> New Imei:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="old_imei" id="old_imei" value="<?php echo $rows['old_imei'];?>" /></td>
</tr>
<tr>
<td width="39%" height="27" align="right">New SIM*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td width="61%"><input type="text" name="new_sim_no" value="<?php echo $rows['new_sim_no'];?>" /></td>
</tr>
<tr>
<td width="33%" height="27" align="right">Old SIM*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td width="67%"><input type="text" name="old_sim_no" value="<?php echo $rows['old_sim_no'];?>" /></td>
</tr>
</table>
</div>

<table width="100%" border="0" cellpadding="0" cellspacing="0">

<tr>

 <td width="378" height="32" align="right">Select One:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  <td width="580"><input type="radio" name="group2" value='host_comp' checked="checked" onClick="setVisibility('sub3', 'inline');";>To Host Company
<input type="radio" name="group2" value='int_repaired' onClick="setVisibility('sub3', 'none');";>Internal Repaired

<input type="radio" name="group2" value='Not Repairable' onClick="setVisibility('sub3', 'none');";>Not Repairable


<br></td>
</tr></table>
<div id="sub3">
<table width="100%" border="0" cellpadding="0" cellspacing="">
<tr><td align="right"><?php
echo $msg;
?></td></tr>

<tr>
<td width="39%" height="27" align="right">Actual Problem*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td width="61%"><input type="text" name="Actual_bloblem" maxlength="500" value="<?php echo $rows['Actual_bloblem'];?>" /></td>
</tr>
<tr>
<tr>
<td width="39%" height="27" align="right">Spare Cost*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td width="61%"><input type="text" name="Spare_cost" value="<?php echo $rows['Spare_cost'];?>" /></td>
</tr>
<tr>
<td width="39%" height="27" align="right">Company Name*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td width="61%"><input type="text" name="comp_name" value="<?php echo $rows['comp_name'];?>" /></td>
</tr>
<tr>
<td align="right" height="29">Person Name*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td width="61%"><input type="text" name="per_name" value="<?php echo $rows['per_name'];?>" /></td>
</tr>
<tr>
<td align="right" height="29">Repaired*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td width="61%">
<select name="Repaired" id="Repaired">
<option value="">Select One</option>
<option value="Yes">Yes</option>
<option value="No">No</option>

</select>

</td>
</tr>
<!--<tr>
<td align="right" height="32">Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td width="61%"><input type="text" name="hc_date" value="" /></td>
</tr>
<tr>
<td align="right">Problem:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td width="61%"><input type="text" name="hc_prob" value="" /></td>
</tr>-->

</table>
</div>
<br />
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td width="42%" align="right">&nbsp;&nbsp;&nbsp;</td>

<td width="58%" align="left"><input type="submit" value="submit" name="submit"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="Cancel" value="Cancel" onClick="window.location = 'open_device.php' " /></td></tr>
</table>

</form>
</body>
</html>
<?
include("include/footer.inc.php");

?>
