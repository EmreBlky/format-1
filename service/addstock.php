<?php
session_start();
ob_start();
include("include/header.inc.php");
include ("config.php");

$mode=$_GET['mode'];
if(isset($_POST['submit']))
{
if($mode=='in')
	{
	$flag=1;
	}
	else if($mode=='out')
	{
	$flag=0;
	}
	
	$model=$_POST['model'];
	$stock=$_POST['stock'];
	$source=$_POST['source'];
	$device_type=$_POST['device_type'];
	
$sql=mysql_query("insert into stocks(model,no_of_devices,source,date,flag,device_type)values('".$model."','".$stock."','".$source."',now(),".$flag.",".$device_type.")");	
header("location:stocks.php?mode=$mode");
}	









?>

<script type="text/javascript">
function req_info()
{
  if(document.form.model.value=="")
   {
    alert("please enter model");
    document.form.model.focus();
    return false;
   }
   if(document.form.stock.value=="")
   {
    alert("please enter stock");
    document.form.stock.focus();
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
<form name="form" method="post" action="addstock.php?mode=<?=$mode?>" onSubmit="return req_info();">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding-top:30px; padding-bottom:30px;">
<tr><td height="29" align="right">Model:*&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="model" value="" /></td>
</tr>
<tr><td align="right" height="29">No. Of Devices:*&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="stock" value="" /></td>
</tr>
<? if($mode=='in'){?>
<tr><td align="right" height="29">Device Source:*&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>
<select name="source" id="source">
<option value="">Select One</option>
<option value="Visiontech">Visiontech</option>
<option value="Teltonic">Teltonic</option>
<option value="Other">Other</option>
</select>
</td>
</tr>
<? } else if($mode=='out') {?>
<tr><td align="right" height="29">Destination:*&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>
<select name="source" id="source">
<option value="">Select One</option>
<option value="Sonipath">Sonipath</option>
<option value="Jaipur">Jaipur</option>
<option value="Mumbai">Mumbai</option>
<option value="Other">Other</option>
</select>
</td>
</tr>
<? }?>
<tr>
<td height="32" align="right">Device Type*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan="2">

<Input type = 'Radio' Name ='device_type' value= '1' checked
<?PHP if($device_type==1) echo "checked"; ?>
>Old

<Input type = 'Radio' Name ='device_type' value= '2'
<?PHP if($device_type==2) echo "checked"; ?>
>New

</td>
</tr> 

<tr>
<td height="29" align="right"><input type="submit" name="submit" value="submit" /></td>
</tr>
</table>
</form>
</body>
</html>