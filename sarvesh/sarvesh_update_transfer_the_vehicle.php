<?php
include('lock.php');
include ('connection.php');
     if(isset($_POST["update"]))
  {
  $updt=mysql_query("update transfer_the_vehicle set transfer_from_paid_unpaid='".$_POST["transfer_from_paid_unpaid"]."' where id='".$_POST["id"]."'");	
     echo "record updated";
 }
   $sql=("select * from transfer_the_vehicle where id='".$_GET["id"]."'");
  $search=mysql_query($sql);


 ?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Internal Process</title>
</head>

<body>
<?php include ("header.php"); ?>
<br/>
<br />
<center>
<h2>Sarvesh's Transfer From</h2> 
<form method="post">
          <table border="1" width="50%" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">
          <tr style="font-weight:bold;" align="center">
	<td>id</td>	  
  <td>Transfer From Paid Unpaid</td>
  
 
  </tr>
        <?php while($row=mysql_fetch_array($search))
        {
        ?>
<tr style="font-weight:bold;" align="center">

<td><input type="value" name="id" value="<?php echo $row["id"];?>"></td>
<td><input type="value" name="transfer_from_paid_unpaid" value="<?php echo $row["transfer_from_paid_unpaid"];?>"></td>
  
  
</tr>       <?php } ?>


<tr>
<td></td>
  <td><input type="Submit" value="update" name="update" />&nbsp;</td>
</tr>
       
</table>
</form>
</center>
</body>
</html>
