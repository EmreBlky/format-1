<?php
 
 include("dbcon.php");

 if(isset($_GET["userid"]) && $_GET["userid"]!="" )
{
	$User_Id= $_GET["userid"];
 
		$sql = "select * from user_paymentstatus where  user_id=".$User_Id."   order by  calling_date desc"; 
		$rsd = mysql_query($sql);
		$total =  mysql_num_rows($rsd);


 


}

 
		 

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


<form name="form1" method="post" action="add_collectioncomment.php">
<table width="100%" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td   align="center"><strong> Comments</strong></td>

  </tr>

<?while ($row = mysql_fetch_assoc($rsd))

{ 
 
echo "<tr>";
   

echo "<td>" . date("d M Y",strtotime($row['calling_date'])) . "</td>";

echo "</tr>";
echo "<tr>";
echo "<td>" . $row['coment_bycalling'] . "</td>";

echo "</tr>";
echo "<tr>";

echo "<td>Status: ";

If($row['calling_status']=="1")
{
echo " Payment supposed to be received today</td>";
}
else
{
echo " Further calling </td>";
}
  
  
  echo "</tr>";
 
echo "<tr>";
   

echo "<td><hr/></td>";

echo "</tr>";
 
  }?>
 

     </table>
</form>
</body>
</html>
