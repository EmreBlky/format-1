<?php
session_start();
ob_start();
include("include/header.inc.php");
include ("config.php");
$id=$_GET['id'];
$sql1=mysql_query("select * from stock_listing where id='$id'");
$row=mysql_fetch_row($sql1);
//print_r($row);

if(isset($_POST['submit']))
{
$model=$_POST['model'];
$stock=$_POST['stock'];

$sql="update stock_listing set model='$model',stock='$stock' where id='$id'";
$execute=mysql_query($sql);

header("location:stock_listing.php");
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
<form name="form" method="post" action="" onSubmit="return req_info();">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td height="29" align="right">Model:*&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="model" value="<? echo $row[1];?>" /></td>
</tr>
<tr><td align="right" height="29">Stock:*&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="stock" value="<? echo $row[2];?>" /></td>
</tr>
<tr>
<td height="29" align="right"><input type="submit" name="submit" value="submit" /></td>
</tr>
</table>
</form>
</body>
</html>