<?php
include("include/header.inc.php");
include ("config.php");


if(isset($_POST['submit']))
{
$name=$_POST['name'];
//echo $name;die();
$veh_reg=$_POST['veh_reg'];
if($veh_reg=="0")
	{
	 $veh_reg=$_POST['veh_reg1'];
	}

$Notwoking=$_POST['Notwoking'];
$location=$_POST['location'];
$atime_status=$_POST['atime_status'];
$atime=$_POST['atime'];
$atimeto=$_POST['atimeto'];
$pname=$_POST['pname'];
$cnumber=$_POST['cnumber'];
$status=$_POST['status'];
$IP_Box=$_POST['IP_Box'];
$datapullingtime=$_POST['datapullingtime'];
$device_model=$_POST['device_model'];


$sql=mysql_query("SELECT name FROM users WHERE user_id='$name'");
$row=mysql_fetch_array($sql);

$sql="INSERT INTO services(name,veh_reg,Notwoking,location,atime,atimeto,atime_status,pname,cnumber,req_date,status,required,datapullingtime,IP_Box,branch_id, device_model)VALUES('".$row['name']."','".$veh_reg."','".$Notwoking."','".$location."','".$atime."','".$atimeto."','".$atime_status."','".$pname."','".$cnumber."','".date("Y-m-d")."','1','".$required."','".$datapullingtime."','".$IP_Box."','".$_SESSION['branch_id']."','".$device_model."')"; 

//echo "INSERT INTO services(name,veh_reg,Notwoking,location,atime,pname,cnumber,req_date,status)VALUES('".$row['name']."','".$veh_reg."','".$Notwoking."','".$location."','".$atime."','".$pname."','".$cnumber."','".date("Y-m-d")."','1')";die(); 
$execute=mysql_query($sql);
header("location:services.php");
}

?>


<link rel="stylesheet" type="text/css" media="all" href="js/calendar/calendar-win2k-1.css" title="win2k-1" />
  <link rel="stylesheet" type="text/css" media="all" href="js/calendar/calendar-win2k-1.css" title="win2k-1" />
<script src="../js/validation_new.js"></script>
    <!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="js/calendar/calendar-win2k-1.css" title="win2k-1" />
  
   <!-- main calendar program -->
  <script type="text/javascript" src="js/calendar/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="js/calendar/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="js/calendar/calendar-setup.js"></script>

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
 
function getYear(user_id,veh_reg) {
 
var strURL="ajax.php?user_id="+user_id+"&select_id="+veh_reg;
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
<script type="text/javascript">

function req_info()
{

  var name=document.getElementById(name)
  if(document.form1.name.value==0)
  {
  alert("please choose one name") ;
  document.form1.name.focus();
  return false;
  }
   
  if(document.form1.veh_reg.value=="0" && document.form1.veh_reg1.value=="")
  {
  alert("please choose vehicle number") ;
  document.form1.veh_reg.focus();
  return false;
  }

  if(document.form1.Notwoking.value =="")
  {
   alert("please enter not working time");
   document.form1.Notwoking.focus();
   return false;
   }
   if(document.form1.location.value =="")
  {
   alert("please enter location");
   document.form1.location.focus();
   return false;
   }
   
    if(document.form1.atime.value =="")
  {
   alert("please enter available time");
   document.form1.atime.focus();
   return false;
   }
   
   if(document.form1.pname.value =="")
  {
   alert("please enter person name");
   document.form1.pname.focus();
   return false;
   }
   
   if(document.form1.cnumber.value =="")
  {
   alert("please enter contact number");
   document.form1.cnumber.focus();
   return false;
   }
    if(document.form1.device_model.value =="")
  {
   alert("please enter Device Model");
   document.form1.device_model.focus();
   return false;
   }
   
 }  
</script>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form method="post" action="" name="form1" onSubmit="return req_info();">
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">

 <tr>
<td width="24%" height="29" align="right" >Client Name:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td colspan="2">
<?php
include("config.php");
$query="SELECT user_id,name FROM users";
$result=mysql_query($query);

?> 

 
<select name="name" id="name" onChange="getYear(this.value,'veh_reg')" style="width:150px">
<option value="0">Select Name</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['user_id']?>><?=$row['name']?></option>
<? } ?>
</select></td>
</tr>
<tr style="">
<td align="right">Vehicle No*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td width="19%"><div id="statediv"><select name="veh_reg" style="width:150px">
  <option value="0">Select Name First</option>
</div></td>
<td width="8%"> <td width="21%">Or <input type="text" name="veh_reg1" id="veh_reg1" value="" />
<td width="0%"><td width="9%" align="left"></select></div> &nbsp;&nbsp;<td width="19%"></td>
<td width="0%"></td>
</tr>

<tr>
<td height="32" align="right">Notwoking:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan="2"><input type="text" name="Notwoking" value="" id="Notwoking" style="width:147px" autocomplete="off" readonly/></td>
</tr>
<tr>
<td height="32" align="right">Location:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan="2"><input type="text" name="location" value="" style="width:147px"/></td>
</tr>
<tr>
<td height="32" align="right">Availbale Time status:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan="2">

<select name="atime_status" id="atime_status" style="width:150px">
<option value="">Select Status</option>
<option value="Till">Till</option>
<option value="Between">Between</option></select></td></tr>


<tr>
<td height="32" align="right">Available Time:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td colspan="2">
	 <input type="text" name="atime" id="atime" value="" style="width:147px" autocomplete="off" readonly/></td> 
	 <td> TO:- <input type="text" name="atimeto" id="atimeto" value="" style="width:147px" autocomplete="off" readonly/> 		
	  	</td>
</tr>

<tr>
<td height="32" align="right">Person Name:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>
	 <input type="text" name="pname" id="pname" value="" style="width:147px"/> 		
	  	</td>
</tr>
<tr>
<td height="32" align="right">Contact No:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan="2"><input type="text" name="cnumber" value="" style="width:147px"/></td>
</tr>
<tr>
<td height="32" align="right">Required.:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="checkbox" name="required" id="required" value="urgent" /> Urgent </td>
</tr>
<tr>
<td height="32" align="right">IP Box.:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="checkbox" name="IP_Box" id="IP_Box" value="required" <?php if($result['IP_Box']=='required') {?> checked="checked" <? }?> /> Required </td>
</tr>
<tr>
<td height="32" align="right">Data Pulling Time.:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="datapullingtime" id="datapullingtime" value="" style="width:147px"/></td>
</tr>

<tr>
<td height="32" align="right">Device Model.:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><?php
include("config.php");
$query="SELECT device_model FROM device_model";
$result=mysql_query($query);

?> 

 
<select name="device_model" id="device_model" style="width:150px">
<option value="">Select Device Model</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['device_model']?>><?=$row['device_model']?></option>
<? } ?>
</select></td>
</tr>

<tr>
<td height="32" align="right"><input type="submit" name="submit" value="submit" align="right" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="Cancel" value="Cancel" onClick="window.location = 'services.php' " /></td>
</tr>

</table>
</form>
</body>
</html>
<?
include("include/footer.inc.php");

?>

<script type="text/javascript">
   
     
    Calendar.setup({
        inputField     :    "Notwoking",   // id of the input field
        ifFormat       :    "%Y-%m-%d %H:%M",       // format of the input field
        showsTime      :    true,
        timeFormat     :    "24",
        firstDay       :    1
    });
    Calendar.setup({
        inputField     :    "atime",
        ifFormat       :    "%Y-%m-%d %H:%M",
        showsTime      :    true,
        timeFormat     :    "24",
        firstDay       :    1
    });
	  Calendar.setup({
        inputField     :    "atimeto",
        ifFormat       :    "%Y-%m-%d %H:%M",
        showsTime      :    true,
        timeFormat     :    "24",
        firstDay       :    1
    });
   
</script>