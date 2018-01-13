<?php
 
 include("dbcon.php");
  if(isset($_GET["userid"]) && $_GET["userid"]!="" )
{
	    
		  $User_Id= $_GET["userid"];
		  $price=$_GET["price"];

		$sql_group = "select sys_group_id from group_users  where active=true and group_users.sys_user_id='" . $User_Id . "'";
		$sql_group_id = mysql_query($sql_group);
		$group_id = mysql_fetch_row($sql_group_id);
 
//$sql = "select count(*) as totalveh from `tbl_history_devices` where sys_group_id='" . $group_id[0] . "' and (remove_date="" or remove_date='0000-00-00 00:00:00' or remove_date is null)";

}
echo "Fgd";

 
		 

?>
<style>
body,td{
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:12px;
}
</style>
<html>
<head>
</head>
<body>


 <table  >
 
   

<? for($i=1;$i<=6;$i++)
{?> <tr>
	<td>
	<table border="1" cellspacing="0" cellpadding="0" width="100%">
	<tr BGCOLOR="#99CCFF">
		<td colspan="5" align="center"><b><? echo $Previous_month= date("M - Y", strtotime("-".$i." month")) ;?></b></td>		 
	</tr>
	<tr>
		<td style="color:pink;font-weight:bold">Number of Veh.</td>
		<td  style="color:pink;font-weight:bold">Amount</td>
		<td  style="color:pink;font-weight:bold">Paid Amount</td>
		<td  style="color:pink;font-weight:bold">Paid By</td>
		<td  style="color:pink;font-weight:bold">Received By</td>
	</tr>

<?
  $billing_month= date("Y-m-31 00:00:00", strtotime("-".$i." month")) ;

//select add_date from tbl_history_devices where sys_group_id='3113'  and (remove_date='' or remove_date='0000-00-00 00:00:00' or remove_date is null) and add_date <'2012-12-31 06:01:41' 




   $TotalVeh = "select count(*) as TotalVeh from tbl_history_devices where sys_group_id='".$group_id ."' and (remove_date='' or remove_date='0000-00-00 00:00:00' or remove_date is null) and add_date <'".$billing_month."'";
	  $TotalVeh_res = mysql_query($TotalVeh);
	  

?>
	<tr>
		<td><? $TotalVeh_res[][]?></td>
		<td><? $TotalVeh_res[][]*$price?></td>
		<td><? $TotalVeh_res[][] ?></td> 
		<td><? $TotalVeh_res[][]?></td>
		<td><? $TotalVeh_res[][]?></td> 
	</tr>
	</table>
	
	</td></tr>

	<?}?>
	 
  
  </table>
</body>
</html>
