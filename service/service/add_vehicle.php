<?php
include("include/header.inc.php");
include ("config.php");
ob_start();




if(isset($_POST['submit']))
{
$name=$_POST['name'];
$veh_reg=$_POST['veh_reg'];

$sql=mysql_query("insert into vehicles(veh_reg,user_id)values('".$veh_reg."','".$name."')");
}
?>
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
  if(document.form1.veh_reg.value=="")
  {
  alert("please enter vehicle number") ;
  document.form1.veh_reg.focus();
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
<form name="form1" method="post" action="" onSubmit="return req_info();">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td height="29" align="right" >Client Name:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>
<?php
include("config.php");
$query="SELECT user_id,name FROM users";
$result=mysql_query($query);

?> 

 
<select name="name" id="name" onChange="getYear(this.value)" style="width:150px">
<option value="0">Select Name</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['user_id']?>><?=$row['name']?></option>
<? } ?>
</select></td>
</tr>
<tr><td height="29" align="right">Vehicle No.*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="veh_reg" value="" /></td>
</tr>
<tr><td height="29" align="right"><input type="submit" name="submit" value="submit" /></td>
</tr>
</table>
</form>
</body>
</html>