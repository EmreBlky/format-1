<?php
include("include/header.inc.php");
include("config.php");
ob_start();

if(isset($_POST['submit']))
{
$name=$_POST['name'];
$select=mysql_query("select * from users where name='$name'");
$row=mysql_fetch_row($select);

if(!empty($row))
{
echo "user is already exist";
}
else
{
$sql1=mysql_query("insert into users(name)values('".$name."')");
}

}

?>
<script language="JavaScript">
function setVisibility(id, visibility) {
document.getElementById(id).style.display = visibility;
}
</script> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form name="form" method="post" action="">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
  <td height="29" align="right" >Client Name:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="name" value="" /></td>  
</tr>

<tr><td  height="29" align="right"><input type="submit" name="submit" value="submit"  /></td>
</tr>
</table>
</form>
</body>
</html>
<?
include("include/footer.inc.php");

?>