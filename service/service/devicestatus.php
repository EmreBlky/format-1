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
 
 $devicestatus=$_POST["devicestatus"];
 
$sql_repair="UPDATE repai_device SET devicestatus='$devicestatus' WHERE id='$id'";

$repair_execute=mysql_query($sql_repair);
 
header("location:show_repairs.php?mode=close");
}

 

?> 

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
<tr>
<td height="28" align="right">Model:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="model" id="model" readonly="readonly" value="<?php echo $rows['model'];?>" /></td>
</tr>
 <tr>
<td height="28" align="right">Device Status</td>
<td><input type="text" name="devicestatus" id="devicestatus"  value="<?php echo $rows['devicestatus'];?>"/></td>
</tr>
</table>
 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td width="42%" align="right">&nbsp;&nbsp;&nbsp;</td>

<td width="58%" align="left"><input type="submit" value="submit" name="submit"/></td></tr>
</table>

</form>
</body>
</html>
<?
include("include/footer.inc.php");

?>
