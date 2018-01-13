<?php
include ("config.php");
$id=$_REQUEST['id'];
$oldreason=mysql_fetch_array(mysql_query("select reason from services where id=$id"));
if(isset($_REQUEST['submit']))
	{
	$id=$_REQUEST['id'];
	$reason=$_REQUEST['reason'];	
	mysql_query("update services set reason='$reason' where id=$id");
	?>
    <script type="text/javascript">
	opener.location.reload();
    window.close();	
    </script>
	<? 
	
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form name="frm" action="editreason.php" method="get">
<input type="hidden" name="id" value="<?=$id?>" />
<table width="261" height="123" border="1" align="center">
  <tr>
    <td width="112">Change Reason</td>
    <td width="137"><textarea name="reason" id="reason" cols="20" rows="6" ><?=$oldreason['reason']?></textarea> </td>
  </tr>
   <tr>
    
    <td colspan="2" align="center"><input type="submit" name="submit" value="Update" id="submit" /> </td>
  </tr>
</table>
</form>
</body>
</html>