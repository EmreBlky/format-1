<?php
session_start();
 include("../connection.php");
 
if(isset($_REQUEST["id"]))
{
	  $id=$_REQUEST["id"];
	  $req_id=$_REQUEST["req_id"];

}


 
 if(isset($_POST['submit']))
	 {
	 
   $support_user=$_POST['support_user'];
   $requested_user=$_POST['requested_user'];
 
	if($req_id=='1')
	{
		
		$Updateapprovestatus="update new_account_creation set approve_status=1, approve_date='".date("Y-m-d H:i:s")."', support_id='".$support_user."', telecaller_name='".$requested_user."' where id=$id";
		mysql_query($Updateapprovestatus);
		echo "Successfully Approved";
	
	}
		
}

 
?>

 <html>
<head>
 
</head>
<body>


<? if(!isset($_REQUEST["view"]) && $_REQUEST["view"]!=true)
{?>

<form name="addname" method="post" action="add_support_telecaller.php?id=<?echo $_REQUEST["id"]?>&req_id=<?echo$_REQUEST["req_id"]?>">



<table border="0" cellspacing="5" cellpadding="5" align="left">
 <tr><td>Assign request to</td></tr>
 <tr>
     <td>
      <select name="support_user" id="support_user" width="150px">
            <option value="" >-- Select One --</option>
            <?php
            $support_query = select_query("SELECT * FROM login_user WHERE parent_id=3 AND branch_id=1");
            //while($support_data=mysql_fetch_assoc($support_query))
			for($i=0;$i<count($support_query);$i++)
            {
                  ?>
            
            <option value ="<?php echo $support_query[$i]['id'] ?>"  <?echo $selected;?>>
            <?php echo $support_query[$i]['user_name']; ?>
            </option>
            <?php 
            } 
            
            ?>
            </select>
     </td>
 </tr>
 <tr>
     <td>
      <select name="requested_user" id="requested_user" width="150px">
            <option value="" >-- Select One --</option>
            <?php
            $tele_query = select_query(" select name,login_name from telecaller_users where status=1 order by name asc");
            //while($data=mysql_fetch_assoc($tele_query))
            for($j=0;$j<count($tele_query);$j++)
			{
            ?>
            
            <option value ="<?php echo $tele_query[$j]['login_name'] ?>"  <?echo $selected;?>>
            <?php echo $tele_query[$j]['name']; ?>
            </option>
            <?php 
            } 
            
            ?>
            </select>
     </td>
 </tr>
 <tr><td><input type="submit" name="submit" value="Submit"></td></tr>
</table>
</form>

<?  
}
 
?>
</body>
</html>
