<?php
include("lock.php");
//session_start();
include ('connection.php');
     if(isset($_POST["update"]))
  {
 // $sql=("select * from device_change where id='".$_GET["id"]."'");
 $updt=mysql_query("update sim_change set old_sim_status='".$_POST["old_sim_status"]."' where id='".$_POST["id"]."'");	
     echo "record updated";
 }
   $sql=("select * from sim_change where id='".$_GET["id"]."'");
  $search=mysql_query($sql);

//echo "<script>document.location.href ='sarvesh_device_change.php'</script>";
 ?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Anoop pages</title>
</head>

<body>
<?php include ("header.php"); ?>
<br />
<br />
<center>
<form method="post">
          <table border="1" width="50%" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">
          <tr style="font-weight:bold;" align="center">
	<td>SL.No</td>	  
  <td>Old SIM Status</td>
   
  </tr>
        <?php 
		
		while($row=mysql_fetch_array($search))
        {
        ?>
<tr style="font-weight:bold;" align="center">

<td><input type="value" name="id" value="<?php echo $row["id"]; ?>"></td>
  <td><input type="text"  name="old_sim_status" value=<?php echo $row["old_sim_status"];?> ></td>
  
  
</tr>       <?php  } ?>


<tr>
<td></td>
  <td><input type="Submit" value="update" name="update" />&nbsp;</td>
</tr>
       
</table>
</form>
</center>
</body>
</html>
