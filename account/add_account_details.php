<?
session_start();
include("../connection.php");

 /*include($_SERVER['DOCUMENT_ROOT']."/format/connection.php");*/

if(isset($_REQUEST["id"]))
{
	  $id=$_REQUEST["id"];
	  $transfer_from_user=$_REQUEST["from_id"];
	  $transfer_to_user=$_REQUEST["to_id"];
	  
}

	  $sql=mysql_fetch_assoc(mysql_query("select * from matrix.users  where id='".$transfer_from_user."'",$dblink));

	  $sql1=mysql_fetch_assoc(mysql_query("select * from matrix.users  where id='".$transfer_to_user."'",$dblink));


 if(isset($_POST['submit']))
	 {
	 
   $client_from=$_POST['client_from'];
   $client_to=$_POST['client_to'];
 
 
		$query1="update transfer_the_vehicle set company_from_details='".$client_from."',company_to_details='".$client_to."' where id=$id";
		
  		 mysql_query($query1);
		echo "Data Inserted successfully";
		
}
 
?>

 <html>
<head>
 
</head>
<body>


<? if(!isset($_REQUEST["view"]) && $_REQUEST["view"]!=true)
{?>

<form name="add_details" method="post" action="add_account_details.php?id=<?echo $_REQUEST["id"]?>">



<table border="0" cellspacing="5" cellpadding="5" align="left">
 <tr><td>Client User <?php echo $sql["sys_username"];?> </td></tr>
<tr>
 <td><textarea rows="3" cols="25" name="client_from" id="client_from"></textarea>
 </td>
 </tr>
 <tr><td>Transfer User <?php echo $sql1["sys_username"];?></td></tr>
 <tr><td><textarea rows="3" cols="25" name="client_to" id="client_to"></textarea></td></tr>
 <tr><td><input type="submit" name="submit" value="Submit"></td></tr>
</table>
</form>

<?  
}
 
?>
</body>
</html>
